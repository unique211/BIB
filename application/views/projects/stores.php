<article class="content">

    <div class="card card-block">

        <div id="notify" class="alert alert-success" style="display:none;">

            <a href="#" class="close" data-dismiss="alert">&times;</a>



            <div class="message"></div>

        </div>

        <div class="grid_3 grid_4">

            <div class="header-block">

             



                <h3 class="title">

                   

                   <?php echo $this->lang->line('Store') ?> 

                   <?php if($this->aauth->get_user()->roleid==5){?>

                   <a href="<?php echo base_url('projects/addstore') ?>" class="btn btn-primary btn-sm rounded">



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

                                        <h3 class="pink" id="dash_0"></h3>

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

                                        <h3 class="indigo" id="dash_1"></h3>

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

                                        <h3 class="green" id="dash_2"></h3>

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



            <table id="storetable" class="display" cellspacing="0" width="100%">

                <thead>

                <tr>

                    <th>#</th>

                    <th><?php echo $this->lang->line('Name') ?></th>

                    <th><?php echo $this->lang->line('Classification') ?></th>

                    <th><?php echo $this->lang->line('Status') ?></th>

                    <th><?php echo $this->lang->line('Start Date') ?></th>

                    <th><?php echo $this->lang->line('Setup Date') ?></th>

                    <th><?php echo $this->lang->line('Quota') ?></th>

                    <th><?php echo $this->lang->line('Budget') ?></th>

                    <th><?php echo $this->lang->line('Actions') ?></th>





                </tr>

                </thead>

                <tbody>





                </tbody>



            </table>



        <?php }

        if($this->aauth->get_user()->roleid==3) { ?>

            <table id="ptltable" class="display" cellspacing="0" width="100%">

                <thead>

                <tr>

                    <th>#</th>



                    <th><?php echo $this->lang->line('Location') ?></th>

                    <th><?php echo $this->lang->line('Name') ?></th>

                    <th><?php echo $this->lang->line('Start Date') ?></th>

                    <th><?php echo $this->lang->line('End Date') ?></th>

                    <th><?php echo $this->lang->line('Status') ?></th>

                    <th><?php echo $this->lang->line('Assign') ?></th>

                     <th><?php echo $this->lang->line('Action') ?></th>





                </tr>

                </thead>

                <tbody>

                    <tr>

                    <td>1</td>

                    <td>Surat</td>

                    <td>Business Owner</td>

                    <td>11/11/1111</td>

                    <td>11/11/1111</td>

                    <td><span class="project_pending">pending</span></td>

                    <td>Not Assinged </td>

                     <td><a href="" class="btn btn-primary btn-sm rounded" data-id="" data-stat="0"> <?php echo $this->lang->line('View'); ?></a> <a href="" class="btn btn-success btn-sm rounded" data-id="'" data-stat="0"> <?php echo $this->lang->line('Apply'); ?></a></td>

                 </tr>

                 <tr>

                    <td>1</td>

                    <td>Surat</td>

                    <td>Business Owner</td>

                    <td>11/11/1111</td>

                    <td>11/11/1111</td>

                    <td><span class="project_pending" style="background-color: green">Running</span></td>

                    <td>This show is assigned to another Teamleader</td>

                     <td><a href="" class="btn btn-primary btn-sm rounded" data-id="" data-stat="0"> <?php echo $this->lang->line('View'); ?></a> </td>

                 </tr>

                </tbody>



            </table>



        <?php } ?>







        </div>

    </div>

    <input type="hidden" id="dashurl" value="projects/projects_stats">

</article>



<div id="delete_model_3" class="modal fade">
            <form id="mfrom_3">
    <div class="modal-dialog">
            
        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span

                            aria-hidden="true">&times;</span></button>

                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>

            </div>

            <div class="modal-body">

                <p><?php echo $this->lang->line('delete this project') ?> </p>

            </div>

            <div class="modal-footer">

                <input type="hidden" id="object-id_3" value=""  name="deleteid">

                <input type="hidden" id="action-url_3" value="projects/delete_i">

                <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm"

                id="delete-confirm_3"><?php echo $this->lang->line('Delete') ?></button>

                <button type="button" data-dismiss="modal"

                        class="btn"><?php echo $this->lang->line('Cancel') ?></button>

            </div>

        </div>
        </form>
    </div>


</div>

<div id="pop_model" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title"><?php echo $this->lang->line('Change Status'); ?></h4>

            </div>



            <div class="modal-body">

                <form id="form_model">





                    <div class="row">

                        <div class="col-xs-12 mb-1"><label

                                    for="status"><?php echo $this->lang->line('Change Status') ?></label>

                            <select name="stat" class="form-control mb-1">

                                <option value="Due">Due</option>

                                <option value="Progress">Progress</option>

                                <option value="Done">Done</option>

                            </select>



                        </div>

                    </div>



                    <div class="modal-footer">

                        <input type="hidden" class="form-control"

                               name="tid" id="taskid" value="">

                        <button type="button" class="btn btn-default"

                                data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>

                        <input type="hidden" id="action-url" value="tools/set_task">

                        <button type="button" class="btn btn-primary"

                                id="submit_model"><?php echo $this->lang->line('Change Status'); ?></button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<div id="task_model" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title" id="task_title"><?php echo $this->lang->line('Details'); ?></h4>

            </div>



            <div class="modal-body">

                <form id="form_model">





                    <div class="row">

                        <div class="col-xs-12 mb-1" id="description">



                        </div>

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-xs-12 mb-1"><?php echo $this->lang->line('Priority') ?> <strong><span

                                        id="priority"></span></strong>



                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12 mb-1"><?php echo $this->lang->line('Assigned to') ?> <strong><span

                                        id="employee"></span></strong>



                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12 mb-1"><?php echo $this->lang->line('Assigned by') ?> <strong><span

                                        id="assign"></span></strong>



                        </div>

                    </div>



                    <div class="modal-footer">

                        <input type="hidden" class="form-control required"

                               name="tid" id="taskid" value="">

                        <button type="button" class="btn btn-default"

                                data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>



                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">



    $(document).ready(function () {





          $('#ptltable').DataTable({});



        $('#storetable').DataTable({



            "processing": true,

            "serverSide": true,

            "stateSave": true,

            
            'createdRow': function (row, data, dataIndex) {
                    $(row).attr('data-block', '0');
                },

            "order": [[ 2, "asc" ]],

            "ajax": {

                "url": "<?php echo site_url('projects/project_load_list')?>",

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
        
        $(document).on('click', ".delete-custom", function (e) {


console.log('from here');
var id=$(this).attr('data-object-id');
$('#action-url_3').val("projects/delete_i/"+id);

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

        miniDash();

        $('input[type=radio][name=selection]').change(function() {
        if (this.value == 'new') {
        }
        });



    });



</script>