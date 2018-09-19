<?php
include_once("./database/constants.php");
if(!isset($_SESSION["userid"]))
{
    header("location:" .DOMAIN."/");
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script  src="./js/order.js"></script>
</head>
<body>
<?php include_once ("./templates/header.php");?>

<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card" style="box-shadow: 0 0 25px 0 lightgrey">
                <h5 class="card-header">New Orders</h5>
                <div class="card-body">
                    <form onsubmit="return false" id="order_data">
                        <div class="form-group">
                            <label for="" class="col-sm-3">Order Date</label>
                            <div class="col-sm-6">
                                <input type="text" name="order_date" id="order_date" class="form-control form-control-sm"    value="<?php echo date("Y-m-d") ?>" readonly>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3">Customer Name</label>
                            <div class="col-sm-6">
                                <input type="text" name="customer_name" id="customer_name" class="form-control form-control-sm"    >

                            </div>
                        </div>
                        <div class="card" style="box-shadow: 0 0 15px 0 lightgrey">
                            <div class="card-body">
                                <h3>Make order list</h3>

                                <table align="center" style="width: 800px">
                                    <thead>
                                        <th>#</th>
                                        <th style="text-align: center">Item Name</th>
                                        <th style="text-align: center">Total Quantity</th>
                                        <th style="text-align: center">Quantity</th>
                                        <th style="text-align: center">Price</th>
                                        <th style="text-align: center">Total</th>
                                    </thead>
                                    <tbody id="invoice_item">


                                    </tbody>


                                </table>
                                <center style="padding: 10px;">
                                    <button id="add" style="width: 150px" class="btn btn-success">Add</button>
                                    <button id="remove" style="width: 150px" class="btn btn-danger">Delete</button>
                                </center>

                            </div>
                            <!--Card body ends -->

                        </div>
                        <p></p>
                        <div class="form-group">
                            <label for="" class="col-sm-3">Sub Total</label>
                            <div class="col-sm-6">
                                <input type="text" name="sub_total" id="sub_total" class="form-control form-control-sm" readonly>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3">GST (18%)</label>
                            <div class="col-sm-6">
                                <input type="text" name="gst" id="gst" class="form-control form-control-sm"    readonly>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3">Discount</label>
                            <div class="col-sm-6">
                                <input type="text" name="discount" id="discount" class="form-control form-control-sm"  required  >

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3">Net Total</label>
                            <div class="col-sm-6">
                                <input type="text" name="net_total" id="net_total" class="form-control form-control-sm"    readonly>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3">Paid</label>
                            <div class="col-sm-6">
                                <input type="text" name="paid" id="paid" class="form-control form-control-sm"    readonly>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class="col-sm-3">Due</label>
                            <div class="col-sm-6">
                                <input type="text" name="due" id="due" class="form-control form-control-sm"   required >

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3">Payment</label>
                            <div class="col-sm-6">
                                <select name="payment" class="form-control  form-control-sm" id="" required>
                                    <option>Cash</option>
                                    <option>Card</option>
                                    <option>Draft</option>
                                    <option>Cheque</option>
                                </select>

                            </div>
                        </div>
                        <center>
                            <input type="submit" id="order_form" style="width: 150px;" class="btn btn-success" value="Order">
                            <input type="submit" id="print_invoice" style="width: 150px;" class="btn btn-success d-none" value="Print Invoice">

                        </center>

                    </form>
                </div>
            </div>

        </div>

    </div>


</div>

</body>



</html>
