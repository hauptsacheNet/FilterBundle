<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10.10.14
 * Time: 09:01
 */

namespace Hn\FilterBundle\Annotation\Expression;

use Hn\FilterBundle\Annotation\SimpleMetaAnnotation;

/**
 * @Annotation
 * @Target("ANNOTATION")
 */
final class In extends MappedExpression implements SimpleMetaAnnotation
{
}