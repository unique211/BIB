<?php
$item_list = array();
foreach ($items as $item) {
    $item_list[$item->item_id] = $item->item_name;
}
?>
<div class="app-content content container-fluid">

    <div class="content-wrapper">

        <div class="content-header row">

            <div class="card card-block">

                <div id="notify" class="alert alert-success" style="display:none;">

                    <a href="#" class="close" data-dismiss="alert">&times;</a>



                    <div class="message"></div>

                </div>

                <div class="grid_3 grid_4">

                    <div class="header-block">

                        <h3 class="title">

                            Show : <?php echo $project['show_name']; ?>

                        </h3>

                        <p>



                            <span class="project_pending">Waiting</span>

                        </p>

                        <p>

                            Assigned to </p>

                        <p><?php

                            foreach ($emp as $row) {



                                echo '<span class="avatar"><img src="' . base_url() . '/userfiles/employee/thumbnail/' . $row['picture'] . '" title="' . $row['name'] . '" alt="' . $row['name'] . '"></span> &nbsp; ';
                            }

                            ?></p>
                    </div>

                    <p>&nbsp;</p>

                    <p>

                        <b><a href="#" class="btn btn-primary btn-sm rounded">

                                Show Id : <?php echo $project['show_id']; ?>

                            </a>

                            <a href="#" class="btn btn-primary btn-sm rounded">

                                Show Name : <?php echo $project['show_name']; ?>

                            </a>

                        </b>

                    </p>

                </div>

                <div class="card">

                    <div class="card-body">

                        <div class="card-block">



                            <ul class="nav nav-tabs nav-justified">



                                <li class="nav-item">

                                    <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" aria-controls="active" aria-expanded="true"><?php echo $this->lang->line('Summary') ?></a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" id="inventory1-tab" data-toggle="tab" href="#inventory1" aria-controls="inventory1" aria-expanded="true">Inventory</a>

                                </li>



                            </ul>

                            <div class="tab-content px-1 pt-1">


                                <div role="tabpanel" class="tab-pane fade active in" id="active" aria-labelledby="active-tab" aria-expanded="true">

                                    <ul class="nav nav-tabs nav-justified sidebar-green-backgrod">

                                        <li class="nav-item">

                                            <a class="nav-link active " id="active-tab" data-toggle="tab" href="#active" aria-controls="active" aria-expanded="true">Information</a>

                                        </li>

                                        <li class="nav-item">

                                            <a class="nav-link" id="location-tab" data-toggle="tab" href="#location" aria-controls="location"><?php echo $this->lang->line('Location') ?></a>

                                        </li>
                                        <li class="nav-item">

                                            <a class="nav-link" id="booths-tab" data-toggle="tab" href="#booths" aria-controls="booths"><?php echo $this->lang->line('Booth') ?></a>

                                        </li>

                                        <?php if ($this->aauth->get_user()->roleid == 5) { ?>

                                            <li class="nav-item">

                                                <a class="nav-link" id="booths-tab" data-toggle="tab" href="#booths" aria-controls="booths"><?php echo $this->lang->line('Booth') ?></a>

                                            </li>

                                        <?php } ?>

                                        <?php if (($this->aauth->get_user()->roleid == 3 and !empty($tlckeck)) or ($this->aauth->get_user()->roleid == 5)) { ?>
                                            <li class="nav-item">

                                                <a class="nav-link" id="salesperson1-tab" data-toggle="tab" href="#salesperson1" aria-controls="salesperson1"><?php echo $this->lang->line('Break timings') ?></a>

                                            </li>


                                            <li class="nav-item">

                                                <a class="nav-link" id="thread-tab" data-toggle="tab" href="#activities" aria-controls="activities"><?php echo $this->lang->line('Activities Log') ?></a>

                                            </li>

                                        <?php } ?>


                                    </ul>
                                    <div role="tabpanel" class="tab-pane fade active in " id="active" aria-labelledby="active-tab" aria-expanded="true">
                                    <div class="table-responsive col-sm-12">

                                        <table class="table">

                                            <tbody>

                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('Name') ?></th>

                                                    <td>

                                                        <p><?php echo $project['show_name'] ?></p>



                                                    </td>



                                                </tr>



                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('Status') ?></th>

                                                    <td>

                                                        <p><?php echo $this->lang->line($project['show_status']) ?></p>



                                                    </td>



                                                </tr>

                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('Attendece') ?></th>

                                                    <td>

                                                        <p><?php echo $project['show_attendence'] ?></p>



                                                    </td>



                                                </tr>

                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('Budget') ?></th>

                                                    <td>

                                                        <p><?php echo $project['show_budget'] ?></p>



                                                    </td>



                                                </tr>

                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('Quota') ?></th>

                                                    <td>

                                                        <p><?php echo $project['show_quota'] ?></p>



                                                    </td>



                                                </tr>



                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('Start Date') ?></th>

                                                    <td>

                                                        <p><?php echo dateformat($project['show_start_date']) ?></p>



                                                    </td>



                                                </tr>

                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('End Date') ?></th>

                                                    <td>

                                                        <p><?php echo dateformat($project['show_end_date']) ?></p>



                                                    </td>



                                                </tr>

                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('Setup Date') ?></th>

                                                    <td>

                                                        <p><?php echo dateformat($project['show_setup_date']) ?></p>



                                                    </td>



                                                </tr>

                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('Hourly rate') ?></th>

                                                    <td>

                                                        <p><?php echo $project['show_hourly_wage'] ?></p>



                                                    </td>



                                                </tr>

                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('Note') ?></th>

                                                    <td>

                                                        <p><?php echo $project['show_note'] ?></p>



                                                    </td>



                                                </tr>

                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('TL Commision') ?></th>

                                                    <td>

                                                        <p><?php echo $project['show_tl_commission'] ?></p>



                                                    </td>



                                                </tr>



                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('Tags') ?></th>

                                                    <td>

                                                        <p><?php echo $project['show_tag'] ?></p>



                                                    </td>



                                                </tr>



                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('Default Warehouse') ?></th>

                                                    <td>

                                                        <p>Main Warehouse</p>



                                                    </td>



                                                </tr>



                                                <tr>

                                                    <th scope="row"><?php echo $this->lang->line('Shipping Option') ?></th>

                                                    <td>

                                                        <p><?php

                                                            echo $project['show_shipping_option'];

                                                            ?></p>



                                                    </td>



                                                </tr>



                                                <tr>

                                                    <th scope="row">Communication</th>

                                                    <td>

                                                        <p><?php switch ($project['ptype']) {

                                                                case 0:

                                                                    echo 'None';

                                                                    break;

                                                                case 1:

                                                                    echo 'Emails to team';

                                                                    break;



                                                                case 2:

                                                                    echo 'Emails to team &  customer';

                                                                    break;
                                                            }



                                                            ?></p>



                                                    </td>



                                                </tr>



                                            </tbody>

                                        </table>

                                    </div>
                                    </div>

 <!-- Location -->

 <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab" aria-expanded="false">


