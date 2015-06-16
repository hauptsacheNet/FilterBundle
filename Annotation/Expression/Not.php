<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 16.06.15
 * Time: 13:27
 */

namespace Hn\FilterBundle\Annotation\Expression;


use Hn\FilterBundle\Annotation\SimpleMetaAnnotation;

/**
 * @Annotation
 * @Target("ANNOTATION")
 */
class Not implements SimpleMetaAnnotation
{
    /**
     * The sub expression annotations.
     *
     * @var object
     */
    public $child;

    /**
     * Returns the constructor arguments in the correct order.
     * It may return other annotations which then have to be handled as well
     *
     * @return array
     */
    public function getConstructorArguments()
    {
        return array($this->child);
    }
}