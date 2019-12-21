<article class="content">

    <div class="card card-block">

        <div id="notify" class="alert alert-success" style="display:none;">

            <a href="#" class="close" data-dismiss="alert">&times;</a>



            <div class="message"></div>

        </div>

        <div class="grid_3 grid_4">

        
            <h3>Shipment Label</h3>

            <hr>

            <form method="post" action="<?php echo base_url(); ?>reports/show_sales">
                      
                       <div class="form-group row">

                          <label class="col-sm-3 col-form-label" for="show"><b>Select Show</b></label>

                              <div class="col-sm-4">

                                  <select name="show_id" id="show_id" class="form-control select-box">

                                       <?php

                                        foreach($show_list as $row) {

                                          $sid=$this->input->post('show_id');
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

                           <div class="form-group row">
                           <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-4">
                          <button type="submit" class="btn btn-success ">View</button>
                        </div>
                         </div>
                      </form>

        </div>

    </div>

</article>
