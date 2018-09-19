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
    <script  src="./js/main.js"></script>
</head>
<body>
<?php include_once ("./templates/header.php");?>

    <div class="container" style="margin-top:20px;">
        <div class="row">
            <div class="col-md-4">

                <div class="card" >
                    <img class="card-img-top mx-auto" style = "width:60%;" src="./images/user.jpg" alt="Card image cap">
                    <div class="card-body mx-auto">
                        <h5 class="card-title">Profile Info</h5>
                        <p class="card-text"> <i class="fa fa-user">&nbsp;</i>  King Mnisi</p>
                        <p class="card-text"><i class="fa fa-user">&nbsp;</i>Admin</p>
                        <p class="card-text"><i class="fa fa-clock-o">&nbsp;</i>Last Sign In: xxxx-xx-xx</p>
                         <a href="#" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>  Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="jumbotron" style="width:100%; height:100%;">
                    <h1>Welcome back,Admin</h1>
                    <div class="row">
                        <div class="col-sm-6">
                            <iframe src="http://free.timeanddate.com/clock/i64vf969/n111/szw160/szh160/cf100/hnce1ead6" frameborder="0" width="160" height="160"></iframe>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">New Orders</h5>
                                    <p class="card-text">Here you can make invoices and create new orders</p>
                                    <a href="new_order.php" class="btn btn-primary">New Orders</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="container" style="margin-top:20px;">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title">Manage Categories</h5>
                            <p class="card-text">Here you can manage your categories  and add new parent and sub categories</p>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#category">Add </a>
                            <a href="manage_categories.php" class="btn btn-primary">Manage </a>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title">Manage Brands</h5>
                            <p class="card-text">Here you can manage your brands  and add new brands</p>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#brand">Add </a>
                            <a href="manage_brand.php" class="btn btn-primary">Manage </a>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title">Manage Products</h5>
                            <p class="card-text">Here you can manage your products  and add new products</p>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#product">Add </a>
                            <a href="manage_product.php" class="btn btn-primary">Manage </a>
                        </div>
                    </div>
                </div>
            </div>

    </div>


<?php
    include_once ("templates/category.php");
    include_once ("templates/brand.php");
    include_once ("templates/product.php")
?>

</body>



</html>
