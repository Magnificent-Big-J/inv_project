<!-- Modal -->
<div class="modal fade" id="product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_product" onsubmit="return false">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
                            <small id="proName_error" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date_added">Date Added</label>
                            <input type="text" class="form-control" id="date_added" name="date_added" value="<?php echo date("Y-m-d") ?>" readonly>
                            <small id="date_error" class="form-text text-muted"></small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="select_cat">Category</label>
                            <select  id="select_cat" class="form-control" name = "select_cat" required>

                            </select>
                            <small id="cat_error" class="form-text text-muted"></small>
                        </div>

                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="select_brand">Brand</label>
                            <select  id="select_brand" class="form-control" name = "select_brand" required>

                            </select>
                            <small id="brand_error" class="form-text text-muted"></small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="product_price">Product Price</label>
                            <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter product price">
                            <small id="proPrice_error" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="product_qty">Product Quantity</label>
                            <input type="text" class="form-control" id="product_qty" name="product_qty" placeholder="Enter Quantity">
                            <small id="proQty_error" class="form-text text-muted"></small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>