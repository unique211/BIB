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



class Productcategory extends CI_Controller

{

    public function __construct()

    {

        parent::__construct();

        $this->load->library("Aauth");

        $this->load->model('categories_model', 'products_cat');



        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');
        }

        if ($this->aauth->get_user()->roleid != 1 and $this->aauth->get_user()->roleid < 3) {



            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
    }



    public function index()

    {

        $data['cat'] = $this->products_cat->category_stock();

        $head['title'] = "Product Categories";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/category', $data);

        $this->load->view('fixed/footer');
    }



    public function warehouse()

    {

        $data['cat'] = $this->products_cat->warehouse();

        $head['title'] = "Product Warehouse";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/warehouse', $data);

        $this->load->view('fixed/footer');
    }
    //open produc size page - arzoo
    public function productsize()

    {
        $data['size'] = $this->products_cat->productsizelist();

        $head['title'] = "Product Size";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/productsize', $data);

        $this->load->view('fixed/footer');
    }

    //open product color page - arzoo
    public function productcolor()

    {
        $data['size'] = $this->products_cat->productcolorlist();

        $head['title'] = "Product Color";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/productcolor', $data);

        $this->load->view('fixed/footer');
    }

    //open produc material page - arzoo
    public function productmaterial()

    {
        $data['size'] = $this->products_cat->productmateriallist();

        $head['title'] = "Product Material";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/productmaterial', $data);

        $this->load->view('fixed/footer');
    }



    public function view()

    {

        $data['cat'] = $this->products_cat->category_stock();

        $head['title'] = "View Product Category";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/category_view', $data);

        $this->load->view('fixed/footer');
    }



    public function viewwarehouse()

    {

        $data['cat'] = $this->products_cat->warehouse();

        $head['title'] = "View Product Warehouse";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/warehouse_view', $data);

        $this->load->view('fixed/footer');
    }



    public function add()

    {

        $data['cat'] = $this->products_cat->category_list();

        $head['title'] = "Add Product Category";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/category_add', $data);

        $this->load->view('fixed/footer');
    }



    public function addwarehouse()

    {

        if ($this->input->post()) {

            $cat_name = $this->input->post('product_catname');

            $cat_desc = $this->input->post('product_catdesc');

            if ($cat_name) {

                $this->products_cat->addwarehouse($cat_name, $cat_desc);
            }
        } else {



            $data['cat'] = $this->products_cat->category_list();

            $head['title'] = "Add Product Warehouse";

            $head['usernm'] = $this->aauth->get_user()->username;

            $this->load->view('fixed/header', $head);

            $this->load->view('products/warehouse_add', $data);

            $this->load->view('fixed/footer');
        }
    }
    //add product size - arzoo
    public function addproductsize()

    {

        if ($this->input->post()) {

            $name = $this->input->post('size');


            $this->products_cat->addproductsize($name);
        } else {



            $data['size'] = $this->products_cat->productsizelist();

            $head['title'] = "Add Product Size";

            $head['usernm'] = $this->aauth->get_user()->username;

            $this->load->view('fixed/header', $head);

            $this->load->view('products/productsize_add', $data);

            $this->load->view('fixed/footer');
        }
    }
    //add product color - arzoo
    public function addproductcolor()

    {

        if ($this->input->post()) {

            $name = $this->input->post('name');
            $code = $this->input->post('color');


            $this->products_cat->addproductcolor($name,$code);
        } else {



            $data['size'] = $this->products_cat->productcolorlist();

            $head['title'] = "Add Product Color";

            $head['usernm'] = $this->aauth->get_user()->username;

            $this->load->view('fixed/header', $head);

            $this->load->view('products/productcolor_add', $data);

            $this->load->view('fixed/footer');
        }
    }
    //add product Material - arzoo
    public function addproductmaterial()

    {

        if ($this->input->post()) {

            $name = $this->input->post('material');


            $this->products_cat->addproductmaterial($name);
        } else {



            $data['material'] = $this->products_cat->productmateriallist();

            $head['title'] = "Add Product Material";

            $head['usernm'] = $this->aauth->get_user()->username;

            $this->load->view('fixed/header', $head);

            $this->load->view('products/productmaterial_add', $data);

            $this->load->view('fixed/footer');
        }
    }



    public function addcat()

    {

        $cat_name = $this->input->post('product_catname');

        $cat_desc = $this->input->post('product_catdesc');



        if ($cat_name) {

            $this->products_cat->addnew($cat_name, $cat_desc);
        }
    }





    public function delete_i()

