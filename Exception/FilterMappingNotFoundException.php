<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 04.06.14
 * Time: 12:12
 */

namespace Hn\FilterBundle\Exception;


use Exception;

class FilterMappingNotFoundException extends \RuntimeException
{
    private $className;

    public function __construct($className)
    {
        $this->className = $className;
        parent::__construct("There is no filter mapping for '$className'");
    }

} 