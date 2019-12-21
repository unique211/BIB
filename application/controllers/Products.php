<?php

/**

 * Neo Billing -  Accounting,  Invoicing  and CRM Software

 * Copyright (c) Rajesh Dukiya. All Rights Reserved

 * ***********************************************************************

 *

 *  Email: support@ultimatekode.com

 *  Website: https://www.ultimatekode.com

 *

 *  ************************************************************************

 *  * This software is furnished under a license and may be used and copied

 *  * only  in  accordance  with  the  terms  of such  license and with the

 *  * inclusion of the above copyright notice.

 *  * If you Purchased from Codecanyon, Please read the full License from

 *  * here- http://codecanyon.net/licenses/standard/

 * ***********************************************************************

 */



defined('BASEPATH') or exit('No direct script access allowed');



class Products extends CI_Controller

{

    public function __construct()

    {
        parent::__construct();

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $this->load->library("Aauth");

        $this->load->model('products_model', 'products');

        $this->load->model('categories_model', 'categories');



        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');
        }

        if ($this->aauth->get_user()->roleid != 1 and $this->aauth->get_user()->roleid < 3) {



            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
    }



    public function index()

    {

        // $head['title'] = "Products";
        $head['title'] = "Items";

        $head['usernm'] = $this->aauth->get_user()->username;
        $data['items'] = $this->products->getItemDetails();
        $this->load->view('fixed/header', $head);

        $this->load->view('products/items', $data);
        // $this->load->view('products/products');

        $this->load->view('fixed/footer');
        // echo json_encode($data);
    }



    public function cat()

    {

        $head['title'] = "Product Categories";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/cat_productlist');

        $this->load->view('fixed/footer');
    }





    public function add()
    {

        $data['cat'] = $this->categories->category_list();

        $data['warehouse'] = $this->categories->warehouselistwithouttl();

        $head['title'] = "Add Product";

        $head['usernm'] = $this->aauth->get_user()->username;
        $data['items'] = $this->getItemFromApi();
        $data['size'] = $this->products->getProductSize();
        $data['material'] = $this->products->getProductMaterial();
        $data['color'] = $this->products->getProductColor();
        $this->load->view('fixed/header', $head);

        $this->load->view('products/product-add', $data);

        $this->load->view('fixed/footer');
    }





    public function product_list()

    {

        $catid = $this->input->get('id');
        if ($catid > 0) {
            $list = $this->products->get_datatables($catid);
        } else {

            $list = $this->products->get_datatables();
        }
        // echo json_encode($list);
        $data = array();

        $no = $this->input->post('start');

        foreach ($list as $prd) {

            $no++;

            $row = array();

            $row[] = $no;

            $pid = $prd->pid;

            $row[] = $prd->product_name;

            $row[] = $prd->qty;

            $row[] = $prd->product_code;

            $row[] = $prd->title;

            $row[] = amountFormat($prd->product_price);

            $row[] = '<a href="' . base_url() . 'products/edit?id=' . $pid . '" class="btn btn-primary btn-xs"><span class="icon-pencil"></span> ' . $this->lang->line('Edit') . '</a> <a href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-xs  delete-object"><span class="icon-bin"></span> ' . $this->lang->line('Delete') . '</a>';

            $data[] = $row;
        }



        $output = array(

            "draw" => $_POST['draw'],

            "recordsTotal" => $this->products->count_all($catid),

            "recordsFiltered" => $this->products->count_filtered($catid),

            "data" => $data,

        );

        //output to json format

        echo json_encode($output);
    }
    public function item_product_list()

    {

        $catid = $this->input->get('id');
        // if ($catid > 0) {
        $list = $this->products->get_product_datatables($catid);
        // } else {

        // $list = $this->products->get_datatables();
        // }
        // echo json_encode($list);
        $data = array();

        $no = $this->input->post('start');

        foreach ($list as $prd) {

            $no++;

            $row = array();

            $row[] = $no;

            $pid = $prd->pid;

            $row[] = $prd->product_name;

            $row[] = $prd->qty;

            $row[] = $prd->product_code;

            $row[] = $prd->title;

            $row[] = amountFormat($prd->product_price);

            $row[] = '<a href="' . base_url() . 'products/edit?id=' . $pid . '" class="btn btn-primary btn-xs"><span class="icon-pencil"></span> ' . $this->lang->line('Edit') . '</a> <a href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-xs  delete-object"><span class="icon-bin"></span> ' . $this->lang->line('Delete') . '</a>';

            $data[] = $row;
        }



        $output = array(

            "draw" => $_POST['draw'],

            "recordsTotal" => $this->products->count_all($catid),

            "recordsFiltered" => $this->products->count_filtered($catid),

            "data" => $data,

        );

        //output to json format

        echo json_encode($output);
    }



    public function addproduct()

