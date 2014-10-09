<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 04.06.14
 * Time: 11:56
 */

namespace Hn\FilterBundle\Meta;


use Hn\FilterBundle\Factory\FilterMetaCollectionInterface;

interface FilterDefinitionInterface
{
    public function define(FilterMetaCollectionInterface $factory);
}