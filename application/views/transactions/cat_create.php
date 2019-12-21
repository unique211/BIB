<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4">


            <form method="post" id="data_form" class="form-horizontal">

                <h5><?php echo $this->lang->line('New Transactions Category') ?></h5>
                <hr>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="catname"><?php echo $this->lang->line('Category Name') ?></label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Transactions Category Name"
                               class="form-control margin-bottom  required" name="catname">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="product_catname"><?php echo $this->lang->line('Category Type')  ?></label>

                    <fieldset>
                        <div class="col-sm-10">
                            <input type="radio" class="radio" checked  name="cat_type" value="Income" id="Income" />
                            <label for="y"><?php echo $this->lang->line('Income') ?></label>

                            <input style="margin-left:80px" type="radio" class="radio" name="cat_type" value="Expense" id="Expense" />
                            <label for="z"><?php echo $this->lang->line('Expense') ?></label>
                           
                        </div>
                    </fieldset>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                               value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">
                        <input type="hidden" value="transactions/save_createcat" id="action-url">
                    </div>
                </div>


            </form>
        </div>
    </div>
</article>

