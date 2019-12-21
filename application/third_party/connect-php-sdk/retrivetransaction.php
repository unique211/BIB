<?php
require_once(__DIR__ . '\autoload.php');

// Configure OAuth2 access token for authorization: oauth2
SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken('EAAAEHSCTkIq6OcNF7DVHmjMgYZ9fb7srm-VmGWBbS7mUXbgH3P1Y4xtH5D-4W8i');

$api_instance = new SquareConnect\Api\TransactionsApi();
$location_id = "0PZ0MMCQ5WH1A"; // string | The ID of the transaction's associated location.
$transaction_id = "transaction_id_example"; // string | The ID of the transaction to retrieve.

try {
    $result = $api_instance->retrieveTransaction($location_id, $transaction_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TransactionsApi->retrieveTransaction: ', $e->getMessage(), PHP_EOL;
}
?>