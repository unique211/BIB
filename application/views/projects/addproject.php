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


            <form method="post"  id="data_form" class="form-horizontal">

                <h3><?php echo $this->lang->line('Add Store') ?> </h3>
                
                 
                <hr>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="product_catname"><?php echo $this->lang->line('Select Classification') ?></label>

                    <fieldset>
                        <div class="col-sm-10">
                            <input  type="radio"  name="project_type1" value="kiosk"  />
                            <label for="kiosk"><?php echo $this->lang->line('Kiosk') ?></label>
                            <input type="radio" style="margin-left:80px" checked="checked"  name="project_type1"   />
                            <label for="store"><?php echo $this->lang->line('Store') ?></label>
                        </div>
                    </fieldset>
                </div>
                <div class="form-group row" id="locationdiv" style="display:none;">
                <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Location') ?></label>
                <div class="col-sm-10">         <select name="location" class="form-control">
                            <option value="select_loc">Select Location</option>
                            <?php
                             echo "<option value='0'>N/A</option>";
                                foreach ($locations as $key => $value) {
                                   echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                }
                            ?>

                        </select>
                </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Name') ?></label>

                    <div class="col-sm-10">
                        <input type="text" placeholder="Project Title"
                               class="form-control margin-bottom  required" name="name" >
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="status"><?php echo $this->lang->line('Status') ?></label>

                    <div class="col-sm-4">
                        <select name="status" class="form-control">
                           <?php echo" <option value='Waiting'>".$this->lang->line('Waiting')."</option>
                            <option value='Pending'>".$this->lang->line('Pending')."</option>
                            <option value='Terminated'>".$this->lang->line('Terminated')."</option>
                            <option value='Finished'>".$this->lang->line('Finished')."</option>
                            <option value='Progress'>".$this->lang->line('Progress')."</option>"; ?>
                        </select>
                    </div>
                     <label class="col-sm-2 col-form-label" for="quota"><?php echo $this->lang->line('Quota') ?></label>

                    <div class="col-sm-4">
                        <input type="number" placeholder="Quota"
                               class="form-control margin-bottom  required" value="0" min="0" name="quota" >
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="budget"><?php echo $this->lang->line('Budget') ?></label>

                    <div class="col-sm-4">
                        <input type="number" min="0" value="0" placeholder="Budget"
                               class="form-control margin-bottom  required" name="budget">
                    </div>

                   <div class="col-sm-6">
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="employee"><?php echo $this->lang->line('Assign to') ?></label>

                    <div class="col-sm-8">
                        <select name="employee[]" class="form-control required select-box" multiple="multiple">
                            <?php
                            foreach ($emp as $row) {
                                $cid = $row['id'];
                                $title = $row['name'];
                                echo "<option value='$cid'>$title</option>";
                            }
                            ?>
                        </select>


                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 control-label"
                           for="sdate"><?php echo $this->lang->line('Start Date') ?></label>

                    <div class="col-sm-4">
                    <div class="input-group" data-provide="datepicker">
                        <input type="text" class="form-control required"
                               placeholder="Start Date" id="start_date" name="sdate"
                               data-toggle="datepicker" autocomplete="false">
                               <div class="input-group-addon">
                                                            <span class="fa fa-calendar"></span>
                                </div>
                        </div>  

                               <!--<input type="text" class="form-control required " id="start_date" name="sdate">-->
                    </div>

                    <label class="col-sm-2 control-label"
                           for="setupdate"><?php echo $this->lang->line('Setup Date') ?></label>

                    <div class="col-sm-4">
                    <div class="input-group" data-provide="datepicker">
                        <input type="text" class="form-control required"
                               placeholder="Setup Date" id="set_update" name="setupdate" data-toggle="datepicker" autocomplete="false"
                              >
                              <div class="input-group-addon">
                                                            <span class="fa fa-calendar"></span>
                                </div>
                        </div>  
                    </div>
                </div>

                <div class="form-group row">

                   
