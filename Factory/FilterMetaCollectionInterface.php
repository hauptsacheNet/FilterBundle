<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 04.06.14
 * Time: 12:25
 */

namespace Hn\FilterBundle\Factory;


use Hn\FilterBundle\Meta\FilterClass;

interface FilterMetaCollectionInterface
{
    public function addMetaClass(FilterClass $filterClass);
} 