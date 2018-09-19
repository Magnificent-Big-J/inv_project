<?php
/**
 * Created by PhpStorm.
 * User: Joel.Mnisi
 * Date: 2018/03/06
 * Time: 01:47 PM
 */

class DBOperation
{

    private $con;
    public $pre_stmt;
    public $res;
    /**
     * DBOperation constructor.
     */
    public function __construct()
    {
        include_once("../database/Database.php");

        $db = new Database();
        $this->con = $db->connect();
    }
    public function addCategody($parent_id,$category)
    {
        $status = 1;
        $this->pre_stmt = $this->con->prepare("INSERT INTO `categories`( `pararent_id`, `category_name`, `status`) VALUES (?,?,?)");
        $this->pre_stmt->bind_param("isi",$parent_id,$category,$status);
        $this->res = $this->pre_stmt->execute() or die($this->con->error);

        if($this->res)
        {
            return "CAT_ADDED";
        }
        else
        {
            return 0;
        }

    }
    public function addBrand($brand)
    {
        $status = 1;
        $this->pre_stmt = $this->con->prepare("INSERT INTO `brands`( `brand_name`, `status`) VALUES (?,?)");
        $this->pre_stmt->bind_param("si",$brand,$status);
        $this->res = $this->pre_stmt->execute() or die($this->con->error);

        if($this->res)
        {
            return "BRAND_ADDED";
        }
        else
        {
            return 0;
        }

    }
    public function addProduct($cid, $bid, $product_name,$date, $qty, $price)
    {
        $status = 1;
        $this->pre_stmt = $this->con->prepare("INSERT INTO `products`(`cid`, `bid`, `product_name`, `product_price`, `product_stock`, `product_status`, `added_date`) VALUES (?,?,?,?,?,?,?)");
        //$this->pre_stmt->bind_param("iisdisi",$cid,$bid,$product_name,$price,$qty,$status,$date);
        $this->pre_stmt->bind_param("iisdiis",$cid,$bid,$product_name,$price,$qty,$status,$date);
        $this->res = $this->pre_stmt->execute() or die($this->con->error);

        if($this->res)
        {
            return "Product_ADDED";
        }
        else
        {
            return 0;
        }

    }

    public function getAllRecord($table)
    {
        $this->pre_stmt = $this->con->prepare("SELECT * FROM `$table`");
        $this->pre_stmt->execute() or die($this->con>$this->con->error);
        $this->res = $this->pre_stmt->get_result();

        $rows = array();

        if($this->res->num_rows > 0)
        {
            while ($row = $this->res->fetch_assoc())
            {
                $rows[] = $row;
            }

            return $rows;
        }
        return "NO_DATA";

    }
}