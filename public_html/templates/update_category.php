<!-- Modal -->
<div class="modal fade" id="update_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_update_category" onsubmit="return false">
                    <div class="form-group">

                        <label for="category_name">Category Name</label>
                        <input type="hidden" name="cid"  id="cid">
                        <input type="text" class="form-control" id="update_category_name" name="update_category_name" placeholder="Enter category name">
                        <small id="cat_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="parent_category">Parent Category </label>
                        <select name="parent_category" id="parent_category" class="form-control">

                        </select>


                        <small id="par_error" class="form-text text-muted"></small>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>