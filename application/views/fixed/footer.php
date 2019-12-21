<!-- BEGIN VENDOR JS-->

<script type="text/javascript">



    $('[data-toggle="datepicker"]').datepicker({autoHide: true, format: '<?php echo $this->config->item('dformat2'); ?>'});

    $('[data-toggle="datepicker"]').datepicker('setDate', new Date());

    $('#sdate').datepicker({autoHide: true, format: '<?php echo $this->config->item('dformat2'); ?>'});

    $('#sdate').datepicker('setDate', '<?php echo dateformat(date('Y-m-d', strtotime('-30 days', strtotime(date('Y-m-d'))))); ?>');

    $('.date30').datepicker('setDate', '<?php echo dateformat(date('Y-m-d', strtotime('-30 days', strtotime(date('Y-m-d'))))); ?>');





</script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url(); ?>assets/myjs/jquery-ui.js"></script>

<script src="<?php echo base_url(); ?>assets/vendors/js/ui/perfect-scrollbar.jquery.min.js"

        type="text/javascript"></script>

<script src="<?php echo

base_url(); ?>assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/myjs/jquery.dataTables.min.js"></script>





<script type="text/javascript">var dtformat = $('#hdata').attr('data-df');

    var currency = $('#hdata').attr('data-curr');

    ;</script>

<script src="<?php echo base_url('assets/myjs/custom.js') . APPVER; ?>"></script>

<script src="<?php echo base_url('assets/myjs/basic.js') . APPVER; ?>"></script>

<script src="<?php echo base_url('assets/myjs/control.js?') .rand(); ?>"></script>



<script src="<?php echo base_url('assets/js/core/app.js'); ?>" type="text/javascript"></script>



<script src="<?php echo base_url(); ?>assets/js/core/app-menu.js" type="text/javascript"></script>
 
