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



class Employee extends CI_Controller

{

    public function __construct()
    {

        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        $this->load->library("Aauth");


        $this->load->model('employee_model', 'employee');
        $this->load->model('Products_model', 'products');




        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');
        }

        if ($this->aauth->get_user()->roleid < 5) {

            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
    }



    public function index()

    {

        $head['usernm'] = $this->aauth->get_user()->username;

        $head['title'] = 'Employees List';

        $data['employee'] = $this->employee->list_employee();

        $this->load->view('fixed/header', $head);

        $this->load->view('employee/list', $data);

        $this->load->view('fixed/footer');
    }





    public function view()

    {

        $id = $this->input->get('id');

        $head['usernm'] = $this->aauth->get_user()->username;

        $head['title'] = 'Employee Details';

        $data['employee'] = $this->employee->employee_details($id);

        $data['eid'] = intval($id);

        $this->load->view('fixed/header', $head);

        $this->load->view('employee/view', $data);

        $this->load->view('fixed/footer');
    }





    public function add()

    {



        $head['usernm'] = $this->aauth->get_user()->username;

        $head['title'] = 'Add Employee';
        $data['employee'] = $this->getEmployeeAPI();


        $this->load->view('fixed/header', $head);

        $this->load->view('employee/add', $data);

        $this->load->view('fixed/footer');
    }



    public function submit_user()

    {

        if ($this->aauth->get_user()->roleid < 4) {

            redirect('/dashboard/', 'refresh');
        }



        $username = $this->input->post('username');

        $employee = $this->input->post('employee');

        $email = $this->input->post('email');

        $password = $this->input->post('password');

        $roleid = 3;

        if ($this->input->post('roleid')) {

            $roleid = $this->input->post('roleid');
        }



        if ($roleid > 3) {

            if ($this->aauth->get_user()->roleid < 5) {

                die('No! Permission');
            }
        }


        $name = $this->input->post('name');

        $phone = $this->input->post('phone');


        $email = $this->input->post('email');


        $address = $this->input->post('address');

        $city = $this->input->post('city');


        $region = $this->input->post('region');
        $state = $this->input->post('state');
        $zipcode = $this->input->post('zipcode');
        $selection = $this->input->post('selection');
        $account_number = $this->input->post('account_number');
        $phone_no = $this->input->post('ph_no');
        $referred_by = $this->input->post('referred_by');
    //    // echo $this->input->post('selection'). ' Hi';
    // echo json_encode(array('status' => 'Error', 'message' =>

    //     'There has been an error, please try again .'.$employee ));
       $a = $this->aauth->create_user($email, $password, $username);
        if($selection =="new"){
            $emp_id = $this->createEmployeeAPI($name, $email);
            $employee = $emp_id;
        }
    //     
    //     $a = '10';


        if ((string) $this->aauth->get_user($a)->id != $this->aauth->get_user()->id) {

            $nuid = (string) $this->aauth->get_user($a)->id;

            $user_role = (string) $this->aauth->get_user($a)->roleid;

            if ($nuid > 0) {




                if ($roleid == 3) {

                    $warehouse_name = $name . " warehouse";
                    $warehouse_desciption = "This waarehouse is assign to team leader :  " . $name;
                    $warehouse_type = 3;
                    $userid = $nuid;
                    $this->products->assignvarehousetotl($warehouse_name, $warehouse_desciption, $warehouse_type, $userid);
                }

                $this->employee->add_employee($nuid, (string) $this->aauth->get_user($a)->username, $name, $roleid, $phone, $address, $city, $region, $account_number, $employee,$phone_no,$referred_by,$state,$zipcode);
            }
        } else {

            echo json_encode(array('status' => 'Error', 'message' =>

            'There has been an error, please try again .'));
        }
    }



    public function invoices()

    {

        $id = $this->input->get('id');

        $head['usernm'] = $this->aauth->get_user()->username;

        $head['title'] = 'Employee Invoices';

        $data['employee'] = $this->employee->employee_details($id);

        $data['eid'] = intval($id);

        $this->load->view('fixed/header', $head);

        $this->load->view('employee/invoices', $data);

        $this->load->view('fixed/footer');
    }



