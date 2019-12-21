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

                            Show : <?php echo $project['show_name'] ?>

                        </h3>

                        <p><?php echo $this->lang->line('Status') ?>: <span class="project_<?php echo $project['show_status'] ?>"><?php echo $this->lang->line($project['show_status']) ?></span>

                        </p>

                        <p>

                            Assigned to</p>

                        <p><?php

                            foreach ($emp as $row) {



                                echo '<span class="avatar"><img src="' . base_url() . '/userfiles/employee/thumbnail/' . $row['picture'] . '" title="' . $row['name'] . '" alt="' . $row['name'] . '"></span> &nbsp; ';
                            }

                            ?></p>
                    </div>

                    <p>&nbsp;</p>

                    <div class="row">

                        <div class="col-xl-3 col-lg-6 col-xs-6">

                            <div class="card">

                                <div class="card-body">

                                    <div class="card-block">

                                        <div class="media">

                                            <div class="media-body text-xs-left">

                                                <h3 class="pink" id="dash_0"><?php echo $due_task; ?></h3>

                                                <span><?php echo $this->lang->line('Due') ?></span>

                                            </div>

                                            <div class="media-right media-middle">

                                                <i class="icon-clock3 pink font-large-2 float-xs-right"></i>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-3 col-lg-6 col-xs-6">

                            <div class="card">

                                <div class="card-body">

                                    <div class="card-block">

                                        <div class="media">

                                            <div class="media-body text-xs-left">

                                                <h3 class="indigo" id="dash_1"> <?php echo $progress_task; ?></h3>

                                                <span><?php echo $this->lang->line('Progress') ?></span>

                                            </div>

                                            <div class="media-right media-middle">

                                                <i class="icon-spinner5 indigo font-large-2 float-xs-right"></i>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-3 col-lg-6 col-xs-6">

                            <div class="card">

                                <div class="card-body">

                                    <div class="card-block">

                                        <div class="media">

                                            <div class="media-body text-xs-left">

                                                <h3 class="green" id="dash_2"><?php echo $done_task; ?></h3>

                                                <span><?php echo $this->lang->line('Done') ?></span>

                                            </div>

                                            <div class="media-right media-middle">

                                                <i class="icon-clipboard2 green font-large-2 float-xs-right"></i>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-3 col-lg-6 col-xs-6">

                            <div class="card">

                                <div class="card-body">

                                    <div class="card-block">

                                        <div class="media">

                                            <div class="media-body text-xs-left">

                                                <h3 class="deep-cyan" id="dash_6"><?php echo $total_task; ?></h3>

                                                <span><?php echo $this->lang->line('Total') ?></span>

                                            </div>

                                            <div class="media-right media-middle">

                                                <i class="icon-stats-bars22 deep-cyan font-large-2 float-xs-right"></i>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="row">

                        <div class="col-sm-12">

                            <p>

                                <b><a style="color: white;" class="btn btn-primary btn-sm rounded">

                                        Show Id : <?php echo $project['show_id']; ?>

                                    </a>

                                    <a style="color: white;" class="btn btn-primary btn-sm rounded">

                                        Show Name : <?php echo $project['show_name']; ?>

                                    </a>

                                    <?php if (!empty($tlckeck)) { ?>

                                    <a href="<?php echo base_url('transactions/add?id=' . $project['id'] . '&d=1') ?>" class="btn btn-success btn-sm rounded">Expense</a>

                                    <?php } ?>


                                </b>

                            </p>

                        </div>

                    </div>





                </div>



                <input type="hidden" id="dashurl" value="projects/task_stats?id=<?php echo $project['id']; ?>">

                <div class="card">

                    <div class="card-body">

                        <div class="card-block">

                            <p></p>

                            <ul class="nav nav-tabs nav-justified">


                                <li class="nav-item">

                                    <a class="nav-link active" id="active1-tab" data-toggle="tab" href="#active1" aria-controls="active1" aria-expanded="true"><?php echo $this->lang->line('Summary') ?></a>

                                </li>



                                <?php if ($this->aauth->get_user()->roleid == 3 and !empty($tlckeck)) { ?>

                                <li class="nav-item">

                                    <a class="nav-link" id="inventory1-tab" data-toggle="tab" href="#inventory1" aria-controls="inventory1">Inventory</a>

                                </li>

                                <?php } ?>



                                <!-- reports --->

                                <?php if ($this->aauth->get_user()->roleid == 5) { ?>

                                <li class="nav-item">

                                    <a class="nav-link" id="reports1-tab" data-toggle="tab" href="#reports1" aria-controls="reports">Attendees</a>

                                </li>

                                <?php }  ?>

                                <!-- reports --->


                                <?php if (($project['show_task_communication'] == 0  and !empty($tlckeck)) or ($project['show_task_communication'] == 0  or $this->aauth->get_user()->roleid == 5)) { ?>

                                <li class="nav-item">

                                    <a class="nav-link" id="communication-tab" data-toggle="tab" href="#communication" aria-controls="communication"><?php echo $this->lang->line('Communication') ?></a>

                                </li>

                                <?php } ?>

                                <?php if (($this->aauth->get_user()->roleid == 3 and !empty($tlckeck)) or ($this->aauth->get_user()->roleid == 5)) { ?>
                                <li class="nav-item">

                                    <a class="nav-link" id="invoices_main-tab" data-toggle="tab" href="#invoices_main" aria-controls="invoices_main">Orders and Cash</a>

                                </li>

                                <?php } ?>

                                <!--- Business Owner Inventory -->
                                <?php if ($this->aauth->get_user()->roleid == 5) { ?>

                                <li class="nav-item">

                                    <a class="nav-link" id="inventorybo-tab" data-toggle="tab" href="#inventorybo" aria-controls="inventorybo">Inventory</a>

                                </li>
                                <?php } ?>


                                <?php if (($this->aauth->get_user()->roleid == 3 and !empty($tlckeck)) or ($this->aauth->get_user()->roleid == 5)) { ?>
                                <li class="nav-item">

                                    <a class="nav-link" id="linkOpt-tab" data-toggle="tab" href="#files" aria-controls="files"><?php echo $this->lang->line('Files') ?></a>

                                </li>

                                <?php } ?>

                            </ul>

                            <div class="tab-content px-1 pt-1">

                                <!-- Summary Main -->

                                <div role="tabpanel" class="tab-pane fade active in" id="active1" aria-labelledby="active1-tab" aria-expanded="true">

                                    <div class="card">

                                        <div class="card-body">

                                            <div class="card-block">



                                                <ul class="nav nav-tabs nav-justified sidebar-green-backgrod">

                                                    <li class="nav-item">

                                                        <a class="nav-link active " id="active-tab" data-toggle="tab" href="#active" aria-controls="active" aria-expanded="true">Information</a>

                                                    </li>

                                                    <li class="nav-item">

                                                        <a class="nav-link" id="location-tab" data-toggle="tab" href="#location" aria-controls="location"><?php echo $this->lang->line('Location') ?></a>

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
                                                <div style="background-color: #f5f5f5" class="tab-content px-1 pt-1">


                                                    <!--  Summary  -->

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

                                                                        <th scope="row"><?php echo $this->lang->line('Attendance') ?></th>

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

                                                                            <p><?php switch ($project['show_task_communication']) {

                                                                                    case 0:

                                                                                        echo 'Yes';

                                                                                        break;

                                                                                    case 1:

                                                                                        echo 'No';

                                                                                        break;
                                                                                }



                                                                                ?></p>



                                                                        </td>



                                                                    </tr>



                                                                </tbody>

                                                            </table>

                                                        </div>



                                                    </div>

                                                    <!--  Summary  -->

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

                                                                        <label class="col-sm-2 col-form-label" for="contact_email"><b>Contact Email </b><i style="color:red">*</i></label>

                                                                        <div class="col-sm-6">

                                                                            <input type="email" placeholder="Contact Email" class="form-control " name="contact_email" value="<?php echo $location_details[0]['contact_email']; ?>" />



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

                                                    <!-- BOOTH -->

                                                    <div class="tab-pane fade" id="booths" role="tabpanel" aria-labelledby="booths-tab" aria-expanded="false">

                                                        <p><a href="<?php echo base_url('projects/addshowbooth?id=' . $project['id']) ?>" class="btn btn-primary btn-sm rounded">

                                                                <?php echo $this->lang->line('Add new') . ' ' . $this->lang->line('Booth') ?>

                                                            </a>
                                                        </p>

                                                        <table id="boothTable" class="display " cellspacing="0" width="100%">

                                                            <thead>

                                                                <tr>

                                                                    <th class="priority-3">#</th>



                                                                    <th class="priority-1"><?php echo $this->lang->line('Size') ?></th>

                                                                    <th class="priority-5"><?php echo $this->lang->line('Cost') ?></th>

                                                                    <th class="priority-2"><?php echo $this->lang->line('Description') ?></th>

                                                                    <th class="priority-6"><?php echo $this->lang->line('Product Category') ?></th>

                                                                    <th class="priority-7"><?php echo $this->lang->line('Team Leader') ?></th>

                                                                    <th class="priority-9">Action</th>



                                                                </tr>

                                                            </thead>

                                                            <tbody>
                                                            <!-- <?php print_r ($boothinfo); ?>    -->
                                                                     <?php $count =0;foreach($boothinfo as $bothdata){$count =$count+1;?>
                                                                       
                                                                            <tr>
                                                                                <td><?php echo $count ?></td>
                                                                                <td><?php echo $bothdata['size']; ?></td>
                                                                                <td><?php echo $bothdata['cost']; ?></td>
                                                                                <td><?php echo $bothdata['description']; ?></td>
                                                                                <td><?php echo $bothdata['title']; ?></td>
                                                                                <td><?php echo $bothdata['teamleader_id']; ?></td>
                                                                                <td><?php echo '<a class="btn btn-info btn-sm" href="' . base_url() . 'projects/editbooth?id=' . $bothdata['boothid'] . '" data-object-id="' . $bothdata['boothid'] . '"> <i class="icon-pencil"></i> </a>&nbsp;<a class="btn btn-brown btn-sm delete-custom" data-object-id="' . $booth['boothid'] . '" data-did="6"> <i class="icon-trash-o"></i> </a>' ?></i>
                                                                         </td>
                                                                            </tr>
                                                                    <?php }?> 


                                                            </tbody>

                                                        </table>

                                                    </div>

                                                    <!-- Booth -->

                                                    <!-- SALES PERSON -->



                                                    <div class="tab-pane fade" id="salesperson1" role="tabpanel" aria-labelledby="salesperson1-tab" aria-expanded="false">

                                                        <p>


                                                            <a href="addworkingtime?id=<?php echo $project['id']; ?>" class="btn btn-primary btn-sm rounded">

                                                                Add Working Time



                                                            </a>

                                                        </p>


                                                        <table id="SalesPersonTable" class="display" cellspacing="0" width="100%">

                                                            <thead>

                                                                <tr>

                                                                    <th>#</th>

                                                                    <th><?php echo $this->lang->line('Sales Person Name') ?></th>

                                                                    <th>Action</th>



                                                                </tr>

                                                            </thead>

                                                            <tbody>


                                                                <?php

                                                                if (count($emp[0]) != 0) {


                                                                    $n = 0;
                                                                    foreach ($emp as $sal) {

                                                                        ?>
                                                                <tr>
                                                                    <td><?php echo ++$n; ?></td>
                                                                    <td><?php echo $sal[0]['name']; ?></td>
                                                                    <td>

                                                                        <?php
                                                                                $cco = 0;
                                                                                foreach ($getsalespersonfrombreaktime as $sales) {
                                                                                    if ($sales['salesperson'] == $sal[0]['id']) {
                                                                                        $cco++;
                                                                                        ?>
                                                                        <a class="btn btn-info btn-sm" href="<?php echo base_url(); ?>projects/editbreaktime?id=<?php echo $sales['salesperson']; ?>&show_id=<?php echo $_GET['id']; ?>&asid=<?php echo $sal[0]['id']; ?>">
                                                                            <i class="icon-pencil"></i>
                                                                        </a>
                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>

                                                                        <?php if ($cco == 0) {
                                                                                    foreach ($getsalespersonfrombreaktime as $sales) {
                                                                                        if ($sales['salesperson'] == 0) {
                                                                                            ?>
                                                                        <a class="btn btn-info btn-sm" href="<?php echo base_url(); ?>projects/editbreaktime?id=<?php echo $sales['salesperson']; ?>&show_id=<?php echo $_GET['id']; ?>&asid=<?php echo $sal[0]['id']; ?>">
                                                                            <i class="icon-pencil"></i>
                                                                        </a>
                                                                        <?php   }
                                                                                    }
                                                                                } ?>


                                                                        &nbsp;<a class="btn-brown btn-sm delete-break-time" salesperson_id="<?php echo $sal[0]['id']; ?>" show_id="<?php echo $project['id']; ?>" href="#"> <i class="icon-trash-o"></i> </a>
                                                                    </td>
                                                                </tr>



                                                                <?php }
                                                                }
                                                                ?>



                                                            </tbody>



                                                        </table>







                                                    </div>



                                                    <!--  SALES PERSON  -->

                                                    <!--activities-->

                                                    <div class="tab-pane fade" id="activities" role="tabpanel" aria-labelledby="activities-tab" aria-expanded="false">

                                                        <?php foreach ($activities as $row) { ?>





                                                        <div class="form-group row">





                                                            <div class="col-sm-10">

                                                                <?php



                                                                    echo '- ' . $row['value'] . '<br><br>';





                                                                    ?>

                                                            </div>

                                                        </div>

                                                        <?php }

                                                        ?>

                                                    </div>

                                                    <!--activities-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <!-- Summary Main -->



                                <!-- REPOTS -->

                                <div role="tabpanel" class="tab-pane fade " id="reports1" aria-labelledby="reports1-tab" aria-expanded="true">


                                    <div class="card">

                                        <div class="card-body">

                                            <div class="card-block">



                                                <ul class="nav nav-tabs nav-justified sidebar-green-backgrod">

                                                    <?php if ($this->aauth->get_user()->roleid == 5) { ?>

                                                    <li class="nav-item">

                                                        <a class="nav-link active" id="teamleader-tab" data-toggle="tab" href="#teamleader" aria-controls="teamleader"><?php echo $this->lang->line('Team Leader') ?></a>

                                                    </li>

                                                    <?php } ?>

                                                    <?php if ($this->aauth->get_user()->roleid == 5) { ?>

                                                    <li class="nav-item">

                                                        <a class="nav-link" id="Attendees-tab" data-toggle="tab" href="#Attendees" aria-controls="Attendees"><?php echo $this->lang->line('Distributors') ?></a>

                                                    </li>

                                                    <?php }  ?>


                                                </ul>
                                                <div style="background-color: #f5f5f5" class="tab-content px-1 pt-1">

                                                    <!-- Team Leader -->

                                                    <div class="tab-pane fade active in" id="teamleader" role="tabpanel" aria-labelledby="teamleader-tab" aria-expanded="false">



                                                        <div class="card card-block">

                                                            <div id="notify" class="alert alert-success" style="display:none;">

                                                                <a href="#" class="close" data-dismiss="alert">&times;</a>



                                                                <div class="message"></div>

                                                            </div>

                                                            <div class="grid_3 grid_4">

                                                                <div class="header-block">

                                                                    <h3 class="title"><?php echo $project['show_name']; ?></h3>

                                                                    <hr>

                                                                    <form method="post" class="form-horizontal">

                                                                        <hr>



                                                                        <div class="table table-responsive">

                                                                            <table id="approveTeamLeadertable" class="display" cellspacing="0" width="100%">

                                                                                <thead>

                                                                                    <tr>

                                                                                        <th>#</th>

                                                                                        <th><?php echo $this->lang->line('Team Leader') ?></th>

                                                                                        <th><?php echo $this->lang->line('Applied Date') ?></th>

                                                                                        <th><?php echo $this->lang->line('Actions') ?></th>

                                                                                    </tr>

                                                                                </thead>

                                                                                <tbody>
                                                                                   

                                                                                </tbody>

                                                                            </table>

                                                                        </div>

                                                                    </form>



                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <!-- Team Leader -->


                                                    <!--  Attendess  -->



                                                    <div role="tabpanel" class="tab-pane fade " id="Attendees" aria-labelledby="Attendees-tab" aria-expanded="true">



                                                        <div class="table-responsive col-sm-12">

                                                            <table id="attendeestable" class="display" cellspacing="0" width="100%">





                                                                <thead>

                                                                    <th class="priority-1">#</th>

                                                                    <th class="priority-2" scope="row"><?php echo $this->lang->line('Person Name') ?></th>

                                                                    <th class="priority-3" scope="row"><?php echo $this->lang->line('Title') ?></th>

                                                                    <th class="priority-4" scope="row"><?php echo $this->lang->line('Booth') ?></th>

                                                                    <th class="priority-5" scope="row"><?php echo $this->lang->line('Product Category') ?></th>

                                                                </thead>



                                                                <tbody>



                                                                    <tr>



                                                                        <td>

                                                                            <p data-toggle="modal" data-target="#myModal1" style="color: purple" id="model-click"><a>ABC</a></p>



                                                                        </td>

                                                                        <td>

                                                                            <p><?php echo $this->lang->line('Team Leader') ?></p>



                                                                        </td>

                                                                        <td>

                                                                            <p><?php echo $this->lang->line('Booth') ?> 1 </p>



                                                                        </td>

                                                                        <td>

                                                                            <p>Categoty 1</p>



                                                                        </td>



                                                                    </tr>

                                                                    <tr>



                                                                        <td>

                                                                            <p data-toggle="modal" data-target="#myModal1" style="color: purple" id="model-click"><a>Business Owner</a></p>



                                                                        </td>

                                                                        <td>

                                                                            <p><?php echo $this->lang->line('Sales Person') ?></p>



                                                                        </td>

                                                                        <td>

                                                                            <p><?php echo $this->lang->line('Booth') ?> 2</p>



                                                                        </td>

                                                                        <td>

                                                                            <p>Categoty 3</p>



                                                                        </td>



                                                                    </tr>







                                                                </tbody>

                                                            </table>

                                                        </div>



                                                    </div>

                                                    <!-- Attendes -->


                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <!-- REPOTS -->

                                <!---  Business Owner Inventory BO  -->

                                <div role="tabpanel" class="tab-pane fade " id="inventorybo" aria-labelledby="inventorybo-tab" aria-expanded="true">

                                    <div class="card">

                                        <div class="card-body">

                                            <div class="card-block">

                                                <ul class="nav nav-tabs nav-justified  sidebar-green-backgrod">



                                                    <li class="nav-item">

                                                        <a class="nav-link active" id="tlpackinglist1-tab" data-toggle="tab" href="#tlpackinglist1" aria-controls="tlpackinglist1">Team Leader Requested Packing List</a>

                                                    </li>
                                                    <li class="nav-item">

                                                        <a class="nav-link" id="tlpackinglisthis-tab" data-toggle="tab" href="#tlpackinglisthis" aria-controls="tlpackinglisthis">History</a>

                                                    </li>

                                                </ul>
                                                <div style="background-color: #f5f5f5" class="tab-content px-1 pt-1">

                                                    <div role="tabpanel" class="tab-pane fade active in" id="tlpackinglist1" aria-labelledby="tlpackinglist1-tab" aria-expanded="true">
                                                        <div class="row">

                                                            <div class="col-md-12">

                                                                <h3>Team Leader - Requested Packing List</h3>

                                                                <br>

                                                            </div>

                                                            <div class="col-md-12">

                                                                <table cellspacing="0" style="width: 100%" id="tlrequestforpackinglist">

                                                                    <thead>

                                                                        <tr>

                                                                            <th class="priority-1">&nbsp;</th>
                                                                            <th>#</th>



                                                                            <th class="priority-2">Product Name</th>



                                                                            <th class="priority-3">Team Leader Name</th>

                                                                            <th class="priority-5">Requested Quantity</th>

                                                                            <th class="priority-4">Approved Quantity</th>

                                                                            <th class="priority-6">Requested At</th>

                                                                            <th class="priority-9">Action</th>

                                                                        </tr>

                                                                    </thead>

                                                                    <tbody>

                                                                    </tbody>

                                                                </table>



                                                            </div>



                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="tlpackinglisthis" aria-labelledby="tlpackinglisthis-tab" aria-expanded="true">
                                                        <!-- content -->
                                                        <div id="notify" class="alert alert-success" style="display:none;">

                                                            <a href="#" class="close" data-dismiss="alert">&times;</a>



                                                            <div class="message"></div>

                                                        </div>

                                                        <div class="grid_3 grid_4">

                                                            <div class="header-block">





                                                                <h3 class="title">

                                                                    Packing List Request History

                                                                </h3>

                                                                <br>

                                                            </div>



                                                            <table id="requesthistory" style="width:100%">



                                                                <thead>

                                                                    <th class="priority-1">#</th>

                                                                    <th class="priority-2">Requested at</th>

                                                                    <th class="priority-6">Approved at</th>

                                                                    <th class="priority-9">Recieved at</th>



                                                                </thead>

                                                                <tbody>


                                                                </tbody>


                                                            </table>

                                                        </div>

                                                        <!-- content -->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                </div>

                                <!--- Business Owner Inventory BO -->

                                <!--- Communication -->



                                <div class="tab-pane fade" id="communication" role="tabpanel" aria-labelledby="communication-tab" aria-expanded="false">



                                    <div class="card">

                                        <div class="card-body">

                                            <div class="card-block">



                                                <ul class="nav nav-tabs nav-justified sidebar-green-backgrod">



                                                    <li class="nav-item">

                                                        <a class="nav-link active" id="milestones-tab" data-toggle="tab" href="#milestones" aria-controls="milestones"><?php echo $this->lang->line('Milestones') ?></a>

                                                    </li>



                                                    <li class="nav-item"> <a class="nav-link" id="link-tab" data-toggle="tab" href="#link" aria-controls="link" aria-expanded="false"><?php echo $this->lang->line('Tasks') ?></a>

                                                    </li>





                                                    <li class="nav-item">

                                                        <a class="nav-link" id="thread-tab" data-toggle="tab" href="#thread" aria-controls="thread"><?php echo $this->lang->line('Thread') ?></a>

                                                    </li>

                                                    <?php if ($this->aauth->get_user()->roleid == 5) { ?>

                                                    <li class="nav-item">

                                                        <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" aria-controls="comments"><?php echo $this->lang->line('Comments') ?></a>

                                                    </li>

                                                    <?php } ?>

                                                    <?php if (($this->aauth->get_user()->roleid == 3 and !empty($tlckeck)) or ($this->aauth->get_user()->roleid == 5)) { ?>
                                                    <li class="nav-item">

                                                        <a class="nav-link" id="linkOpt-tab" data-toggle="tab" href="#notes" aria-controls="notes"><?php echo $this->lang->line('Notes') ?></a>

                                                    </li>
                                                    <?php } ?>

                                                </ul>

                                                <div style="background-color: #f5f5f5" class="tab-content px-1 pt-1">

                                                    <!--milestones-->

                                                    <div role="tabpanel" class="tab-pane fade active in" id="milestones" aria-labelledby="milestones-tab" aria-expanded="true">



                                                        <?php if (($this->aauth->get_user()->roleid == 3 and !empty($tlckeck)) or ($this->aauth->get_user()->roleid == 5)) { ?>

                                                        <a href="<?php echo base_url('projects/addmilestoneforshow?id=' . $project['id']) ?>" class="btn btn-primary btn-sm rounded">

                                                            <?php echo $this->lang->line('Add Milestone') ?>

                                                        </a>

                                                        <?php } ?>



                                                        <table id="milestonetable" class="display" cellspacing="0" width="100%">

                                                            <thead>

                                                                <tr>

                                                                    <th class="priority-1">#</th>

                                                                    <th class="priority-2">Title</th>

                                                                    <th class="priority-3">Color</th>

                                                                    <th class="priority-4">Start Date</th>

                                                                    <th class="priority-5">Due Date</th>

                                                                    <?php if (($this->aauth->get_user()->roleid == 3 and !empty($tlckeck)) or ($this->aauth->get_user()->roleid == 5)) { ?>

                                                                    <th class="priority-9">Action</th>

                                                                    <?php } ?>

                                                                </tr>

                                                            </thead>

                                                            <tbody>

                                                                <?php

                                                                $i = 0;

                                                                foreach ($milestones as $ml1) {

                                                                    ?>

                                                                <tr>

                                                                    <td class="priority-1"><?php echo ++$i; ?></td>

                                                                    <td class="priority-2"><?php echo $ml1->name ?></td>

                                                                    <td class="priority-3">

                                                                        <div style="width:40px;height: 20px;background-color:<?php echo $ml1->color; ?> ">

                                                                        </div>

                                                                    </td>

                                                                    <td class="priority-4"><?php echo $ml1->sdate; ?></td>

                                                                    <td class="priority-5"><?php echo $ml1->edate; ?></td>

                                                                    <?php if (($this->aauth->get_user()->roleid == 3 and !empty($tlckeck)) or ($this->aauth->get_user()->roleid == 5)) { ?>

                                                                    <td class="priority-9">
                                                                        <a class="btn btn-info btn-sm" href="<?php
                                                                                                                        echo base_url('projects/editmilestone?id=' . $ml1->id)  ?>&sid=<?php echo $project['id']; ?>"> <i class="icon-pencil"></i> </a>
                                                                        &nbsp;<a class="btn-brown btn-sm delete-custom" data-did="2" href="#" data-object-id="<?php echo $ml1->id; ?>"> <i class="icon-trash-o"></i> </a>

                                                                    </td>

                                                                    <?php } ?>

                                                                </tr>



                                                                <?php

                                                                }

                                                                ?>

                                                            </tbody>

                                                        </table>

                                                    </div>

                                                    <!--milestones-->

                                                    <!------ Task ---->

                                                    <div class="tab-pane fade" id="link" role="tabpanel" aria-labelledby="link-tab" aria-expanded="false">

                                                        <?php if (($this->aauth->get_user()->roleid == 3 and !empty($tlckeck)) or ($this->aauth->get_user()->roleid == 5)) { ?>

                                                        <p><a href="<?php echo base_url('projects/addtaskforshow?id=' . $project['id']) ?>" class="btn btn-primary btn-sm rounded">

                                                                <?php echo $this->lang->line('Add new') . ' ' . $this->lang->line('Task') ?>

                                                            </a>



                                                        </p>

                                                        <?php } ?>

                                                        <table id="todotable" class="display" cellspacing="0" width="100%">

                                                            <thead>

                                                                <tr>

                                                                    <th class="priority-1">#</th>

                                                                    <th class="priority-2"><?php echo $this->lang->line('Task') ?></th>

                                                                    <th class="priority-3"><?php echo $this->lang->line('Due Date') ?></th>

                                                                    <th class="priority-4"><?php echo $this->lang->line('Start') ?></th>

                                                                    <th class="priority-5"><?php echo $this->lang->line('Status') ?></th>



                                                                    <th class="priority-9"><?php echo $this->lang->line('Actions') ?></th>











                                                                </tr>

                                                            </thead>

                                                            <tbody>



                                                            </tbody>

                                                        </table>

                                                    </div>

                                                    <!------ Task ---->

                                                    <!--thread-->

                                                    <div class="tab-pane fade" id="thread" role="tabpanel" aria-labelledby="thread-tab" aria-expanded="false">



                                                        <ul class="timeline">
                                                            <?php
                                                            $total = 1;
                                                            $flag = true;
                                                            foreach ($milestones as $ml1) {
                                                                $checktask = 0;

                                                                ?>
                                                            <li class="<?php if (!$flag) {

                                                                                echo 'timeline-inverted';
                                                                            } ?>">
                                                                <div class="timeline-badge info"><?php echo $total ?>

                                                                </div>

                                                                <div class="timeline-panel">
                                                                    <div class="timeline-heading">
                                                                        <h4 class="timeline-title"><?php echo $ml1->name; ?></h4>
                                                                        <?php
                                                                            foreach ($thread_list as $task) {
                                                                                if ($ml1->id == $task['milestone_id']) {
                                                                                    $checktask++;
                                                                                    ?>

                                                                        <small class="text-muted"><i class="glyphicon glyphicon-time"></i>
                                                                            <?php echo $task['showtaskname'] . "  " . $task['showtaskstart'] . " ~ " . $task['showtaskdue']; ?>
                                                                        </small>
                                                                        <br>

                                                                        <?php

                                                                                }
                                                                            }
                                                                            if ($checktask == 0) {
                                                                                echo "<small class='text-muted'><i class='glyphicon glyphicon-time'></i>No Task Available</small>";
                                                                            }

                                                                            ?>
                                                                    </div>
                                                                </div>

                                                            </li>
                                                            <br>

                                                            <?php

                                                                $total++;
                                                                $flag = !$flag;
                                                            }


                                                            ?>
                                                        </ul>

                                                    </div>

                                                    <!--thread-->

                                                    <!--comments-->

                                                    <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab" aria-expanded="false">

                                                        <hr>

                                                        <p>Comments timeline among team members and customer.</p>

                                                        <form method="post" id="data_form2">

                                                            <div class="form-group row">





                                                                <div class="col-sm-12">

                                                                    <textarea class="summernote" placeholder=" Note" autocomplete="false" rows="10" name="content"></textarea>

                                                                </div>

                                                            </div>

                                                            <div class="form-group row">





                                                                <div class="col-sm-10">

                                                                    <input type="submit" class="btn btn-success sub-btn" value="<?php echo $this->lang->line('Comment') ?> " id="submit-data2" data-loading-text="Creating...">

                                                                </div>

                                                            </div>

                                                            <input type="hidden" value="projects/addcommentshow" id="action-url2">

                                                            <input type="hidden" value="<?php echo $project['id']; ?>" name="nid">

                                                            <input type="hidden" id="action-url-transfer-all" value="projects/transferfullstock" class="action-url">



                                                        </form>

                                                        <ul class="timeline">

                                                            <?php $flag = true;

                                                            $total = count($comments_list);

                                                            foreach ($comments_list as $row) {





                                                                ?>

                                                            <li class="<?php if (!$flag) {

                                                                                echo 'timeline-inverted';
                                                                            } ?>">

                                                                <div class="timeline-badge info"><?php echo $total ?></div>

                                                                <div class="timeline-panel">

                                                                    <div class="timeline-heading">

                                                                        <h4 class="timeline-title"><?php if ($row['key3']) echo $row['customer'] . ' Reply <small>(Customer)</small>';
                                                                                                        else echo $row['employee'] . ' Reply <small>(Employee)</small>'; ?></h4>



                                                                    </div>

                                                                    <div class="timeline-body">

                                                                        <p><?php echo $row['value'] ?></p>

                                                                    </div>

                                                                </div>

                                                            </li>

                                                            <?php $flag = !$flag;

                                                                $total--;
                                                            } ?>





                                                        </ul>





                                                    </div>

                                                    <!--comments-->

                                                    <!--notes-->

                                                    <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab" aria-expanded="false">

                                                        <form method="post" id="data_form">

                                                            <div class="form-group row">

                                                                <div class="col-sm-12">

                                                                    <textarea class="summernote" placeholder=" Note" autocomplete="false" rows="10" name="content"><?php echo $project['note']; ?>

            </textarea>

                                                                </div>

                                                            </div>

                                                            <div class="form-group row">

                                                                <div class="col-sm-10">

                                                                    <input type="submit" class="btn btn-success sub-btn" value="<?php echo $this->lang->line('Update') ?> " id="submit-data" data-loading-text="Creating...">

                                                                </div>

                                                            </div>

                                                            <input type="hidden" value="/projects/set_note_show" id="action-url">

                                                            <input type="hidden" value="<?php echo $project['id']; ?>" name="nid">

                                                        </form>

                                                    </div>

                                                    <!--notes-->

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!--- Communication -->


                                <!------------------------files-------------->

                                <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab" aria-expanded="false">



                                    <p>



                                        <?php foreach ($p_files as $row) { ?>





                                        <section class="form-group row">





                                            <div data-block="sec" class="col-sm-12">

                                                <div class="card card-block"><?php





                                                                                    echo '<a href="' . base_url('userfiles/project/' . $row['value']) . '">' . $row['value'] . '</a><a href="#" class="btn btn-danger float-xs-right delete-custom" data-did="1" data-object-id="' . $row['meatadata'] . '"><i class="icon-trash-b"></i></a> ';



                                                                                    echo '<br><br>';

                                                                                    ?></div>

                                            </div>

                                        </section>

                                        <?php } ?>

                                    </p>

                                    <span class="btn btn-success fileinput-button">

                                        <i class="glyphicon glyphicon-plus"></i>

                                        <span>...</span>

                                        <!-- The file input field used as target for the file upload widget -->

                                        <input id="fileupload" type="file" name="files[]" multiple>

                                    </span>

                                    <br>

                                    <br>

                                    <!-- The global progress bar -->

                                    <div id="progress" class="progress">

                                        <div class="progress-bar progress-bar-success"></div>

                                    </div>

                                    <!-- The container for the uploaded files -->

                                    <div id="files" class="files"></div>

                                    <br>

                                </div>

                                <!---------------------Files--------------->


                                <!--invoices-->
                                <div class="tab-pane fade" id="invoices_main" role="tabpanel" aria-labelledby="invoices_main-tab" aria-expanded="false">

                                    <div class="card">

                                        <div class="card-body">

                                            <div class="card-block">

                                                <ul class="nav nav-tabs nav-justified sidebar-green-backgrod">
                                                    <li class="nav-item">

                                                        <a class="nav-link active" id="invoices-tab" data-toggle="tab" href="#invoices" aria-controls="invoices">Show orders</a>

                                                    </li>

                                                    <?php if ($this->aauth->get_user()->roleid == 3) { ?>

                                                    <li class="nav-item">
                                                        <a class="nav-link" id="cashcollection-tab" data-toggle="tab" href="#cashcollection" aria-controls="cashcollection" aria-expanded="false">Cash collection</a>
                                                    </li>

                                                    <?php } ?>

                                                </ul>
                                                <div class="tab-content px-1 pt-1">
                                                    <div class="tab-pane fade active in" id="invoices" role="tabpanel" aria-labelledby="invoices-tab" aria-expanded="false">
                                                        <p><a href="<?php echo base_url('invoices/create?project=' . $project['id']) ?>" class="btn btn-primary btn-sm rounded">
                                                                <?php echo $this->lang->line('Create New Invoice') ?></a>
                                                        </p>



                                                        <div class="table-responsive">

                                                            <table class="table table-hover mb-1" id="orderdetails">

                                                                <thead>

                                                                    <tr>

                                                                        <th><?php echo $this->lang->line('Invoices') ?>#</th>

                                                                        <th><?php echo $this->lang->line('Status') ?></th>
                                                                        <th><?php echo $this->lang->line('Sales Person') ?></th>

                                                                        <th><?php echo $this->lang->line('Due') ?></th>

                                                                        <th><?php echo $this->lang->line('Amount') ?></th>

                                                                    </tr>

                                                                </thead>

                                                                <tbody>

                                                                    <?php



                                                                    foreach ($invoices as $item) {

                                                                        echo '<tr>

                                        <td class="text-truncate"><a href="' . base_url() . 'invoices/view?id=' . $item['tid'] . '">#' . $item['tid'] . '</a></td>

                                      

                                        <td class="text-truncate"><span class="tag tag-default st-' . $item['status'] . '">' . $this->lang->line(ucwords($item['status'])) . '</span></td>

                                        <td class="text-truncate">' . $item['emp_name'] . '</td>
                                        <td class="text-truncate">' . dateformat($item['invoicedate']) . '</td>

                                        <td class="text-truncate">' . amountFormat($item['total']) . '</td>

                                    </tr>';
                                                                    } ?>



                                                                </tbody>

                                                            </table>

                                                        </div>

                                                    </div>


                                                    <!-- -----------------------Cash Collection---------------------- -->
                                                    <div class="tab-pane fade " id="cashcollection" role="tabpanel" aria-labelledby="cashcollection-tab" aria-expanded="false">
                                                        <br>
                                                        <p style="font-size: 18px;font-weight: 600">User Name : <?php echo $loggedinusername; ?> </p>
                                                        <br>
                                                        <form id="transfer_amount_to_sl_form">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label" for="salesperson"><b>Select Salesperson</b></label>
                                                                <div class="col-sm-4">
                                                                    <select name="pay_acc2" class="form-control " id="salesperson">
                                                                        <option value="">----Select Salesperson----</option>
                                                                        <?php
                                                                        //print_r($emp);
                                                                        foreach ($emp as $sl) {
                                                                            if ($sl[0]['ac_num'] != '' || $sl[0]['ac_num'] != null) {
                                                                                ?>

                                                                        <option value="<?php echo $sl[0]['id']; ?>"><?php echo $sl[0]['name']; ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label " for="salesperson"><b>Amount</b></label>
                                                                <div class="col-sm-4">
                                                                    <input type="number" val=1 min=0 class="form-control " name="amount" id="amount">
                                                                </div>
                                                                <input type="hidden" name="pay_acc" value="<?php echo $loggedin_user_ac_id; ?>">
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="submit" name="transfer_amount_to_sl_btn" id="transfer_amount_to_sl_btn" class="btn btn-success" value="Transfer">
                                                                    <input type="hidden" id="transfer_amount_to_sl_url" value="transactions/save_transfer" />
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- -----------------------Cash Collection---------------------- -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--invoices-->

                                <!--Inventory-->

                                <div class="tab-pane fade" id="inventory1" role="tabpanel" aria-labelledby="inventory1-tab" aria-expanded="false">

                                    <div class="card">

                                        <div class="card-body">

                                            <div class="card-block">

                                                <ul class="nav nav-tabs nav-justified sidebar-green-backgrod">



                                                    <li class="nav-item">

                                                        <a class="nav-link active" id="packinglist1-tab" data-toggle="tab" href="#packinglist1" aria-controls="packinglist1">Packing List</a>

                                                    </li>





                                                    <?php if ($this->aauth->get_user()->roleid == 3) { ?>

                                                    <li class="nav-item"> <a class="nav-link" id="confirmrequisionlist-tab" data-toggle="tab" href="#confirmrequisionlist" aria-controls="confirmrequisionlist" aria-expanded="false">Conf. Rcpt. - Packing List </a>

                                                    </li>





                                                    <li class="nav-item"> <a class="nav-link" id="sprequisionlist-tab" data-toggle="tab" href="#sprequisionlist" aria-controls="sprequisionlist" aria-expanded="false">Sales Person Requisition List</a>

                                                    </li>









                                                    <li class="nav-item">

                                                        <a class="nav-link" id="stocklist-tab" data-toggle="tab" href="#stocklist" aria-controls="stocklist">Stock Transfer</a>

                                                    </li>

                                                    <li class="nav-item">

                                                        <a class="nav-link" id="warehouseproduct-tab" data-toggle="tab" href="#warehouseproduct" aria-controls="warehouseproduct">Allocate to SalesPerson</a>

                                                    </li>

                                                    <li class="nav-item">

                                                        <a class="nav-link" id="tlhis-tab" data-toggle="tab" href="#tlhis" aria-controls="tlhis">History</a>

                                                    </li>

                                                    <?php } ?>

                                                </ul>

                                                <div class="tab-content px-1 pt-1">

                                                    <!-- packing list -->

                                                    <div role="tabpanel" class="tab-pane fade active in" id="packinglist1" aria-labelledby="packinglist1-tab" style="background-color: #f5f5f5" aria-expanded="true">

                                                        <form id="data_form_packinglist_request_tl">

                                                            <div class="row">

                                                                <div class="col-md-4">

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

                                                                                //print_r($item_list);
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

                                                                                <td <?php if ($this->aauth->get_user()->roleid == 5) { ?> colspan='2' <?php } ?>><input name="<?php echo 'product[' . $pr['pid'] . '][requested_qty]' ?>" class="ckqty" type="number" <?php if ($this->aauth->get_user()->roleid == 5) { ?> readonly <?php } ?> max="<?php echo $pr['qty']; ?>" style="width: 50px;" min="0" value="0" id="<?php echo $pr['pid'];  ?>" /></td>

                                                                                <?php if ($this->aauth->get_user()->roleid == 5) { ?>

                                                                                <td>

                                                                                    <input type="number" id="<?php echo $pr['pid'];  ?>" <?php if ($this->aauth->get_user()->roleid == 3) { ?> class="ckqty" max="<?php echo $pr['qty']; ?>" readonly <?php } ?> style="width: 50px" name="<?php echo 'product[' . $pr['pid'] . '][approved_qty]' ?>" min="0" value="0" /></td>

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

                                                                                    <input id="<?php echo $pr1['pid'];  ?>" class="ckqty" name="<?php echo 'product[' . $pr1['pid'] . '][requested_qty]' ?>" type="number" max="<?php echo $pr1['qty']; ?>" <?php if ($this->aauth->get_user()->roleid == 5) { ?> readonly <?php } ?> style="width: 50px;" min="0" value="0" />

                                                                                </td>
                                                                                <?php if ($this->aauth->get_user()->roleid == 5) { ?>

                                                                                <td>

                                                                                    <input id="<?php echo $pr1['pid'];  ?>" class="ckqty" max="<?php echo $pr1['qty']; ?>" type="number" <?php if ($this->aauth->get_user()->roleid == 3) { ?> readonly <?php } ?> style="width: 50px" name="<?php echo 'product[' . $pr1['pid'] . '][approved_qty]' ?>" min="0" value="0" />

                                                                                </td>
                                                                                <?php } ?>



                                                                            </tr>

                                                                            <?php }
                                                                            } ?>

                                                                        </tbody>

                                                                    </table>

                                                                </div>

                                                                <div class="col-md-2">

                                                                    <p style="font-size: 12px;font-weight: 900">

                                                                        FLASHBOX CHECKOUT

                                                                    </p>

                                                                    <table class="table-responsive">

                                                                        <?php
                                                                        $pre_item = '';
                                                                        foreach ($getProductByQuickPick as $qckpick) {
                                                                            $new_item = $qckpick['item_id'];
                                                                            if ($pre_item != $new_item) {
                                                                                $pre_item = $new_item;
                                                                                echo '<tr><td colspan="2" style="text-align:center;"><b>' . $item_list[$new_item] . '</b></td></tr>';
                                                                            }
                                                                            ?>

                                                                        <tr>

                                                                            <td> <input value="<?php echo $qckpick['pid'] ?>" type="checkbox" style="font-size: 20px" value="<?php echo $qckpick['pid'];  ?>" name="ck_1[]"></td>

                                                                            <td><?php echo $qckpick['product_name'] ?></td>

                                                                        </tr>

                                                                        <?php

                                                                        }

                                                                        ?>

                                                                    </table>

                                                                    <br>

                                                                </div>

                                                            </div>

                                                            <div class="row">

                                                                <div class="col-md-12">

                                                                    <input type="submit" id="submit-packinglist-tl" class="btn btn-success margin-bottom" value="Apply" data-loading-text="Adding..." />

                                                                    <input type="hidden" id="action-url-packinglist-tl" value="projects/requestpackinglisttl" class="action-url">

                                                                    <input type="hidden" value="<?php echo $project['id']; ?>" name="project">

                                                                </div>

                                                            </div>

                                                        </form>

                                                    </div>

                                                    <!-- packing list -->





                                                    <!-- packing list history tl -->

                                                    <div role="tabpanel" style="background-color: #f5f5f5" class="tab-pane fade" id="tlhis" aria-labelledby="tlhis-tab" aria-expanded="true">

                                                        <table id="tlsidepackhist" style="width: 100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Requested At</th>
                                                                    <th>Approved At</th>
                                                                    <th>Received At</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- packing list history tl-->

                                                    <!-- requision list -->

                                                    <div role="tabpanel" style="background-color: #f5f5f5" class="tab-pane fade" id="sprequisionlist" aria-labelledby="sprequisionlist-tab" aria-expanded="true">

                                                        <div class="row">

                                                            <div class="col-md-12">

                                                                <table id="salesperson_reqest_list" cellspacing="0" style="width: 100%;">

                                                                    <thead>

                                                                        <tr>

                                                                            <th class="priority-1">#</th>



                                                                            <th>Product Name</th>



                                                                            <th>Sales Person Name</th>

                                                                            <th>Requested Quantity</th>

                                                                            <th>Approved Quantity</th>

                                                                            <th>Requested At</th>

                                                                            <th>Action</th>

                                                                        </tr>

                                                                    </thead>

                                                                    <tbody>




                                                                    </tbody>

                                                                </table>



                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div role="tabpanel" style="background-color: #f5f5f5" class="tab-pane fade" id="confirmrequisionlist" aria-labelledby="confirmrequisionlist-tab" aria-expanded="true">



                                                        <table id="confirmpackinglisttl" style="width: 100%">

                                                            <thead>

                                                                <tr>

                                                                    <th class="priority-1">&nbsp;</th>
                                                                    <th>#</th>

                                                                    <th>Product Name</th>

                                                                    <th>Requested Quantity</th>

                                                                    <th>Approved Quantity</th>

                                                                    <th>Requested At</th>

                                                                    <th>Approved At</th>

                                                                    <th>Action</th>

                                                                </tr>

                                                            </thead>

                                                            <tbody>
                                                            </tbody>

                                                        </table>




                                                    </div>

                                                    <div role="tabpanel" style="background-color: #f5f5f5" class="tab-pane fade" id="stocklist" aria-labelledby="stocklist-tab" aria-expanded="true">

                                                        <div class="card" style="background-color: #f5f5f5">

                                                            <div class="card-body">

                                                                <div class="card-block">



                                                                    <ul class="nav nav-tabs nav-justified" style="background-color: #F9E6D9">



                                                                        <li class="nav-item">

                                                                            <a class="nav-link active" id="stocktransfer-tab" data-toggle="tab" href="#stocktransfer" aria-controls="stocktransfer">Transfer Stock</a>

                                                                        </li>



                                                                        <li class="nav-item"> <a class="nav-link" id="stockrecieve-tab" data-toggle="tab" href="#stockrecieve" aria-controls="stockrecieve" aria-expanded="false">Received Stock</a>

                                                                        </li>

                                                                        <li class="nav-item"> <a class="nav-link" id="stockhistory-tab" data-toggle="tab" href="#stockhistory" aria-controls="stockhistory" aria-expanded="false">History</a>

                                                                        </li>

                                                                    </ul>

                                                                    <div class="tab-content px-1 pt-1" style="background-color: #F9E6D9">

                                                                        <!--Transfer Stock TAB CONTENT-->

                                                                        <div role="tabpanel" class="tab-pane fade active in" id="stocktransfer" aria-labelledby="stocktransfer-tab" aria-expanded="true">



                                                                            <div class="form-group row col-sm-12">

                                                                                <h3>Transfer Stock</h3>

                                                                            </div>

                                                                            <br>

                                                                            <form id="transfer-full-stock">



                                                                                <div class="form-group row">

                                                                                    <label style="font-size: 15px" class="col-sm-2 col-form-label" for="team_leader"> Team Leader

                                                                                    </label>

                                                                                    <div class="col-md-6">



                                                                                        <select class="form-control margin-bottom " name="transferteamleader" id="transferedteamleaderid">

                                                                                            <option value="">---Select---</option>

                                                                                            <?php

                                                                                            foreach ($teamleaderforstocktransfer as $row) {

                                                                                                $cid = $row['eid'];

                                                                                                $title = $row['name'];

                                                                                                echo "<option value='$cid'>$title</option>";
                                                                                            }

                                                                                            ?>

                                                                                        </select>

                                                                                    </div>

                                                                                    <div class="col-sm-2">

                                                                                        <br>

                                                                                        <input type="submit" id="transfer_full_stock" value="Transfer full stock" class="btn btn-success">


                                                                                        <input type="hidden" id="action-url-transfer-all" value="projects/transferfullstock" class="action-url">

                                                                                        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="project">

                                                                                    </div>

                                                                                </div>

                                                                            </form>

                                                                            <div class="form-group row">

                                                                                <label style="font-size: 15px;text-align: center;font-weight: 600" class="col-sm-12 col-form-label" for="team_leader">

                                                                                    - OR -

                                                                                </label>

                                                                            </div>

                                                                            <div class="form-group row">

                                                                                <label style="font-size: 15px;font-weight: 600" class="col-sm-6 col-form-label" for="team_leader">

                                                                                    Enter quantity for each item

                                                                                </label>

                                                                            </div>







                                                                            <form id="transfer-stock-manual">
                                                                                <input type='text' id="get_transfer_teamleadr_id" name='get_transfer_teamleadr_id' style="display: none;" />
                                                                                <div class="row">

                                                                                    <div class="col-md-6 table-responsive">

                                                                                        <table cellspacing="0" class="table table-bordered" width="100%">

                                                                                            <thead>

                                                                                                <th>Product</th>

                                                                                                <th colspan="2">Quantity</th>

                                                                                            </thead>

                                                                                            <tbody>



                                                                                                <?php

                                                                                                if (empty($getStckTransferDetailsforNotColor)) {

                                                                                                    ?>
                                                                                                <tr>
                                                                                                    <td colspan="3" style="text-align: center;">No Product Available</td>
                                                                                                </tr>

                                                                                                <?php
                                                                                                } else {
                                                                                                    $pre_item = '';
                                                                                                    foreach ($getStckTransferDetailsforNotColor as $pr) {
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

                                                                                                    <td <?php if ($this->aauth->get_user()->roleid == 5) { ?> colspan='2' <?php } ?>><input name="<?php echo 'product[' . $pr['pid'] . '][requested_qty]' ?>" type="number" <?php if ($this->aauth->get_user()->roleid == 5) { ?> readonly <?php } ?> max="<?php echo $pr['qty']; ?>" style="width: 50px;" min="1" value="1" id="<?php echo $pr['pid'];  ?>" /></td>

                                                                                                    <?php if ($this->aauth->get_user()->roleid == 5) { ?>

                                                                                                    <td>

                                                                                                        <input type="number" id="<?php echo $pr['pid'];  ?>" <?php if ($this->aauth->get_user()->roleid == 3) { ?> max="<?php echo $pr['qty']; ?>" readonly <?php } ?> style="width: 50px" name="<?php echo 'product[' . $pr['pid'] . '][approved_qty]' ?>" min="1" value="1" /></td>

                                                                                                    <?php } ?>

                                                                                                </tr>

                                                                                                <?php

                                                                                                    }
                                                                                                }

                                                                                                ?>

                                                                                            </tbody>

                                                                                        </table>

                                                                                    </div>

                                                                                    <div class="col-md-6 table-responsive">

                                                                                        <table class="table table-bordered">

                                                                                            <thead>

                                                                                                <tr>

                                                                                                    <th>Product</th>

                                                                                                    <th>Color</th>

                                                                                                    <th colspan="2" style="text-align: center;">Quantity</th>



                                                                                                </tr>

                                                                                            </thead>

                                                                                            <tbody>

                                                                                                <?php
                                                                                                if (empty($getStckTransferDetailsforColor)) {

                                                                                                    ?>
                                                                                                <tr>
                                                                                                    <td colspan="4" style="text-align: center;">No Product Available</td>
                                                                                                </tr>
                                                                                                <?php } else {
                                                                                                    $pre_item = '';
                                                                                                    foreach ($getStckTransferDetailsforColor as $pr1) {
                                                                                                        $new_item = $pr1['item_id'];
                                                                                                        if ($pre_item != $new_item) {
                                                                                                            $pre_item = $new_item;
                                                                                                            echo '<tr><td colspan="2" style="text-align:center;"><b>' . $item_list[$new_item] . '</b></td></tr>';
                                                                                                        }
                                                                                                        ?>

                                                                                                <tr>

                                                                                                    <td style="color:purple;">

                                                                                                        <?php echo $pr1['product_name']; ?>

                                                                                                        <input type="hidden" value="<?php echo $pr1['pid']; ?>" name="<?php echo 'product[' . $pr1['pid'] . '][id]' ?>" />

                                                                                                    </td>

                                                                                                    <td>

                                                                                                        <div style="background-color:<?php echo $pr1['color']; ?>;height: 20px;width: 20px ">

                                                                                                        </div>

                                                                                                    </td>

                                                                                                    <td <?php if ($this->aauth->get_user()->roleid == 5) { ?> colspan='2' <?php } ?>>

                                                                                                        <input id="<?php echo $pr1['pid'];  ?>" name="<?php echo 'product[' . $pr1['pid'] . '][requested_qty]' ?>" type="number" max="<?php echo $pr1['qty']; ?>" <?php if ($this->aauth->get_user()->roleid == 5) { ?> readonly <?php } ?> style="width: 50px;" min="1" value="1" />

                                                                                                    </td>
                                                                                                    <?php if ($this->aauth->get_user()->roleid == 5) { ?>

                                                                                                    <td>

                                                                                                        <input id="<?php echo $pr1['pid'];  ?>" class="ckqty" max="<?php echo $pr1['qty']; ?>" type="number" <?php if ($this->aauth->get_user()->roleid == 3) { ?> readonly <?php } ?> style="width: 50px" name="<?php echo 'product[' . $pr1['pid'] . '][approved_qty]' ?>" min="1" value="1" />

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



                                                                                    <div class="col-sm-2">

                                                                                        <input type="submit" id="transfer-all-stock" class="btn btn-success margin-bottom " value="Transfer" data-loading-text="Transfering..." />

                                                                                        <input type="hidden" id="action-url-transfer-all" value="projects/transferstockmanually" class="action-url">

                                                                                        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="project">

                                                                                    </div>

                                                                                </div>



                                                                            </form>





                                                                        </div>

                                                                        <!--Transfer Stock TAB CONTENT-->

                                                                        <!--Recieve Stock TAB CONTENT-->

                                                                        <div role="tabpanel" class="tab-pane fade " id="stockrecieve" aria-labelledby="stockrecieve-tab" aria-expanded="true">

                                                                            <div class="form-group row col-sm-12">

                                                                                <div style="font-size: 20px">

                                                                                    Received Stock Details

                                                                                </div>

                                                                            </div>

                                                                            <br>

                                                                            <form id="transfer_confirmation">

                                                                                <div class="form-group row">

                                                                                    <label style="font-size: 15px" class="col-sm-2 col-form-label" for="team_leader">Team Leader

                                                                                    </label>

                                                                                    <div class="col-md-6">

                                                                                        <select class="form-control margin-bottom" id="select_teamleader">
                                                                                            <option value="">---select---</option>

                                                                                            <?php

                                                                                            foreach ($teamleaderforstocktransfer as $row) {

                                                                                                $cid = $row['eid'];

                                                                                                $title = $row['name'];

                                                                                                echo "<option value='$cid'>$title</option>";
                                                                                            }
                                                                                            ?>

                                                                                        </select>

                                                                                    </div>

                                                                                    <div class="col-sm-2">
                                                                                        <br>

                                                                                        <input type="submit" style="font-weight: 600" name="transfer_confirm" value="Display Recieved Stock Detail" id="transfer_confirm1" class="btn btn-success">

                                                                                        <input type="hidden" id="action-url-transfer-confirm" value="projects/getstocktransferrecieveddata" class="action-url">

                                                                                        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="project">
                                                                                        <input type="hidden" name="tl" id="tl_value">


                                                                                    </div>



                                                                                </div>

                                                                            </form>
                                                                            <br>
                                                                            <div id="stocktransferrecieved">
                                                                            </div>


                                                                        </div>

                                                                        <!--Recieve Stock TAB CONTENT-->

                                                                        <!--HISTORY Stock TAB CONTENT-->

                                                                        <div role="tabpanel" class="tab-pane fade" id="stockhistory" aria-labelledby="stockhistory-tab" aria-expanded="true">

                                                                            <br>
                                                                            <div class="table-responsive">

                                                                                <table id="stock_history_teamleader" style="width: 100%">

                                                                                    <thead>

                                                                                        <th>#</th>

                                                                                        <th>Transferred Stock Team Leader</th>

                                                                                        <th>Received Stock Team Leader</th>

                                                                                        <th>Item Name</th>

                                                                                        <th>Transfer Quantity</th>

                                                                                        <th>Created At</th>

                                                                                        <th>Status</th>

                                                                                    </thead>

                                                                                    <tbody>


                                                                                    </tbody>



                                                                                </table>
                                                                            </div>

                                                                        </div>

                                                                        <!--HISTORY Stock TAB CONTENT-->

                                                                    </div>



                                                                    <!--  Stock Transfer -->



                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>


                                                    <!-- WAREHOUSE PRODUCTS TEAM LEADER -->

                                                    <div role="tabpanel" class="tab-pane fade" id="warehouseproduct" aria-labelledby="warehouseproduct-tab" aria-expanded="true">
                                                        <br>
                                                        <h3>Allocate to SalesPerson</h3>
                                                        <hr>

                                                        <form id="product_warehouse_form">
                                                            <div class="form-group row">

                                                                <label class="col-sm-2 col-form-label" for="name"><b>Select Salesperson</b></label>

                                                                <div class="col-sm-4">
                                                                    <select class="form-control" name="sl">

                                                                        <?php if (empty($emp)) { ?>
                                                                        <option value="">--select--</option>
                                                                        <?php } else {
                                                                            foreach ($emp as $sl) {
                                                                                ?>
                                                                        <option value="<?php echo $sl[0]['id']; ?>"><?php echo $sl[0]['name']; ?></option>
                                                                        <?php
                                                                            }
                                                                        }

                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="row table-responsive">



                                                                <div class="col-md-12">

                                                                    <table class="table table-hover" style="width: 100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Product Name</th>
                                                                                <th>Available Quantity</th>
                                                                                <th>Quantity</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $index = 1;
                                                                            $pre_item = '';
                                                                            foreach ($teamleader_warehouse_product as $pr) {
                                                                                $new_item = $pr['item_id'];
                                                                                if ($pre_item != $new_item) {
                                                                                    $pre_item = $new_item;
                                                                                    echo '<tr>
                                                                                <td colspan="4" style="text-align:center;"><b>' . $item_list[$new_item] . '</b></td>
                                                                            </tr>';
                                                                                } ?>
                                                                            <tr>
                                                                                <td><?php echo $index; ?></td>
                                                                                <td><?php echo $pr['product_name']; ?></td>
                                                                                <td><?php echo $pr['total_qty']; ?></td>
                                                                                <td><input min=0 type="number" style="width: 40px;" value=0 max="<?php echo $pr['total_qty']; ?>" name="pr_qty[]" />
                                                                                    <input type="hidden" value="<?php echo $pr['pid']; ?>" name="pid[]" /></td>
                                                                                <input type="hidden" value="<?php echo $pr['id']; ?>" name="id[]" /></td>
                                                                            </tr>


                                                                            <?php $index++;
                                                                            } ?>

                                                                        </tbody>

                                                                    </table>

                                                                </div>

                                                            </div>

                                                            <div class="row">


                                                                <div class="col-md-11">

                                                                    <input type="submit" id="product_warehouse_submit" class="btn btn-success margin-bottom" value="Send Products to Salesperson" data-loading-text="Adding..." />

                                                                    <input type="hidden" id="product_warehouse_url" value="projects/sendproductby_tl_sl" class="action-url">

                                                                    <input type="hidden" value="<?php echo $project['id']; ?>" name="project">

                                                                </div>

                                                            </div>

                                                        </form>

                                                    </div>


                                                    <!--  WAREHOUSE PRODUCTS TEAM LEADER -->




                                                </div>

                                            </div>

                                        </div>



                                    </div>

                                </div>


                                <!-- PACKING LIST -->

                                <div class="tab-pane fade" id="packinglist" role="tabpanel" aria-labelledby="packinglist-tab" aria-expanded="false">



                                    <form>

                                        <div class="row">

                                            <div class="col-md-4">

                                                <table cellspacing="0" class="table table-bordered" width="100%">

                                                    <thead>

                                                        <tr>

                                                            <th>Product</th>

                                                            <th colspan="2" style="text-align: center;">Quantity</th>



                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                        <tr>

                                                            <td style="color: purple">Queen Pillow</td>

                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 5) { ?> disabled="true" <?php } ?> value="20" /></td>

                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 3) { ?> disabled="true" <?php } ?> value="20" /></td>

                                                        </tr>

                                                        <tr>

                                                            <td style="color: purple">King Pillow</td>

                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 5) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 3) { ?> disabled="true" <?php } ?> value="20" /></td>

                                                        </tr>

                                                        <tr>

                                                            <td style="color: purple">Queen Pillow</td>

                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 5) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 3) { ?> disabled="true" <?php } ?> value="20" /></td>

                                                        </tr>

                                                        <tr>

                                                            <td style="color: purple">Lumber</td>

                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 5) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 3) { ?> disabled="true" <?php } ?> value="20" /></td>

                                                        </tr>

                                                    </tbody>

                                                </table>

                                            </div>

                                            <div class="col-md-6">

                                                <table>

                                                    <table cellspacing="0" class="table table-bordered" width="100%">

                                                        <thead>

                                                            <tr>

                                                                <th>Product</th>

                                                                <th>Color</th>

                                                                <th colspan="2" style="text-align: center;">Quantity</th>



                                                            </tr>

                                                        </thead>

                                                        <tbody>

                                                            <tr>

                                                                <td style="color: purple">Metal - iPhone</td>

                                                                <td><input type="text" style="width: 70px" value="Black" /></td>

                                                                <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 5) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                                <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 3) { ?> disabled="true" <?php } ?> value="20" /></td>

                                                            </tr>

                                                            <tr>

                                                                <td style="color: purple">Metal - iPhone</td>

                                                                <td><input type="text" style="width: 70px" value="Blue" /></td>

                                                                <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 5) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                                <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 3) { ?> disabled="true" <?php } ?> value="20" /></td>

                                                            </tr>

                                                            <tr>

                                                                <td style="color: purple">Metal - iPhone</td>

                                                                <td><input type="text" style="width: 70px" value="Purple" /></td>

                                                                <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 5) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                                <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 3) { ?> disabled="true" <?php } ?> value="20" /></td>

                                                            </tr>



                                                        </tbody>

                                                    </table>

                                                </table>

                                            </div>

                                            <div class="col-md-2">

                                                <div>

                                                    <p style="font-size: 12px;font-weight: 900">FLASHBOX CHECKOUT</p>

                                                    <table>

                                                        <tr>

                                                            <td> <input type="checkbox" style="font-size: 20px" name="ck_1">

                                                            </td>

                                                            <td>Envelopes

                                                            </td>



                                                        </tr>

                                                        <tr>

                                                            <td>

                                                                <input type="checkbox" style="font-size: 20px" name="ck_2">

                                                            </td>

                                                            <td>

                                                                Waranty Cards

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td>

                                                                <input type="checkbox" style="font-size: 20px" name="ck_2">

                                                            </td>

                                                            <td>

                                                                Business Cards

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td>

                                                                <input type="checkbox" style="font-size: 20px" name="ck_2">

                                                            </td>

                                                            <td>

                                                                Sharpless

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td>

                                                                <input type="checkbox" style="font-size: 20px" name="ck_2">

                                                            </td>

                                                            <td>

                                                                Pens

                                                            </td>

                                                        </tr>

                                                    </table>





                                                    <br>







                                                </div>

                                            </div>

                                        </div>

                                    </form>

                                </div>



                                <!-- Sales PACKING LIST -->

                                <div class="tab-pane fade" id="salses_packinglist" role="tabpanel" aria-labelledby="salses_packinglist-tab" aria-expanded="false">



                                    <div class="row">

                                        <div class="col-md-4">

                                            <table cellspacing="0" class="table table-bordered" style="width: auto;">

                                                <thead>

                                                    <tr>

                                                        <th>#</th>



                                                        <th>Product Name</th>



                                                        <th>Sales Person Name</th>

                                                        <th>Requested Quantity</th>

                                                        <th>Approved Quantity</th>

                                                        <th>Action</th>

                                                    </tr>

                                                </thead>

                                                <tbody style="text-align: center;">





                                                    <tr>

                                                        <td>1</td>

                                                        <td>Queen Pillow</td>

                                                        <td>Sales Person 2</td>

                                                        <td><input type="number" name="product_requested_quantity" disabled value="20"></td>

                                                        <td><input type="number" name="product_requested_quantity" value="15"></td>

                                                        <td><button type="submit" class="btn btn-sm btn-success">Approve</button></td>

                                                    </tr>



                                                </tbody>

                                            </table>



                                        </div>



                                    </div>

                                </div>




                                <!-- TEAM PACKING LIST REQUEST FOR BUSINESS OWNER-->

                                <div class="tab-pane fade" id="teamleader_request" role="tabpanel" aria-labelledby="teamleader_request-tab" aria-expanded="false">



                                    <div class="row">

                                        <div class="col-md-4">

                                            <table cellspacing="0" class="table table-bordered" style="width: auto;">

                                                <thead>

                                                    <tr>

                                                        <th>#</th>



                                                        <th>Product Name</th>



                                                        <th>Sales Person Name</th>

                                                        <th>Requested Quantity</th>

                                                        <th>Approved Quantity</th>

                                                        <th>Action</th>

                                                    </tr>

                                                </thead>

                                                <tbody style="text-align: center;">



                                                    <tr>

                                                        <td data-toggle="modal" data-target="#task_model">1</td>

                                                        <td data-toggle="modal" data-target="#task_model" style="color: purple">King Pillow</td>

                                                        <td>Sales Person 1</td>

                                                        <td><input type="number" name="product_requested_quantity" value="20"></td>

                                                        <td><input type="number" name="product_requested_quantity" disabled value="15"></td>

                                                        <td><button type="submit" class="btn btn-sm btn-success">Confirm receipt</button></td>

                                                    </tr>

                                                    <tr>

                                                        <td data-toggle="modal" data-target="#task_model">2</td>

                                                        <td data-toggle="modal" data-target="#task_model" style="color: purple">Queen Pillow</td>

                                                        <td>Sales Person 2</td>

                                                        <td><input type="number" name="product_requested_quantity" value="20"></td>

                                                        <td><input type="number" name="product_requested_quantity" disabled value="0"></td>

                                                        <td><button type="submit" class="btn btn-sm btn-danger">Requested</button></td>

                                                    </tr>



                                                </tbody>

                                            </table>



                                        </div>



                                    </div>

                                </div>

                                <!-- SALES PERSON -->



                                <!--  SALES PERSON  -->



                                <!-- Location -->

                                <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab" aria-expanded="false">


                                    <div class="card card-block">

                                        <div id="notify" class="alert alert-success" style="display:none;">

                                            <a href="#" class="close" data-dismiss="alert">&times;</a>



                                            <div class="message"></div>

                                        </div>

                                        <div class="grid_3 grid_4">





                                            <form method="post" class="form-horizontal <?php if ($this->aauth->get_user()->roleid == 3) {
                                                                                            echo 'disablefield';
                                                                                        } ?>">



                                                <h5><?php echo $this->lang->line('Location') ?> Info</h5>

                                                <hr>

                                                <div class="form-group row">

                                                    <label class="col-sm-2 col-form-label" for="contact_person"><b>Contact Person </b><i style="color:red">*</i></label>

                                                    <div class="col-sm-6">

                                                        <input type="text" placeholder="Contact Person" class="form-control " name="contact_person" />

                                                    </div>

                                                </div>

                                                <div class="form-group row">

                                                    <label class="col-sm-2 col-form-label" for="contact_number"><b>Contact Number </b><i style="color:red">*</i></label>

                                                    <div class="col-sm-6">

                                                        <input type="text" placeholder="Contact Number" class="form-control " name="contact_number" />



                                                    </div>

                                                </div>
                                                <div class="form-group row">