<div class="col-sm-6">
</div>

                    <label class="col-sm-2 control-label"
                           for="setuptime"><?php echo $this->lang->line('Setup Time') ?></label>

                    <div class="col-sm-4">
                        <input type="time"  class="form-control required"
                               placeholder="Setup Time" name="setuptime"
                               >
                    </div>
                </div>
                 <div class="form-group row">

                    <label class="col-sm-2 control-label"
                           for="note"><?php echo $this->lang->line('Note') ?></label>

                    <div class="col-sm-4">
                        <textarea class="summernote required"
                                  placeholder=" Note"
                                  autocomplete="false" rows="10" name="note"></textarea>
                    </div>
                    <div class="col-sm-6">
                         <div class="form-group row">

                                    <label class="col-sm-4 col-form-label"
                                           for="hourly_rate"><?php echo $this->lang->line('Hourly Minimum wage') ?></label>

                                    <div class="col-sm-8">
                                        <input type="text"  placeholder="Hourly rate"
                                               class="form-control margin-bottom required" name="hourly_rate">
                                    </div>
                                </div>
                                <div class="form-group row">

                    <label class="col-sm-4 col-form-label" for="tl_commission"><?php echo $this->lang->line('TL Commision') ?>(%)</label>

                    <div class="col-sm-8">
                        <input type="text"  placeholder="TL Commission in persentage"
                               class="form-control margin-bottom  required" name="tl_commission">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-4 col-form-label"
                           for="default_warehouse">Default Warehouse</label>

                    <div class="col-sm-8">
                        <select name="default_warehouse" class="form-control" id="link_to_cal">
                            
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

                    <label class="col-sm-4 col-form-label"
                           for="shiptype"><?php echo $this->lang->line('Shipping Option') ?></label>

                    <fieldset>
                        <div class="col-sm-8">
                            <input type="radio" checked class="radio"  name="shiptype" value="Ship" id="Ship" />
                            <label for="shiptype"><?php echo $this->lang->line('Ship') ?></label>
                            <input style="margin-left:80px" type="radio" class="radio" name="shiptype" value="Pick-up" id="Pick-up" />
                            <label for="shiptype"><?php echo $this->lang->line('Pick-up') ?></label>
                            
                        </div>
                    </fieldset>
                </div>
                    </div>
                </div>
                 <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="tags"><?php echo $this->lang->line('Tags') ?></label>

                    <div class="col-sm-10">
                        <input type="text"  placeholder="Tags"
                               class="form-control margin-bottom  required" name="tags">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="task_communication">Task Communication</label>

                    <div class="col-sm-4">
                        <select name="task_communication" class="form-control">
                            <option value='0'>No</option>
                            <option value='1'>Emails to team</option>
                            <option value='2'>Emails to team, customer</option>
                        </select>
                    </div>
                </div>

            
               
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">

                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                               value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">
                        <input type="hidden" value="projects/addstore" id="action-url">

                    </div>
                </div>

            </form>
        </div>
    </div>
</article>
<script type="text/javascript">
$(document).ready(function(){

    $('input[type=radio][name=project_type1]').change(function() {
        if (this.value == 'kiosk') {
            $('#locationdiv').show();
        }else{
            $('#locationdiv').hide();
        }
        });
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

    $('.edate').datepicker({autoHide: true, format: '<?php echo $this->config->item('dformat2'); ?>'});
    var slider = $('#progress');
    var textn = $('#prog');
    textn.text(slider.val() + '%');
    $(document).on('change', slider, function (e) {
        e.preventDefault();
        textn.text($('#progress').val() + '%');

    });
    $(function() {
		var d = new Date();

		var month = d.getMonth()+1;
		var day = d.getDate();

		var date = ((''+month).length<2 ? '0' : '') + month + '/' +
					((''+day).length<2 ? '0' : '') + day + '/' +
						d.getFullYear();

		//alert(output);
				
 
             $("#start_date").val(date);
             $("#set_update").val(date);
			 
        $("#end_date").datepicker({autoHide: true, format: 'mm-dd-yyyy'});
        $("#set_update").datepicker({autoHide: true, format: 'mm-dd-yyyy'});

        $("#start_date").datepicker({
           // dateFormat: 'mm/dd/yyyy',

            onSelect: function(selected) {
                var dt = new Date(selected);
                $("#end_date").datepicker("option", "minDate", dt);
                $("#set_update").datepicker("option", "maxDate", dt);
            }




        });
		
            $('.date').datepicker({
					 'todayHighlight':true,
					// minDate: 0
       });
        

    });
})
</script>