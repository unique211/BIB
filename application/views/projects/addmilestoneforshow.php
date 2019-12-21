<article class="content">

    <div class="card card-block">

        <div id="notify" class="alert alert-success" style="display:none;">

            <a href="#" class="close" data-dismiss="alert">&times;</a>



            <div class="message"></div>

        </div>

        <div class="grid_3 grid_4">





            <form method="post" id="data_form" class="form-horizontal">



                <h3><?php echo $this->lang->line('Add Milestone') ?></h3>


                 <p>

                    <b><a href="#" class="btn btn-primary btn-sm rounded">

                                            <?php echo $project['show_id']; ?> 



                                </a>  

                                <a href="#" class="btn btn-primary btn-sm rounded">

                                             <?php echo $project['show_name']; ?> 

                                </a></b>

                </p>

                <hr>



                <div class="form-group row">



                    <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Title') ?><i style="color: red">*</i></label>



                    <div class="col-sm-10">

                        <input type="text" placeholder="Milestone Title"

                               class="form-control margin-bottom  required" name="name">

                    </div>

                </div>





                <div class="form-group row">



                    <label class="col-sm-2 control-label"

                           for="edate"><?php echo $this->lang->line('Color') ?><i style="color: red">*</i></label>



                    <div class="col-sm-2">

                        <input id="color" name="color" type="color" class="form-control input-md"

                               value="#0b97f4">

                    </div>

                </div>





                <div class="form-group row">



                    <label class="col-sm-2 control-label"

                           for="edate"><?php echo $this->lang->line('Start Date') ?><i style="color: red">*</i></label>



                    <div class="col-sm-2">

                        <input type="text" id="start_date" class="form-control required"

                               placeholder="Start Date" name="staskdate"

                              autocomplete="false">

                    </div>

                </div>





                <div class="form-group row">



                    <label class="col-sm-2 control-label"

                           for="edate"><?php echo $this->lang->line('Due Date') ?><i style="color: red">*</i></label>



                    <div class="col-sm-2">

                        <input type="text" id="end_date" class="form-control required"

                               placeholder="End Date" name="taskdate"

                               autocomplete="false">

                    </div>


                </div>




                <div class="form-group row">



                    <label class="col-sm-2 control-label"

                           for="content"><?php echo $this->lang->line('Description') ?><i style="color: red">*</i></label>



                    <div class="col-sm-10">

                        <textarea class="summernote required"

                                  placeholder=" Note"

                                  autocomplete="false" rows="10" name="content"></textarea>

                    </div>

                </div>

          

                <div class="form-group row ">



                    <label class="col-sm-2 col-form-label"></label>



                    <div class="col-sm-4">

                      <div class="abc">
                      </div>

                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"

                               value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">

                        <input type="hidden" value="/projects/addmilestoneforshow" id="action-url">

                        <input type="hidden" value="<?php echo $prid ?>" name="project">

                    </div>

                </div>

            </form>

        </div>

    </div>

</article>

<script type="text/javascript">

     $(function() {
       var startdat="<?php echo $project['show_start_date'] ?>";
       var enddate="<?php echo $project['show_end_date'] ?>";

                     $("#end_date").datepicker({

                       

                     });

                    $("#start_date").datepicker({
                     
                         onSelect: function (selected) {
                                  var dt = new Date(selected);
                                 
                               
                                 $("#end_date").datepicker("option", "minDate", dt);

                              
                                   
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

</script>

<script>
  $(document).ready(function(){


    var show_id="<?php echo $_GET['id']; ?>";

    var append_data='';

       jQuery.ajax({

            url: baseurl+"/projects/getmilestonealldate",

            type: 'POST',

            data: { id : show_id },

           dataType: 'json',

            success: function (data) {

              $.each(data, function( key, obj ) {

                   append_data+="<input type='text' style='display:none' name='start_date[]' value="+obj.sdate+" ><input type='text'  style='display:none' name='end_date[]' value="+obj.edate+" >";              
              });

              console.log(append_data);

               $('.abc').html(append_data);
            },
          });

  });
  
</script>