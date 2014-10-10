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
final class Contains extends MappedExpression implements SimpleMetaAnnotation {
}