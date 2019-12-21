<article class="content">

    <div class="card card-block">

        <div id="notify" class="alert alert-success" style="display:none;">

            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>

        </div>

        <div class="grid_3 grid_4">

           
            <h3>Calculation for pallet shipping</h3>

            <br>

             <form method="post" action="<?php echo base_url(); ?>reports/calculating_shipping_pallet">
                      
                       <div class="form-group row">

                          <label class="col-sm-3 col-form-label" for="show"><b>Select Show</b></label>

                              <div class="col-sm-6">

                                  <select name="show_id" id="show_id" class="form-control select-box">

                                       <?php
                                        $sid=$this->input->post('show_id');
                                        foreach($show_list as $row) {

                                          $id = $row->id;
                                           $show_name = $row->show_name;

                                          if($sid==$id)
                                          {
                                            echo "<option selected value=".$id.">$show_name</option>";
                                          }
                                          else
                                          {
                                         

                                          echo "<option value=".$id.">$show_name</option>";
                                        }

                                      }

                                      ?> 

                                  </select>

                              </div>

                        </div>

                        <!-- Teamleader  -->

                         <div class="form-group row">

                          <label class="col-sm-3 col-form-label" for="show"><b>Select Teamleader</b></label>

                          <div class="col-sm-6">

                                  <select name="teamleader_id" id="teamleader_id" class="form-control select-box">

                                    <option value=""></option>

                                  </select>

                            </div>

                         </div>

                         <!-- Teamleader  -->



                           <div class="form-group row">
                           <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-4">
                          <button type="submit" id="btn-submit" class="btn btn-success ">View</button>
                        </div>
                         </div>
                      </form>


        </div>

    </div>



</article>

<script type="text/javascript">

   $('#show_id').change(function(){

    $('.display_data').html('');

                  var id = $(this).val();

                  var appenddata='';     
               
                  $.ajax({

                    url: baseurl + 'reports/getTeamleaderfoconsignment',

                    type: 'GET',

                    data: {show_id : id},

                    dataType: 'json',

                    success: function (data) {


                      var icount=0;
                      $.each(data, function(idx, obj) {  
                          icount++;
                          });

                      var show_name=$("#show_id option:selected").text();

                      if(icount != 0)
                      {
                           appenddata+="<option value='all'>All Teamleaders for show "+show_name+"</option>";

                        $.each(data, function(idx, obj) {                       
                            appenddata+="<option value="+obj.id+">"+obj.name+"</option>";
                        });
                      }
                      else
                      {
                        appenddata+="<option value=''>"+"No team Leader Available"+"</option>";
                      }
 
                       $('#teamleader_id').html(appenddata);

                    }
                });


            });
</script>