<div class="card card-block">

    <div id="notify" class="alert alert-success" style="display:none;">

        <a href="#" class="close" data-dismiss="alert">&times;</a>



        <div class="message"></div>

    </div>

    <div class="grid_3 grid_4">





        <form method="post" id="data_form" class="form-horizontal <?php if ($this->aauth->get_user()->roleid == 3) {
                                                                        echo 'disablefield';
                                                                    } ?>">



            <h5><?php echo $this->lang->line('Location') ?> Info</h5>

            <hr>

            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="contact_person"><b>Contact Person </b><i style="color:red">*</i></label>

                <div class="col-sm-6">

                    <input type="text" placeholder="Contact Person" class="form-control " name="contact_person" value="<?php echo $location_details[0]['contact_person']; ?>" />

                </div>

            </div>

            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="contact_number"><b>Contact Number </b><i style="color:red">*</i></label>

                <div class="col-sm-6">

                    <input type="text" placeholder="Contact Number" class="form-control " name="contact_number" value="<?php echo $location_details[0]['contact_number']; ?>" />



                </div>

            </div>

            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="extension"><b>Extension (if any)</b></label>

                <div class="col-sm-6">

                    <input type="text" placeholder="Extension" class="form-control" name="extension" value="<?php echo $location_details[0]['extension']; ?>" />

                </div>

            </div>



            <div class="form-group row">



                <label class="col-sm-2 col-form-label" for="indoor_outdoor"><b><?php echo $this->lang->line('Indoor') ?>/<?php echo $this->lang->line('Outdoor') ?><i style="color:red">*</i></b></label>

                <div class="col-sm-4">

                    <select name="indoor_outdoor" class="form-control ">



                        <option value="1" <?php if ($location_details[0]['type'] == 1) echo 'selected'; ?>>Indoor</option>

                        <option value="2" <?php if ($location_details[0]['type'] == 2) echo 'selected'; ?>>Outdoor</option>





                    </select>

                </div>





            </div>





            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="address"><b><?php echo $this->lang->line('Address') ?><i style="color:red">*</i></b></label>

                <div class="col-sm-6">

                    <textarea placeholder="Address" class="form-control " name="address"><?php echo $location_details[0]['address']; ?></textarea>

                </div>

            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="Flooring"><b>Flooring</b></label>
                <div class="col-sm-6">
                    <input type="radio" name="required" value="Required" <?php if ($location_details[0]['flooring'] == 'Required') echo 'checked'; ?>> Required &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="required" value="Not Required" <?php if ($location_details[0]['flooring'] == 'Not Required') echo 'checked'; ?>> Not Required<br>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="Electricity"><b>Electricity</b></label>
                <div class="col-sm-6">
                    <input type="radio" name="electricity" value="Provided" <?php if ($location_details[0]['electricity'] == 'Provided') echo 'checked'; ?>> Provided &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="electricity" value="Not Provided" <?php if ($location_details[0]['electricity'] == 'Not Provided') echo 'checked'; ?>> Not Provided<br>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="Website"><b>Website</b></label>

                <div class="col-sm-6">

                    <input type="text" placeholder="Website" class="form-control" name="website" value="<?php echo $location_details[0]['website']; ?>" />

                </div>

            </div>


            <div class="form-group row">


                <!-- <div  id="googleMap" style="width:100%;height:400px;"></div> -->
                <label class="col-sm-2 col-form-label" for="Upload Booth Map"><b>Upload Booth Map</b></label>

                <div class="col-sm-6">

                    <input type="file" class="form-control input-md" id="uploadFile" name="uploadFile" accept="image/*">

                    <input type="hidden" id="file_attachother" name="file_attachother" value="<?php if (isset($location_details[0]['location'])) {
                                                                                                    echo $location_details[0]['location'];
                                                                                                } ?>" required>

                    <div id="msg"><?php if (isset($location_details[0]['location'])) {
                                        echo $location_details[0]['location'];
                                    } ?></div>

                </div>

            </div>

            <div class="form-group row">

                <div id="containerother_kyc">
                    <?php if (isset($location_details[0]['location'])) {
                        ?>

                    <img id="myImage" width="500px" height="300px" src="<?php echo base_url() . 'assets/booth_img/' . $location_details[0]['location']; ?>" />

                    <?php  } ?>
                </div>

            </div>
            <div class="form-group row">

                <div class="col-sm-4">

                    <div class="form-group row">

                        <div class="col-sm-10">

                            <input type="button" class="btn btn-success sub-btn" value="<?php echo $this->lang->line('Add') ?> " id="submit-data123" data-loading-text="Creating...">

                        </div>

                    </div>

                    <input type="hidden" value="projects/addlocationforshow" id="action-url">

                    <input type="hidden" value="<?php echo $project['id']; ?>" name="nid">

                </div>

            </div>



        </form>

    </div>

