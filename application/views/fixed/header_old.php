<!DOCTYPE html>

<html lang="en" data-textdirection="ltr" class="loading">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimal-ui">



    <?php if (@$title) {

        echo "<title>$title</title >";

    } else {

        echo "<title>BambooisBetter</title >";

    }

    ?>

    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>assets/images/ico/apple-icon-60.png">
    

    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/images/ico/apple-icon-76.png">

    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/images/ico/apple-icon-120.png">

    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets/images/ico/apple-icon-152.png">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/ico/favicon.ico">

    <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>assets/images/ico/favicon-32.png">

    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="apple-touch-fullscreen" content="yes">

    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <!-- BEGIN VENDOR CSS-->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/' . LTR . '/bootstrap.css'); ?>">

    <!-- font icons-->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts/icomoon.css'); ?>">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <link rel="stylesheet" type="text/css"

          href="<?php echo base_url(); ?>assets/fonts/flag-icon-css/css/flag-icon.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/css/extensions/pace.css">

    <!-- END VENDOR CSS-->

    <!-- BEGIN ROBUST CSS-->

    <link rel="stylesheet" type="text/css"

          href="<?php echo base_url('assets/' . LTR . '/bootstrap-extended.css') . APPVER; ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/' . LTR . '/app.css') . APPVER; ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/' . LTR . '/colors.css'); ?>">

    <!-- END ROBUST CSS-->

    <!-- BEGIN Page Level CSS-->

    <link rel="stylesheet" type="text/css"

          href="<?php echo base_url('assets/' . LTR . '/core/menu/menu-types/vertical-menu.css'); ?>">

    <link rel="stylesheet" type="text/css"

          href="<?php echo base_url('assets/' . LTR . '/core/menu/menu-types/vertical-overlay-menu.css'); ?>">

    <link rel="stylesheet" type="text/css"

          href="<?php echo base_url('assets/' . LTR . '/core/colors/palette-gradient.css'); ?>">

    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/custom/datepicker.min.css') . APPVER ?>"> -->

    <link rel="stylesheet" href="<?php echo base_url('assets/custom/jquery.dataTables.css') . APPVER ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/custom/summernote-bs4.css') . APPVER; ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/custom/select2.min.css') . APPVER; ?>">

  

  

    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->

    <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/' . LTR . '/style.css') . APPVER; ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/' . LTR . '/custom.css') . APPVER; ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/custom/style.css') . APPVER; ?>">

    <!-- END Custom CSS-->



    <script src="<?php echo base_url(); ?>assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>



    <script src="<?php echo base_url(); ?>assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>





    <script src="<?php echo base_url(); ?>assets/portjs/raphael.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/portjs/morris.min.js" type="text/javascript"></script>





    <script src="<?php echo base_url('assets/myjs/datepicker.min.js') . APPVER; ?>"></script>

    <script src="<?php echo base_url('assets/myjs/summernote-bs4.min.js') . APPVER; ?>"></script>

    <script src="<?php echo base_url('assets/myjs/select2.min.js') . APPVER; ?>"></script>

   

  





    <script type="text/javascript">var baseurl = '<?php echo base_url() ?>';</script>

 <!-- arzoo -->
     <!-- <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase.js"></script> -->
     <script src="https://www.gstatic.com/firebasejs/6.3.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.0/firebase-functions.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.0/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.0/firebase-storage.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.0/firebase-database.js"></script>

    <script>
        //alert('hi');
       var tokenvalue='';
        // Initialize Firebase
        // TODO: Replace with your project's customized code snippet
        var config = {
           // apiKey: "AIzaSyBfZJGjP72Xsgm6aodFg8hd50KiExAYKP4",
            apiKey: "AIzaSyAKQ4662NReheTALgDvZpbSLKPV3Fcp9pE",
            authDomain: "allymsg-6d58f.firebaseapp.com",
            databaseURL: "https://allymsg-6d58f.firebaseio.com",
            storageBucket: "allymsg-6d58f",
            messagingSenderId: "803663967145",
        };
        firebase.initializeApp(config);
       // alert('hi1');
        const messaging = firebase.messaging();
        messaging
            .requestPermission()
            .then(function () {
                // MsgElem.innerHTML = "Notification permission granted." 
                console.log("Notification permission granted.");
                
                // get the token in the form of promise
                return messaging.getToken()
            })
            .then(function(token) {
               // TokenElem.value = token
           //   alert('First time:'+token);
              $('#token').val(token);
                //code to call the ajax for the database entry of the token in db
                $.ajax({
                    type: "POST",
                    url: baseurl + "user/setToken",
                    data: {
                        token: token
                    },
                    dataType: "JSON",
                    async: false,
                    success: function(data) {
                        console.log(data);
                    },error:function(e){
                        console.log(e);
                    }
                });
            })
            // .then(function() {
            //   //code to call the ajax for the database entry of the token in db
            // })
            .catch(function (err) {
               // ErrElem.innerHTML =  ErrElem.innerHTML + "; " + err
                console.log("Unable to get permission to notify.", err);
            });
           // alert('hi2');
        messaging.onMessage(function(payload) {
		
            console.log("Message received. ", payload);
           // NotisElem.innerHTML = NotisElem.innerHTML + JSON.stringify(payload) 
            var notificationTitle = payload.data.title;
			var notificationOptions = {
                body:payload.data.body,
                icon:payload.data.icon,
                image:payload.data.image,
                data:{
                    time: new Date(Date.now()).toString(),
                    click_action:payload.data.click_action,
                }
                
			};
			
			var notification = new Notification(notificationTitle,notificationOptions);
			
        });
       
    </script>

    <!-- arzoo -->



    <style>
        .sidebar-green-backgrod
        {
            background-color: #839851 !important;
           /* font-weight: 700;*/
        }
        .icon-eye
        {
            font-size: 17px;
        }
        .icon-pencil
        {
            font-size: 17px;
        }
        .icon-trash-o
        {
            font-size: 17px;
        }

       
            .model-width
            {
            width: width: 1100px;
            }

      

         @media screen and (max-width: 1349px) and (min-width: 1045px) {
             .model-width
        {
            width: 600px;
        }
         
         .priority-8{
            display:none;
        } 
        .priority-7{
            display:none;
        } 
        .priority-6{
            display:none;
        }
        .priority-5{
            display:none;
        }
        .mobile-view
        {
            margin-top: -30px;
        }

    }
    
    @media screen and (max-width: 1045px) and (min-width: 835px) {
         .model-width
        {
            width: 600px;
        }
        
         .priority-8{
            display:none;
        } 
        .priority-7{
            display:none;
        }
        .priority-6{
            display:none;
        }
        .priority-5{
            display:none;
        }
        .priority-4{
            display:none;
        }
        .mobile-view
        {
            margin-top: -30px;
        }
    }

   

     @media screen and (max-width: 834px) and (min-width: 601px) {

        .model-width
        {
            width: 550px;
        }
       
         .priority-8{
            display:none;
        } 
        .priority-7{
            display:none;
        }
        .priority-6{
            display:none;
        }
        .priority-5{
            display:none;
        }
      
          .priority-1{
            display:none;
        }
        .mobile-view
        {
            margin-top: -30px;
        }

        
    }

    
    @media screen and (max-width: 600px) and (min-width: 300px) {
         .model-width
        {
            width: 300px;
        }
        
         .priority-8{
            display:none;
        } 
        .priority-7{
            display:none;
        }
        .priority-6{
            display:none;
        }
        .priority-5{
            display:none;
        }
      
          .priority-1{
            display:none;
        }
       
       
    }
    
    @media screen and (max-width: 300px) {
         .model-width
        {
            width: 270px;
        }
        
         .priority-8{
            display:none;
        } .priority-7{
            display:none;
        }
        .priority-6{
            display:none;
        }
        .priority-5{
            display:none;
        }
        .priority-4{
            display:none;
        }
        .priority-3{
            display:none;
        }
       
         .priority-1{
            display:none;
        }
      
    
    }

    .active1{
        background-color: purple;
        color:white;
    }

    </style>



