<?php
//create customer

require_once(__DIR__ . '\autoload.php');

// Configure OAuth2 access token for authorization: oauth2
SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken('EAAAEHSCTkIq6OcNF7DVHmjMgYZ9fb7srm-VmGWBbS7mUXbgH3P1Y4xtH5D-4W8i');
// SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken('EAAAEFzdEilDgtDCURfS5vQ-iuR3VuOSaWKtvH79XaACUe-Gvl55k35DM9R8Tl3n');

$api_instance = new SquareConnect\Api\CustomersApi();
//create customer
// $body = new \SquareConnect\Model\CreateCustomerRequest(); // \SquareConnect\Model\CreateCustomerRequest | An object containing the fields to POST for the request.  See the corresponding object definition for field details.
// $body->setGivenName("Vishal");
// $body->setEmailAddress("vishal.rkcet@gmail.com");
// try {
//     $result = $api_instance->createCustomer($body);
//     print_r($result);
// } catch (Exception $e) {
//     echo 'Exception when calling CustomersApi->createCustomer: ', $e->getMessage(), PHP_EOL;
// }


//List customer
$cursor = ""; // string | A pagination cursor returned by a previous call to this endpoint. Provide this to retrieve the next set of results for your original query.  See [Pagination](/basics/api101/pagination) for more information.
$sort_field = "DEFAULT"; // string | Indicates how Customers should be sorted. Default: `DEFAULT`.
$sort_order = "ASC"; // string | Indicates whether Customers should be sorted in ascending (`ASC`) or descending (`DESC`) order. Default: `ASC`.

try {
    $result = $api_instance->listCustomers($cursor, $sort_field, $sort_order);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CustomersApi->listCustomers: ', $e->getMessage(), PHP_EOL;
}
?>
