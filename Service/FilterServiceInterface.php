<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 02.06.14
 * Time: 15:59
 */

namespace Hn\FilterBundle\Service;



use Doctrine\ORM\Query\Expr\Composite;
use Doctrine\ORM\QueryBuilder;

interface FilterServiceInterface
{
    /**
     * @param object $filter
     * @param QueryBuilder $qb
     * @throws \LogicException
     */
    public function addFilterToQueryBuilder($filter, QueryBuilder $qb);
} 