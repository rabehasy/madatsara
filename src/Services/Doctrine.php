<?php

namespace App\Services;

use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Filter\SQLFilter;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\Mapping\ClassMetadata;

class Doctrine extends SQLFilter
{
    public function paginate(Query $dql, int $page, int $limit): Paginator
    {
        $paginator = new Paginator($dql);

        // avoid msg: Not all identifier properties can be found in the ResultSetMapping: id
        $paginator->setUseOutputWalkers(false);

        $query = $paginator->getQuery();

        if ($limit > 0) {
            $query->setMaxResults($limit);
        }

        $query
            ->setFirstResult($limit * ($page - 1)); // Offset

        return $paginator;
    }

    public function addFilterConstraint(ClassMetaData $targetEntity, $targetTableAlias)
    {
        if (!$targetEntity->hasField('disabledAt')) {
            return '';
        }

        return $targetTableAlias.'.disabled_at IS NULL';
    }
}
