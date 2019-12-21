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



class Reports_model extends CI_Model

{



    public function index()

    {





        $query = $this->db->query("SELECT pid,product_name,product_price FROM products WHERE UPPER(product_name) LIKE '" . strtoupper($name) . "%'");



        $result = $query->result_array();



        return $result;
    }



    public function viewstatement($pay_acc, $trans_type, $sdate, $edate, $ttype)

    {



        if ($trans_type == 'All') {

            $where = "acid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') ";
        } else {

            $where = "acid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') AND type='$trans_type'";
        }

        $this->db->select('*');

        $this->db->from('transactions');

        $this->db->where($where);

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();

        $result = $query->result_array();



        return $result;
    }



    public function get_statements($pay_acc, $trans_type, $sdate, $edate)

    {



        if ($trans_type == 'All') {

            $where = "acid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') ";
        } else {

            $where = "acid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') AND type='$trans_type'";
        }

        $this->db->select('*');

        $this->db->from('transactions');

        $this->db->where($where);

        $query = $this->db->get();

        $result = $query->result_array();



        return $result;
    }



    //transaction account statement



    var $table = 'transactions';

    var $column_order = array(null, 'account', 'type', 'cat', 'amount', 'stat');

    var $column_search = array('id', 'account');

    var $order = array('id' => 'asc');

    var $opt = '';





    //income statement





    public function incomestatement()

    {





        $this->db->select_sum('lastbal');

        $this->db->from('accounts');

        $query = $this->db->get();

        $result = $query->row_array();



        $lastbal = $result['lastbal'];



        $this->db->select_sum('credit');

        $this->db->from('transactions');



        $this->db->where('type', 'Income');

        $month = date('Y-m');

        $today = date('Y-m-d');

        $this->db->where('DATE(date) >=', "$month-01");

        $this->db->where('DATE(date) <=', $today);



        $query = $this->db->get();

        $result = $query->row_array();



        $motnhbal = $result['credit'];

        return array('lastbal' => $lastbal, 'monthinc' => $motnhbal);
    }



    public function customincomestatement($acid, $sdate, $edate)

    {





        $this->db->select_sum('credit');

        $this->db->from('transactions');

        if ($acid > 0) {

            $this->db->where('acid', $acid);
        }

        $this->db->where('type', 'Income');

        $this->db->where('DATE(date) >=', $sdate);

        $this->db->where('DATE(date) <=', $edate);

        $query = $this->db->get();

        $result = $query->row_array();



        return $result;
    }



    //expense statement





    public function expensestatement()

    {





        $this->db->select_sum('debit');

        $this->db->from('transactions');



        $this->db->where('type', 'Expense');

        $month = date('Y-m');

        $today = date('Y-m-d');

        $this->db->where('DATE(date) >=', "$month-01");

        $this->db->where('DATE(date) <=', $today);



        $query = $this->db->get();

        $result = $query->row_array();



        $motnhbal = $result['debit'];

        return array('monthinc' => $motnhbal);
    }



    public function customexpensestatement($acid, $sdate, $edate)

    {





        $this->db->select_sum('debit');

        $this->db->from('transactions');

        if ($acid > 0) {

            $this->db->where('acid', $acid);
        }

        $this->db->where('type', 'Expense');

        $this->db->where('DATE(date) >=', $sdate);

        $this->db->where('DATE(date) <=', $edate);

        $query = $this->db->get();

        $result = $query->row_array();



        return $result;
    }



    public function statistics($limit = false)
    {

        $this->db->from('reports');

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;
    }



    public function get_customer_statements($pay_acc, $trans_type, $sdate, $edate)

    {



        if ($trans_type == 'All') {

            $where = "payerid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') AND ext=0";
        } else {

            $where = "payerid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') AND type='$trans_type' AND ext=0";
        }

        $this->db->select('*');

        $this->db->from('transactions');

        $this->db->where($where);

        $query = $this->db->get();

        $result = $query->result_array();



        return $result;
    }



    public function get_supplier_statements($pay_acc, $trans_type, $sdate, $edate)

    {



        if ($trans_type == 'All') {

            $where = "payerid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') AND ext=1";
        } else {

            $where = "payerid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') AND type='$trans_type' AND ext=1";
        }

        $this->db->select('*');

        $this->db->from('transactions');

        $this->db->where($where);

        $query = $this->db->get();

        $result = $query->result_array();



        return $result;
    }


