<article class="content">

    <div class="card card-block">

        <div id="notify" class="alert alert-success" style="display:none;">

            <a href="#" class="close" data-dismiss="alert">&times;</a>



            <div class="message"></div>

        </div>

        <div class="grid_3 grid_4">





            <form method="post" id="data_form" class="form-horizontal">



                <h3>Edit Milestone </h3>

                 <p>

                    <b><a href="#" class="btn btn-primary btn-sm rounded">

                                            <?php echo $project['project']['show_id']; ?> 

                                </a>  

                                <a href="#" class="btn btn-primary btn-sm rounded">

                                             <?php echo $project['project']['show_name']; ?> 

                                </a></b>

                </p>

                <hr>



                <div class="form-group row">



                    <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Title') ?><i style="color: red">*</i></label>



                    <div class="col-sm-10">

                        <input type="text" value="<?php echo $milestone->name; ?>" placeholder="Milestone Title" class="form-control margin-bottom  required" name="name">

                    </div>

                </div>


  <div class="append_data">

                    </div>


                <div class="form-group row">

                   



                    <label class="col-sm-2 control-label"

                           for="edate"><?php echo $this->lang->line('Color') ?><i style="color: red">*</i></label>



                    <div class="col-sm-2">

                        <input id="color" name="color" type="color" class="form-control input-md"

                               value="<?php echo $milestone->color; ?>">

                    </div>

                </div>





                <div class="form-group row">



                    <label class="col-sm-2 control-label"

                           for="edate"><?php echo $this->lang->line('Start Date') ?><i style="color: red">*</i></label>



                    <div class="col-sm-2">

                        <input type="text" class="form-control required"

                               placeholder="Start Date" id="start_date" name="start_date"

                               autocomplete="false">

                    </div>

                </div>





                <div class="form-group row">



                    <label class="col-sm-2 control-label"

                           for="edate"><?php echo $this->lang->line('Due Date') ?><i style="color: red">*</i></label>



                    <div class="col-sm-2">

                        <input type="text" class="form-control required"

                               placeholder="End Date" id="end_date" name="end_date" autocomplete="false">

                    </div>

                </div>





                <div class="form-group row">



                    <label class="col-sm-2 control-label"

                           for="content"><?php echo $this->lang->line('Description') ?><i style="color: red">*</i></label>



                    <div class="col-sm-10">

                        <textarea class="summernote"

                                  placeholder=" Note"

                                  autocomplete="false" rows="10" name="content">  </textarea>

                    </div>

                </div>





                <div class="form-group row">



                    <label class="col-sm-2 col-form-label"></label>



                    <div class="col-sm-4">

                         <input type="hidden" value="<?php echo $_GET['id']; ?>" name="mile_id">



                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"

                               value="Edit" data-loading-text="Editing...">

                        <input type="hidden" value="/projects/editmilestone" id="action-url">

                        <input type="hidden" value="<?php echo $_GET['sid'] ?>" name="project">

                    </div>

                </div>





            </form>

        </div>

    </div>

</article>

<script type="text/javascript">


$(document).ready(function(){

    var start_date="<?php echo $milestone->sdate; ?>";
    var end_date="<?php echo $milestone->edate; ?>";
    var des="<?php echo $milestone->exp; ?>";



    $('#end_date').val(end_date);
    $('#start_date').val(start_date);

    $('.summernote').val(des);



    $(function () {

        $('.select-box').select2();

         $("#end_date").datepicker({

          

                       

                     });

                    $("#start_date").datepicker({
                     
                         onSelect: function (selected) {

                               
                                  var dt = new Date(selected);
                                 
                               
                                 $("#end_date").datepicker("option", "minDate", dt);                         
                                
                                }
                    });



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

    });

</script>



<script>
  $(document).ready(function(){

    var show_id="<?php echo $_GET['sid']; ?>";
    var mile_id="<?php echo $_GET['id']; ?>";

    var append_data='';

       jQuery.ajax({

            url: baseurl+"/projects/getmilestonealldateedit",

            type: 'POST',

            data: { id : show_id,mile_id : mile_id },

           dataType: 'json',

            success: function (data) {

              $.each( data, function( key, obj ) {

                   append_data+="<input type='hidden' name='start_date[]' value="+obj.sdate+" >";
                    append_data+="<input type='hidden' name='end_date[]' value="+obj.edate+" >";


                
              });

              $('.append_data').html(append_data);

            },
          });

  });
  
</script>