<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4">


    <h3>Add Break Time</h3>
    <hr>
    </div>

    <form>
       <div class="form-group row">
                  <label class="col-sm-2 col-form-label" ><b>Sales Person : </b></label>
                  <div class="col-sm-6">
                   <input readonly="" type="text" id="salesperson_name" value="<?php echo $salesperson['name']; ?>"  class="form-control margin-bottom " required name="salesperson_name">
               </div>
             </div>

             <?php
             $nb=0;
             foreach($workingtimedetails as $wrtime)
             {
              foreach($breaktimedetailsfromdatatabse as $bkcheck)
              {
                if($wrtime['id']==$bkcheck['detail_id'])
                {
                  $first_s_date=$bkcheck['start_break_time'];
                  $first_e_date=$bkcheck['end_break_time'];
                  break;
                }
              }
              ?>

              <div class="form-group row">
                <div class="col-md-2">
                </div>
                <div class="col-md-2">
                   <label class="col-form-label" ><b>Date :  </b></label>
                   <input type="text" style="display: none" name="detail_id[]" value="<?php echo $wrtime['id']; ?>" />
                      
                  <input readonly="" type="text" id="date"  value="<?php echo $wrtime['date']; ?>"   class="form-control margin-bottom " required name="date[]">
                </div>
                <div class="col-md-4">
                   <label class="col-form-label" ><b>Strat Working Time :  </b></label>
                      
                  <input readonly="" type="time" id="start_working_time" value="<?php echo $wrtime['start_working_time']; ?>"   class="form-control margin-bottom " required name="start_working_time[]">
                </div>
                <div class="col-md-4">
                   <label class="col-form-label" ><b> End Working Time :  </b></label>
                      
                  <input readonly="" type="time" id="end_working_time" value="<?php echo $wrtime['end_working_time']; ?>"   class="form-control margin-bottom " required name="end_working_time[]">
                </div>
              </div>

              <div class="form-group row appendclass_<?php echo $wrtime['id'] ?>" id="<?php echo $wrtime['id'] ?>">
                <div class="col-md-4">
                </div>
                <div class="col-md-3">
                   <label class="col-form-label" ><b>Start Break Time :  </b></label>
                      
                  <input value="<?php echo $first_s_date; ?>"   type="time" id="start_break_time"  min="<?php echo $wrtime['start_working_time']; ?>" max="<?php echo $wrtime['end_working_time']; ?>" class="form-control margin-bottom " required name="start_break_time<?php echo $wrtime['id']; ?>[]">
                </div>
                <div class="col-md-3">
                   <label class="col-form-label" ><b>End Break Time :  </b></label>
                      
                  <input  value="<?php echo $first_e_date; ?>"   min="<?php echo $wrtime['start_working_time']; ?>" max="<?php echo $wrtime['end_working_time']; ?>" type="time" id="end_break_time"  class="form-control margin-bottom " required name="end_break_time<?php echo $wrtime['id']; ?>[]">
                </div>
                <div class="col-sm-2">
                 <a class="btn btn-success  timeAddClickfordate  " data-id="<?php echo $wrtime['id']; ?>"   style='color: white; border-radius:50%' id="<?php echo $wrtime['id'] ?>" >+</a> 
                </div>




              <div class="append_<?php echo $wrtime['id']; ?>">


                <!-- ====================================================== -->

                <?php 
                $counn=1;
                foreach($breaktimedetailsfromdatatabse as $spd){ 
                  $xx=mt_rand(1,10000);
                  if($spd['detail_id']==$wrtime['id']){
                    if($counn!=1){
                  ?>
                  <div class="row">
                  <div class="form-group delete_row_<?php echo $xx; ?>" > 
                    <div class='col-md-3'> 
                    </div> 
                    <div class='col-md-3'> 
                      <label class='col-form-label' ><b>Start Break Time :  </b>
                      </label>  
                      <input  type='time' value="<?php echo $spd['start_break_time']; ?>" id='start_break_time' class='form-control margin-bottom' required name="start_break_time<?php echo $wrtime['id']; ?>[]">
                    </div>
                    <div class='col-md-3'> 
                      <label class='col-form-label' ><b>End Break Time :  </b>
                      </label> 
                      <input value="<?php echo $spd['end_break_time']; ?>" type='time' id='end_break_time'  class='form-control margin-bottom' required name="end_break_time<?php echo $wrtime['id']; ?>[]"> 
                    </div> 
                    <div class='col-sm-2'> <p class='btn btn-danger abc deleterow' id="delete_row_<?php echo $xx; ?>" style='color: white; border-radius:50%' >-</p>
                    </div> 
                    <div class="col-md-1">
                    </div>
                  </div>
                </div>

                <?php  }  $counn++; } } ?>
            

                <!-- ====================================================== -->
                </div>

              </div>

              <script type="text/javascript">
                var dd="<?php echo $breaktimedetailsfromdatatabse[$nb]['detail_id']; ?>";
                var nb="<?php echo $nb; ?>";
                console.log('data is  $breaktimedetailsfromdatatabse['+nb+'][detail_id] :- '+dd);
              </script>
            
              <?php
              $nb++;
             }
              ?> 
              <div class="form-group row">
                  <div class="col-sm-4">
                  </div>
                  <div class="col-sm-2">
                  
                      <button type="button" id="modelclose" readonly class="btn btn-success" data-dismiss="modal">Add Break Time </button>
                      </div>

                </div>
               
          </form>


  </div>