</head>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns"

      class="vertical-layout vertical-menu 2-columns  fixed-navbar"><span id="hdata"

                                                                          data-df="<?php echo $this->config->item('dformat2'); ?>"

                                                                          data-curr="<?php echo $this->config->item('currency'); ?>"></span>



<!-- navbar-fixed-top-->

<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">

    <div class="navbar-wrapper">

        <div class="navbar-header">

            <ul class="nav navbar-nav">

                <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a

                            class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a>

                </li>

                <li class="nav-item"><a href="<?php echo base_url() ?>dashboard/" class="navbar-brand nav-link"><img

                                alt="branding logo" src="<?php echo base_url(); ?>userfiles/theme/logo-header.png"

                                data-expand="<?php echo base_url(); ?>userfiles/theme/logo-header.png"

                                data-collapse="<?php echo base_url(); ?>assets/images/logo/logo-80x80.png"

                                class="brand-logo height-100"></a></li>

                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile"

                                                                    class="nav-link open-navbar-container"><i

                                class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>

            </ul>

        </div>

        <div class="navbar-container content container-fluid">

            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">

                <ul class="nav navbar-nav">

                    <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i

                                    class="icon-menu5"> </i></a></li>

                    <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i

                                    class="icon icon-expand2"></i></a></li>

                    

                </ul>

                <div id="head-customerbox-result" class="dropdown dropdown-notification"></div>

                <ul class="nav navbar-nav float-xs-right">



                    <li class="dropdown dropdown-notification nav-item"><a href="#" data-toggle="dropdown"

                                                                           class="nav-link nav-link-label"><i

                                    class="ficon icon-bell4"></i><span

                                    class="tag tag-pill tag-default tag-danger tag-default tag-up"

                                    id="taskcount">0</span></a>

                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">

                            <li class="dropdown-menu-header">

                                <h6 class="dropdown-header m-0"><span

                                            class="grey darken-2"><?php echo $this->lang->line('Pending Tasks') ?></span>

                                </h6>

                            </li>

                            <li class="list-group scrollable-container" id="tasklist"></li>

                            <li class="dropdown-menu-footer"><a href="<?php echo base_url('manager/todo') ?>"

                                                                class="dropdown-item text-muted text-xs-center"><?php echo $this->lang->line('Manage tasks') ?></a>

                            </li>

                        </ul>

                    </li>

               
                    <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown"

                                                                   class="dropdown-toggle nav-link dropdown-user-link"><span

                                    class="avatar avatar-online"><img

                                        src="<?php echo base_url('userfiles/employee/thumbnail/' . $this->aauth->get_user()->picture) ?>"

                                        alt="avatar"><i></i></span></a>

                        <div class="dropdown-menu dropdown-menu-right"><a href="<?php echo base_url(); ?>user/profile"

                                                                          class="dropdown-item"><i

                                        class="icon-head"></i><?php echo $this->lang->line('Profile') ?></a>

                            <div class="dropdown-divider"></div>

                            <a href="<?php echo base_url('user/logout'); ?>" class="dropdown-item"><i

                                        class="icon-power3"></i> <?php echo $this->lang->line('Logout') ?></a>

                        </div>

                    </li>

                </ul>

            </div>

        </div>

    </div>

