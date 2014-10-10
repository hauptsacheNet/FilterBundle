<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10.10.14
 * Time: 09:06
 */

namespace Hn\FilterBundle\Annotation\Expression;


abstract class MappedExpression
{
    /**
     * @var string
     */
    public $mappedProperty;

    /**
     * Returns the constructor arguments in the correct order.
     * It may return other annotations which then have to be handled as well
     *
     * @return array
     */
    public function getConstructorArguments()
    {
        return array($this->mappedProperty);
    }
} 