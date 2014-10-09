<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 02.06.14
 * Time: 15:28
 */

namespace Hn\FilterBundle\Tests\Common;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Hn\FilterBundle\Filter as Filter;
use Hn\FilterBundle\FilterOperator as FilterOperator;

class EntityFilter
{

    /**
     * @ORM\Column(type="string")
     * @Filter\OrX({
     *     @Filter\MapTo("entity.name", @FilterOperator\Eq),
     *     @Filter\MapTo("entity.description", @FilterOperator\Contains)
     * })
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Filter\MapTo("entity.rank", @FilterOperator\Eq)
     * @var number
     */
    private $rank;

    /**
     * @ORM\Column(type="text")
     * @Filter\MapTo("entity.description", @FilterOperator\Contains)
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @Filter\MapTo("entity.createdAt", @FilterOperator\Gte)
     * @var \DateTime
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime")
     * @Filter\MapTo("entity.createdAt", @FilterOperator\Lte)
     * @var \DateTime
     */
    private $endAt;

    /**
     * @ORM\OneToMany(targetEntity="EntityDynamicFilter", fetch="EAGER")
     * @Filter\AndX
     * @var Collection|EntityDynamicFilter[]
     */
    private $and;

    public function __construct()
    {
        $this->and = new ArrayCollection();
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param mixed $rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    }
    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }
    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @param mixed $startAt
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;
    }
    /**
     * @return mixed
     */
    public function getStartAt()
    {
        return $this->startAt;
    }
    /**
     * @param mixed $endAt
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;
    }
    /**
     * @return mixed
     */
    public function getEndAt()
    {
        return $this->endAt;
    }
    /**
     * @return \Doctrine\Common\Collections\Collection|\Hn\FilterBundle\Tests\Common\EntityDynamicFilter[]
     */
    public function getAnd()
    {
        return $this->and;
    }
    public function addAnd(EntityDynamicFilter $filter)
    {
        $this->and->add($filter);
    }
    public function removeAnd(EntityDynamicFilter $filter)
    {
        $this->and->removeElement($filter);
    }
}