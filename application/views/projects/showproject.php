<link href="<?php echo base_url(); ?>assets/portcss/bootstrap-colorpicker.min.css" rel="stylesheet" />

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



                <h3><?php echo $this->lang->line('Add Show') ?></h3>

                <hr>

                <div class="form-group row">



                    <label class="col-sm-2 col-form-label" for="show_id">
                        <h4><?php echo $this->lang->line('Show') ?>#</h4>
                    </label>



                    <div class="col-sm-4">

                        <input type="text" class="form-control margin-bottom  required" id="show_id" name="show_id">
						<label id="show_id_msg" style="color:red;"></label>
                    </div>
                    <!-- location start -->

                    <label class="col-sm-2 col-form-label" for="show_id">
                        <h4><?php echo $this->lang->line('Location') ?>#</h4>
                    </label>



                    <div class="col-sm-4">

                        <!-- <input type="text" class="form-control margin-bottom  required" id="show_id" name="show_id"> -->
                        <select name="location" class="form-control">
                            <option value="select_loc">Select Location</option>
                            <?php
                             echo "<option value='0'>N/A</option>";
                                foreach ($locations as $key => $value) {
                                   echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                }
                            ?>

                        </select>

                    </div>
                    <!-- location end -->
                </div>


                <div class="form-group row">



                    <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Name') ?><i style="color:red">*</i></label>



                    <div class="col-sm-10">

                        <input type="text" placeholder="Show Name" class="form-control margin-bottom required" name="name">

                    </div>

                </div>



                <div class="form-group row">



                    <label class="col-sm-2 col-form-label" for="status"><?php echo $this->lang->line('Status') ?><i style="color:red">*</i></label>



                    <div class="col-sm-4">

                        <select name="status" class="form-control">

                            <?php echo " <option value='Waiting'>" . $this->lang->line('Waiting') . "</option>

                            <option value='Pending'>" . $this->lang->line('Pending') . "</option>

                            <option value='Terminated'>" . $this->lang->line('Terminated') . "</option>

                            <option value='Finished'>" . $this->lang->line('Finished') . "</option>

                            <option value='Progress'>" . $this->lang->line('Progress') . "</option>"; ?>

                        </select>

                    </div>

                    <label class="col-sm-2 col-form-label" for="attendance"><?php echo $this->lang->line('Attendance') ?><i style="color:red">*</i></label>



                    <div class="col-sm-4">

                        <input type="number" min="0" value="0" placeholder="Attendance" class="form-control" id="attendance" name="attendance">

                    </div>

                </div>

                <div class="form-group row">



                    <label class="col-sm-2 col-form-label" for="budget"><?php echo $this->lang->line('Budget') ?><i style="color:red">*</i></label>



                    <div class="col-sm-4">

                        <input type="number" placeholder="Budget" value="0" min="0" class="form-control margin-bottom  required" name="budget">

                    </div>



                    <label class="col-sm-2 col-form-label" for="quota"><?php echo $this->lang->line('Quota') ?><i style="color:red">*</i></label>



                    <div class="col-sm-4">

                        <input type="number" placeholder="quota" class="form-control margin-bottom required" min="0" value="0" name="quota">

                    </div>

                </div>



                <div class="form-group row">



                    <label class="col-sm-2 col-form-label" for="employee"><?php echo $this->lang->line('Assign to') ?></label>



                    <div class="col-sm-8">

                        <select name="employee[]" class="form-control  select-box " multiple="multiple">

                            <?php

                            foreach ($emp as $row) {

                                $cid = $row['id'];

                                $title = $row['name'];

                                echo "<option  value='$cid'>$title</option>";
                            }

                            ?>

                        </select>





                    </div>

                </div>



                <div class="form-group row">



                    <label class="col-sm-2 control-label" for="sdate"><?php echo $this->lang->line('Start Date') ?><i style="color:red">*</i></label>



                    <div class="col-sm-3">

                        <input type="text" class="form-control required " id="start_date" name="sdate">

                    </div>

                    <div class="col-sm-1"></div>



                    <label class="col-sm-2 control-label" for="setupdate"><?php echo $this->lang->line('Setup Date') ?><i style="color:red">*</i></label>



                    <div class="col-sm-3">

                        <input type="text" class="form-control required" name="setupdate" id="setup_date">

                    </div>

                </div>



                <div class="form-group row">



                    <label class="col-sm-2 control-label" for="edate"><?php echo $this->lang->line('End Date') ?><i style="color:red">*</i></label>



                    <div class="col-sm-3">

                        <input type="text" class="form-control required" id="end_date" name="edate">

                    </div>



                    <div class="col-sm-1"></div>

                    <label class="col-sm-2 control-label" for="setuptime"><?php echo $this->lang->line('Setup Time') ?></label>



                    <div class="col-sm-3">

                        <input type="time" class="form-control " placeholder="Setup Time" name="setuptime">

                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-6">

                        <div class="form-group row">



                            <label class="col-sm-4 col-form-label" for="hourly_wage"><?php echo $this->lang->line('Hourly Minimum wage') ?><i style="color:red">*</i></label>



                            <div class="col-sm-6">

                                <input type="number" placeholder="Hourly rate" value="0" min="0" class="form-control margin-bottom" name="hourly_wage">

                            </div>

                        </div>

                        <div class="form-group row">



                            <label class="col-sm-4 col-form-label" for="tl_commission"><?php echo $this->lang->line('TL Commision') ?>(%)<i style="color:red">*</i></label>



                            <div class="col-sm-6">

                                <input type="number" placeholder="TL Commission in persentage" value="0" class="form-control margin-bottom  required" name="tl_commission">

                            </div>

                        </div>

                        <div class="form-group row">



                            <label class="col-sm-4 col-form-label" for="warehouse">Default Warehouse<i style="color:red">*</i></label>



                            <div class="col-sm-6">

                                <select name="warehouse" class="form-control" id="link_to_cal">

                                    <?php

                                    foreach ($warehouse as $row) {

                                        $cid = $row['id'];

                                        $title = $row['title'];

                                        echo "<option value='$cid'>$title</option>";
                                    }

                                    ?>

                                </select>

                            </div>

                        </div>

                        <div class="form-group row">



                            <label class="col-sm-4 col-form-label" for="shiptype"><?php echo $this->lang->line('Shipping Option') ?><i style="color:red">*</i></label>



                            <fieldset>

                                <div class="col-sm-8">

                                    <input type="radio" checked class="radio" name="shiptype" value="Ship" id="Ship" />

                                    <label for="Ship"><?php echo $this->lang->line('Ship') ?></label>

                                    <input style="margin-left:80px" type="radio" class="radio" name="shiptype" value="Pick-up" id="Pick-up" />

                                    <label for="Pick-up"><?php echo $this->lang->line('Pick-up') ?></label>



                                </div>

                            </fieldset>

                        </div>
						<div class="form-group row">



                            <label class="col-sm-4 col-form-label" for="Shipping carrier">Shipping carrier</label>



                            <div class="col-sm-6">

                                <input type="text" placeholder="Shipping carrier"  class="form-control margin-bottom " name="shipping_carrier">

                            </div>

                        </div>

                    </div>



                    <label class="col-sm-2 control-label" for="note"><?php echo $this->lang->line('Note') ?></label>



                    <div class="col-sm-4">

                        <textarea class="summernote" placeholder=" Note" autocomplete="false" rows="10" name="note"></textarea>

                    </div>



                </div>

                <div class="form-group row">



                    <label class="col-sm-2 col-form-label" for="tags"><?php echo $this->lang->line('Tags') ?></label>



                    <div class="col-sm-10">

                        <input type="text" placeholder="Tags" class="form-control margin-bottom " name="tags">

                    </div>

                </div>

                <div class="form-group row">



                    <label class="col-sm-2 col-form-label" for="task_communication">Task Communication<i style="color:red">*</i></label>



                    <div class="col-sm-4">

                        <select name="task_communication" class="form-control">

                            <option value='0'>Yes</option>

                            <option value='1'>No</option>

                        </select>

                    </div>

                </div>







                <div class="form-group row">



                    <label class="col-sm-2 col-form-label"></label>



                    <div class="col-sm-4">



                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom" value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">

                        <input type="hidden" value="projects/showproject" id="action-url">



                    </div>

                </div>



            </form>

        </div>

    </div>

