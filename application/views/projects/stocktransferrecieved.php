
                        <?php
                        foreach ($confirmtransferstock as $key => $value) 
                        {

                            // echo "<pre>";
                            // print_r($confirmtransferstock);

                            ?>
                            <form id="transfered_confirmation_id_<?php echo $value[0]['id'];?>">

                            <div class="row">
                                <div class="col-md-12">
                                    <h6>Date & Time  : <?php echo $key; ?> </h6>
                                    <br>
                                </div>
                            </div>
                             <div class="row"  id="data-transfer-stock">
                            <?php
                            $colour_array = '';
                            $colourless_array = '';
                            foreach ($value as $key1 => $value1)
                            {
                                //echo '<pre>';print_r($value);die;
                                
                                        if($value1['color'] !='' && $value1['color'] !='null')
                                        {
                                            
                                            $colourless_array = "<tr><td style='color: purple'>".$value1['product_name']."</td><td style='color: purple'><div style='background-color:". $value1['color'].";height: 20px;width: 20px'></div></td><td style='color: purple'>".$value1['qty']."</td></tr>";
                                        }
                                        else
                                        {
                                            $colour_array .= "<tr><td style='color: purple'>".$value1['product_name']."</td><td style='color: purple'>".$value1['qty']."</td></tr>";
                                        }
                            }
                            ?>
                            <?php if($colourless_array!=''){?>
                            <div class="col-md-6">
                                 <table cellspacing="0" class="table table-bordered" width="100%">

                                <thead>

                                    <tr>

                                        <th>Product</th>
                                        <th>Color</th>
                                        <th  style="text-align: center;">Quantity</th>

                                      

                                    </tr>

                                </thead>

                                <tbody>
                                    <?php echo $colourless_array; ?>
                                </tbody>

                                </table>
                            </div>
                        <?php 
                    } ?>
                        <?php if($colour_array!=''){?>
                            <div class="col-md-6">
                                 <table cellspacing="0" class="table table-bordered" width="100%">

                                <thead>

                                    <tr>

                                        <th>Product</th>

                                        <th  style="text-align: center;">Quantity</th>

                                      

                                    </tr>

                                </thead>
                                    <?php echo $colour_array; ?>
                                <tbody>
                                </tbody>

                            </table>
                            </div>
                        <?php } ?>
                              <div class="col-md-12">
                           
                                <input data-id="<?php echo $value[0]['id'];?>" type="submit" style="font-weight: 600" name="transfer_all" value="Confirm All" class="btn btn-success confirm-stock" >
                                <input type="hidden" id="action-url-transfer-confirmed" value="projects/confirmedtransferstock" class="action-url">

                             </div>
                             </div>
                         </form>
                            <?php
                        }
                        ?>
