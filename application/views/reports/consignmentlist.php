<article class="content">

    <div class="card card-block">

        <div id="notify" class="alert alert-success" style="display:none;">

            <a href="#" class="close" data-dismiss="alert">&times;</a>



            <div class="message"></div>

        </div>

        <div class="grid_3 grid_4">

            <h3>Consignment List</h3>

            <hr>



            <div class="row sameheight-container">

                <div class="col-md-12">

                    <form>
                      
                       <div class="form-group row">

                          <label class="col-sm-3 col-form-label" for="show"><b>Select Show</b></label>

                              <div class="col-sm-4 id_100" >

                                  <select name="show_id" id="show_id" class="form-control select-box">

                                       <?php

                                        foreach($show_list as $row) {

                                          $id = $row->id;

                                          $show_name = $row->show_name;

                                          echo "<option value=".$id.">$show_name</option>";

                                      }

                                      ?> 

                                  </select>

                              </div>

                        </div>
                        <div class="form-group row">

                          <label class="col-sm-3 col-form-label" for="show"><b>Select Team Leader</b></label>

                              <div class="col-sm-4 id_101">

                                  <select name="teamleader_id" id="teamleader_id" class="form-control select-box">

                                      
                                  </select>

                              </div>

                        </div>
                         <div class="form-group row">
                           <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-4">
                          <span class="btn btn-success checkbtn">View</span>
                        </div>

                         </div>

                    </form>

                </div>
                <!-- <div class="row"> -->
         <div class="display_data table-responsive">
    
               </div>
              <!-- </div> -->



            



        </div>

    </div>

</article>

<script type="text/javascript">
  function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
</script>

<script type="text/javascript">
   $('#show_id').change(function(){

    $('.display_data').html('');


                  var id = $(this).val();

                  var appenddata='';

                
                 
               
                  $.ajax({

                    url: baseurl + 'reports/getTeamleaderfoconsignment',

                    type: 'GET',

                    data: {show_id : id},

                    dataType: 'json',

                    success: function (data) {

                     $.each(data, function(idx, obj) {
                   
                    
                      appenddata+="<option value="+obj.id+">"+obj.name+"</option>";
                        });

                     if(appenddata=='')
                     {
                        appenddata+="<option value=''>"+"No team Leader Available"+"</option>";
                     }

                     
                      
                       $('#teamleader_id').html(appenddata);

                    }
                });


            });
</script>

<script type="text/javascript">
  
  $('.checkbtn').click(function(){

     var show_id= $('#show_id').children("option:selected").val();
     var teamleader_id=$('#teamleader_id').children("option:selected").val();

     var displayData="<table style='width:100%' class='table'><thead><tr><th>Index</th><th>Quantity</th><th>Product</th><th>Retail Amount</th><th> Request date and time</th></tr></thead><tbody>";



     if(show_id=='' || teamleader_id== null || teamleader_id=='')
     {
        
        $("#notify").removeClass("alert-success");
        $("#notify").addClass("alert-warning").fadeIn();
        $("#notify .message").html("<strong>Warning</strong>: Please select Show and Team Leader both !");

        $("html, body").scrollTop($("body").offset().top);
     }
     else
     {

         $.ajax({

                    url: baseurl+'reports/getReportDataforconsignment',

                    type: 'POST',

                    data: {show_id : show_id,teamleader_id : teamleader_id},

                    dataType: 'json',

                    success: function (data) {

                    
						console.log(data);
                      var total=0;
                      var counter=0;
                      var displayamount=0;
                      var i=1;

                       $.each(data, function(idx, obj) {

                         
                          displayamount=obj.product_approve_qty*obj.product_price; 

                           counter+=displayamount;              
                    
                            displayData+="<tr><td>"+ i++ +"</td><td>"+obj.product_approve_qty+"</td><td>"+obj.item_name+'-'+obj.product_name+"</td><td>"+displayamount+"</td><td>"+obj.product_requested_at+"</td></tr>";
                           
                        });

                       if(i!=1)
                       {
                           displayData+="<tr><td colspan=3></td> <td><b>"+counter+" /- </b></td> </tr>";
                       }
                       else
                       {
                          displayData+="<tr><td colspan=4 style='text-align:center'>No Data is Available</td></tr>";
                       }

                     
                     
                       displayData+="</tbody></table>";

                       $('.display_data').html(displayData);
                    },
                });


     }


  });

</script>

<script type="text/javascript">
  var checkdata=[];
  checkdata=getUrlVars();

  if(checkdata.length!=0 || checkdata!='')
  {
      var show_id = getUrlVars()["sid"];
      var teamleader_id = getUrlVars()["tid"];

      var appenddata1='';

      $("div.id_100 select").val(show_id);


      $.ajax({

                    url: baseurl + 'reports/getTeamleaderfoconsignment',

                    type: 'GET',

                    data: {show_id : show_id},

                    dataType: 'json',

                    success: function (data) {

                     $.each(data, function(idx, obj) {

                      if(obj.id==teamleader_id)
                      {
                         appenddata1+="<option selected value="+obj.id+">"+obj.name+"</option>";
                       
                      }
                      else
                      {
                        appenddata1+="<option  value="+obj.id+">"+obj.name+"</option>";
                      }

                       });
                   
                    
                     

                     if(appenddata1=='')
                     {
                        appenddata1+="<option value=''>"+"No team Leader Available"+"</option>";
                     }

                     
                      
                       $('#teamleader_id').html(appenddata1);

                    }
                });



      

       var displayData="<table style='width:100%' class='table'><thead><tr><th>Index</th><th>Quantity</th><th>Product</th><th>Retail Amount</th></tr></thead><tbody>";

 

     if(show_id=='' || teamleader_id== null || teamleader_id=='')
     {
      
        $("#notify").removeClass("alert-success");
        $("#notify").addClass("alert-warning").fadeIn();
        $("#notify .message").html("<strong>Warning</strong>: Please select Show and Team Leader both !");

        $("html, body").scrollTop($("body").offset().top);
     }
     else
     {



      $.ajax({

                    url: baseurl+'reports/getReportDataforconsignment',

                    type: 'POST',

                    data: {show_id : show_id,teamleader_id : teamleader_id},

                    dataType: 'json',

                    success: function (data) {

                    

                      var total=0;
                      var counter=0;
                      var displayamount=0;
                      var i=1;

                       $.each(data, function(idx, obj) {

                         
                          displayamount=obj.product_approve_qty*obj.product_price; 

                           counter+=displayamount;              
                    
                            displayData+="<tr><td>"+ i++ +"</td><td>"+obj.product_approve_qty+"</td><td>"+obj.product_name+"</td><td>"+displayamount+"</td></tr>";
                           
                        });

                       if(i!=1)
                       {
                           displayData+="<tr><td colspan=3></td> <td><b>"+counter+" /- </b></td> </tr>";
                       }
                       else
                       {
                          displayData+="<tr><td colspan=4 style='text-align:center'>No Data is Available</td></tr>";
                       }

                     
                     
                       displayData+="</tbody></table>";

                       $('.display_data').html(displayData);
                    },
                });

      }

      
  }


</script>