</article>

<script type="text/javascript">
    function makeid() {

        var result = '';

        var characters = '01ABCDEF23456789NOPQRSTUVWXYZ';

        var charactersLength = characters.length;

        for (var i = 0; i < 5; i++) {

            result += characters.charAt(Math.floor(Math.random() * charactersLength));

        }

        return result;

    }

    var rndm = 'SW_' + makeid();



    //$('#show_id').val(rndm);
</script>



<script type="text/javascript">
    $(function() {

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

	$(document).on("blur", "#show_id", function(e) {
		 e.preventDefault();
		 var show_id=$('#show_id').val();
		$.ajax({

            type: "POST",

            url: baseurl + "Projects/checkshowId",



            data: {

                show_id: show_id,

            },

            dataType: "JSON",

            async: false,

            success: function(data) {
				if(data == 1){
					$('#show_id_msg').html('Entered Show Id Already Exist !!!');
					$('#submit-data').attr("disabled", true);
				}else{
					$('#show_id_msg').html('');
					$('#submit-data').attr("disabled", false);
				}
				
			}
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

            data: function(customer) {

                return {

                    customer: customer

                };

            },

            processResults: function(data) {

                return {

                    results: $.map(data, function(item) {

                        return {

                            text: item.name,

                            id: item.id

                        }

                    })

                };

            },

        }

    });




    $(function() {
        $("#end_date").datepicker({});
        $("#setup_date").datepicker({});

        $("#start_date").datepicker({
            onSelect: function(selected) {
                var dt = new Date(selected);
                $("#end_date").datepicker("option", "minDate", dt);
                $("#setup_date").datepicker("option", "maxDate", dt);
            }



        });

    })




    // $("#setup_date").datepicker({

    //        onSelect: function (selected) {
    //           var dt = new Date(selected);

    //             dt.setDate(dt.getDate() + 1);

    //             $("#end_date").datepicker("option", "minDate", dt);
    //         }

    //     });


    // $("#end_date").datepicker({});






    var slider = $('#progress');

    var textn = $('#prog');

    textn.text(slider.val() + '%');

    $(document).on('change', slider, function(e) {

        e.preventDefault();

        textn.text($('#progress').val() + '%');



    });
</script>