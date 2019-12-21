<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4">


		<h3>Set Working Time</h3>
		
		<hr>  
		<form>
			 <div class="form-group row">
                  <label class="col-sm-2 col-form-label" ></label>
                  <label class="col-sm-10 col-form-label" style="color: red" ><b><?php echo " Please Select Date Between ".$date[0]['show_start_date']."  and ".$date[0]['show_end_date']." only. "; ?></b></label>
        </div>
              <div class="form-group row">


                    <label class="col-sm-2 col-form-label" ><b>Date : </b></label>



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
                    
                    <div class="col-md-12">
                    	<br>
                    </div>

                     <div class="col-sm-2">	
                     	<label class="col-form-label" ><b>SalesPerson :  </b></label>
                     </div> 

                      <div class="col-sm-5">

                       

                        <select name="salesperson" class="form-control margin-bottom" id="salesperson">
                        	<option value="">ALL</option>
                        	<?php

                            foreach ($emp as $row) {

                                $cid = $row['id'];

                                $title = $row['name'];

                                $teamleader=array();

                                 $teamleader=explode(",",$show_emp);

                                    foreach($teamleader as $t)
                                    {
                                        if($cid==$t)
                                        {
                                             echo "<option  value='$cid'>$title</option>";
                                        }
                                       
                                    }

                               

                            }

                            ?> 
                        </select>

                    </div>

              </div>

              <div class="col-md-12">
                    	<br>
                    	<label class="col-sm-2 col-form-label" for="to_breaktime"></label>
                    	<input type="button" class="btn btn-primary workingtime" value="Enter Working Time"/>
              </div>

                    

             

               

               <!-- add working time fields dynamic -->

               <div class="datass">
               </div>

               <!-- add working time fields dynamic -->

			
		</form>
     </div>

	</div>
</div>
</article>

