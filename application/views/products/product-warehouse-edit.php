<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <form method="post" id="data_form" class="form-horizontal">
            <div class="grid_3 grid_4">

                <h3>Edit Product warehouse</h3>
                <hr>


                <input type="hidden" name="catid" value="<?php echo $warehouse['id'] ?>">


                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="product_cat_name">Warehouse Name</label>

                    <div class="col-sm-8">
                        <input type="text"
                               class="form-control margin-bottom  required" name="product_cat_name"
                               value="<?php echo $warehouse['title'] ?>">
                    </div>
                </div>


                <div class="form-group row">

                    <label class="col-sm-2 col-form-label">Description</label>

                    <div class="col-sm-8">


                        <input type="text" name="product_cat_desc" class="form-control required"
                               aria-describedby="sizing-addon1" value="<?php echo $warehouse['extra'] ?>">

                    </div>

                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="product_catname"><?php echo $this->lang->line('Warehouse') ?></label>

                    <fieldset>
                        <div class="col-sm-8">
                            <input type="radio" class="radio" checked name="warehouse_type" value="y" id="y" />
                            <label style="margin-left: 10px" for="y"><?php echo $this->lang->line('Warehouse') ?></label>
                            <input style="margin-left: 30px" type="radio" class="radio" name="warehouse_type" value="z" id="z" />
                            <label for="z" style="margin-left: 10px"><?php echo $this->lang->line('Store') ?></label>
                            <input disabled="true" style="margin-left: 30px" type="radio" class="radio" name="warehouse_type" value="z" id="z" />
                            <label style="margin-left: 10px" for="z">Virtual - TL</label>
                        </div>
                    </fieldset>
                </div>


                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                               value="Update" data-loading-text="Updating...">
                        <input type="hidden" value="productcategory/editwarehouse" id="action-url">
                    </div>
                </div>

            </div>
        </form>
    </div>

</article>

