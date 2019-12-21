<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4">


            <form method="post" id="data_form" class="form-horizontal">

                <h5><?php echo $title ?></h5>
                <hr>

                <div class="form-group row">
					<input type="hidden" name="sizeid" value="<?php echo $size['p_size_id'] ?>">
                    <label class="col-sm-2 col-form-label" for="size">Size</label>

                    <div class="col-sm-10">
                        <input type="text" placeholder="Size"
                               class="form-control margin-bottom  required" name="size" value="<?php echo $size['name'] ?>">
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                               value="Update" data-loading-text="Adding...">
                        <input type="hidden" value="productcategory/editproductsize" id="action-url">
                    </div>
                </div>


            </form>
        </div>
    </div>
	
</article>