</article>
<script type="text/javascript">
  
</script>
<script type="text/javascript">
  
  $('.timeAddClickfordate').click(function(){
    var x = Math.floor((Math.random() * 100000) + 1);
    var dataid=$(this).attr('data-id');
     var timeField="<div class='form-group row delete_row_"+x+"' style='padding:7px' > <div class='col-md-4'> </div> <div class='col-md-3'> <label class='col-form-label' ><b>Start Break Time :  </b></label>  <input  type='time' id='start_break_time' class='form-control margin-bottom' required name='start_break_time"+dataid+"[]'></div><div class='col-md-3'> <label class='col-form-label' ><b>End Break Time :  </b></label> <input type='time' id='end_break_time'  class='form-control margin-bottom' required name='end_break_time"+dataid+"[]'> </div> <div class='col-sm-1'> <p class='btn btn-danger abc deleterow' id='delete_row_"+x+"' style='color: white; border-radius:50%' >-</p></div> </div>";
       $(".append_"+$(this).attr('id')).append(timeField);
  });
    $(document).on('click','.deleterow', function(){  
        var id=$(this).attr('id');
        $('.'+id).remove();
       });
</script>
<script type="text/javascript">
  $('#modelclose').click(function(){
    var checkinsertion=0;
     var detailid = document.getElementsByName('detail_id[]');
     var datee = document.getElementsByName('date[]');
     var startt = document.getElementsByName('start_working_time[]');
     var endt = document.getElementsByName('end_working_time[]');
     var all={};
     var object={};
     var allbstime=[];
         var allbetime=[];
          var check1=0;
     object.startbreaktime=[];
     object.endbreaktime=[];
     object.startbreaktimestam=[];
         object.endbreaktimestam=[];
    for(var i=0;i<detailid.length;i++)
    {
            all[i]={};
            object.startbreaktime[i]=[];
            object.endbreaktime[i]=[];
            object.startbreaktimestam[i]=[];
            object.endbreaktimestam[i]=[];
            all[i]['detail_id']=detailid[i].value;
            all[i]['salesperson_id']="<?php echo $_GET['asid']; ?>";
            all[i]['show_id']="<?php echo $_GET['show_id'] ?>";
            var starttimes=startt[i].value;
            var endtimes=endt[i].value;
            var date=datee[i].value;
            var detailid1=detailid[i].value;
            var stratbreaktime=document.getElementsByName('start_break_time'+detailid1+'[]');
            var endbreaktime=document.getElementsByName('end_break_time'+detailid1+'[]');
           
            for(var j=0;j<stratbreaktime.length;j++)
            {
              var stratbtime=stratbreaktime[j].value+":00";
              var endbtime=endbreaktime[j].value+":00";
              if(stratbreaktime[j].value != '' ||  stratbreaktime[j].value)
              {
                checkinsertion++;
              }
                
              console.log("("+stratbtime +">"+ endtimes +"||"+ stratbtime +"<"+ starttimes+") || ("+endbtime +">"+ endtimes +"||"+ endbtime +"<"+ starttimes+")");
                      if(stratbtime!=':00' || endbtime!=':00')
                      {
                      
                        if((stratbtime > endtimes || stratbtime < starttimes) || (endbtime > endtimes || endbtime < starttimes) )
                        {
                           
                            check1++;
                           
                        }
                      }
                            var tchange=date;
                            console.log(tchange);
                            var from = tchange.split("-");
                       
                            var getdate=new Date(from[0], from[1]-1,from[2]);
                         
                            var year = getdate.getFullYear();
                            var month = getdate.getMonth() + 1;
                            var day = getdate.getDate();
                            
                            var dateString = '' + year + '-' + month + '-' + day;
                            var combined = new Date(dateString + ' ' + stratbtime);
                            var combinedend = new Date(dateString + ' ' + endbtime);
                            console.log("get date : "+ dateString);
                            object.startbreaktime[i][j]=stratbtime;
                            object.endbreaktime[i][j]=endbtime;
                            object.startbreaktimestam[i][j]=combined.getTime();
                            object.endbreaktimestam[i][j]=combinedend.getTime();
                            console.log(object.startbreaktimestam[i][j] +">"+ object.endbreaktimestam[i][j]);
                        if(object.startbreaktimestam[i][j] > object.endbreaktimestam[i][j])
                        {
                          alert('Start time is greater then end time');
                          check1++;
                        }
                        if(j > 0 )
                        {
                            var combinedlaststart = new Date(dateString+' '+stratbreaktime[j-1].value);
                            var combinedlastend = new Date(dateString+' '+endbreaktime[j-1].value);
                            console.log(combinedlaststart + "----" + combinedlastend);
                              if((object.startbreaktimestam[i][j] >= combinedlaststart.getTime()) && (object.startbreaktimestam[i][j] <= combinedlastend.getTime()  ))
                              {
                              
                                 check1++;
                              
                              }
                              if((object.endbreaktimestam[i][j] >= combinedlaststart.getTime()) && (object.endbreaktimestam[i][j] <= combinedlastend.getTime()  ))
                              {
                                //alert('Please Select Unique Break Time Slot');
                                 check1++;
                              
                              }
                        }
                          if(check1 != 0)
                          {
                           $("#notify .message").html("<strong>Warning</strong> :  Please insert valid date and time with Unique break time slot");
                            $("#notify").removeClass("alert-danger").addClass("alert-warning").fadeIn();
                            $("html, body").scrollTop($("body").offset().top);
                         
                          }
                          if(check1 != 0)
                          {
                             return false;
                          }
                          if(checkinsertion==0)
                          {
                            $("#notify .message").html("<strong>Warning</strong> :  Please Insert At least one Break Time details for show working day");
                            $("#notify").removeClass("alert-danger").addClass("alert-warning").fadeIn();
                            $("html, body").scrollTop($("body").offset().top);
                          }
                          if(checkinsertion==0)
                          {
                            return false;
                          }
            }
            all[i]['start_break_time']=object.startbreaktime[i];
            all[i]['end_break_time']=object.endbreaktime[i];
          } 
          console.log(all);
          
          jQuery.ajax({
            url: baseurl+"projects/addbreaktime",
            type: 'POST',
            data: {all : all},
            dataType: 'json',
            success: function (data) {
                if (data.status == "Success") {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-danger");
                    $("#notify").removeClass("alert-warning").addClass("alert-success").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);      
                } else {
                  
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-success").addClass("alert-danger").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                }
            },
            error: function (data) {
              
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-success").addClass("alert-danger").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
            }
        });
    
     
  });
      
  
</script>