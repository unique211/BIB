<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class RetriveAPIC extends CI_Controller

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
        $this->load->model('Products_model', 'product');
        

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

        // // Configure OAuth2 access token for authorization: oauth2
        // SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken('EAAAEHSCTkIq6OcNF7DVHmjMgYZ9fb7srm-VmGWBbS7mUXbgH3P1Y4xtH5D-4W8i');
        // // SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken('EAAAEFzdEilDgtDCURfS5vQ-iuR3VuOSaWKtvH79XaACUe-Gvl55k35DM9R8Tl3n');


       // $api_instance = new SquareConnect\Api\OrdersApi();
        // $location_id = "0PZ0MMCQ5WH1A"; // string | The ID of the business location to associate the order with.

        $start_time = time();
        $emp = array();
        $loc_ids = $this->getLocationsAPI();
        foreach ($loc_ids as $locd_id) {
            //search order
            $loc_id = array($locd_id);//["225QW2PSVE88V"];
            $api_instance = new SquareConnect\Api\OrdersApi();
            $body = new \SquareConnect\Model\SearchOrdersRequest(); // \SquareConnect\Model\SearchOrdersRequest | An object containing the fields to POST for the request.  See the corresponding object definition for field details.
            $body->setLocationIds($loc_id);
            try {
                $result = $api_instance->searchOrders($body);
                $obj = json_decode($result);
                echo "<br/>====================================================<br/>";


                foreach ($obj as $key => $value) {
                    // print_r($key);
                     echo "<br/> order start <br/>";
                    // print_r($value);
                    // echo "<br/><br/>";
                    if (is_array($value)) {
                        $inner = $value;
                        foreach ($inner as $key => $value) {
                            $str = '';
                            print_r("<br/>key " . $key);
                            // echo "<br/> value <br/>";
                            // echo json_encode($value);
                            echo "<br/><br/>";
                            print_r('$value->id ' . $value->id . '<br/>');
                            print_r('$value->location_id ' . $value->location_id . '<br/>');
                            // print_r("<br/>" . empty($value->returns) . "<br/>");
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
                                try {
                                    $tresult = $api_instance->retrieveTransaction($location_id, $transaction_id);
                                    // echo "<br/>6666";
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
                                    // echo "<br/>77777";
                                    // echo "<br/>====================================================transaction details====================================================<br/>";
                                    // echo $payment_id . "<br/>";
                                    // echo $isshiping . "<br/>";
                                    // echo $pmode . "<br/>";
                                    // echo $tamount . "<br/>";
                                    // echo $emp_id . "<br/>";
                                    // echo $pamount . "<br/>";
                                    //payment
                                    $api_instance = new SquareConnect\Api\V1TransactionsApi();
                                    // // $location_id = "PGN2MMZCK1Q2Q"; // string | The ID of the payment's associated location.
                                    // // $payment_id = "8Q3e2ZgsnUJzsPsE4V9NVyMF"; // string | The Square-issued payment ID. payment_id comes from Payment objects returned by the List Payments endpoint, Settlement objects returned by the List Settlements endpoint, or Refund objects returned by the List Refunds endpoint.

                                    try {
                                        $presult = $api_instance->retrievePayment($location_id, $payment_id);
                                        // echo $presult;
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
                                        // echo "<br/>88888";
                                    } catch (Exception $e) {
                                        // echo "<br/>99999";
                                        echo 'Exception when calling V1TransactionsApi->retrievePayment: ', $e->getMessage(), PHP_EOL;
                                    }
                                    echo "<br/><br/>====================================================Payment Details====================================================<br/><br/>";
                                    // print_r($itm_nm);
                                    // echo "<br/>";
                                    // print_r($pamount);
                                    // echo "<br/>";
                                    // print_r($emp_id);
                                    // echo "<br/>";
                                    // print_r($emp);
                                    // echo "<br/><br/>";

                                    // print_r("<br/><br/>".$emp_id."<br/><br/>");
                                    // //retrive from db emp_id
                                    // $emp_id = $this->employee->getempid($emp_id);
                                    // echo "<br/>AAAAA";
                                } catch (Exception $e) {
                                    // echo "<br/>BBBBB</b>";
                                    echo 'Exception when calling TransactionsApi->retrieveTransaction: ', $e->getMessage(), PHP_EOL;
                                }



                                //get customer 
                                if (isset($value->tenders[0]->customer_id)) {
                                    // print_r('customer_id:' . $value->customer_id . '<br/>');
                                    $api_instance = new SquareConnect\Api\CustomersApi();
                                    $customer_id = str_replace(' ', '', $value->tenders[0]->customer_id); //"0WETWDSFQ926X3WJNFNJGG9P0R"; // string | The ID of the customer to retrieve.

                                    try {
                                        $result1 = $api_instance->retrieveCustomer($customer_id);
                                        echo "<br/>====================================================customer details==================================================== <br/>";
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
                                //added in invoice


                                if ($tid != 0) {

                                    //get line items
                                    // echo "<br/><br/>" . json_encode($value->line_items) . "<br/><br/>";
                                    $line_items = $value->line_items;
                                    if (is_array($line_items)) {
                                        foreach ($line_items as $key => $value) {
                                            $item = '';
                                            // print_r('uid ' . $value->uid . '<br/>');

                                            // print_r('name ' . $value->name . '<br/>');
                                            // print_r('quantity ' . $value->quantity . '<br/>');
                                            // print_r('base_price_money->amount ' . $value->base_price_money->amount . '<br/>');
                                            // print_r('base_price_money->currency ' . $value->base_price_money->currency . '<br/>');
                                            // print_r('variation_total_price_money->amount ' . $value->variation_total_price_money->amount . '<br/>');
                                            // print_r('variation_total_price_money->currency ' . $value->variation_total_price_money->currency . '<br/>');
                                            // print_r('gross_sales_money->amount ' . $value->gross_sales_money->amount . '<br/>');
                                            // print_r('gross_sales_money->currency ' . $value->gross_sales_money->currency . '<br/>');
                                            // print_r('total_tax_money');
                                            // print_r('total_tax_money->amount ' . $value->total_tax_money->amount . '<br/>');
                                            // print_r('total_tax_money->currency ' . $value->total_tax_money->currency . '<br/>');
                                            // print_r('total_discount_money');
                                            // print_r('total_discount_money->amount ' . $value->total_discount_money->amount . '<br/>');
                                            // print_r('total_discount_money->currency ' . $value->total_discount_money->currency . '<br/>');

                                            // print_r('total_money');
                                            // print_r('total_money->amount ' . $value->total_money->amount . '<br/>');
                                            // print_r('total_money->currency ' . $value->total_money->currency . '<br/>');

                                            $item_id = isset($item_lst[$value->name]) ? $item_lst[$value->name] : 0;
                                            $pid = $this->product->getItemId($item_id);
                                            echo ("<br/>pid ".$pid."<br/>");
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
                                                'extra_fields' => '',
                                            );
                                            //print_r($data);
                                            echo ('====================================================items ' . $this->invoice->insert_item_api($data));
                                            // exit(0);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                echo "<br/>====================================================completed for location ".$locd_id."====================================================<br/>";
            } catch (Exception $e) {
                echo "<br/>====================================================problem for location ".$locd_id."====================================================<br/>";
                echo 'Exception when calling OrdersApi->searchOrders: ', $e->getMessage(), PHP_EOL;
            }

        }

        echo "<br/>====================================================completed for all locations==================================================== <br/>";
        //update emp amounts
        foreach ($emp as $k => $v) {
            echo $k . ' ' . $v;
            $this->employee->setAccountBalance($k, $v);
        }
        $end_time = time();
        $diff = $end_time->diff($start_time);
        echo "<br/><br/><br/>completed in ".$diff->format('%H:%I:%S');;
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