</nav>



<!-- ////////////////////////////////////////////////////////////////////////////-->





<!-- main menu-->

<div data-scroll-to-active="true" class="main-menu menu-static menu-dark menu-accordion menu-shadow" id="side">

    <!-- main menu header-->

    <div class="main-menu-header">

        <div>

            <div class="dropdown profile-element"> <span>

                            <img alt="image" class="img-circle "

                                 src="<?php echo base_url('userfiles/employee/' . $this->aauth->get_user()->picture) ?>">

                             </span>

                <a data-toggle="dropdown" class="dropdown-toggle block" href="#" aria-expanded="false">

                    <span class="clear white">  <span

                                class="text-xs"><!-- <?php echo user_role($this->aauth->get_user()->roleid); ?> -->
                                <?php
                                    if($this->aauth->get_user()->roleid==3)
                                    {
                                        echo "Team Leader";
                                    }
                                    elseif($this->aauth->get_user()->roleid==2)
                                    {
                                        echo "Sales Manager";
                                    }
                                    elseif($this->aauth->get_user()->roleid==5)
                                    {
                                        echo "Bussiness Owner";
                                    }

                                 ?><b

                                    class="caret"></b></span> </span> </a>

                <ul class="dropdown-menu animated m-t-xs">

                    <li>

                    <a href="<?php echo base_url().'user/profile' ?>"><?php echo $this->aauth->get_user()->username; ?></a>
                    </li>



                      <li class=" divider">

                    </li>

                    <li>

                        <a href="<?php echo base_url('user/logout'); ?>">&nbsp;<?php echo $this->lang->line('Logout'); ?></a>

                    </li>

                </ul>

            </div>



        </div>

    </div>

    <!-- / main menu header-->

    <!-- main menu content-->

    <div class="main-menu-content">

        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">



            <li class="nav-item <?php if ($this->uri->segment(1) == "dashboard") {

                echo 'active';

            } ?>">

                <a href="<?php echo base_url(); ?>dashboard/"> <i class="icon-dashboard"></i><span

                            class="menu-title"> <?php echo $this->lang->line('Dashboard') ?></span></a>

            </li>
            <!---------------- Start Project for Salesperson ----------------->

              <?php if ($this->aauth->get_user()->roleid== 2) { ?>

                 <li  class="navigation-header sidebar-green-backgrod"><span ><?php echo $this->lang->line('Project') ?></span><i data-toggle="tooltip" data-placement="right" data-original-title="Balance" class="icon-ellipsis icon-ellipsis"> </i>
                </li>
                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "projects") { echo ' open'; } ?>">
                     <a href=""> <i class="icon-file"></i><span class="menu-title"> <?php echo $this->lang->line('Project Management') ?> </span><i  class="fa arrow"></i> </a>
                    <ul class="menu-content sidebar-green-backgrod">
                        <li class="sidebar-green-backgrod" >
                            <a href="<?php echo base_url(); ?>salesperson/explore?id=<?php echo $this->session->userdata('salesperson_show_id'); ?>"><?php echo $this->lang->line('Manage Projects') ?></a>
                        </li>
                    </ul>
                </li>


              <?php } ?>

             <!---------------- Start Project for Salesperson ----------------->

             <!---------------- Start Project ----------------->

                <?php if ($this->aauth->get_user()->roleid== 3) { ?>

                <li  class="navigation-header sidebar-green-backgrod"><span ><?php echo $this->lang->line('Project') ?></span><i

                            data-toggle="tooltip" data-placement="right"

                            data-original-title="Balance"

                            class="icon-ellipsis icon-ellipsis"></i>

                </li>

                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "projects") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-file"></i><span

                                class="menu-title"> <?php echo $this->lang->line('Project Management') ?> </span><i

                                class="fa arrow"></i> </a>

                    <ul class="menu-content sidebar-green-backgrod">

                        

                       

                        <li class="sidebar-green-backgrod" >

                            <a href="<?php echo base_url(); ?>projects/shows"><?php echo $this->lang->line('Manage Projects') ?></a>

                        </li>

                       

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>projects/stores"><?php echo $this->lang->line('Manage Stores') ?></a>

                        </li>





                    </ul>

                </li>

                <li class="sidebar-green-backgrod"><a href="<?php echo base_url(); ?>tools/todo"><i class="icon-android-done-all sidebar-green-backgrod"></i><span

                                class="menu-title"> <?php echo $this->lang->line('To Do List') ?></span></a></li>

                            <?php } ?>

                <!---------------- end project ----------------->

            <?php if ($this->aauth->get_user()->roleid == -1) { ?>



                <li class="navigation-header sidebar-green-backgrod"><span><?php echo $this->lang->line('Project') ?></span><i

                            data-toggle="tooltip" data-placement="right"

                            data-original-title="Balance"

                            class="icon-ellipsis icon-ellipsis"></i>

                </li>

                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "projects") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-file"></i><span

                                class="menu-title"> <?php echo $this->lang->line('Project Management') ?> </span><i

                                class="fa arrow"></i> </a>

                    <ul class="menu-content sidebar-green-backgrod">



                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>projects/addproject"><?php echo $this->lang->line('New Project') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>projects"><?php echo $this->lang->line('Manage Projects') ?></a>

                        </li>

                         <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>projects/addproject"><?php echo $this->lang->line('New Store') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>projects"><?php echo $this->lang->line('Manage Stores') ?></a>

                        </li>

                        

                       

                    </ul>

                </li>

                

                <div style="height: 600px;"></div>

            <?php }

            if ($this->aauth->get_user()->roleid == 1) { ?>



                <li class="navigation-header sidebar-green-backgrod"><span><?php echo $this->lang->line('Stock') ?></span><i

                            data-toggle="tooltip" data-placement="right"

                            data-original-title="Stock"

                            class="icon-ellipsis icon-ellipsis"></i>

                </li>

                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "products") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-truck2"></i><span

                                class="menu-title"><?php echo $this->lang->line('Items Manager') ?></span><i

                                class="fa arrow"></i> </a>

                    <ul class="menu-content sidebar-green-backgrod">

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>products/add"><?php echo $this->lang->line('New Product') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>products"><?php echo $this->lang->line('Manage Products') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>productcategory"><?php echo $this->lang->line('Product Categories') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>productcategory/warehouse"><?php echo $this->lang->line('Warehouses') ?></a>

                        </li>

                    </ul>

                </li>

                <div style="height: 600px;"></div>

                <?php

            }



            if ($this->aauth->get_user()->roleid > 1) { ?>

                <li class="navigation-header sidebar-green-backgrod"><span 

                            data-i18n="nav.category.support"> <?php echo $this->lang->line('sales') ?></span><i

                            data-toggle="tooltip"

                            data-placement="right"

                            data-original-title="Sales"

                            class="icon-ellipsis icon-ellipsis"></i>

                </li>

                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "invoices" OR $this->uri->segment(1) == "quote") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-plus"></i> <span

                                class="menu-title"><?php echo $this->lang->line('sales') ?>

                            <i

                                    class="icon-arrow"></i></span></a>

                    <ul class="menu-content sidebar-green-backgrod">

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>invoices/create"><?php echo $this->lang->line('New Invoice'); ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>invoices"><?php echo $this->lang->line('Manage Invoices'); ?></a>

                        </li>

                      <!--  <li>

                            <a href="<?php echo base_url(); ?>quote/create"><?php echo $this->lang->line('New Quote'); ?></a>

                        </li>

                        <li>

                            <a href="<?php echo base_url(); ?>quote"><?php echo $this->lang->line('Manage Quotes'); ?></a>

                        </li>

                        -->

                    </ul>

                </li>

              <!--  <li class="nav-item has-sub <?php if ($this->uri->segment(1) == "rec_invoices") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-android-calendar"></i> <span

                                class="menu-title"><?php echo $this->lang->line('Reccuring Sales') ?><i

                                    class="icon-arrow"></i></span></a>

                    <ul class="menu-content">

                        <li>

                            <a href="<?php echo base_url(); ?>rec_invoices/dashboard"><?php echo $this->lang->line('Dashboard'); ?></a>

                        </li>

                        <li>

                            <a href="<?php echo base_url(); ?>rec_invoices/create"><?php echo $this->lang->line('New Invoice'); ?></a>

                        </li>

                        <li>

                            <a href="<?php echo base_url(); ?>rec_invoices"><?php echo $this->lang->line('Manage Invoices') ?></a>

                        </li>



                    </ul>

                </li> -->



            <?php }

            if ($this->aauth->get_user()->roleid > 2) { ?>

                <li class="navigation-header sidebar-green-backgrod"><span><?php echo $this->lang->line('Stock') ?></span><i

                            data-toggle="tooltip" data-placement="right"

                            data-original-title="Stock"

                            class="icon-ellipsis icon-ellipsis"></i>

                </li>

                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "products") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-truck2"></i><span

                                class="menu-title"><?php echo $this->lang->line('Items Manager') ?></span><i

                                class="fa arrow"></i> </a>

                    <ul class="menu-content sidebar-green-backgrod">

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>products/add"><?php echo $this->lang->line('New Product') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>products"><?php echo $this->lang->line('Manage Products') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>productcategory"><?php echo $this->lang->line('Product Categories') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>productcategory/warehouse"><?php echo $this->lang->line('Warehouses') ?></a>

                        </li>
						
						<li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>productcategory/productsize"><?php echo $this->lang->line('size') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>products/stock_transfer"><?php echo $this->lang->line('Stock Transfer') ?></a>

                        </li>

                    </ul>

                </li>

                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "purchase") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-file"></i><span

                                class="menu-title"> <?php echo $this->lang->line('Purchase Order') ?> </span><i

                                class="fa arrow"></i> </a>

                    <ul class="menu-content sidebar-green-backgrod">

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>purchase/create"><?php echo $this->lang->line('New Order') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>purchase"><?php echo $this->lang->line('Manage Orders') ?></a>

                        </li>

                    </ul>

                </li>

                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "stockreturn") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-share-square-o"></i> <span

                                class="menu-title"><?php echo $this->lang->line('Stock Return') ?>

                            <i

                                    class="icon-arrow"></i></span></a>

                    <ul class="menu-content sidebar-green-backgrod">

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>stockreturn/create"><?php echo $this->lang->line('Add new'); ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>stockreturn"><?php echo $this->lang->line('Records'); ?></a>

                        </li>



                    </ul>

                </li>

                <li class="navigation-header sidebar-green-backgrod"><span><?php echo $this->lang->line('CRM') ?></span><i

                            data-toggle="tooltip" data-placement="right"

                            data-original-title="CRM"

                            class="icon-ellipsis icon-ellipsis"></i>

                </li>

                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "customers") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-group"></i><span

                                class="menu-title"> <?php echo $this->lang->line('Clients') ?></span><i

                                class="fa arrow"></i> </a>

                    <ul class="menu-content sidebar-green-backgrod">

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>customers/create"><?php echo $this->lang->line('New Client') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>customers"><?php echo $this->lang->line('Manage Clients') ?></a>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>clientgroup"><?php echo $this->lang->line('Manage Groups') ?></a>

                        </li>

                    </ul>

                </li>

