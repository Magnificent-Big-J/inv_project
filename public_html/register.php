<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/ccs/font-awesone.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script  src="./js/main.js"></script>
</head>
<body>
<?php include_once ("./templates/header.php");?>

    <div class="container" style="margin-top:20px;">
        <div class="container">
            <div class="card" style = "width: 30rem; margin:0 auto;">
                <div class="card-header">Sign Up</div>
                <div class="card-body">
                    <form  id="register_form"  onsubmit="return false" autocomplete="off">
                        <div class="form-group">
                            <label for="username">Full Name</label>
                            <input type="text" class="form-control" id="username" name="username"  placeholder="Enter Username">
                            <small id="u_error" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="text" class="form-control" id="email" name="email"  placeholder="Enter Email Address">
                            <small id="e_error" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="password1">Password</label>
                            <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                            <small id="p1_error" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="password2">Re-enter Password</label>
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Password">
                            <small id="p2_error" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="usertype">Usertype</label>
                            <select name="usertype" id="usertype" class = "form-control">
                                <option value="">Select UserType</option>
                                <option value="0">Admin</option>
                                <option value="1">Other</option>
                            </select>
                            <small id="ut_error" class="form-text text-muted"></small>
                        </div>
                        <button class="btn btn-primary" name = "user_register" type="submit" ><span class="fa fa-user"></span>&nbsp; Sign Up   </button>
                        <span><a href="index.php">Sign In</a></span>
                    </form>

                </div>
                <div class="card-footer text-muted">
                </div>

            </div>

        </div>

    </div>
</body>
</html>
