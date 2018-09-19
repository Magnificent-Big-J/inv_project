<?php
/**
 * Created by PhpStorm.
 * User: Joel.Mnisi
 * Date: 2018/03/07
 * Time: 02:36 PM
 */

include_once("./database/constants.php");
if(isset($_SESSION["userid"]))
{
    session_destroy();

}
header("location:" .DOMAIN."/");