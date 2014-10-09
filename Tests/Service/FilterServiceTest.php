<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 03.06.14
 * Time: 15:27
 */

namespace Hn\FilterBundle\Tests\Service;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Hn\FilterBundle\Factory\FilterMetaFactory;
use Hn\FilterBundle\Meta\Expression\AndX;
use Hn\FilterBundle\Meta\Expression\Comparator;
use Hn\FilterBundle\Meta\FilterClass;
use Hn\FilterBundle\Meta\FilterProperty;
use Hn\FilterBundle\Service\FilterService;
use Hn\FilterBundle\Tests\Common\Person;
use Hn\FilterBundle\Tests\Common\PersonFilter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\Query\Parameter;

class FilterServiceTest extends KernelTestCase
{

    /**
     * @var FilterService
     */
    protected $filterService;

    /**
     * @var Registry
     */
    protected $doctrine;

    public function setUp()
    {
        $personMeta = new FilterClass('Hn\FilterBundle\Tests\Common\PersonFilter', array(
            new FilterProperty('name', new AndX(array(
                new Comparator('person.name'),
                new Comparator('job.description')
            ))),
            new FilterProperty('age', new Comparator('person.age'))
        ));

        // prepare factory
        $factory = new FilterMetaFactory();
        $factory->addMetaClass($personMeta);

        // create filter service
        $this->filterService = new FilterService($factory);
        $this->bootKernel();
        $container = static::$kernel->getContainer();
        $this->doctrine = $container->get('doctrine');
    }

    public function testEmpty()
    {
        $filter = new PersonFilter();

        /** @var EntityManager $em */
        $em = $this->doctrine->getManager();
        $qb = $em->createQueryBuilder();
        $expr = $this->filterService->createExpression($filter, $qb);

        $expect = $qb->expr()->andX();
        $this->assertEquals($expect, $expr);
    }

    public function testEquals()
    {
        $filter = new PersonFilter();
        $filter->setAge(5);

        /** @var EntityManager $em */
        $em = $this->doctrine->getManager();
        $qb = $em->createQueryBuilder();
        $expr = $this->filterService->createExpression($filter, $qb);

        $expect = $qb->expr()->andX(
            $qb->expr()->eq('person.age', '?0')
        );
        $this->assertEquals($expect, $expr);

        $expectParameter = new ArrayCollection(array(
            0 => new Parameter(0, 5, Type::INTEGER)
        ));
        $this->assertEquals($expectParameter, $qb->getParameters());
    }

    public function testEqualsOnMultiple()
    {
        $filter = new PersonFilter();
        $filter->setName("Max");

        /** @var EntityManager $em */
        $em = $this->doctrine->getManager();
        $qb = $em->createQueryBuilder();
        $expr = $this->filterService->createExpression($filter, $qb);

        $expect = $qb->expr()->andX(
            $qb->expr()->andX(
                $qb->expr()->eq('person.name', '?0'),
                $qb->expr()->eq('job.description', '?1')
            )
        );
        $this->assertEquals($expect, $expr);

        $expectParameter = new ArrayCollection(array(
            0 => new Parameter(0, 'Max', \PDO::PARAM_STR),
            1 => new Parameter(1, 'Max', \PDO::PARAM_STR)
        ));
        $this->assertEquals($expectParameter, $qb->getParameters());
    }
} 