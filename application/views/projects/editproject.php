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

                <h3><?php echo $this->lang->line('Edit Store') ?> </h3>


                <hr>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="classification"><?php echo $this->lang->line('Select Classification') ?></label>

                    <fieldset>
                        <div class="col-sm-10">
                            <input type="radio" <?php if ($project['classification'] == "kiosk") { ?> checked="checked" <?php } ?> class="radio" name="classification_type" value="kiosk" id="Kiosk" />
                            <label for="Kiosk"><?php echo $this->lang->line('Kiosk') ?></label>
                            <input type="radio" style="margin-left:80px" <?php if ($project['classification'] == "store") { ?> checked="checked" <?php } ?> class="radio" name="classification_type" value="store" id="store" />
                            <label for="store"><?php echo $this->lang->line('Store') ?></label>
                        </div>
                    </fieldset>
                </div>
<div class="form-group row" id="locationdiv"  <?php if ($project['classification'] == "store") { ?>style="display:none;" <?php }?>>

                    <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Location') ?></label>

                    <div class="col-sm-10">
                    <select name="location" class="form-control">
                          
                          <?php
                           echo "<option value='0' selected>N/A</option>";
                              foreach ($locations as $key => $value) {
                                 
                                   if($value['id'] == $project['location'])
                                  echo "<option value='".$value['id']."' selected>".$value['name']."</option>";
                                  else
                                 echo "<option value='".$value['id']."'>".$value['name']."</option>";
                              }
                              if($project['location']=='0')
                              echo "<option value='0' selected>N/A</option>";
                          ?>

                      </select>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Name') ?></label>

                    <div class="col-sm-10">
                        <input type="text" placeholder="Project Title" value="<?php echo $project['name']; ?>" class="form-control margin-bottom  required" name="name">
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="status"><?php echo $this->lang->line('Status') ?></label>

                    <div class="col-sm-4">
                        <select name="status" class="form-control">
                            <option value='Waiting' <?php if ($project['status'] == "Waiting") { ?> selected <?php } ?>><?php echo $this->lang->line('Waiting'); ?></option>
                            <option value='Pending' <?php if ($project['status'] == "Pending") { ?> selected <?php } ?>><?php echo $this->lang->line('Pending') ?></option>
                            <option value='Terminated' <?php if ($project['status'] == "Terminated") { ?> selected <?php } ?>><?php echo $this->lang->line('Terminated') ?></option>
                            <option value='Finished' <?php if ($project['status'] == "Finished") { ?> selected <?php } ?>><?php echo $this->lang->line('Finished') ?></option>
                            <option value='Progress' <?php if ($project['status'] == "Progress") { ?> selected <?php } ?>><?php echo $this->lang->line('Progress') ?></option>"

                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label" for="quota"><?php echo $this->lang->line('Quota') ?></label>

                    <div class="col-sm-4">
                        <input type="number" value="<?php echo $project['quota']; ?>" placeholder="Quota" class="form-control margin-bottom  required" name="quota">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="budget"><?php echo $this->lang->line('Budget') ?></label>

                    <div class="col-sm-4">
                        <input value="<?php echo $project['budget']; ?>" type="number" placeholder="Budget" class="form-control margin-bottom  required" name="budget">
                    </div>

                    <div class="col-sm-6">
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="employee"><?php echo $this->lang->line('Assign to') ?></label>

                    <div class="col-sm-8">
                        <select name="employee[]" class="form-control required select-box" multiple="multiple">
                            <?php

                            foreach ($emp as $row) {

                                $cid = $row['id'];

                                $title = $row['name'];

                                $teamleader = array();

                                $teamleader = explode(",", $emp2);

                                foreach ($teamleader as $t) {
                                    if ($cid == $t) {
                                        echo "<option  selected value='$cid'>$title</option>";
                                    } else {
                                        echo "<option value='$cid'>$title</option>";
                                    }
                                }
                            }

                            ?>
                        </select>


                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 control-label" for="sdate"><?php echo $this->lang->line('Start Date') . "-" . $project['sdate']; ?></label>

                    <div class="col-sm-4">
                        <div class="input-group date " data-provide="datepicker">
                            <input value="<?php echo $project['sdate']; ?>" type="text" class="form-control required" placeholder="Start Date" id="start_date" name="sdate" data-toggle="datepicker" autocomplete="false">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                        </div>

                    </div>


                    <label class="col-sm-2 control-label" for="setupdate"><?php echo $this->lang->line('Setup Date') ?></label>

                    <div class="col-sm-4">
                        <div class="input-group date " data-provide="datepicker">
                            <input type="text" value="<?php echo $project['setupdate']; ?>" class="form-control required" placeholder="Setup Date" id="set_update" name="setupdate" data-toggle="datepicker" autocomplete="false">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group row">


                    <div class="col-sm-6">
                    </div>

                    <label class="col-sm-2 control-label" for="setuptime"><?php echo $this->lang->line('Setup Time') ?></label>

                    <div class="col-sm-4">
                        <input type="time" class="form-control required" placeholder="Setup Time" name="setuptime" autocomplete="false" <?php if ($project['setuptime'] != '00:00:00') { ?> value="<?php echo $project['setuptime'];  ?>" <?php  } ?>>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 control-label" for="note"><?php echo $this->lang->line('Note') ?></label>

                    <div class="col-sm-4">
                        <textarea class="summernote" placeholder=" Note" autocomplete="false" rows="10" name="note"><?php echo $project['note']; ?></textarea>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">

                            <label class="col-sm-4 col-form-label" for="hourly_rate"><?php echo $this->lang->line('Hourly Minimum wage') ?></label>

                            <div class="col-sm-8">
                                <input type="text" value="<?php echo $project['hourlyrate']; ?>" placeholder="Hourly rate" class="form-control margin-bottom" name="hourly_rate">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-4 col-form-label" for="tl_commission"><?php echo $this->lang->line('TL Commision') ?>(%)</label>

                            <div class="col-sm-8">
                                <input type="text" value="<?php echo $project['tlcomission']; ?>" placeholder="TL Commission in persentage" class="form-control margin-bottom  required" name="tl_commission">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-4 col-form-label" for="default_warehouse">Default Warehouse</label>

                            <div class="col-sm-8">
                                <select name="default_warehouse" class="form-control" id="link_to_cal">
                                    <?php
                                    foreach ($warehouse as $row) {
                                        $cid = $row['id'];
                                        $title = $row['title'];
                                        if ($project['default_warehouse'] == $cid) {
                                            echo "<option selected value=" . $cid . ">" . $title . "</option>";
                                        } else {
                                            echo "<option value=" . $cid . ">" . $title . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-4 col-form-label" for="shipping_option"><?php echo $this->lang->line('Shipping Option') ?></label>

                            <fieldset>
                                <div class="col-sm-8">
                                    <input type="radio" <?php if ($project['shipping_option'] == "Ship") { ?> checked="checked" <?php } ?> checked class="radio" name="shiptype" value="Ship" id="Ship" />
                                    <label for="y"><?php echo $this->lang->line('Ship') ?></label>
                                    <input style="margin-left:80px" <?php if ($project['shipping_option'] == "Pick-up") { ?> checked="checked" <?php } ?> type="radio" class="radio" name="shiptype" value="Pick-up" id="Pick-up" />
                                    <label for="z"><?php echo $this->lang->line('Pick-up') ?></label>

                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="tags"><?php echo $this->lang->line('Tags') ?></label>

                    <div class="col-sm-10">
                        <input type="text" placeholder="Tags" value="<?php echo $project['tag']; ?>" class="form-control margin-bottom  required" name="tags">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="name">Task Communication</label>

                    <div class="col-sm-4">
                        <select name="task_communication" class="form-control">
                            <option <?php if ($project['show_task_communication'] == '0') { ?> selected <?php } ?> value='0'>No</option>
                            <option <?php if ($project['show_task_communication'] == '1') { ?> selected <?php } ?> value='1'>Emails to team</option>
                            <option <?php if ($project['show_task_communication'] == '2') { ?> selected <?php } ?> value='2'>Emails to team, customer</option>
                        </select>
                    </div>
                </div>



                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">

                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom" value="<?php echo $this->lang->line('Edit') ?>" data-loading-text="Adding...">
                        <input type="hidden" value="projects/edit" id="action-url">
                        <input type="hidden" value="<?php echo $_GET['id'] ?>" name="project_id">
                    </div>
                </div>

            </form>
        </div>
    </div>
</article>
<script type="text/javascript">
    $(document).ready(function() {

        $('input[type=radio][name=classification_type]').change(function() {
        if (this.value == 'kiosk') {
            $('#locationdiv').show();
        }else{
            $('#locationdiv').hide();
        }
        });
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

        $('.edate').datepicker({
            autoHide: true,
            format: '<?php echo $this->config->item('dformat2'); ?>'
        });

        var slider = $('#progress');
        var textn = $('#prog');
        textn.text(slider.val() + '%');
        $(document).on('change', slider, function(e) {
            e.preventDefault();
            textn.text($('#progress').val() + '%');

        });

        var sdate = "<?php echo $project['sdate']; ?>";
        var sow_setup_date = "<?php echo $project['setupdate']; ?>";


        var res1 = sdate.split("-");
        var res2 = sow_setup_date.split("-");


        $('#start_date').val(res1[1] + '/' + res1[2] + '/' + res1[0]);
        $('#set_update').val(res2[1] + '/' + res2[2] + '/' + res2[0]);

        $(function() {
            $("#start_date").datepicker({});
            $("#set_update").datepicker({});
        });

       
    });
</script>