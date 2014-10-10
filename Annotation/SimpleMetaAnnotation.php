<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 09.10.14
 * Time: 17:56
 */

namespace Hn\FilterBundle\Annotation;

use Doctrine\ORM\Mapping\Annotation;


interface SimpleMetaAnnotation extends Annotation
{
    /**
     * Returns the constructor arguments in the correct order.
     * It may return other annotations which then have to be handled as well
     *
     * @return array
     */
    public function getConstructorArguments();
} 