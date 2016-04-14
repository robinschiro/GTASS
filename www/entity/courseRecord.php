<?php

/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 4/12/2016
 * Time: 1:09 AM
 */
class courseRecord
{
    var $name;
    var $grade;

    /**
     * courseRecord constructor.
     * @param $name
     * @param $grade
     */
    public function __construct($name, $grade)
    {
        $this->name = $name;
        $this->grade = $grade;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param mixed $grade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    


}