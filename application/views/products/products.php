<article class="content">
    <div class="card card-block">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-toggle.min.css" rel="stylesheet">
 <!--Sweetalert -->
 <link href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css" rel="stylesheet">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4 animated fadeInRight">
            <h3><?php echo $this->lang->line('Item Name'). ': '.$products[0]->item_name.' - '. $this->lang->line('Products') ?></h3>
            <div class="row">

                <div class="col-xl-4 col-lg-6 col-xs-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-block">
                                <div class="media">
                                    <div class="media-body text-xs-left">
                                        <h3 class="green"><span id="dash_0"></span></h3>
                                        <span><?php echo $this->lang->line('In Stock') ?></span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-rocket green font-large-2 float-xs-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-xs-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-block">
                                <div class="media">
                                    <div class="media-body text-xs-left">
                                        <h3 class="red"><span id="dash_1"></span></h3>
                                        <span><?php echo $this->lang->line('Stock out') ?></span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-blocked red font-large-2 float-xs-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-xs-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-block">
                                <div class="media">
                                    <div class="media-body text-xs-left">
                                        <h3 class="cyan" id="dash_2"></h3>
                                        <span><?php echo $this->lang->line('Total') ?></span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-stats-bars22 cyan font-large-2 float-xs-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php //echo $id."<br/>";
       // print_r($products)
        ?>
        <div class="table-responsive">
            <table id="productstable" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Qty') ?></th>
                        <th><?php echo $this->lang->line('SKU Number') ?></th>
                        <th><?php echo $this->lang->line('Category') ?></th>
                        <th><?php echo $this->lang->line('Price') ?></th>
                        <th><?php echo $this->lang->line('Settings') ?></th>
                    </tr>
                </thead>
                <tbody><?php 
                    $instock = 0;
                    $outstock = 0;
                    $totalstock = 0;
                    $i = 1;
                    foreach ($products as $row) {
                    $name = $row->product_name.'-'.$row->clr.'-'.$row->sz.'-'.$row->mtr;
                    $qty = isset($row->qty) ? $row->qty : 0;
                    $id = $row->pid;
                    $code = $row->SKU_number;
                    $cat = $row->cat;
                    $price = $row->product_price;
                    $status=$row->status;
                    // $cnt = $row->cnt;
                    if ($qty == 0)
                    $outstock++;
                    else {
                    $instock++;
                    }
                    $del = '';
                   // if ($cnt == 0) {
                    $del = "<a data-object-id='" . $id . "' class='btn btn-danger btn-xs delete-object' title='Delete' href='#'><i class='icon-trash-o'></i></a>";
                   // }
                    echo "<tr>
                        <td>$i</td>
                        <td>$name</td>
                        <td>$qty</td>
                        <td>$code</td>
                        <td>$cat</td>
                        <td>$price</td>";
                        if ($this->aauth->get_user()->roleid == 2 || $this->aauth->get_user()->roleid == 3) { 
                            echo  "<td>-</td></tr>";
                        }else{
                        if($status==1){
                            echo   "<td><a href='" . base_url("products/edit?id=$id") . "' class='btn btn-warning btn-xs' title='Edit'><i class='icon-pencil'></i></a>&nbsp;" . $del . "<label class='checkbox-inline' style='margin-left:30px;'><input type='checkbox'  id='status_$id' checked data-toggle='toggle'  data-size='mini' class='itemactdeact'   data-on='Active' data-off='Inactive'  data-onstyle='success' data-offstyle='danger'></label></td>
                            </tr>";
                        }else{
                            echo   "<td><a href='" . base_url("products/edit?id=$id") . "' class='btn btn-warning btn-xs' title='Edit'><i class='icon-pencil'></i></a>&nbsp;" . $del . "<label class='checkbox-inline' style='margin-left:30px;'><input type='checkbox'  id='status_$id'  data-toggle='toggle'  data-size='mini' class='itemactdeact'   data-on='Active' data-off='Inactive'  data-onstyle='success' data-offstyle='danger'></label></td>
                            </tr>"; 
                        }
                    }

                      
                    $i++;
                    }
                    $totalstock = $instock + $outstock;
                    ?>
                </tbody>

                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Qty') ?></th>
                        <th><?php echo $this->lang->line('SKU Number') ?></th>
                        <th><?php echo $this->lang->line('Category') ?></th>
                        <th><?php echo $this->lang->line('Price') ?></th>
                        <th><?php echo $this->lang->line('Settings') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <input type="hidden" id="dashurl" value="products/prd_stats">