    public function invoices_list()

    {



        $eid = $this->input->post('eid');

        $list = $this->employee->invoice_datatables($eid);

        $data = array();



        $no = $this->input->post('start');





        foreach ($list as $invoices) {

            $no++;

            $row = array();

            $row[] = $no;

            $row[] = $invoices->tid;

            $row[] = $invoices->name;

            $row[] = $invoices->invoicedate;

            $row[] = amountFormat($invoices->total);

            switch ($invoices->status) {

                case "paid":

                    $out = '<span class="label label-success">Paid</span> ';

                    break;

                case "due":

                    $out = '<span class="label label-danger">Due</span> ';

                    break;

                case "canceled":

                    $out = '<span class="label label-warning">Canceled</span> ';

                    break;

                case "partial":

                    $out = '<span class="label label-primary">Partial</span> ';

                    break;

                default:

                    $out = '<span class="label label-info">Pending</span> ';

                    break;
            }

            $row[] = $out;

            $row[] = '<a href="' . base_url("invoices/view?id=$invoices->tid") . '" class="btn btn-success btn-xs"><i class="icon-file-text"></i> View</a> &nbsp; <a href="' . base_url("invoices/printinvoice?id=$invoices->tid") . '&d=1" class="btn btn-info btn-xs"  title="Download"><span class="icon-download"></span></a>&nbsp; &nbsp;<a href="#" data-invoice-id="' . $invoices->tid . '" class="btn btn-danger btn-xs delete-invoice" title="Delete"><i class="icon-trash-o"></i></a>';



            $data[] = $row;
        }



        $output = array(

            "draw" => $_POST['draw'],

            "recordsTotal" => $this->employee->invoicecount_all($eid),

            "recordsFiltered" => $this->employee->invoicecount_filtered($eid),

            "data" => $data,

        );

        //output to json format

        echo json_encode($output);
    }



    public function transactions()

    {

        $id = $this->input->get('id');

        $head['usernm'] = $this->aauth->get_user()->username;

        $head['title'] = 'Employee Transactions';

        $data['employee'] = $this->employee->employee_details($id);

        $data['eid'] = intval($id);

        $this->load->view('fixed/header', $head);

        $this->load->view('employee/transactions', $data);

        $this->load->view('fixed/footer');
    }



    public function translist()

    {

        $eid = $this->input->post('eid');

        $list = $this->employee->get_datatables($eid);

        $data = array();

        $no = $this->input->post('start');

        foreach ($list as $prd) {

            $no++;

            $row = array();

            $pid = $prd->id;

            $row[] = $prd->date;

            $row[] = $prd->account;

            $row[] = amountFormat($prd->debit);

            $row[] = amountFormat($prd->credit);



            $row[] = $prd->payer;

            $row[] = $prd->method;

            $row[] = '<a href="' . base_url() . 'transactions/view?id=' . $pid . '" class="btn btn-primary btn-xs"><span class="icon-eye"></span> View</a> <a data-item-id="' . $pid . '" class="btn btn-danger btn-xs delete-transaction"><span class="icon-bin"></span>Delete</a>';

            $data[] = $row;
        }



        $output = array(

            "draw" => $_POST['draw'],

            "recordsTotal" => $this->employee->count_all(),

            "recordsFiltered" => $this->employee->count_filtered(),

            "data" => $data,

        );

        //output to json format

        echo json_encode($output);
    }





    function disable_user()

    {

        if (!$this->aauth->get_user()->roleid == 5) {

            redirect('/dashboard/', 'refresh');
        }

        $uid = intval($this->input->post('deleteid'));



        $nuid = intval($this->aauth->get_user()->id);



        if ($nuid == $uid) {

            echo json_encode(array('status' => 'Error', 'message' =>

            'You can not disable yourself!'));
        } else {





            $a = $this->aauth->ban_user($uid);



            echo json_encode(array('status' => 'Success', 'message' =>

            'User Profile disabled successfully!'));
        }
    }



    function delete_user()