    {

        $id = $this->input->post('deleteid');

        if ($id) {

            $this->db->delete('products', array('pcat' => $id));

            $this->db->delete('product_cat', array('id' => $id));

            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Product Category with products')));
        } else {

            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }



    public function delete_warehouse()

    {

        $id = $this->input->post('deleteid');

        if ($id) {

            $this->db->delete('products', array('pcat' => $id));

            $this->db->delete('product_warehouse', array('id' => $id));

            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Product Warehouse with products')));
        } else {

            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    //delete product size -arzoo
    public function delete_productsize()

    {

        $id = $this->input->post('deleteid');

        if ($id) {


            $this->products_cat->editproductsize($id, $name, 'delete');
        }
    }
    //delete product color -arzoo
    public function delete_productcolor()

    {

        $id = $this->input->post('deleteid');

        if ($id) {


            $this->products_cat->editproductcolor($id, $name, $code,'delete');
        }
    }
    //delete product material -arzoo
    public function delete_productmaterial()

    {

        $id = $this->input->post('deleteid');

        if ($id) {


            $this->products_cat->editproductmaterial($id, $name, 'delete');
        }
    }



    //view for edit

    public function edit()

    {

        $catid = $this->input->get('id');

        $this->db->select('*');

        $this->db->from('product_cat');

        $this->db->where('id', $catid);

        $query = $this->db->get();

        $data['productcat'] = $query->row_array();



        $head['title'] = "Edit Product Category";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('products/product-cat-edit', $data);

        $this->load->view('fixed/footer');
    }



    public function editwarehouse()

    {

        if ($this->input->post()) {

            $cid = $this->input->post('catid');

            $cat_name = $this->input->post('product_cat_name');

            $cat_desc = $this->input->post('product_cat_desc');

            if ($cat_name) {

                $this->products_cat->editwarehouse($cid, $cat_name, $cat_desc);
            }
        } else {

            $catid = $this->input->get('id');

            $this->db->select('*');

            $this->db->from('product_warehouse');

            $this->db->where('id', $catid);

            $query = $this->db->get();

            $data['warehouse'] = $query->row_array();



            $head['title'] = "Edit Product Warehouse";

            $head['usernm'] = $this->aauth->get_user()->username;

            $this->load->view('fixed/header', $head);

            $this->load->view('products/product-warehouse-edit', $data);

            $this->load->view('fixed/footer');
        }
    }

    //edit product size - arzoo
    public function editproductsize()

    {

        if ($this->input->post()) {
            $id = $this->input->post('sizeid');

            $name = $this->input->post('size');
            if ($name) {

                $this->products_cat->editproductsize($id, $name, 'edit');
            }
        } else {

            $id = $this->input->get('id');

            $this->db->select('*');

            $this->db->from('product_size');

            $this->db->where('p_size_id ', $id);

            $query = $this->db->get();

            $data['size'] = $query->row_array();



            $head['title'] = "Edit Product Size";

            $head['usernm'] = $this->aauth->get_user()->username;

            $this->load->view('fixed/header', $head);

            $this->load->view('products/productsize_edit', $data);

            $this->load->view('fixed/footer');
        }
    }
    //edit product size - arzoo
    public function editproductcolor()

    {

        if ($this->input->post()) {
            $id = $this->input->post('sizeid');

            $name = $this->input->post('name');
            $code = $this->input->post('color');
            if ($name) {

                $this->products_cat->editproductcolor($id, $name, $code, 'edit');
            }
        } else {

            $id = $this->input->get('id');

            $this->db->select('*');

            $this->db->from('product_color');

            $this->db->where('p_color_id ', $id);

            $query = $this->db->get();

            $data['size'] = $query->row_array();



            $head['title'] = "Edit Product Color";

            $head['usernm'] = $this->aauth->get_user()->username;

            $this->load->view('fixed/header', $head);

            $this->load->view('products/productcolor_edit', $data);

            $this->load->view('fixed/footer');
        }
    }
    //edit product material - arzoo
    public function editproductmaterial()

    {

        if ($this->input->post()) {
            $id = $this->input->post('materialid');

            $name = $this->input->post('material');
            if ($name) {

                $this->products_cat->editproductmaterial($id, $name, 'edit');
            }
        } else {

            $id = $this->input->get('id');

            $this->db->select('*');

            $this->db->from('product_material');

            $this->db->where('p_material_id ', $id);

            $query = $this->db->get();

            $data['material'] = $query->row_array();



            $head['title'] = "Edit Product Material";

            $head['usernm'] = $this->aauth->get_user()->username;

            $this->load->view('fixed/header', $head);

            $this->load->view('products/productmaterial_edit', $data);

            $this->load->view('fixed/footer');
        }
    }


    public function editcat()

    {

        $cid = $this->input->post('catid');

        $product_cat_name = $this->input->post('product_cat_name');



        $product_cat_desc = $this->input->post('product_cat_desc');

        if ($cid) {

            $this->products_cat->edit($cid, $product_cat_name, $product_cat_desc);
        }
    }
}