    public function getDataforconsignment($show_id, $teamleader_id)
    {
        $this->db->select('*');
        $this->db->from('packinglist_request_show');
        $this->db->where('packinglist_request_show.product_requested_by', $teamleader_id);
        $this->db->where('packinglist_request_show.product_approved_by', $this->aauth->get_user()->id);
        $this->db->where('packinglist_request_show.status', 1);
        $this->db->where('packinglist_request_show.show_id', $show_id);
        $this->db->join('products', 'products.pid = packinglist_request_show.product_id', 'left');
        $this->db->join('item_details', 'products.item_id=item_details.item_id', 'left');
        $this->db->join('employee_profile', 'packinglist_request_show.product_requested_by=employee_profile.id', 'left');
        $query = $this->db->get();

        return $query->result_array();
    }

    //get booth and salesperson details for commission report

    public function getboothdetails($show_id)
    {
        $alldata = array();

        //get show each date
        $this->db->select('*');
        $this->db->from('shows');
        $this->db->where('shows.id', $show_id);
        $query = $this->db->get()->row();

        $date_from = strtotime($query->show_start_date);
        $date_to = strtotime($query->show_end_date);


        $period = array();

        for ($i = $date_from; $i <= $date_to; $i += 86400) {
            $period[] = date("Y-m-d", $i);
        }

        $details = array();

        $detailspercredit = array();

        $shows_assign_to = $query->show_assign_to;

        if ($shows_assign_to != '' || $shows_assign_to != null) {
            $person = explode(',', $shows_assign_to);


            //get salesperson details date wise for cash sales
            foreach ($period as $datetime) {
                foreach ($person as $sl) {
                    $this->db->select('*,employee_profile.id AS eid,showbooth.id AS bid');
                    $this->db->from('showbooth');
                    $this->db->where('showbooth.prid', $show_id);
                    $this->db->join('shows', 'shows.id=' . $show_id, 'left');
                    $this->db->join('employee_profile', 'employee_profile.id=' . $sl, 'left');
                    $this->db->join('invoices','invoices.booth_id=showbooth.id','left');
                    // $this->db->join('invoices', 'invoices.location_id=shows.location_id', 'left');
                    $this->db->where('invoices.salesperson_id', $sl);
                    $this->db->where('invoices.invoicedate', $datetime);
                    $this->db->where('invoices.pmethod', 1);
                    $query1 = $this->db->get()->result_array();

                    if (!empty($query1)) {
                        $details[] = $query1;
                    }
                }
            }

            //get salesperson details date wise for credit sales
            foreach ($period as $datetime) {
                foreach ($person as $sl) {
                    $this->db->select('*,employee_profile.id AS eid,showbooth.id AS bid');
                    $this->db->from('showbooth');
                    $this->db->where('showbooth.prid', $show_id);
                    $this->db->join('shows', 'shows.id=' . $show_id, 'left');
                    $this->db->join('employee_profile', 'employee_profile.id=' . $sl, 'left');
                       $this->db->join('invoices','invoices.booth_id=showbooth.id','left');
                    // $this->db->join('invoices', 'invoices.location_id=shows.location_id', 'left');
                    $this->db->where('invoices.salesperson_id', $sl);
                    $this->db->where('invoices.invoicedate', $datetime);
                    $this->db->where('invoices.pmethod', 2);
                    $query1 = $this->db->get()->result_array();

                    if (!empty($query1)) {
                        $detailspercredit[] = $query1;
                    }
                }
            }

            //get all invoice data for tax calculation 

            $allinvoicesdetails = array();

            $this->db->select('*,showbooth.id AS bid');
            $this->db->from('invoices');
            $this->db->join('showbooth','invoices.booth_id=showbooth.id','left');
            // $this->db->join('shows', 'invoices.location_id=shows.location_id', 'left');
            // $this->db->join('showbooth', 'shows.id=showbooth.prid', 'left');
            // $this->db->where('shows.id', $show_id);
            $this->db->where('showbooth.prid', $show_id);
           
            $query = $this->db->get();
            $allinvoicesdetails[] = $query->result_array();


            //get salesperson detail 
            $salesperson = array();

            foreach ($person as $sl1) {
                $this->db->select('*');
                $this->db->from('employee_profile');
                $this->db->where('employee_profile.id', $sl1);
                $query1 = $this->db->get();

                $salesperson[] = $query1->result_array();
            }

            //get booth details
            $boothdetails = [];
            $this->db->select('*');
            $this->db->from('showbooth');
            $this->db->where('showbooth.prid', $show_id);
            $query2 = $this->db->get();
            $boothdetails[] = $query2->result_array();



            $alldata['salesperson'] = $salesperson;
            $alldata['datewithsales'] = $details;
            $alldata['datewithsalesforcredit'] = $detailspercredit;
            $alldata['dates'] = $period;
            $alldata['boothdetail'] = $boothdetails;
            $alldata['allinvoicesdetails'] = $allinvoicesdetails;
            $alldata['totalsalesperson'] = count($person);
            $alldata['totaldate'] = count($period);


            return $alldata;
        } else {
            return 12;
        }
    }