    {

        if (!$this->aauth->get_user()->roleid == 5) {

            redirect('/dashboard/', 'refresh');
        }

        $uid = intval($this->input->post('empid'));



        $nuid = intval($this->aauth->get_user()->id);



        if ($nuid == $uid) {

            echo json_encode(array('status' => 'Error', 'message' =>

            'You can not delete yourself!'));
        } else {



            $this->db->delete('employee_profile', array('id' => $uid));



            $this->db->delete('aauth_users', array('id' => $uid));



            echo json_encode(array('status' => 'Success', 'message' =>

            'User Profile deleted successfully! Please refresh the page!'));
        }
    }





    public function calc_income()

    {

        $eid = $this->input->post('eid');



        if ($this->employee->money_details($eid)) {

            $details = $this->employee->money_details($eid);



            echo json_encode(array('status' => 'Success', 'message' =>

            '<br> Total Income: ' . $details['credit'] . '<br> Total Expenses: ' . $details['debit']));
        }
    }



    public function calc_sales()

    {

        $eid = $this->input->post('eid');



        if ($this->employee->sales_details($eid)) {

            $details = $this->employee->sales_details($eid);



            echo json_encode(array('status' => 'Success', 'message' =>

            'Total Sales (Paid Payment):  ' . $details['total']));
        }
    }



    public function update()

    {

        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');
        }





        $id = $this->input->get('id');

        $this->load->model('employee_model', 'employee');

