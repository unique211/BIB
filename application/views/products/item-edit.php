<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <form method="post" id="data_form" class="form-horizontal">
            <div class="grid_3 grid_4">

                <h3><?php echo $this->lang->line('Edit Item') ?></h3>
                <hr>


                <input type="hidden" name="item_id" value="<?php echo $item_data->item_id ?>">


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="Item_name"><?php echo $this->lang->line('Item Name') ?></label>
                            <div class="col-sm-8">
                                <input type="text" placeholder="Item Name" class="form-control margin-bottom  required" name="Item_name" id="item_txt" value="<?php echo $item_data->item_name; ?>">
                            </div>
                        </div>

                        <div class=" form-group row api_pro">
                            <label class="col-sm-4 col-form-label" for="product_name"><?php echo $this->lang->line('Item Name API') ?></label>

                            <div class="col-sm-8">

                                <?php //print_r ($items);
                                  $item_arry = array();
                                ?>
                                <select name="item" class="form-control" id="items">
                                    <option value="select_item">Select Item</option>
                                    <?php
                                    foreach ($items as $key => $value) {
                                        if ($value['id'] == $item_data->item_api_id)
                                            echo "<option value='" . $value['id'] . "' selected>" . $value['name'] . "</option>";
                                        else if ($value['status'] == 'assigned'){
                                            array_push($item_arry,$value['id']);
                                            echo "<option value='" . $value['id'] . "' class='hidden_items' style='background-color:#830040;color:#ffffff'>" . $value['name'] . "</option>";
                                         } else
                                            echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>


                        <div class="form-group row hide_item">
                            <label class="col-sm-4 col-form-label" for="product_cat"><?php echo $this->lang->line('Product Category') ?></label>
                            <div class="col-sm-8">
                                <input type="hidden" name="procat" id="procat" value="" />
                                <select name="product_cat" class="form-control" id="product_cat">
                                    <?php
                                    foreach ($cat as $row) {
                                        $cid = $row['id'];
                                        $title = $row['title'];
                                        if ($cid == $item_data->product_category)
                                            echo "<option value='$cid' selected>$title</option>";
                                        else
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
                                    foreach ($warehouse as $row) {
                                        $cid = $row['id'];
                                        $title = $row['title'];
                                        if ($cid == $item_data->warehouse)
                                            echo "<option value='$cid' selected>$title</option>";
                                        else
                                            echo "<option value='$cid'>$title</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-4 col-form-label" for="product_code"><?php echo $this->lang->line('Product Code') ?></label>

                            <div class="col-sm-8">
                                <input type="text" placeholder="Product Code" class="form-control required" name="product_code" value="<?php echo $item_data->product_code ?>">
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="Product Image">Product Image</label>
                            <div class="col-sm-8">

                                <!-- <label  for="Product Image">Product Image</label> -->



                                <input type="file" class="form-control input-md" id="uploadFile" name="uploadFile" accept="image/*">

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

                    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Default TAX Rate') ?></label>

                    <div class="col-sm-4">
                        <div class="input-group">

                            <input type="text" name="product_tax" class="form-control required" placeholder="0.00" aria-describedby="sizing-addon1" onkeypress="return isNumber(event)" value="<?php echo $item_data->tax_rate ?>"><span class="input-group-addon">%</span>
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

                            <input type="text" name="product_disc" class="form-control required" placeholder="0.00" aria-describedby="sizing-addon1" onkeypress="return isNumber(event)" value="<?php echo $item_data->discount_rate ?>"><span class="input-group-addon">%</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <small><?php echo $this->lang->line('Discount rate during') ?></small>
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Description') ?></label>

                    <div class="col-sm-8">
                        <textarea placeholder="Description" class="form-control margin-bottom" name="product_desc"><?php echo $item_data->pro_desc ?></textarea>
                    </div>
                </div>




                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom" value="<?php echo $this->lang->line('Update') ?>" data-loading-text="Updating...">
                        <input type="hidden" value="products/edititemdb" id="action-url">
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
    // //to change the produt list from API
    $("#items").change(function() {
        var v = $(this).val();
        var item_aary = <?php echo json_encode($item_arry);?>;
        console.log(item_aary);
        console.log(v);
        if(item_aary.includes(v)){
            alert('All Products assigned');
            return;
        }


    });


    // function product_list(v, vari) {

    //     var data = <?php echo json_encode($items['items_var']); ?>;

    //     $html = '<option value="0">Select Variant</option>';
    //     $.each(data, function(key, value) {
    //         if (key == v) {

    //             var objArray = value;
    //             $.each(objArray, function(key, value) {

    //                 if (value.id == vari)
    //                     $html += '<option value="' + value.id + '" selected>' + value.name + '</option>';
    //                 else
    //                     $html += '<option value="' + value.id + '">' + value.name + '</option>';
    //             });
    //         }

    //     });


    //     $("#products").html($html);
    // }
    // var v = "<?php echo $product['item_id']; ?>";
    // var vari = "<?php echo $product['variant_id']; ?>";
    // product_list(v, vari);
</script>