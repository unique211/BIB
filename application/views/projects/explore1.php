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
                            <?php echo $project['name'] ?>
                        </h3>
                        <p><?php echo $this->lang->line('Status') ?>: <span class="project_<?php echo $project['status'] ?>"><?php echo $this->lang->line($project['status']) ?></span>
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
                                                <h3 class="pink" id="dash_0"></h3>
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
                                                <h3 class="indigo" id="dash_1"></h3>
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
                                                <h3 class="green" id="dash_2"></h3>
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
                                                <h3 class="deep-cyan" id="dash_6"><?php echo $totalt ?></h3>
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
                                <b><a href="#" class="btn btn-primary btn-sm rounded">
                                        1003
                                        <!--  <?php echo $project['id']; ?> -->
                                    </a>
                                    <a href="#" class="btn btn-primary btn-sm rounded">
                                        <?php echo $project['name']; ?>
                                    </a></b>
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
                                    <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" aria-controls="active" aria-expanded="true"><?php echo $this->lang->line('Summary') ?></a>
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

                              

                                <li class="nav-item">
                                    <a class="nav-link" id="communication-tab" data-toggle="tab" href="#communication" aria-controls="communication"><?php echo $this->lang->line('Communication') ?></a>
                                </li>

                                <?php } ?>
                                <?php if ($this->aauth->get_user()->roleid == 5) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="teamleader-tab" data-toggle="tab" href="#teamleader" aria-controls="teamleader"><?php echo $this->lang->line('Team Leader') ?></a>
                                    </li>
                               
                                <li class="nav-item">
                                    <a class="nav-link" id="thread-tab" data-toggle="tab" href="#activities" aria-controls="activities"><?php echo $this->lang->line('Activities Log') ?></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="linkOpt-tab" data-toggle="tab" href="#files" aria-controls="files"><?php echo $this->lang->line('Files') ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="salesperson1-tab" data-toggle="tab" href="#salesperson1" aria-controls="salesperson1"><?php echo $this->lang->line('Break timings') ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="packinglist-tab" data-toggle="tab" href="#packinglist" aria-controls="packinglist"><?php echo $this->lang->line('Packing List') ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="linkOpt-tab" data-toggle="tab" href="#notes" aria-controls="notes"><?php echo $this->lang->line('Notes') ?></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="invoices-tab" data-toggle="tab" href="#invoices" aria-controls="invoices"><?php echo $this->lang->line('Invoices') ?></a>
                                </li>
                                <?php } ?>
                                <?php if ($this->aauth->get_user()->roleid == 5) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" aria-controls="comments"><?php echo $this->lang->line('Comments') ?></a>
                                    </li>
                              
                                <li class="nav-item">
                                    <a class="nav-link" id="Attendees-tab" data-toggle="tab" href="#Attendees" aria-controls="Attendees"><?php echo $this->lang->line('Attendees') ?></a>
                                </li>
                                <?php } ?>



                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <div role="tabpanel" class="tab-pane fade active in" id="active" aria-labelledby="active-tab" aria-expanded="true">
                                    <p>
                                        <!-- <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show') ?> #
                                        </a>  <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show Name') ?> 
                                        </a> -->
                                    </p>
                                    <div class="table-responsive col-sm-12">
                                        <table class="table">

                                            <tbody>
                                                <tr>
                                                    <th scope="row"><?php echo $this->lang->line('Name') ?></th>
                                                    <td>
                                                        <p><?php echo $project['name'] ?></p>

                                                    </td>

                                                </tr>
                                                <!--   <tr>
                                                <th scope="row"><?php echo $this->lang->line('Priority') ?></th>
                                                <td>
                                                    <p><?php echo $project['priority'] ?></p>

                                                </td>

                                            </tr> -->
                                                <tr>
                                                    <th scope="row"><?php echo $this->lang->line('Status') ?></th>
                                                    <td>
                                                        <p><?php echo $this->lang->line($project['status']) ?></p>

                                                    </td>

                                                </tr>

                                                <tr>
                                                    <th scope="row"><?php echo $this->lang->line('Start Date') ?></th>
                                                    <td>
                                                        <p><?php echo dateformat($project['sdate']) ?></p>

                                                    </td>

                                                </tr>

                                                <tr>
                                                    <th scope="row"><?php echo $this->lang->line('Tags') ?></th>
                                                    <td>
                                                        <p><?php echo $project['tag'] ?></p>

                                                    </td>

                                                </tr>

                                                <tr>
                                                    <th scope="row"><?php echo $this->lang->line('Default Warehouse') ?></th>
                                                    <td>
                                                        <p>Warehouse 1</p>

                                                    </td>

                                                </tr>

                                                <tr>
                                                    <th scope="row"><?php echo $this->lang->line('Shipping Option') ?></th>
                                                    <td>
                                                        <p><?php echo $this->lang->line('Ship') ?></p>

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

                                <!--  Attendess  -->

                                <div role="tabpanel" class="tab-pane fade " id="Attendees" aria-labelledby="Attendees-tab" aria-expanded="true">

                                    <div class="table-responsive col-sm-12">
                                        <table class="table">

                                            <tbody>
                                                <tr>
                                                    <th scope="row"><?php echo $this->lang->line('Person Name') ?></th>
                                                    <th scope="row"><?php echo $this->lang->line('Title') ?></th>
                                                    <th scope="row"><?php echo $this->lang->line('Booth') ?></th>
                                                    <th scope="row"><?php echo $this->lang->line('Product Category') ?></th>
                                                </tr>



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



                                <!--- Communication -->

                                <div class="tab-pane fade" id="communication" role="tabpanel" aria-labelledby="communication-tab" aria-expanded="false">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-block">

                                                <ul class="nav nav-tabs nav-justified">

                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="milestones-tab" data-toggle="tab" href="#milestones" aria-controls="milestones"><?php echo $this->lang->line('Milestones') ?></a>
                                                    </li>

                                                    <li class="nav-item"> <a class="nav-link" id="link-tab" data-toggle="tab" href="#link" aria-controls="link" aria-expanded="false"><?php echo $this->lang->line('Tasks') ?></a>
                                                    </li>


                                                    <li class="nav-item">
                                                        <a class="nav-link" id="thread-tab" data-toggle="tab" href="#thread" aria-controls="thread"><?php echo $this->lang->line('Thread') ?></a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content px-1 pt-1">
                                                    <!--milestones-->
                                                    <div role="tabpanel" class="tab-pane fade active in" id="milestones" aria-labelledby="milestones-tab" aria-expanded="true">


                                                        <p><a href="<?php echo base_url('projects/addmilestone?id=' . $project['id']) ?>" class="btn btn-primary btn-sm rounded">
                                                                <?php echo $this->lang->line('Add Milestone') ?>
                                                            </a>
                                                            <!-- <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show') ?> #
                                        </a>  <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show Name') ?> 
                                        </a> -->
                                                        </p>

                                                        <ul class="timeline">
                                                            <?php $flag = true;
                                                            $total = count($milestones);
                                                            foreach ($milestones as $row) {


                                                                ?>
                                                                <li data-block="sec" class="<?php if (!$flag) {
                                                                                                    echo 'timeline-inverted';
                                                                                                } ?>">
                                                                    <div class="timeline-badge" style="background-color: <?php echo $row['color'] ?>;"><?php echo $total ?></div>
                                                                    <div class="timeline-panel">
                                                                        <div class="timeline-heading">
                                                                            <h4 class="timeline-title"><?php echo $row['name'] ?></h4>
                                                                            <p>
                                                                                <small class="text-muted"><i class="glyphicon glyphicon-time"></i> <?php echo $row['sdate'] . ' ~ ' . $row['edate'] . '</small><a href="#" class=" float-xs-right delete-custom" data-did="2" data-object-id="' . $row['id'] . '"><i class="danger icon-trash-o"></i></a>'; ?>
                                                                            </p>
                                                                        </div>
                                                                        <div class="timeline-body">
                                                                            <p><?php echo $row['exp'];
                                                                                    if ($row['task']) echo '</p><p><strong>[Task]</strong> ' . $row['task']; ?></p>

                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            <?php $flag = !$flag;
                                                                $total--;
                                                            } ?>


                                                        </ul>
                                                    </div>
                                                    <!--milestones-->
                                                    <!------ Task ---->
                                                    <div class="tab-pane fade" id="link" role="tabpanel" aria-labelledby="link-tab" aria-expanded="false">
                                                        <p><a href="<?php echo base_url('projects/addtask?id=' . $project['id']) ?>" class="btn btn-primary btn-sm rounded">
                                                                <?php echo $this->lang->line('Add new') . ' ' . $this->lang->line('Task') ?>
                                                            </a>
                                                            <!-- <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show') ?> #
                                        </a>  <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show Name') ?> 
                                        </a> -->
                                                        </p>
                                                        <table id="todotabledata" class="display" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th><?php echo $this->lang->line('Task') ?></th>
                                                                    <th><?php echo $this->lang->line('Due Date') ?></th>
                                                                    <th><?php echo $this->lang->line('Start') ?></th>
                                                                    <th><?php echo $this->lang->line('Status') ?></th>
                                                                    <th><?php echo $this->lang->line('Actions') ?></th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!------ Task ---->
                                                    <!--thread-->
                                                    <div class="tab-pane fade" id="thread" role="tabpanel" aria-labelledby="thread-tab" aria-expanded="false">
                                                        <!--  <p><a href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show') ?> #
                                        </a>  <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show Name') ?> 
                                        </a></p> -->
                                                        <ul class="timeline">
                                                            <?php $flag = true;
                                                            $total = count($thread_list);
                                                            foreach ($thread_list as $row) {


                                                                ?>
                                                                <li class="<?php if (!$flag) {
                                                                                    echo 'timeline-inverted';
                                                                                } ?>">
                                                                    <div class="timeline-badge info"><?php echo $total ?></div>
                                                                    <div class="timeline-panel">
                                                                        <div class="timeline-heading">
                                                                            <h4 class="timeline-title"><?php echo $row['name'] ?></h4>
                                                                            <p>
                                                                                <small class="text-muted"><i class="glyphicon glyphicon-time"></i> <?php echo $row['emp'] . ' ' . $row['start'] . ' ~ ' . $row['duedate'] ?>
                                                                                </small>
                                                                            </p>
                                                                        </div>
                                                                        <div class="timeline-body">
                                                                            <p><?php echo $row['description'] ?></p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            <?php $flag = !$flag;
                                                                $total--;
                                                            } ?>
                                                        </ul>
                                                    </div>
                                                    <!--thread-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!--- Communication -->


                                <!--activities-->
                                <div class="tab-pane fade" id="activities" role="tabpanel" aria-labelledby="activities-tab" aria-expanded="false">
                                    <p><a href="<?php echo base_url('projects/addactivity?id=' . $project['id']) ?>" class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Add activity') ?>
                                        </a>
                                        <!-- <a href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show') ?> #
                                        </a>  <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show Name') ?> 
                                        </a> -->
                                    </p>
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
                                <!--files-->
                                <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab" aria-expanded="false">

                                    <p>

                                        <?php foreach ($p_files as $row) { ?>


                                            <section class="form-group row">


                                                <div data-block="sec" class="col-sm-12">
                                                    <div class="card card-block"><?php


                                                                                        echo '<a href="' . base_url('userfiles/project/' . $row['value']) . '">' . $row['value'] . '</a><a href="#" class="btn btn-danger float-xs-right delete-custom" data-did="1" data-object-id="' . $row['meta_data'] . '"><i class="icon-trash-b"></i></a> ';

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
                                <!--Files-->
                                <!--notes-->
                                <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab" aria-expanded="false">
                                    <!-- <p><a href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show') ?> #
                                        </a>  <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show Name') ?> 
                                        </a></p> -->
                                    <form method="post" id="data_form">
                                        <div class="form-group row">


                                            <div class="col-sm-12">
                                                <textarea class="summernote" placeholder=" Note" autocomplete="false" rows="10" name="content"><?php echo $project['note']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">


                                            <div class="col-sm-10">
                                                <input type="submit" class="btn btn-success sub-btn" value="<?php echo $this->lang->line('Update') ?> " id="submit-data" data-loading-text="Creating...">
                                            </div>
                                        </div>
                                        <input type="hidden" value="/projects/set_note" id="action-url">
                                        <input type="hidden" value="<?php echo $project['id']; ?>" name="nid">
                                    </form>
                                </div>
                                <!--notes-->
                                <!--invoices-->
                                <div class="tab-pane fade" id="invoices" role="tabpanel" aria-labelledby="invoices-tab" aria-expanded="false">
                                    <p><a href="<?php echo base_url('invoices/create?project=' . $project['id']) ?>" class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Create New Invoice') ?>
                                        </a>
                                        <!--  <a href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show') ?> #
                                        </a>  <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show Name') ?> 
                                        </a> -->
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-hover mb-1">
                                            <thead>
                                                <tr>
                                                    <th><?php echo $this->lang->line('Invoices') ?>#</th>
                                                    <th><?php echo $this->lang->line('Status') ?></th>
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
                                <td class="text-truncate">' . $item['invoicedate'] . '</td>
                                <td class="text-truncate">' . $this->config->item('currency') . ' ' . amountFormat($item['total']) . '</td>
                            </tr>';
                                                } ?>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <!--invoices-->
                                <!--comments-->
                                <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab" aria-expanded="false">
                                    <!-- <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show') ?> #
                                        </a>  <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show Name') ?> 
                                        </a> -->
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
                                        <input type="hidden" value="/projects/addcomment" id="action-url2">
                                        <input type="hidden" value="<?php echo $project['id']; ?>" name="nid">
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
                                <!-- BOOTH -->
                                <div class="tab-pane fade" id="booths" role="tabpanel" aria-labelledby="booths-tab" aria-expanded="false">
                                    <!-- <p><a href="<?php echo base_url('index.php/projects/addbooth?id=' . $project['id']) ?>" class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Add new') . ' ' . $this->lang->line('Booth') ?>
                                        </a>

                                    </p> -->

                                    <table id="boothTable" class="display" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>

                                                <th><?php echo $this->lang->line('Size') ?></th>
                                                <th><?php echo $this->lang->line('Cost') ?></th>
                                                <th><?php echo $this->lang->line('Description') ?></th>
                                                <th><?php echo $this->lang->line('Product Name') ?></th>
                                                <th><?php echo $this->lang->line('Team Leader') ?></th>


                                                <!-- <th>Action</th> -->

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>



                                </div>
                                <!-- Booth -->

                                <!-- PACKING LIST -->
                                <div class="tab-pane fade" id="packinglist" role="tabpanel" aria-labelledby="packinglist-tab" aria-expanded="false">
                                    <!--  <p>
                                        <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show') ?> #
                                        </a>  <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show Name') ?> 
                                        </a>

                                     </p> -->
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
                                                            <td>Queen Pillow</td>
                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 5) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 3) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>King Pillow</td>
                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 5) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 3) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Queen Pillow</td>
                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 5) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                            <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 3) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Lumber</td>
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
                                                                <td>Metal - iPhone</td>
                                                                <td><input type="text" style="width: 70px" value="Black" /></td>
                                                                <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 5) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                                <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 3) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Metal - iPhone</td>
                                                                <td><input type="text" style="width: 70px" value="Blue" /></td>
                                                                <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 5) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                                <td><input type="number" style="width: 50px" <?php if ($this->aauth->get_user()->roleid == 3) { ?> disabled="true" <?php } ?> value="20" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Metal - iPhone</td>
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

                                <!-- PACKING LIST -->

                                <!-- SALES PERSON -->

                                <div class="tab-pane fade" id="salesperson1" role="tabpanel" aria-labelledby="salesperson1-tab" aria-expanded="false">
                                    <p><a href="SetBreakTime" class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Set Break Time') ?>
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

                                        </tbody>

                                    </table>



                                </div>

                                <!--  SALES PERSON  -->

                                <!-- Location -->

                                <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab" aria-expanded="false">

                                    </p>
                                    <div class="card card-block">
                                        <div id="notify" class="alert alert-success" style="display:none;">
                                            <a href="#" class="close" data-dismiss="alert">&times;</a>

                                            <div class="message"></div>
                                        </div>
                                        <div class="grid_3 grid_4">


                                            <form method="post" id="data_form" class="form-horizontal">

                                                <h5><?php echo $this->lang->line('Location') ?> Info</h5>
                                                <hr>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="contact_person"><b>Contact Person </b></label>
                                                    <div class="col-sm-6">
                                                        <input type="text" placeholder="contact person" class="form-control" name="contact_person" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="contact_number"><b>Contact Number </b></label>
                                                    <div class="col-sm-6">
                                                        <input type="text" placeholder="contact number" class="form-control" name="contact_number" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="extension"><b>Extension (if any)</b></label>
                                                    <div class="col-sm-6">
                                                        <input type="text" placeholder="Extension" class="form-control" name="extension" />
                                                    </div>
                                                </div>

                                                <div class="form-group row">

                                                    <label class="col-sm-2 col-form-label" for="indoor_outdoor"><b><?php echo $this->lang->line('Indoor') ?>/<?php echo $this->lang->line('Outdoor') ?></b></label>
                                                    <div class="col-sm-4">
                                                        <select name="indoor_outdoor" class="form-control">

                                                            <option>--select--</option>


                                                        </select>
                                                    </div>


                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="address"><b><?php echo $this->lang->line('Address') ?></b></label>
                                                    <div class="col-sm-6">
                                                        <textarea placeholder="Address" class="form-control" name="address"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">




                                                    <div id="googleMap" style="width:100%;height:400px;"></div>
                                                </div>
                                                <div class="form-group row">



                                                    <div class="col-sm-4">
                                                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom" value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                </div>



                                <!-- Location -->

                                <!-- Team Leader -->
                                <div class="tab-pane fade" id="teamleader" role="tabpanel" aria-labelledby="teamleader-tab" aria-expanded="false">
                                    <!-- <p>
                                         <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show') ?> #
                                        </a>  <a
                                                href="#"
                                                class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Show Name') ?> 
                                        </a>
                                    </p> -->
                                    <div class="card card-block">
                                        <div id="notify" class="alert alert-success" style="display:none;">
                                            <a href="#" class="close" data-dismiss="alert">&times;</a>

                                            <div class="message"></div>
                                        </div>
                                        <div class="grid_3 grid_4">
                                            <div class="header-block">
                                                <h3 class="title">Test Show</h3>
                                                <hr>
                                                <form method="post" class="form-horizontal">
                                                    <hr>

                                                    <div class="table-responsive">
                                                        <table id="approveTeamLeader" class="display" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th><?php echo $this->lang->line('Team Leader') ?></th>
                                                                    <th><?php echo $this->lang->line('Applied Date') ?></th>
                                                                    <th><?php echo $this->lang->line('Actions') ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td style="color:purple">Team Leader 1</td>
                                                                    <td>6/05/2019</td>
                                                                    <td><a href="" class="btn btn-success btn-sm rounded" data-id="" data-stat="0"> <i style="font-size: 20px" class="ficon icon-thumbsup"></i></a> <a href="" class="btn btn-danger btn-sm rounded" data-id="'" data-stat="0"> <i style="font-size: 20px" class="ficon icon-thumbsdown"></i></a></td>
                                                                <tr>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td style="color:purple">Team Leader 2</td>
                                                                    <td>5/05/2019</td>
                                                                    <td><a href="" class="btn btn-success btn-sm rounded" data-id="" data-stat="0"> <i style="font-size: 20px" class="ficon icon-thumbsup"></i></a> <a href="" class="btn btn-danger btn-sm rounded" data-id="'" data-stat="0"> <i style="font-size: 20px" class="ficon icon-thumbsdown"></i></a></td>
                                                                <tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Team Leader -->

                                </div>
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
                                            <input type="hidden" id="action-url" value="tools/set_task">
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
                            <input type="hidden" id="action-url_1" value="projects/delete_file">
                            <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm" id="delete-confirm_1"><?php echo $this->lang->line('Delete') ?></button>
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
                        </div>

                        <div class="modal-footer">

                            <input type="hidden" id="object-id_2" value="" name="object_id">
                            <input type="hidden" id="action-url_2" value="projects/delete_milestone">
                            <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm" id="delete-confirm_2"><?php echo $this->lang->line('Delete') ?></button>
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
                            <input type="hidden" id="action-url_3" value="tools/delete_i">
                            <button type="button" data-dismiss="modal" class="btn btn-primary delete-confirm" id="delete-confirm_3"><?php echo $this->lang->line('Delete') ?></button>
                            <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Cancel') ?></button>
                        </div>
                    </div>
                </div>
        </div>


        <!--- Attendece Model--->
        <div id="myModal1" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Sales Person Details</h4>
                    </div>
                    <div class="modal-body">


                        <table class="table ">

                            <tbody>
                                <tr>
                                    <td scope="row"><?php echo $this->lang->line('Total Sales per day') ?></th>
                                    </td>
                                    <td>
                                        <p>22</p>

                                    </td>

                                </tr>
                                <tr>
                                    <td scope="row"><?php echo $this->lang->line('Hours worked per date') ?></td>
                                    <td>
                                        <p>5</p>

                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>


        <!-- Attendece  Model--->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">


        </script>
        <script>
            $('#boothTable').DataTable({
                "ajax": "<?php echo site_url('index.php/projects/getboothlist?id=' . $_GET['id']) ?>"
            });

            $('#SalesPersonTable').DataTable({});
            $('#approveTeamLeader').DataTable({});
        </script>
        <script type="text/javascript">
            $('#todotabledata').DataTable({

                "processing": true,
                "serverSide": true,
                'createdRow': function(row, data, dataIndex) {
                    $(row).attr('data-block', '0');
                },
                "order": [],
                "ajax": {
                    "url": "<?php echo site_url('index.php/projects/todo_load_list') ?>",
                    "type": "POST",
                    data: {
                        'pid': <?php echo $project['id']; ?>
                    }
                },
                "columnDefs": [{
                    "targets": [1],
                    "orderable": true,
                }, ],

            });
        </script>


        <script type="text/javascript">
            $(document).ready(function() {





                // $('#todotabledata').DataTable({});


                $('#todotabledata').DataTable({

                    "processing": true,
                    "serverSide": true,
                    'createdRow': function(row, data, dataIndex) {
                        $(row).attr('data-block', '0');
                    },
                    "order": [],
                    "ajax": {
                        "url": "<?php echo site_url('index.php/projects/todo_load_list') ?>",
                        "type": "POST",
                        data: {
                            'pid': <?php echo $project['id']; ?>
                        }
                    },
                    "columnDefs": [{
                        "targets": [1],
                        "orderable": true,
                    }, ],

                });
                // $('#boothTable').DataTable({});






                $(function() {
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

                $(document).on('click', ".set-task", function(e) {
                    e.preventDefault();
                    $('#taskid').val($(this).attr('data-id'));

                    $('#pop_model').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                });


                $(document).on('click', ".view_task", function(e) {
                    e.preventDefault();

                    var actionurl = 'tools/view_task';
                    var id = $(this).attr('data-id');
                    $('#task_model').modal({
                        backdrop: 'static',
                        keyboard: false
                    });


                    $.ajax({

                        url: baseurl + actionurl,
                        type: 'POST',
                        data: {
                            'tid': id
                        },
                        dataType: 'json',
                        success: function(data) {

                            $('#description').html(data.description);
                            $('#task_title').html(data.name);
                            $('#employee').html(data.employee);
                            $('#assign').html(data.assign);
                            $('#priority').html(data.priority);
                        }

                    });

                });
                miniDash();


            });
        </script>
        <script src="<?php echo base_url('assets/vendors/js/upload/jquery.iframe-transport.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendors/js/upload/jquery.ui.widget.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendors/js/upload/load-image.all.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendors/js/upload/canvas-to-blob.min.js') ?>"></script>
        <!-- The basic File Upload plugin -->
        <script src="<?php echo base_url('assets/vendors/js/upload/jquery.fileupload.js') ?>"></script>
        <!-- The File Upload processing plugin -->
        <script src="<?php echo base_url('assets/vendors/js/upload/jquery.fileupload-process.js') ?>"></script>
        <!-- The File Upload image preview & resize plugin -->
        <script src="<?php echo base_url('assets/vendors/js/upload/jquery.fileupload-image.js') ?>"></script>
        <!-- The File Upload audio preview plugin -->
        <script src="<?php echo base_url('assets/vendors/js/upload/jquery.fileupload-audio.js') ?>"></script>
        <!-- The File Upload video preview plugin -->
        <script src="<?php echo base_url('assets/vendors/js/upload/jquery.fileupload-video.js') ?>"></script>
        <!-- The File Upload validation plugin -->
        <script src="<?php echo base_url('assets/vendors/js/upload/jquery.fileupload-validate.js') ?>"></script>


        <script>
            function myMap() {
                var mapProp = {
                    center: new google.maps.LatLng(51.508742, -0.120850),
                    zoom: 5,
                };
                var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>

        <script>
            /*jslint unparam: true, regexp: true */
            /*global window, $ */
            $(function() {
                'use strict';
                // Change this to the location of your server-side upload handler:
                var url = baseurl + 'projects/file_handling?id=<?php echo $project['id']; ?>',
                    uploadButton = $('<button/>')
                    .addClass('btn btn-primary')
                    .prop('disabled', true)
                    .text('Processing...')
                    .on('click', function() {
                        var $this = $(this),
                            data = $this.data();
                        $this
                            .off('click')
                            .text('Abort')
                            .on('click', function() {
                                $this.remove();
                                data.abort();
                            });
                        data.submit().always(function() {
                            $this.remove();
                        });
                    });
                $('#fileupload').fileupload({
                        url: url,
                        dataType: 'json',
                        autoUpload: false,
                        acceptFileTypes: /(\.|\/)(gif|jpe?g|png|docx|docs|txt|pdf|xls)$/i,
                        maxFileSize: 999000,
                        // Enable image resizing, except for Android and Opera,
                        // which actually support image resizing, but fail to
                        // send Blob objects via XHR requests:
                        disableImageResize: /Android(?!.*Chrome)|Opera/
                            .test(window.navigator.userAgent),
                        previewMaxWidth: 100,
                        previewMaxHeight: 100,
                        previewCrop: true
                    }).on('fileuploadadd', function(e, data) {
                        data.context = $('<div/>').appendTo('#files');
                        $.each(data.files, function(index, file) {
                            var node = $('<p/>')
                                .append($('<span/>').text(file.name));
                            if (!index) {
                                node
                                    .append('<br>')
                                    .append(uploadButton.clone(true).data(data));
                            }
                            node.appendTo(data.context);
                        });
                    }).on('fileuploadprocessalways', function(e, data) {
                        var index = data.index,
                            file = data.files[index],
                            node = $(data.context.children()[index]);
                        if (file.preview) {
                            node
                                .prepend('<br>')
                                .prepend(file.preview);
                        }
                        if (file.error) {
                            node
                                .append('<br>')
                                .append($('<span class="text-danger"/>').text(file.error));
                        }
                        if (index + 1 === data.files.length) {
                            data.context.find('button')
                                .text('Upload')
                                .prop('disabled', !!data.files.error);
                        }
                    }).on('fileuploadprogressall', function(e, data) {
                        var progress = parseInt(data.loaded / data.total * 100, 10);
                        $('#progress .progress-bar').css(
                            'width',
                            progress + '%'
                        );
                    }).on('fileuploaddone', function(e, data) {
                        $.each(data.result.files, function(index, file) {
                            if (file.url) {
                                var link = $('<a>')
                                    .attr('target', '_blank')
                                    .prop('href', file.url);
                                $(data.context.children()[index])
                                    .wrap(link);
                            } else if (file.error) {
                                var error = $('<span class="text-danger"/>').text(file.error);
                                $(data.context.children()[index])
                                    .append('<br>')
                                    .append(error);
                            }
                        });
                    }).on('fileuploadfail', function(e, data) {
                        $.each(data.files, function(index) {
                            var error = $('<span class="text-danger"/>').text('File upload failed.');
                            $(data.context.children()[index])
                                .append('<br>')
                                .append(error);
                        });
                    }).prop('disabled', !$.support.fileInput)
                    .parent().addClass($.support.fileInput ? undefined : 'disabled');
            });

            var slider = $('#progress');
            var textn = $('#prog');
            textn.text(slider.val() + '%');
            $(document).on('change', slider, function(e) {
                e.preventDefault();
                textn.text($('#progress').val() + '%');
                $.ajax({

                    url: baseurl + 'projects/progress',
                    type: 'POST',
                    data: {
                        'pid': <?php echo $project['id']; ?>,
                        'val': $('#progress').val()
                    },
                    dataType: 'json',
                    success: function(data) {

                        $('#description').html(data.description);
                        $('#task_title').html(data.name);
                        $('#employee').html(data.employee);
                        $('#assign').html(data.assign);
                        $('#priority').html(data.priority);
                    }

                });
            });
        </script>