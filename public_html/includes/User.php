<?php
/**
 * Created by PhpStorm.
 * User: Joel.Mnisi
 * Date: 2018/03/02
 * Time: 02:11 PM
 */

class User
{

    /**
     * User constructor.
     */
    private  $con;
    public function __construct()
    {
        include_once ('../database/Database.php');
        $db = new Database();
        $this->con = $db->connect();


    }
    private function emailExists($email)
    {
       $pre_stmt = $this->con->prepare("SELECT `user_id` FROM `users` WHERE `email`= ?");
       $pre_stmt->bind_param("s",$email);
       $pre_stmt->execute() or die($this->con->error);
       $results = $pre_stmt->get_result();

       if($results->num_rows >0)
       {
           return 1;
       }
       else{

           return 0;
       }
    }
    public function createUserAccount($username,$email,$password,$usertype)
    {
        //To protect your application from sql, you can prepares statement


        if( $this->emailExists($email))
        {
            return "Email_Already_Exists";
        }
        else
        {
            $password = password_hash($password,PASSWORD_BCRYPT,["const"=>8]);
            $date = date("Y-m-d h:m:s");
            $notes = "";
            $pre_stmt = $this->con->prepare("INSERT INTO `users`(`username`, `email`, `password`, `usertype`, `created_at`, `last_login`, `notes`)
                                            VALUES (?,?,?,?,?,?,?)");
            $pre_stmt->bind_param("sssssss",$username,$email,$password,$username,$date,$date,$notes);
            $results = $pre_stmt->execute() or die($this->con->error);

            if($results)
            {
               return $this->con->insert_id;
            }
            else
            {
                return "SOME_ERROR";
            }
        }


    }
    public function userLogin($email,$password)
    {
        $pre_stmt = $this->con->prepare("SELECT `user_id`, `username`, `email`, `password`, `last_login` FROM `users` WHERE email = ? ");
        $pre_stmt->bind_param("s",$email);
        $pre_stmt->execute() or die($this->con->error);
        $results = $pre_stmt->get_result();

        if($results->num_rows <1)
        {
            return "Not_registered";
        }
        else
        {
            $row = $results->fetch_assoc();
            if(password_verify($password,$row['password']))
            {
                $_SESSION['userid'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['last_login'] = $row['last_login'];
                $date = date("Y-m-d h:m:s");
                $pre_stmt = $this->con->prepare("UPDATE `users` SET `last_login` = ? where email = ?");
                $pre_stmt->bind_param("ss",$date,$email);
                $results = $pre_stmt->execute() or die($this->con->error);

                if($results)
                {
                    return 1;//pass
                }
                else
                {
                    return 0;//fail
                }
            }
            else{
                return "Invalid_username_password";
            }
        }


    }
}