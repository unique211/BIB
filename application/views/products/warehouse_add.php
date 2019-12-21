<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4">


            <form method="post" id="data_form" class="form-horizontal">

                <h3><?php echo $this->lang->line('Add New Product Warehouse') ?></h3>
                <hr>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="product_catname"><?php echo $this->lang->line('Name') ?></label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Product Warehouse Name"
                               class="form-control margin-bottom  required" name="product_catname">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="product_catname"><?php echo $this->lang->line('Description') ?></label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Product Warehouse Description"
                               class="form-control margin-bottom required" name="product_catdesc">
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
                            <input style="margin-left: 30px" type="radio" disabled class="radio" name="warehouse_type" value="z" id="z" />
                            <label style="margin-left: 10px" for="z">Virtual - TL</label>
                        </div>
                    </fieldset>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                               value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">
                        <input type="hidden" value="productcategory/addwarehouse" id="action-url">
                    </div>
                </div>


            </form>
        </div>
    </div>
</article>

