<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4">
            <div class="row">
                <div class="col-md-6">
                
                            <h3><?php echo $this->lang->line('Notes') ?> by <?php echo $employee['name'] ?></h3>
                        </div>
                   <div class="col-md-6">    
                            <a style="float: right;" class="btn btn-primary"><b style="color:white">Add New</b></a>
                        </div>
             </div>           

            <hr>
            <table id="notes" class="display" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th><?php echo $this->lang->line('Note date') ?></th>
                    <th><?php echo $this->lang->line('Note Text') ?></th>
                    <th><?php echo $this->lang->line('Reminder Date') ?></th>
                    <th><?php echo $this->lang->line('Action') ?></th>
                </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                <tr>
                   <th>No</th>
                    <th><?php echo $this->lang->line('Note date') ?></th>
                    <th><?php echo $this->lang->line('Note Text') ?></th>
                    <th><?php echo $this->lang->line('Reminder Date') ?></th>
                    <th><?php echo $this->lang->line('Action') ?></th>

                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div id="delete_invoice" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo $this->lang->line('Delete Invoice') ?></h4>
                </div>
                <div class="modal-body">
                    <p><?php echo $this->lang->line('You can not revert') ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary"
                            id="delete"><?php echo $this->lang->line('Delete') ?></button>
                    <button type="button" data-dismiss="modal" class="btn">
                        ><?php echo $this->lang->line('Cancel') ?></button>
                </div>
            </div>
        </div>
    </div>
</article>
<script type="text/javascript">
    $(document).ready(function () {

         $('#notes').DataTable({});

    });
</script>