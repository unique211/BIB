<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4">

            <form method="post" id="data_form" class="form-horizontal">

                <h3><?php echo $this->lang->line('Show and Break Times') ?></h3>
                <p>
                    <b><a href="#" class="btn btn-primary btn-sm rounded">
                                            <?php echo $this->lang->line('Store') ?> 2
                                </a>  
                                <a href="#" class="btn btn-primary btn-sm rounded">
                                            Test Store 
                                </a></b>
                </p>
                <hr>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" ></label>

                    <div class="col-sm-5">
                        <label class="col-sm-1 col-form-label" for="from_breaktime"><b><?php echo $this->lang->line('From') ?></b></label>
                        <input type="date" id="start_date" placeholder="Add Commision Rate (%)"
                               class="form-control margin-bottom  required" name="start_date">
                    </div>

                    <div class="col-sm-5">
                        <label class="col-sm-1 col-form-label" for="to_breaktime"><b><?php echo $this->lang->line('To') ?></b></label>
                        <input type="date" id="end_date" placeholder="Add Commision Rate (%)"
                               class="form-control margin-bottom  required" name="end_date">
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
                        <input type="submit" id="submit-data1" class="btn btn-success margin-bottom"
                               value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">
                        
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
            <button type="submit" class="btn btn-success btnmodel" >Add</button>
         
        </div>
         </form>
      </div>
      
    </div>
  </div>