    {
        //retrive all colors
        $col = $this->categories->productcolorlist();
        $col_list = array();
        foreach ($col as $row) {
            $col_list[$row['p_color_id']] = $row['name'];
        }
        //retrive all size
        $sz = $this->categories->productsizelist();
        $sz_list = array();
        foreach ($sz as $row) {
            $sz_list[$row['p_size_id']] = $row['name'];
        }
        //retrive all material
        $mt = $this->categories->productmateriallist();
        $mt_list = array();
        foreach ($mt as $row) {
            $mt_list[$row['p_material_id']] = $row['name'];
        }


        $cnt = 0; //to count item added
        $item_name = $this->input->post('Item_name');

        $product_name = $this->input->post('product_name');

        $catid = $this->input->post('product_cat');

        $warehouse = $this->input->post('product_warehouse');

        $product_code = $this->input->post('product_code');

        $product_price = $this->input->post('product_price');

        $factoryprice = $this->input->post('fproduct_price');
        $factoryprice = (isset($factoryprice)) ? $factoryprice : 0;
        $taxrate = $this->input->post('product_tax');
        $taxrate = (isset($taxrate)) ? $taxrate : 0;
        $disrate = $this->input->post('product_disc');
        $disrate = (isset($disrate)) ? $disrate : 0;
        $product_qty = $this->input->post('product_qty');

        $product_qty_alert = $this->input->post('product_qty_alert');

        $product_desc = $this->input->post('product_desc');



        $product_width = $this->input->post('product_width');
        $product_width = (isset($product_width)) ? $product_width : 0;
        $product_hight = $this->input->post('product_hight');
        $product_hight = (isset($product_hight)) ? $product_hight : 0;
        $product_length = $this->input->post('product_length');
        $product_length = (isset($product_length)) ? $product_length : 0;
        $product_weight = $this->input->post('product_weight');
        $product_weight = (isset($product_weight)) ? $product_weight : 0;


        $quick_pick = $this->input->post('quick_pick');



        $product_sku = $this->input->post('product_sku');

        $product_barcode = $this->input->post('product_barcode');

        $package_qty = $this->input->post('package_qty');
        $package_qty = (isset($package_qty)) ? $package_qty : 0;
        $selection = $this->input->post('selection');


        $image = $this->input->post('file_attachother');

        // echo json_encode(array('status' => 'Success', 'message' => $catid.' '.$item_name. ' '.$product_name.' '.$warehouse.' '.$product_code.' '.$product_price.' '.$factoryprice.' '.$taxrate.' '.$disrate.' '. $product_qty. ' '.$product_qty_alert.' '.$product_desc.' '.$product_width.' '.$product_hight.' '.$product_length.' '. $product_weight.'  '.$quick_pick.'  '.$product_sku.' '.$product_barcode.' '.$package_qty.' '.$selection));
        if ($selection == "new") {
            $vari = array();
            $product_color = $this->input->post('product_color');

            $Product_size = $this->input->post('Product_size');

            $material = $this->input->post('Product_material');
            $ismulti = (count($product_color) > 1 || count($Product_size) > 1 || count($material) > 1) ? true : false;
            $combo = array();
            $db_item_id = "";
            $db_pro_ids = array();
            $db_item_id = $this->products->addnewItem($item_name, $catid, $warehouse, $product_code, $taxrate, $disrate,  $product_desc, "",  $image);

            foreach ($product_color as $color) {
                foreach ($Product_size as $size) {
                    foreach ($material as $m) {
                        if ($ismulti) {
                            $product_sku  = "SKU" . $product_code . $color . $size . $m;
                            //$product_barcode = "UPC" . $product_code . $color . $size . $m;

                        }
                        $ret = $this->products->addnew($product_name, $product_price, $factoryprice, $product_qty, $product_qty_alert, $db_item_id, $product_width, $product_hight, $product_length, $product_weight, $color, $quick_pick, $size, $product_sku, '', $package_qty, '', $m, $warehouse);
                        $db_pro_ids[] =  $ret;
                        $cnt++;
                        array_push(
                            $vari,
                            array(
                                'var_name' => $product_name . '-' . $col_list[$color] . '-' . $sz_list[$size] . '-' . $mt_list[$m],
                                'item_sku' => $product_sku,
                                'item_upc' => "",
                                'code' =>  $product_code . $color . $size . $m,
                            )
                        );

                        if ($ismulti) {
                            $product_barcode  = $db_item_id . $ret . $color . $size . $m;
                            $product_sku  = "SKU" . $db_item_id . $ret . $color . $size . $m;
                        }

                        array_push($combo, array('c' => $color, 's' => $size, 'm' => $m, 'barcode' => $product_barcode, 'item_sku' => $product_sku));
                    }
                }
            }

            for ($i = 0; $i < count($vari); $i++) {
                $vari[$i]['item_upc'] = $combo[$i]['barcode'];
                $vari[$i]['item_sku'] = $combo[$i]['item_sku'];
            }

            $data = array(
                'item_name' => $item_name,
                //'var_name' => $product_name,
                'item_desc' => $product_desc,
                // 'item_sku' => $product_sku,
                // 'item_upc' => $product_barcode,
                'item_amt' => $product_price,
                'item_alert' => $product_qty_alert,
                'variant' => $vari
            );

            $items = $this->createItem($data);
            $item = $items['item'];
            $products = $items['var'];
            $index = 0;
            $this->products->updateItem(array('item_api_id' => $item), $db_item_id);
            //code to update the item and products with generated barcode and 
            foreach ($products as $pro) {
                $bimg = $this->generateBarcode($pro['upc']);
                $data = array(
                    "upc_barcode" => $pro['upc'],
                    "SKU_number" => $pro['sku'],
                    "variant_id" => $pro['id'],
                    "barcode_img" => $bimg,
                );

                $this->products->updateProduct($data, $db_pro_ids[$index++]);
            }
        } else if ($selection == "newv") {
            $catid = $this->input->post('procat');
            $index = 0;
            // $warehouse = $this->input->post('proware');

            $product_code = $this->input->post('procode');


            $taxrate = $this->input->post('protax');
            $taxrate = (isset($taxrate)) ? $taxrate : 0;
            $disrate = $this->input->post('prodisc');
            $disrate = (isset($disrate)) ? $disrate : 0;
            $product_desc = $this->input->post('prodesc');
            $products = $items;
            $product_color = $this->input->post('product_color');

            $Product_size = $this->input->post('Product_size');

            $material = $this->input->post('Product_material');


            $item = $this->input->post('item_sel');
            $item_id  = $this->products->getItem_api_id($item);
            $ismulti = (count($product_color) > 1 || count($Product_size) > 1 || count($material) > 1) ? true : false;
            foreach ($product_color as $color) {
                foreach ($Product_size as $size) {
                    foreach ($material as $m) {
                        if ($ismulti) {
                            $product_sku  = "SKU" . $product_code . $color . $size . $m;
                            // $product_barcode = "UPC" . $product_code . $color . $size . $m;
                        }
                        $temp = $this->products->addnew($product_name, $product_price, $factoryprice, $product_qty, $product_qty_alert, $item, $product_width, $product_hight, $product_length, $product_weight, $color, $quick_pick, $size, $product_sku, '', $package_qty, '', $m, $warehouse);
                        if ($ismulti) {

                            $product_barcode = $item . $temp . $color . $size . $m;
                            $product_sku = "SKU" .$item . $temp . $color . $size . $m;
                        }
                        $data = array(
                            'item_id' => $item_id,
                            'var_name' => $product_name,
                            'item_desc' => $product_desc,
                            'item_sku' => $product_sku,
                            'item_upc' => $product_barcode,
                            'item_amt' => $product_price,
                            'item_alert' => $product_qty_alert
                        );
                        $items = $this->createVariant($data);
                        $products = $items;
                        // $product_color = implode(',', $product_color);
                        // $Product_size = implode(',', $Product_size);
                        // $material = implode(',', $material);
                        $bimg = $this->generateBarcode($product_barcode);
                        $data = array(
                            "upc_barcode" => $product_barcode,
                            "SKU_number" => $product_sku,
                            "variant_id" => $products,
                            "barcode_img" => $bimg,
                        );
                        $this->products->updateProduct($data, $temp);
                        //$temp = $this->products->addnew($product_name, $product_price, $factoryprice, $product_qty, $product_qty_alert, $item, $product_width, $product_hight, $product_length, $product_weight, $color, $quick_pick, $size, $product_sku, $product_barcode, $package_qty, $products, $m, $warehouse);
                        if ($temp > 0) {
                            $cnt++;
                            // echo json_encode(array('status' => 'Success', 'message' =>

                            // $this->lang->line('ADDED') . ' ' . $temp . ' Product/s  ' . '&nbsp; Return to Variants<a href="' . base_url("products/viewproducts?id=$item") . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>'));
                            // //array('status' => 'Success', 'message' => '[Show] ' . $this->lang->line('UPDATED').'&nbsp; Return to Show <a href="' .base_url("projects/exploreshow?id=" . $id) . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>')
                        } else if ($temp == -1) {
                            echo json_encode(array('status' => 'Error', 'message' => 'SKU Number And UPC Barcode are Already Exists!'));
                        } else {

                            // echo json_encode(array('status' => 'Error', 'message' =>

                            // $this->lang->line('ERROR') . $product_name . ' ' . $product_price . ' ' . $factoryprice . ' ' . $product_qty . ' ' . $product_qty_alert . ' ' . $item . ' ' . $product_width . ' ' . $product_hight . ' ' . $product_length . ' ' . $product_weight . ' ' . $product_color . ' ' . $quick_pick . ' ' . $Product_size . ' ' . $material . ' ' . $product_sku . ' ' . $product_barcode . ' ' . $package_qty . ' ' . $products));
                        }
                        $index++;
                    }
                }
            }
        } else {
            $item = $this->input->post('item');
            $index = 0;
            $products = $this->input->post('products');
            $product_color = $this->input->post('product_color_s');
            $Product_size = $this->input->post('Product_size_s');
            $material = $this->input->post('Product_material_s');
            if ($catid) {
                $tmp = 0;
                $item = $this->products->addnewItem($item_name, $catid, $warehouse, $product_code, $taxrate, $disrate,  $product_desc, $item,  $image);
                $tmp += $this->products->addnew($product_name, $product_price, $factoryprice, $product_qty, $product_qty_alert, $item, $product_width, $product_hight, $product_length, $product_weight, $product_color, $quick_pick, $Product_size, $product_sku, $product_barcode, $package_qty, $products, $material, $warehouse);
                if ($tmp > 0) {
                    $cnt++;
                }
                $index++;
            }
        }


        if ($cnt > 0) {

            echo json_encode(array('status' => 'Success', 'message' =>

            $this->lang->line('ADDED') . ' ' . $cnt . ' Product/s  ' . $index . '&nbsp; Return to Variants<a href="' . base_url("products/viewproducts?id=$item") . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>'));
            //array('status' => 'Success', 'message' => '[Show] ' . $this->lang->line('UPDATED').'&nbsp; Return to Show <a href="' .base_url("projects/exploreshow?id=" . $id) . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>')
        } else if ($cnt == -1) {
            echo json_encode(array('status' => 'Error', 'message' => 'SKU Number And UPC Barcode are Already Exists!'));
        } else {

            echo json_encode(array('status' => 'Error', 'message' =>

            $this->lang->line('ERROR') . $product_name . ' pp ' . $product_price . ' fp ' . $factoryprice . ' pq ' . $product_qty . ' pa ' . $product_qty_alert . ' itm ' . $item . ' pw ' . $product_width . ' ph ' . $product_hight . ' pl ' . $product_length . ' pw ' . $product_weight . ' pc  ' . $product_color . ' qp ' . $quick_pick . ' ps' . $Product_size . ' m ' . $material . ' sku ' . $product_sku . ' bar  ' . $product_barcode . ' paqty ' . $package_qty . ' pro ' . $products . ' sel ' . $selection . ' war ' . $warehouse));
        }
    }

    public function dtest(){
        $id = "19";
        echo  $this->products->getVariantId($id);
    }

    public function delete_i()

    {

        $id = $this->input->post('deleteid');

        if ($id) {
            $var_id = $this->products->getVariantId($id);
           $this->db->delete('products', array('pid' => $id));
             
            if($var_id!=""){
                $this->deleteItemVariantSquare($var_id);
            }
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {

            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    public function delete_item()

    {

        $id = $this->input->post('deleteid');

        if ($id) {

            $this->db->delete('products', array('item_id' => $id));
            $this->db->delete('item_details', array('item_id' => $id));
            $var_id = $this->products->getItem_api_id($id);
            if($var_id!=0){
                $this->deleteItemVariantSquare($var_id);
            }
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {

            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }



    public function edit()

    {

        $pid = $this->input->get('id');

        $this->db->select('*');

        $this->db->from('products');

        $this->db->where('pid', $pid);

        $query = $this->db->get();

        $data['product'] = $query->row_array();
        // $data['product'] = $query->row_array();
        $data['item_data'] = $this->products->getItemData($data['product']['item_id']);
        $data['product']['item_id'] =  $this->products->getItem_api_id($data['product']['item_id']);
        $data['items'] = $this->getItemFromApi($data['product']['variant_id']);


        $data['cat_ware'] = $this->categories->cat_ware($pid);

        $data['warehouse'] = $this->categories->warehouselistwithouttl();

        $data['cat'] = $this->categories->category_list();

        $data['size'] = $this->products->getProductSize();

        $data['material'] = $this->products->getProductMaterial();

        $data['color'] = $this->products->getProductColor();

        $head['title'] = "Edit Product";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/product-edit', $data);

        $this->load->view('fixed/footer');
    }



    public function editproduct()

    {

        $pid = $this->input->post('pid');

        $product_name = $this->input->post('product_name');

        // $catid = $this->input->post('product_cat');

        $warehouse = $this->input->post('product_warehouse');

        //   $product_code = $this->input->post('product_code');

        $product_price = $this->input->post('product_price');

        $factoryprice = $this->input->post('fproduct_price');
        $factoryprice = (isset($factoryprice)) ? $factoryprice : 0;
        //  $taxrate = $this->input->post('product_tax');

        // $disrate = $this->input->post('product_disc');

        $product_qty = $this->input->post('product_qty');

        $product_qty_alert = $this->input->post('product_qty_alert');

        //   $product_desc = $this->input->post('product_desc');

        $item = $this->input->post('item_id');

        //$item_name = $this->input->post('Item_name');

        $products = $this->input->post('products');
        $product_width = $this->input->post('product_width');
        $product_width = (isset($product_width)) ? $product_width : 0;
        $product_hight = $this->input->post('product_hight');
        $product_hight = (isset($product_hight)) ? $product_hight : 0;
        $product_length = $this->input->post('product_length');
        $product_length = (isset($product_length)) ? $product_length : 0;
        $product_weight = $this->input->post('product_weight');
        $product_weight = (isset($product_weight)) ? $product_weight : 0;
        $product_color = $this->input->post('product_color');
        //$product_color = implode(',', $product_color);

        $quick_pick = $this->input->post('quick_pick');

        $Product_size = $this->input->post('Product_size');
        //$Product_size = implode(',', $Product_size);

        $product_sku = $this->input->post('product_sku');

        $product_barcode = $this->input->post('product_barcode');

        $package_qty = $this->input->post('package_qty');
        $package_qty = (isset($package_qty)) ? $package_qty : 0;
        //  $image = $this->input->post('file_attachother');
        $material = $this->input->post('Product_material');
        // $material = implode(',', $material);
        $data =  array(
            'variation_id' => $products,
            'item_amt' => $product_price,
            'item_id' => $item,
        );
        $this->updateVariant($data);
        if ($pid) {

            // $this->products->edit($pid, $catid, $warehouse, $product_name, $product_code, $product_price, $factoryprice, $taxrate, $disrate, $product_qty, $product_qty_alert, $product_desc, $item, $product_width, $product_hight, $product_length, $product_weight, $product_color, $quick_pick, $Product_size, $product_sku, $product_barcode, $package_qty, $products, $image, $item_name, $material);
            $this->products->edit($pid,  $product_name, $product_price, $factoryprice, $product_qty, $product_qty_alert,  $product_width, $product_hight, $product_length, $product_weight, $product_color, $quick_pick, $Product_size, $product_sku, $product_barcode, $package_qty, $products, $material, $warehouse);
        }
    }
    public function edititemdb()

    {

        $item_id = $this->input->post('item_id');

        $catid = $this->input->post('product_cat');

        $warehouse = $this->input->post('product_warehouse');

        $product_code = $this->input->post('product_code');

        $taxrate = $this->input->post('product_tax');

        $disrate = $this->input->post('product_disc');

        $product_desc = $this->input->post('product_desc');

        $item = $this->input->post('item');

        $item_name = $this->input->post('Item_name');

        $image = $this->input->post('file_attachother');


        if ($item_id) {

            $this->products->editItem($item_id, $catid, $warehouse, $product_code,  $taxrate, $disrate,  $product_desc, $item,  $image, $item_name);
        }
    }





    public function warehouseproduct_list()

    {

        $catid = $this->input->get('id');





        $list = $this->products->get_datatables($catid, true);



        $data = array();

        $no = $this->input->post('start');

        foreach ($list as $prd) {

            $no++;

            $row = array();

            $row[] = $no;

            $pid = $prd->pid;

            $row[] = $prd->product_name;

            $row[] = $prd->qty;

            $row[] = $prd->product_code;

            $row[] = $prd->title;

            $row[] = amountFormat($prd->product_price);

            $row[] = '<a href="' . base_url() . 'products/edit?id=' . $pid . '" class="btn btn-primary btn-xs"><span class="icon-pencil"></span> ' . $this->lang->line('Edit') . '</a> <a href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-xs  delete-object"><span class="icon-bin"></span> ' . $this->lang->line('Delete') . '</a>';

            $data[] = $row;
        }



        $output = array(

            "draw" => $_POST['draw'],

            "recordsTotal" => $this->products->count_all($catid, true),

            "recordsFiltered" => $this->products->count_filtered($catid, true),

            "data" => $data,

        );

        //output to json format

        echo json_encode($output);
    }



    public function prd_stats()

    {



        $this->products->prd_stats();
    }



    public function stock_transfer_products()

    {

        $wid = $this->input->get('wid');

        $result = $this->products->products_list($wid);

        echo json_encode($result);
    }

    public function stock_transfer_items()

    {

        $wid = $this->input->get('wid');

        $result = $this->products->products_list($wid);

        echo json_encode($result);
    }


    public function stock_transfer()

    {

        if ($this->input->post()) {



            $products_l = $this->input->post('products_l');

            $from_warehouse = $this->input->post('from_warehouse');

            $to_warehouse = $this->input->post('to_warehouse');



            $this->products->transfer($from_warehouse, $products_l, $to_warehouse);
        } else {



            $data['cat'] = $this->categories->category_list();

            $data['warehouse'] = $this->categories->warehouse_list();

            $head['title'] = "Stock Transfer";

            $head['usernm'] = $this->aauth->get_user()->username;

            $this->load->view('fixed/header', $head);

            $this->load->view('products/stock_transfer', $data);

            $this->load->view('fixed/footer');
        }
    }



    public function productcolor()

    {

        $head['title'] = "Products Color";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/ColorAdd');

        $this->load->view('fixed/footer');
    }



    public function productsize()

    {

        $head['title'] = "Products Size";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/SizeAdd');

        $this->load->view('fixed/footer');
    }
    //add produt
    public function productmaterial()

    {

        $head['title'] = "Products Material Master";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/MaterialAdd');

        $this->load->view('fixed/footer');
    }
    //to retrive the items usng the catalog api -arzoo start
    public function getItemFromApi($id = '0')
    {
        $path = APPPATH . 'third_party/connect-php-sdk/autoload.php';
        // echo $path;
        require_once($path);
        $this->config->load('api_config');
        // $id = $this->products->getItem_api_id($id);
        $token = $this->config->item('square_token');
        // Configure OAuth2 access token for authorization: oauth2
        SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($token);
        $items_db = $this->products->getAllItems();
        $api_instance = new SquareConnect\Api\CatalogApi();
        $cursor = "cursor_example"; // string | The pagination cursor returned in the previous response. Leave unset for an initial request. See [Pagination](/basics/api101/pagination) for more information.
        $types = "types_example"; // string | An optional case-insensitive, comma-separated list of object types to retrieve, for example `ITEM,ITEM_VARIATION,CATEGORY,IMAGE`.  The legal values are taken from the [CatalogObjectType](#type-catalogobjecttype) enumeration, namely `ITEM`, `ITEM_VARIATION`, `CATEGORY`, `DISCOUNT`, `TAX`, `MODIFIER`, `MODIFIER_LIST`, or `IMAGE`.
        $items_list  = array();
        $items_var  = array();
        $ret = array();
        // print_r($items_db);
        try {
            $result = $api_instance->listCatalog();
            $result = json_decode($result);

            foreach ($result->objects as $key => $value) {
                if ($value->type == "ITEM") {
                    $cnt = 0;
                    $edt = 0;
                    $mmm = 0;
                    foreach ($value->item_data->variations as $var) {
                        if (!isset($items_var[$value->id]))
                            $items_var[$value->id] = array();
                        if ((!in_array($var->id, $items_db))) {
                            array_push($items_var[$value->id], ['id' => $var->id, 'name' => ($var->item_variation_data->name), 'status' => 'new']);
                            $mmm++;
                        } else if ($id == $var->id) {
                            array_push($items_var[$value->id], ['id' => $var->id, 'name' => ($var->item_variation_data->name), 'status' => 'edit']);
                            $edt++;
                        } else {
                            array_push($items_var[$value->id], ['id' => $var->id, 'name' => ($var->item_variation_data->name), 'status' => 'assigned']);
                            $cnt++;
                        }
                    }
                    if ($cnt > 0 && $mmm > 0)
                        array_push($items_list, ['id' => $value->id, 'name' => ($value->item_data->name), 'status' => 'mod']);
                    else if ($cnt > 0)
                        array_push($items_list, ['id' => $value->id, 'name' => ($value->item_data->name), 'status' => 'assigned']);
                    else if ($edt > 0)
                        array_push($items_list, ['id' => $value->id, 'name' => ($value->item_data->name), 'status' => 'edit']);
                    else
                        array_push($items_list, ['id' => $value->id, 'name' => ($value->item_data->name), 'status' => 'new']);
                }
            }
            $ret['items'] = $items_list;
            $ret['items_var'] = $items_var;

            return ($ret);
        } catch (Exception $e) {
            // echo 'Exception when calling CatalogApi->listCatalog: ', $e->getMessage(), PHP_EOL;
            return 0;
        }
    }
    public function getItemsFromApi($id = '0')
    {
        $path = APPPATH . 'third_party/connect-php-sdk/autoload.php';
        // echo $path;
        require_once($path);
        $this->config->load('api_config');
        // $id = $this->products->getItem_api_id($id);
        $token = $this->config->item('square_token');
        // Configure OAuth2 access token for authorization: oauth2
        SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($token);
        $items_db = $this->products->getAllItemsID();
        $api_instance = new SquareConnect\Api\CatalogApi();
        $cursor = "cursor_example"; // string | The pagination cursor returned in the previous response. Leave unset for an initial request. See [Pagination](/basics/api101/pagination) for more information.
        $types = "types_example"; // string | An optional case-insensitive, comma-separated list of object types to retrieve, for example `ITEM,ITEM_VARIATION,CATEGORY,IMAGE`.  The legal values are taken from the [CatalogObjectType](#type-catalogobjecttype) enumeration, namely `ITEM`, `ITEM_VARIATION`, `CATEGORY`, `DISCOUNT`, `TAX`, `MODIFIER`, `MODIFIER_LIST`, or `IMAGE`.
        $items_list  = array();
        $items_var  = array();
        $ret = array();
        // print_r($items_db);
        try {
            $result = $api_instance->listCatalog();
            $result = json_decode($result);

            foreach ($result->objects as $key => $value) {
                if ($value->type == "ITEM") {
                    if (!in_array($value->id, $items_db)) {
                        array_push($items_list, ['id' => $value->id, 'name' => ($value->item_data->name), 'status' => 'new']);
                    } else if ($id == $value->id) {
                        array_push($items_list, ['id' => $value->id, 'name' => ($value->item_data->name), 'status' => 'edit']);
                    } else {
                        array_push($items_list, ['id' => $value->id, 'name' => ($value->item_data->name), 'status' => 'assigned']);
                    }
                }
            }
            // $ret['items'] = $items_list;
            return ($items_list);
        } catch (Exception $e) {
            // echo 'Exception when calling CatalogApi->listCatalog: ', $e->getMessage(), PHP_EOL;
            return 0;
        }
    }


    public function createItem($data)
    {
        $path = APPPATH . 'third_party/connect-php-sdk/autoload.php';
        require_once($path);
        $this->config->load('api_config');

        $token = $this->config->item('square_token');
        $curr = $this->config->item('square_currency');
        // Configure OAuth2 access token for authorization: oauth2
        SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($token);
        $api_instance = new SquareConnect\Api\CatalogApi();
        $body = new \SquareConnect\Model\BatchUpsertCatalogObjectsRequest(); // \SquareConnect\Model\BatchUpsertCatalogObjectsRequest | An object containing the fields to POST for the request.  See the corresponding object definition for field details.
        $key = '' . time();
        $body->setIdempotencyKey($key);
        $batch = new \SquareConnect\Model\CatalogObjectBatch;
        $obj = new \SquareConnect\Model\CatalogObject;
        $obj->setType('ITEM');
        $obj->setId('#' . $key);
        $obj->setPresentAtAllLocations(true);
        $item_data = new \SquareConnect\Model\CatalogItem;
        $item_data->setName($data['item_name']);
        $item_data->setDescription($data['item_desc']);
        $variants = array();
        foreach ($data['variant'] as $value) {
            //create and add varaint
            $obj_var = new \SquareConnect\Model\CatalogObject;
            $obj_var->setType('ITEM_VARIATION');
            $id = "#" . $key . $value['code'];
            $obj_var->setId($id);
            $obj_var->setPresentAtAllLocations(true);
            $var = new \SquareConnect\Model\CatalogItemVariation;
            $var->setName($value['var_name']);
            $var->setPricingType('FIXED_PRICING');
            $var->setSku($value['item_sku']);
            $var->setUpc($value['item_upc']);
            $var->setTrackInventory(true);
            //  $var->setInventoryAlertType("TRUE");
            $var->setInventoryAlertThreshold(intval($data['item_alert']));
            // $var->setUserData('bbbb1111');
            // $var->setV2Id('cccc');

            $var1 = new \SquareConnect\Model\Money;
            $var1->setAmount(intval($data['item_amt']) * 100);
            $var1->setCurrency($curr);
            // $var1->setCurrency('USD');

            $var->setPriceMoney($var1);
            $obj_var->setItemVariationData($var);
            //create the variants list
            array_push($variants, $obj_var);
        }



        $item_data->setVariations($variants);
        $obj->setItemData($item_data);
        $obj_array = array();
        array_push($obj_array, $obj);
        $batch->setObjects($obj_array);
        $batches = array();
        array_push($batches, $batch);
        $body->setBatches($batches);
        $item_ids = array();
        try {
            $result = $api_instance->batchUpsertCatalogObjects($body);
            $item_ids['item'] =  $result['objects'][0]['id'];
            $item_ids['var'] = array();
            foreach ($result['objects'][0]['item_data']['variations'] as $value) {
                $sku = (isset($value['item_variation_data']['sku']) ? $value['item_variation_data']['sku'] : "-");
                $upc = (isset($value['item_variation_data']['upc']) ? $value['item_variation_data']['upc'] : "-");
                array_push($item_ids['var'], array('id' => $value['id'], 'sku' => $sku, 'upc' => $upc));
            }
            // print_r($result);
            return $item_ids;
        } catch (Exception $e) {
            $err = 'Exception when calling CatalogApi->batchUpsertCatalogObjects: ' . $e->getMessage() . PHP_EOL;
            $item_ids['item'] = $err;
            $item_ids['var'] = $err;
            return $item_ids;
        }
    }
    public function createVariant($data)
    {
        $path = APPPATH . 'third_party/connect-php-sdk/autoload.php';
        require_once($path);
        $this->config->load('api_config');
        $curr = $this->config->item('square_currency');
        $token = $this->config->item('square_token');
        // Configure OAuth2 access token for authorization: oauth2
        SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($token);
        $key = '' . time();
        $api_instance = new SquareConnect\Api\CatalogApi();
        $body = new \SquareConnect\Model\BatchUpsertCatalogObjectsRequest(); // \SquareConnect\Model\BatchUpsertCatalogObjectsRequest | An object containing the fields to POST for the request.  See the corresponding object definition for field details.
        $body->setIdempotencyKey($key);
        $batch = new \SquareConnect\Model\CatalogObjectBatch;

        $obj_var = new \SquareConnect\Model\CatalogObject;
        $obj_var->setType('ITEM_VARIATION');
        $obj_var->setId('#' . $key . 'var');
        $obj_var->setPresentAtAllLocations(true);
        $var = new \SquareConnect\Model\CatalogItemVariation;
        $var->setItemId($data['item_id']);
        $var->setName($data['var_name']);
        //   $var->setItemId('10000');
        // $var->setOrdinal('11');
        $var->setPricingType('FIXED_PRICING');
        $var->setSku($data['item_sku']);
        $var->setUpc($data['item_upc']);
        $var->setTrackInventory(true);
        //  $var->setInventoryAlertType("TRUE");
        $var->setInventoryAlertThreshold(intval($data['item_alert']));
        // $var->setUserData('bbbb1111');


        $var1 = new \SquareConnect\Model\Money;
        $var1->setAmount(intval($data['item_amt']) * 100);
        $var1->setCurrency($curr);
        // $var1->setCurrency('USD');

        $var->setPriceMoney($var1);
        $obj_var->setItemVariationData($var);
        $obj_array = array();
        array_push($obj_array, $obj_var);
        $batch->setObjects($obj_array);
        $batches = array();
        array_push($batches, $batch);
        $body->setBatches($batches);
        try {
            $result = $api_instance->batchUpsertCatalogObjects($body);
            $item_ids =  $result['objects'][0]['id'];
            return ($item_ids);
            // print_r($result);
        } catch (Exception $e) {
            $err =  'Exception when calling CatalogApi->batchUpsertCatalogObjects: ' . $e->getMessage() . PHP_EOL;
            return $err;
        }
    }

    //to add item - arzoo end

    //product image upload Arzoo
    public function doc_image_upload()
    {
        $this->load->helper("file");
        $this->load->helper(array('form', 'url'));
        $this->load->helper('directory');
        $this->load->library("upload");
        //  $id=$this->input->post('id');
        // $id = $this->session->userdata('attach_id');

        if ($_FILES['uploadFile']['size'] > 0) {
            $this->upload->initialize(array(
                "upload_path" => './assets/product_img/',
                "overwrite" => FALSE,
                "max_filename" => 300,
                "remove_spaces" => TRUE,
                "allowed_types" => '*',
                "max_size" => 30000,
            ));
            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
                echo json_encode($error);
            }
            $data = $this->upload->data();
            $path = $data['file_name'];
            echo $path;
        } else {
            echo "no file";
        }
    }
    public function getDataForItem()
    {
        $item_id = $this->input->post('item_id');
        $result = $this->db->select('*')->from('item_details')->where('item_id', $item_id)->get()->result();
        echo json_encode($result);
    }
    public function getItemList()
    {
        $result = $this->db->from('item_details')->select('item_id,item_name')->get()->result();
        // return $result;
        echo json_encode($result);
    }
    //view products for Item
    public function viewproducts()
    {
        // $head['title'] = "Products";
        $head['title'] = "Items";

        $head['usernm'] = $this->aauth->get_user()->username;
        $data['id'] = $this->input->get('id');
        $this->load->view('fixed/header', $head);
        $data['products'] = $this->products->getProductsDetails($this->input->get('id'));
        // $this->load->view('products/items',$data);
        $this->load->view('products/products', $data);

        $this->load->view('fixed/footer');
    }
    public function edititem()
    {
        $id = $this->input->get('id');

        $data['item_data'] = $this->products->getItemData($id);
        $data['items'] = $this->getItemsFromApi($data['item_data']->item_api_id);

        $data['warehouse'] = $this->categories->warehouselistwithouttl();

        $data['cat'] = $this->categories->category_list();

        $data['size'] = $this->products->getProductSize();

        $data['material'] = $this->products->getProductMaterial();

        $data['color'] = $this->products->getProductColor();

        $head['title'] = "Edit Item";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/item-edit', $data);

        $this->load->view('fixed/footer');
    }
    public function test()
    {
        $data = array(
            'item_id' => '10',
            'variation_id' => 'YJ2SU7TR55527CKGZFLW4HNC',
            'item_amt' => 20,
            'item_alert' => 2
        );
        $items = $this->updateVariant($data);
        echo json_encode($items);
    }
    //update variants
    function updateVariant($data)
    {
        $path = APPPATH . 'third_party/connect-php-sdk/autoload.php';
        require_once($path);
        $this->config->load('api_config');
        $curr = $this->config->item('square_currency');
        $token = $this->config->item('square_token');
        // Configure OAuth2 access token for authorization: oauth2
        SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($token);

        $locs = $this->getLocationsAPI();
        $apiInstance = new SquareConnect\Api\V1ItemsApi();
        $location_id = $locs[0]; // string | The ID of the item's associated location.
        $item_id = $data['item_id']; // string | The ID of the item to modify.
        $variation_id = $data['variation_id']; // string | The ID of the variation to modify.
        $body = new \SquareConnect\Model\V1Variation(); // \SquareConnect\Model\V1Variation | An object containing the fields to POST for the request.  See the corresponding object definition for field details.
        //  $body->setSKU("BB:Pillow 12345678");

        $var1 = new \SquareConnect\Model\V1Money;
        $var1->setAmount(intval($data['item_amt']) * 100);
        $var1->setCurrencyCode($curr);
        // $var1->setCurrencyCode('USD');
        $body->setPriceMoney($var1);
        $body->setV2Id($variation_id);
        try {
            $result = $apiInstance->updateVariation($location_id, $item_id, $variation_id, $body);
            // print_r($result);
            return 1;
        } catch (Exception $e) {
            // echo 'Exception when calling V1ItemsApi->updateVariation: ', $e->getMessage(), PHP_EOL;
            return 0;
        }
    }
    //location code -- arzoo
    function getLocationsAPI()
    {
        # create an instance of the Location API
        $locations_api = new \SquareConnect\Api\LocationsApi();

        try {
            $locations = $locations_api->listLocations();
            //$data = $locations->getLocations();
            //print_r();
            $data = array();
            foreach ($locations->getLocations() as $key => $value) {
                array_push($data, $value['id']);
            }
            //  echo "<br/>data<br/>";

            // return ($data);
            return ($data);
            // print_r ($data);
            // echo "<br/>data<br/>";
        } catch (\SquareConnect\ApiException $e) {
            // echo "Caught exception!<br/>";
            // print_r("<strong>Response body:</strong><br/>");
            // echo "<pre>";
            // var_dump($e->getResponseBody());
            // echo "</pre>";
            // echo "<br/><strong>Response headers:</strong><br/>";
            // echo "<pre>";
            // var_dump($e->getResponseHeaders());
            // echo "</pre>";
            // exit(1);
            return array();
        }
    }
    function aciteitem()
    {
        $data = array(
            'status' => $this->input->post('status'),
        );
        $id = $this->input->post('id');
        $table_name = $this->input->post('table_name');
        $data1 = $this->products->data_update1($data, $table_name, "item_id", $id);
        echo json_encode($data1);
    }
    function acitiveproduct()
    {
        $data = array(
            'status' => $this->input->post('status'),
        );
        $id = $this->input->post('id');
        $table_name = $this->input->post('table_name');
        $data1 = $this->products->data_update2($data, $table_name, "pid", $id);
        echo json_encode($data1);
    }
    function checkproduct()
    {
        $id = $this->input->post('id');
        $table_name = $this->input->post('table_name');
        $data1 = $this->products->check_product($id, $table_name);
        echo json_encode($data1);
    }
    function generateBarcode($code)
    {
        $path = APPPATH . 'third_party/GenerateBarCode/vendor/autoload.php';
        require_once($path);
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        file_put_contents('./assets/product_barcode/' . $code . '.png', $generator->getBarcode($code, $generator::TYPE_CODE_128));
        return $code . '.png';
    }
    function testCode()
    {
        echo  $this->generateBarcode('shamsaagazarzooshaikh123456');
    }
    function getInventoryRequests()
    {
        echo json_encode($this->products->getrequestedInventory());
    }
    function getApprovedRequests()
    {
        echo json_encode($this->products->getapprovedInventory());
    }
    function getConfirmedRequests()
    {
        echo json_encode($this->products->getconfirmedInventory());
    }
    function deleteItemVariantSquare($id)
    {
        $path = APPPATH . 'third_party/connect-php-sdk/autoload.php';
        require_once($path);
        $this->config->load('api_config');
        $token = $this->config->item('square_token');
        // Configure OAuth2 access token for authorization: oauth2
        SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($token);
        $apiInstance = new SquareConnect\Api\CatalogApi();
        $object_id = $id; // string | The ID of the [CatalogObject](#type-catalogobject) to be deleted. When an object is deleted, other objects in the graph that depend on that object will be deleted as well (for example, deleting a [CatalogItem](#type-catalogitem) will delete its [CatalogItemVariation](#type-catalogitemvariation)s).

        try {
            $result = $apiInstance->deleteCatalogObject($object_id);
            return 1;
        } catch (Exception $e) {
            // echo 'Exception when calling CatalogApi->deleteCatalogObject: ', $e->getMessage(), PHP_EOL;
            return 0;
        }
    }
}
