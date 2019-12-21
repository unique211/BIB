<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class RetriveAPI extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $path = APPPATH . 'third_party/connect-php-sdk/autoload.php';
        // echo $path;
        require_once($path);
        $this->load->model('Customers_model', 'cust');
        $this->load->model('Invoices_model', 'invoice');
        $this->load->model('Employee_model', 'employee');
        $this->load->model('Products_model', 'product');
        $this->load->model('Accounts_model', 'account');
        $this->load->model('shows_model', 'shows');

        $this->config->load('api_config');

        $token = $this->config->item('square_token');
        SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($token);
        set_time_limit(0);
    }
    public function index()
    {
        // echo 'welcome user';
        // echo base_url();
    }
    public function getOrderDetails()
    {
        echo 'hi';
        $start_time = time();
        echo $start_time;
        $order_lst = array();
        $trans_lst = array();
        $pay_lst = array();
        $emp = array();
        $loc_ids = $this->shows->getAllLocations();
        foreach ($loc_ids as $locd_id) {
            //search order
            $loc_id = array($locd_id); //["225QW2PSVE88V"];
            $api_instance = new SquareConnect\Api\OrdersApi();
            $body = new \SquareConnect\Model\SearchOrdersRequest(); // \SquareConnect\Model\SearchOrdersRequest | An object containing the fields to POST for the request.  See the corresponding object definition for field details.
            $body->setLocationIds($loc_id);
            try {
                $result = $api_instance->searchOrders($body);
                $obj = json_decode($result);
                echo "\n=======================start=============================\n";


                foreach ($obj as $key => $value) {
                    // print_r($key);
                    echo "\n order start \n";
                    // print_r($value);
                    // echo "\n\n";
                    if (is_array($value)) {
                        $inner = $value;
                        foreach ($inner as $key => $value) {
                            $str = '';
                            print_r("\nkey " . $key);
                            // echo "\n value \n";
                            // echo json_encode($value);
                            echo "\n\n";
                            //print_r('$value->id ' . $value->id . '\n');
                            //print_r('$value->location_id ' . $value->location_id . '\n');
                            // print_r("\n" . empty($value->returns) . "\n");
                            if (empty($value->returns)) {


                                //transaction

                                $api_instance = new SquareConnect\Api\TransactionsApi();
                                $location_id = $value->location_id; // string | The ID of the payment's associated location.
                                $transaction_id = $value->id; // string | The ID of the transaction to retrieve.
                                $payment_id = "";
                                $isshiping = "";
                                $pmode = "";
                                $tamount = "";
                                $emp_id = "";
                                $pamount = 0;
                                $e_id = "";
                                $amnt = 0;
                                echo '<br/>details<br/>'.$loc_id.' '.$location_id.' '.$transaction_id.'<br/><br/>';
                                try {
                                    $tresult = $api_instance->retrieveTransaction($location_id, $transaction_id);
                                    // echo "\n6666";
                                    $payment_id = $tresult["transaction"]["tenders"][0]["id"];
                                    if (empty($tresult["transaction"]["shipping_address"]))
                                        $isshiping = 1;
                                    else
                                        $isshiping = 2;
                                    if ($tresult["transaction"]["tenders"][0]["type"] == "CARD")
                                        $pmode = 2;
                                    else
                                        $pmode = 1;
                                    $tamount = $tresult["transaction"]["tenders"][0]["amount_money"]["amount"];

                                    //payment
                                    $api_instance = new SquareConnect\Api\V1TransactionsApi();
                                    // // $location_id = "PGN2MMZCK1Q2Q"; // string | The ID of the payment's associated location.
                                    // // $payment_id = "8Q3e2ZgsnUJzsPsE4V9NVyMF"; // string | The Square-issued payment ID. payment_id comes from Payment objects returned by the List Payments endpoint, Settlement objects returned by the List Settlements endpoint, or Refund objects returned by the List Refunds endpoint.

                                    try {
                                        $presult = $api_instance->retrievePayment($location_id, $payment_id);
                                        // echo $presult;
                                        foreach ($presult["itemizations"] as $k => $v) {
                                            $itm_nm = $v['item_variation_name'];
                                            $item_lst[$itm_nm] = $v['item_detail']['item_variation_id'];
                                        }
                                        if ($presult["tender"][0]["type"] == "CASH") {
                                            $emp_id = $presult["tender"][0]["employee_id"];
                                            $e_id = $emp_id;
                                            $amnt = $presult["net_total_money"]["amount"];
                                            if (isset($emp[$emp_id])) {
                                                
                                                $emp[$emp_id] = $emp[$emp_id] + $amnt;
                                            } else {
                                                $emp[$emp_id] = $amnt;
                                            }
                                            $pamount += $presult["net_total_money"]["amount"];
                                        }else{
                                            $emp_id = $presult["tender"][0]["employee_id"];

                                            if (isset($emp[$emp_id])) {
                                                $emp[$emp_id] = $emp[$emp_id] + 0;
                                            } else {
                                                $emp[$emp_id] = 0;
                                            }
                                            
                                        }
                                        // echo "\n88888";
                                    } catch (Exception $e) {
                                        // echo "\n99999";
                                        echo 'Exception when calling V1TransactionsApi->retrievePayment: ', $e->getMessage(), PHP_EOL;
                                    }
                                    echo "\n\n====================================================Payment Details====================================================\n\n";
                                } catch (Exception $e) {
                                    // echo "\nBBBBB</b>";
                                    echo 'Exception when calling TransactionsApi->retrieveTransaction: ', $e->getMessage(), PHP_EOL;
                                }
                                echo "<br/><br/>";
                                print_r($item_lst);
                                echo "<br/><br/>";
                                //get customer 
                                if (isset($value->tenders[0]->customer_id)) {
                                    // print_r('customer_id:' . $value->customer_id . '\n');
                                    $api_instance = new SquareConnect\Api\CustomersApi();
                                    $customer_id = str_replace(' ', '', $value->tenders[0]->customer_id); //"0WETWDSFQ926X3WJNFNJGG9P0R"; // string | The ID of the customer to retrieve.

                                    try {
                                        $result1 = $api_instance->retrieveCustomer($customer_id);
                                        echo "\n====================================================customer details==================================================== \n";
                                        // echo ($result1);
                                        //start
                                        $data = array(
                                            'name' => $result1['customer']['given_name'] . ' ' . $result1['customer']['family_name'],
                                            'company' => $result1['customer']['company_name'],
                                            'phone' => $result1['customer']['phone_number'],
                                            'email' => $result1['customer']['email_address'],
                                            'address' => $result1['customer']['address']['address_line_1'] . ' ' . $result1['customer']['address']['address_line_2'],
                                            'city' => $result1['customer']['address']['locality'],
                                            'region' => $result1['customer']['address']['administrative_district_level_1'],
                                            'country' => '',
                                            'postbox' => $result1['customer']['address']['postal_code'],
                                            'gid' => isset($result1['customer']['address']['groups']) ? $result1['customer']['address']['groups'] : '',
                                            'taxid' => '',
                                            'name_s' => $result1['customer']['given_name'] . ' ' . $result1['customer']['family_name'],
                                            'phone_s' => $result1['customer']['phone_number'],
                                            'email_s' => $result1['customer']['email_address'],
                                            'address_s' => $result1['customer']['address']['address_line_1'] . ' ' . $result1['customer']['address']['address_line_2'],
                                            'city_s' => $result1['customer']['address']['locality'],
                                            'region_s' => $result1['customer']['address']['administrative_district_level_1'],
                                            'country_s' => '',
                                            'postbox_s' => $result1['customer']['address']['postal_code'],
                                            'customers_id' => $result1['customer']['id'],
                                            'extra_fields' => $result1,
                                        );
                                        $cust_id = $this->cust->insert_api('customers', $data);
                                        //end

                                    } catch (Exception $e) {
                                        echo 'Exception when calling CustomersApi->retrieveCustomer: ', $e->getMessage(), PHP_EOL;
                                    }
                                }

                                $str = $str . (isset($value->reference_id) ? ' reference_id:' . $value->reference_id : '');
                                $str = $str . (isset($value->source) ? ' source:' . implode(",", $value->source) : '');
                                // $str = $str . (isset($value->net_amounts) ? ' net_amoounts:' . implode(",", $value->net_amounts) : '');
                                $str = $str . (isset($value->updated_at) ? ' updated_at:' . $value->updated_at : '');
                                $str = $str . (isset($value->state) ? ' state:' . $value->state : '');
                                // $str = $str . (isset($value->total_money) ? ' total_money:' . implode(",", $value->total_money) : '');
                                // $str = $str . (isset($value->total_tax_money) ? ' total_tax_money:' . implode(",", $value->total_tax_money) : '');
                                // $str = $str . (isset($value->total_discount_money) ? ' total_discount_money:' . implode(",", $value->total_discount_money) : '');
                                // $str = $str . (isset($value->total_service_charge_money) ? ' total_service_charge_money:' . implode(",", $value->total_service_charge_money) : '');


                                $c_dt = explode('T', $value->created_at);
                                if (isset($value->closed_at))
                                    $d_dt = explode('T', $value->closed_at);
                                else {
                                    $d_dt = $c_dt;
                                }
                                $cust_id = isset($cust_id) ? $cust_id : 0;
                                echo "\n emp_id p : " . $emp_id;
                                $emp_id = $this->employee->getempid($emp_id);
                                echo "\n emp_id a : " . $emp_id;
                                $tamount = number_format(((float) $tamount / 100), 2, '.', '');

                                $subtotal = isset($value->net_amounts->total_money->amount) ? $value->net_amounts->total_money->amount : 0;
                                $subtotal = number_format(((float) $subtotal / 100), 2, '.', '');

                                $shipping = isset($value->net_amounts->service_charge_money->amount) ? $value->net_amounts->service_charge_money->amount : 0;
                                $shipping = number_format(((float) $shipping / 100), 2, '.', '');

                                $discount = isset($value->net_amounts->discount_money->amount) ? $value->net_amounts->discount_money->amount : 0;
                                $discount = number_format(((float) $discount / 100), 2, '.', '');

                                $tax = isset($value->net_amounts->tax_money->amount) ? $value->net_amounts->tax_money->amount : 0;
                                $tax = number_format(((float) $tax / 100), 2, '.', '');

                                //add into invoices
                                $data = array(
                                    'tid' => 0,
                                    'invoicedate' => $c_dt[0],
                                    'invoiceduedate' => $d_dt[0],
                                    'subtotal' => $subtotal,
                                    'shipping' => $shipping,
                                    'discount' => $discount,
                                    'tax' => $tax,
                                    'total' => $tamount,
                                    'pmethod' => $pmode,
                                    'notes' => '',
                                    'status' => 'due',
                                    'csd' => '',
                                    'eid' => '',
                                    'pamnt' => $tamount,
                                    'items' => count($item_lst),
                                    'taxstatus' => 'yes',
                                    'discstatus' => '1',
                                    'format_discount' => '%',
                                    'refer' => '',
                                    'term' => '',
                                    'multi' => '',
                                    'salesperson_id' => $emp_id,
                                    'booth_id' => '',
                                    'customer_id' => $cust_id,
                                    'shipping_option' => $isshiping,
                                    'invoices_id' => $value->id,
                                    'location_id' => $value->location_id,
                                    'extra_fields' => $str,
                                );
                                $tid = $this->invoice->insert_api($data);
                                //added in invoice
                                echo "<br/>tid<br/>" . $tid . "<br/><br/>";

                                if ($tid != 0) {

                                    //get line items
                                     echo "<br/><br/>" . json_encode($value->line_items) . "<br/><br/>";
                                    $line_items = $value->line_items;
                                    $booth_id = 0;
                                    if (is_array($line_items)) {
                                        foreach ($line_items as $key => $value) {
                                            $item = '';

                                           // $item_id = isset($item_lst[$value->variation_name]) ? $item_lst[$value->variation_name] : 0;
                                            $pid = $this->product->getItemId($value->catalog_object_id);
                                            $pid = isset($pid)?$pid:0;
                                            echo ("\npid " . $pid . "\n");
                                            $tamount = number_format(((float) $tamount / 100), 2, '.', '');

                                            $price = isset($value->base_price_money->amount) ? $value->base_price_money->amount : 0;
                                            $price = number_format(((float) $price / 100), 2, '.', '');

                                            $subtotal = isset($value->total_money->amount) ? $value->total_money->amount : 0;
                                            $subtotal = number_format(((float) $subtotal / 100), 2, '.', '');

                                            $shipping = isset($value->net_amounts->service_charge_money->amount) ? $value->net_amounts->service_charge_money->amount : 0;
                                            $shipping = number_format(((float) $shipping / 100), 2, '.', '');

                                            $discount = isset($value->total_discount_money->amount) ? $value->total_discount_money->amount : 0;
                                            $discount = number_format(((float) $discount / 100), 2, '.', '');

                                            $tax = isset($value->total_tax_money->amount) ? $value->total_tax_money->amount : 0;
                                            $tax = number_format(((float) $tax / 100), 2, '.', '');

                                            $tdiscount = isset($value->total_discount_money->amount) ? $value->total_discount_money->amount : 0;
                                            $tdiscount = number_format(((float) $tdiscount / 100), 2, '.', '');

                                            $ttax = isset($value->total_tax_money->amount) ? $value->total_tax_money->amount : 0;
                                            $ttax = number_format(((float) $ttax / 100), 2, '.', '');
                                            $data = array(
                                                'tid' => $tid,
                                                'pid' => $pid,
                                                'product' => $value->variation_name,
                                                'qty' => $value->quantity,
                                                'price' => $price,
                                                'tax' => $tax,
                                                'discount' => $discount,
                                                'subtotal' => $subtotal,
                                                'totaltax' => $ttax,
                                                'totaldiscount' => $tdiscount,
                                                'product_des' => '',
                                                'extra_fields' => '',
                                            );
                                            //print_r($data);
                                            echo ('\n====================================================items ' . $this->invoice->insert_item_api($data));
                                            // exit(0);
                                        }
                                    }
                                    if(isset($pid)){
                                        $booth_id = $this->product->getboothId($pid,$location_id);
                                        $this->invoice->updateBoothInvoice($booth_id, $tid);
                                    }
                                }
                                echo "\n=======transaction started=======\n";
                                $amnt = number_format(((float) $amnt / 100), 2, '.', '');
                                //insert into account and into transaction
                                $ret = $this->employee->setAccountBalance($e_id, $amnt, $c_dt[0],$tid );
                                echo "\n=======transaction saved ".$ret."\n";
                            }
                        }
                    }
                }
                echo "\n====================================================completed for location " . $locd_id . "====================================================\n";
            } catch (Exception $e) {
                echo "\n====================================================problem for location " . $locd_id . "====================================================\n";
                echo 'Exception when calling OrdersApi->searchOrders: ', $e->getMessage(), PHP_EOL;
            }
        }

        echo "\n====================================================completed for all locations==================================================== \n";
        // //update emp amounts
        // foreach ($emp as $k => $v) {
        //     echo $k . ' ' . $v;
        //     $this->employee->setAccountBalance($k, $v);
        // }
        $end_time = time();
        $diff = $end_time->diff($start_time);
        echo "\n\n\ncompleted in " . $diff->format('%H:%I:%S');;
    }
    public function retriveData()
    {
        $start_time = time();
        echo $start_time . "\n";
        $order_lst = array();
        $trans_lst = array();
        $pay_lst = array();
        $loc_ids = $this->shows->getAllLocations(); //$this->getLocationsAPI();
        foreach ($loc_ids as $locd_id) {
            //search order start
            $loc_id = array($locd_id);
            echo "\n" . $locd_id . "\n";
            $api_instance = new SquareConnect\Api\OrdersApi();
            $body = new \SquareConnect\Model\SearchOrdersRequest(); // \SquareConnect\Model\SearchOrdersRequest | An object containing the fields to POST for the request.  See the corresponding object definition for field details.
            $body->setLocationIds($loc_id);
            try {
                $result = $api_instance->searchOrders($body);
                $obj = json_decode($result);
                foreach ($obj as $key => $value) {
                    if (is_array($value) && $key == "orders") {
                        $inner = $value;
                        $order_lst = array_merge($order_lst, $inner);
                        // echo (count($orders) . "\n");
                    }
                }
            } catch (Exception $e) {
                echo "\n====================================================problem for location " . $locd_id . "====================================================\n";
                echo 'Exception when calling OrdersApi->searchOrders: ', $e->getMessage(), PHP_EOL;
            }
            //search order end
            //list transaction start
            $tran_instance = new SquareConnect\Api\TransactionsApi();
            try {
                $result = $tran_instance->listTransactions($locd_id);

                foreach ($result['transactions'] as  $value) {

                    $trans_lst[$value['id']] = $value;
                    $payment_id = $value['tenders'][0]['id'];

                    //get payment data start
                    $pay_instance = new SquareConnect\Api\V1TransactionsApi();
                    // // $location_id = "PGN2MMZCK1Q2Q"; // string | The ID of the payment's associated location.
                    // // $payment_id = "8Q3e2ZgsnUJzsPsE4V9NVyMF"; // string | The Square-issued payment ID. payment_id comes from Payment objects returned by the List Payments endpoint, Settlement objects returned by the List Settlements endpoint, or Refund objects returned by the List Refunds endpoint.

                    try {
                        $presult = $pay_instance->retrievePayment($locd_id, $payment_id);

                        $pay_lst[$value['id']] = $presult;
                    } catch (Exception $e) {
                        // echo "\n99999";
                        echo 'Exception when calling V1TransactionsApi->retrievePayment: ', $e->getMessage(), PHP_EOL;
                    }
                    //get payment data end



                    // echo("\n".($value['tenders'][0]['id']));
                }
            } catch (Exception $e) {
                echo 'Exception when calling TransactionsApi->listTransactions: ', $e->getMessage(), PHP_EOL;
            }
            //list transaction end


        }
        $end_time = time();
        $diff = $end_time->diff($start_time);
        $this->notifytheTeamLeader();
        echo "\n\n\ncompleted in " . $diff->format('%H:%I:%S');;
    }





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
            //  echo "\ndata\n";

            // return ($data);
            return ($data);
            // print_r ($data);
            // echo "\ndata\n";
        } catch (\SquareConnect\ApiException $e) {
            return array();
        }
    }
    public function notifytheTeamLeader()
    {
        $limit = 500;
        $msgs = $this->account->getTeamLeaderIdsToNotify();
        echo json_encode($msgs);
        foreach ($msgs as $msg) {
            $m = 'Balance of ' . $msg['sales_name'] . ' is more then ' . $limit . ' for show ' . $msg['show_name'];

            $this->sendNotification(array($msg['team_lead_device_token']), 'Balance is more than limit', $m);
            // $this->sendNotification("dhTpM7IRnjE:APA91bFcI2yinxLT93Qcruwp4xQWBNCIdBgFKyFkTMos-ApAQ8JjGEKa2oVfam8ON-wpWAnxw-c7GrimZJ6H1ZfzLPCzCLwJdkReB46pRO7bzIngxT7FmiqdgGjMVVPKzp2wy6TzM1tE",'Balance is more than limit',$m);
            //echo $m;
        }
    }
    //send notification -- arzoo
    public function sendNotification($ids, $title, $msgd)
    // public function sendNotification()

    {

        //define('SERVER_API_KEY', 'AIzaSyBfZJGjP72Xsgm6aodFg8hd50KiExAYKP4');
        // $tokens = array();
        // $tokens = $ids;
        $this->config->load('api_config');

        $SERVER_API_KEY = $this->config->item('firebase_token');
        // $ret = $this->shows->getTokens($ids);
        // foreach ($ret as $row) {
        //     array_push($tokens, $row->device_token);
        // }
        // print_r($ids);
        $dashboard = base_url() . 'dashboard';

        $header = [
            'Authorization: Key=' . $SERVER_API_KEY,
            'Content-Type:Application/json'
        ];
        $msg = [
            'title' => $title,
            'body' => $msgd,
            'icon' => 'https://acmesoftware.net/userfiles/company/1556091612354279320.png',
            //'image' => 'http://allysoftsolutions.com/assets/images/logo.png',
            'click_action' => $dashboard,
        ];
        $payload = [
            'registration_ids' => $ids,
            'data' => $msg
        ];


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => $header,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return;
    }
}
