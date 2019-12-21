<article class="content">

    <div class="card card-block">

        <div id="notify" class="alert alert-success" style="display:none;">

            <a href="#" class="close" data-dismiss="alert">&times;</a>



            <div class="message"></div>

        </div>

        <div class="grid_3 grid_4">



            <form method="post" class="form-horizontal">



                <h3><?php echo $this->lang->line('Show and Break Times') ?></h3>

                <p>

                    <b><a href="#" class="btn btn-primary btn-sm rounded">

                                            <?php echo $project['show_id'] ?> 

                                </a>  

                                <a href="#" class="btn btn-primary btn-sm rounded">

                                            <?php echo $project['show_name'] ?> 

                                </a></b>

                </p>

                <hr>
                 <div class="form-group row">
                  <label class="col-sm-2 col-form-label" ></label>
                  <label class="col-sm-10 col-form-label" style="color: red" ><b><?php echo " Please Select Date Between ".$date[0]['show_start_date']."  and ".$date[0]['show_end_date']." only. "; ?></b></label>

                 </div>

                <div class="form-group row">



                    <label class="col-sm-2 col-form-label" ></label>



                    <div class="col-sm-5">

                        <label class="col-sm-1 col-form-label" for="from_breaktime"><b><?php echo $this->lang->line('From') ?></b></label>

                        <input type="text" id="start_date" 

                               class="form-control margin-bottom " required name="start_date">

                    </div>



                    <div class="col-sm-5">

                        <label class="col-sm-1 col-form-label" for="to_breaktime"><b><?php echo $this->lang->line('To') ?></b></label>

                        <input type="text" id="end_date" 

                               class="form-control margin-bottom "  required name="end_date">

                    </div>

                </div>

                <div class="form-group row">
                   <label class="col-sm-2 col-form-label"><b>Sales Person</b></label>

                   <div class="fetchselesperson col-md-5">

                   </div>

                </div>



                 <div class="form-group row">



                    <label class="col-sm-2 col-form-label"></label>

                     <div class="col-sm-4">

                        <a class="btn btn-success" id="set_time_date" style="color: white">Add time for each day</a>

                     </div>

                 </div>

                 

                  <div id="dynamic_date">



                </div>

            

                <div class="form-group row">



                    <label class="col-sm-2 col-form-label"></label>



                    <div class="col-sm-4">

                        
                        <a id="submit_breakdata" class="btn btn-success">Submit</a>
                    </div>

                </div>



            </form>

        </div>

    </div>

</article>



<div class="modal" id="myModal" role="dialog">

    <div class="modal-dialog">

      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

         

          <h4 class="modal-title">Set working time for each day</h4>

        </div>

        <form method="post">

        <div class="modal-body">

          

          <br/>

        </div>

     

        <div class="modal-footer">

            <a class="btn btn-success btnmodel" >Add</a>

            <button type="button" id="modelclose" readonly class="btn btn-default" data-dismiss="modal">Close</button>

        </div>

         </form>

      </div>

      

    </div>

  </div>



