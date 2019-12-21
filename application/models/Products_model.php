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



    defined('BASEPATH') OR exit('No direct script access allowed');



    class Products_model extends CI_Model
    {
        var $table = 'products';

        var $column_order = array(null, 'product_name', 'qty', 'product_code', 'title', 'product_price', null); //set column field database for datatable orderable

        var $column_search = array('product_name', 'product_code'); //set column field database for datatable searchable

        var $order = array('pid' => 'desc'); // default order



        public function __construct()

        {

            parent::__construct();

            $this->load->database();

        }



        private function _get_datatables_query($id = '', $w = '',$it = false)

        {
            if($it){
                $this->db->from($this->table);
                $this->db->join('item_details','products.item_id = item_details.item_id');
                $this->db->join('product_warehouse', 'product_warehouse.id = products.warehouse');
                $this->db->join('product_cat', 'product_cat.id = item_details.product_category');
                if ($id > 0) {

                    $this->db->where("item_details.item_id = $id");

                }
            }
            else if ($w) {

                $this->db->from($this->table);
                $this->db->join('item_details','products.item_id = item_details.item_id');
                $this->db->join('product_warehouse', 'product_warehouse.id = products.warehouse');

                if ($id > 0) {

                    $this->db->where("product_warehouse.id = $id");

                }

            } else {

                $this->db->from($this->table);
                $this->db->join('item_details','products.item_id = item_details.item_id');
                $this->db->join('product_cat', 'product_cat.id = item_details.product_category');

                if ($id > 0) {

                    $this->db->where("product_cat.id = $id");

                }

            }

            $i = 0;

            foreach ($this->column_search as $item) // loop column 

            {

                $search = $this->input->post('search');

                $value = $search['value'];

                if ($value) // if datatable send POST for search

                {

                    if ($i === 0) // first loop

                    {

                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.

                        $this->db->like($item, $value);

                    } else {

                        $this->db->or_like($item, $value);

                    }



                    if (count($this->column_search) - 1 == $i) //last loop

                        $this->db->group_end(); //close bracket

                }

                $i++;

            }

            $search = $this->input->post('order');

            if ($search) // here order processing

            {

                $this->db->order_by($this->column_order[$search['0']['column']], $search['0']['dir']);

            } else if (isset($this->order)) {

                $order = $this->order;

                $this->db->order_by(key($order), $order[key($order)]);

            }

        }



        function get_datatables($id = '', $w = '')

        {

            if ($id > 0) {

                $this->_get_datatables_query($id, $w);

            } else {

                $this->_get_datatables_query();

            }

            if ($this->input->post('length') != -1)

                $this->db->limit($this->input->post('length'), $this->input->post('start'));

            $query = $this->db->get();

            return $query->result();

        }
        function get_product_datatables($id = '')

        {

            

                $this->_get_datatables_query($id,'',true);
           
            if ($this->input->post('length') != -1)

                $this->db->limit($this->input->post('length'), $this->input->post('start'));

            $query = $this->db->get();

            return $query->result();

        }



        function count_filtered($id, $w = '')

        {

            if ($id > 0) {

                $this->_get_datatables_query($id, $w);

            } else {

                $this->_get_datatables_query();

            }

            $query = $this->db->get();

            return $query->num_rows();

        }



        public function count_all()

        {

            $this->db->from($this->table);

            return $this->db->count_all_results();

        }
        public function addnewItem($item_name,$catid, $warehouse, $product_code, $taxrate, $disrate,  $product_desc, $item,  $image){
            $row = $this->db->select('item_id')->from('item_details')->where('item_api_id',$item)->get()->row();
            
            $data =array(
                'item_name'=>$item_name,
                'product_category'=>$catid,
                // 'warehouse'=>$warehouse,
                'product_code'=>$product_code,
                'tax_rate'=>$taxrate,
                'discount_rate'=>$disrate,
                'pro_desc'=>$product_desc,
                'pro_image'=>$image,
                'item_api_id'=>$item
            );
            if(isset($row)){
                $id = $row->item_id;
                $this->db->set($data);
                $this->db->where('item_id',$id);
                $this->db->update('item_details');
                return $id;
            }else{
                $this->db->insert('item_details', $data);
                return $this->db->insert_id();
            }
           
        }
        //to update the item
        public function updateItem($data,$item_id){
            $this->db->where('item_id', $item_id);
            $this->db->update('item_details', $data);
        }
        //to update the item
        public function updateProduct($data,$pro_id){
            $this->db->where('pid', $pro_id);
            $this->db->update('products', $data);
        }

        public function addnew($product_name, $product_price, $factoryprice, $product_qty,$product_qty_alert, $item, $product_width, $product_hight, $product_length, $product_weight, $product_color, $quick_pick, $Product_size, $product_sku, $product_barcode, $package_qty, $products, $material, $warehouse)

        {

            $data = array(

                // 'pcat' => $catid,

                'warehouse' => $warehouse,

                'product_name' => $product_name,

                // 'product_code' => $product_code,

                'product_price' => $product_price,

                'fproduct_price' => $factoryprice,

                // 'taxrate' => $taxrate,

                // 'disrate' => $disrate,

                'qty' => $product_qty,

                // 'product_des' => $product_desc,

                'alert' => $product_qty_alert,
                
                'item_id'=>$item,

                'product_width'=>$product_width,

                'product_height'=>$product_hight,

                'product_lenght'=>$product_length,

                'product_weight'=>$product_weight,

                'color'=>$product_color,

                'quick_pick'=>$quick_pick,

                'product_size'=>$Product_size,
                'product_material'=>$material,

                'SKU_number'=>$product_sku,

                'UPC_barcode'=>$product_barcode,

                'Package_quanity_in_bx'=>$package_qty,

                // 'item_name'=>$item_name,

                'variant_id'=>$products,
                'barcode_img'=>'',

                // 'image'=>$image


            );

       	   $this->db->select('*');
	   $this->db->from('products');
           $this->db->where('SKU_number',$product_sku);
           $this->db->where('UPC_barcode',$product_barcode);
	   $num_results = $this->db->count_all_results();
      
 if($num_results==0 || $num_results=="0"){

           if ($this->db->insert('products', $data)) {

               return $this->db->insert_id();

            } else {

                return 0;
            }



        }else{
return -1;
	}


}
        // public function edit($pid, $catid, $warehouse, $product_name, $product_code, $product_price, $factoryprice, $taxrate, $disrate, $product_qty,$product_qty_alert,$product_desc,$item,$product_width,$product_hight,$product_length,$product_weight,$product_color,$quick_pick,$Product_size,$product_sku,$product_barcode,$package_qty,$products, $image, $item_name,$material)
        public function edit($pid,  $product_name, $product_price, $factoryprice, $product_qty, $product_qty_alert,  $product_width, $product_hight, $product_length, $product_weight, $product_color, $quick_pick, $Product_size, $product_sku, $product_barcode, $package_qty, $products, $material, $warehouse)

        {

            $data = array(

                // 'pcat' => $catid,

                'warehouse' => $warehouse,

                'product_name' => $product_name,

                // 'product_code' => $product_code,

                'product_price' => $product_price,

                'fproduct_price' => $factoryprice,

                // 'taxrate' => $taxrate,

                // 'disrate' => $disrate,

                'qty' => $product_qty,

                // 'product_des' => $product_desc,

                'alert' => $product_qty_alert,

                // 'item_id' => $item,

                'product_width'=>$product_width,

                'product_height'=>$product_hight,

                'product_lenght'=>$product_length,

                'product_weight'=>$product_weight,

                'color'=>$product_color,

                'quick_pick'=>$quick_pick,

                'product_size'=>$Product_size,
                'product_material'=>$material,

                'SKU_number'=>$product_sku,

                'UPC_barcode'=>$product_barcode,

                'Package_quanity_in_bx'=>$package_qty,
                
                // 'item_name'=>$item_name,

                'variant_id'=>$products,

                // 'image'=>$image

            );





            $this->db->set($data);

            $this->db->where('pid', $pid);



            if ($this->db->update('products')) {

                echo json_encode(array('status' => 'Success', 'message' =>

                    $this->lang->line('UPDATED')));

            } else {

                echo json_encode(array('status' => 'Error', 'message' =>

                    $this->lang->line('ERROR')));

            }



        }
        public function editItem($item_id, $catid, $warehouse, $product_code,  $taxrate, $disrate,  $product_desc, $item,  $image, $item_name)
        {

            $data = array(

                'item_name'=>$item_name,

                'product_category' => $catid,

                // 'warehouse' => $warehouse,

                'product_code' => $product_code,

                'tax_rate' => $taxrate,

                'discount_rate' => $disrate,

                'pro_desc' => $product_desc,

                'item_api_id' => $item,
                
                'pro_image'=>$image

            );





            $this->db->set($data);

            $this->db->where('item_id', $item_id);



            if ($this->db->update('item_details')) {

                echo json_encode(array('status' => 'Success', 'message' =>

                    $this->lang->line('UPDATED')));

            } else {

                echo json_encode(array('status' => 'Error', 'message' =>

                    $this->lang->line('ERROR').$item_id.''.$item_name.' '.$catid.' '.$item.' '.$image.' '.$product_desc.' '. $disrate
                .' '.$taxrate.' '. $product_code.' '.$warehouse));

            }
        }



        public function prd_stats()

        {



            $query = $this->db->query("SELECT

            COUNT(IF( qty > 0, qty, NULL)) AS instock,

            COUNT(IF( qty <= 0, qty, NULL)) AS outofstock,

            COUNT(qty) AS total

            FROM products ");

            //   return $query->result_array();



            echo json_encode($query->result_array());



        }



        public function products_list($wid)

        {

            $this->db->select('*');

            $this->db->from('products');
            $this->db->where('item_id',$wid);
           

            $query = $this->db->get();

          

            return $query->result_array();

            



        }

        public function transfer($from_warehouse,$products_l,$to_warehouse)

        {    $updateArray = array();

            foreach($products_l as $row){
                $updateArray[] = array(

                    'pid' => $row,

                    'warehouse' => $to_warehouse

                );
            }



            if ($this->db->update_batch('products',$updateArray, 'pid')) {

                echo json_encode(array('status' => 'Success', 'message' =>

                    $this->lang->line('UPDATED')));

            } else {

                echo json_encode(array('status' => 'Error', 'message' =>

                    $this->lang->line('ERROR').' ' .$from_warehouse.' '.$products_l.' '.$to_warehouse));

            }



        }

        //create function for assign warehose to created team leader 

        public function assignvarehousetotl($warehouse_name,$warehouse_desciption,$warehouse_type,$userid)
        {
            $data = array('title'=>$warehouse_name,'extra'=>$warehouse_desciption,'warehouse_type'=>$warehouse_type,'user_id'=>$userid);

             $this->db->insert('product_warehouse', $data);
        }
        //get variant id - arzoo
        public function getVariantId($pid){
            $ret = $this->db->select('variant_id')
            ->from('products')
            ->where('pid',$pid)->get()->row();
            if(!empty($ret))
            return $ret->variant_id;
            else
            return "0";
        }
        //get all variants ids -arzoo
        
     public function getAllItems(){
        $this->db->select('variant_id');
        $this->db->from('products');
        $this->db->where_not_in('variant_id',"");
        $query = $this->db->get();
        $data = array();
        foreach ($query->result() as $row) {
            array_push($data,$row->variant_id);
        }
        return $data;
     }  //get all item ids
     public function getAllItemsID(){
        $this->db->select('item_api_id');
        $this->db->from('item_details');
        $this->db->where_not_in('item_api_id',"");
        $query = $this->db->get();
        $data = array();
        foreach ($query->result() as $row) {
            array_push($data,$row->item_api_id);
        }
        return $data;
     }  
     //get specific item_id - arzoo
     public function getItemId($item_id){
        $result = $this->db->where('variant_id', $item_id)->select("pid")->from('products')->get()->row();
        return $result->pid;
     }
     //get the product size -arzoo 
     public function getProductSize(){
         $result = $this->db->from('product_size')->where('status','1')->get()->result();
         return $result;

     }
     //get the product material -arzoo
     public function getProductMaterial(){
         $result = $this->db->from('product_material')->where('status','1')->get()->result();
         return $result;

     }
     //get the product color -arzoo
     public function getProductColor(){
         $result = $this->db->from('product_color')->where('status','1')->get()->result();
         return $result;

     }
     //get item list - arzoo
     public function getItemList(){
        $result = $this->db->from('item_details')->select('item_id,item_name')->get()->result();
        return $result;
     }
     public function getItem_api_id($item){
        $result = $this->db->from('item_details')->select('item_api_id')->where('item_id',$item)->get()->row();
        if(isset($result)){
            return $result->item_api_id;
        }else{
            return 0;
        }
     }
     public function getItemDetails(){
        $result = $this->db->select(' count(pid) as cnt, item_details.item_id,item_details.item_name, product_cat.title as cat, product_warehouse.title as warehouse, sum(qty) as qty,item_details.product_code,item_details.status as status ')
        ->from('item_details')
        ->join('product_cat','product_cat.id = item_details.product_category')
        ->join('products ','products.item_id = item_details.item_id','left')
        ->join('product_warehouse','product_warehouse.id = products.warehouse','left')
       // ->where('item_details.status','1')
        ->group_by('item_details.item_id')
        ->order_by('item_details.item_id','DESC')
        ->get()
        ->result();
        return $result;
     }
     public function getItemData($id){
        $result= $this->db->from('item_details')->where('item_id',$id)->get()->row();
        return $result;
     }
     public function getProductsDetails($id){
        $result = $this->db->select('products.*, product_color.name as clr, product_size.name as sz, product_material.name as mtr, item_details.item_id,item_details.item_name, product_cat.title as cat, product_warehouse.title as warehouse, qty,item_details.product_code,products.status')
        ->from('item_details')
        ->join('product_cat','product_cat.id = item_details.product_category')
        ->join('products','products.item_id = item_details.item_id')
        ->join('product_color','products.color = product_color.p_color_id')
        ->join('product_size','products.product_size = product_size.p_size_id')
        ->join('product_material','products.product_material = product_material.p_material_id')
        ->join('product_warehouse','product_warehouse.id = products.warehouse')
        ->where('products.item_id',$id)
              ->order_by('products.pid','DESC')
        ->get()
        ->result();
        return $result;
     }
     function data_update1($data,$table,$colum,$id){
        $this->db->where($colum,$id);
        $data1 = $this->db->update($table,$data);

        if($table=="item_details"){
            $this->db->where('item_id',$id);
            $this->db->update('products',$data);
        }
        return $data1;
    }
    function data_update2($data,$table,$colum,$id){
       
       
       
        $this->db->where($colum,$id);
        $data1 = $this->db->update($table,$data);
        return $data1;
    }
    function check_product($id,$table){
        
            $this->db->select('item_id');
             $this->db->from('products');
            $this->db->where('pid',$id);	
            $hasil=$this->db->get();
            if($hasil->num_rows() >0){
                foreach($hasil->result_array() as $product){
                    $itemid=$product['item_id'];
                    if($itemid >0){
                            $this->db->select('status');
                            $this->db->from('item_details');
                            $this->db->where('item_id',$itemid);	
                            $hasil1=$this->db->get();
                            return $hasil1->result();

                        }
                    }
                }
            
    }
    function getboothId($pid,$location_id){
       $ret =  $this->db->select('DISTINCT(showbooth.id) as booth_id')
        ->from("showbooth")
        ->join('shows','shows.id=showbooth.prid','left')
        ->join('item_details','item_details.product_category = showbooth.product_id')
        ->join('products','products.item_id= item_details.item_id')
        ->where('shows.location_id',$location_id)
        ->where('products.pid',$pid)
        ->get()
        ->row();
        if(!empty($ret))
        return $ret->booth_id;
        else
        return 0;
    }
    function getrequestedInventory(){
        $ret =  $this->db->select('salesperson_request.*,products.product_name, employee_profile.name as emp_name, shows.show_name')
         ->from("salesperson_request")
         ->join('shows','shows.id=salesperson_request.show_id','left')
         ->join('products','products.pid= salesperson_request.product_id')
         ->join('employee_profile','employee_profile.id= salesperson_request.product_requested_by')
         ->where('salesperson_request.product_requested_to',$this->aauth->get_user()->id)
         ->where('salesperson_request.status','0')
         ->get()
         ->result_array();
         return $ret;
     }
    function getapprovedInventory(){
        $ret =  $this->db->select('salesperson_request.*,products.product_name, employee_profile.name as emp_name, shows.show_name')
         ->from("salesperson_request")
         ->join('shows','shows.id=salesperson_request.show_id','left')
         ->join('products','products.pid= salesperson_request.product_id')
         ->join('employee_profile','employee_profile.id= salesperson_request.product_approved_by')
         ->where('salesperson_request.product_requested_by',$this->aauth->get_user()->id)
         ->where('salesperson_request.status','1')
         ->get()
         ->result_array();
         return $ret;
     }
    function getconfirmedInventory(){
        $ret =  $this->db->select('salesperson_request.*,products.product_name, employee_profile.name as emp_name, shows.show_name')
         ->from("salesperson_request")
         ->join('shows','shows.id=salesperson_request.show_id','left')
         ->join('products','products.pid= salesperson_request.product_id')
         ->join('employee_profile','employee_profile.id= salesperson_request.product_requested_by')
         ->where('salesperson_request.product_approved_by',$this->aauth->get_user()->id)
         ->where('salesperson_request.status','2')
         ->get()
         ->result_array();
         return $ret;
     }
    }
        
