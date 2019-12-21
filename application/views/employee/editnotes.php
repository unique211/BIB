<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4">
            <div class="row">
                <div class="col-md-6">
                
                            <h3>Edit <?php echo $this->lang->line('Notes') ?> by <?php echo $employee['name'] ?></h3>
                        </div>
                   
             </div>           

            <hr>
              <form method="post"  class="form-horizontal">
                       <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="size"><?php echo $this->lang->line('Note date') ?></label>

                    <div class="col-sm-6">
                        <input type="date" placeholder="Size"
                               class="form-control margin-bottom  required" name="note_date">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="size"><?php echo $this->lang->line('Note Text') ?></label>

                    <div class="col-sm-6">
                        <textarea class="form-control" name="note_text" placeholder="Note Text"></textarea>
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="size"><?php echo $this->lang->line('Reminder Date') ?></label>

                    <div class="col-sm-6">
                        <input type="date" placeholder="Cost"
                               class="form-control margin-bottom  required" name="note_reminder">
                    </div>
                </div>
                                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-6">
                    <input type="submit"  class="btn btn-success margin-bottom" value="Edit"
                    ">
                </div>
                </div>
                
              </form>
        </div>
    </div>

</article>
