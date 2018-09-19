<?php
include_once("../database/constants.php");
include_once("../includes/DBOperation.php");
include_once ('User.php');
include_once ("../includes/Manage.php");

if(isset($_POST['username']) && isset($_POST['email']))
{
    $user = new User();
    $res = $user->createUserAccount($_POST['username'],$_POST['email'],$_POST['password1'],$_POST['usertype']);
    echo $res;
    exit();
}

//Login

if(isset($_POST['log_email']) && isset($_POST['log_password']))
{
    $user = new User();
    $res =  $user->userLogin($_POST['log_email'],$_POST['log_password']);
    echo $res;
    exit();
}

//Category

if(isset($_POST['getCategory']))
{
    $obj = new DBOperation();
    $rows = $obj->getAllRecord("categories");
   if(!empty($rows)) {
       foreach ($rows as $row) {
           $par_cat = $row['cat_id'];
           $cat_name = $row['category_name'];
           echo "<option value=\"$par_cat\">$cat_name</option>";
       }
   }
    exit();
}

//add category

if(isset($_POST['category_name']) && isset($_POST['parent_category']))
{
    $obj = new DBOperation();
    $res = $obj->addCategody($_POST['parent_category'],$_POST['category_name']);
    echo $res;
    exit();
}
//add brand

if(isset($_POST['brand_name']) )
{
    $obj = new DBOperation();
    $res = $obj->addBrand($_POST['brand_name']);
    echo $res;
    exit();
}

//get Brands

if(isset($_POST['getBrand']))
{
    $obj = new DBOperation();
    $rows = $obj->getAllRecord("brands");
    if(!empty($rows)) {
        foreach ($rows as $row) {
            $brand_id = $row['brand_id'];
            $brand_name = $row['brand_name'];
            echo "<option value=\"$brand_id\">$brand_name</option>";
        }
    }
    exit();
}
//Add products
if(isset($_POST['product_name']) && isset($_POST['date_added']) && isset($_POST['select_cat'])&& isset($_POST['select_brand'])&& isset($_POST['product_price']) && isset($_POST['product_qty']))
{
    //($cid, $bid, $product_name,$date, $qty, $price)
    $obj = new DBOperation();
    $res = $obj->addProduct($_POST['select_cat'],$_POST['select_brand'],$_POST['product_name'],$_POST['date_added'],$_POST['product_qty'],$_POST['product_price']);
    echo $res;
    //echo $_POST['select_cat'];
    exit();
}
//Manage Categories
if(isset($_POST['ManageCategory']))
{
    $obj = new Manage();
    $res = $obj->manageRecordWithPagination("`categories`",$_POST['pageno']);
    $rows = $res['rows'];
    $pagination =  $res['pagination'];
    $n = ($_POST['pageno'] - 1) * 4;
    if(count($rows))
    {
        foreach ($rows as $row)
        {

            ?>
            <tr>
                <td><?php echo ++$n; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['parent']; ?></td>
                <td><a href="" class="btn btn-success btn-sm"><?php  if($row['status']==1){echo "Active";}else{echo "Not Active";}; ?></a></td>
                <td>
                    <a href="" did ='<?php echo $row['cat_id']; ?>' class="btn btn-danger btn-sm del_cat">Delete</a>
                    <a href="" eid ='<?php echo $row['cat_id']; ?>' class="btn btn-info btn-sm edit_cat" data-toggle="modal" data-target="#update_category">Edit</a>
                </td>
            </tr>

            <?php
        }

        ?>
        <tr>
            <td colspan="5"><?php echo $pagination; ?></td>
        </tr>
<?php


        exit();
    }


}

//Delete categories

    if(isset($_POST['deleteCategory']))
    {
        $obj = new Manage();
        $res = $obj->deleteRecord("`categories`","`cat_id`",$_POST['id']);
        echo $res;

        exit();

    }

    //update category

    if(isset($_POST['updateCategory']))
    {
        $obj = new Manage();
        $res = $obj->getSingleRecord("`categories`","`cat_id`",$_POST['id']);
        echo json_encode($res);
        exit();
    }
//update record

    if(isset($_POST['update_category_name']))
    {
        $obj = new Manage();
        $id = $_POST['cid'];
        $name = $_POST['update_category_name'];
        $parent_category = $_POST['parent_category'];


        $res = $obj->update_record("`categories`",["`cat_id`"=>$id],[" `pararent_id`"=>$parent_category,"`category_name`"=>$name,"`status`"=>1]);
        echo $res;
        exit();
    }

//Manage Categories
if(isset($_POST['ManageBrand']))
{
    $obj = new Manage();
    $res = $obj->manageRecordWithPagination("`brands`",$_POST['pageno']);
    $rows = $res['rows'];
    $pagination =  $res['pagination'];
    $n = ($_POST['pageno'] - 1) * 4;
    if(count($rows))
    {
        foreach ($rows as $row)
        {

            ?>
            <tr>
                <td><?php echo ++$n; ?></td>
                <td><?php echo $row['brand_name']; ?></td>
                <td><a href="" class="btn btn-success btn-sm"><?php  if($row['status']==1){echo "Active";}else{echo "Not Active";}; ?></a></td>
                <td>
                    <a href="" did ='<?php echo $row['brand_id']; ?>' class="btn btn-danger btn-sm del_brand">Delete</a>
                    <a href="" eid ='<?php echo $row['brand_id']; ?>' class="btn btn-info btn-sm edit_brand" data-toggle="modal" data-target="#update_brand">Edit</a>
                </td>
            </tr>

            <?php
        }

        ?>
        <tr>
            <td colspan="5"><?php echo $pagination; ?></td>
        </tr>
        <?php


        exit();
    }



}

//Delete brand

