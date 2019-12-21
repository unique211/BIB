<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class=" animated fadeInRight">
                <div class="col-md-8">
                    <div class="card card-block bg-white">
                        <div id="notify" class="alert alert-success" style="display:none;">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>

                            <div class="message"></div>
                        </div>
                        <form method="post" id="data_form" class="form-horizontal">
                            <div class="grid_3 grid_4">

                                <h3><?php echo $this->lang->line('Employee Details') ?> </h3>
                                <hr>
                                <div class="form-group row">

                                    <label class="col-sm-6 col-form-label" for="name"><?php echo $this->lang->line('UserName') ?>
                                        <small class="error">(Use Only a-z0-9)</small>
                                    </label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control margin-bottom required" name="username" placeholder="username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="radio" style="margin-left:20px;" name="selection" id="selection_old" value="frm_list" checked>From Square list</input>
                                    <input type="radio" style="margin-left:20px;" name="selection" id="selection_new" value="new">Create New</input>
                                </div>
                                <div class="form-group row" id="api_emp">

                                    <label class="col-sm-6 col-form-label" for="employee"><?php echo $this->lang->line('Employees') ?>
                                    </label>

                                    <div class="col-sm-10">
                                        <select name="employee" class="form-control margin-bottom">

                                            <option value="select_emp">Select Members</option>
                                            <?php
                                            foreach ($employee as $key => $value) {
                                                echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                            }
                                            ?>


                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-6 col-form-label" for="email">Email</label>

                                    <div class="col-sm-10">
                                        <input type="email" placeholder="email" class="form-control margin-bottom required" name="email" placeholder="email">
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <label class="col-sm-6 col-form-label" for="password"><?php echo $this->lang->line('Password') ?>
                                        <small>(min length 6)</small>
                                    </label>

                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Password" class="form-control margin-bottom required" name="password" placeholder="password">
                                    </div>
                                </div>
                                <?php if ($this->aauth->get_user()->roleid >= 0) { ?>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('UserRole') ?></label>

                                        <div class="col-sm-5">
                                            <select name="roleid" class="form-control margin-bottom">

                                                <option value="3">Team Leader</option>
                                                <option value="5">Business Owner</option>
                                                <option value="2">Sales Team</option>
                                                <option value="1">Inventory Manager</option>

                                            </select>
                                        </div>
                                    </div>


                                <?php } ?>

                                <hr>

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Name') ?></label>

                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Name" class="form-control margin-bottom required" name="name" placeholder="Full name">
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label" for="address"><?php echo $this->lang->line('Address') ?></label>

                                    <div class="col-sm-10">
                                        <input type="text" placeholder="address" class="form-control margin-bottom" name="address">
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label" for="city"><?php echo $this->lang->line('City') ?></label>

                                    <div class="col-sm-10">
                                        <input type="text" placeholder="City" class="form-control margin-bottom" name="city">
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label" for="state"><?php echo $this->lang->line('State') ?></label>

                                    <div class="col-sm-10">
                                        <input type="text" placeholder="State" class="form-control margin-bottom" name="state">
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label" for="zipcode"><?php echo $this->lang->line('ZipCode') ?></label>

                                    <div class="col-sm-10">
                                        <input type="text" placeholder="ZipCode" class="form-control margin-bottom" name="zipcode">
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label" for="phone"><?php echo $this->lang->line('Phone') ?></label>

                                    <div class="col-sm-10">
                                        <input type="text" placeholder="phone" class="form-control margin-bottom" name="phone">
                                    </div>
                                </div>


                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label" for="Phone Number"><?php echo $this->lang->line('Phone Number') ?></label>

                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Phone Number" class="form-control margin-bottom" name="ph_no">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="ac_nm">Account Number</label>

                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Account Number" class="form-control margin-bottom required" name="account_number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="Referred By">Referred By</label>

                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Referred By" class="form-control margin-bottom required" name="referred_by">
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label"></label>

                                    <div class="col-sm-4">
                                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom" value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">
                                        <input type="hidden" value="/employee/submit_user" id="action-url">
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $("#profile_add").click(function(e) {
        e.preventDefault();
        var actionurl = baseurl + 'user/submit_user';
        actionProduct1(actionurl);
    });
</script>

<script>
    function actionProduct1(actionurl) {

        $.ajax({

            url: actionurl,
            type: 'POST',
            data: $("#product_action").serialize(),
            dataType: 'json',
            success: function(data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-warning").addClass("alert-success").fadeIn();


                $("html, body").animate({
                    scrollTop: $('html, body').offset().top
                }, 200);
                $("#product_action").remove();
            },
            error: function(data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").animate({
                    scrollTop: $('#notify').offset().top
                }, 1000);

            }

        });


    }
    $('input[type=radio][name=selection]').change(function() {
        if (this.value == 'new') {
            $("#api_emp").css('display', "none");
        } else {
            $("#api_emp").css('display', "");
        }
    });
</script>