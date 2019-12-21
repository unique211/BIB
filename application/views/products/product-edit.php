<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <form method="post" id="data_form" class="form-horizontal">
            <div class="grid_3 grid_4">

                <h3><?php echo $this->lang->line('Edit Product') ?></h3>
                <hr>


                <input type="hidden" name="pid" value="<?php echo $product['pid'] ?>">


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">



                            <label class="col-sm-4 col-form-label" for="Item_name"><?php echo $this->lang->line('Item Name') ?></label>



                            <div class="col-sm-8">
                                <input type="text" placeholder="Item Name" class="form-control margin-bottom" required disabled name="Item_name" id="item_txt" value="<?php echo $item_data->item_name; ?>">
                                <!-- <select class="form-control" id="item_sel" name="item_sel">
                            <option value="0">Select Item</option>
                        </select> -->
                            </div>


                        </div>
                        <div class="form-group row">



                            <label class="col-sm-4 col-form-label" for="product_name"><?php echo $this->lang->line('Product Name') ?></label>



                            <div class="col-sm-8">

                                <input type="text" placeholder="Product Name" class="form-control margin-bottom  required" name="product_name" id="product_name" value="<?php echo $product['product_name'] ?>" />

                            </div>

                        </div>
                        <div class="form-group row">
                            <input type="checkbox" style="margin-left:20px;" name="shows" id="shows" value="1" />Show All products

                        </div>
                        <div class=" form-group row api_pro">
                            <label class="col-sm-4 col-form-label" for="product_name"><?php echo $this->lang->line('Item Name API') ?></label>



                            <div class="col-sm-8">
                                <input type="hidden" value="<?php echo ($product['item_id']); ?>" name="item_id" />
                                <?php //echo ($product['item_id']); 

                                ?>
                                <select name="item" class="form-control" id="items" disabled>
                                    <option value="select_item">Select Item</option>
                                    <?php

                                    foreach ($items['items'] as $key => $value) {
                                        if ($value['id'] == $product['item_id'])
                                            echo "<option value='" . $value['id'] . "' selected>" . $value['name'] . "</option>";
                                        else
                                            echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                    }
                                    ?>

                                </select>

                            </div>

                        </div>
                        <div class="form-group row api_pro">



                            <label class="col-sm-4 col-form-label" for="product_name"><?php echo $this->lang->line('Product Name API') ?></label>



                            <div class="col-sm-8">


                                <select name="products" class="form-control" id="products">
                                    <!-- <option value="select_item">Select Variant</option>-->
                                    <?php
                                    // foreach ($items as $key => $value) {
                                    //     echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                    // }
                                    ?>

                                </select>

                            </div>

                        </div>

                        <div class="form-group row hide_item">



                            <label class="col-sm-4 col-form-label" for="product_cat"><?php echo $this->lang->line('Product Category') ?></label>



                            <div class="col-sm-8">
                                <input type="hidden" name="procat" id="procat" value="" />
                                <select name="product_cat" class="form-control" id="product_cat" disabled>

                                    <?php
                                    echo '<option value="' . $cat_ware['cid'] . '">' . $cat_ware['catt'] . ' (S)</option>';
                                    foreach ($cat as $row) {
                                        $cid = $row['id'];
                                        $title = $row['title'];
                                        echo "<option value='$cid'>$title</option>";
                                    }
                                    ?>

                                </select>





                            </div>

                        </div>



                        <div class="form-group row hide_item">



                            <label class="col-sm-4 col-form-label" for="product_cat"><?php echo $this->lang->line('Warehouse') ?></label>



                            <div class="col-sm-8">
                                <input type="hidden" name="proware" id="proware" value="" />
                                <select name="product_warehouse" id="product_warehouse" class="form-control">

                                    <?php
                                    echo '<option value="' . $cat_ware['wid'] . '">' . $cat_ware['watt'] . ' (S)</option>';
                                    foreach ($warehouse as $row) {
                                        $cid = $row['id'];
                                        $title = $row['title'];
                                        echo "<option value='$cid'>$title</option>";
                                    }
                                    ?>

                                </select>





                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="Product Image">Product Image</label>
                            <div class="col-sm-8">

                                <!-- <label  for="Product Image">Product Image</label> -->



                                <input type="file" disabled class="form-control input-md" id="uploadFile" name="uploadFile" accept="image/*">

                                <input type="hidden" id="file_attachother" name="file_attachother" required>

                                <div id="msg"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <center>
                                    <div id="containerother_kyc">
                                        <img class="img" id='myImage' src="<?php echo base_url() . 'assets/product_img/' . $item_data->pro_image ?>" width=300 height=200 />
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="product_code"><?php echo $this->lang->line('Product Code') ?></label>

                    <div class="col-sm-6">
                        <input type="text" disabled placeholder="Product Code" class="form-control required" name="product_code" value="<?php echo $item_data->product_code ?>">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 control-label" for="product_price"><?php echo $this->lang->line('Product Retail Price') ?></label>

                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo $this->config->item('currency') ?></span>
                            <input type="text" name="product_price" class="form-control required" placeholder="0.00" aria-describedby="sizing-addon" onkeypress="return isNumber(event)" value="<?php echo $product['product_price'] ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Product Wholesale Price') ?></label>

                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo $this->config->item('currency') ?></span>
                            <input type="text" name="fproduct_price" class="form-control " placeholder="0.00" aria-describedby="sizing-addon1" onkeypress="return isNumber(event)" value="<?php echo $product['fproduct_price'] ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Default TAX Rate') ?></label>

                    <div class="col-sm-4">
                        <div class="input-group">

                            <input type="text" disabled name="product_tax" class="form-control" placeholder="0.00" aria-describedby="sizing-addon1" onkeypress="return isNumber(event)" value="<?php echo $item_data->tax_rate ?>"><span class="input-group-addon">%</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <small><?php echo $this->lang->line('Tax rate during') ?></small>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Default Discount Rate') ?></label>

                    <div class="col-sm-4">
                        <div class="input-group">

                            <input type="text" disabled name="product_disc" class="form-control" placeholder="0.00" aria-describedby="sizing-addon1" onkeypress="return isNumber(event)" value="<?php echo $item_data->discount_rate ?>"><span class="input-group-addon">%</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <small><?php echo $this->lang->line('Discount rate during') ?></small>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Stock Units') ?></label>

                    <div class="col-sm-4">
                        <input type="text" placeholder="Total Items in stock" class="form-control margin-bottom required" name="product_qty" onkeypress="return isNumber(event)" value="<?php echo $product['qty'] ?>">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Alert Quantity') ?></label>

                    <div class="col-sm-4">
                        <input type="number" placeholder="Low Stock Alert Quantity" class="form-control margin-bottom required" name="product_qty_alert" value="<?php echo $product['alert'] ?>" onkeypress="return isNumber(event)">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Description') ?></label>

                    <div class="col-sm-8">
                        <textarea placeholder="Description" disabled class="form-control margin-bottom" name="product_desc"><?php echo $item_data->pro_desc ?></textarea>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('product_width') ?></label>

                    <div class="col-sm-4">
                        <input type="text" placeholder="Product width" class="form-control margin-bottom " name="product_width" value="<?php echo $product['product_width'] ?>">
                    </div>
                    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('product_height') ?></label>

                    <div class="col-sm-4">
                        <input type="text" placeholder="Product Height" class="form-control margin-bottom " name="product_hight" value="<?php echo $product['product_height'] ?>">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('product_length') ?></label>

                    <div class="col-sm-4">
                        <input type="text" placeholder="Product Length" class="form-control margin-bottom " name="product_length" value="<?php echo $product['product_lenght'] ?>">
                    </div>
                    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('product_weight') ?></label>

                    <div class="col-sm-4">
                        <input type="text" placeholder="Product Weight" class="form-control margin-bottom " name="product_weight" value="<?php echo $product['product_weight'] ?>">
                    </div>
                </div>


                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="product_color"><?php echo $this->lang->line('Product_color') ?></label>

                    <div class="col-sm-4">
                        <!--  <input id="color" name="product_color" type="color" class="form-control input-md" value="<?php echo $product['color'] ?>">-->
                        <select name="product_color" class="form-control select-box">



                            <?php
                            foreach ($color as $s) {
                                $color = array();

                                $color = explode(",", $product['color']);
                                foreach ($color as $c) {
                                    if ($s->p_color_id == $c)
                                        echo '<option value="' . $s->p_color_id . '" selected>' . $s->name . '</option>';
                                    else
                                        echo '<option value="' . $s->p_color_id . '">' . $s->name . '</option>';
                                }
                            }
                            ?>

                        </select>

                    </div>

                    <label class="col-sm-2 col-form-label" for="product_color"><?php echo $this->lang->line('Quick Pick') ?></label>

                    <div class="col-sm-2">
                        <select name="quick_pick" class="form-control">

                            <option value="1" <?php if ($product['quick_pick'] == '1') {
                                                    echo 'selected';
                                                } ?>>Yes</option>

                            <option value="0" <?php if ($product['quick_pick'] == '0') {
                                                    echo 'selected';
                                                } ?>>No</option>





                        </select>


                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="Product_size"><?php echo $this->lang->line('Product_size') ?></label>

                    <div class="col-sm-4">

                        <select name="Product_size" class="form-control select-box">

                            <?php
                            foreach ($size as $s) {
                                $sizearray = array();

                                $sizearray = explode(",", $product['product_size']);
                                foreach ($sizearray as $c) {
                                    if ($s->p_size_id == $c)
                                        echo '<option value="' . $s->p_size_id . '" selected>' . $s->name . '</option>';
                                    else
                                        echo '<option value="' . $s->p_size_id . '">' . $s->name . '</option>';
                                }
                            }
                            ?>
                        </select>


                    </div>

                    <label class="col-sm-2 col-form-label" for="Product_Material"><?php echo $this->lang->line('pmaterial') ?></label>

                    <div class="col-sm-4">

                        <select name="Product_material" class="form-control select-box">



                            <?php
                            foreach ($material as $s) {
                                $materialarray = array();

                                $materialarray = explode(",", $product['product_material']);
                                foreach ($materialarray as $c) {
                                    if ($s->p_material_id == $c)
                                        echo '<option value="' . $s->p_material_id . '" selected>' . $s->name . '</option>';
                                    else
                                        echo '<option value="' . $s->p_material_id . '">' . $s->name . '</option>';
                                }
                            }
                            ?>

                        </select>





                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="Product_size"><?php echo $this->lang->line('SKU Number') ?></label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="SKU Number" class="form-control margin-bottom required" name="product_sku" value="<?php echo $product['SKU_number'] ?>">
                    </div>
                    <label class="col-sm-2 col-form-label" for="Product_size"><?php echo $this->lang->line('UPC Barcode') ?></label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="UPC Barcode" class="form-control margin-bottom" readonly  value="<?php echo $product['UPC_barcode'] ?>">
                        <input type="hidden"  name="product_barcode" value="<?php echo $product['UPC_barcode'] ?>">
                    </div>

                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="Product_size"><?php echo $this->lang->line('Package Quantity') ?></label>
                    <div class="col-sm-4">
                        <input type="number" placeholder="Package Quantity in Box" class="form-control margin-bottom required" name="package_qty" value="<?php echo $product['Package_quanity_in_bx'] ?>">
                    </div>
                    <label class="col-sm-2 col-form-label" for="Product_size"><?php echo $this->lang->line('Product Barcode') ?></label>
                    <div class="col-sm-4">
                    <img class="img"  src="<?php echo base_url() . 'assets/product_barcode/' . $product['barcode_img']; ?>" width=300 height=50 />
                    </div>




                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom" value="<?php echo $this->lang->line('Update') ?>" data-loading-text="Updating...">
                        <input type="hidden" value="products/editproduct" id="action-url">
                    </div>
                </div>

            </div>
        </form>
    </div>
