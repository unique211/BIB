<article class="content">

    <div class="card card-block">

        <div id="notify" class="alert alert-success" style="display:none;">

            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>

        </div>

        <div class="grid_3 grid_4">

        </div>
        <?php if($this->input->post('teamleader_id')==''){ ?>

          <div class="table-responsive">

        <table class="table table-bordered">

                              <tr>

                                <th colspan="7" style="text-align: center;">

                                  <?php echo $show_details->show_id." ".$show_details->show_name; ?>

                                </th>

                                
                              </tr>

                               <tr>

                                <th>Item</th>

                                <th>Weight per Item </th>

                                <th>Weight per box</th>

                                <th># of boxes</th>

                                <th>Weight</th>

                                <th>Total Pieces</th>

                                <th>Dimension</th>

                              </tr>
                              <tr>
                                <td colspan="7" style="text-align: center;">Team Leader is Not Available</td>
                              </tr>
                            </table>
                          </div>

        <?php }else{ 

          if(empty($shipping_pallet))
          {
            ?>
            <div class="table-responsive">
           <table class="table table-bordered">

                              <tr>

                                <th colspan="7" style="text-align: center;">

                                  <?php echo $show_details->show_id." ".$show_details->show_name; ?>

                                </th>

                                
                              </tr>

                               <tr>

                                <th>Item</th>

                                <th>Weight per Item </th>

                                <th>Weight per box</th>

                                <th># of boxes</th>

                                <th>Weight</th>

                                <th>Total Pieces</th>

                                <th>Dimension</th>

                              </tr>
                              <tr>
                                <td colspan="7" style="text-align: center;">No Data is Available</td>
                              </tr>
                            </table>
                          </div>
            <?php
          }
          else
          {

            ?>

              <div class="card card-block sameheight-item">

                <div class="col-md-12">

                  <p>Show ID : <?php echo $show_details->show_id; ?></p>

                  <p>Show Name : <?php echo $show_details->show_name; ?></p>

                </div>

                 <div class="col-md-12 table-responsive">

                        
                            <table class="table table-bordered">

                              <tr>

                                <th colspan="7" style="text-align: center;">

                                  <?php echo $show_details->show_id." ".$show_details->show_name; ?>

                                </th>

                                
                              </tr>

                               <tr>

                                <th>Item</th>

                                <th>Weight per Item </th>

                                <th>Weight per box</th>

                                <th># of boxes</th>

                                <th>Weight</th>

                                <th>Total Pieces</th>

                                <th>Dimension</th>

                              </tr>

                              <?php
                              $t_weight = 0;
                              $t_pieces = 0;
                              foreach($product_category as $cat)
                              {

                                ?>

                                  <tr>

                                        <th colspan="7">

                                         <?php echo $cat['title']; ?>

                                        </th>
    
                                  </tr>

                                <?php 
                                $sum_weight = 0;
                                $sum_pieces = 0;
                                
                                 $count=0;
                                  foreach($shipping_pallet as $product)
                                  {
                                   
                                    if($product['product_category']==$cat['id'])
                                    {
                                      $count++;
                                      ?>

                                      <tr>
                                        
                                      <td><?php echo $product['item_name'].'-'.$product['product_name']; ?></td>
                                      <td><?php echo $product['product_weight']; ?></td>
                                      <td><?php $boxweight=$product['product_weight']*$product['Package_quanity_in_bx']; ?>
                                        <?php echo $boxweight; ?>
                                      </td>
                                      <td><?php $ofbox=$product['product_approve_qty']/$product['Package_quanity_in_bx'];

                                        $inint=(int)$ofbox;

                                        if($inint==0)
                                        {
                                          $inint=1;
                                        }

                                        echo $inint;
                                      ?></td>
                                      <td>
                                        <?php echo $boxweight*$inint;  $sum_weight += ($boxweight*$inint);?>
                                      </td>
                                      <td><?php echo $product['product_approve_qty'];   $sum_pieces += $product['product_approve_qty'];?></td>
                                      <td><?php echo $product['product_lenght']." x ".$product['product_width']." x ".$product['product_height']; ?></td>
                                      </tr>

                                      <?php
                                    }
                                   
                                    
                                   

                                  }
                                  $t_weight += $sum_weight;
                                  $t_pieces += $sum_pieces;
                                  ?>

                                  <tr>
    
                                    <td colspan="4">&nbsp;</td>
                                    <td> <?php echo $sum_weight; ?></td>
                                    <td> <?php echo $sum_pieces; ?></td>
                                    <td >&nbsp;</td>
                                   
                                  </tr>
                                      <?php
                                    
                                  if($count==0)
                                  {

                                  ?>

                              <tr>

                                <td colspan="7">No Product is Available for category <?php echo $cat['title']; ?></td>
                               
                              </tr>
                                  <?php
                                }

                                 
                              }



                               ?>
                               <tr>

                               <td colspan="4">&nbsp;</td>
                                    <td><strong><?php echo $t_weight; ?></strong> </td>
                                    <td> <strong><?php echo $t_pieces; ?></strong></td>
                                    <td >&nbsp;</td>
                              </tr>
                               <tr>

                                <td style="text-align:left; ">Pallet Dimensions</td>
                                <td colspan="6"></td>
                              </tr>
                            </table>

                     </div>
              </div>

            <?php

          }

          }

          ?>

    </div>
</article>

<script>

  $(document).ready(function() {

  var sid="<?php echo $this->input->post('show_id'); ?>";
  var tid="<?php echo $this->input->post('teamleader_id'); ?>";

  var appenddata='';
  
    $.ajax({

                    url: baseurl + 'reports/getTeamleaderfoconsignment',

                    type: 'GET',

                    data: {show_id : sid},

                    dataType: 'json',

                    success: function (data) {

                      var icount=0;
                      $.each(data, function(idx, obj) {  
                          icount++;
                          });

                      var show_name=$("#show_id option:selected").text();

                      if(icount != 0)
                      {
                          if(tid=='all')
                          {
                            appenddata+="<option selected value='all'>All Teamleaders for show "+show_name+"</option>";

                          }
                          else
                          {
                            appenddata+="<option value='all'>All Teamleaders for show "+show_name+"</option>";
                          }
                           
                        $.each(data, function(idx, obj) {

                          if(tid==obj.id)
                          {
                             appenddata+="<option selected value="+obj.id+">"+obj.name+"</option>";
                          } 
                          else{
                             appenddata+="<option value="+obj.id+">"+obj.name+"</option>";
                          }                      
                           
                        });
                      }
                      else
                      {
                        if(tid=='')
                          {
                        appenddata+="<option selected value=''>"+"No team Leader Available"+"</option>";
                      }

                      }
 
                       $('#teamleader_id').html(appenddata);
                    }
                });

  });


</script>