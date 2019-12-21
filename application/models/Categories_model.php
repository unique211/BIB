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



class Categories_model extends CI_Model

{





    public function category_list()

    {

        $query = $this->db->query("SELECT id,title

FROM product_cat



ORDER BY id DESC");

        return $query->result_array();
    }



    public function warehouse_list()

    {

        $query = $this->db->query("SELECT id,title

FROM product_warehouse



ORDER BY id DESC");

        return $query->result_array();
    }

    public function warehouselistwithouttl()
    {
        $query = $this->db->query("SELECT id,title FROM product_warehouse WHERE warehouse_type = 1  ORDER BY id DESC");

        return $query->result_array();
    }



    public function category_stock()

    {

        // $query = $this->db->query("SELECT c.*,p.pc,p.salessum,p.worthsum,p.qty FROM product_cat AS c LEFT JOIN ( SELECT pcat,COUNT(pid) AS pc,SUM(product_price*qty) AS salessum, SUM(fproduct_price*qty) AS worthsum,SUM(qty) AS qty FROM products GROUP BY pcat ) AS p ON c.id=p.pcat");
        $query = $this->db->query("SELECT c.*,p.pc,p.salessum,p.worthsum,p.qty FROM product_cat AS c LEFT JOIN ( SELECT item_details.product_category as pcat,COUNT(pid) AS pc,SUM(product_price*qty) AS salessum, SUM(fproduct_price*qty) AS worthsum,SUM(qty) AS qty FROM products inner join item_details on item_details.item_id = products.item_id GROUP BY pcat ) AS p ON c.id=p.pcat");

        return $query->result_array();
    }



    public function warehouse()

    {

        $query = $this->db->query("SELECT c.*,p.pc,p.salessum,p.worthsum,p.qty FROM product_warehouse AS c LEFT JOIN ( SELECT warehouse,COUNT(pid) AS pc,SUM(product_price*qty) AS salessum, SUM(fproduct_price*qty) AS worthsum,SUM(qty) AS qty FROM products GROUP BY warehouse ) AS p ON c.id=p.warehouse");
        // $query = $this->db->query("SELECT c.*,p.pc,p.salessum,p.worthsum,p.qty FROM product_warehouse AS c LEFT JOIN ( SELECT item_details.warehouse as warehouse,COUNT(pid) AS pc,SUM(product_price*qty) AS salessum, SUM(fproduct_price*qty) AS worthsum,SUM(qty) AS qty FROM products inner join item_details on item_details.item_id = products.item_id GROUP BY warehouse ) AS p ON c.id=p.warehouse");

        return $query->result_array();
    }
    // get product size list
    public function productsizelist()
    {
        $this->db->select('*');
        $this->db->from('product_size');
        $this->db->where('status', '1');
        $query = $this->db->get();
        return $query->result_array();
    }
    // get product size list
    public function productcolorlist()
    {
        $this->db->select('*');
        $this->db->from('product_color');
        $this->db->where('status', '1');
        $query = $this->db->get();
        return $query->result_array();
    }
    // get product Material list
    public function productmateriallist()
    {
        $this->db->select('*');
        $this->db->from('product_material');
        $this->db->where('status', '1');
        $query = $this->db->get();
        return $query->result_array();
    }



    public function cat_ware($id)

    {

        $query = $this->db->query("SELECT c.id AS cid, w.id AS wid,c.title AS catt,w.title AS watt FROM products AS p LEFT JOIN  item_details i ON p.item_id = i.item_id  LEFT JOIN product_cat AS c ON i.product_category=c.id LEFT JOIN product_warehouse AS w ON  p.warehouse=w.id WHERE

p.pid='$id' ");

        return $query->row_array();
    }



    public function addnew($cat_name, $cat_desc)

    {

        $data = array(

            'title' => $cat_name,

            'extra' => $cat_desc

        );



        if ($this->db->insert('product_cat', $data)) {

            echo json_encode(array('status' => 'Success', 'message' =>

            $this->lang->line('ADDED')));
        } else {

            echo json_encode(array('status' => 'Error', 'message' =>

            $this->lang->line('ERROR')));
        }
    }



    public function addwarehouse($cat_name, $cat_desc)

    {

        $data = array(

            'title' => $cat_name,

            'extra' => $cat_desc

        );



        if ($this->db->insert('product_warehouse', $data)) {

            echo json_encode(array('status' => 'Success', 'message' =>

            $this->lang->line('ADDED')));
        } else {

            echo json_encode(array('status' => 'Error', 'message' =>

            $this->lang->line('ERROR')));
        }
    }
    // add product size - arzoo
    public function addproductsize($name)

    {

        $data = array(

            'name' => $name,

        );



        if ($this->db->insert('product_size', $data)) {

            echo json_encode(array('status' => 'Success', 'message' =>

            $this->lang->line('ADDED')));
        } else {

            echo json_encode(array('status' => 'Error', 'message' =>

            $this->lang->line('ERROR')));
        }
    }
    // add product color - arzoo
    public function addproductcolor($name,$code)

    {

        $data = array(

            'name' => $name,
            'color_code' => $code

        );



        if ($this->db->insert('product_color', $data)) {

            echo json_encode(array('status' => 'Success', 'message' =>

            $this->lang->line('ADDED')));
        } else {

            echo json_encode(array('status' => 'Error', 'message' =>

            $this->lang->line('ERROR')));
        }
    }
    // add product material - arzoo
    public function addproductmaterial($name)

    {

        $data = array(

            'name' => $name,

        );



        if ($this->db->insert('product_material', $data)) {

            echo json_encode(array('status' => 'Success', 'message' =>

            $this->lang->line('ADDED')));
        } else {

            echo json_encode(array('status' => 'Error', 'message' =>

            $this->lang->line('ERROR')));
        }
    }



    public function edit($catid, $product_cat_name, $product_cat_desc)

    {

        $data = array(

            'title' => $product_cat_name,

            'extra' => $product_cat_desc

        );





        $this->db->set($data);

        $this->db->where('id', $catid);



        if ($this->db->update('product_cat')) {

            echo json_encode(array('status' => 'Success', 'message' =>

            $this->lang->line('UPDATED')));
        } else {

            echo json_encode(array('status' => 'Error', 'message' =>

            $this->lang->line('ERROR')));
        }
    }



    public function editwarehouse($catid, $product_cat_name, $product_cat_desc)

    {

        $data = array(

            'title' => $product_cat_name,

            'extra' => $product_cat_desc

        );





        $this->db->set($data);

        $this->db->where('id', $catid);



        if ($this->db->update('product_warehouse')) {
            echo json_encode(array('status' => 'Success', 'message' =>

            $this->lang->line('UPDATED')));
        } else {

            echo json_encode(array('status' => 'Error', 'message' =>

            $this->lang->line('ERROR')));
        }
    }

    // edit product size - arzoo
    public function editproductsize($id, $name, $operation)

    {

        if ($operation != 'delete') {
            $data = array(

                'name' => $name,

            );
        } else {
            $data = array(

                'status' => '0',

            );
        }





        $this->db->set($data);

        $this->db->where('p_size_id', $id);



        if ($this->db->update('product_size')) {
            if ($operation != 'delete') {

                echo json_encode(array('status' => 'Success', 'message' =>

                $this->lang->line('UPDATED')));
            } else {
                echo json_encode(array('status' => 'Success', 'message' =>

                $this->lang->line('DELETED')));
            }
        } else {

            echo json_encode(array('status' => 'Error', 'message' =>

            $this->lang->line('ERROR')));
        }
    }
    // edit product color - arzoo
    public function editproductcolor($id, $name, $code,$operation)

    {

        if ($operation != 'delete') {
            $data = array(

                'name' => $name,
                'color_code' => $code,

            );
        } else {
            $data = array(

                'status' => '0',

            );
        }





        $this->db->set($data);

        $this->db->where('p_color_id', $id);



        if ($this->db->update('product_color')) {
            if ($operation != 'delete') {

                echo json_encode(array('status' => 'Success', 'message' =>

                $this->lang->line('UPDATED')));
            } else {
                echo json_encode(array('status' => 'Success', 'message' =>

                $this->lang->line('DELETED')));
            }
        } else {

            echo json_encode(array('status' => 'Error', 'message' =>

            $this->lang->line('ERROR')));
        }
    }
    // edit product size - arzoo
    public function editproductmaterial($id, $name, $operation)

    {

        if ($operation != 'delete') {
            $data = array(

                'name' => $name,

            );
        } else {
            $data = array(

                'status' => '0',

            );
        }





        $this->db->set($data);

        $this->db->where('p_material_id', $id);



        if ($this->db->update('product_material')) {
            if ($operation != 'delete') {

                echo json_encode(array('status' => 'Success', 'message' =>

                $this->lang->line('UPDATED')));
            } else {
                echo json_encode(array('status' => 'Success', 'message' =>

                $this->lang->line('DELETED')));
            }
        } else {

            echo json_encode(array('status' => 'Error', 'message' =>

            $this->lang->line('ERROR')));
        }
    }
}
