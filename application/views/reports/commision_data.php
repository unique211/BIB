<?php 

if((count($boothdetail[0])==0) OR $totalsalesperson==0 OR $totaldate==0 OR $totaldate == '' OR $totalsalesperson == '')
{

  ?>
 <br>
 <div style='width:100%;text-align:center;'>
  <h1>No Data Is Available for selected Show</h1>
</div>
<br>

<?php  
}



?>


<article class="content">

    <div class="card card-block">

        <div id="notify" class="alert alert-success" style="display:none;">

            <a href="#" class="close" data-dismiss="alert">&times;</a>



            <div class="message"></div>

        </div>

        <div class="grid_3 grid_4">

           

            <h3>Commission Report</h3>

            <hr>



            <div class="row sameheight-container">
            	<div class="col-md-12 table-responsive">
                        <?php
                        //  echo json_encode($allinvoicesdetails);
            		$totalcash=0;
            		 foreach($boothdetail[0] as $booth) { 
            		 	$totalcash=0;
                              $totallastcol=0;
                              $cashgrossforsal=0;
                              $finalcashgross=0;
                              $totalcashcredit=0;
                              $totallastcolcredit=0;
                              $cashgrossforsalcredit=0;
                              $finalcashgrosscredit=0;
                              $taxforcashsale=0;
                              $taxforcreditsale=0;
                              $taxcashforsales=0;
                              $taxcreditforsales=0;
                              $finalcashgross1=0;
                              $totalrowtaxforcashsale=0;
                              $finalcashgrosscredit2=0;
                              $totalrowtaxforcreditsale=0;
                              $cashnetforsales=0;
                              $creditnetforsales=0;
                              $cashgrossforsal1=0;
                              $totalcashnet=0;
                              $totalcreditnet=0;
                              //$finalgross2=0;   //distri cs
                              $finalcashgross2=0;
                              $totalrowtaxforcashsale1=0;
                              $totalcashnet1=0;
                              $totaldistributecomcash=0;
                              $finalcashgrosscredit3=0;
                              $totaldistributecomforcredit=0;
                              $finalcashgross6=0;

                              //distributed commission----------
                              $salescashgrosstotal=0;
                              $distributedcashtax=0;
                              $distributedcashtax1=0;
                              $distributedcashnet=0;
                              $salescreditgrosstotal=0;
                              $distributedcredittax=0;
                              $distributedcreditnet=0;
                              $distributedtotalgross=0;
                              $sp_cash_gross = array();
                              $sp_tax_amt = array();
                              $sp_cash_net = array();
            		 	?>
            			<div style="text-align: left;">
            				<span class="btn btn-sm btn-success"><?php echo $booth['description']; ?></span>
            			</div>
            			<br>
                          <!-- --------------------------------Cash Based Sales----------  -->     
            		<table class="table table-bordered" style="width: 100%">

            			<thead>
            			 	<tr>
            			 		<th style="text-align: center;font-size: 18px" colspan="<?php echo ($totalsalesperson+4); ?>">CASH SALES</th>
            			 	</tr>
            			 	<tr>
            			 		<th colspan="2">Date</th>
            			 		<?php foreach($salesperson as $sl) {?>

            			 			<th><?php echo $sl[0]['name'] ?></th>
            			 		<?php } ?>
            			 		<th>Total</th>
            			 	</tr>
            			 	<?php foreach($dates as $date) {  
            			 	$rowtotal=0;	?>
            			 	<tr>
            			 		<th colspan="2"><?php echo $date; ?></th>
            			 		
            			 			<?php foreach($salesperson as $sl){ 
            			 				
            			 				?>

            			 				<?php foreach($datewithsales as $dtsl) { 
                                                            foreach($dtsl as $dt){
                                                                  if($booth['id']==$dt['bid'] AND $sl[0]['id']==$dt['salesperson_id']  AND $date==$dt['invoicedate'] )
            			 						{
            			 								$totalcash=$totalcash+$dt['total'];
            			 						}
                                                            }
            			 					
            			 					 ?>

            			 				<?php } ?>

            			 				<th><?php
            			 					$rowtotal=$rowtotal+$totalcash;
                                                            $totallastcol=$totallastcol+$totalcash;
            			 				 echo $totalcash; ?></th>
                                                      

            			 		<?php $totalcash=0; } ?>
            			 		
            			 			
            			 		<th><?php echo $rowtotal ?></th>
            			 	</tr>
            			 	<?php $rowtotal=0;  } ?>
                                    <tr>
                                          <th colspan="2"></th>
                                          <th colspan="<?php echo $totalsalesperson; ?>"></th>
                                          <th><?php echo $totallastcol; ?></th>

                                    </tr>
                                    <tr>
                                          <th colspan="2">Cash Gross</th>
                                          <?php foreach($salesperson as $sl) {
                                                $cashgrossforsal=0;
                                                foreach($datewithsales as $dtsl){
                                                      foreach($dtsl as $dt){
                                                            if($booth['id']==$dt['bid'] AND $sl[0]['id']==$dt['salesperson_id'] )
                                                             {
                                                                  $cashgrossforsal+=$dt['total'];
                                                                 
                                                             }
                                                      }

                                              
                                                         }
                                                ?>

                                                <th> <?php echo $cashgrossforsal; ?></th>
                                                                        
                                          <?php $sp_cash_gross[$sl[0]['id']]  = $cashgrossforsal;  $finalcashgross=$finalcashgross+$cashgrossforsal; } ?>
                                          <th><?php echo $finalcashgross; ?></th>

                                    </tr>
                                    <!--      Tax Count   -->
                                    <tr>
                                          <?php

                                                foreach($allinvoicesdetails as $invoice)
                                                {
                                                if($invoice[0]['booth_id']==$booth['id'] AND $invoice[0]['taxstatus']=='yes' AND $invoice[0]['pmethod']==1)
                                                      {
                                                            $taxforcashsale+=$invoice[0]['tax'];
                                                      }

                                                }

                                           ?>
                                          <th>Tax Rate</th>
                                          <th style="background-color: yellow"><?php echo $taxforcashsale; ?>%</th>
                                           <?php foreach($salesperson as $sl) {
                                                $cashgrossforsal=0;
                                                $taxcashforsales=0;
                                                foreach($datewithsales as $dtsl){
                                                      foreach($dtsl as $dt){
                                                            if($booth['id']==$dt['bid'] AND $sl[0]['id']==$dt['salesperson_id'] )
                                                             {
                                                                  $taxcashforsales+=$dt['tax'];
                                                                 
                                                             }
                                                      }
                                                
                                                                  }
                                                ?>

                                                <th> <?php

                                                     
                                                      $totalrowtaxforcashsale+=$taxcashforsales;
                                                 echo $taxcashforsales; ?></th>

                                          <?php $sp_tax_amt[$sl[0]['id']]  = $taxcashforsales;
                                    } ?>

                                         
                                           <th><?php echo $totalrowtaxforcashsale; ?></th>     

                                    </tr>
                                    <!------------      cash net ------------------------------------------------- -->
                                    <tr>
                                          <th colspan="2">Cash Net</th>
                                            <?php foreach($salesperson as $sl) {
                                                 $cashgrossforsal=0;
                                                
                                                ?>

                                                <th> <?php

                                               
                                                $cashgrossforsal = $sp_cash_gross[$sl[0]['id']] - $sp_tax_amt[$sl[0]['id']];
                                                $sp_cash_net[$sl[0]['id']] = $cashgrossforsal;
                                                $totalcashnet +=  $cashgrossforsal;
                                                echo ($cashgrossforsal);?></th>

                                          <?php } ?>
                                           <th><?php echo $totalcashnet ?></th>
                                    </tr>

                                    <!--------------  cash distributed commission ---------------->
                                    <tr>
                                          <th>Disctributor Commission</th>
                                          <th>10%</th>
                                          <?php foreach($salesperson as $sl) {
                                                $cashgrossforsal=0;
                                                
                                                $countdistributoncashnet=($sp_cash_net[$sl[0]['id']]*10)/100;
                                                ?>
                                                <th><?php 
                                                $totaldistributecomcash+=$countdistributoncashnet;
                                                echo $countdistributoncashnet; ?></th>

                                              
                                          <?php } ?>
                                           <th><?php echo $totaldistributecomcash; ?></th>
                                    </tr>
            			</thead>

            		</table>
                        <br>
                        <?php 
                              $sp_cash_gross = array();
                              $sp_tax_amt = array();
                              $sp_cash_net = array();
                        ?>
                        <!-- --------------------------------Credit Card Based Sales----------  -->
                        <table class="table table-bordered" style="width: 100%">

                              <thead>
                                    <tr>
                                          <th style="text-align: center;font-size: 18px" colspan="<?php echo ($totalsalesperson+4); ?>">CREDIT CARD SALES</th>
                                    </tr>
                                    <tr>
                                          <th colspan="2">Date</th>
                                          <?php foreach($salesperson as $sl) {?>

                                                <th><?php echo $sl[0]['name'] ?></th>
                                          <?php } ?>
                                          <th>Total</th>
                                    </tr>
                                    <?php foreach($dates as $date) {  
                                    $rowtotalcredit=0;      ?>
                                    <tr>
                                          <th colspan="2"><?php echo $date; ?></th>
                                          
                                                <?php foreach($salesperson as $sl){ 
                                                      
                                                      ?>

                                                      <?php foreach($datewithsalesforcredit as $dtsl) { 
                                                                  foreach($dtsl as $dt){
                                                                        if($booth['id']==$dt['bid'] AND $sl[0]['id']==$dt['salesperson_id']  AND $date==$dt['invoicedate'] )
            			 						      {
            			 								$totalcashcredit=$totalcashcredit+$dt['total'];
            			 						      }
                                                                  }
                                                             ?>

                                                      <?php } ?>

                                                      <th><?php
                                                            $rowtotalcredit=$rowtotalcredit+$totalcashcredit;
                                                            $totallastcolcredit=$totallastcolcredit+$totalcashcredit;
                                                       echo $totalcashcredit; ?></th>


                                          <?php $totalcashcredit=0; } ?>
                                          
                                                
                                          <th><?php echo $rowtotalcredit ?></th>
                                    </tr>
                                    <?php $rowtotalcredit=0;  } ?>
                                    <tr>
                                          <th colspan="2"></th>
                                          <th colspan="<?php echo $totalsalesperson; ?>"></th>
                                          <th><?php echo $totallastcolcredit; ?></th>

                                    </tr>
                                    <tr>
                                          <th colspan="2">Credit Card Gross</th>
                                          <?php foreach($salesperson as $sl) {
                                                $cashgrossforsalcredit=0;
                                                foreach($datewithsalesforcredit as $dtsl){
                                                foreach($dtsl as $dt){
                                                      if($booth['id']==$dt['bid'] AND $sl[0]['id']==$dt['salesperson_id'] )
                                                       {
                                                            $cashgrossforsalcredit+=$dt['total'];
                                                           
                                                       }
                                                }             }
                                                ?>

                                                <th> <?php echo $cashgrossforsalcredit; ?></th>

                                          <?php $sp_cash_gross[$sl[0]['id']]  = $cashgrossforsalcredit; $finalcashgrosscredit=$finalcashgrosscredit+$cashgrossforsalcredit;} ?>
                                          <th><?php echo $finalcashgrosscredit; ?></th>

                                    </tr>
                                    <!--  Credit Card Tax Rate -->
                                    <tr>
                                          <?php

                                                foreach($allinvoicesdetails as $invoice)
                                                {
                                                if($invoice[0]['booth_id']==$booth['id'] AND $invoice[0]['taxstatus']=='yes' AND $invoice[0]['pmethod']==2)
                                                      {
                                                            $taxforcreditsale+=$invoice[0]['tax'];
                                                      }

                                                }

                                           ?>
                                          <th>Tax Rate</th>
                                          <th style="background-color: yellow"><?php echo $taxforcreditsale; ?></th>
                                           <?php foreach($salesperson as $sl) {
                                                $cashgrossforsalcredit=0;
                                                $taxcreditforsales=0;
                                                foreach($datewithsalesforcredit as $dtsl){

                                                foreach($dtsl as $dt){
                                                      if($booth['id']==$dt['bid'] AND $sl[0]['id']==$dt['salesperson_id'] )
                                                       {
                                                            $taxcreditforsales+=$dt['tax'];
                                                           // $finalcashgrosscredit2=$finalcashgrosscredit2+$cashgrossforsalcredit;
                                                       }
                                                }
                                                                  }
                                                ?>

                                                <th> <?php

                                                      
                                                      $totalrowtaxforcreditsale+=$taxcreditforsales;
                                                 echo $taxcreditforsales; ?></th>

                                          <?php $sp_tax_amt[$sl[0]['id']]  = $taxcreditforsales; } ?>
                                           <th><?php echo $totalrowtaxforcreditsale; ?></th>     

                                    </tr>
                                    <tr>
                                          <th colspan="2">Credit Card Net</th>
                                          <?php foreach($salesperson as $sl) {
                                                $cashgrossforsalcredit=0;
                                       
                                                ?>

                                                <th> <?php

                                                        $cashgrossforsalcredit = $sp_cash_gross[$sl[0]['id']] - $sp_tax_amt[$sl[0]['id']];
                                                      $sp_cash_net[$sl[0]['id']] = $cashgrossforsalcredit;
                                                      $totalcreditnet += $cashgrossforsalcredit;
                                                 echo ($cashgrossforsalcredit); ?></th>

                                          <?php } ?>
                                           <th><?php echo $totalcreditnet; ?></th>
                                    </tr>
                                    <tr>
                                          <th>Disctributor Commission</th>
                                          <th>10%</th>
                                          <?php foreach($salesperson as $sl) { 
                                                $cashgrossforsalcredit=0;
                                               
                                                $distributecomforcredit=($sp_cash_net[$sl[0]['id']]*10)/100;
                                                                  $totaldistributecomforcredit+=$distributecomforcredit;
                                                ?>
                                                <th><?php echo $distributecomforcredit; ?></th>
                                           <?php } ?>
                                           <th><?php echo $totaldistributecomforcredit; ?></th>
                                    </tr>
                              </thead>

                        </table>

                        <div class="table-responsive">

                        <table class="table table-bordered" style="width: 100%">
                              <thead>
                                    <tr>
                                          <th style="text-align: center;" colspan="<?php echo ($totaldate+2); ?>">DAILY TOTAL</th>
                                    </tr>
                                    <tr>
                                          <th>Date</th>
                                          <?php
                                                foreach($dates as $date)
                                                {
                                                      ?>
                                                      <th><?php echo $date; ?></th>
                                                      <?php
                                                }
                                           ?>
                                           <th>Total</th>
                                    </tr>
                                    <tr>
                                          <th>Cash Gross</th>
                                          <?php
                                          $sp_cash_gross = array();
                                          $sp_cash_tax_amt = array();
                                          $sp_cash_net = array();
                                          $sp_credit_gross = array();
                                          $sp_credit_tax_amt = array();
                                          $sp_credit_net = array();
                                          $sp_daily_gross = array();
                                          $sp_daily_tax_amt = array();
                                          $sp_daily_net = array();

                                          $totalcashgrossdatewise=0;
                                         
                                                foreach($dates as $date)
                                                { $totalcashd=0;
                                                     foreach($datewithsales as $dtsl) { 
                                                            
                                                            foreach($dtsl as $dt){
                                                                  
                                                                  if($booth['id']==$dt['bid'] AND $date==$dt['invoicedate'])
                                                                   {
                                                                        $totalcashd=$totalcashd+$dt['total'];
                                                                        
                                                                   }
                                                                  
                                                            }
                                                            } 
                                                      ?>
                                                      <th><?php echo $totalcashd;  ?></th>
                                                      <?php $totalcashgrossdatewise+=$totalcashd;
                                                      $sp_cash_gross[$date] = $totalcashd;
                                                }
                                           ?>
                                           <th><?php echo $totalcashgrossdatewise; ?></th>
                                    </tr>
                                    <tr>
                                          <th>Cash tax Collected</th>
                                          <?php
                                          $taxforcreditsale1=0;
                                          $totaltaxford=0;
                                          $totaltaxd=0;
                                          $totalcashd=0;
                                                foreach($dates as $date)
                                                {
                                                      $totalcashd=0;
                                                      foreach($datewithsales as $dtsl) { 
                                                            foreach($dtsl as $dt){
                                                            if($booth['id']==$dt['bid'] AND $date==$dt['invoicedate'] )
                                                                  {
                                                                              $totalcashd=$totalcashd+$dt['tax'];
                                                                             
                                                                  }
                                                      
                                                            } 
                                                      }

                                                            
                                                      ?>
                                                      <th><?php 
                                                      $sp_cash_tax_amt[$date] = $totalcashd;
                                                         $totaltaxd+=$totalcashd;
                                                      echo $totalcashd; ?></th>
                                                      <?php
                                                }
                                           ?>
                                          <th><?php echo $totaltaxd; ?></th>
                                    </tr>
                                    <tr>
                                          <th>Cash Net</th>
                                          <?php
                                          $taxforcreditsale1=0;
                                          $totaltaxford=0;
                                          $totaltaxd=0;
                                          $totalcashgrossdatewise=0;
                                          $totalcashd=0;
                                          
                                          foreach($dates as $date)
                                          {
                                          

                                                ?>
                                                
                                                <th><?php
                                                       $taxforcont=$sp_cash_gross[$date] - $sp_cash_tax_amt[$date]; //($totalcashd)-($taxforcreditsale1*$totalcashd)/(100);
                                                       $sp_cash_net[$date] = $taxforcont;
                                                       $totaltaxd+=$taxforcont;
                                                 echo $taxforcont; ?></th>
                                                <?php
                                          } ?>
                             
                                    <th><?php echo $totaltaxd; ?></th>
                                    </tr>
                                    

                                    <tr>
                                          <th>Credit Card Gross</th>
                                          <?php
                                          $totalcashgrossdatewise=0;
                                          
                                                foreach($dates as $date)
                                                {$totalcashd=0;
                                                     foreach($datewithsalesforcredit as $dtsl) { 
                                                           
                                                            foreach($dtsl as $dt){
                                                                  if($booth['id']==$dt['bid'] AND $date==$dt['invoicedate'] )
                                                                   {
                                                                        $totalcashd=$totalcashd+$dt['total'];
                                                                       
                                                                   }
                                                            }
                                                      }

                                                      ?>
                                                      <th><?php echo $totalcashd; ?></th>
                                                      <?php
                                                      $sp_credit_gross[$date]  = $totalcashd;
                                                      $totalcashgrossdatewise+=$totalcashd;
                                                }
                                           ?>
                                           <th><?php echo $totalcashgrossdatewise; ?></th>
                                    </tr>
                                    <tr>
                                          <th>Credit Card Tax Collected</th>
                                          <?php
                                          $taxforcreditsale1=0;
                                          $totaltaxford=0;
                                          $totaltaxd=0;
                                          $totalcashd=0;
                                                foreach($dates as $date)
                                                {
                                                      $totalcashd=0;
                                                      foreach($datewithsalesforcredit as $dtsl) { 
                                                            foreach($dtsl as $dt){
                                                            if($booth['id']== $dt['bid'] AND $date== $dt['invoicedate'] )
                                                                  {
                                                                              $totalcashd=$totalcashd+ $dt['tax'];
                                                                             
                                                                  }
                                                      
                                                            } 
                                                      }

                                                            
                                                      ?>
                                                      <th><?php 
                                                      $sp_credit_tax_amt[$date] = $totalcashd;
                                                         $totaltaxd+=$totalcashd;
                                                      echo $totalcashd; ?></th>
                                                      <?php
                                                }
                                           ?>
                                           <th><?php echo $totaltaxd; ?></th>
                                    </tr>
                                    <tr>
                                          <th>Credit Card Net</th>
                                          <?php $totalcreditnet =0;
                                          foreach($dates as $date)
                                          {
                                         
                                                ?>

                                                <th> <?php

                                                      
                                                      $totalcreditnetd = $sp_credit_gross[$date] - $sp_credit_tax_amt[$date];
                                                      $sp_credit_net[$date] =$totalcreditnetd;
                                                      $totalcreditnet+=$totalcreditnetd;//$cashgrossforsalcredit-$taxcreditforsales;
                                                 echo $totalcreditnetd;//($cashgrossforsalcredit-$taxcreditforsales); ?></th>

                                          <?php } ?>
                                           <th><?php echo $totalcreditnet; ?></th>
                                    </tr>
                                    <tr>  
                                          <!-- only + declaration on top is remail -->
                                          <th>Daily Gross</th>
                                          <?php
                                          $totalcashd01=0;
                                          $totalcashgrossdatewise01=0;  //
                                          $totalcashd1=0;
                                          $totalcashgrossdatewise1=0;   //
                                          $totaldailygross=0;           
                                                foreach($dates as $date)
                                                {
                                                            $dailygross=$sp_cash_gross[$date]+$sp_credit_gross[$date];
                                                            $totaldailygross+=$dailygross;  
                                                      ?>
                                                      <th><?php echo $dailygross; ?></th>
                                                      <?php
                                                }
                                           ?>
                                           <th><?php echo $totaldailygross; ?></th>
                                    </tr>
                                     <tr>
                                          <th>Daily Tax Collected</th>
                                          <?php
                                          $taxforcreditsale12=0;
                                          $totaltaxford2=0;
                                          $datewisetotaltaxcount=0;
                                          $totalcashd22=0;
                                          $totalcashd10=0;
                                          $totaldailytax=0;
                                                foreach($dates as $date)
                                                {
                                                      
                                                            $datewisetotaltaxcount=$sp_cash_tax_amt[$date]+$sp_credit_tax_amt[$date];//$casetaxdatewise+$creditcardtaxdatewise;
                                                            $totaldailytax=$totaldailytax+$datewisetotaltaxcount;
                                                       ?>
                                                      <th><?php echo $datewisetotaltaxcount; ?></th>
                                                      <?php
                                                }
                                           ?>
                                           <th><?php echo $totaldailytax; ?></th>
                                    </tr>
                                    <tr>
                                          <th>Daily Net</th>
                                          <?php
                                         $taxforcreditsale123=0;
                                          $totaltaxford23=0;
                                          $datewisetotaltaxcount3=0;
                                          $totalcashd223=0;
                                          $totalcashd103=0;
                                          $totaldailytax3=0;
                                          $datewiseceditnetd=0;
                                          $datewisecashnetd=0;
                                          $dailynet=0;
                                          $totaldilynet=0; //
                                                foreach($dates as $date)
                                                {
                                                      
                                                            $dailynet=$sp_cash_net[$date]+$sp_credit_net[$date];//$datewisecashnetd+$datewiseceditnetd;
                                                            $totaldilynet+=$dailynet;




                                                      ?>
                                                      <th><?php echo $dailynet; ?></th>
                                                      <?php
                                                }
                                           ?>
                                           <th><?php echo $totaldilynet ?></th>
                                    </tr>
                              </thead>
                        </table>
                  </div>
                  <br>


                 <!-- DIstributed COmmission --> 

                <table class="table table-bordered" style="width: 100%">
                  <thead>
                    <tr>
                      <th colspan="<?php echo ($totalsalesperson+2); ?>" style="text-align: center;">DISTRIBUTOR COMMISSION</th>
                    </tr>
                    <tr>
                      <th>Date</th>
                      <?php foreach($salesperson as $sl){ ?>
                        <th><?php echo $sl[0]['name']; ?></th>
                      <?php } ?>
                      <th>Total</th>
                    </tr>
                    <!-- Cash Gross -->
                    <tr>
                      <th>Cash Gross</th>

                       <?php 
                        $sp_cash_gross = array();
                        $sp_cash_tax_amt = array();
                        $sp_cash_net = array();
                        $sp_credit_gross = array();
                        $sp_credit_tax_amt = array();
                        $sp_credit_net = array();
                        $sp_daily_gross = array();
                        $sp_daily_tax_amt = array();
                        $sp_daily_net = array();

                  //      $salescashgross=0;
                       foreach($salesperson as $sl){ 
                        $salescashgross=0;
                        foreach($datewithsales as $dtsl) { 
                              foreach($dtsl as $dt){
                                    if($booth['id']==$dt['bid'] AND $sl[0]['id']==$dt['salesperson_id'])
                                    {
                                          $salescashgross=$salescashgross+$dt['total'];
                                          
                                    }
                              }
                        }

                            ?>
                        <th><?php echo $salescashgross; ?></th>

                       <?php $salescashgrosstotal+=$salescashgross;
                       $sp_cash_gross[$sl[0]['id']] = $salescashgross;
                  } ?>
                       <th><?php echo $salescashgrosstotal; ?></th>

                    </tr>

                     <!-- Cash Gross -->
                     

                  </thead>
                  <tbody>
                    <tr>
                      <th>Tax Cash Collected</th>
                      <?php foreach($salesperson as $sl) {
                        $salescashtaxtotal=0;
                        $salescashgross=0;
                        $salescashtaxcount=0;
                        //  foreach($allinvoicesdetails as $invoice){
                        //     if($booth['id']==$invoice[0]['bid'] AND $sl[0]['id']==$invoice[0]['salesperson_id'] AND $invoice[0]['pmethod']==1)
                        //     {
                        //       $salescashgross=$salescashgross+$invoice[0]['total'];
                        //       if($invoice[0]['taxstatus']=='yes')
                        //       {
                        //         $salescashtaxtotal+=$invoice[0]['tax'];
                        //       }
                              
                             
                        //     }
                        //   }
                        foreach($datewithsales as $dtsl) { 
                              foreach($dtsl as $dt){
                                    if($booth['id']==$dt['bid'] AND $sl[0]['id']==$dt['salesperson_id'])
                                    {
                                          $salescashtaxcount=$salescashtaxcount+$dt['tax'];
                                          
                                    }
                              }
                        }
                        //   $salescashtaxcount=($salescashgross*$salescashtaxtotal)/100;
                          $sp_cash_tax_amt[$sl[0]['id']] = $salescashtaxcount;
                          $distributedcashtax+=$salescashtaxcount;

                          ?>

                        <th><?php echo $salescashtaxcount; ?></th>
                      <?php } ?>
                      <th><?php echo $distributedcashtax;  ?></th>
                    </tr>

                    <tr>
                      <th>Cash Net 
                      </th>
                      <?php foreach($salesperson as $sl){ 
                      
                          $salescashnetcount=$sp_cash_gross[$sl[0]['id']] - $sp_cash_tax_amt[$sl[0]['id']];//$salescashgross-$salescashtaxcount;
                          $sp_cash_net[$sl[0]['id']] = $salescashnetcount;
                          $distributedcashnet+=$salescashnetcount;
                        ?>
                        <th><?php echo $salescashnetcount; ?></th>
                      <?php } ?>
                      <th><?php echo $distributedcashnet; ?></th>
                    </tr>
                    <tr>
                      <th>Credit Card Gross</th>
                      <?php
                      $salescreditgross=0;
                       foreach($salesperson as $sl){ $salescreditgross=0;
                        
                        foreach($datewithsalesforcredit as $dtsl) { 
                              foreach($dtsl as $dt){
                                    if($booth['id']==$dt['bid'] AND $sl[0]['id']==$dt['salesperson_id'])
                                    {
                                          $salescreditgross=$salescreditgross+$dt['total'];
                                          
                                    }
                              }
                        }
                            ?>
                        <th><?php echo $salescreditgross; ?></th>
                      <?php $salescreditgrosstotal+=$salescreditgross;
                      $sp_credit_gross[$sl[0]['id']] = $salescreditgross;
                  } ?>
                      <th><?php echo $salescreditgrosstotal; ?></th>
                    </tr>
                    <tr>
                      <th>Credit Card Tax Collected </th>
                      <?php foreach($salesperson as $sl){  
                        $salescredittaxtotal=0;
                        $salescreditgross=0;
                        $salescredittaxcount=0;
                      
                        foreach($datewithsalesforcredit as $dtsl) { 
                              foreach($dtsl as $dt){
                                    if($booth['id']==$dt['bid'] AND $sl[0]['id']==$dt['salesperson_id'])
                                    {
                                          $salescredittaxcount=$salescredittaxcount+$dt['tax'];
                                          
                                    }
                              }
                        }
                        //   $salescredittaxcount=($salescreditgross*$salescredittaxtotal)/100;
                          $distributedcredittax+=$salescredittaxcount;
                          $sp_credit_tax_amt[$sl[0]['id']] = $salescredittaxcount;
                          ?>

                        <th><?php echo $salescredittaxcount; ?></th>

                       
                      <?php } ?>
                      <th><?php echo $distributedcredittax; ?></th>
                    </tr>
                    <tr>
                       <th>Credit Card Net</th>
                       <?php foreach($salesperson as $sl){ 
                         $salescredittaxtotal=0;
                          $salescreditgross=0;
                       
                          $salescreditnetcount=$sp_credit_gross[$sl[0]['id']]  - $sp_credit_tax_amt[$sl[0]['id']] ;//$salescreditgross-$salescredittaxcount;
                          $sp_credit_net[$sl[0]['id']] = $salescreditnetcount;
                          $distributedcreditnet+=$salescreditnetcount;
                        ?>
                        <th><?php echo $salescreditnetcount; ?></th>
                       
                      <?php } ?>
                        <th><?php echo $distributedcreditnet; ?></th>
                    </tr>

                    <tr>
                      <th>Total Gross</th>
                      <?php 
                      foreach($salesperson as $sl){ 
                       
                        $distributedgross = $sp_cash_gross[$sl[0]['id']] + $sp_credit_gross[$sl[0]['id']];
                        $sp_daily_gross[$sl[0]['id']] =  $distributedgross;
                        $distributedtotalgross+=$distributedgross;
                        ?>

                        <th><?php echo $distributedgross; ?></th>

                      <?php } ?>
                      <th><?php echo $distributedtotalgross; ?></th>
                    </tr>
                    <tr>
                      <th>Total Tax Collected</th>
                      <?php 
                      $distributedtotaltax=0;
                      foreach($salesperson as $sl) {

                        $salescashgross=0;
                        $salescashtax=0;
                        $salescreditgross=0;
                        $salescredittax=0;
                        $salestotaltax=0;

                        $salestotaltax= $sp_cash_tax_amt[$sl[0]['id']] + $sp_credit_tax_amt[$sl[0]['id']];//$salescashtotaltax+$salescredittotaltax;
                        $sp_daily_tax_amt = $salestotaltax;
                        $distributedtotaltax+=$salestotaltax;
                        ?>

                      <th><?php echo $salestotaltax; ?></th>
                      <?php } ?>
                     
                      
                      <th><?php echo $distributedtotaltax; ?></th>
                    </tr>

                    <tr>
                      <th>Total Net</th>
                      <?php
                      $distributedtotalnet=0;
                       foreach($salesperson as $sl){ 
                        $salescashgross=0;
                        $salescashtax=0;
                        $salescreditgross=0;
                        $salescredittax=0;
                        $salestotaltax=0;
                        $salescashtotalnet=0;
                        $salescredittotalnet=0;
                        $distributednet=0;

                       
                        $distributednet=  $sp_cash_net[$sl[0]['id']] + $sp_credit_net[$sl[0]['id']];//$salescashtotalnet+$salescredittotalnet;
                        $sp_daily_net[$sl[0]['id']] = $distributednet;
                        $distributedtotalnet+=$distributednet;







                      ?>

                      <th><?php echo $distributednet; ?></th>
                        
                      <?php } ?>
                      <th><?php echo $distributedtotalnet; ?></th>
                    </tr>

                    <tr>
                      <th>Distribution Commission</th>
                      <?php 
                      $distributedtotalcommission=0;
                      foreach($salesperson as $sl){
                        $salescashgross=0;
                        $salescashtax=0;
                        $salescreditgross=0;
                        $salescredittax=0;
                        $salestotaltax=0;
                        $salescashtotalnet=0;
                        $salescredittotalnet=0;
                        $distributednet=0;
                        $distributedtotalnet=0;
                        $distributedcommission=0;

                        
                        $distributedcashcommission=($sp_cash_net[$sl[0]['id']]*(10))/100;//($salescashtotalnet*(10))/100;
                        $distributedcreditcommission=($sp_credit_net[$sl[0]['id']]*(10))/100;//($salescredittotalnet*(10))/100;
                        $distributedcommission=$distributedcashcommission+$distributedcreditcommission;
                        $distributedtotalcommission+=$distributedcommission;
                    ?>

                      <th><?php echo $distributedcommission; ?></th>
                        

                       

                      <?php } ?>

                      <th><?php echo $distributedtotalcommission;?></th>

                    </tr>
                   
                  </tbody>
                </table>

                 <!-- DIstributed COmmission --> 


                <br>
            		<?php } ?>
            	</div>
            </div>
        </div>
    </div>
</article>


