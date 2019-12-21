<body data-open="click" data-menu="vertical-menu" data-col="1-column"
      class="vertical-layout vertical-menu 1-column  blank-page blank-page">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">

                    <div class="card border-grey border-lighten-3 m-0">
                        <div class="card-header no-border">
                            <div class="card-title text-xs-center">
                                <div class="p-1"><img width="100%"
                                            src="<?php echo base_url('userfiles/company/') . $this->config->item('logo'); ?>"
                                            alt="Logo"></div>
                            </div>
                            <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2">
                                <span><?php echo $this->lang->line('employee_login_panel') ?></span>
                            </h6>
                        </div>
                        <div class="card-body collapse in">
                         <h2><?php echo $this->session->flashdata('message_name'); ?></h2>
                            <div class="card-block">
                                <form class="form-horizontal form-simple"
                                      action="<?php echo base_url(); ?>user/checklogin" method="POST">
                                    <fieldset class="form-group position-relative has-icon-left mb-0">
                                        <input type="text" class="form-control form-control-lg input-lg" name="username" id="username"
                                               placeholder="<?php echo $this->lang->line('Your Email') ?>" required>
                                        <div class="form-control-position">
                                            <i class="icon-head"></i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control form-control-lg input-lg"
                                               name="password" placeholder="<?php echo $this->lang->line('Your Password') ?>" required>
                                        <div class="form-control-position">
                                            <i class="icon-key3"></i>
                                        </div>
                                    </fieldset>
                                    <?php if ($response) {
                                        echo '<div id="notify" class="alert alert-danger" >
                            <a href="#" class="close" data-dismiss="alert">&times;</a> <div class="message">' . $response . '</div>
                        </div>';
                                    } ?>

                                    <?php if ($this->aauth->get_login_attempts() > 1 && $captcha_on) {
                                        echo '<script src="https://www.google.com/recaptcha/api.js"></script>
                                    <fieldset class="form-group position-relative has-icon-left">
                                      <div class="g-recaptcha" data-sitekey="' . $captcha . '"></div>
                                    </fieldset>';
                                    } ?>
                                    <fieldset class="form-group row">
                                        <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                            <fieldset>
                                                <input type="checkbox" id="remember-me" class="chk-remember"
                                                       name="remember_me">
                                                <label for="remember-me"> <?php echo $this->lang->line('remember_me') ?></label>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-xs-12 text-xs-center text-md-right"><a
                                                    href="<?php echo base_url('user/forgot'); ?>" class="card-link">
                                                <?php echo $this->lang->line('forgot_password') ?>?</a></div>
                                    </fieldset>
                                    <hr>
                                    <div class="append_div">
                                    </div>
                                 
                                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i
                                                class="icon-unlock2"></i> <?php echo $this->lang->line('login') ?>
                                    </button>

                                </form>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-12 col-xs-12 text-xs-center">

                                <h6 class="card-subtitle text-muted text-xs-center font-small-3 pt-2"><a
                                            href="<?php echo base_url('crm'); ?>"
                                            class="card-link"><?php echo $this->lang->line('customer_login') ?></a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){

        function countProperties(obj) {
            var count = 0;

            for (var property in obj) {
                if (Object.prototype.hasOwnProperty.call(obj, property)) {
                    count++;
                }
            }

            return count;
        }

        $('#username').change(function(){

            var email_id=$("#username").val();
            var show_option='';

            if(email_id != '')
            {
                jQuery.ajax({

                        url: baseurl+"user/getshowdetailsforlogin",

                        type: 'GET',

                        data: {email : email_id},

                        dataType: 'json',

                        success: function (data) {


                            var size=countProperties(data);

                            var append_data='';
   

                            if(size != 0)
                            {
                                append_data="<h6 class='card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2'><span>Please Fill up Below Details for login</span></h6>";
                                append_data+="<fieldset class='form-group row'><label class='col-sm-3 col-form-label' for='show_id'>Select Show</label> <div class='col-sm-9'> <select class='form-control' id='show_id' name='show_id'> <option value=''>--select show--</option>";
                                 for(var i=0;i<size;i++)
                                {
                                     append_data+="<option value="+data[i]['id']+">"+data[i]['show_name']+"</option>";
                                } 

                                append_data+="</select></div></fieldset> <fieldset class='form-group row'><label class='col-sm-3 col-form-label' for='show_id'>Select Booth</label><div class='col-sm-9'><select class='form-control' name='booth_id' id='booth_id'></select></div></fieldset>";

                                $('.append_div').html(append_data);

                                $("#show_id").change(function(){
           
                var show_id=$("#show_id").val();

               
                var option='';
                
                        if(show_id != '')
                        {
                                    jQuery.ajax({

                                    url: baseurl+"user/getboothlistshowloginpage",

                                    type: 'GET',

                                    data: {id: show_id,email : email_id},

                                    dataType: 'json',

                                    success: function (data) {



                                        var size=countProperties(data);

                                        if(size==0)
                                        {
                                             option+="<option value="+''+">No any booth available in selected show</option>";
                                        }
                                        else{
                                             for(var i=0;i<size;i++)
                                            {
                                                 option+="<option value="+data[i]['id']+">"+data[i]['description']+"</option>";
                                            }

                                        }


                                       

                                        $('#booth_id').html(option);
                                              
                                    },
                                    error: function()
                                    {
                                       
                                    },
                                });
                            }
                    });


                            }
                            else
                            {

                                 $('.append_div').html();

                                append_data="<h6 class='card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2'><span>Please Fill up Below Details for login</span></h6>";
                                append_data+="<fieldset class='form-group row'><label class='col-sm-3 col-form-label' for='show_id'>Select Show</label> <div class='col-sm-9'> <select class='form-control' id='show_id' name='show_id'> <option value=''>--No Show Assigned --</option>";
                                 append_data+="</select></div></fieldset> <fieldset class='form-group row'><label class='col-sm-3 col-form-label' for='show_id'>Select Booth</label><div class='col-sm-9'><select class='form-control' name='booth_id' id='booth_id'></select></div></fieldset>";
 
                                $('.append_div').html(append_data); 
                            }
                                  
                        },
                        error: function()
                        {
                          $('.append_div').html(''); 
                        },
                    });
            }


        });

    });

      

</script>