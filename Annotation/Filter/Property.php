<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 09.10.14
 * Time: 17:51
 */

namespace Hn\FilterBundle\Annotation\Filter;

use Doctrine\ORM\Mapping\Annotation;
use Hn\FilterBundle\Meta\FilterProperty;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
final class Property implements Annotation
{
    /**
     * The expression on the field to execute
     */
    public $expression;

    /**
     * @var string
     * @Enum({"SCALAR", "OBJECT", "ID", "COLLECTION_AND", "COLLECTION_OR"})
     * @see \Hn\FilterBundle\Meta\FilterProperty TYPE constants
     */
    public $type = "SCALAR";
}