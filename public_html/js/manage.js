$(document).ready(function () {
    var  DOMAIN = "http://localhost/inv_project/public_html/";
    //manage categories
    manageCategories(1);
    function manageCategories(pn) {
        $.ajax({
            url: "http://localhost/inv_project/public_html/includes/process.php",
            method: "POST",
            data: {'ManageCategory':1,'pageno':pn},
            success:function(data)
            {
                $('#get_category').html(data);
            }

        });

    }
    //manage brand
    manageBrand(1);
    function manageBrand(pn) {
        $.ajax({
            url: "http://localhost/inv_project/public_html/includes/process.php",
            method: "POST",
            data: {'ManageBrand':1,'pageno':pn},
            success:function(data)
            {
                $('#get_brand').html(data);
            }

        });

    }




    $("body").delegate(".page-link","click",function () {

        var pn = $(this).attr("pn");
        manageCategories(pn);

    })

    //brand

    $("body").delegate(".page-link","click",function () {

        var pn = $(this).attr("pn");
        manageBrand(pn);

    })


    $("body").delegate(".del_cat","click",function () {
        var did = $(this).attr("did");
        if(confirm("Are you sure you want to delete?"))
        {
            $.ajax({
                url: "http://localhost/inv_project/public_html/includes/process.php",
                method: "POST",
                data: {'deleteCategory':1,'id':did},
                success:function(data)
                {
                    if(data == "DEPENDENT_CATEGORY")
                    {
                        alert("Sorry! This dependent is a parent of some other categories");
                    }
                    else if(data == "CATEGORY_DELETED")
                    {
                        alert("Category successfully deleted");
                    }
                    else if(data == "DELETED")
                    {
                        alert("Successfully deleted");
                    }
                    else
                    {
                        alert(data);
                    }
                }

            });
        }
        else
        {

        }

    })
    $("body").delegate(".edit_cat","click",function () {
        var eid = $(this).attr("eid");

        $.ajax({
            url: "http://localhost/inv_project/public_html/includes/process.php",
            method: "POST",
            dataType:"json",
            data: {'updateCategory':1,'id':eid},
            success:function(data)
            {
                //alert(data);
                console.log(data);
                $("#cid").val(data["cat_id"]);
                $("#update_category_name").val(data["category_name"]);
                $("#parent_category").val(data["pararent_id"]);
            }

        });


    })

    $("#form_update_category").on("submit", function () {
        if($("#update_category_name").val() =="")
        {
            $("#update_category_name").addClass("border-danger");
            $('#cat_error').html("<span class='text-danger'>Please enter category name</span>");
        }
        else
        {
            $.ajax({
                url: DOMAIN+ "/includes/process.php",
                method: "POST",
                data: $("#form_update_category").serialize(),
                success:function(data)
                {
                    window.location.href = "";
                }

            });
        }
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

                $("#select_cat").html( root + data);

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

    //Delete Brand
    $("body").delegate(".del_brand","click",function (e) {
        e.preventDefault();
        var did = $(this).attr("did");
             console.log(did);
        if(confirm("Are you sure you want to delete the brand?"))
        {
            $.ajax({
                url: "http://localhost/inv_project/public_html/includes/process.php",
                method: "POST",
                data: {'deleteBrand':1,'id':did},
                success:function(data)
                {

                     if(data == "DELETED")
                    {
                        alert("Brand is successfully deleted");
                    }
                    else
                    {
                        alert(data);
                    }
                }

            });
        }


    })

    //update brand record

    $("#form_brand_update").on("submit", function () {

            $.ajax({
                url: DOMAIN+ "/includes/process.php",
                method: "POST",
                data: $("#form_brand_update").serialize(),
                success:function(data)
                {
                    window.location.href = "";


                }

            });

    })

    //brand update data

    $("body").delegate(".edit_brand","click",function () {
        var eid = $(this).attr("eid");

        $.ajax({
            url: "http://localhost/inv_project/public_html/includes/process.php",
            method: "POST",
            dataType:"json",
            data: {'updateBrand':1,'id':eid},
            success:function(data)
            {
                //alert(data);
                console.log(data);
                $("#brand_id").val(data["brand_id"]);
                $("#update_brand_name").val(data["brand_name"]);

            }

        });


    })


    manageProduct(1);
    function manageProduct(pn) {
        $.ajax({
            url: "http://localhost/inv_project/public_html/includes/process.php",
            method: "POST",
            data: {'ManageProduct':1,'pageno':pn},
            success:function(data)
            {
                $('#get_product').html(data);
            }

        });

    }

    //Delete Product
    $("body").delegate(".page-link","click",function () {

        var pn = $(this).attr("pn");
        manageProduct(pn);

    })


    $("body").delegate(".del_product","click",function () {
        var did = $(this).attr("did");
        if(confirm("Are you sure you want to delete?"))
        {
            $.ajax({
                url: "http://localhost/inv_project/public_html/includes/process.php",
                method: "POST",
                data: {'deleteProduct':1,'id':did},
                success:function(data)
                {
                    if(data == "DELETED")
                    {
                        alert("Product is successfully deleted");
                    }
                    else
                    {
                        alert(data);
                    }
                }

            });
        }
        else
        {

        }

    })


    //update product

    $("body").delegate(".edit_product","click",function () {
        var eid = $(this).attr("eid");
             $.ajax({
            url: "http://localhost/inv_project/public_html/includes/process.php",
            method: "POST",
            dataType:"json",
            data: {'updateProduct':1,'id':eid},
            success:function(data)
            {


                console.log(data);
                $("#pid").val(data["pid"]);
                $("#update_product_name").val(data["product_name"]);
                $("#select_cat").val(data["cid"]);
                $("#product_qty").val(data["product_stock"]);
                $("#select_brand").val(data["bid"]);
                $("#date_added").val(data["added_date"]);
                $("#product_price").val(data["product_price"]);

            }

        });


    })

    $("#form_product_update").on("submit", function () {

        $.ajax({
            url: DOMAIN+ "/includes/process.php",
            method: "POST",
            data: $("#form_product_update").serialize(),
            success:function(data)
            {


                window.location.href = "";


            }

        });

    })


})