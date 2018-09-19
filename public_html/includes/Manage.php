<?php
/**
 * Created by PhpStorm.
 * User: Joel.Mnisi
 * Date: 2018/03/18
 * Time: 06:05 PM
 */

class Manage
{
    private $con;
    public $pre_stmt;
    public $res;
    /**
     * DBOperation constructor.
     */
    public function __construct()
    {
        //include_once("../database/Database.php");
        include_once ("../database/Database.php");
        $db = new Database();
        $this->con = $db->connect();
    }

    public function  manageRecordWithPagination($table,$pno){
        $a = $this->pagination($this->con,$table,$pno,4);
        $rows = array();
        if($table ==  "`categories`")
        {
            $this->pre_stmt = "SELECT p.`category_name` as category, c.`category_name` as parent,p.`cat_id`,p.`status` 
                    FROM `categories` p LEFT JOIN `categories` c 
                    on p.`pararent_id` = c.`cat_id` ". $a['limit'];
        }
        else if($table == "`products`")
        {
            $this->pre_stmt = "SELECT p.pid, p.product_name, c.category_name, b.brand_name,p.product_price,p.product_stock,p.added_date,p.product_status
                FROM products p, brands b, categories c
                where p.bid = b.brand_id AND p.cid = c.cat_id";
        }
        else{
            $this->pre_stmt = "SELECT * FROM ". $table . " " . $a['limit'];
        }

        $this->res = $this->con->query($this->pre_stmt) or die($this->con->error);

        if($this->res->num_rows > 0)
        {
            while ($row = $this->res->fetch_assoc())
            {
                $rows[] = $row;
            }

        }

    return ["rows"=>$rows, "pagination"=>$a['pagination']];
    }
   private function pagination($con,$table,$pageno,$numberOfRecordsPerPage)
    {
        $query = $con->query("SELECT COUNT(*) as rows FROM ".$table);
        $row = mysqli_fetch_assoc($query);
        $totalRecords = $row["rows"];


        $last = ceil($totalRecords/$numberOfRecordsPerPage);

        $pagination = "<ul class='pagination'>";

        if($last != 1)
        {
            if($pageno > 1)
            {
                $previous = "";
                $previous = $pageno - 1;
                $pagination .= " <li class='page-tem'><a pn='$previous' href='#' class='page-link'>Previous</a></li> ";
            }

            for ($i = $pageno - 4; $i<$pageno;$i++)
            {
                if($i>0)
                {
                    $pagination .= "<li class='page-tem'><a pn='$i' href='#' class='page-link'>$i</a></li>";
                }

            }
            $pagination .= "<li class='page-tem'><a pn='$pageno' href='#' class='page-link'> $pageno</a></li>";
            for ($i = $pageno + 1; $i<=$last;$i++)
            {
                $pagination .= "<li class='page-tem'><a pn='$i' href='#' class='page-link'>$i</a></li>";
                if($i > $pageno + 4)
                {
                    break;
                }
            }
            if($last > $pageno)
            {
                $next = "";
                $next = $pageno + 1;
                $pagination .= "<li class='page-tem'><a pn='$next' href='#' class='page-link'>Next</a></li>";
            }

        }
        //Limit

        $limit = "LIMIT ". ($pageno - 1) * $numberOfRecordsPerPage .",".$numberOfRecordsPerPage;
        $pagination .="</ul>";
        return ["pagination"=>$pagination, "limit"=>$limit];
    }
    public function deleteRecord($table,$pk,$id)
    {
        if($table=="`categories`")
        {
            $this->pre_stmt = $this->con->prepare("SELECT $id FROM `categories` WHERE `pararent_id` = ?");
            $this->pre_stmt->bind_param("i",$id);
            $this->pre_stmt->execute()or die($this->con->error);
            $this->res = $this->pre_stmt->get_result();

            if($this->res->num_rows > 0)
            {
                return "DEPENDENT_CATEGORY";
            }
            else
            {
                $this->pre_stmt = $this->con->prepare("DELETE FROM " .$table . " WHERE $pk = ? ");
                $this->pre_stmt->bind_param("i",$id);
                $this->pre_stmt->execute()or die($this->con->error);
                $this->res = $this->pre_stmt->get_result();

                if($this->res)
                {
                    return "CATEGORY_DELETED";
                }

            }

        }
        else
        {


            $this->pre_stmt = $this->con->prepare("DELETE FROM " .$table . " WHERE $pk = ? ");
            $this->pre_stmt->bind_param("i",$id);
            $this->pre_stmt->execute()or die($this->con->error);
            $this->res = $this->pre_stmt->get_result();


            if( $this->res)
            {
                return "DELETED";
            }
            else
            {
                return $this->con->error;
            }

        }
    }
    public function getSingleRecord($table,$pk,$id)
    {

        $this->pre_stmt = $this->con->prepare("SELECT * FROM ". $table . " WHERE $pk =? ");

        $this->pre_stmt->bind_param("i",$id);
        $this->pre_stmt->execute()or die($this->con->error);
        $this->res = $this->pre_stmt->get_result();
        if($this->res->num_rows > 0)
        {
            $row = $this->res->fetch_assoc();
        }

        return $row;
    }
    public function update_record($table,$where,$fields)
    {
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value)
        {
            $condition .= $key . " = '" .$value . "' AND ";
        }

        $condition = substr($condition,0,-5);

        foreach ($fields as $key => $value)
        {
            $sql .= $key . " = '" .$value . "', ";
        }
        $sql = substr($sql,0,-2);
        $sql = "UPDATE " . $table . " SET " . $sql. " WHERE " .$condition;

        if(mysqli_query($this->con,$sql))
        {
            return "UPDATED";
        }

    }
    public function storeCustomerInvoice($order_date,$customer_name,$totalQty,$qty,$pro_price,$pro_name,$sub_total,$gst,$net_total,$discount,$paid,$due,$payment)
    {

        $this->pre_stmt = $this->con->prepare("INSERT INTO `invoice`( `customer_name`, `order_date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) 
                                              VALUES (?,?,?,?,?,?,?,?,?)");
        $this->pre_stmt->bind_param("ssdddddds",$customer_name,$order_date,$sub_total,$gst,$discount,$net_total,$paid,$due,payment_type);
        $this->pre_stmt->execute()or die($this->con->error);
        $invoice_no = $this->pre_stmt->insert_id;

        if(!empty($invoice_no))
        {
            for($i = 0; $i< count($totalQty); $i++)
            {
                $rem_qty = $totalQty[$i] - $qty[$i];
                if($rem_qty < 0)
                {
                    return "ORDER_FAIL_TO_COMPLETE";
                }
                else  {
                    //update product quantity
                    $this->con->query("UPDATE `products` SET `product_stock` = '$rem_qty' WHERE `	product_name` = '".$pro_name[$i]. "'") or die($this->con->error);
                }

                $this->pre_stmt = $this->con->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`) 
                                                    VALUES (?,?,?,?)");
                $this->pre_stmt->bind_param("isdi",$invoice_no,$pro_name[$i],$pro_price[$i],$qty[$i]);
                $this->pre_stmt->execute()or die($this->con->error);
                $this->res = $this->pre_stmt->get_result();
            }
            return "ORDER_COMPLETED";
        }


    }

}