<script type="text/javascript">
//	$(".alert").remove();
    var totalNoti = 0;
    $.ajax({



        url: baseurl + 'manager/pendingtasks',

        dataType: 'json',
        async:false,
        success: function (data) {

            $('#tasklist').html(data.tasks);
            totalNoti += parseInt(data.tcount);
            console.log('tot1'+totalNoti);
            //$('#taskcount').html(data.tcount);
            if(totalNoti>0){
                $('.ptask').css('display','');
            }else{
                $('.ptask').css('display','none');    
            }


        },

        error: function (data) {

            $('#response').html('Error')

        }



    });
    //load show requests
    $.ajax({



        url: baseurl + 'projects/getAllShowRequests',

        dataType: 'json',
        async:false,
        success: function (data) {
            var html = '';
        var incount = 0;
          console.log(data);
          $.each(data, function(key, value) {
              console.log(value.show_id);
          html += '<a href="'+baseurl +'/projects/exploreshow?id='+value.show_id+'" class="list-group-item">'+
                      '<div class="media">'+
                        '<div class="media-left valign-middle"><i class="icon-bullhorn2 icon-bg-circle bg-cyan"></i></div>'+
                        '<div class="media-body">'+
                          '<h6 class="media-heading"> Request for ' + value.show_name + '</h6>'+
                          '<p class="notification-text font-small-2 text-muted">By '+value.empname+'</p><small>'+
                        //   'Request date <time  class="media-meta text-muted">'+value.empname+'</time></small>'+
                          '</div>'+
                          '</div></a>';
                          incount++;
          });
          if(incount>0){
            totalNoti += incount;
          console.log('tot2'+totalNoti);
          }
          
          $('#showrequestlist').html(html);
        },

        error: function (data) {

            $('#response').html('Error')

        }



    });
    //load inventory requests
    $.ajax({



        url: baseurl + 'products/getInventoryRequests',

        dataType: 'json',
        async:false,
        success: function (data) {
            var html = '';
            var incount = 0;
          console.log(data);
          $.each(data, function(key, value) {
              console.log(value.show_id);
          html += '<a href="'+baseurl +'/projects/exploreshow?id='+value.show_id+'" class="list-group-item">'+
                      '<div class="media">'+
                        '<div class="media-left valign-middle"><i class="icon-bullhorn2 icon-bg-circle bg-cyan"></i></div>'+
                        '<div class="media-body">'+
                          '<h6 class="media-heading"> Request for ' + value.product_name + '</h6>'+
                          '<p class="notification-text font-small-2 text-muted">By '+value.emp_name+'</p><small>'+
                          '<p class="notification-text font-small-2 text-muted">Show  '+value.show_name+'</p><small>'+
                        //   'Request date <time  class="media-meta text-muted">'+value.empname+'</time></small>'+
                          '</div>'+
                          '</div></a>';
                          incount++;
          });
         
          if(incount>0){
              $('.inreq').css('display','');
              totalNoti += incount;
              console.log('tot3'+totalNoti);
          }else{
            $('.inreq').css('display','none');
          }
          $('#pendinginvrequestlist').html(html);
        },

        error: function (data) {
            console.log('data-error');
            $('#response').html('Error')
            $('.inreq').css('display','none');
        }



    });
    //load inventory approved
    $.ajax({



        url: baseurl + 'products/getApprovedRequests',

        dataType: 'json',
        async:false,
        success: function (data) {
            var html = '';
            var incount = 0;
          console.log(data);
          $.each(data, function(key, value) {
              console.log(value.show_id);
          html += '<a href="'+baseurl +'/projects/exploreshow?id='+value.show_id+'" class="list-group-item">'+
                      '<div class="media">'+
                        '<div class="media-left valign-middle"><i class="icon-bullhorn2 icon-bg-circle bg-cyan"></i></div>'+
                        '<div class="media-body">'+
                          '<h6 class="media-heading"> Approved for ' + value.product_name + '</h6>'+
                          '<p class="notification-text font-small-2 text-muted">By '+value.emp_name+'</p><small>'+
                          '<p class="notification-text font-small-2 text-muted">Show  '+value.show_name+'</p><small>'+
                        //   'Request date <time  class="media-meta text-muted">'+value.empname+'</time></small>'+
                          '</div>'+
                          '</div></a>';
                          incount++;
          });
          totalNoti += incount;
          console.log('tot4'+totalNoti);
          if(incount>0){
              $('.inalloc').css('display','');
          }else{
            $('.inalloc').css('display','none');
          }
          $('#invallocatedlist').html(html);
        },

        error: function (data) {
            console.log('data-error');
            $('#response').html('Error')
            $('.inalloc').css('display','none');
        }



    });
    //load inventory confirmed
    $.ajax({



        url: baseurl + 'products/getConfirmedRequests',
        async:false,
        dataType: 'json',

        success: function (data) {
            var html = '';
            var incount = 0;
          console.log(data);
          $.each(data, function(key, value) {
              console.log(value.show_id);
          html += '<a href="'+baseurl +'/projects/exploreshow?id='+value.show_id+'" class="list-group-item">'+
                      '<div class="media">'+
                        '<div class="media-left valign-middle"><i class="icon-bullhorn2 icon-bg-circle bg-cyan"></i></div>'+
                        '<div class="media-body">'+
                          '<h6 class="media-heading"> Confirmed for ' + value.product_name + '</h6>'+
                          '<p class="notification-text font-small-2 text-muted">By '+value.emp_name+'</p><small>'+
                          '<p class="notification-text font-small-2 text-muted">Show  '+value.show_name+'</p><small>'+
                        //   'Request date <time  class="media-meta text-muted">'+value.empname+'</time></small>'+
                          '</div>'+
                          '</div></a>';
                          incount++;
          });
          if(incount>0){
              $('.inconfirm').css('display','');
              totalNoti += incount;
            console.log('tot5'+totalNoti);
          }else{
            $('.inconfirm').css('display','none');
          }
         
          $('#invconfirmlist').html(html);
          $('#taskcount').html(totalNoti);
        },

        error: function (data) {
            console.log('data-error');
            $('.inconfirm').css('display','none');
            $('#response').html('Error')

        }
       


    });

   



    var winh = document.body.scrollHeight;

    var sideh = document.getElementById('side').scrollHeight;

    var opx = winh - sideh;

    document.getElementById('rough').style.height = opx + "px";

    $('body').on('click', '.menu-toggle', function () {





        var opx2 = winh - sideh + 180;

        document.getElementById('rough').style.height = opx2 + "px";

    });

</script>

<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>

<!-- <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

</body>

</html>