<script type="text/javascript">

    $(document).ready(function () {

     var show_start_date="<?php echo $date[0]["show_start_date"] ?>";
     var show_end_date="<?php echo $date[0]['show_end_date'] ?>";
   
    $("#start_date").datepicker({
    
        minDate: new Date(show_start_date),
      dateFormat: 'yy-mm-dd',
      maxDate: new Date(show_end_date),
       onSelect: function (selected) {
          var dt = new Date(selected);
         
          $("#end_date").datepicker("option", "minDate", dt);
        }

    });

    $("#end_date").datepicker({
       dateFormat: 'yy-mm-dd',
      maxDate : new Date(show_end_date),


    });

        var empd=<?php echo json_encode($emp);?>;

        var sp="<select class='form-control changeclass' id='salesperson_0' name='salesperson' >";

        for (var i = 0; i < empd.length; i++) {

            sp+="<option  value="+empd[i][0].id+">"+empd[i][0].name+"</option>";

        }


        sp+="</select>";

        $('.fetchselesperson').html(sp);

        $('#dynamic_date').hide();


        $("#set_time_date").click(function(){



            $('.btnmodel').show();



            var start = $('#start_date').val();

            var end = $('#end_date').val();



            var compareStart=new Date(start);

            var compareStartModel=new Date(start);

            var compareEnd=new Date(end);



            if(start == "" || end == "")

            {

                alert('Please Fill Start date and end date')

            }

            else

            {



                if(compareStart > compareEnd)

                {

                    alert('Invalid Date')

                }

                else

                {



                    var millisecondsPerDay = 1000 * 60 * 60 * 24;

                    var millisBetween = compareEnd.getTime() - compareStart.getTime();

                    var days = millisBetween / millisecondsPerDay;

                 



                    var TotalDay=Math.floor(days);



                    var displayDate="";



                        var i=0;

                        var d1=new Date(start);



                        var strDate=d1.getDate()+ "/" + (d1.getMonth()+1)+ "/" +d1.getFullYear();

                        //display starting working time details for break

                         displayDate+="<br/><div class='form-group row' id='dynamic_date'> <label class='col-sm-2 col-form-label' for='team_leader'><b>Date</b> </label> <div class='col-sm-2'><label  for='from_breaktime'><b>Working Date</b></label> <input readonly type='text' id='end_date_0' class='form-control margin-bottom  ' required value="+strDate+"  name='dates[]'> </div><div ><div  class='form-group row '><div class='col-sm-2' ><label  for='from_breaktime'><b>Working Start Time</b></label> <input type='text' id='start_time_work_0' class='form-control margin-bottom  ' required name='start_time_work[]' readonly></div><div class='col-sm-2' > <label  for='from_breaktime'><b>Working End Time</b></label><input type='text' readonly id='end_time_work_0' class='form-control margin-bottom '  required name='end_time_work[]'></div></div></div></div>";



                        //Add break time details for first date

                        displayDate+="<div class="+i+" ><div class='form-group row '> <div class='col-sm-2'> </div> <div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>StartTime</b></label> <input type='time' id='start_break_time_0' class='form-control margin-bottom  ' required name='bkstart0[]'> </div> <div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>EndTime</b></label> <input type='time' id='end_break_time_0' class='form-control margin-bottom '  required name='bkend0[]'></div> <div class='col-sm-1'> <a class='btn btn-success abc timeAddClickfordate"+i+"' id='"+i+"' style='color: white;border-radius:50%'>+</a> </div> </div> </div></div>";


                    for(var i=1; i<=TotalDay; i++)

                    {



                        date1=compareStart.setDate(compareStart.getDate() + 1)



                        var d=new Date(date1);



                        var strDate=d.getDate()+ "/" + (d.getMonth()+1)+ "/" +d.getFullYear();

                        //display ending working time details for break

                        displayDate+="<br/><br/><div class='form-group row' id='dynamic_date'> <label class='col-sm-2 col-form-label' for='team_leader'><b>Date</b> </label> <div class='col-sm-2'> <label  for='from_breaktime'><b>Working Date</b></label><input readonly type='text' id='end_date_"+i+"' class='form-control margin-bottom  ' required value="+strDate+"  name='dates[]'> </div><div  class='form-group row '> <div class='col-sm-2' > <label  for='from_breaktime'><b>Working Start Time</b></label>  <input type='text' readonly id='start_time_work_"+i+"' class='form-control margin-bottom' required name='start_time_work[]'>  </div>  <div class='col-sm-2' > <label  for='from_breaktime'><b>Working End Time</b></label> <input type='text' id='end_time_work_"+i+"' readonly class='form-control margin-bottom  ' required name='end_time_work[]'> </div> </div></div>";

                        //Add break time details for 2nd to all date

                        displayDate+="<div class="+i+" ><div class='form-group row '> <div class='col-sm-2'> </div> <div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>StartTime</b></label> <input type='time' id='start_break_time_"+i+"' class='form-control margin-bottom  ' required  name='bkstart"+i+"[]'> </div> <div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>EndTime</b></label> <input type='time' id='end_break_time_"+i+"' class='form-control margin-bottom '  required name='bkend"+i+"[]'></div> <div class='col-sm-1'> <a class='btn btn-success abc timeAddClickfordate"+i+"' id='"+i+"' style='color: white;border-radius:50%'>+</a> </div> </div> </div></div>";

                    }



                    //for model ------------------------------



                    var strDate1=d1.getDate()+ "/" + (d1.getMonth()+1)+ "/" +d1.getFullYear();

                        //Display working time for show 

                    displayModelData="<br/><div class='form-group row'> <label class='col-sm-1 col-form-label' for='team_leader'><b>Date</b> </label> <div class='col-sm-3'><input readonly type='text' id='end_date' class='form-control margin-bottom'  required value="+strDate1+"  name='modeldates[]'></div> <div  class='col-md-8'> <div class='form-group row '><div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>StartTime</b></label> <input type='time' id='start_date' class='form-control margin-bottom'  required name='working_start_time[]'> </div> <div class='col-sm-4'>  <label class='col-sm-1 col-form-label' for='from_breaktime'><b>EndTime</b></label> <input type='time' id='start_date' class='form-control margin-bottom'  required name='working_end_time[]'> </div> </div></div></div>";



                    $(".modal-body").html(displayModelData);



                    for(var i=1; i<=TotalDay; i++)

                    {

                        //Set working time for show    

                        date2=compareStartModel.setDate(compareStartModel.getDate() + 1)



                        var d=new Date(date2);



                        var strDate1=d.getDate()+ "/" + (d.getMonth()+1)+ "/" +d.getFullYear();



                        displayModelData+="<div class='form-group row'> <label class='col-sm-1 col-form-label' for='team_leader'><b>Date</b> </label> <div class='col-sm-3'><input  readonly type='text' id='end_date' class='form-control margin-bottom'  required value="+strDate1+"  name='modeldates[]'></div> <div  class='col-md-8'> <div  class='form-group row '><div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>StartTime</b></label> <input type='time' id='start_date' class='form-control margin-bottom'  required name='working_start_time[]'> </div> <div class='col-sm-4'>  <label class='col-sm-1 col-form-label' for='from_breaktime'><b>EndTime</b></label> <input type='time' required id='start_date' class='form-control margin-bottom ' name='working_end_time[]'> </div> </div></div></div>";

                        $(".modal-body").html(displayModelData);

                    }

                    $('#myModal').modal({backdrop: 'static',keyboard: false});

                    //for model -------------------------------

                  $("#dynamic_date").html(displayDate);

                    var dynamicremovecount=101;

                    $(".abc").click(function(){

                        dynamicremovecount++;

                         var box=$(this).attr('id');

                         var timeField="<div style='margin-top:-20px' class='form-group row "+dynamicremovecount+"' > <div class='col-sm-2'> </div> <div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'>StartTime</label> <input type='time' id='start_date' class='form-control margin-bottom '  required name='bkstart"+box+"[]'> </div> <div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'>EndTime</label> <input type='time' id='start_date' class='form-control margin-bottom  ' required name='bkend"+box+"[]'> </div><div class='col-sm-1'><p  class='btn btn-danger abc timeAddClickfordate' id='"+dynamicremovecount+"' style='color: white;margin-top:30px;border-radius:50%'>-</p></div> </div> ";

                         $("."+box).append(timeField); //add

                         $('.timeAddClickfordate').click(function(){

                             var box=$(this).attr('id');

                             $("."+dynamicremovecount).hide();

                         });



                    });



                }

            }



             var startt=[];

              var endt=[];

            $(".btnmodel").click(function(){



              var validationError=0;

             

              var inps = document.getElementsByName('working_start_time[]');

              var inps1= document.getElementsByName('working_end_time[]');

             for (var i = 0; i <inps.length; i++) {

                var inp=inps[i];

                    if(inp.value=='')

                    {

                        validationError+=1;

                    }

                    startt[i]=inp.value;



                    

                }

                for (var i = 0; i <inps1.length; i++) {

                var inp1=inps1[i];

                    if(inp1.value=='')

                    {

                        validationError+=1;

                    }

                    endt[i]=inp1.value;

                }



                if(validationError != 0)

                {

                    alert('Please fill up all startind work time and ending work time  fields with valid input');

                }

                else

                {
                     $('#modelclose').removeAttr("disabled");   

                      $('.btnmodel').hide();                 

                     $('#dynamic_date').show();

                  
                     //display working time details for each salesperson in main form from modal

                     $('#start_time_work_0').val(startt[0]);

                     $('#end_time_work_0').val(endt[0]);

                      $('#start_break_time_0').attr('min',startt[0]);

                      $('#start_break_time_0').attr('max',endt[0]);

                      $('#end_break_time_0').attr('min',startt[0]);

                      $('#end_break_time_0').attr('max',endt[0]);


                      $('#start_date').attr('max',endt[0]);

                      $('#start_date').attr('min',startt[0]);


                     for(var i=1;i<startt.length;i++)

                     {

                         $('#start_time_work_'+i).val(startt[i]);

                         $('#end_time_work_'+i).val(endt[i]);

                         $('#start_break_time_'+i).attr('min',startt[i]);

                          $('#start_break_time_'+i).attr('max',endt[i]);

                         $('#end_break_time_'+i).attr('min',startt[i]);

                        $('#end_break_time_'+i).attr('max',endt[i]);

                     }

                 
                }



            });

             $("#submit_breakdata").click(function() {  

                 var check1=0;


                 var errorCount=0;
                 var errorck=TotalDay+1;

                 var finaldata=[];
                 var all={};
                 var allbstime=[];
                 var allbetime=[];
                 var object={};
                 object.startbreaktime=[];
                 object.endbreaktime=[];
                 object.startbreaktimestam=[];
                 object.endbreaktimestam=[];
                 

                var alldates = document.getElementsByName('dates[]');
                console.log('main date');
                console.log(alldates);
                var allstarttime=document.getElementsByName('start_time_work[]');
                var allendtime=document.getElementsByName('end_time_work[]');
                var salesperson=document.getElementById('salesperson_0').value;
               
                 //for time check

                for (var i = 0; i < alldates.length; i++) {

                all[i]={};
                object.startbreaktime[i]=[];
                object.endbreaktime[i]=[];
                object.startbreaktimestam[i]=[];
                object.endbreaktimestam[i]=[];
                var date=alldates[i];
             
                var starttimes=allstarttime[i];
                var endtimes=allendtime[i];
                var startbreaktimes=document.getElementsByName('bkstart'+i+'[]');
                var endbreaktimes=document.getElementsByName('bkend'+i+'[]');

                allbstime[i]={};
                allbetime[i]={};

                for(var j=0;j<startbreaktimes.length;j++)
                {
                	var stratbtime=startbreaktimes[j].value;
                	var endbtime=endbreaktimes[j].value;

                  if((stratbtime > endt[i] || stratbtime < startt[i]) || (endbtime > endt[i] || endbtime < startt[i]) )
                  {
                      alert('Start Break Time and End Break Time Must Be In Between Working Hours ('+startt[i]+' - '+endt[i]+' ) for date'+date.value+' you set [ '+stratbtime+' - '+ endbtime +' ]');
                      check1++;
                     
                  }

                    var tchange=date.value;

                    var from = tchange.split("/");

                 
                      var getdate=new Date(from[2], from[1]-1,from[0]);
                      var year = getdate.getFullYear();
                      var month = getdate.getMonth() + 1;
                      var day = getdate.getDate();

                      var dateString = '' + year + '-' + month + '-' + day;
                      var combined = new Date(dateString + ' ' + stratbtime);
                      var combinedend = new Date(dateString + ' ' + endbtime);
                     
                      
                	object.startbreaktime[i][j]=stratbtime;
                	object.endbreaktime[i][j]=endbtime;
                  object.startbreaktimestam[i][j]=combined.getTime();
                  object.endbreaktimestam[i][j]=combinedend.getTime();

                  if(object.startbreaktimestam[i][j] > object.endbreaktimestam[i][j])
                  {
                    alert('Start time is greater then end time ');
                    check1++;
                  }

                
                  if(j > 0 )
                  {
                    var combinedlaststart = new Date(dateString+' '+startbreaktimes[j-1].value);
                    var combinedlastend = new Date(dateString+' '+endbreaktimes[j-1].value);

                      if((object.startbreaktimestam[i][j] >= combinedlaststart.getTime()) && (object.startbreaktimestam[i][j] <= combinedlaststart.getTime()  ))
                      {
                         check1++;
                      
                      }
                       if((object.endbreaktimestam[i][j] <= combinedlaststart.getTime()) && (object.endbreaktimestam[i][j] >= combinedlaststart.getTime()  ))
                      {
                         check1++;
                      
                      }
                   }

                    if(check1 != 0)
                    {
                     $("#notify .message").html("<strong>Warning</strong> :  Please insert valid date and time ");

                      $("#notify").removeClass("alert-danger").addClass("alert-warning").fadeIn();

                      $("html, body").scrollTop($("body").offset().top);

                    return false;
                    }
                }

               	all[i]['start_break_time']=object.startbreaktime[i];
               	all[i]['end_break_time']=object.endbreaktime[i];

                var changedateformate1=date.value;
                var from = changedateformate1.split("/");
                var getdatefordatabase=from[1]+"/"+from[0]+"/"+from[2];


               	all[i]['date']=getdatefordatabase;//new Date(from[1], from[0]-1,from[2]);
                
                all[i]['starttimes']=starttimes.value;
                all[i]['endtimes']=endtimes.value;
                all[i]['salesperson']=salesperson;
                all[i]['show_id']="<?php echo $_GET['id']; ?>";
                all[i]['assign_by']="<?php echo $this->aauth->get_user()->id; ?>";

                }

               if(check1 == 0)
                    {
                     $("#notify .message").html("<strong>Success</strong> :  Data saved ");



                      $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();

                      $("html, body").scrollTop($("body").offset().top);

                   
                  }

            jQuery.ajax({

            url: baseurl+"/BiB/projects/setBreakTimeShow",

            type: 'POST',

	        data: {all : all},

            dataType: 'json',

            success: function (data) {

                if (data.status == "Success") {

                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);

                    $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();

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

            

        }); 

       



    });



   

</script>