<script type="text/javascript">
    $(document).ready(function () {

        $('#submit-data1').attr("disabled", true);

        $('#dynamic_date').hide();

       // $('.btnmodel').attr("disabled", true);

        $("#set_time_date").click(function(){

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
                   // alert( Math.floor(days));

                    var TotalDay=Math.floor(days);



                    var displayDate="";

                    
                        // date1=compareStart.setDate(compareStart.getDate() + 1)
                        var i=0;
                        var d1=new Date(start);

                        var strDate=d1.getDate()+ "/" + (d1.getMonth()+1)+ "/" +d1.getFullYear();

                         displayDate+="<br/><div class='form-group row' id='dynamic_date'> <label class='col-sm-2 col-form-label' for='team_leader'><b>Date</b> </label> <div class='col-sm-2'> <input readonly type='text' id='end_date' class='form-control margin-bottom  required' value="+strDate+"  name='dates[]'> </div><div ><div style='margin-top:-20px' class='form-group row '><div class='col-sm-2' style='margin-top:-40px'><label class='col-sm-1 col-form-label' for='from_breaktime'><b>StartTime</b></label> <input type='time' id='start_date' class='form-control margin-bottom  required' name='tl_commission'></div><div class='col-sm-2' style='margin-top:-40px'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>EndTime</b></label><input type='time' id='start_date' class='form-control margin-bottom  required' name='tl_commission'></div></div></div></div><div style='margin-top:-10px' class='form-group row'><label class='col-sm-2 col-form-label' for='team_leader'><b><?php echo $this->lang->line('Sales Person') ?></b></label><div class='col-sm-6'><select class='form-control' name='team_leader'><option>---Select Sales Person---</option>    </select></div></div>";

                        displayDate+="<div class="+i+" ><div style='margin-top:-20px' class='form-group row '> <div class='col-sm-2'> </div> <div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>StartTime</b></label> <input type='time' id='start_date' class='form-control margin-bottom  required' name='tl_commission'> </div> <div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>EndTime</b></label> <input type='time' id='start_date' class='form-control margin-bottom  required' name='tl_commission'></div> <div class='col-sm-1'> <a class='btn btn-success abc timeAddClickfordate"+i+"' id='"+i+"' style='color: white;border-radius:50%'>+</a> </div> </div> </div></div>";

                    for(var i=1; i<=TotalDay; i++)
                    {

                        date1=compareStart.setDate(compareStart.getDate() + 1)

                        var d=new Date(date1);

                        var strDate=d.getDate()+ "/" + (d.getMonth()+1)+ "/" +d.getFullYear();
                       
                        displayDate+="<br/><br/><div class='form-group row' id='dynamic_date'> <label class='col-sm-2 col-form-label' for='team_leader'><b>Date</b> </label> <div class='col-sm-2'> <input readonly type='text' id='end_date' class='form-control margin-bottom  required' value="+strDate+"  name='dates[]'> </div><div style='margin-top:-20px' class='form-group row '> <div class='col-sm-2' style='margin-top:-40px'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>StartTime</b></label>  <input type='time' id='start_date' class='form-control margin-bottom  required' name='tl_commission'>  </div>  <div class='col-sm-2' style='margin-top:-40px'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>EndTime</b></label> <input type='time' id='start_date' class='form-control margin-bottom  required' name='tl_commission'> </div> </div></div><div class='form-group row'><label class='col-sm-2 col-form-label' for='team_leader'><b><?php echo $this->lang->line('Sales Person') ?></b></label><div class='col-sm-6'><select class='form-control' name='team_leader'><option>---Select Sales Person---</option>    </select></div> </div>";

                        displayDate+="<div class="+i+" ><div style='margin-top:-20px' class='form-group row '> <div class='col-sm-2'> </div> <div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>StartTime</b></label> <input type='time' id='start_date' class='form-control margin-bottom  required' name='tl_commission'> </div> <div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>EndTime</b></label> <input type='time' id='start_date' class='form-control margin-bottom  required' name='tl_commission'></div> <div class='col-sm-1'> <a class='btn btn-success abc timeAddClickfordate"+i+"' id='"+i+"' style='color: white;border-radius:50%'>+</a> </div> </div> </div></div>";
                    }

                    //for model ------------------------------

                    var strDate1=d1.getDate()+ "/" + (d1.getMonth()+1)+ "/" +d1.getFullYear();

                    displayModelData="<br/><div class='form-group row'> <label class='col-sm-1 col-form-label' for='team_leader'><b>Date</b> </label> <div class='col-sm-3'><input readonly type='text' id='end_date' class='form-control margin-bottom'  required value="+strDate1+"  name='modeldates[]'></div> <div style='margin-top:-30px' class='col-md-8'> <div class='form-group row '><div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>StartTime</b></label> <input type='time' id='start_date' class='form-control margin-bottom'  required name='working_start_time[]'> </div> <div class='col-sm-4'>  <label class='col-sm-1 col-form-label' for='from_breaktime'><b>EndTime</b></label> <input type='time' id='start_date' class='form-control margin-bottom'  required name='working_end_time[]'> </div> </div></div></div>";

                    $(".modal-body").append(displayModelData);

                    for(var i=1; i<=TotalDay; i++)
                    {

                        date2=compareStartModel.setDate(compareStartModel.getDate() + 1)

                        var d=new Date(date2);

                        var strDate1=d.getDate()+ "/" + (d.getMonth()+1)+ "/" +d.getFullYear();

                        displayModelData+="<div class='form-group row'> <label class='col-sm-1 col-form-label' for='team_leader'><b>Date</b> </label> <div class='col-sm-3'><input  readonly type='text' id='end_date' class='form-control margin-bottom'  required value="+strDate1+"  name='modeldates[]'></div> <div style='margin-top:-30px' class='col-md-8'> <div  class='form-group row '><div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'><b>StartTime</b></label> <input type='time' id='start_date' class='form-control margin-bottom'  required name='working_start_time[]'> </div> <div class='col-sm-4'>  <label class='col-sm-1 col-form-label' for='from_breaktime'><b>EndTime</b></label> <input type='time' required id='start_date' class='form-control margin-bottom  required' name='working_end_time[]'> </div> </div></div></div>";

                        $(".modal-body").html(displayModelData);
                    }
                    

                    $('#myModal').modal({backdrop: 'static',
    keyboard: false});

                    //for model -------------------------------


                  $("#dynamic_date").html(displayDate);

                    var dynamicremovecount=101;

                    $(".abc").click(function(){

                        dynamicremovecount++;

                         var box=$(this).attr('id');

                         var timeField="<div style='margin-top:-20px' class='form-group row "+dynamicremovecount+"' > <div class='col-sm-2'> </div> <div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'>StartTime</label> <input type='time' id='start_date' class='form-control margin-bottom  required' name='tl_commission'> </div> <div class='col-sm-4'> <label class='col-sm-1 col-form-label' for='from_breaktime'>EndTime</label> <input type='time' id='start_date' class='form-control margin-bottom  required' name='tl_commission'> </div><div class='col-sm-1'><p  class='btn btn-danger abc timeAddClickfordate' id='"+dynamicremovecount+"' style='color: white;margin-top:30px;border-radius:50%'>-</p></div> </div> ";

                         $("."+box).append(timeField); //add

                         $("p").click(function(){

                            var box=$(this).attr('id');

                            $("."+dynamicremovecount).hide();
                           

                         });

                    });

                }
            }

            $(".btnmodel").click(function(){
                
                $('#set_time_date').hide();
                $('#dynamic_date').toggle();

                var start_time = document.getElementsByName('working_start_time[]');

                var end_time = document.getElementsByName('working_end_time[]');

                for (var i = 0; i <inps.length; i++) {
                var inp=inps[i];
                    alert(start_time.value);
                }



            });
        }); 
       

    });

   
</script>

