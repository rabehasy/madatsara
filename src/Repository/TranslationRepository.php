<?php

namespace App\Repository;

use App\Entity\Translation;
use App\Services\Doctrine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;
use function Symfony\Component\String\u;

/**
 * @method Translation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Translation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Translation[]    findAll()
 * @method Translation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TranslationRepository extends ServiceEntityRepository
{
    private $fieldsExclude = [
        'clone',
    ];

    /**
     * @var Doctrine
     */
    private $doctrineService;

    /**
     * @var Security
     */
    private $security;

    public function __construct(ManagerRegistry $registry, Doctrine $doctrineService, Security $security)
    {
        parent::__construct($registry, Translation::class);

        $this->doctrineService = $doctrineService;

        $this->security = $security;
    }

    /**
     * Generic Query.
     *
     * @return \Doctrine\ORM\Tools\Pagination\Paginator
     */
    public function findQuery(array $query = [], int $page = 0, int $limit = 0)
    {
        $qb = $this->createQueryBuilder('a');

        $search = '';
        $isWhereAnd = false;

        if (!empty($query['search'])) {
            $search = $query['search'];
        }

        if ('' !== $search) {
            // Convert String to lower and trim
            $search = u($search)->lower()->trim();

            $qb->where('lower(a.keytranslate) LIKE :search OR lower(a.translation) LIKE :search')
                ->setParameter('search', '%'.$search.'%');

            $isWhereAnd = true;
        }

        // Filter option_translation_type
        if (!empty($query['option_translation_type']) && '' !== $query['option_translation_type']) {
            $qb = $qb->where('a.translationType = :translationType');

            if ($isWhereAnd) {
                $qb = $qb->andWhere('a.translationType = :translationType');
            }

            $qb = $qb->setParameter('translationType', $query['option_translation_type']);

            $isWhereAnd = true;
        }

        // Filter option_locale
        if (!empty($query['option_locale']) && '' !== $query['option_locale']) {

            $qb = $qb->where('a.locale = :locale');
            if ($isWhereAnd) {
                $qb = $qb->andWhere('a.locale = :locale');
            }

            $qb = $qb->setParameter('locale', $query['option_locale']);

            $isWhereAnd = true;
        }

        // Filter option_domain
        if (!empty($query['option_domainoption_domain']) && '' !== $query['option_domain']) {
            $qb = $qb->where('a.domain = :domain');
            if ($isWhereAnd) {
                $qb = $qb->andWhere('a.domain = :domain');
            }

            $qb = $qb->setParameter('domain', $query['option_domain']);

            $isWhereAnd = true;
        }

        $qb->orderBy('a.keytranslate', 'ASC');

        $q = $qb->getQuery();

        $paginator = $this->doctrineService->paginate($q, $page, $limit);

        return $paginator;
    }

    /**
     * @return mixed
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByDomainAndLocale(string $domain, string $locale)
    {
        $locale = $_ENV['DEFAULT_LOCALE'] ?? $locale;

        return $this->createQueryBuilder('t', 't.keytranslate')
            ->where('t.domain = :domain')
            ->andWhere('t.locale = :locale')
            ->andWhere('t.translationType = \'domain\'') // Files only
            ->setParameter('domain', $domain)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByIds(string $ids)
    {
        $qb = $this->createQueryBuilder('t')
            ->where('t.id IN (:ids)')
            ->setParameter('ids', explode(',', $ids))
            ->getQuery()
            ->getResult()
            ;

        return $qb;
    }

    /**
     * @return mixed
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function updateAll(array $fields)
    {
        if (empty($fields)) {
            return false;
        }

        $sqlFields = [];

        $sql = "UPDATE App\Entity\Translation a ";

        $parameterCollection = new ArrayCollection();

        foreach ($fields as $key => $value) {
            if (!in_array($key, $this->fieldsExclude)) {
                $sqlFields[] = 'a.'.$key.' = :'.$key;
//                $paramFields[$key] = $value;
                $parameterCollection->add(new Parameter($key, $value));
            }
        }

        if (!empty($sqlFields)) {
            $sql .= ' set ';
        }
        $sql .= implode(', ', $sqlFields);

        $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($parameterCollection)
            ->execute();
    }
}