</article>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-toggle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
    var table;

    $(document).ready(function() {
        var instock = "<?php echo $instock; ?>";
        var outstock = "<?php echo $outstock; ?>";
        var totalstock = "<?php echo $totalstock; ?>";
        console.log(instock);
        console.log(outstock);
        console.log(totalstock);
        $("#dash_0").html(instock);
        $("#dash_1").html(outstock);
        $("#dash_2").html(totalstock);
        //datatables
        table = $('#productstable').DataTable({});


        //     "processing": true, //Feature control the processing indicator.
        //     "serverSide": true, //Feature control DataTables' server-side processing mode.
        //     "order": [], //Initial no order.

        //     // Load data for the table's content from an Ajax source
        //     "ajax": {
        //         "url": '<?php //echo base_url("products/item_product_list?id=$id")
                            ?>',
        //         "type": "POST"
        //     },

        //     //Set column definition initialisation properties.
        //     "columnDefs": [
        //         {
        //             "targets": [0], //first column / numbering column
        //             "orderable": false, //set not orderable
        //         },
        //     ],

        // });
        // miniDash();
        var flag=0;
        $(".itemactdeact").change(function() {
            var id= $(this).attr('id');
            var productid=id.split('_');
            flag=0;
            $.ajax({
                type : "POST",
                url  : baseurl+"Products/checkproduct",
                dataType : "JSON",
                data : { id:productid[1],
                        status:1,
                        table_name:'products',
                        },
                success: function(data){

                    if(data[0].status==1 && flag==0){

            if ($('#'+id).prop("checked") == true) {
              
                swal({
            title: "Are you sure to Active This Product ?",
            //text: "Are you sure to Active This Item !!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: false
        },
        function(){	

                $.ajax({
                type : "POST",
                url  : baseurl+"Products/acitiveproduct",
                dataType : "JSON",
                data : { id:productid[1],
                        status:1,
                        table_name:'products',
                        },
                success: function(data){
                   
                if(data == true){
                        swal(" Your Product Success Fully Active");
                       					
                    
                    }
                    else{
                    errorTost("Data Delete Failed");
                    }
    
                }
            });
            return false;
            
        });
            }else{
                
              console.log(productid[1]);
         swal({
            title: "Are you sure to InActive This Product ?",
           // text: "Are you sure to InAcive This Item !!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: false
        },
        function(){	

                $.ajax({
                type : "POST",
                url  : baseurl+"Products/acitiveproduct",
                dataType : "JSON",
                data : { id:productid[1],
                         status:0,
                         table_name:'products',
                        	},
                success: function(data){
                   
                if(data == true){
                        swal("Your Product Success Fully InActive");
                       					
                    
                    }
                    else{
                    errorTost("Data Delete Failed");
                    }
    
                }
            });
            return false;
            
        });
            
        
        }
        $(".cancel").click(function() {
        if(flag==0){
      
          if($("#"+id).is(':checked')) {
             
              $('#'+id).bootstrapToggle('off');
          }else{
              
              $('#'+id).bootstrapToggle('on');
          }
          flag=1;
        }
        
          });
         
    }else{
       
            if(flag==0){
                swal(" Your Product Item Not Active");
        if($("#"+id).is(':checked')) {
             
             $('#'+id).bootstrapToggle('off');
         }else{
             
             $('#'+id).bootstrapToggle('on');
         }
         flag=1;
            }
       
        
    }
    
     }
     });
     
    
});
        
    });
</script>
<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this product') ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="products/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>