$(document).ready(function () {
    var  DOMAIN = "http://localhost/inv_project/public_html/";

    $("#add").click(function () {
        addNewRow();

    })

    function addNewRow() {
        $.ajax({
            url:DOMAIN + "/includes/process.php",
            method:"POST",
            data:{"getNewOrderIterm":1},
            success: function (data) {
                $("#invoice_item").append(data);
                var n = 0;

                $(".number").each(function () {
                    $(this).html(++n);
                })
            }
        })

    }

    $("#remove").click(function () {
        $("#invoice_item").children("tr:last").remove();
        calculate(0,0);
    })

    $("#invoice_item").delegate(".pid","change",function () {
        var pid = $(this).attr('pid').val();
        var tr = $(this).parent().parent();
        $(".overlay").show();
        $.ajax({
            url:DOMAIN + "/includes/process.php",
            method: "POST",
            dataType:"json",
            data:{'getPriceAndQty':1, 'id':pid},
            success:function (data) {
                tr.find(".product_price").val(data['product_price']);
                tr.find(".pro_name").val(data['product_name'])
                tr.find(".totalQty").val(data['product_stock']);
                tr.find(".qty").val(1);
                tr.find(".amt").html(tr.find(".product_price").val() * tr.find(".qty").val());
            }

        });


    })
    $("#invoice_item").delegate(".qty","keyup",function () {
        var qty = $(this);

        var tr = $(this).parent().parent();
        if(isNaN(qty.val()))
        {
            alert("Please enter a valid quantity");
        }
        else
        {
            if((qty.val() - 0) > (tr.find(".totalQty").val() - 0))
            {
                alert("Sorry! You are requesting more quantity than what we cab offer you at the moment")
            }
            else
            {
                tr.find(".amt").html(tr.find(".product_price").val() * tr.find(".qty").val());
                calculate(0,0);
            }

        }
    })

    $("#discount").keyup(function () {
        var discount = $(this).val();
        calculate(discount,0);
    })
    $("#paid").keyup(function () {
        var paid = $(this).val();
        var discount = $("#discount").val();
        calculate(discount,paid);
    })

    /*
    Order Processing
     */

    $("#order_form").click(function () {

        $.ajax({
            url:DOMAIN + "/includes/process.php",
            method: "POST",
            data:$("#order_data").serialize(),
            success:function (data) {
                $("#order_data").trigger("reset");
            }
        })
    })

    function calculate(discount,paid)
    {
        var sub_total = 0;
        var gst = 0;
        var net_total = 0;
        var due = 0;

        $(".amt").each(function () {
            sub_total += ($(this).html()*1);

        })
        gst = 0.15 * sub_total;
        net_total = + sub_total + gst  - discount;
        due = paid - net_total;
        $("#sub_total").val(sub_total);
        $("#gst").val(gst);
        $("#discount").val(discount);
        $("#net_total").val(net_total);
        $("#paid").val(paid);
        $("#due").val(due);

    }


    

})