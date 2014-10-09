<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 03.06.14
 * Time: 16:37
 */

namespace Hn\FilterBundle\Tests\Common;


class PersonFilter
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var number
     */
    private $age;

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param number $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return number
     */
    public function getAge()
    {
        return $this->age;
    }
}