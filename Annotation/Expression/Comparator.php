<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10.10.14
 * Time: 09:00
 */

namespace Hn\FilterBundle\Annotation\Expression;


use Hn\FilterBundle\Annotation\SimpleMetaAnnotation;

/**
 * @Annotation
 * @Target("ANNOTATION")
 */
final class Comparator extends MappedExpression implements SimpleMetaAnnotation
{
    /**
     * @var string
     */
    public $mappedProperty;

    /**
     * @var string
     */
    public $operator = \Hn\FilterBundle\Meta\Expression\Comparator::EQ;

    public function getConstructorArguments()
    {
        return array($this->mappedProperty, $this->operator);
    }
}