if(isset($_POST['deleteBrand']))
{
    $obj = new Manage();
    $res = $obj->deleteRecord("`brands`","`brand_id`",$_POST['id']);
    echo $res;
    //echo "SHIT";
    exit();

}

//update record

if(isset($_POST['update_brand_name']))
{
    $obj = new Manage();
    $id = $_POST['brand_id'];
    $name = $_POST['update_brand_name'];

    $res = $obj->update_record("`brands`",["`brand_id`"=>$id],["`brand_name`"=>$name,"`status`"=>1]);
    echo $res;
    exit();
}

//update category

if(isset($_POST['updateBrand']))
{
    $obj = new Manage();
    $res = $obj->getSingleRecord("`brands`","`brand_id`",$_POST['id']);
    echo json_encode($res);
    exit();
}

//ManageProduct

//Manage Categories
if(isset($_POST['ManageProduct']))
{
    $obj = new Manage();
    $res = $obj->manageRecordWithPagination("`products`",$_POST['pageno']);
    $rows = $res['rows'];
    $pagination =  $res['pagination'];
    $n = ($_POST['pageno'] - 1) * 4;
    if(count($rows))
    {
        //p.product_name, c.category_name, b.brand_name,p.product_price,p.product_stock,p.added_date,p.product_status
        foreach ($rows as $row)
        {

            ?>
            <tr>
                <td><?php echo ++$n; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td><?php echo $row['brand_name']; ?></td>
                <td><?php echo $row['product_stock']; ?></td>
                <td><?php echo $row['added_date']; ?></td>
                <td><a href="" class="btn btn-success btn-sm"><?php  if($row['product_status']==1){echo "Active";}else{echo "Not Active";}; ?></a></td>
                <td>
                    <a href="" did ='<?php echo $row['pid']; ?>' class="btn btn-danger btn-sm del_product">Delete</a>
                    <a href="" eid ='<?php echo $row['pid']; ?>' class="btn btn-info btn-sm edit_product" data-toggle="modal" data-target="#update_product">Edit</a>
                </td>
            </tr>

            <?php
        }

        ?>
        <tr>
            <td colspan="8"><?php echo $pagination; ?></td>
        </tr>
        <?php


        exit();
    }


}

//Delete Product deleteProduct
if(isset($_POST['deleteProduct']))
{
    $obj = new Manage();
    $res = $obj->deleteRecord("`products`","`pid`",$_POST['id']);
    echo $res;
    //echo "SHIT";
    exit();

}

//Update Product

if(isset($_POST['updateProduct']))
{
    $obj = new Manage();
    $res = $obj->getSingleRecord("`products`","`pid`",$_POST['id']);
    echo json_encode($res);
    //echo json_encode("data");
    exit();
}

//Update product record
if(isset($_POST['update_product_name']))
{
    $obj = new Manage();
    $id = $_POST['pid'];
    $name = $_POST['update_product_name'];
    $category = $_POST['select_cat'];
    $qty = $_POST['product_qty'];
    $brand = $_POST['select_brand'];
    $product_price = $_POST['product_price'];


    $res = $obj->update_record("`products`",["`pid`"=>$id],["`cid`"=>$category,"`product_name`"=>$name,"`bid`"=>$brand,"`product_stock`"=>$qty,"`product_price`"=>$product_price,"`product_status`"=>1]);
    echo $res;

    exit();
}

//------------------------------Invoice-----------------------------------------

    if(isset($_POST['getNewOrderIterm']))
    {
        $obj = new DBOperation();
        $rows = $obj->getAllRecord("products");
        ?>
    <tr>
                  <td><b id='number'>1</b></td>
                  <td>
                     <select name='pid' class='form-control  form-control-sm pid'  required>
                      <option value="">Select Product</option>
                      <?php
                        foreach ($rows as $row)
                        {
                      ?>
                        <option value="<?php echo $row['pid'] ?>"><?php echo $row['product_name'] ?></option>
                      <?php
                        }
                      ?>
                     </select>
                  </td>
                  <td>
                     <input type='text' class='form-control  form-control-sm totalQty' name='totalQty[]' readonly>
                  </td>
                  <td>
                      <input type='text' class='form-control  form-control-sm pro_qty' name='qty[]' required>
                  </td>
                  <td>
                     <span> <input type='text' class='form-control  form-control-sm pro_price' name='price[]' readonly></span>
                  </td>
                <td>
                    <input type='hidden'  name='pro_name[]' class ='pro_name' readonly>
                </td>
                  <td>
                     R <span class='amt'>0</span>
                  </td>
              </tr>
    <?php
        exit();
    }


//-------------------------------------Get price--------------

if(isset($_POST['getPriceAndQty']))
{
    $obj = new Manage();
    $rows = $obj->getSingleRecord("`products`","`pid`",$_POST['id']);
    echo json_encode($rows);
    exit();
}


if(isset($_POST['order_date']) && isset($_POST['customer_name']))
{
    $order_date = $_POST['order_date'];
    $customer_name = $_POST['customer_name'];

    //Now getting array from order form
    $totalQty = $_POST['totalQty'];
    $qty = $_POST['qty'];
    $pro_price = $_POST['pro_price'];
    $pro_name = $_POST['pro_name'];



    $sub_total = $_POST['sub_total'];
    $gst = $_POST['gst'];
    $net_total = $_POST['net_total'];
    $discount = $_POST['discount'];
    $paid = $_POST['paid'];
    $due = $_POST['due'];
    $payment = $_POST['payment'];
    $obj = new Manage();

    $res = $obj->storeCustomerInvoice($order_date,$customer_name,$totalQty,$qty,$pro_price,$pro_name,$sub_total,$gst,$net_total,$discount,$paid,$due,$payment);
    echo $res;
    exit();
}




    ?>

