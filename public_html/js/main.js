$(document).ready(function(){
    var DOMAIN = "http://localhost/inv_project/public_html";
    $("#register_form").on('submit',function () {

        var status = false;
        var name = $("#username");
        var email = $("#email");
        var pass1 = $("#password1");
        var pass2 = $("#password2");
        var type = $("#usertype");
        var n_pattern = new RegExp(/^[A-Za-z]+$/);
        var e_pattern = new  RegExp(/^[a-z0-9_-]+(\.[a-z0-9]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*([a-z]{2,4})$/);

        if(name.val().length < 6 || name.val() == "" ||n_pattern.test(name.val()))
        {

            name.addClass("border-danger");
            $('#u_error').html("<span class='text-danger'>Please enter full name and must be 6 or more 6 characters long</span>");
        }
        else
        {
            name.removeClass("border-danger");
            $('#u_error').html("<span class='text-danger'></span>");
            status = true;
        }

        if(!e_pattern.test(email.val()))
        {
            email.addClass("border-danger");
            $('#e_error').html("<span class='text-danger'>Please enter valid email</span>");
        }
        else
        {
            email.removeClass("border-danger");
            $('#e_error').html("<span class='text-danger'></span>");
            status = true;
        }

        if(pass1.val() == "" || pass1.val().length < 9)
        {
            pass1.addClass("border-danger");
            $('#p1_error').html("<span class='text-danger'>Please enter password 1</span>");
        }
        else
        {
            pass1.removeClass("border-danger");
            $('#p1_error').html("<span class='text-danger'></span>");
            status = true;
        }

        if(pass2.val() == "" || pass2.val().length < 9)
        {
            pass1.addClass("border-danger");
            $('#p2_error').html("<span class='text-danger'>Please enter password 2</span>");
        }
        else
        {
            pass2.removeClass("border-danger");
            $('#p2_error').html("<span class='text-danger'></span>");
            status = true;
        }

        if(type.val() == "")
        {
            type.addClass("border-danger");
            $('#ut_error').html("<span class='text-danger'>Please select user type</span>");
        }
        else
        {
            type.removeClass("border-danger");
            $('#ut_error').html("<span class='text-danger'></span>");
            status = true;
        }

        if(pass2.val() ==  pass1.val() && status == true)
        {
            pass2.removeClass("border-danger");
            $('#p2_error').html("<span class='text-danger'></span>");
            $(".overlay").show();
            $.ajax({
                url:DOMAIN+ "/includes/process.php",
                method: "POST",
                data: $("#register_form").serialize(),
                success:function(data)
                {
                    if(data == "Email_Already_Exists")
                    {
                        $(".overlay").hide();
                        alert("Email already already used");
                    }
                    else if (data =="SOME_ERROR")
                    {
                        $(".overlay").hide();
                        alert("Something went wrong");
                    }
                    else
                    {
                        $(".overlay").hide();
                        window.location.href = encodeURI(DOMAIN+"/index.php?msg=successfully signed up please sign in to continue");
                    }
                }

            });



        }
        else
        {
            pass1.addClass("border-danger");
            $('#p2_error').html("<span class='text-danger'>Please enter password 2</span>");

        }

    })
    $("#login_form").on('submit',function () {
        var email = $("#log_email");
        var pass = $("#log_password");
        var status = false;

        if(email.val() == "")
        {
            email.addClass("border-danger");
            $('#e_error').html("<span class='text-danger'>Please enter valid email</span>");
            status = false;
        }
        else
        {
            email.removeClass("border-danger");
            $('#e_error').html("<span class='text-danger'></span>");
            status = true;
        }

        if(pass.val() == "")
        {
            pass.addClass("border-danger");
            $('#p_error').html("<span class='text-danger'>Please enter password</span>");
            status = false;
        }
        else
        {
            pass.removeClass("border-danger");
            $('#p_error').html("<span class='text-danger'></span>");
            status = true;
        }

        if(status)
        {
            $.ajax({
                url:DOMAIN+ "/includes/process.php",
                method: "POST",
                data: $("#login_form").serialize(),
                success:function(data)
                {
                    if(data == "Not_registered")
                    {
                        $('#e_error').html("<span class='text-danger'>Not registered</span>");
                        status = false;
                    }
                    else if (data =="Invalid_username_password")
                    {//Invalid_username_password
                        $('#p_error').html("<span class='text-danger'>Invalid username/password</span>");
                        status = false;
                    }
                    else
                    {

                        window.location.href = encodeURI(DOMAIN+"/dashboard.php");
                    }
                }

            });
        }
    })


    $("#form_category").on('submit',function () {
        if($("#category_name").val() =="")
        {
            $("#category_name").addClass("border-danger");
            $('#cat_error').html("<span class='text-danger'>Please enter category name</span>");
        }
        else
        {
            $.ajax({
                url: DOMAIN+ "/includes/process.php",
                method: "POST",
                data: $("#form_category").serialize(),
                success:function(data)
                {
                  if(data == "CAT_ADDED")
                  {
                      $("#category_name").removeClass("border-danger");
                      $('#cat_error').html("<span class='text-success'>category added</span>");
                      $("#category_name").val('');
                      fetch_category();
                  }
                  else
                  {
                      alert(data);
                  }
                }

            });
        }

    })
    //add brand

    $("#form_brand").on('submit',function () {
        if($("#brand_name").val() =="")
        {
            $("#brand_name").addClass("border-danger");
            $('#brand_error').html("<span class='text-danger'>Please enter category name</span>");
        }
        else
        {
            $.ajax({
                url: DOMAIN+ "/includes/process.php",
                method: "POST",
                data: $("#form_brand").serialize(),
                success:function(data)
                {
                    if(data == "BRAND_ADDED")
                    {
                        $("#brand_name").removeClass("border-danger");
                        $('#brand_error').html("<span class='text-success'>Brand added</span>");
                        $("#brand_name").val('');
                        fetch_brand();
                    }
                    else
                    {
                        alert(data);
                    }
                }

            });
        }

    })

    $("#form_product").on('submit',function () {
         $.ajax({
                url: DOMAIN+ "/includes/process.php",
                method: "POST",
                data: $("#form_product").serialize(),
                success:function(data)
                {
                    if(data == "Product_ADDED")
                    {
                        $('#product_name').val("");
                        $('#product_price').val("");
                        $('#product_qty').val("");
                       alert("Product Added");
                    }
                    else
                    {
                        alert(data);
                    }
                }

            });


    })



    fetch_category();
    function fetch_category() {

        $.ajax({
            url: "http://localhost/inv_project/public_html/includes/process.php",
            method: "POST",
            data: {'getCategory':1},
            success:function(data)
            {
                var root = " <option value='0'>Root</option>";
                var choose = " <option value=''>Select Category</option>";
                $("#parent_category").html( root + data);
                $("#select_cat").html( choose + data);

            }

        });
        
    }
    fetch_brand();
    function fetch_brand() {

        $.ajax({
            url: "http://localhost/inv_project/public_html/includes/process.php",
            method: "POST",
            data: {'getBrand':1},
            success:function(data)
            {
                var root = " <option value=''>Select Brand</option>";

                $("#select_brand").html( root + data);


            }

        });

    }
    
});
