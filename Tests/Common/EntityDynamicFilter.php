<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 02.06.14
 * Time: 15:38
 */

namespace Hn\FilterBundle\Tests\Common;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\Expr\Comparison;
use Hn\FilterBundle\Filter as Filter;
use Hn\FilterBundle\FilterOperator as FilterOperator;

class EntityDynamicFilter
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $field;

    /**
     * @ORM\Column(type="string")
     */
    private $operator = 'Hn\FilterBundle\FilterOperator\Eq';

    /**
     * @ORM\Column(type="string")
     * @Filter\MapUsing("field", @FilterOperator\Field("operator"))
     */
    private $value;

    /**
     * @ORM\Column(type="string")
     * @Filter\MapUsing("field", @FilterOperator\Field("operator"))
     */
    private $value2;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param mixed $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return mixed
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value2
     */
    public function setValue2($value2)
    {
        $this->value2 = $value2;
    }

    /**
     * @return mixed
     */
    public function getValue2()
    {
        return $this->value2;
    }
}