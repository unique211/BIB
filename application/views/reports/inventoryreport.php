<article class="content">

    <div class="card card-block">

        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>

        </div>

        <div class="grid_3 grid_4">

        

            <h3>Inventory Report</h3>

            <hr>



            <div class="row sameheight-container">

                <div class="col-sm-3">

                    <h5>Show List</h5>

                    <table class="table table-hover table-bordered">

                        <?php
                        foreach($show_list as $show)
                        {

                        ?>

                        <tr>

                            <td class="show_id" id="<?php echo $show->id; ?>" show_id="<?php echo $show->id; ?>" ><?php echo $show->show_name; ?></td>

                        </tr>



                        <?php
                        }

                         ?>
                       


                    </table>

                </div>

                <div class="col-sm-9">

                    <h2><p id="append_show_name"></p></h2>

                    <div class="table-responsive">

                        <table class="table table-hover table-bordered appenddata" style="text-align: center;">
                        </table>

                    </div>

                </div>

                

            </div>



            <div id="task1_model" class="modal fade" role="dialog">

                <div style="margin-left: 33%;margin-top: 5%;width: 500px" >

                    <div class="modal-content">

                        <div class="modal-header">

                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;

                                </button>

                            <h4 class="modal-title">Stock details</h4>

                        </div>

                        <div class="modal-body appendmodaluser">

                          <!--   <p style="font-size: 16px;font-weight: 600">User Name : Team Leader 1 (Team Leader) </p>

                            <p style="font-size: 16px;font-weight: 600">Created At : 2019-05-15 00:10:45  </p> -->

                        </div>

                        <table class="table table-hover table-bordered">

                            <thead>

                                <th>#</th>

                                <th>Product Name</th>

                                <th>Stock Quantity</th>

                                

                            </thead>

                            <tbody id="appendmodaldata" style="text-align: center;">

                                <!-- <tr>

                                    <td>1</td>

                                    <td>Queen Pillow 2</td>

                                    <td>15</td>

                                </tr>

                                <tr>

                                    <td>2</td>

                                    <td>Metal - iPhone</td>

                                    <td>10</td>

                                </tr>

                                <tr>

                                    <td>3</td>

                                    <td>Black - iPhone</td>

                                    <td>20</td>

                                </tr>

                                <tr>

                                    

                                    <th colspan="2">Total Stock</th>

                                    <th>45</th>

                                </tr> -->

                            </tbody>

                        </table>

                        <div class="modal-footer">

                        </div>

                    </div>

                </div>

         

        </div>



        </div>

    </div>



</article>

<script type="text/javascript">
    
    $('.show_id').click(function(){

        $("td").removeClass("active1");

        $(this).addClass('active1');

        var show_name=$(this).text();

        $('#append_show_name').html(show_name);

        $(this).addClass('active1');

        var show_id=$(this).attr('show_id');

        var appenddata='';

        $.ajax({

                    url: baseurl+'reports/getInventorydetails',

                    type: 'POST',

                    data: {show_id : show_id},

                    dataType: 'json',

                    success: function (data) {

                    appenddata+="<thead><th>#</th><th>User Name</th><th>User Type</th><th>Created At</th><th>Stock Details</th></thead><tbody>";

                        var counter=0;
                        var index=1;
                         $.each(data, function(idx, obj) {
                            counter++;
                        });

                         if(counter != 0)
                         {
                            $.each(data, function(idx, obj) {

                                var usertype=obj.roleid;

                                if(usertype==3)
                                {
                                    usertype="Team Leader";
                                }
                                if(usertype==2)
                                {
                                    usertype="Sales Person";
                                }

                                appenddata+="<tr><td>"+index+"</td><td>"+obj.name+"</td><td>"+usertype+"</td><td>"+obj.date_created+"</td><td><a username='"+obj.name+"' created_at='"+obj.date_created+"' usertype='"+usertype+"' data-toggle='modal' show_id="+obj.show_id+" user_id="+obj.user_id+"   class='btn btn-primary openmodel'  ><i style='font-weight: 700;font-size: 17px;' class='ficon icon-eye'></i></a></td></tr>";

                                index++;
                            
                            });
                         }
                         else
                         {

                            appenddata+="<tr><td colspan='5'>No Data is Available</td></tr>";

                         }

                         appenddata+="</tbody>";

                         $('.appenddata').html(appenddata);


                         //Model Content---------------------------------

                         $('.openmodel').click(function(){ 

                              var show_id=$(this).attr('show_id');
                              var user_id=$(this).attr('user_id');
                              var user_name=$(this).attr('username');
                              var created_at=$(this).attr('created_at');
                              var usertype=$(this).attr('usertype');

                              //alert('show id : '+show_id+' | usertype : '+usertype);

                              console.log('show id : '+show_id);
                              console.log('user_id : '+user_id);
                              console.log('baseurl : '+baseurl);


                                 $.ajax({

                                        url: baseurl+'reports/getinvoicemodaldata',

                                        type: 'POST',

                                        data: {show_id : show_id,user_id : user_id},

                                        dataType: 'json',

                                        success: function (data) {

                                            console.log(data);

                                            var counter1=0;
                                            var index1=1;
                                            var appendmodaldata='';
                                            var appendmodaluser='';

                                             $.each(data, function(idx, obj) {

                                                    counter1++;

                                             });

                                              appendmodaluser+="<p style='font-size: 16px;font-weight: 600'>User Name : "+user_name+" ( "+usertype+" ) </p><p style='font-size: 16px;font-weight: 600'>Created At : "+created_at+" </p>";

                                             if(counter1 != 0)
                                             {
                                                var qty=0;
                                             
                                                 $.each(data, function(idx, obj) {

                                                      appendmodaldata+="<tr><td>"+index1+"</td><td>"+obj.product_name+"</td><td>"+obj.qty+"</td></tr>";

                                                      index1++;
                                                      qty=parseInt(qty) + parseInt(obj.qty);

                                                });
                                              
                                                appendmodaldata+="<tr><th colspan='2'>Total Stock</th><th style='text-align: center;'> "+qty+" </th></tr>";
                                             }
                                             else
                                             {
                                               
                                                appendmodaldata+="<tr><td colspan='3'>No Data is available</td></tr><tr><th colspan='2'>Total Stock</th><th style='text-align: center;'> - </th></tr>";
                                             }

                                             $('.appendmodaluser').html(appendmodaluser);
                                             $('#appendmodaldata').html(appendmodaldata);

                                              $("#task1_model").modal('show');

                                            //console.log(data);

                                        },
                            });



                              
                            });
                         //Model Content---------------------------------

                       

                    },
                });         
    });


</script>

<script>



</script>