<script type="text/javascript">
	

    $(document).ready(function () {

     var show_start_date="<?php echo $date[0]["show_start_date"] ?>";
     var show_end_date="<?php echo $date[0]['show_end_date'] ?>";
     var show_id="<?php echo $_GET['id'] ?>";
    
    

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


    //--------------------Enter Working time button--------------------

    $('.workingtime').click(function(){

         $(".datass").html();


    	var startdate = $('#start_date').val();
    	var enddate =  $('#end_date').val();
      var salesperson =$("#salesperson option:selected" ).val();
     
      
      var fromdatabasealldata={};




        jQuery.ajax({

                    url: baseurl+"/projects/getdetailsfordisplay",

                    type: 'POST',

                    data: { show_id: show_id,show_start_work_date:startdate,show_end_work_date:enddate,salesperson:salesperson},

                    dataType: 'json',

                    success: function (data) {

                     
                         
                         var countfromdata=0;

                        
                        $.each( data, function( key, obj ) {

                          countfromdata++;
                          
                          
                        });

                        console.log("total data"+countfromdata);

                        //-------------------In AJAX SUCCESS----------------
                        var ddate=[];


      if(startdate == '' || enddate == '')
      {
        alert('Enter Start Date and End Date First');
      }
      else
      {

        var compareStart=new Date(startdate);
        var compareStartModel=new Date(startdate);
        var compareEnd=new Date(enddate);
        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var millisBetween = compareEnd.getTime() - compareStart.getTime();
        var days = millisBetween / millisecondsPerDay;
        var TotalDay=Math.floor(days);
        var firstworkingtme01;

        var i=0;

        var d1=new Date(startdate);

        var strDate1=d1.getDate()+ "/" + (d1.getMonth()+1)+ "/" +d1.getFullYear();


        if(countfromdata !=0)
        {
          firstworkingtmestart01=data[0].start_working_time;
          firstworkingtmeend01=data[0].end_working_time;
        }
        else
        {
          firstworkingtmestart01=null;
          firstworkingtmeend01=null;
        }

         ddate[0]=strDate1;


                        //Display working time for show 

                    displayModelData="<br><br/><div class='form-group row'> <label class='col-sm-1 col-form-label' for='team_leader'> </label> <div class='col-sm-3'><label class='col-sm-2 col-form-label' for='from_breaktime'><b>Date</b></label><input readonly type='text' id='end_date' class='form-control margin-bottom'  required value="+strDate1+"  name='modeldates[]'></div> <div  class='col-md-8'> <div class='form-group row '><div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>StartTime</b></label> <input type='time' value="+firstworkingtmestart01+" id='start_date' class='form-control margin-bottom'  required name='working_start_time[]'> </div> <div class='col-sm-4'>  <label class='col-sm-1 col-form-label' for='from_breaktime'><b>EndTime</b></label> <input value="+firstworkingtmeend01+" type='time' id='start_date' class='form-control margin-bottom'  required name='working_end_time[]'> </div> </div></div></div>";



                    $(".datass").html(displayModelData);

                    for(var i=1; i<=TotalDay; i++)
                      {
                      var wstime='';
                      var wetime=''; 


                     if(countfromdata > i)
                     {
                       wstime=data[i].start_working_time;
                      wetime=data[i].end_working_time;
                     }


                     
                    
                        //Set working time for show    

                        date2=compareStartModel.setDate(compareStartModel.getDate() + 1);



                        var d=new Date(date2);



                        var strDate1=d.getDate()+ "/" + (d.getMonth()+1)+ "/" +d.getFullYear();

                        

                        ddate[i]=strDate1;

                      

                        displayModelData+="<div class='form-group row'> <label class='col-sm-1 col-form-label' for='team_leader'></label> <div class='col-sm-3'><label class='col-sm-2 col-form-label' for='from_breaktime'><b>Date</b></label><input  readonly type='text' id='end_date' class='form-control margin-bottom'  required value="+strDate1+"  name='modeldates[]'></div> <div  class='col-md-8'> <div  class='form-group row '><div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>StartTime</b></label> <input type='time' value='"+wstime+"' id='start_date' class='form-control margin-bottom'  required name='working_start_time[]'> </div> <div class='col-sm-4'>  <label class='col-sm-1 col-form-label' for='from_breaktime'><b>EndTime</b></label> <input value='"+wetime+"' type='time' required id='start_date' class='form-control margin-bottom ' name='working_end_time[]'> </div> </div></div></div>";



                        $("datass").html(displayModelData);

                    }

                     displayModelData+="<div class='row form-group'> <label class='col-sm-1 col-form-label' for='team_leader'></label> <div class='col-sm-3'><input type='button' class='btn btn-primary' value='Add Working Time' id='addworkingtime' /></div></div>";

                     $(".datass").html(displayModelData);



             //-----------------check validation------------------------


            $('#addworkingtime').click(function(){


              var validationError=0;

              var startt=[];

              var endt=[];

              var salesperson =$("#salesperson option:selected" ).val();


              var inps = document.getElementsByName('working_start_time[]');

              var inps1= document.getElementsByName('working_end_time[]');

             



             for(var i = 0; i <inps.length; i++) {

                var inp=inps[i];

                    if(inp.value=='')

                    {

                        validationError++;

                    }

                    startt[i]=inp.value;
                 

                }

                for(var i = 0; i <inps1.length; i++) {

                var inp1=inps1[i];

                    if(inp1.value=='')

                    {

                        validationError++;

                    }

                    endt[i]=inp1.value;

                }

                if(validationError != 0)
                {

                    alert('Please fill up all startind work time and ending work time  fields with valid input');

                }
                else
                {

                  var errorfortime=0;

                  for(var i=0 ; i < endt.length ; i++)
                  {
                    if(startt[i] > endt[i] )
                    {
                      errorfortime++;
                      
                    }
                    
                  }

                  if(errorfortime != 0)
                  {
                    alert('End Working Time Must be greater than Start Break Time ');
                    return false;
                  }
                  else
                  {
                      var all={};

                      for(var i=0 ; i < endt.length ; i++)
                      {
                        
                      all[i]={};
                      var changedateformate1=ddate[i];
                     
                              var from = changedateformate1.split("/");
                      var getdatefordatabase=from[1]+"/"+from[0]+"/"+from[2];
                      all[i]['date']=getdatefordatabase;
                      all[i]['starttimes']=startt[i];
                      all[i]['endtimes']=endt[i];
                      all[i]['salesperson']=salesperson;
                      all[i]['show_id']="<?php echo $_GET['id']; ?>";
                      all[i]['assign_by']="<?php echo $this->aauth->get_user()->id; ?>";
                            }

                      console.log(all);

                      jQuery.ajax({

                       url: baseurl+"/projects/setBreakTimeShowwt",

                       type: 'POST',

                       data: {all : all},

                        dataType: 'json',

                        success: function (data) {

                        if (data.status == "Success") {

                            $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);

                            $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();

                            $("html, body").scrollTop($("body").offset().top);


                            } 
                        },

                 
                      });


                  }


                
                }


            });

             //-----------------check validation------------------------
              
      }
                        //--------------------END AJAX SUCCESS----------------
                       
                    },
                  });

        


    	

    	
    });



});




</script>