        if ($this->input->post()) {

            $eid = $this->input->post('eid');

            $name = $this->input->post('name');

            $phone = $this->input->post('phone');

            $phonealt = $this->input->post('phonealt');

            $address = $this->input->post('address');

            $city = $this->input->post('city');

            $region = $this->input->post('region');

            
            $zipcode = $this->input->post('zipcode');
            
            $state = $this->input->post('state');

            $country = $this->input->post('country');

            $postbox = $this->input->post('postbox');

            $this->employee->update_employee($eid, $name, $phone, $phonealt, $address, $city, $region, $country, $postbox, $zipcode,$state);
        } else {

            $head['usernm'] = $this->aauth->get_user($id)->username;

            $head['title'] = $head['usernm'] . ' Profile';





            $data['user'] = $this->employee->employee_details($id);

            $data['eid'] = intval($id);

            $this->load->view('fixed/header', $head);

            $this->load->view('employee/edit', $data);

            $this->load->view('fixed/footer');
        }
    }





    public function displaypic()

    {



        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');
        }



        $this->load->model('employee_model', 'employee');

        $id = $this->input->get('id');

        $this->load->library("uploadhandler", array(

            'accept_file_types' => '/\.(gif|jpe?g|png)$/i', 'upload_dir' => FCPATH . 'userfiles/employee/'

        ));

        $img = (string) $this->uploadhandler->filenaam();

        if ($img != '') {

            $this->employee->editpicture($id, $img);
        }
    }





    public function user_sign()

    {

        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');
        }





        $this->load->model('employee_model', 'employee');

        $id = $this->input->get('id');

        $this->load->library("uploadhandler", array(

            'accept_file_types' => '/\.(gif|jpe?g|png)$/i', 'upload_dir' => FCPATH . 'userfiles/employee_sign/'

        ));

        $img = (string) $this->uploadhandler->filenaam();

        if ($img != '') {

            $this->employee->editsign($id, $img);
        }
    }





    public function updatepassword()

    {



        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');
        }

        $this->load->library("form_validation");



        $id = $this->input->get('id');

        $this->load->model('employee_model', 'employee');





        if ($this->input->post()) {

            $eid = $this->input->post('eid');

            $this->form_validation->set_rules('newpassword', 'Password', 'required');

            $this->form_validation->set_rules('renewpassword', 'Confirm Password', 'required|matches[newpassword]');

            if ($this->form_validation->run() == FALSE) {

                echo json_encode(array('status' => 'Error', 'message' => '<br>Rules<br> Password length should  be at least 6 [a-z-0-9] allowed!<br>New Password & Re New Password should be same!'));
            } else {



                $newpassword = $this->input->post('newpassword');





                echo json_encode(array('status' => 'Success', 'message' => 'Password Updated Successfully!'));



                $this->aauth->update_user($eid, false, $newpassword, false);
            }
        } else {

            $head['usernm'] = $this->aauth->get_user()->username;

            $head['title'] = $head['usernm'] . ' Profile';





            $data['user'] = $this->employee->employee_details($id);

            $data['eid'] = intval($id);

            $this->load->view('fixed/header', $head);

            $this->load->view('employee/password', $data);

            $this->load->view('fixed/footer');
        }
    }



    public function notes()

    {

        $id = $this->input->get('id');

        $head['usernm'] = $this->aauth->get_user()->username;

        $head['title'] = 'Employee Notes';

        $data['employee'] = $this->employee->employee_details($id);

        $data['eid'] = intval($id);

        $this->load->view('fixed/header', $head);

        $this->load->view('employee/notes', $data);

        $this->load->view('fixed/footer');
    }



    public function addnotes()

    {

        $id = $this->input->get('id');

        $head['usernm'] = $this->aauth->get_user()->username;

        $head['title'] = 'Employee Notes';

        $data['employee'] = $this->employee->employee_details($id);

        $data['eid'] = intval($id);

        $this->load->view('fixed/header', $head);

        $this->load->view('employee/addnotes', $data);

        $this->load->view('fixed/footer');
    }



    public function editnotes()

    {

        $id = $this->input->get('id');

        $head['usernm'] = $this->aauth->get_user()->username;

        $head['title'] = 'Employee Notes';

        $data['employee'] = $this->employee->employee_details($id);

        $data['eid'] = intval($id);

        $this->load->view('fixed/header', $head);

        $this->load->view('employee/editnotes', $data);

        $this->load->view('fixed/footer');
    }

    //employee code -- arzoo
    function getEmployeeAPI($id = '0')
    {
        //  echo 'hi';
        $employees_db = $this->employee->getAllEmployee();
        $path = APPPATH . 'third_party/connect-php-sdk/autoload.php';
        //   echo $path;
        //   print_r($employees_db);
        require_once($path);
        $this->config->load('api_config');

        $token = $this->config->item('square_token');
        // Configure OAuth2 access token for authorization: oauth2
        SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($token);
        # create an instance of the Location API
        $employee_api = new SquareConnect\Api\EmployeesApi();

        try {
            $employees = $employee_api->listEmployees();

            $data = array();
            foreach ($employees->getEmployees() as $key => $value) {
                if ((!in_array($value['id'], $employees_db)) || ($id == $value['id'])) {
                    array_push($data, ['id' => $value['id'], 'name' => ($value['first_name'] . ' ' . $value['last_name'])]);
                }
            }
            //  print_r($data);
            return ($data);
        } catch (\SquareConnect\ApiException $e) {

            return 0;
        }
    }
    //create employee code -  arzoo
    function createEmployeeAPI($name , $email)
    {
        
        $tname = explode(" ", $name);//print_r($tname);
        $fname = isset($tname[0]) ? $tname[0] : '';//$tname[0];
        $lname = isset($tname[1]) ? $tname[1] : '';
        
        $path = APPPATH . 'third_party/connect-php-sdk/autoload.php';
          // echo $path;
        //   print_r($employees_db);
        require_once($path);
        $this->config->load('api_config');

        $token = $this->config->item('square_token');
        // Configure OAuth2 access token for authorization: oauth2
        SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($token);
        $api_instance = new SquareConnect\Api\V1EmployeesApi();
        $body = new \SquareConnect\Model\V1Employee(); // \SquareConnect\Model\V1Employee | An object containing the fields to POST for the request.  See the corresponding object definition for field details.
       // $body->setId('9000');
        $body->setFirstName($fname);
        $body->setLastName($lname);
        // $body->setRoleIds('1');
        // $body->setAuthorizedLocationIds('');
        $body->setEmail($email);
        //$body->setStatus('ACTIVE');
        //$body->setExternalId('');


        try {
            $result = $api_instance->createEmployee($body);
            // print_r($result);
            return $result['id'];
        } catch (Exception $e) {
            // echo 'Exception when calling V1EmployeesApi->createEmployee: ', $e->getMessage(), PHP_EOL;
            return "problem";
        }
    }
}
