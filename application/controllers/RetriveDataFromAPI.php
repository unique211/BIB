<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class RetriveDataFromAPI extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        $path = APPPATH . '\third_party\connect-php-sdk\autoload.php';
        echo $path;
        require_once($path);
        $this->load->model('Customers_model', 'cust');
        $this->load->model('Invoices_model', 'invoice');
        $this->load->model('Employee_model', 'employee');
        // Configure OAuth2 access token for authorization: oauth2
        $this->config->load('api_config');

        $token = $this->config->item('square_token');
        SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($token);
    }
    public function index()
    {
        // echo 'welcome user';
        // echo base_url();
    }
    public function getOrderDetails()
    {




        $api_instance = new SquareConnect\Api\OrdersApi();
        // $location_id = "0PZ0MMCQ5WH1A"; // string | The ID of the business location to associate the order with.



        //search order
        // $loc_id = ["6NA8AMV33ZYWK", "0PZ0MMCQ5WH1A"];
        $loc_id = $this->getLocationsAPI();
        // var_dump($loc_id);
        $body = new \SquareConnect\Model\SearchOrdersRequest(); // \SquareConnect\Model\SearchOrdersRequest | An object containing the fields to POST for the request.  See the corresponding object definition for field details.

        try {
            $orders = array();

            $emp = array();
            for ($i = 0; $i < count($loc_id);) {
                $body->setLocationIds(array_slice($loc_id, $i, 10));
                $result = $api_instance->searchOrders($body);

                $obj = json_decode($result);

                foreach ($obj as $key => $value) {
                    if (is_array($value) && $key == "orders") {
                        $inner = $value;
                        $orders = array_merge($orders, $inner);
                        echo (count($orders) . "<br/>");
                    }
                }
                $i = $i + 10;
            }echo"<br/><br/><br/>";
            print_r($orders);
            echo"<br/><br/><br/>";
            //code to insert the data in to db
            foreach ($orders as $key => $value) {
                $cust_id = "";
                $str = '';
                $item_lst = array();
                 print_r('key '.$key);
                //retrive customer -start
                // echo"<br/><br/><br/>";
                // print_r($value);
                // echo"<br/><br/><br/>";
                // print_r($value->tenders[0]->customer_id);
                echo "<br/>11111";
                if (isset($value->tenders[0]->customer_id)) {
                    // print_r('customer_id:' . $value->customer_id . '<br/>');
                    $api_instance = new SquareConnect\Api\CustomersApi();
                    $customer_id = str_replace(' ', '', $value->tenders[0]->customer_id); //"0WETWDSFQ926X3WJNFNJGG9P0R"; // string | The ID of the customer to retrieve.
                    echo "<br/>22222";
                    try {
                        $result1 = $api_instance->retrieveCustomer($customer_id);
                        // echo "<br/>value <br/>";
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
                        echo "<br/>33333";
                    } catch (Exception $e) {
                        echo 'Exception when calling CustomersApi->retrieveCustomer: ', $e->getMessage(), PHP_EOL;
                        echo "<br/>44444";
                    }
                    echo "<br/>55555";
                }
                //retrive customer -end

                //trasaction 
                $api_instance = new SquareConnect\Api\TransactionsApi();
                $location_id = $value->location_id; // string | The ID of the payment's associated location.
                $transaction_id = $value->id; // string | The ID of the transaction to retrieve.
                $payment_id = "";
                $isshiping = "";
                $pmode = "";
                $tamount = "";
                $emp_id = "";
                $pamount = 0;
                try {
                    $tresult = $api_instance->retrieveTransaction($location_id, $transaction_id);
                    echo "<br/>6666";
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
                    echo "<br/>77777";
                    //payment
                $api_instance = new SquareConnect\Api\V1TransactionsApi();
                // $location_id = "PGN2MMZCK1Q2Q"; // string | The ID of the payment's associated location.
                // $payment_id = "8Q3e2ZgsnUJzsPsE4V9NVyMF"; // string | The Square-issued payment ID. payment_id comes from Payment objects returned by the List Payments endpoint, Settlement objects returned by the List Settlements endpoint, or Refund objects returned by the List Refunds endpoint.
                
                try {
                    $presult = $api_instance->retrievePayment($location_id, $payment_id);
                    foreach ($presult["itemizations"] as $k => $v) {
                        $itm_nm = $v['name'];
                        $item_lst[$itm_nm] = $v['item_detail']['item_id'];
                    }
                    if ($presult["tender"][0]["type"] == "CASH") {
                        $emp_id = $presult["tender"][0]["employee_id"];

                        if (isset($emp[$emp_id])) {
                            $emp[$emp_id] = $emp[$emp_id] + $presult["net_total_money"]["amount"];
                        } else {
                            $emp[$emp_id] = $presult["net_total_money"]["amount"];
                        }
                        $pamount += $presult["net_total_money"]["amount"];
                    }
                    echo "<br/>88888";
                } catch (Exception $e) {
                    echo "<br/>99999";
                    echo 'Exception when calling V1TransactionsApi->retrievePayment: ', $e->getMessage(), PHP_EOL;
                }

                //retrive from db emp_id
                $emp_id = $this->employee->getempid($emp_id);
                echo "<br/>AAAAA";
                } catch (Exception $e) {
                    echo "<br/>BBBBB";
                    echo 'Exception when calling TransactionsApi->retrieveTransaction: ', $e->getMessage(), PHP_EOL;
                }


                



                $str = $str . (isset($value->reference_id) ? ' reference_id:' . $value->reference_id : '');
                $str = $str . (isset($value->source) ? ' source:' . implode(",", $value->source) : '');
                $str = $str . (isset($value->net_amounts) ? ' net_amoounts:' . implode(",", $value->net_amounts) : '');
                $str = $str . (isset($value->updated_at) ? ' updated_at:' . $value->updated_at : '');
                $str = $str . (isset($value->state) ? ' state:' . $value->state : '');
                $str = $str . (isset($value->total_money) ? ' total_money:' . implode(",", $value->total_money) : '');
                $str = $str . (isset($value->total_tax_money) ? ' total_tax_money:' . implode(",", $value->total_tax_money) : '');
                $str = $str . (isset($value->total_discount_money) ? ' total_discount_money:' . implode(",", $value->total_discount_money) : '');
                $str = $str . (isset($value->total_service_charge_money) ? ' total_service_charge_money:' . implode(",", $value->total_service_charge_money) : '');


                $c_dt = explode('T', $value->created_at);
                if (isset($value->closed_at))
                    $d_dt = explode('T', $value->closed_at);
                else {
                    $d_dt = $c_dt;
                }
                // print_r($c_dt);
                //add into invoices
                $data = array(
                    'tid' => 0,
                    'invoicedate' => $c_dt[0],
                    'invoiceduedate' => $d_dt[0],
                    'subtotal' => $value->net_amounts->total_money->amount,
                    'shipping' => $value->net_amounts->service_charge_money->amount,
                    'discount' => $value->net_amounts->discount_money->amount,
                    'tax' => $value->net_amounts->tax_money->amount,
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
                echo "<br/>CCCCCCC";
                if ($tid != 0) {
                    $line_items = $value->line_items;
                    if (is_array($line_items)) {
                        foreach ($line_items as $key => $value) {
                            echo "<br/>DDDDDDDD";
                            $item = '';
                            $item_id = isset($item_lst[$value->name])?$item_lst[$value->name]:0;
                            $pid = $this->getItemId($item_id);
                            $data = array(
                                'tid' => $tid,
                                'pid' => $pid,
                                'product' => $value->name,
                                'qty' => $value->quantity,
                                'price' => $value->base_price_money->amount,
                                'tax' => $value->total_tax_money->amount,
                                'discount' => $value->total_discount_money->amount,
                                'subtotal' => $value->total_money->amount,
                                'totaltax' => $value->total_tax_money->amount,
                                'totaldiscount' => $value->total_discount_money->amount,
                                'product_des' => '',
                                'extra_fields' => implode(",", $value),
                            );
                            echo ('items ' . $this->invoice->insert_item_api($data));
                            // print_r('-------------------End Item Details -------------------' . '<br/>');
                        }
                    }
                }
            }
        } catch (Exception $e) {
            echo "<br/>EEEEEE";
            echo 'Exception when calling OrdersApi->searchOrders: ', $e->getMessage(), PHP_EOL;
        }
        //update emp amounts
        foreach ($emp as $k => $v) {
            echo $k . ' ' . $v;
            $this->employee->setAccountBalance($k, $v);
        }

        echo "<br/><br/><br/>completed";
    }
    function getEmployeeAPI()
    {
        $api_instance = new SquareConnect\Api\V1EmployeesApi();
        $order = "ASC"; // string | The order in which employees are listed in the response, based on their created_at field.      Default value: ASC
        $begin_updated_at = "begin_updated_at_example"; // string | If filtering results by their updated_at field, the beginning of the requested reporting period, in ISO 8601 format
        $end_updated_at = "end_updated_at_example"; // string | If filtering results by there updated_at field, the end of the requested reporting period, in ISO 8601 format.
        $begin_created_at = "begin_created_at_example"; // string | If filtering results by their created_at field, the beginning of the requested reporting period, in ISO 8601 format.
        $end_created_at = "end_created_at_example"; // string | If filtering results by their created_at field, the end of the requested reporting period, in ISO 8601 format.
        $status = "status_example"; // string | If provided, the endpoint returns only employee entities with the specified status (ACTIVE or INACTIVE).
        $external_id = "external_id_example"; // string | If provided, the endpoint returns only employee entities with the specified external_id.
        $limit = 56; // int | The maximum integer number of employee entities to return in a single response. Default 100, maximum 200.
        $batch_token = "batch_token_example"; // string | A pagination cursor to retrieve the next set of results for your original query to the endpoint.

        try {
            $result = $api_instance->listEmployees();
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling V1EmployeesApi->listEmployees: ', $e->getMessage(), PHP_EOL;
        }
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
}
