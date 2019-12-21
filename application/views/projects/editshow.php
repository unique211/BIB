<link href="<?php echo base_url(); ?>assets/portcss/bootstrap-colorpicker.min.css" rel="stylesheet"/>

<script src='<?php echo base_url(); ?>assets/portjs/moment.min.js'></script>

<script src="<?php echo base_url(); ?>assets/portjs/fullcalendar.min.js"></script>

<script src='<?php echo base_url(); ?>assets/portjs/bootstrap-colorpicker.min.js'></script>

<script src='<?php echo base_url('assets/portjs/main.js') . APPVER; ?>'></script>



<article class="content">

    <div class="card card-block">

        <div id="notify" class="alert alert-success" style="display:none;">

            <a href="#" class="close" data-dismiss="alert">&times;</a>



            <div class="message"></div>

        </div>

        <div class="grid_3 grid_4">





            <form method="post" id="data_form" class="form-horizontal">

                <h3><?php echo $this->lang->line('Add') ?></h3>



                <hr>

                <div class="form-group row">



                    <label class="col-sm-2 col-form-label"

                           for="show_id"><h4><?php echo $this->lang->line('Show') ?>#<i style="color:red">*</i></h4></label>



                    <div class="col-sm-4">

                        <input type="text"

                               class="form-control margin-bottom  required" value="<?php echo $project['show_id']; ?>" name="show_id">

                    </div>


                    <!-- location  start -->
                    <label class="col-sm-2 col-form-label" for="show_id">
                        <h4><?php echo $this->lang->line('Location') ?>#</h4>
                    </label>



                    <div class="col-sm-4">

                        <!-- <input type="text" class="form-control margin-bottom  required" id="show_id" name="show_id"> -->
                        <select name="location" class="form-control">
                          
                            <?php
                             echo "<option value='0' selected>N/A</option>";
                                foreach ($locations as $key => $value) {
                                   
                                     if($value['id'] == $project['location_id'])
                                    echo "<option value='".$value['id']."' selected>".$value['name']."</option>";
                                    else
                                   echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                }
                                if($project['location_id']=='0')
                                echo "<option value='0' selected>N/A</option>";
                            ?>

                        </select>

                    </div>
                    <!-- location  end -->

                </div>

                <div class="form-group row">



                    <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Name') ?><i style="color:red">*</i></label>



                    <div class="col-sm-10">

                        <input type="text" placeholder="Project Title"

                               class="form-control margin-bottom  required" value="<?php echo $project['show_name']; ?>" name="name">

                    </div>

                </div>



                <div class="form-group row">



                    <label class="col-sm-2 col-form-label" for="status"><?php echo $this->lang->line('Status') ?><i style="color:red">*</i></label>



                    <div class="col-sm-4">

                        <select name="status" class="form-control required">

                            <option value='Waiting' <?php if($project['show_status']=='Waiting'){ echo 'selected'; } ?> ><?php echo $this->lang->line('Waiting'); ?></option>
                            
                            <option value='Pending' <?php if($project['show_status']=='Pending'){ echo 'selected'; } ?> > <?php echo $this->lang->line('Pending'); ?></option>

                            <option value='Terminated' <?php if($project['show_status']=='Terminated'){ echo 'selected'; } ?> > <?php echo $this->lang->line('Terminated'); ?></option>

                            <option value='Finished' <?php if($project['show_status']=='Finished'){ echo 'selected'; } ?> > <?php echo $this->lang->line('Finished'); ?></option>

                            <option value='Progress' <?php if($project['show_status']=='Progress'){ echo 'selected'; } ?> > <?php echo $this->lang->line('Progress'); ?></option>

                        </select>

                    </div>

                    <label class="col-sm-2 col-form-label" for="attendance"><?php echo $this->lang->line('Attendance') ?><i style="color:red">*</i></label>



                    <div class="col-sm-4">

                       <input type="number" min="0" value="<?php echo $project['show_attendence']; ?>" placeholder="Attendance" class="form-control required" id="attendance" name="attendance">

                    </div>

                </div>

                <div class="form-group row">



                    <label class="col-sm-2 col-form-label" for="budget"><?php echo $this->lang->line('Budget') ?><i style="color:red">*</i></label>



                    <div class="col-sm-4">

                        <input type="number" min="0" placeholder="Budget" value="<?php echo $project['show_budget']; ?>" class="form-control margin-bottom  required" name="budget">

                    </div>



                    <label class="col-sm-2 col-form-label" for="quota"><?php echo $this->lang->line('Quota') ?><i style="color:red">*</i></label>



                    <div class="col-sm-4">

                        <input type="number" min="0" placeholder="quota"

                               class="form-control margin-bottom required" value="<?php echo $project['show_quota']; ?>" name="quota">

                    </div>

                </div>



                <div class="form-group row">



                    <label class="col-sm-2 col-form-label"

                           for="employee"><?php echo $this->lang->line('Assign to') ?></label>



                    <div class="col-sm-8">

                        <select name="employee[]" class="form-control  select-box required" multiple="multiple">

                           <?php

                            foreach ($emp as $row) {

                                $cid = $row['id'];

                                $title = $row['name'];

                                $teamleader=array();

                                 $teamleader=explode(",",$show_emp);

                                    foreach($teamleader as $t)
                                    {
                                        if($cid==$t)
                                        {
                                             echo "<option  selected value='$cid'>$title</option>";
                                        }
                                        else
                                        {
                                             echo "<option value='$cid'>$title</option>";
                                        }
                                    }

                               

                            }

                            ?> 

                        </select>





                    </div>

                </div>



                <div class="form-group row">



                    <label class="col-sm-2 control-label"

                           for="sdate"><?php echo $this->lang->line('Start Date') ?><i style="color:red">*</i></label>



                    <div class="col-sm-3">

                        <input type="text" value="<?php echo $project['show_sdate']; ?>" class="form-control required"

                               placeholder="Start Date" name="sdate" id="start_date"

                               data-toggle="datepicker" autocomplete="false">

                    </div>

                    <div class="col-sm-1"></div>



                    <label class="col-sm-2 control-label"

                           for="setupdate"><?php echo $this->lang->line('Setup Date') ?><i style="color:red">*</i></label>



                    <div class="col-sm-3">

                        <input type="text"  value="<?php echo $project['show_setup_date']; ?>" class="form-control required" id="setup_date"

                               placeholder="Setup Date" name="setupdate"  data-toggle="datepicker" autocomplete="false" 

                              >

                    </div>

                </div>



                <div class="form-group row">



                    <label class="col-sm-2 control-label"

                           for="edate"><?php echo $this->lang->line('End Date') ?><i style="color:red">*</i></label>



                    <div class="col-sm-3">

                        <input type="text" value="2019-07-08" class="form-control required" id="end_date" placeholder="End date" name="edate"  data-toggle="datepicker" autocomplete="false">

                    </div>

                    

                     <div class="col-sm-1"></div>

                    <label class="col-sm-2 control-label"

                           for="setuptime"><?php echo $this->lang->line('Setup Time') ?></label>



                    <div class="col-sm-3">

                        <input type="time" <?php if($project['show_setup_time'] != '00:00:00') { ?>  value="<?php echo $project['show_setup_time'];  ?>" <?php  } ?>  class="form-control"

                               placeholder="Setup Time" name="setuptime">

                    </div>

                </div>

                 <div class="form-group row">

                        <div class="col-sm-6">

                         <div class="form-group row">



                                    <label class="col-sm-4 col-form-label"

                                           for="hourly_wage"><?php echo $this->lang->line('Hourly Minimum wage') ?><i style="color:red">*</i></label>



                                    <div class="col-sm-6">

                                        <input type="number" min="0"  placeholder="Hourly rate"

                                            value="<?php echo $project['show_hourly_wage']; ?>"   class="form-control margin-bottom required" name="hourly_wage">

                                    </div>

                                </div>

                                <div class="form-group row">



                    <label class="col-sm-4 col-form-label" for="tl_commission"><?php echo $this->lang->line('TL Commision') ?>(%)<i style="color:red">*</i></label>



                    <div class="col-sm-6">

                        <input type="number" min="0" placeholder="TL Commission in persentage" value="<?php echo $project['show_tl_commission']; ?>"

                               class="form-control margin-bottom  required" name="tl_commission">

                    </div>

                </div>

                <div class="form-group row">



                    <label class="col-sm-4 col-form-label"

                           for="warehouse">Default Warehouse<i style="color:red">*</i></label>



                    <div class="col-sm-6">

                        <select name="warehouse" class="form-control required" >

                           <?php

                           foreach ($warehouse as $row) {

                                $cid = $row['id'];

                                $title = $row['title'];

                                if($project['show_default_warehouse']==$cid)

                                {

                                  echo "<option selected value=".$cid.">".$title."</option>";  

                                }

                                else

                                {

                                    echo "<option value=".$cid.">".$title."</option>";

                                }

                            }

                            ?>

                        </select>

                    </div>

                </div>

                 <div class="form-group row">



                    <label class="col-sm-4 col-form-label"

                           for="shiptype"><?php echo $this->lang->line('Shipping Option') ?><i style="color:red">*</i></label>



                    <fieldset>

                        <div class="col-sm-8">

                             <input type="radio" <?php if($project['show_shipping_option'] == "Ship") { ?> checked="checked" <?php } ?> checked class="radio"  name="shiptype" value="Ship" id="Ship" />

                            <label for="y"><?php echo $this->lang->line('Ship') ?></label>

                            <input style="margin-left:80px" <?php if($project['show_shipping_option'] == "Pick-up") { ?> checked="checked" <?php } ?>  type="radio" class="radio" name="shiptype" value="Pick-up" id="Pick-up" />

                            <label for="z"><?php echo $this->lang->line('Pick-up') ?></label>

                            

                        </div>

                    </fieldset>

                </div>
				
				<div class="form-group row">



                            <label class="col-sm-4 col-form-label" for="Shipping carrier">Shipping carrier</label>



                            <div class="col-sm-6">

                                <input type="text" placeholder="Shipping carrier"  class="form-control margin-bottom " name="shipping_carrier" value="<?php echo $project['shipping_carrier']; ?>">

                            </div>

                        </div>

                    </div>



                    <label class="col-sm-2 control-label"

                           for="note"><?php echo $this->lang->line('Note') ?></label>



                    <div class="col-sm-4">

                        <textarea class="summernote"

                                  placeholder=" Note"

                                  autocomplete="false" rows="10"  name="note"><?php echo $project['show_note']; ?></textarea>

                    </div>

                

                </div>

                 <div class="form-group row">



                    <label class="col-sm-2 col-form-label" for="tags"><?php echo $this->lang->line('Tags') ?></label>



                    <div class="col-sm-10">

                        <input type="text" placeholder="Tags" value="<?php echo $project['show_tag']; ?>"

                               class="form-control margin-bottom " name="tags">

                    </div>

                </div>

                <div class="form-group row">



                    <label class="col-sm-2 col-form-label"

                           for="task_communication">Task Communication<i style="color:red">*</i></label>



                    <div class="col-sm-4">

                        <select name="task_communication" class="form-control">

                            <option <?php if($project['show_task_communication'] == '0') { ?> selected <?php } ?> value='0'>YES</option>

                            <option <?php if($project['show_task_communication'] == '1') { ?> selected <?php } ?> value='1'>NO</option>

                         

                        </select>

                    </div>

                </div>



            

               

                <div class="form-group row">



                    <label class="col-sm-2 col-form-label"></label>



                    <div class="col-sm-4">



                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"

                               value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">

                         <input type="hidden" value="<?php echo $_GET['id'] ?>" name="show_main_id">

                        <input type="hidden" value="projects/editshow" id="action-url">



                    </div>

                </div>



            </form>

        </div>

    </div>

