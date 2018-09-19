<?php
/**
 * Created by PhpStorm.
 * User: Joel.Mnisi
 * Date: 2018/03/01
 * Time: 03:17 PM
 */

class Database
{
    private $con;

    /**
     * Database constructor.
     */
    public function __construct()
    {
    }
    public function connect()
    {
        include_once('constants.php');
        $this->con = new Mysqli(HOST,USER,PASS,DB);
        if($this->con)
        {

            return $this->con;
        }
        return "DATABASE connection failed";

    }



}