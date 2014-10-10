<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10.10.14
 * Time: 09:00
 */

namespace Hn\FilterBundle\Annotation\Expression;


use Doctrine\Common\Annotations\Annotation;

abstract class Composite
{
    /**
     * The sub expression annotations.
     *
     * @var array
     */
    public $parts;

    /**
     * Returns the constructor arguments in the correct order.
     * It may return other annotations which then have to be handled as well
     *
     * @return array
     */
    public function getConstructorArguments()
    {
        return array($this->parts);
    }
} 