    <article class="content">

        <div class="card card-block">

            <div id="notify" class="alert alert-success" style="display:none;">

                <a href="#" class="close" data-dismiss="alert">&times;</a>



                <div class="message"></div>

            </div>

            <div class="grid_3 grid_4">

                <div class="header-block">

                 



                    <h3 class="title">

                       

                       <?php echo $this->lang->line('Show') ?> 

                       <?php if($this->aauth->get_user()->roleid==5){?>

                       <a href="<?php echo base_url('projects/showproject') ?>" class="btn btn-primary btn-sm rounded">



                            <?php 



                            echo $this->lang->line('Add new') 



                            ?>

                        </a>

                        <?php }?>

                    </h3>

                

                </div>

                <p>&nbsp;</p>

                 <?php if ($this->aauth->get_user()->roleid != 3) { ?>

                <div class="row">

                    <div class="col-xl-3 col-lg-6 col-xs-6">

                        <div class="card">

                            <div class="card-body">

                                <div class="card-block">

                                    <div class="media">

                                        <div class="media-body text-xs-left">

                                            <h3 class="pink" id="dash_0"><?php echo $waiting ?></h3>

                                            <span><?php echo $this->lang->line('Waiting') ?></span>

                                        </div>

                                        <div class="media-right media-middle">

                                            <i class="icon-clock3 pink font-large-2 float-xs-right"></i>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-3 col-lg-6 col-xs-6">

                        <div class="card">

                            <div class="card-body">

                                <div class="card-block">

                                    <div class="media">

                                        <div class="media-body text-xs-left">

                                            <h3 class="indigo" id="dash_1"><?php echo $progress ?></h3><!-- change by sagar $pending-->

                                            <span><?php echo $this->lang->line('Progress') ?></span>

                                        </div>

                                        <div class="media-right media-middle">

                                            <i class="icon-spinner5 indigo font-large-2 float-xs-right"></i>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-3 col-lg-6 col-xs-6">

                        <div class="card">

                            <div class="card-body">

                                <div class="card-block">

                                    <div class="media">

                                        <div class="media-body text-xs-left">

                                            <h3 class="green" id="dash_2"><?php echo $finished ?></h3>

                                            <span><?php echo $this->lang->line('Finished') ?></span>

                                        </div>

                                        <div class="media-right media-middle">

                                            <i class="icon-clipboard2 green font-large-2 float-xs-right"></i>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-3 col-lg-6 col-xs-6">

                        <div class="card">

                            <div class="card-body">

                                <div class="card-block">

                                    <div class="media">

                                        <div class="media-body text-xs-left">

                                            <h3 class="deep-cyan" id="dash_6"><?php echo $totalt ?></h3>

                                            <span><?php echo $this->lang->line('Total') ?></span>

                                        </div>

                                        <div class="media-right media-middle">

                                            <i class="icon-stats-bars22 deep-cyan font-large-2 float-xs-right"></i>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            <?php } ?>



                <?php if($this->aauth->get_user()->roleid==5) { ?>

               



                <table id="showtable" class="display" cellspacing="0" width="100%">

                    <thead>

                    <tr>

                        <th class="priority-1"><?php echo $this->lang->line('Show') ?>#</th>

                        <th class="priority-2"><?php echo $this->lang->line('Name') ?></th>

                        <th class="priority-3"><?php echo $this->lang->line('Status') ?></th>

                        <th class="priority-4"><?php echo $this->lang->line('Start Date') ?></th>

                        <th class="priority-5"><?php echo $this->lang->line('End Date') ?></th>

                        <th class="priority-6"><?php echo $this->lang->line('Tags') ?></th>

                        <th class="priority-7"><?php echo $this->lang->line('Quota') ?></th>

                        <th class="priority-8"><?php echo $this->lang->line('Budget') ?></th>

                        <th class="priority-9"><?php echo $this->lang->line('Actions') ?></th>





                    </tr>

                    </thead>

                    <tbody>

                        

                    </tbody>



                </table>



            <?php }

            if($this->aauth->get_user()->roleid==3) { ?>

                <table id="showtable" class="display" cellspacing="0" width="100%">

                    <thead>

                    <tr>

                        <th class="priority-1"><?php echo $this->lang->line('Show') ?>#</th>

                        <th class="priority-2"><?php echo $this->lang->line('Name') ?></th>

                        <th class="priority-3"><?php echo $this->lang->line('Status') ?></th>

                        <th class="priority-4"><?php echo $this->lang->line('End Date') ?></th>

                        <th class="priority-5"><?php echo $this->lang->line('Setup Date') ?></th>

                        <th class="priority-6"><?php echo $this->lang->line('Tags') ?></th>

                        <th class="priority-7"><?php echo $this->lang->line('Quota') ?></th>

                        <th class="priority-8"><?php echo $this->lang->line('Budget') ?></th>

                        <th class="priority-9"><?php echo $this->lang->line('Actions') ?></th>

                    </tr>

                    </thead>

                    <tbody>

                        

                    </tbody>



                </table>

            <?php } ?>







            </div>

        </div>

        <input type="hidden" id="dashurl" value="projects/projects_stats">



     

    </article>



     <!--dynamic delete -->

                <div id="delete_model_1" class="modal fade">

                    <form id="mform_1">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span

                                                aria-hidden="true">&times;</span></button>

                                    <h4 class="modal-title">Confirmation Message</h4>

                                    <br>

                                    <p>Are you sure want to apply request for this show ?</p>

                                </div>



                                <div class="modal-footer">

                                    <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">

                                    <input type="hidden" id="object-id_1" value="" name="object_id">

                                    <input type="hidden" id="action-url_1" value="projects/add_request_for_show">

                                    <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm"

                                            id="delete-confirm_1"><?php echo $this->lang->line('Apply') ?> </button>

                                    <button type="button" data-dismiss="modal"

                                            class="btn"><?php echo $this->lang->line('Cancel') ?></button>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

                <!--dynamic delete 2-->
                 <div id="delete_model_15" class="modal fade">

            <form id="mform_15">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span

                                        aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
                            <p>Are you sure want to delete show.all data releted this show will be deleted.</p>

                        </div>



                        <div class="modal-footer">



                            <input type="hidden" id="object-id_15" value="" name="deleteid">

                            <input type="hidden" id="action-url_15" value="projects/delete_show">

                            <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm"

                                    id="delete-confirm_15"><?php echo $this->lang->line('Delete') ?></button>

                            <button type="button" data-dismiss="modal"

                                    class="btn"><?php echo $this->lang->line('Cancel') ?></button>

                        </div>

                    </div>

                </div>

            </form>

        </div>






    <script type="text/javascript">



        $(document).ready(function () {





            $('#showtable').DataTable({

                "processing": true,

                "stateSave": true,
                
                'createdRow': function (row, data, dataIndex) {
                    $(row).attr('data-block', '0');
                },

                  "order": [[ 0, "asc" ]],

                "ajax": {

                    "url": "<?php echo site_url('projects/show_load_list')?>",

                    "type": "POST"

                },

                "columnDefs": [

                    {

                        "targets": [0],

                        "orderable": true,

                        "className": "priority-1",

                    },
                    {

                        "targets": [1],

                        "className": "priority-2",

                    },
                    {

                        "targets": [2],

                        "className": "priority-3",

                    },
                    {

                        "targets": [3],

                        "className": "priority-4",

                    },
                    {

                        "targets": [4],

                        "className": "priority-5",

                    },
                    {

                        "targets": [5],

                        "className": "priority-6",

                    },
                    {

                        "targets": [6],

                        "className": "priority-7",

                    },
                    {

                        "targets": [7],

                        "className": "priority-8",

                    },
                    {

                        "targets": [8],

                        "className": "priority-9",

                    },

                ],



            });



            $(document).on('click', ".set-task", function (e) {

                e.preventDefault();

                $('#taskid').val($(this).attr('data-id'));

                $('#pop_model').modal({backdrop: 'static', keyboard: false});



            });






            $(document).on('click', ".view_task", function (e) {

                e.preventDefault();



                var actionurl = 'projects/view_project';

                var id = $(this).attr('data-id');

                $('#task_model').modal({backdrop: 'static', keyboard: false});





                $.ajax({



                    url: baseurl + actionurl,

                    type: 'POST',

                    data: {'tid': id},

                    dataType: 'json',

                    success: function (data) {



                        $('#description').html(data.description);

                        $('#task_title').html(data.name);

                        $('#employee').html(data.employee);

                        $('#assign').html(data.assign);

                        $('#priority').html(data.priority);

                    }



                });



            });

         //   miniDash();





        });

        


    </script>
    <script type="text/javascript">
        
       

    </script>