</div>

</div>

<!-- Location -->


                                </div>


                                

                                <!-- Inventory  -->

                                <div class="tab-pane fade " id="inventory1" role="tabpanel" aria-labelledby="inventory1-tab" aria-expanded="false">

                                    <div class="card">

                                        <div class="card-body">

                                            <div class="card-block">

                                                <ul class="nav nav-tabs nav-justified sidebar-green-backgrod">

                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="packinglistrequest-tab" data-toggle="tab" href="#packinglistrequest" aria-controls="packinglistrequest">

                                                            Products

                                                        </a>

                                                    </li>



                                                    <li class="nav-item">
                                                        <a class="nav-link " id="confirm_packinglist-tab" data-toggle="tab" href="#confirm_packinglist" aria-controls="confirm_packinglist">

                                                            Confirm Receipt - Requisition List

                                                        </a>

                                                    </li>


                                                    <li class="nav-item">

                                                        <a class="nav-link" id="salses_packinglist-tab" data-toggle="tab" href="#salses_packinglist" aria-controls="salses_packinglist">Requested Requisition List </a>



                                                    </li>



                                                </ul>

                                                <div class="tab-content px-1 pt-1">

                                                    <div class="tab-pane fade active in " id="packinglistrequest" role="tabpanel" aria-labelledby="packinglistrequest-tab" aria-expanded="false">

                                                        <form id="data_form_packinglist_request_sl">

                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <br>

                                                                    <label class="col-sm-2 col-form-label" for="name"><b>Select Teamleader</b></label>

                                                                    <div class="col-sm-5">
                                                                        <select class="form-control" name="teamleader">

                                                                            <?php
                                                                            if (empty($teamleader)) {
                                                                                echo "<option value='' >No Team Leader Available</option>";
                                                                            } else {

                                                                                foreach ($teamleader as $tl) { ?>
                                                                                    <option value="<?php echo $tl['tlid'];  ?>"><?php echo $tl['name']; ?></option>

                                                                            <?php  }
                                                                            } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">

                                                                <div class="col-md-6">

                                                                    <table cellspacing="0" class="table table-bordered" width="100%">

                                                                        <thead>

                                                                            <th>Product</th>

                                                                            <th colspan="2">Quantity</th>

                                                                        </thead>

                                                                        <tbody>



                                                                            <?php

                                                                            if (empty($getProductBynotColor)) {

                                                                                ?>
                                                                                <tr>
                                                                                    <td colspan="3" style="text-align: center;">No Product Available</td>
                                                                                </tr>

                                                                                <?php
                                                                                } else {

                                                                                    $pre_item = '';
                                                                                    foreach ($getProductBynotColor as $pr) {
                                                                                        $new_item = $pr['item_id'];
                                                                                        if ($pre_item != $new_item) {
                                                                                            $pre_item = $new_item;
                                                                                            echo '<tr><td colspan="2" style="text-align:center;"><b>' . $item_list[$new_item] . '</b></td></tr>';
                                                                                        }
                                                                                        ?>

                                                                                    <tr>

                                                                                        <td style="color:purple"><?php echo $pr['product_name']; ?>

                                                                                            <input type="hidden" value="<?php echo $pr['pid']; ?>" name="<?php echo 'product[' . $pr['pid'] . '][id]' ?>" />

                                                                                        </td>

                                                                                        <td <?php if ($this->aauth->get_user()->roleid == 5) { ?> colspan='2' <?php } ?>><input name="<?php echo 'product[' . $pr['pid'] . '][requested_qty]' ?>" class="ckqty" type="number" <?php if ($this->aauth->get_user()->roleid == 5) { ?> readonly <?php } ?> max="<?php echo $pr['qty']; ?>" style="width: 50px;" min="0" value="1" id="<?php echo $pr['pid'];  ?>" /></td>

                                                                                        <?php if ($this->aauth->get_user()->roleid == 5) { ?>

                                                                                            <td>

                                                                                                <input type="number" id="<?php echo $pr['pid'];  ?>" <?php if ($this->aauth->get_user()->roleid == 3) { ?> class="ckqty" max="<?php echo $pr['qty']; ?>" readonly <?php } ?> style="width: 50px" name="<?php echo 'product[' . $pr['pid'] . '][approved_qty]' ?>" min="0" value="1" /></td>

                                                                                        <?php } ?>

                                                                                    </tr>

                                                                            <?php

                                                                                }
                                                                            }

                                                                            ?>

                                                                        </tbody>

                                                                    </table>

                                                                </div>

                                                                <div class="col-md-6">

                                                                    <table style="margin-left: 20px" class="table table-bordered  table-responsive" width="100%">

                                                                        <thead>

                                                                            <tr>

                                                                                <th>Product</th>

                                                                                <th>Color</th>

                                                                                <th colspan="2" style="text-align: center;">Quantity</th>



                                                                            </tr>

                                                                        </thead>

                                                                        <tbody>

                                                                            <?php
                                                                            if (empty($getProductByColor)) {

                                                                                ?>
                                                                                <tr>
                                                                                    <td colspan="4" style="text-align: center;">No Product Available</td>
                                                                                </tr>
                                                                                <?php } else {

                                                                                    $pre_item = '';
                                                                                    foreach ($getProductByColor as $pr1) {
                                                                                        $new_item = $pr1['item_id'];
                                                                                        if ($pre_item != $new_item) {
                                                                                            $pre_item = $new_item;
                                                                                            echo '<tr><td colspan="2" style="text-align:center;"><b>' . $item_list[$new_item] . '</b></td></tr>';
                                                                                        }

                                                                                        ?>

                                                                                    <tr>

                                                                                        <td style="color:purple;">

                                                                                            <?php echo $pr1['product_name']; ?>

                                                                                            <input type="hidden" class="ckqty" value="<?php echo $pr1['pid']; ?>" name="<?php echo 'product[' . $pr1['pid'] . '][id]' ?>" />

                                                                                        </td>

                                                                                        <td style="width: 30px">

                                                                                            <div style="background-color:<?php echo $pr1['color']; ?>;height: 20px;width: 20px ">

                                                                                            </div>

                                                                                        </td>

                                                                                        <td <?php if ($this->aauth->get_user()->roleid == 5) { ?> colspan='2' <?php } ?>>

                                                                                            <input id="<?php echo $pr1['pid'];  ?>" class="ckqty" name="<?php echo 'product[' . $pr1['pid'] . '][requested_qty]' ?>" type="number" max="<?php echo $pr1['qty']; ?>" <?php if ($this->aauth->get_user()->roleid == 5) { ?> readonly <?php } ?> style="width: 50px;" min="0" value="1" />

                                                                                        </td>
                                                                                        <?php if ($this->aauth->get_user()->roleid == 5) { ?>

                                                                                            <td>

                                                                                                <input id="<?php echo $pr1['pid'];  ?>" class="ckqty" max="<?php echo $pr1['qty']; ?>" type="number" <?php if ($this->aauth->get_user()->roleid == 3) { ?> readonly <?php } ?> style="width: 50px" name="<?php echo 'product[' . $pr1['pid'] . '][approved_qty]' ?>" min="0" value="1" />

                                                                                            </td>
                                                                                        <?php } ?>



                                                                                    </tr>

                                                                            <?php }
                                                                            } ?>

                                                                        </tbody>

                                                                    </table>

                                                                </div>

                                                            </div>

                                                            <div class="row">

                                                                <div class="col-md-12">

                                                                    <input type="submit" id="submit-packinglist-sl" class="btn btn-success margin-bottom" value="Apply" data-loading-text="Adding..." />

                                                                    <input type="hidden" id="action-url-packinglist-sl" value="projects/requestpackinglistsl" class="action-url">

                                                                    <input type="hidden" value="<?php echo $_GET['id']; ?>" name="project">

                                                                </div>

                                                            </div>

                                                        </form>
                                                    </div>






                                                    <div class="tab-pane fade " id="salses_packinglist" role="tabpanel" aria-labelledby="salses_packinglist-tab" aria-expanded="false">

                                                        <div class="row">
                                                            <div class="row">

                                                                <div class="col-md-12">

                                                                    <table id="salesperson_request_list" cellspacing="0" style="width: 100%;text-align: center;  ">

                                                                        <thead>

                                                                            <tr>

                                                                                <th></th>
                                                                                <th>#</th>

                                                                                <th>Product Name</th>

                                                                                <th>Requested Quantity</th>

                                                                                <th>Approved Quantity</th>

                                                                                <th>Requested At</th>

                                                                                <th>Approved At</th>

                                                                                <th>Confirm At</th>

                                                                                <th>Action</th>

                                                                            </tr>

                                                                        </thead>

                                                                        <tbody style="text-align: center;">
                                                                        </tbody>

                                                                    </table>



                                                                </div>



                                                            </div>



                                                        </div>

                                                    </div>

                                                    <!--- Confrim -->



                                                    <div class="tab-pane fade" id="confirm_packinglist" role="tabpanel" aria-labelledby="confirm_packinglist-tab" aria-expanded="false">

                                                        <table id="confirm_request_sl" style="width: 100%">

                                                            <thead>

                                                                <tr>

                                                                    <th class="priority-1">&nbsp;</th>
                                                                    <th>#</th>

                                                                    <th>Product Name</th>

                                                                    <th>Requested Quantity</th>

                                                                    <th>Approved Quantity</th>

                                                                    <th>Requested To</th>

                                                                    <th>Requested At</th>

                                                                    <th>Approved At</th>

                                                                    <th>Action</th>

                                                                </tr>

                                                            </thead>

                                                            <tbody>
                                                            </tbody>

                                                        </table>



                                                    </div>



                                                    <!-- Confrim -->

                                                </div>

                                            </div>



                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- Inventory  -->

                            <!-- PACKING LIST -->

                        </div>

                    </div>

                </div>

            </div>

            <div id="task_model" class="modal fade" role="dialog">

                <div style="width: 800px;margin-left: 20%;margin-top: 5%">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;

                            </button>

                            <h3 class="modal-title" id="task_title">History of King Pillow Product</h3>

                        </div>



                        <div>

                            <table class="table table-hover">

                                <thead>

                                    <th>#</th>

                                    <th>Requested Date</th>

                                    <th>Requested Quantity</th>

                                    <th>Approved Quantity</th>

                                    <th>Approved Date</th>

                                    <th>Status</th>

                                </thead>

                                <tbody>

                                    <tr>

                                        <td>1</td>



                                        <td>15/5/2019</td>

                                        <td>20</td>

                                        <td>15</td>

                                        <td>15/5/2019</td>

                                        <td><a class="btn btn-primary btn-sm rounded"> Approved and Pending</a></td>

                                    </tr>

                                    <tr>

                                        <td>2</td>



                                        <td>14/5/2019</td>

                                        <td>20</td>

                                        <td>15</td>

                                        <td>15/5/2019</td>

                                        <td><a class="btn btn-success btn-sm rounded" style="font-size: 20px"><i class="icon-save"></i></a></td>

                                    </tr>

                                    <tr>

                                        <td>3</td>



                                        <td>13/5/2019</td>

                                        <td>20</td>

                                        <td>15</td>

                                        <td>14/5/2019</td>

                                        <td><a class="btn btn-success btn-sm rounded" style="font-size: 20px"><i class="icon-save"></i></a></td>

                                    </tr>

                                    <tr>

                                        <td>3</td>



                                        <td>13/5/2019</td>

                                        <td>20</td>

                                        <td>15</td>

                                        <td></td>

                                        <td><a class="btn btn-danger btn-sm rounded"> Not Approved</a></td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>






