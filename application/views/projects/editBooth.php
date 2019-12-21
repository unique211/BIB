<article class="content">



    <div class="card card-block">



        <div id="notify" class="alert alert-success" style="display:none;">



            <a href="#" class="close" data-dismiss="alert">&times;</a>







            <div class="message"></div>



        </div>



        <div class="grid_3 grid_4">











            <form method="post" id="data_form" class="form-horizontal">







                <h3>Edit Booth Details </h3>



                 <p>



                    <b><a href="#" class="btn btn-primary btn-sm rounded">



                                          <?php echo $booth['show_id'];?>



                                </a>  



                                <a href="#" class="btn btn-primary btn-sm rounded">



                                             <?php echo $booth['show_name'] ?>



                                </a></b>



                </p>



                <hr>







                <div class="form-group row">







                    <label class="col-sm-2 col-form-label"



                           for="size"><?php echo $this->lang->line('Sizes') ?><i style="color:red">*</i></label>







                    <div class="col-sm-6">



                        <input type="text" placeholder="Size"



                               class="form-control margin-bottom required" value="<?php echo $booth['size']; ?>" name="size">



                    </div>



                </div>







             <!--   <div class="form-group row">







                    <label class="col-sm-2 col-form-label"



                           for="size"><?php echo $this->lang->line('Cost') ?><i style="color:red">*</i></label>







                    <div class="col-sm-6">



                        <input type="text" placeholder="Cost"



                               class="form-control margin-bottom  required" value="<?php echo $booth['cost']; ?>" name="cost">



                    </div>



                </div>-->







                <div class="form-group row">







                    <label class="col-sm-2 col-form-label"



                           for="size"><?php echo $this->lang->line('Description') ?><i style="color:red">*</i></label>







                    <div class="col-sm-6">



                        <textarea class="form-control required" name="description" placeholder="Description"> <?php echo $booth['description']; ?></textarea>



                    </div>



                </div>







                <div class="form-group row">







                    <label class="col-sm-2 col-form-label"



                           for="size"><?php echo $this->lang->line('Products') ?><i style="color:red">*</i></label>







                    <div class="col-sm-6">



                        <select class="form-control required" name="product">



                           <?php



                           foreach ($products as $row) {



                                $cid = $row['id'];

                                $title = $row['title'];

                             




                                if($cid==$booth['product_id'])

                                {

                                     echo "<option selected value='$cid'>$title</option>";

                                }

                                else

                                {

                                     echo "<option value='$cid'>$title</option>";

                                }

                               



                            }



                            ?>



                        </select>



                    </div>



                </div>







                <div class="form-group row">







                    <label class="col-sm-2 col-form-label"



                           for="size">Team Leaders</label>







                    <div class="col-sm-6">



                        <select class="form-control required select-box" multiple=""  name="teamleader[]">



                         <?php

                           foreach ($emp as $row) {

                                $cid = $row['eid'];

                                $title = $row['name'];

                                if($booth['teamleader_id']==$cid)
                                {
                                     echo "<option selected value='$cid'>$title</option>";
                                }
                                else
                                {
                                    echo "<option value='$cid'>$title</option>";

                                }

                                
                            }

                            // foreach($sales[0] as $sl)
                            // {
                            //         $sid=$sl['id'];
                            //         $sname=$sl['name'];

                            //         if($booth['teamleader_id']==$sid)
                            //         {
                            //               echo "<option selected value='$sid'>$sname</option>";
                            //         }
                            //         else
                            //         {
                            //             echo "<option  value='$sid'>$sname</option>";
                            //         }

                                   
                            // }

                            ?>



                        </select>



                    </div>



                </div>



            



                <div class="form-group row">







                    <label class="col-sm-2 col-form-label"></label>







                    <div class="col-sm-4">



                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"



                               value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">



                        <input type="hidden" value="/projects/editshowbooth" id="action-url">



                         <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">



                    </div>



                </div>











            </form>



        </div>



    </div>



</article>

<script type="text/javascript">
    
     $('.select-box').select2();

</script>