    public function get_product_category()
    {
        $this->db->select('*');
        $this->db->from('product_cat');

        return $this->db->get()->result_array();
    }
    public function get_items($pcat)
    {
        $this->db->select('*');
        $this->db->from('item_details');
        $this->db->where('product_category',$pcat);

        return $this->db->get()->result_array();
    }
    public function getAllProductByItem($pcat,$it){
        $this->db->select('products.*,item_details.item_name, item_details.product_code, product_color.name as clr, product_size.name as sz, product_material.name as mtr,  product_cat.title as cat')
        ->from('products')
        ->join('item_details','item_details.item_id = products.item_id')
        ->join('product_color','products.color = product_color.p_color_id')
        ->join('product_size','products.product_size = product_size.p_size_id')
        ->join('product_material','products.product_material = product_material.p_material_id')
        ->join('product_cat','product_cat.id = item_details.product_category');
        $this->db->where('item_details.product_category',$pcat);
        if($it!="0"){
            $this->db->where('item_details.item_id',$it);
        }
        return $this->db->get()->result_array();
    }
    public function getDataforshippingpallet($show_id, $teamleader_id)
    {
        if ($teamleader_id == 'all' || $teamleader_id == '') {
            $this->db->select('*');
            $this->db->from('packinglist_request_show');
            // $this->db->where('packinglist_request_show.show_id', $show_id);
            $this->db->where('packinglist_request_show.show_id', $show_id);
            $this->db->where('packinglist_request_show.product_approved_by', $this->aauth->get_user()->id);
            $this->db->where('packinglist_request_show.status', 1);
            $this->db->join('products', 'packinglist_request_show.product_id=products.pid', 'left');
            $this->db->join('item_details', 'products.item_id=item_details.item_id', 'left');
        } else {
            $this->db->select('*');
            $this->db->from('packinglist_request_show');
            // $this->db->where('packinglist_request_show.show_id', $show_id);
            $this->db->where('packinglist_request_show.show_id', $show_id);
            $this->db->where('packinglist_request_show.product_approved_by', $this->aauth->get_user()->id);
            $this->db->where('packinglist_request_show.status', 1);
            $this->db->where('packinglist_request_show.product_requested_by', $teamleader_id);
            $this->db->join('products', 'packinglist_request_show.product_id=products.pid', 'left');
            $this->db->join('item_details', 'products.item_id=item_details.item_id', 'left');
        }


        return $this->db->get()->result_array();
    }

    public function getshowdetail($show_id)
    {
        $this->db->select('*');
        $this->db->from('shows');
        $this->db->where('shows.id', $show_id);

        return $this->db->get()->row();
    }

    public function shipping_invoice_items()
    {
        $this->db->select('*');
        $this->db->from('invoice_items');
        $this->db->join('products', 'invoice_items.pid=products.pid', 'left');
        $this->db->join('product_cat', 'products.pcat=product_cat.id', 'left');
        return $this->db->get()->result_array();
    }

    // public function shipping_labels_data($show_id)
    // {
    // $this->db->select('*');
    // $this->db->from('showbooth');
    // $this->db->where('showbooth.prid',$show_id);
    // $this->db->join('invoices','invoices.booth_id=showbooth.id','left');
    // $this->db->where('invoices.id !=','');
    // $this->db->where('invoices.shipping_option',2);
    // $this->db->join('customers','invoices.customer_id=customers.id','left');
    // return $this->db->get()->result_array();
    // }
    public function shipping_labels_data($show_id)
    {
        $this->db->select('customers.*');
        $this->db->from('customers');
        //$this->db->where('showbooth.prid',$show_id);
        $this->db->join('invoices', 'invoices.customer_id =customers.id', 'left');
        $this->db->where('invoices.shipping_option', 2);
        $this->db->join('shows', 'shows.location_id =invoices.location_id ', 'left');
        $this->db->where('shows.id', $show_id);
        return $this->db->get()->result_array();
    }