</article>

<script type="text/javascript">

    $(document).ready(function(){



    var datess="<?php echo $project['show_end_date']; ?>";
    var sow_setup_date="<?php echo $project['show_setup_date']; ?>";
    var show_start_date="<?php echo $project['show_start_date']; ?>";

     var res1 = datess.split("-");
     var res2 = sow_setup_date.split("-");
     var res3 = show_start_date.split("-");
 
    $('#end_date').val(res1[1]+'/'+res1[2]+'/'+res1[0]);
    $('#setup_date').val(res2[1]+'/'+res2[2]+'/'+res2[0]);
    $('#start_date').val(res3[1]+'/'+res3[2]+'/'+res3[0]);


     $(function() {
         $("#end_date").datepicker({
           
         });
       
        $("#setup_date").datepicker({
           
        });

                    $("#start_date").datepicker({
                                          
                         onSelect: function (selected) {
                                  var dt = new Date(selected);
                                 $("#end_date").datepicker("option", "minDate", dt);
                                 $("#setup_date").datepicker("option", "maxDate", dt);
                                }



                    });
          
    })



    $(function () {

       

        $('.select-box').select2();



        $('.summernote').summernote({

            height: 250,

            toolbar: [

                // [groupName, [list of button]]

                ['style', ['bold', 'italic', 'underline', 'clear']],

                ['font', ['strikethrough', 'superscript', 'subscript']],

                ['fontsize', ['fontsize']],

                ['color', ['color']],

                ['para', ['ul', 'ol', 'paragraph']],

                ['height', ['height']],

                ['fullscreen', ['fullscreen']],

                ['codeview', ['codeview']]

            ]

        });

    });



    $("#customer_statement").select2({

        minimumInputLength: 4,

        tags: [],

        ajax: {

            url: baseurl + 'search/customer_select',

            dataType: 'json',

            type: 'POST',

            quietMillis: 50,

            data: function (customer) {

                return {

                    customer: customer

                };

            },

            processResults: function (data) {

                return {

                    results: $.map(data, function (item) {

                        return {

                            text: item.name,

                            id: item.id

                        }

                    })

                };

            },

        }

    });



    var slider = $('#progress');

    var textn = $('#prog');

    textn.text(slider.val() + '%');

    $(document).on('change', slider, function (e) {

        e.preventDefault();

        textn.text($('#progress').val() + '%');



    });

     });

</script>