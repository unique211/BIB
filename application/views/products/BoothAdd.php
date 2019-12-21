<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4">


            <form method="post" id="data_form" class="form-horizontal">

                <h3><?php echo $this->lang->line('booth_detail') ?></h3>
                <hr>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="size"><?php echo $this->lang->line('Sizes') ?></label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Size"
                               class="form-control margin-bottom  required" name="size">
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="size"><?php echo $this->lang->line('Cost') ?></label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Cost"
                               class="form-control margin-bottom  required" name="cost">
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="size"><?php echo $this->lang->line('Description') ?></label>

                    <div class="col-sm-6">
                        <textarea class="form-control" name="description" placeholder="Description"></textarea>
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="size"><?php echo $this->lang->line('Products') ?></label>

                    <div class="col-sm-6">
                        <select class="form-control">
                            <option>Select Product</option>
                            <option>Product 1</option>
                            <option>Product 2</option>
                            <option>Product 3</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="size"><?php echo $this->lang->line('Team Leaders') ?></label>

                    <div class="col-sm-6">
                        <select class="form-control" multiple="">
                            <option><?php echo $this->lang->line('Team Leaders') ?></option>
                            <option>Leader 1</option>
                            <option>Leader 2</option>
                            <option>Leader 3</option>
                        </select>
                    </div>
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

