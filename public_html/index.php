<?php
include_once("./database/constants.php");
    if(isset($_SESSION["userid"]))
    {
        header("location:" .DOMAIN."/dashboard.php");
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Inventory Management System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/ccs/font-awesone.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script  src="./js/main.js" type="text/javascript" rel="stylesheet"></script>
    </head>
<body>
<div class="overlay">
    <div class="loader"></div>
</div>
    <?php include_once ("./templates/header.php");?>

    <div class="container" style="margin-top:20px;">

        <?php
            if(isset($_GET['msg']) && !empty(isset($_GET['msg'])))
            {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   <?php echo $_GET['msg']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <?php
            }
        ?>


            <div class="card mx-auto" style="width: 18rem;">
                <img class="card-img-top mx-auto" style = "width:60%;" src="./images/login.jpg" alt="Login Icon">
                <div class="card-body">
                    <form id="login_form"  onsubmit="return false" autocomplete="off">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="log_email" name="log_email"  placeholder="Enter email">
                            <small id="e_error" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="log_password" name="log_password" placeholder="Password">
                            <small id="p_error" class="form-text text-muted"></small>

                        </div>

                        <button type="submit" class="btn btn-primary"> <i class="fa fa-lock">&nbsp;</i> Sign In</button>

                        <span><a href="register.php">Sign Up</a></span>
                    </form>

                </div>
                <div class="card-footer"><a href="#">Forgot Password?</a></div>
            </div>
    </div>
</body>



</html>