<label class="col-sm-2 col-form-label" for="contact_email"><b>Contact Email </b><i style="color:red">*</i></label>

<div class="col-sm-6">

    <input type="email" placeholder="Contact Email" class="form-control " name="contact_email" />



</div>

</div>

                                                <div class="form-group row">

                                                    <label class="col-sm-2 col-form-label" for="extension"><b>Extension (if any)</b></label>

                                                    <div class="col-sm-6">

                                                        <input type="text" placeholder="Extension" class="form-control" name="extension" />

                                                    </div>

                                                </div>



                                                <div class="form-group row">



                                                    <label class="col-sm-2 col-form-label" for="indoor_outdoor"><b><?php echo $this->lang->line('Indoor') ?>/<?php echo $this->lang->line('Outdoor') ?><i style="color:red">*</i></b></label>

                                                    <div class="col-sm-4">

                                                        <select name="indoor_outdoor" class="form-control ">



                                                            <option value="1">Indoor</option>

                                                            <option value="2">Outdoor</option>





                                                        </select>

                                                    </div>





                                                </div>





                                                <div class="form-group row">

                                                    <label class="col-sm-2 col-form-label" for="address"><b><?php echo $this->lang->line('Address') ?><i style="color:red">*</i></b></label>

                                                    <div class="col-sm-6">

                                                        <textarea placeholder="Address" class="form-control " name="address"></textarea>

                                                    </div>

                                                </div>



                                                <div class="form-group row">









                                                    <div id="googleMap" style="width:100%;height:400px;"></div>

                                                </div>

                                                <div class="form-group row">

                                                    <div class="col-sm-4">

                                                        <div class="form-group row">

                                                            <div class="col-sm-10">

                                                                <input type="button" class="btn btn-success sub-btn" value="<?php echo $this->lang->line('Add') ?> " id="submit-data123" data-loading-text="Creating...">

                                                            </div>

                                                        </div>

                                                        <input type="hidden" id="action-url">

                                                        <input type="hidden" value="<?php echo $project['id']; ?>" name="nid">

                                                    </div>

                                                </div>



                                            </form>

                                        </div>

                                    </div>

                                </div>

                                <!-- Location -->


                            </div>

                        </div>

                    </div>





                    <div id="pop_model" class="modal fade">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;

                                    </button>

                                    <h4 class="modal-title"><?php echo $this->lang->line('Change Status'); ?></h4>

                                </div>



                                <div class="modal-body">

                                    <form id="form_model">





                                        <div class="row">

                                            <div class="col-xs-12 mb-1"><label for="status"><?php echo $this->lang->line('Change Status') ?></label>

                                                <select name="stat" class="form-control mb-1">

                                                    <option value="Due">Due</option>

                                                    <option value="Progress">Progress</option>

                                                    <option value="Done">Done</option>

                                                </select>



                                            </div>

                                        </div>



                                        <div class="modal-footer">

                                            <input type="hidden" class="form-control" name="tid" id="taskid" value="">

                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>

                                            <input type="hidden" id="action-url" value="tools/set_show_task">

                                            <button type="button" class="btn btn-primary" id="submit_model"><?php echo $this->lang->line('Change Status'); ?></button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>



                    <div id="task_model" class="modal fade">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;

                                    </button>

                                    <h4 class="modal-title" id="task_title"><?php echo $this->lang->line('Details'); ?></h4>

                                </div>



                                <div class="modal-body">

                                    <form id="form_model">





                                        <div class="row">

                                            <div class="col-xs-12 mb-1" id="description">



                                            </div>

                                        </div>

                                        <hr>

                                        <div class="row">

                                            <div class="col-xs-12 mb-1"><?php echo $this->lang->line('Priority') ?> <strong><span id="priority"></span></strong>



                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-xs-12 mb-1"><?php echo $this->lang->line('Assigned to') ?>

                                                <strong><span id="employee"></span></strong>



                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-xs-12 mb-1"><?php echo $this->lang->line('Assigned by') ?>

                                                <strong><span id="assign"></span></strong>



                                            </div>

                                        </div>



                                        <div class="modal-footer">

                                            <input type="hidden" class="form-control" name="tid" id="taskid" value="">

                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>



                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- ---------------------  Packing List History --------------------- -->

                    <div id="history_model" class="modal fade ">

                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;

                                    </button>

                                    <h4 class="modal-title" id="task_title"><?php echo $this->lang->line('Details'); ?></h4>

                                </div>



                                <div class="modal-body">
                                    <form>
                                        <table id="historymodeltable" class="table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Product Name</th>
                                                    <th>Requested Product</th>
                                                    <th>Approved Product</th>
                                                    <th>Requested At</th>
                                                    <th>Approved At</th>
                                                    <th>Received At</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>

                                        </table>
                                    </form>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- ---------------------  Packing List History --------------------- -->

                </div>

            </div>

        </div>

        <!-- add task -->

        <!--dynamic delete -->

        <div id="delete_model_1" class="modal fade">

            <form id="mform_1">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>

                        </div>



                        <div class="modal-footer">

                            <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">

                            <input type="hidden" id="object-id_1" value="" name="object_id">

                            <input type="hidden" id="action-url_1" value="projects/delete_file_show">

                            <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm" id="delete-confirm_1"><?php echo $this->lang->line('Delete') ?> </button>

                            <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Cancel') ?></button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

        <!--dynamic delete TL-->

        <div id="delete_tl_1" class="modal fade">

            <form id="mform_tl_1">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title"><?php echo $this->lang->line('DeleteTL') ?></h4>

                        </div>



                        <div class="modal-footer">

                            <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">

                            <input type="hidden" id="request_id" value="" name="object_id">

                            <input type="hidden" id="action-tl-1" value="/projects/delete_tl_show">

                            <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm-tl" id="delete_tl_1"><?php echo $this->lang->line('Delete') ?> </button>

                            <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Cancel') ?></button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

        <!--dynamic delete 2-->

        <div id="delete_model_2" class="modal fade">

            <form id="mform_2">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
                            <p>Are you sure want to delete this milestone ? All Tasks are in this milestone will be also deleted.</p>

                        </div>



                        <div class="modal-footer">



                            <input type="hidden" id="object-id_2" value="" name="object_id">

                            <input type="hidden" id="action-url_2" value="projects/delete_milestone_show">

                            <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm" id="delete-confirm_2"><?php echo $this->lang->line('Delete') ?></button>

                            <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Cancel') ?></button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

        <!-- 21 Confirm Reciept -->


        <div id="delete_model_21" class="modal fade">

            <form id="mform_21">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title">Confirmation Message</h4>

                        </div>

                        <div class="modal-body">

                            <p>Are you sure want to Confirm receipt of this item ? </p>

                        </div>

                        <div class="modal-footer">

                            <input type="hidden" id="object-id_21" value="" name="object_id">

                            <input type="hidden" id="approved_qty_21" value="" name="approve_qty">

                            <input type="hidden" id="action-url_21" value="projects/confirm_reciept_by_tl">

                            <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm" id="delete-confirm_21">Confirm</button>

                            <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Cancel') ?></button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

        <!-- 3 -->

        <div id="delete_model_3" class="modal fade">

            <form id="mform_3">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>

                        </div>

                        <div class="modal-body">

                            <p><?php echo $this->lang->line('delete this task') ?> </p>

                        </div>

                        <div class="modal-footer">

                            <input type="hidden" id="object-id_3" value="" name="deleteid">

                            <input type="hidden" id="action-url_3" value="tools/delete_i_show">

                            <input type="hidden" name="show_id" value="<?php echo $_GET['id']; ?>">

                            <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm" id="delete-confirm_3"><?php echo $this->lang->line('Delete') ?></button>

                            <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Cancel') ?></button>

                        </div>

                    </div>

                </div>

        </div>

        <!-- 6 Delete Booth-->

        <div id="delete_model_6" class="modal fade">



            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>

                    </div>

                    <div class="modal-body">

                        <p>Are you sue you want to delete this Booth Details ? </p>

                    </div>

                    <form id="mform_6">
                        <div class="modal-footer">



                            <input type="hidden" id="object-id_6" value="" name="object_id">

                            <input type="hidden" id="action-url_6" value="projects/delete_booth">

                            <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm" id="delete-confirm_6"><?php echo $this->lang->line('Delete') ?></button>

                            <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Cancel') ?></button>



                        </div>
                    </form>

                </div>

            </div>



        </div>


        <!-- 17 Approve Team Leader ---------------->

        <div id="delete_model_17" class="modal fade">

            <form id="mform_17">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title">Confirmation Message</h4>

                        </div>

                        <div class="modal-body">

                            <p>Are you sure want to Approved product Qantity ? </p>

                        </div>

                        <div class="modal-footer">

                            <input type="hidden" id="object-id_17" value="" name="object_id">

                            <input type="hidden" id="approved_qty_17" value="" name="approve_qty">

                            <input type="hidden" id="action-url_17" value="projects/approve_qty_tl">

                            <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm" id="delete-confirm_17">Approve</button>

                            <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Cancel') ?></button>

                        </div>

                    </div>

                </div>

            </form>

        </div>


        <!-- 28 Approve Sales Person Request -->

        <div id="delete_model_28" class="modal fade">

            <form id="mform_28">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title">Confirmation Message</h4>

                        </div>

                        <div class="modal-body">

                            <p>Are you sure want to Approved product Qantity ? </p>

                        </div>

                        <div class="modal-footer">

                            <input type="hidden" id="object-id_28" value="" name="object_id">

                            <input type="hidden" id="approved_qty_28" value="" name="approve_qty">

                            <input type="hidden" id="action-url_28" value="projects/approve_qty_sl">

                            <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm" id="delete-confirm_28">Approve</button>

                            <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Cancel') ?></button>

                        </div>

                    </div>

                </div>

            </form>

        </div>




        <!-- 11 Accept Team Leader-->

        <div id="delete_model_11" class="modal fade">

            <form id="mform_11">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            