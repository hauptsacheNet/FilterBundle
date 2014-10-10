<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 03.06.14
 * Time: 12:50
 */

namespace Hn\FilterBundle\Service;


use Doctrine\ORM\QueryBuilder;
use Hn\EntityBundle\Service\EntityService;
use Hn\FilterBundle\Factory\FilterMetaFactoryInterface;
use Hn\FilterBundle\Meta\Expression;
use Hn\FilterBundle\Meta\FilterProperty;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class FilterService implements FilterServiceInterface
{
    /**
     * @var PropertyAccessor
     */
    private $accessor;

    /**
     * @var FilterMetaFactoryInterface
     */
    private $metaFactory;

    /**
     * @var EntityService
     */
    private $entityService;

    public function __construct(FilterMetaFactoryInterface $metaFactory, EntityService $entityService)
    {
        $this->accessor = PropertyAccess::createPropertyAccessor();
        $this->metaFactory = $metaFactory;
        $this->entityService = $entityService;
    }

    /**
     * @param object $filter
     * @param QueryBuilder $qb
     * @throws \LogicException
     */
    public function addFilterToQueryBuilder($filter, QueryBuilder $qb)
    {
        $expr = $this->createExpression($filter, $qb);

        if ($expr->count() > 0) {
            $qb->andWhere($expr);
        }
    }

    /**
     * @param object $filter
     * @param QueryBuilder $qb
     * @param string[] $propertyPath
     * @return \Doctrine\ORM\Query\Expr\Andx
     * @throws \LogicException
     */
    public function createExpression($filter, QueryBuilder $qb, array $propertyPath = array())
    {
        $class = $this->metaFactory->getMetadataFor(get_class($filter));
        $andX = $qb->expr()->andX();

        // add all properties which should be filtered
        foreach ($class->getFilterProperties() as $filterProperty) {
            $value = $this->accessor->getValue($filter, $filterProperty->getName());
            if ($value === null) {
                continue;
            }

            // find the right expression to use
            switch ($filterProperty->getType()) {
                case FilterProperty::TYPE_ID:

                    if (is_array($value) || $value instanceof \Traversable) {
                        if ($value instanceof \Traversable) {
                            $value = iterator_to_array($value);
                        }
                        foreach ($value as &$entry) {
                            $entry = $this->entityService->getIdentifier($entry);
                        }
                    } else {
                        $value = $this->entityService->getIdentifier($value);
                    }

                    // No break on purpose.
                case FilterProperty::TYPE_SCALAR:
                    $expr = $filterProperty->getExpression()->createExpression($qb, $value);
                    $andX->add($expr);
                    break;

                case FilterProperty::TYPE_OBJECT:
                    $expr = $this->createExpression($value, $qb);
                    $andX->add($expr);
                    break;

                case FilterProperty::TYPE_COLLECTION:
                    $expr = $qb->expr()->andX();

                    foreach($value as $entry) {
                        $expr->add($this->createExpression($entry, $qb));
                    }
                    break;
            }
        }

        return $andX;
    }
} 