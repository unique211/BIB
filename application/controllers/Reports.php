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



class Reports extends CI_Controller

{

    public function __construct()

    {



        parent::__construct();

         $this->load->library("Aauth");

        $this->load->model('reports_model', 'reports');

        $this->load->model('projects_model', 'projects');
        $this->load->model('invoices_model', 'invoice');

        $this->load->model('shows_model','shows');

       

        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');

        }

        if ($this->aauth->get_user()->roleid < 3) {



            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');



        }



    }



    public function index()

    {





    }



    //Statistics



     public function statistics()
    {



        $data['stat'] = $this->reports->statistics();

        $head['title'] = "Statisticst";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/stat', $data);

        $this->load->view('fixed/footer');



    }



    //accounts section



    public function accountstatement()



    {

        $this->load->model('transactions_model');

        $data['accounts'] = $this->transactions_model->acc_list();

        $head['title'] = "Account Statement";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/statement', $data);

        $this->load->view('fixed/footer');



    }



    public function customerstatement()



    {

        $this->load->model('transactions_model');

        $data['accounts'] = $this->transactions_model->acc_list();

        $head['title'] = "Account Statement";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/customer_statement', $data);

        $this->load->view('fixed/footer');



    }



    public function supplierstatement()



    {

        $this->load->model('transactions_model');

        $data['accounts'] = $this->transactions_model->acc_list();

        $head['title'] = "Account Statement";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/supplier_statement', $data);

        $this->load->view('fixed/footer');



    }



    public function viewstatement()



    {

        $this->load->model('accounts_model', 'accounts');

        $pay_acc = $this->input->post('pay_acc');

        $trans_type = $this->input->post('trans_type');

        $sdate = datefordatabase($this->input->post('sdate'));

        $edate = datefordatabase($this->input->post('edate'));

        $ttype = $this->input->post('ttype');

        $account = $this->accounts->details($pay_acc);

        $data['filter'] = array($pay_acc, $trans_type, $sdate, $edate, $ttype, $account['holder']);

        $head['title'] = "Account Statement";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/statement_list', $data);

        $this->load->view('fixed/footer');

    }



    public function customerviewstatement()



    {

        $this->load->model('customers_model', 'customer');

        $cid = $this->input->post('customer');

        $trans_type = $this->input->post('trans_type');

        $sdate = datefordatabase($this->input->post('sdate'));

        $edate = datefordatabase($this->input->post('edate'));

        $ttype = $this->input->post('ttype');

        $customer = $this->customer->details($cid);

        $data['filter'] = array($cid, $trans_type, $sdate, $edate, $ttype, $customer['name']);



        //  print_r( $data['statement']);

        $head['title'] = "Customer Account Statement";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/customerstatement_list', $data);

        $this->load->view('fixed/footer');





    }



    public function supplierviewstatement()



    {

        $this->load->model('supplier_model', 'supplier');

        $cid = $this->input->post('supplier');

        $trans_type = $this->input->post('trans_type');

        $sdate = datefordatabase($this->input->post('sdate'));

        $edate = datefordatabase($this->input->post('edate'));

        $ttype = $this->input->post('ttype');

        $customer = $this->supplier->details($cid);

        $data['filter'] = array($cid, $trans_type, $sdate, $edate, $ttype, $customer['name']);



        //  print_r( $data['statement']);

        $head['title'] = "Supplier Account Statement";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/supplierstatement_list', $data);

        $this->load->view('fixed/footer');





    }





    //



    public function statements()

    {



        $pay_acc = $this->input->post('ac');

        $trans_type = $this->input->post('ty');

        $sdate = datefordatabase($this->input->post('sd'));

        $edate = datefordatabase($this->input->post('ed'));

        $list = $this->reports->get_statements($pay_acc, $trans_type, $sdate, $edate);

        $balance = 0;



        foreach ($list as $row) {

            $balance += $row['credit'] - $row['debit'];

            echo '<tr><td>' . $row['date'] . '</td><td>' . $row['note'] . '</td><td>' . amountFormat($row['debit']) . '</td><td>' . amountFormat($row['credit']) . '</td><td>' . amountFormat($balance) . '</td></tr>';

        }



    }



    public function customerstatements()

    {





        $pay_acc = $this->input->post('ac');

        $trans_type = $this->input->post('ty');

        $sdate = datefordatabase($this->input->post('sd'));

        $edate = datefordatabase($this->input->post('ed'));





        $list = $this->reports->get_customer_statements($pay_acc, $trans_type, $sdate, $edate);

        $balance = 0;



        foreach ($list as $row) {

            $balance += $row['credit'] - $row['debit'];

            echo '<tr><td>' . $row['date'] . '</td><td>' . $row['note'] . '</td><td>' . amountFormat($row['debit']) . '</td><td>' . amountFormat($row['credit']) . '</td><td>' . amountFormat($balance) . '</td></tr>';

        }



    }



    public function supplierstatements()

    {





        $pay_acc = $this->input->post('ac');

        $trans_type = $this->input->post('ty');

        $sdate = datefordatabase($this->input->post('sd'));

        $edate = datefordatabase($this->input->post('ed'));





        $list = $this->reports->get_supplier_statements($pay_acc, $trans_type, $sdate, $edate);

        $balance = 0;



        foreach ($list as $row) {

            $balance += $row['debit'] - $row['credit'];

            echo '<tr><td>' . $row['date'] . '</td><td>' . $row['note'] . '</td><td>' . amountFormat($row['debit']) . '</td><td>' . amountFormat($row['credit']) . '</td><td>' . amountFormat($balance) . '</td></tr>';

        }



    }





    // income section





    public function incomestatement()



    {

        $head['title'] = "Income Statement";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);



        $this->load->model('transactions_model');

        $data['accounts'] = $this->transactions_model->acc_list();

        $data['income'] = $this->reports->incomestatement();





        $this->load->view('reports/incomestatement', $data);





        $this->load->view('fixed/footer');



    }





    public function customincome()

    {



        if ($this->input->post('check')) {

            $acid = $this->input->post('pay_acc');

            $sdate = datefordatabase($this->input->post('sdate'));

            $edate = datefordatabase($this->input->post('edate'));



            $date1 = new DateTime($sdate);

            $date2 = new DateTime($edate);



            $diff = $date2->diff($date1)->format("%a");

            if ($diff < 90) {

                $income = $this->reports->customincomestatement($acid, $sdate, $edate);



                echo json_encode(array('status' => 'Success', 'message' => 'Calculated', 'param1' => '<b>Income between the dates is ' . amountFormat(floatval($income['credit'])) . '</b>'));

            } else {

                echo json_encode(array('status' => 'Error', 'message' => 'Date range should be within 90 days', 'param1' => ''));

            }



        }

    }



    // expense section





    public function expensestatement()

    {

        $id = $this->input->get('id');

        $explore = $this->shows->explore($id);

        $data['project'] = $explore['project'];

        $head['title'] = "Expense Statement";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->model('transactions_model');

        $data['accounts'] = $this->transactions_model->acc_list();

        $data['income'] = $this->reports->expensestatement();

        $this->load->view('reports/expensestatement', $data);

        $this->load->view('fixed/footer');



    }





    public function customexpense()

    {



        if ($this->input->post('check')) {

            $acid = $this->input->post('pay_acc');

            $sdate = datefordatabase($this->input->post('sdate'));

            $edate = datefordatabase($this->input->post('edate'));



            $date1 = new DateTime($sdate);

            $date2 = new DateTime($edate);



            $diff = $date2->diff($date1)->format("%a");

            if ($diff < 90) {

                $income = $this->reports->customexpensestatement($acid, $sdate, $edate);



                echo json_encode(array('status' => 'Success', 'message' => 'Calculated', 'param1' => '<b>Expense between the dates is ' . amountFormat(floatval($income['debit'])) . '</b>'));

            } else {

                echo json_encode(array('status' => 'Error', 'message' => 'Date range should be within 90 days', 'param1' => ''));

            }



        }



    }





    public function refresh_data()



    {





        $head['title'] = "Refreshing Reports";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/refresh_data');

        $this->load->view('fixed/footer');



    }



    public function refresh_process()



    {



        $this->load->model('cronjob_model');

        if ($this->cronjob_model->reports()) {



            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Calculated')));

        }



    }



    public function taxstatement()



    {

        $this->load->model('transactions_model');

        $data['accounts'] = $this->transactions_model->acc_list();

        $head['title'] = "TAX Statement";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/tax_statement', $data);

        $this->load->view('fixed/footer');



    }



    public function taxviewstatement()



    {





        $trans_type = $this->input->post('ty');

        $sdate = datefordatabase($this->input->post('sdate'));

        $edate = datefordatabase($this->input->post('edate'));



        $data['filter'] = array($sdate, $edate, $trans_type);



        //  print_r( $data['statement']);

        $head['title'] = "TAX Statement";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/tax_out', $data);

        $this->load->view('fixed/footer');





    }



    public function consignmentlist()

    {

        $head['title'] = "Consignmnet List";

        $head['usernm'] = $this->aauth->get_user()->username;

        $data['show_list']=$this->shows->show_list();

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/consignmentlist',$data);

        $this->load->view('fixed/footer');

    }
    
    public function getTeamleaderfoconsignment()
    {
        $show_id=$this->input->get('show_id');

     

        $data=$this->shows->getApprovedTeamLeaderForSale($show_id);

        echo json_encode($data);
    }



    public function calculating_shipping_pallet()

    {

        $head['title'] = "Calculation of shipping pallet";

        $head['usernm'] = $this->aauth->get_user()->username;

        $data['show_list']=$this->shows->show_list();

        $this->load->view('fixed/header', $head);       
       
        $this->load->view('reports/calculation_shipping_pallet',$data); 

            if($this->input->post())
            {

                $show_id=$this->input->post('show_id');
                $teamleader_id=$this->input->post('teamleader_id');

                $data['show_details']=$this->reports->getshowdetail($show_id);
              
                $data['shipping_pallet']=$this->reports->getDataforshippingpallet($show_id,$teamleader_id);

                $data['product_category']=$this->reports->get_product_category();

                $this->load->view('reports/shipping_pallet_calculation_data',$data); 

            }
        

        $this->load->view('fixed/footer');

    }

