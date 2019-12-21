<article class="content">
    <div class="card card-block">      
    <?php
    if(empty($shipping_pallet_data) || empty($invoice_item_details))
    {
    	?>

    	<div class="table-responsive">
    	<table class="table table-bordered">
	    	 <tr>
	            <th colspan="8" style="text-align: center;"> <?php echo $show_details->show_id; ?> | <?php echo $show_details->show_name; ?> 
	            </th>			         
	         </tr>
	         <tr>
	            <td colspan="8" style="text-align: center;">No Data is available for selected show</td>
	         </tr>
         </table>
     </div>
    	<?php
    }
    else
    {
    	?>
    		<div class="row">
    				<div class="col-md-12">
    						<table class="table table-bordered">
						    	 <tr>
						            <th colspan="8" style="text-align: center;"> <?php echo $show_details->show_id; ?> | <?php echo $show_details->show_name; ?></th>
						         </tr>
					        </table>
    				</div>
    				<?php foreach($shipping_pallet_data as $invoice){ ?>
    				<div class="col-md-6">
    					<div class="table-responsive">
	    					<table class="table table-bordered">
	    						 <tr>
	                                <th colspan="2">Customer Name</th>
	                                <td colspan="2"><?php echo $invoice['name']; ?></td>
	                            </tr>
	                            <tr>
	                                <th colspan="2">Shipping Address</th>
	                                <td colspan="2"><?php echo $invoice['address']; ?></td>
	                            </tr>
	                            <tr>
	                            	<td colspan="2"><b>City : </b> <?php echo $invoice['city']; ?> </td>
	                            	<td><b>State : </b> <?php echo $invoice['region']; ?> </td>
	                            	<td><b>Zip : </b><?php echo $invoice['postbox']; ?></td>
	                            </tr>
	                            <tr>
	                            	<th>Email </th>
	                            	<td colspan="3"><?php echo $invoice['email']; ?></td>
	                            </tr>
	                            <?php
	                            $count=0;
	                            foreach($invoice_item_details as $invoice_item)
	                            {
	                            	if($invoice['tid']==$invoice_item['tid'])
	                            	{
	                            		
	                            	?>
	                            	<tr>
	                            		<td colspan="4"></td>
	                            	</tr>
	                            	<tr>
	                            		<td><b>Quantity : </b> <?php echo $invoice_item['qty'] ?></td>
	                            		<td><b>Size : </b><?php echo $invoice_item['product_width']."x".$invoice_item['product_lenght']."x".$invoice_item['product_height']; ?></td>
	                            		<td><b>Quantity : </b> <?php echo $invoice_item['qty'] ?></td>
	                            		<td><b>Zip : </b><?php echo $invoice['postbox']; ?></td>	
	                            	</tr>
	                            	<tr>
	                            		<td><b>Quantity : </b> <?php echo $invoice_item['qty'] ?></td>
	                            		<td><b>Quantity : </b> <?php echo $invoice_item['title'] ?></td>
	                            		<td><b>Size : </b><?php echo $invoice_item['product_width']."x".$invoice_item['product_lenght']."x".$invoice_item['product_height']; ?></td>
	                            		<td><b>Color : </b> <?php if($invoice_item['color']==null)
	                            		{
	                            			echo 'N/A';
	                            		} 
	                            		else{

	                            			echo "<div style='width:45px;height:20px;background-color:".$invoice_item['color'].";color:".$invoice_item['color']."'></div>";
	                            		} ?></td>
	                            	</tr>
	                            	<?php
	                            	}
	                            }
	                             ?>
	                             <tr>
	                            	<th>Notes </th>
	                            	<td colspan="3"><?php echo $invoice['notes']; ?></td>
	                            </tr>
			    			</table>
		    			</div>
    				</div>
    			<?php } ?>
    			</div>	
    	<?php
    }
     ?>
    </div>
</article>