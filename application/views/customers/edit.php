<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="card card-block">
                <div id="notify" class="alert alert-success" style="display:none;">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>

                    <div class="message"></div>
                </div>
            
                <h3>Customer</h3>
               
              
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <p></p>
                            <ul class="nav nav-tabs nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" id="customeredit-tab" data-toggle="tab" href="#customeredit"
                                       aria-controls="customeredit"
                                       aria-expanded="true">Edit Customers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes"
                                       aria-controls="notes"><?php echo $this->lang->line('Notes') ?></a>
                                </li>
                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <div role="tabpanel" class="tab-pane fade active in" id="customeredit"
                                     aria-labelledby="customeredit-tab" aria-expanded="true">
                                    <div class="table-responsive col-sm-12">
                                      <form method="post" id="data_form" class="form-horizontal">
            <div class="row">
                <div class="col-md-6">
                    <h5><?php echo $this->lang->line('Billing Address') ?></h5>
                    <input type="hidden" name="id" value="<?php echo $customer['id'] ?>">

                    <br>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_name"><?php echo $this->lang->line('Name') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="Name"
                                   class="form-control margin-bottom required" name="name"
                                   value="<?php echo $customer['name'] ?>" id="mcustomer_name">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_name"><?php echo $this->lang->line('Company') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="Company"
                                   class="form-control margin-bottom" name="company"
                                   value="<?php echo $customer['company'] ?>">
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="phone"><?php echo $this->lang->line('Phone') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="phone"
                                   class="form-control margin-bottom  required" name="phone"
                                   value="<?php echo $customer['phone'] ?>" id="mcustomer_phone">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label" for="email">Email</label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="email"
                                   class="form-control margin-bottom required" name="email"
                                   value="<?php echo $customer['email'] ?>" id="mcustomer_email">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_name"><?php echo $this->lang->line('Address') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="address"
                                   class="form-control margin-bottom" name="address"
                                   value="<?php echo $customer['address'] ?>" id="mcustomer_address1">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="city"><?php echo $this->lang->line('City') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="city"
                                   class="form-control margin-bottom" name="city"
                                   value="<?php echo $customer['city'] ?>" id="mcustomer_city">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="region"><?php echo $this->lang->line('Region') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="region"
                                   class="form-control margin-bottom" name="region"
                                   value="<?php echo $customer['region'] ?>" id="region">
                        </div>
                    </div>
                   
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="postbox"><?php echo $this->lang->line('PostBox') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="region"
                                   class="form-control margin-bottom" name="postbox"
                                   value="<?php echo $customer['postbox'] ?>" id="postbox">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="postbox"><?php echo $this->lang->line('Tax') ?> ID</label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="TAX ID"
                                   class="form-control margin-bottom" name="taxid"
                                   value="<?php echo $customer['taxid'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="customergroup"><?php echo $this->lang->line('Customer group') ?></label>

                        <div class="col-sm-6">
                            <select name="customergroup" class="form-control">
                                <?php
                                echo '<option value="' . $customergroup['id'] . '">' . $customergroup['title'] . ' (S)</option>';
                                foreach ($customergrouplist as $row) {
                                    $cid = $row['id'];
                                    $title = $row['title'];
                                    echo "<option value='$cid'>$title</option>";
                                }
                                ?>
                            </select>


                        </div>
                    </div>


                </div>

                <div class="col-md-6">
                    <h5><?php echo $this->lang->line('Shipping Address') ?></h5>
                    <br>
                    <div class="form-group row">

                        <div class="input-group">
                            <label class="display-inline-block custom-control custom-radio ml-1">
                                <input type="checkbox" name="customer1" class="custom-control-input" id="copy_address">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description ml-0"><?php echo $this->lang->line('Same As Billing') ?></span>
                            </label>

                        </div>

                        <div class="col-sm-10">
                            <?php echo $this->lang->line("leave Shipping Address") ?>
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_name"><?php echo $this->lang->line('Name') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="Name"
                                   class="form-control margin-bottom" name="name_s"
                                   value="<?php echo $customer['name_s'] ?>" id="mcustomer_name_s">
                        </div>
                    </div>


                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="phone"><?php echo $this->lang->line('Phone') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="phone"
                                   class="form-control margin-bottom" name="phone_s"
                                   value="<?php echo $customer['phone_s'] ?>" id="mcustomer_phone_s">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label" for="email">Email</label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="email"
                                   class="form-control margin-bottom" name="email_s"
                                   value="<?php echo $customer['email_s'] ?>" id="mcustomer_email_s">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_name"><?php echo $this->lang->line('Address') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="address"
                                   class="form-control margin-bottom" name="address_s"
                                   value="<?php echo $customer['address_s'] ?>" id="mcustomer_address1_s">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="city"><?php echo $this->lang->line('City') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="city"
                                   class="form-control margin-bottom" name="city_s"
                                   value="<?php echo $customer['city_s'] ?>" id="mcustomer_city_s">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="region"><?php echo $this->lang->line('Region') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="region"
                                   class="form-control margin-bottom" name="region_s"
                                   value="<?php echo $customer['region_s'] ?>" id="region_s">
                        </div>
                    </div>
                    
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="postbox"><?php echo $this->lang->line('PostBox') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="region"
                                   class="form-control margin-bottom" name="postbox_s"
                                   value="<?php echo $customer['postbox_s'] ?>" id="postbox_s">
                        </div>
                    </div>


                </div>

            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"></label>

                <div class="col-sm-4">
                    <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                           value="Update customer" data-loading-text="Updating...">
                    <input type="hidden" value="customers/editcustomer" id="action-url">
                </div>
            </div>
        </form>
                                        <!-- ---------------------Add Edit Customer Page Data-------- -->
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab" aria-expanded="false">
                                    <!-- -----------Add Table--------------------------- -->
                                    <div class="row">
                <div class="col-md-6">
                
                        </div>
                   <div class="col-md-6">    
                            <a href="/customers/editchange" style="float: right;" class="btn btn-primary"><b style="color:white">Add New</b></a>
                        </div>
             </div>           

            <hr>
            <div id="notes" class="display">
            <table id="notesData" class="display" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>#</th>
                    <th>No</th>
                    <th><?php echo $this->lang->line('Note date') ?></th>
                    <th><?php echo $this->lang->line('Note Text') ?></th>
                    <th><?php echo $this->lang->line('Reminder Date') ?></th>
                    <th><?php echo $this->lang->line('Action') ?></th>
                </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                <tr>
                  <th>#</th>
                   <th>No</th>
                    <th><?php echo $this->lang->line('Note date') ?></th>
                    <th><?php echo $this->lang->line('Note Text') ?></th>
                    <th><?php echo $this->lang->line('Reminder Date') ?></th>
                    <th><?php echo $this->lang->line('Action') ?></th>

                </tr>
                </tfoot>
            </table>
        </div>
                                     <!-- -----------Add Table--------------------------- -->
                                     <!-- <h2>Hello 2</h2> -->
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

              $('#notesData').DataTable({});

        });

    </script>
    