</div>
<!-- 38 Approve Sales Person Request -->
<div id="delete_model_38" class="modal fade">

    <form id="mform_38">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Confirmation Message </h4>

                </div>

                <div class="modal-body">

                    <p>Are you sure you want to Confirm product Qantity ? </p>

                </div>

                <div class="modal-footer">

                    <input type="hidden" id="object-id_38" value="" name="object_id">


                    <input type="text" style="display: none" id="show_id" name="show_id" value="<?php echo $_GET['id']; ?>">

                    <input type="hidden" id="approved_qty_38" value="" name="approve_qty">

                    <input type="hidden" id="action-url_38" value="projects/confirm_reciept_by_sl">

                    <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm" id="delete-confirm_38">Confirm</button>

                    <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Cancel') ?></button>

                </div>

            </div>

        </div>

    </form>

</div>

<!-- 63 Approve Sales Person Request -->
<div id="delete_model_63" class="modal fade">

    <form id="mform_63">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Confirmation Message </h4>

                </div>

                <div class="modal-body">

                    <p>Are you sure you want to Confirm product Qantity ? </p>

                </div>

                <div class="modal-footer">

                    <input type="hidden" id="object-id_63" value="" name="object_id">

                    <input type="hidden" id="approved_qty_63" value="" name="approve_qty">

                    <input type="text" style="display: none" id="show_id" name="show_id" value="<?php echo $_GET['id']; ?>">

                    <input type="hidden" id="action-url_63" value="projects/confirm_reciept_by_sl_to_tl">

                    <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm" id="delete-confirm_63">Confirm</button>

                    <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Cancel') ?></button>

                </div>

            </div>

        </div>

    </form>

</div>

<script type="text/javascript">
    $(document).ready(function() {


        $('#salesperson_request_list').DataTable({

            "ajax": "<?php echo site_url('projects/salesperson_request_list?id=' . $_GET['id']) ?>",
            "oLanguage": {
                "sEmptyTable": "There is no Data available"
            },
            'createdRow': function(row, data, dataIndex) {

                $(row).attr('data-block', '0');
            },
            "columnDefs": [{
                'targets': [0],
                'visible': false,
            }],


        });

        $('#tl_pr_request_table').DataTable({});

        $('#confirm_request_sl').DataTable({

            "ajax": "<?php echo site_url('projects/salesperson_request_confirm?id=' . $_GET['id']) ?>",
            "oLanguage": {
                "sEmptyTable": "There is no Data available"
            },
            'createdRow': function(row, data, dataIndex) {
                $(row).attr('data-block', '0');
            },
            "columnDefs": [{
                'targets': [0],
                'visible': false,
            }],


        });



    });
</script>