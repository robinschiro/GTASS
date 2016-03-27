<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/22/2016
 * Time: 11:16 PM
 */
class user
{
    private $username;
    private $firstName;
    private $lastName;
    private $password; //hash password before storing
    private $email;

    /**
     * user constructor.
     * @param $username
     * @param $firstName
     * @param $lastName
     * @param $password
     * @param $email
     */
//    public function __construct($username, $firstName, $lastName, $password, $email)
//    {
//        $this->username = $username;
//        $this->firstName = $firstName;
//        $this->lastName = $lastName;
//        $this->password = $password;
//        $this->email = $email;
//    }

    public function __construct()
    {
        $this->username = null;
        $this->firstName = null;
        $this->lastName = null;
        $this->password = null;
        $this->email = null;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}