    public function getInventoryData($show_id)
    {
        $this->db->select('*');
        $this->db->from('shows');
        $this->db->where('shows.id', $show_id);
        $salesperson_id = $this->db->get()->row();

        $user_id1 = array();
        $user_id = array();

        $user_id1 = explode(',', $salesperson_id->show_assign_to);

        $this->db->select('*');
        $this->db->from('show_request');
        $this->db->where('show_request.show_id', $show_id);
        $this->db->where('show_request.status', 1);
        $result = $this->db->get()->result_array();


        foreach ($result as $teamleaders) {

            $user_id[] = $teamleaders['teamleader_id'];
        }

        $users = array();
        $users = array_merge($user_id1, $user_id);

        $this->db->select('*,shows.id AS show_id,aauth_users.id AS user_id');
        $this->db->from('aauth_users');
        $this->db->where('aauth_users.id !=', $this->aauth->get_user()->id);
        $this->db->join('employee_profile', 'aauth_users.id=employee_profile.id', 'left');
        $this->db->join('shows', 'shows.id=' . $show_id, 'left');
        $this->db->where_in('aauth_users.id', $users);

        return $this->db->get()->result_array();
    }

    public function getinvoicemodaldata($show_id, $user_id)
    {
        $this->db->select('*');
        $this->db->from('aauth_users');
        $this->db->where('aauth_users.id', $user_id);



        $usertype = $this->db->get()->row()->roleid;

        if ($usertype == 2) {
            $this->db->select('*,salesperson_request.product_approve_qty AS qty');
            $this->db->from('salesperson_request');
            $this->db->where('salesperson_request.product_requested_by', $user_id);
            $this->db->where('salesperson_request.show_id', $show_id);
            $this->db->where('salesperson_request.status !=', 0);
            $this->db->join('products', 'salesperson_request.product_id=products.pid', 'left');

            return  $this->db->get()->result_array();
        } else if ($usertype == 3) {



            $this->db->select('*,sum(packinglist_request_show.product_approve_qty) AS qty');
            $this->db->from('packinglist_request_show');
            $this->db->where('packinglist_request_show.show_id', $show_id);
            $this->db->where('packinglist_request_show.product_requested_by', $user_id);
            $this->db->where('packinglist_request_show.status != ', 0);
            $this->db->join('products', 'packinglist_request_show.product_id=products.pid', 'left');
            $this->db->group_by('packinglist_request_show.product_id');


            return $this->db->get()->result_array();
        }
    }
    public function getByPersonSummry($id)
    {
        $array = $this->db->select('sum(total) as totalcollected ,count(total) as salescount, employee_profile.*')
            ->from('invoices')
            ->join('employee_profile', 'employee_profile.id = salesperson_id', 'inner')
            ->join('shows', 'shows.location_id = invoices.location_id', 'inner')
            ->where('shows.id', $id)
            ->group_by('invoices.salesperson_id')
            ->get()->result_array();
        return $array;
    }
    public function getPerPerson($sid, $empid)
    {
        $array = $this->db->select('invoices.*')
            ->from('invoices')
            ->join('shows', 'shows.location_id = invoices.location_id')
            ->where('shows.id', $sid)
            ->where('invoices.salesperson_id', $empid)
            ->get()->result_array();
            // $query = "SELECT invoices.* FROM `invoices` inner join shows on shows.location_id = invoices.location_id where shows.id = '43' and invoices.salesperson_id = '10'";
            // //$array =$query->result_array();
        return $array;
    }
    public function getByProductSummry($id)
    {
        $array = $this->db->select('sum(total) as totalsale ,count(total) as salescount, products.*')
            ->from('invoice_items')
            ->join('products', 'products.pid = invoice_items.pid', 'inner')
            ->join('invoices', 'invoices.tid = invoice_items.tid', 'inner')
            ->join('shows', 'shows.location_id = invoices.location_id', 'inner')
            ->where('shows.id', $id)
            ->group_by('invoice_items.pid')
            ->get()->result_array();
        return $array;
    }
public function getByProductSku($id,$count)
    {
        $array = $this->db->select('sum(total) as totalsale ,count(total) as salescount, products.*')
            ->from('invoice_items')
            ->join('products', 'products.pid = invoice_items.pid', 'inner')
            ->join('invoices', 'invoices.tid = invoice_items.tid', 'inner')
            ->join('shows', 'shows.location_id = invoices.location_id', 'inner')
            ->where('shows.id', $id)
->limit($count, 0)
            ->group_by('invoice_items.pid')
 ->order_by('salescount','desc')
            ->get()->result_array();
        return $array;
    }
    public function getPerProdcut($sid, $pid)
    {
        $array = $this->db->select('invoice_items.*,invoices.id as invoice_number, invoices.invoicedate as billDt')
            ->from('invoice_items')
            ->join('products', 'products.pid = invoice_items.pid', 'inner')
            ->join('invoices', 'invoices.tid = invoice_items.tid', 'inner')
            ->join('shows', 'shows.location_id = invoices.location_id', 'inner')
            ->where('shows.id', $sid)
            ->where('invoice_items.pid', $pid)
          //  ->group_by('invoice_items.pid')
            ->get()->result_array();
        return $array;
    }
}
