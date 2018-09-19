<?php
/**
 * Created by PhpStorm.
 * User: Joel.Mnisi
 * Date: 2018/03/18
 * Time: 04:31 PM
 */

$con = mysqli_connect("localhost","root","","phppot_examples");


function pagination($con,$table,$pageno,$numberOfRecordsPerPage)
{
    $query = $con->query("SELECT COUNT(*) as rows FROM ".$table);
    $row = mysqli_fetch_assoc($query);
    $totalRecords = $row["rows"];


    $last = ceil($totalRecords/$numberOfRecordsPerPage);

    $pagination = "";

    if($last != 1)
    {
        if($pageno > 1)
        {
            $previous = "";
            $previous = $pageno - 1;
            $pagination .= "<a href='pagination.php?pageno=$previous'>Previous</a>";
        }

        for ($i = $pageno - 4; $i<$pageno;$i++)
        {
            if($i>0)
            {
                $pagination .= "<a href='pagination.php?pageno=$i'>$i</a>";
            }

        }
        $pagination .= "<a href='pagination.php?pageno=$pageno'>$pageno</a>";
        for ($i = $pageno + 1; $i<=$last;$i++)
        {
            $pagination .= "<a href='pagination.php?pageno=$i'>$i</a>";
            if($i > $pageno + 4)
            {
                break;
            }
        }
        if($last > $pageno)
        {
            $next = "";
            $next = $pageno + 1;
            $pagination .= "<a href='pagination.php?pageno=$next'>Next</a>";
        }

    }
    //Limit

    $limit = "LIMIT ". ($pageno - 1) * $numberOfRecordsPerPage .",".$numberOfRecordsPerPage;

    return ["pagination"=>$pagination, "limit"=>$limit];
}

if(isset($_GET['pageno']))
{
    $pageno = $_GET['pageno'];
    $table = "toy";
    $array =  pagination($con,$table,$pageno,2);
    $sql = "SELECT *  FROM ".$table . " " .$array['limit'];

    $query = $con->query($sql);
    echo $con->error;
    while($row = mysqli_fetch_assoc($query))
    {
        echo "<div style='margin: 0 auto; font-size: 20px;'>".$row["name"]."</div>";
    }
    echo "<div style='font-size:22px;'>".  $array['pagination'] ."</div>";
}