<!--

                <li class="nav-item has-sub <?php if ($this->uri->segment(1) == "tickets") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-ticket"></i><span

                                class="menu-title"><?php echo $this->lang->line('Support Tickets') ?></span><i

                                class="fa arrow"></i> </a>

                    <ul class="menu-content">

                        <li>

                            <a href="<?php echo base_url(); ?>tickets/?filter=unsolved"><?php echo $this->lang->line('UnSolved') ?></a>

                        </li>

                        <li>

                            <a href="<?php echo base_url(); ?>tickets"><?php echo $this->lang->line('Manage Tickets') ?></a>

                        </li>





                    </ul>

                </li>

                -->

            <?php }

            if ($this->aauth->get_user()->roleid > 3) { ?>



                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "supplier") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-ios-people"></i><span

                                class="menu-title"> <?php echo $this->lang->line('Suppliers') ?> </span><i

                                class="fa arrow"></i> </a>

                    <ul class="menu-content sidebar-green-backgrod">

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>supplier/create"><?php echo $this->lang->line('New Supplier') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>supplier"><?php echo $this->lang->line('Manage Suppliers') ?></a>

                        </li>

                    </ul>

                </li>

                <!---------------- Start Project ----------------->

                <?php if ($this->aauth->get_user()->roleid != 3) { ?>

                <li class="navigation-header sidebar-green-backgrod"><span><?php echo $this->lang->line('Project') ?></span><i

                            data-toggle="tooltip" data-placement="right"

                            data-original-title="Balance"

                            class="icon-ellipsis icon-ellipsis"></i>

                </li>

                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "projects") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-file"></i><span

                                class="menu-title"> <?php echo $this->lang->line('Project Management') ?> </span><i

                                class="fa arrow"></i> </a>

                    <ul class="menu-content sidebar-green-backgrod">

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>projects/showproject"><?php echo $this->lang->line('New Project') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>projects/shows"><?php echo $this->lang->line('Manage Projects') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>projects/addstore"><?php echo $this->lang->line('New Store') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>projects/stores"><?php echo $this->lang->line('Manage Stores') ?></a>

                        </li>

                    </ul>

                </li>

                <li class="sidebar-green-backgrod" ><a href="<?php echo base_url(); ?>tools/todo"><i class="icon-android-done-all "></i><span

                                class="menu-title"> <?php echo $this->lang->line('To Do List') ?></span></a></li>

                            <?php } ?>

                <!---------------- end project ----------------->

                <li class="navigation-header sidebar-green-backgrod"><span><?php echo $this->lang->line('Balance') ?></span><i

                            data-toggle="tooltip" data-placement="right"

                            data-original-title="Balance"

                            class="icon-ellipsis icon-ellipsis"></i>

                </li>

              


                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "transactions") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-exchange"></i><span

                                class="menu-title"> <?php echo $this->lang->line('Transactions') ?> </span><i

                                class="fa arrow"></i> </a>

                    <ul class="menu-content sidebar-green-backgrod">

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>transactions"><?php echo $this->lang->line('View Transactions') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>transactions/add"><?php echo $this->lang->line('New Transaction') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>transactions/transfer"><?php echo $this->lang->line('New Transfer') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>transactions/income"><?php echo $this->lang->line('Income'); ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>transactions/expense"><?php echo $this->lang->line('Expense') ?></a>

                        </li>





                    </ul>

                </li>



                <li class="navigation-header sidebar-green-backgrod"><span><?php echo $this->lang->line('Miscellaneous') ?></span><i

                            data-toggle="tooltip" data-placement="right"

                            data-original-title="Miscellaneous"

                            class="icon-ellipsis icon-ellipsis"></i>

                </li>





                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "reports") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-file-archive-o"></i><span

                                class="menu-title"> <?php echo $this->lang->line('Data & Reports') ?> </span><i

                                class="fa arrow"></i> </a>

                    <ul class="menu-content sidebar-green-backgrod">

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>reports/statistics"><?php echo $this->lang->line('Statistics') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>reports/accountstatement"><?php echo $this->lang->line('Account Statements') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>reports/customerstatement"><?php echo $this->lang->line('Customer') . ' ' . $this->lang->line('Account Statements') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>reports/supplierstatement"><?php echo $this->lang->line('Supplier') . ' ' . $this->lang->line('Account Statements') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>reports/incomestatement"><?php echo $this->lang->line('Calculate Income'); ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>reports/expensestatement"><?php echo $this->lang->line('Calculate Expenses') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>customers"><?php echo $this->lang->line('Clients Transactions') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>reports/taxstatement"><?php echo $this->lang->line('TAX').' '.$this->lang->line('Statements'); ?> </a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>reports/consignmentlist">Consignment List </a>

                        </li>

                         <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>reports/calculating_shipping_pallet">Shipping Pallet Calculations </a>

                        </li>

                         <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>reports/show_sales">Show Sales </a>

                        </li>

                         <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>reports/commission_report">Commission Reports </a>

                        </li>


                          <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>reports/inventory_report">Packing List </a>

                        </li>
                          <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>reports/topSellingProducts">Top Selling Products </a>

                        </li>
                        

                    </ul>

                </li>




            <?php }

            if ($this->aauth->get_user()->roleid > 4) { ?>

                <li class="navigation-header sidebar-green-backgrod"><span>Configure</span><i data-toggle="tooltip" data-placement="right"

                                                                       data-original-title="Configure"

                                                                       class="icon-ellipsis icon-ellipsis"></i>

                </li>

                <li class="nav-item has-sub sidebar-green-backgrod <?php if ($this->uri->segment(1) == "settings") {

                    echo ' open';

                } ?>">

                    <a href=""> <i class="icon-cog"></i><span

                                class="menu-title"> <?php echo $this->lang->line('Settings') ?></span><i

                                class="fa arrow"></i> </a>

                    <ul class="menu-content sidebar-green-backgrod">

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>settings/company"><?php echo $this->lang->line('Company'); ?></a>

                        </li>



                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>settings/billing"><?php echo $this->lang->line('Billing') ?>

                                & Language</a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>settings/currency"><?php echo $this->lang->line('Currency') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>settings/dtformat"><?php echo $this->lang->line('Date & Time Format') ?></a>

                        </li>



                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>transactions/categories"><?php echo $this->lang->line('Transaction Categories') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>tools/setgoals"><?php echo $this->lang->line('Set Goals') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod"><a href="<?php echo base_url(); ?>restapi"><?php echo $this->lang->line('REST API') ?></a>

                        </li>

                        <li class="sidebar-green-backgrod">

                            <a href="<?php echo base_url(); ?>settings/email"><?php echo $this->lang->line('Email Config') ?></a>

                        </li>

                      





                    </ul>

                </li>

                <li class="sidebar-green-backgrod"><a href="<?php echo base_url(); ?>employee"><i class="icon-users"></i><span

                                class="menu-title"> <?php echo $this->lang->line('Employees') ?></span></a>

                </li>

               


                    </ul>

                </li>

               

            <?php } ?>





        </ul>

    </div>

    <!-- /main menu content-->

    <!-- main menu footer-->

    <!-- include includes/menu-footer-->

    <!-- main menu footer-->

    <div id="rough"></div>

</div>

<!-- / main menu-->