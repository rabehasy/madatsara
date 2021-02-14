<?php

namespace App\Loader;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Translation\Exception\InvalidResourceException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Component\Translation\Loader\LoaderInterface;
use Symfony\Component\Translation\MessageCatalogue;

class DbLoader implements LoaderInterface
{
    /**
     * @var string
     */
    private $entityClass;
    /**
     * @var EntityManager
     */
    private $doctrine;

    /**
     * DbLoader constructor.
     */
    public function __construct(ContainerInterface $container, EntityManager $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->entityClass = $container->getParameter('db_i18n.entity');
    }

    /**
     * Loads a locale.
     *
     * @param mixed  $resource A resource
     * @param string $locale   A locale
     * @param string $domain   The domain
     *
     * @return MessageCatalogue A MessageCatalogue instance
     *
     * @throws NotFoundResourceException when the resource cannot be found
     * @throws InvalidResourceException  when the resource cannot be loaded
     */
    public function load($resource, string $locale, string $domain = 'messages')
    {
        $resource = $resource ?? '';
        $values = [];
        if (null !== $this->getRepository()) {
            $messages = $this->getRepository()->findByDomainAndLocale($domain, $locale);

            $values = array_map(static function (EntityInterface $entity) {
                return $entity->getTranslation();
            }, $messages);
        }

        $catalogue = new MessageCatalogue($locale, [
            $domain => $values,
        ]);

        return $catalogue;
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        $schemaManager = $this->doctrine->getConnection()->getSchemaManager();
        if (!$schemaManager->tablesExist(['translation'])) {
            return null;
        }

        $repository = $this->doctrine->getRepository($this->entityClass);

        return $repository;
    }
}