public function show_sales123()
    {
		//$data=$this->reports->getshowdetail('44');
		$data=$this->reports->shipping_labels_data('44');
		//$data['invoice_item_details']=$this->reports->shipping_invoice_items();
		echo json_encode($data);
	}

    // public function show_sales()
    // {
	// 	$head['title'] = "Sales Label Show";

	// 		$head['usernm'] = $this->aauth->get_user()->username;

	// 		 $data['show_list']=$this->shows->show_list();


	// 		$this->load->view('fixed/header', $head);

	// 		$this->load->view('reports/sales_labels',$data);
			
    //     if($this->input->post())
    //     {
    //         $show_id=$this->input->post('show_id');


    //         $data['show_details']=$this->reports->getshowdetail($show_id);

            

    //         $data['shipping_pallet_data']=$this->reports->shipping_labels_data($show_id);


    //         $data['invoice_item_details']=$this->reports->shipping_invoice_items();



    //             $this->load->view('reports/sales_label_data',$data);
    //     }

    //     $this->load->view('fixed/footer');

    // }
    public function test()
    {
        $show_id="47";
        $data=$this->reports->getboothdetails($show_id);
        echo "<br/>==================data===========================<br/>";
echo json_encode(($data));
        echo "<br/>==================datewithsales===========================<br/>";
echo json_encode(($data['datewithsales']));
        echo "<br/>==================datewithsalesforcredit===========================<br/>";
echo json_encode(($data['datewithsalesforcredit']));
echo "<br/>====================boothdetail=========================<br/>";
echo json_encode(($data['boothdetail']));
echo "<br/>=========================totalsalesperson====================<br/>";
echo json_encode($data['totalsalesperson']);
echo "<br/>===================totaldate==========================<br/>";
echo($data['totaldate']);
echo "<br/>=====================totaldate========================<br/>";
echo($data['totaldate'] == '');
echo "<br/>==========================totalsalesperson===================<br/>";
echo($data['totalsalesperson']);
echo "<br/>=============================================<br/>";
    }
    public function show_sales()
    {
		$head['title'] = "Sales Label Show";

			$head['usernm'] = $this->aauth->get_user()->username;

			 $data['show_list']=$this->shows->show_list();


			$this->load->view('fixed/header', $head);

			$this->load->view('reports/sales_labels',$data);
			
        if($this->input->post())
        {
            $show_id=$this->input->post('show_id');
            $sales_radio=$this->input->post('sales_radio');


            $data['show_id'] = $show_id;
            $data['sales_radio'] = $sales_radio;
            if($sales_radio=='1'){
                $data['show_details']=$this->reports->getByPersonSummry($show_id);
                $this->load->view('reports/sales_label_data',$data);
            }else  if($sales_radio=='2'){
                $data['show_details']=$this->reports->getByProductSummry($show_id);
                $this->load->view('reports/sales_label_data_product',$data);
            }else{
if($sales_radio=='3'){
$count=5;
}else{
$count=10;
}
                $data['show_details']=$this->reports->getByProductSku($show_id,$count);
                $this->load->view('reports/sales_label_data_sku',$data);
            }
            

            
 
            // $data['shipping_pallet_data']=$this->reports->shipping_labels_data($show_id);


            // $data['invoice_item_details']=$this->reports->shipping_invoice_items();



                
        }

        $this->load->view('fixed/footer');

    }

    public function getByPersonData(){
        $empid = $this->input->post('eid');
        $sid = $this->input->post('sid');
        
        $data = $this->reports->getPerPerson($sid, $empid);
        echo json_encode($data);
    }
    public function getPerProdcut(){
        $pid = $this->input->post('pid');
        $sid = $this->input->post('sid');
        
        $data = $this->reports->getPerProdcut($sid, $pid);
        echo json_encode($data);
    }


     public function store_sales()

    {

        $head['title'] = "Shipment Label Store";

        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/shipment_labels_store');

        $this->load->view('fixed/footer');

    }

    public function item_report(){
        $head['title'] = "Item Report";

        $head['usernm'] = $this->aauth->get_user()->username;

        $data['product_catagory']=$this->reports->get_product_category();

        $this->load->view('fixed/header', $head);

       
        if($this->input->post())
        {
            $pcat = $this->input->post('product_cat');
            $it = $this->input->post('item');
            $data['item'] = $this->reports->get_items($pcat);
            // if($it!="0")
            $data['item_data']= $this->reports->getAllProductByItem($pcat,$it);
            $data['cid']= $pcat;
            $data['item_id'] = $it;
            // else
            // $data['item_data']= $this->reports->getAllProductByItem($pcat,$it);
            $this->load->view('reports/item_report',$data);
            $this->load->view('reports/item_data',$data);
        }else{
            $this->load->view('reports/item_report',$data);
        }
        $this->load->view('fixed/footer');

    }
    public function item_cat(){
        $pcat = $this->input->post('pcat');
        echo json_encode($this->reports->get_items($pcat));
    }
    

    public function commission_report()

    {

        $head['title'] = "Commission Report";

        $head['usernm'] = $this->aauth->get_user()->username;

        $data['show_list']=$this->shows->show_list();

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/commission_report',$data);

        

        if($this->input->post())
        {
             $show_id=$this->input->post('show_id');

            $data=$this->reports->getboothdetails($show_id);

            if($data==12)
            {
                 $this->load->view('reports/displaymessage',$data);
            }
            else
            {
                if((count($data['boothdetail'][0])==0) OR $data['totalsalesperson']==0 OR $data['totaldate']==0 OR $data['totaldate'] == '' OR $data['totalsalesperson'] == '')
                {
                    $this->load->view('reports/displaymessage',$data);
                }
                else{
                     $this->load->view('reports/commision_data',$data);
                } 
            }

                       
        }

        $this->load->view('fixed/footer');

    }



    public function taxviewstatements_load()

    {





        $trans_type = $this->input->post('ty');

        $sdate = datefordatabase($this->input->post('sd'));

        $edate = datefordatabase($this->input->post('ed'));



if($trans_type=='Sales') {

    $where = " WHERE DATE(invoices.invoicedate) BETWEEN '$sdate' AND '$edate' ";

    $query = $this->db->query("SELECT customers.taxid AS VAT_Number,invoices.tid AS invoice_number,invoices.total AS amount,invoices.tax AS tax,customers.name AS customer_name,customers.company AS Company_Name,invoices.invoicedate AS date FROM invoices LEFT JOIN customers ON invoices.csd=customers.id" . $where);

}

else

{



    $where = " WHERE (DATE(purchase.invoicedate) BETWEEN '$sdate' AND '$edate') ";

    $query = $this->db->query("SELECT supplier.taxid AS VAT_Number,purchase.tid AS invoice_number,purchase.total AS amount,purchase.tax AS tax,supplier.name AS customer_name,supplier.company AS Company_Name,purchase.invoicedate AS date FROM purchase LEFT JOIN supplier ON purchase.csd=supplier.id" . $where);

}





//echo $where;





        $balance = 0;



        foreach ($query->result_array() as $row) {

            $balance += $row['tax'];

            echo '<tr><td>' . $row['invoice_number'] . '</td><td>' . $row['customer_name'] . '</td><td>' . $row['VAT_Number'] . '</td><td>' . amountFormat($row['amount']) . '</td><td>' . amountFormat($row['tax']) . '</td><td>' . amountFormat($balance) . '</td></tr>';

        }

    }



     public function inventory_report()

    {

        $head['title'] = "Inventory Report";

        $head['usernm'] = $this->aauth->get_user()->username;

        $data['show_list']=$this->shows->show_list();

        $this->load->view('fixed/header', $head);

        $this->load->view('reports/inventoryreport',$data);

        $this->load->view('fixed/footer');

    }


    //get Consignment report data

    public function getReportDataforconsignment()
    {

        $show_id= $this->input->post('show_id');
        $teamleader_id= $this->input->post('teamleader_id');

        $data=$this->reports->getDataforconsignment($show_id,$teamleader_id);

       echo json_encode($data);


    }

    //get booth details and salespersondetails for commission report 

    public function getBoothDetails()
    {
        $show_id=$this->input->post('show_id');

        $details=$this->reports->getboothdetails($show_id);

        echo json_encode($details);

    }

    //check commission report data

    public function check()
    {

        if($this->input->post())
        {
             $head['title'] = "Commission Report";

            $head['usernm'] = $this->aauth->get_user()->username;
            
            $show_id=$this->input->post('show_id');

            $data=$this->reports->getboothdetails($show_id);

            $this->load->view('fixed/header', $head);

            $this->load->view('reports/commision_data',$data);

            $this->load->view('fixed/footer');

             
        }
        else{

             $head['title'] = "Inventory Report";

             $data['show_list']=$this->shows->show_list();

                $head['usernm'] = $this->aauth->get_user()->username;

                $this->load->view('fixed/header', $head);

                $this->load->view('reports/commision_data',$data);

                $this->load->view('fixed/footer');

        }
       

       

     
    }

    public function getInventorydetails()
    {
        $show_id=$this->input->post('show_id');

        $data=$this->reports->getInventoryData($show_id);

        echo json_encode($data);

    }

      public function getinvoicemodaldata()
    {

        $show_id=$this->input->post('show_id');
        $user_id=$this->input->post('user_id');

        $data=$this->reports->getinvoicemodaldata($show_id,$user_id);

        echo json_encode($data);


    }
    //arzoo for top selling report
    public function topSellingProducts(){
        $show_id = $this->input->post('show_id');
        if(!isset($show_id))
            $show_id = 0;
        $head['title'] = "Top Selling Products";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['products'] = $this->invoice->getTopSelling($show_id);
        $data['show_list']=$this->shows->show_list();
        $this->load->view('fixed/header', $head);

        $this->load->view('reports/top_selling_product',$data);
        $this->load->view('reports/display_topproduct',$data);

        $this->load->view('fixed/footer');
    }


}