</article>
<!--fileupload Files -->

<script src="<?php echo base_url() . 'assets/js/AjaxFileUpload.js' ?>"></script>
<script>
    $('.select-box').select2();
    // Image upload Arzoo 
    $('#uploadFile').ajaxfileupload({

        'action': baseurl + 'Products/doc_image_upload',

        'onStart': function() {
            $("#msg").html("<font color='red'><i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>Please wait file is uploading.....</font>");
        },

        'onComplete': function(response) {
            console.log(response);
            if (response == '') {

                $("#msg").html("<font color='red'>" + "Error in file upload" + "</font>");

            } else {
                response = response.split("   ");

                console.log(response[1]);

                $("#file_attachother").val($.trim(response[1]));

                $("#msg").html("<font id='doc_image_name1' color='green'>" + response[1] + "</font>");

                // $("#image_name").val(response);

                $('#containerother_kyc').empty();

                //   var url = getRootUrl();

                var img = $('<img />').addClass('img').attr({

                    'id': 'myImage',

                    'src': baseurl + 'assets/product_img/' + $.trim(response[1]),

                    'width': 300,

                    'height': 200,

                }).appendTo('#containerother_kyc');

            }

        }

    });
    //to change the produt list from API
    $("#items").change(function() {
        var v = $(this).val();
        // var t = $(this).text();
        // alert(t);
        product_list(v, '');


    });

    var arr = new Array();

    function product_list(v, vari) {
        var hd = false;
        if ($('#shows').prop("checked") == true){
            hd = true;
        } else if ($('#shows').prop("checked") == false) {
            hd = false;
        }
        var data = <?php echo json_encode($items['items_var']); ?>;

        $html = '<option value="0">Select Variant</option>';
        $.each(data, function(key, value) {
            if (key == v) {

                var objArray = value;
                $.each(objArray, function(key, value) {

                    if (value.id == vari)
                        $html += '<option value="' + value.id + '" selected>' + value.name + '</option>';
                    else if (value.status == "assigned") {
                        arr.push(value.id);
                        $html += '<option value="' + value.id + '" class="hidden_items" style="background-color:#830040;color:#ffffff;display:none">' + value.name + '</option>';
                    } else if (value.status == "new")
                        $html += '<option value="' + value.id + '">' + value.name + '</option>';
                });
            }

        });


        $("#products").html($html);
    }
    $("#products").change(function() {
        var p = $(this).val();
        if (arr.includes(p)) {
            alert('Products assigned');
            return;
        }
    });
    var v = "<?php echo $product['item_id']; ?>";
    var vari = "<?php echo $product['variant_id']; ?>";
    product_list(v, vari);
    $('#shows').change(function() {
        if ($(this).prop("checked") == true) {
           $(".hidden_items").css('display','');
        } else if ($(this).prop("checked") == false) {
            $(".hidden_items").css('display','none');
        }
    });
</script>