<article class="content">
<link href="<?php echo base_url(); ?>assets/css/bootstrap-toggle.min.css" rel="stylesheet">
 <!--Sweetalert -->
 <link href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css" rel="stylesheet">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4 animated fadeInRight">
            <h3><?php echo $this->lang->line('Items') ?></h3>
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
        <?php //print_r($items);

        // foreach ($items as $row) {
        //     print_r($row->item_name);
        // }
        ?>
        <div class="table-responsive">
            <table id="itemstable" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Qty') ?></th>
                        <th><?php echo $this->lang->line('Code') ?></th>
                        <th><?php echo $this->lang->line('Category') ?></th>
                        <th><?php echo $this->lang->line('Settings') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $instock = 0;
                    $outstock = 0;
                    $totalstock = 0;
                    $i = 1;
                    foreach ($items as $row) {
                        $name = $row->item_name;
                        $qty = isset($row->qty) ? $row->qty : 0;
                        $id = $row->item_id;
                        $code = $row->product_code;
                        $cat = $row->cat;
                        $cnt =  $row->cnt;
                        $status=$row->status;
                        if ($qty == 0)
                            $outstock++;
                        else {
                            $instock++;
                        }
                        $del = '';
                        //if ($cnt == 0) {
                            $del = "<a data-object-id='" . $id . "' class='btn btn-danger btn-xs delete-object' title='Delete' href='" . base_url("products/delete_item?id=$id") . "'><i class='icon-trash-o'></i></a>";
                        //}
                        echo "<tr>
                    <td>$i</td>
                    <td>$name</td>
                    <td>$qty</td>
                    <td>$code</td>
                    <td>$cat</td>";
                    if($status==1){
                        echo  "<td> <a href='" . base_url("products/viewproducts?id=$id") . "'  title='View Products' class='btn btn-primary btn-xs'><i class='icon-eye'></i></a>&nbsp;<a href='" . base_url("products/edititem?id=$id") . "' class='btn btn-warning btn-xs' title='Edit'><i class='icon-pencil'></i></a>&nbsp;" . $del . " <label class='checkbox-inline' style='margin-left:30px;'><input type='checkbox'  id='status_$id' checked='true' data-toggle='toggle'  data-size='mini' class='itemactdeact'   data-on='Active' data-off='Inactive'  data-onstyle='success' data-offstyle='danger'></label></td></tr>";
                    }else{
                        echo  "<td> <a href='" . base_url("products/viewproducts?id=$id") . "'  title='View Products' class='btn btn-primary btn-xs'><i class='icon-eye'></i></a>&nbsp;<a href='" . base_url("products/edititem?id=$id") . "' class='btn btn-warning btn-xs' title='Edit'><i class='icon-pencil'></i></a>&nbsp;" . $del . " <label class='checkbox-inline' style='margin-left:30px;'><input type='checkbox'  id='status_$id'  data-toggle='toggle'  data-size='mini' class='itemactdeact'   data-on='Active' data-off='Inactive'  data-onstyle='success' data-offstyle='danger'></label></td></tr>";
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
                        <th><?php echo $this->lang->line('Code') ?></th>
                        <th><?php echo $this->lang->line('Category') ?></th>
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
        $("#dash_0").html(instock);
        $("#dash_1").html(outstock);
        $("#dash_2").html(totalstock);
        //datatables
       var table= $('#itemstable').DataTable({
        // "processing": true,
        // "serverSide": true,
            'columnDefs': [ { 
       'searchable'    : false, 
       'targets'       : [0,2,5] 
    },{
                'targets': [0,5], /* column index */
                'orderable': false, /* true or false */
            }]
        });

        $(".itemactdeact").change(function() {
            var id= $(this).attr('id');
            var itemid=id.split('_');
           
            $('#status_'+itemid).bootstrapToggle('on');
            if ($(this).prop("checked") == true) {
                swal({
            title: "Are you sure to Active This Item ?",
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
                url  : baseurl+"Products/aciteitem",
                dataType : "JSON",
                data : { id:itemid[1],
                        status:1,
                        table_name:'item_details',
                        },
                success: function(data){
                   
                if(data == true){
                        swal(" Your Item Success Fully Active");
                       					
                    
                    }
                    else{
                    errorTost("Data Delete Failed");
                    }
    
                }
            });
            return false;
            
        });
        
      
            }else{
               
         swal({
            title: "Are you sure to InActive This Item ?",
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
                url  : baseurl+"Products/aciteitem",
                dataType : "JSON",
                data : { id:itemid[1],
                         status:0,
                         table_name:'item_details',
                        	},
                success: function(data){
                   
                if(data == true){
                        swal("Your Item Success Fully InActive");
                       					
                    
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
          
     
    if($("#"+id).is(':checked')) {
       
        $('#'+id).bootstrapToggle('off');
    }else{
        
        $('#'+id).bootstrapToggle('on');
    }
   
  
    });
});
       
        // $('#search-input').on('change', function(){

        //     table
        //     .column(1)
        //     .search(this.value)
        //     .draw();

        //     });

        //     "processing": true, //Feature control the processing indicator.
        //     "serverSide": true, //Feature control DataTables' server-side processing mode.
        //     "order": [], //Initial no order.

        //     // Load data for the table's content from an Ajax source
        //     "ajax": {
        //         "url": "<?php //echo site_url('index.php/products/product_list')
                            ?>",
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
                <input type="hidden" id="action-url" value="products/delete_item">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>