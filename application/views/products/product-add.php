<article class="content">

    <div class="card card-block">

        <div id="notify" class="alert alert-success" style="display:none;">

            <a href="#" class="close" data-dismiss="alert">&times;</a>



            <div class="message"></div>

        </div>

        <form method="post" id="data_form" class="form-horizontal">

            <div class="grid_3 grid_4">

                <h3><?php echo $this->lang->line('Add New Product') ?></h3>

                <hr>





                <input type="hidden" name="act" value="add_product">




                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="radio" style="margin-left:20px;" name="selection" value="frm_list" checked>From Square list</input>
                        <input type="radio" style="margin-left:20px;" name="selection" value="new">Create New Item</input>
                        <input type="radio" style="margin-left:20px;" name="selection" value="newv">Create New Variant</input>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">



                        <label class="col-sm-4 col-form-label" for="Item_name"><?php echo $this->lang->line('Item Name') ?></label>



                        <div class="col-sm-8">

                            <input type="text" placeholder="Item Name" class="form-control margin-bottom  required" name="Item_name" id="item_txt">
                            <select class="form-control" id="item_sel" name="item_sel">
                                <option value="0">Select Item</option>
                            </select>
                        </div>


                    </div>
                    <div class="form-group row">



                        <label class="col-sm-4 col-form-label" for="product_name"><?php echo $this->lang->line('Product Name') ?></label>



                        <div class="col-sm-8">

                            <input type="text" placeholder="Product Name" class="form-control margin-bottom  required" name="product_name" id="product_name">

                        </div>

                    </div>
                    <div class="form-group row api_pro">
                        <input type="checkbox" style="margin-left:20px;" name="shows" id="shows" value="1" />Show All products

                    </div>

                    <div class="form-group row api_pro">



                        <label class="col-sm-4 col-form-label" for="product_name"><?php echo $this->lang->line('Item Name API') ?></label>



                        <div class="col-sm-8">

                            <?php
                            $item_arry = array();
                            //print_r($items); 
                            //print_r($items['items'][0]['status']); 
                            ?>
                            <select name="item" class="form-control" id="items">
                                <option value="select_item">Select Item</option>
                                <?php
                                foreach ($items['items'] as $key => $value) {
                                    if ($value['status'] == 'mod')
                                        echo "<option value='" . $value['id'] . "' class='hidden_items' style='background-color:#839851;color:#ffffff;'>" . $value['name'] . "</option>";
                                    else if ($value['status'] == 'assigned'){
                                        echo "<option value='" . $value['id'] . "' class='hidden_items' style='background-color:#830040;color:#ffffff;display:none'>" . $value['name'] . "</option>";
                                        array_push($item_arry,$value['id']);
                                    }                                        
                                    else
                                        echo "<option value='" . $value['id'] . "' >" . $value['name'] . "</option>";
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
                            <select name="product_cat" class="form-control" id="product_cat">

                                <?php

                                foreach ($cat as $row) {

                                    $cid = $row['id'];

                                    $title = $row['title'];

                                    echo "<option value='$cid'>$title</option>";
                                }

                                ?>

                            </select>





                        </div>

                    </div>



                    <div class="form-group row">



                        <label class="col-sm-4 col-form-label" for="product_cat"><?php echo $this->lang->line('Warehouse') ?></label>



                        <div class="col-sm-8">
                            <input type="hidden" name="proware" id="proware" value="" />
                            <select name="product_warehouse" id="product_warehouse" class="form-control">

                                <?php

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



                            <input type="file" class="form-control input-md" id="uploadFile" name="uploadFile" accept="image/*">

                            <input type="hidden" id="file_attachother" name="file_attachother" required>

                            <div id="msg"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <center>
                                <div id="containerother_kyc">

                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row hide_item">



                <label class="col-sm-2 col-form-label" for="product_code"><?php echo $this->lang->line('Product Code') ?></label>



                <div class="col-sm-4">
                    <input type="hidden" name="procode" id="procode" value="" />
                    <input type="text" placeholder="Product Code" class="form-control required" name="product_code" id="product_code">

                </div>

            </div>

            <div class="form-group row">



                <label class="col-sm-2 control-label" for="product_price"><?php echo $this->lang->line('Product Retail Price') ?></label>



                <div class="col-sm-4">

                    <div class="input-group">

                        <span class="input-group-addon"><?php echo $this->config->item('currency') ?></span>

                        <input type="text" name="product_price" class="form-control required" placeholder="0.00" aria-describedby="sizing-addon" onkeypress="return isNumber(event)">

                    </div>

                </div>

            </div>

            <div class="form-group row">



                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Product Wholesale Price') ?></label>



                <div class="col-sm-4">

                    <div class="input-group">

                        <span class="input-group-addon"><?php echo $this->config->item('currency') ?></span>

                        <input type="text" name="fproduct_price" class="form-control " placeholder="0.00" aria-describedby="sizing-addon1" onkeypress="return isNumber(event)">

                    </div>

                </div>

            </div>

            <div class="form-group row hide_item">



                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Default TAX Rate') ?></label>



                <div class="col-sm-4">

                    <div class="input-group">


                        <input type="hidden" name="protax" id="protax" value="" />
                        <input type="text" name="product_tax" id="product_tax" class="form-control " placeholder="0.00" aria-describedby="sizing-addon1" onkeypress="return isNumber(event)"><span class="input-group-addon">%</span>

                    </div>

                </div>

                <div class="col-sm-4">

                    <small><?php echo $this->lang->line('Tax rate during') ?></small>

                </div>

            </div>

            <div class="form-group row hide_item">



                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Default Discount Rate') ?></label>



                <div class="col-sm-4">

                    <div class="input-group">


                        <input type="hidden" name="prodisc" id="prodisc" value="" />
                        <input type="text" name="product_disc" id="product_disc" class="form-control " placeholder="0.00" aria-describedby="sizing-addon1" onkeypress="return isNumber(event)"><span class="input-group-addon">%</span>

                    </div>

                </div>

                <div class="col-sm-4">

                    <small><?php echo $this->lang->line('Discount rate during') ?></small>

                </div>

            </div>

            <div class="form-group row">



                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Stock Units') ?></label>



                <div class="col-sm-4">

                    <input type="number" placeholder="Total Items in stock" class="form-control margin-bottom required" name="product_qty" onkeypress="return isNumber(event)">

                </div>

            </div>

            <div class="form-group row">



                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Alert Quantity') ?></label>



                <div class="col-sm-4">

                    <input type="number" placeholder="Low Stock Alert Quantity" class="form-control margin-bottom required" name="product_qty_alert" onkeypress="return isNumber(event)">

                </div>

            </div>

            <div class="form-group row hide_item">



                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Description') ?></label>



                <div class="col-sm-10">
                    <input type="hidden" name="prodesc" id="prodesc" value="" />
                    <textarea placeholder="Description" class="form-control margin-bottom" name="product_desc" id="product_desc"></textarea>

                </div>

            </div>

            <div class="form-group row">



                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('product_width') ?></label>



                <div class="col-sm-4">

                    <input type="text" placeholder="Product width" class="form-control margin-bottom" name="product_width">

                </div>

                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('product_height') ?></label>



                <div class="col-sm-4">

                    <input type="text" placeholder="Product Height" class="form-control margin-bottom" name="product_hight">

                </div>

            </div>

            <div class="form-group row">



                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('product_length') ?></label>



                <div class="col-sm-4">

                    <input type="text" placeholder="Product Length" class="form-control margin-bottom" name="product_length">

                </div>

                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('product_weight') ?></label>



                <div class="col-sm-4">

                    <input type="text" placeholder="Product Weight" class="form-control margin-bottom" name="product_weight">

                </div>

            </div>





            <div class="form-group row">



                <label class="col-sm-2 control-label" for="edate"><?php echo $this->lang->line('color') ?></label>



                <div class="col-sm-4">

                    <!-- <input id="color" name="product_color" type="color" class="form-control input-md" value="#FE7555"> -->
                    <div id="s_color">
                        <select name="product_color_s" class="form-control select-box" id="product_color_S">

                            <!-- <option>------Select Color------</option> -->

                            <?php
                            foreach ($color as $s) {
                                echo '<option value="' . $s->p_color_id . '">' . $s->name . '</option>';
                            }
                            ?>

                        </select>
                    </div>
                    <div id="m_color">
                        <select name="product_color[]" class="form-control select-box" multiple="multiple" id="product_color">

                            <!-- <option>------Select Color------</option> -->

                            <?php
                            foreach ($color as $s) {
                                echo '<option value="' . $s->p_color_id . '">' . $s->name . '</option>';
                            }
                            ?>

                        </select>
                    </div>

                </div>

                <label class="col-sm-2 col-form-label" for="product_color"><?php echo $this->lang->line('Quick Pick') ?></label>



                <div class="col-sm-2">

                    <select name="quick_pick" class="form-control">

                        <option value="1">Yes</option>

                        <option value="0">No</option>
                    </select>
                </div>





            </div>

            <div class="form-group row">



                <label class="col-sm-2 col-form-label" for="Product_size"><?php echo $this->lang->line('Product_size') ?></label>



                <div class="col-sm-4">

                    <div id="m_size">
                        <select name="Product_size[]" id="Product_size" class="form-control select-box" multiple="multiple">

                            <!-- <option>------Select Size------</option> -->

                            <?php
                            foreach ($size as $s) {
                                echo '<option value="' . $s->p_size_id . '">' . $s->name . '</option>';
                            }
                            ?>

                        </select>
                    </div>
                    <div id="s_size">
                        <select name="Product_size_s" id="Product_size_s" class="form-control select-box">

                            <!-- <option>------Select Size------</option> -->

                            <?php
                            foreach ($size as $s) {
                                echo '<option value="' . $s->p_size_id . '">' . $s->name . '</option>';
                            }
                            ?>

                        </select>
                    </div>






                </div>

                <label class="col-sm-2 col-form-label" for="Product_Material"><?php echo $this->lang->line('pmaterial') ?></label>

                <div class="col-sm-4">

                    <div id="s_material">
                        <select name="Product_material_s" id="Product_material_s" class="form-control select-box">

                            <!-- <option>------Select Material------</option> -->

                            <?php
                            foreach ($material as $s) {
                                echo '<option value="' . $s->p_material_id . '">' . $s->name . '</option>';
                            }
                            ?>

                        </select>
                    </div>
                    <div id="m_material">
                        <select name="Product_material[]" id="Product_material" class="form-control select-box" multiple="multiple">

                            <!-- <option>------Select Material------</option> -->

                            <?php
                            foreach ($material as $s) {
                                echo '<option value="' . $s->p_material_id . '">' . $s->name . '</option>';
                            }
                            ?>

                        </select>
                    </div>





                </div>





            </div>

            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="Product_size"><?php echo $this->lang->line('SKU Number') ?></label>

                <div class="col-sm-4">

                    <input type="text" placeholder="SKU Number" class="form-control margin-bottom " id="product_sku" name="product_sku">

                </div>
                <label class="col-sm-2 col-form-label" for="Product_size"><?php echo $this->lang->line('UPC Barcode') ?></label>

                <div class="col-sm-4">

                    <input type="text" placeholder="UPC Barcode" class="form-control margin-bottom " name="product_barcode" id="product_barcode">

                </div>



            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="Product_size"><?php echo $this->lang->line('Package Quantity') ?></label>

                <div class="col-sm-4">

                    <input type="number" placeholder="Package Quantity in Box" class="form-control margin-bottom" name="package_qty">

                </div>





            </div>

            <div class="form-group row">



                <label class="col-sm-2 col-form-label"></label>



                <div class="col-sm-4">

                    <input type="submit" id="submit-data" class="btn btn-success margin-bottom" value="<?php echo $this->lang->line('Add product') ?>" data-loading-text="Adding...">

                    <input type="hidden" value="products/addproduct" id="action-url">

                </div>

            </div>


    </div>



    </form>

    </div>

</article>
<!--fileupload Files -->

<script src="<?php echo base_url() . 'assets/js/AjaxFileUpload.js' ?>"></script>

<script>
    //var baseurl=<?php echo base_url(); ?>;
    //alert(baseurl);
    $('.select-box').select2();

    $('input[type=radio][name=selection]').change(function() {
        if (this.value == 'new') {
            $(".api_pro").css('display', "none");
            $("#item_txt").css('display', "");
            $("#item_sel").css('display', "none");
            // $(".hide_item").css('display', "");
            $("#product_cat").prop("disabled", false);
            $("#product_warehouse").prop("disabled", false);
            $("#product_code").prop("disabled", false);
            $("#product_tax").prop("disabled", false);
            $("#product_disc").prop("disabled", false);
            $("#product_desc").prop("disabled", false);
            $("#product_color").css('display', "");
            $("#Product_material").css('display', "");
            $("#Product_size").css('display', "");
            $("#s_material").css('display', "none");
            $("#s_color").css('display', "none");
            $("#s_size").css('display', "none");
            $("#m_size").css('display', "");
            $("#m_color").css('display', "");
            $("#m_material").css('display', "");
        } else if (this.value == 'newv') {
            $(".api_pro").css('display', "none");
            $("#item_txt").css('display', "none");
            $("#item_sel").css('display', "");
            var html = '<option value="0">Select Item</option>';
            $.ajax({

                type: "POST",

                url: baseurl + "products/getItemList",
                dataType: "JSON",

                async: false,

                success: function(data) {
                    console.log(data);
                    $.each(data, function(key, value) {
                        html += '<option value="' + value.item_id + '">' + value.item_name + '</option>';
                    });
                    $("#item_sel").html(html);
                }
            });
            $("#product_cat").prop("disabled", true);
            $("#product_warehouse").prop("disabled", false);
            $("#product_code").prop("disabled", true);
            $("#product_tax").prop("disabled", true);
            $("#product_disc").prop("disabled", true);
            $("#product_desc").prop("disabled", true);
            $("#product_color").css('display', "");
            $("#Product_material").css('display', "");
            $("#Product_size").css('display', "");
            $("#s_material").css('display', "none");
            $("#s_color").css('display', "none");
            $("#s_size").css('display', "none");
            $("#m_size").css('display', "");
            $("#m_color").css('display', "");
            $("#m_material").css('display', "");

            // $(".hide_item").css('display', "none");
        } else {
            $(".api_pro").css('display', "");
            $("#item_txt").css('display', "");
            $("#item_sel").css('display', "none");
            // $(".hide_item").css('display', "");
            $("#product_cat").prop("disabled", false);
            $("#product_warehouse").prop("disabled", false);
            $("#product_code").prop("disabled", false);
            $("#product_tax").prop("disabled", false);
            $("#product_disc").prop("disabled", false);
            $("#product_desc").prop("disabled", false);
            $("#product_color").css('display', "none");
            $("#Product_material").css('display', "none");
            $("#Product_size").css('display', "none");
            $("#s_material").css('display', "");
            $("#s_color").css('display', "");
            $("#s_size").css('display', "");
            $("#m_size").css('display', "none");
            $("#m_color").css('display', "none");
            $("#m_material").css('display', "none");
        }

    });
    $(".api_pro").css('display', "");
    $("#item_txt").css('display', "");
    $("#item_sel").css('display', "none");
    $("#product_cat").prop("disabled", false);
    $("#product_warehouse").prop("disabled", false);
    $("#product_code").prop("disabled", false);
    $("#product_tax").prop("disabled", false);
    $("#product_disc").prop("disabled", false);
    $("#product_desc").prop("disabled", false);
    $("#product_color").css('display', "none");
    $("#Product_material").css('display', "none");
    $("#Product_size").css('display', "none");
    $("#s_material").css('display', "");
    $("#s_color").css('display', "");
    $("#s_size").css('display', "");
    $("#m_size").css('display', "none");
    $("#m_color").css('display', "none");
    $("#m_material").css('display', "none");

    //$(".hide_item").css('display', "");
    $("#items").change(function() {
        var v = $(this).val();
        // var t = $(this).text();
        // alert(t);
        var data = <?php echo json_encode($items['items_var']); ?>;
        console.log(data);
        var item_aary = <?php echo json_encode($item_arry);?>;

        //     $.each(myObjects, function () {
        //     console.log("ID: " + this);
        //     // console.log("First Name: " + this.firstname);
        //     // console.log("Last Name: " + this.lastname);
        //     console.log(" ");
        // });
        console.log(item_aary);
        console.log(v);
        if(item_aary.includes(v)){
            alert('All Products assigned');
            return;
        }
        $html = '<option value="0">Select Variant</option>';
        $.each(data, function(key, value) {
            if (key == v) {
                console.log(key + ": " + value);
                var objArray = value;
                $.each(objArray, function(key, value) {
                    console.log(key + " " + value.id + " " + value.name);
                    if (value.status == 'assigned')
                        $html += '<option value="' + value.id + '" style="background-color:#830040;color:#ffffff">' + value.name + '</option>';
                    else
                        $html += '<option value="' + value.id + '">' + value.name + '</option>';
                });
            }

        });
        // $("#items option:selected").text();
        $('#item_txt').val($("#items option:selected").text());
        $("#products").html($html);


    });
    $('#products').change(function() {

        $('#product_name').val($("#products option:selected").text());
    });

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
    $("#item_sel").change(function() {
        var itm_id = $(this).val();
        console.log(itm_id);
        $('#item_txt').val($("#item_sel option:selected").text());
        $.ajax({

            type: "POST",

            url: baseurl + "products/getDataForItem",

            data: {

                item_id: itm_id
            },

            dataType: "JSON",

            async: false,

            success: function(data) {
                console.log(data);
                $('#product_cat').val(data[0]['product_category']).trigger('change');
                $('#procat').val(data[0]['product_category']);

               // $('#product_warehouse').val(data[0]['warehouse']).trigger('change');
               // $('#proware').val(data[0]['warehouse']);
                $('#product_code').val(data[0]['product_code']);
                $('#procode').val(data[0]['product_code']);
                $('#product_tax').val(data[0]['tax_rate']);
                $('#protax').val(data[0]['tax_rate']);
                $('#product_disc').val(data[0]['discount_rate']);
                $('#prodisc').val(data[0]['discount_rate']);
                $('#product_desc').html(data[0]['pro_desc']);
                $('#prodesc').val(data[0]['pro_desc']);
                $("#product_cat").prop("disabled", true);
                // $("#product_cat").prop("readonly", readonly);
                $("#product_warehouse").prop("disabled", false);
                $("#product_code").prop("disabled", true);
                $("#product_tax").prop("disabled", true);
                $("#product_disc").prop("disabled", true);
                $("#product_desc").prop("disabled", true);
                console.log($('#product_cat').val());
            }
        });

    });
    $("#product_color").change(function() {
        sku();
    });
    $("#Product_material").change(function() {
        sku();
    });
    $("#Product_size").change(function() {
        sku();
    });

    function sku() {
        var c = $("#product_color").val();
        var m = $("#Product_material").val();
        var s = $("#Product_size").val();
        if (c == null) {
            c = [];
        }
        if (m == null) {
            m = [];
        }
        if (s == null) {
            s = [];
        }
        console.log(c);
        console.log(m);
        console.log(s);
        if (s.length > 1 || c.length > 1 || m.length > 1) {
            var n = "<?php echo $this->lang->line('Generate product') ?>";
            $('#submit-data').val(n);
            $("#product_barcode").prop("disabled", true);
            $("#product_sku").prop("disabled", true);
            $("#product_barcode").removeAttr("required");
            $("#product_sku").removeAttr("required");
        } else {
            var n = "<?php echo $this->lang->line('Add product') ?>";
            $('#submit-data').val(n);
            $("#product_barcode").prop("disabled", false);
            $("#product_barcode").attr("required", true);
            $("#product_sku").attr("required", true);
            $("#product_sku").prop("disabled", false);
        }
    }
    $('#shows').change(function() {
        if ($(this).prop("checked") == true) {
           $(".hidden_items").css('display','');
        } else if ($(this).prop("checked") == false) {
            $(".hidden_items").css('display','none');
        }
    });
</script>