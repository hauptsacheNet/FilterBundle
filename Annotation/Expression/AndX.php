<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 09.10.14
 * Time: 17:59
 */

namespace Hn\FilterBundle\Annotation\Expression;

use Doctrine\ORM\Mapping\Annotation;
use Hn\FilterBundle\Annotation\SimpleMetaAnnotation;

/**
 * @Annotation
 * @Target("ANNOTATION")
 */
final class AndX extends Composite implements SimpleMetaAnnotation
{
}