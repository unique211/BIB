<?php
require_once(__DIR__ . '\autoload.php');

// Configure OAuth2 access token for authorization: oauth2
SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken('EAAAEHSCTkIq6OcNF7DVHmjMgYZ9fb7srm-VmGWBbS7mUXbgH3P1Y4xtH5D-4W8i');

$api_instance = new SquareConnect\Api\TransactionsApi();
$location_id = "AN2TMFCK0NQNK"; // string | The ID of the location to list transactions for.
$begin_time = ""; // string | The beginning of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time minus one year.
$end_time = ""; // string | The end of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time.
$sort_order = "ASC"; // string | The order in which results are listed in the response (`ASC` for oldest first, `DESC` for newest first).  Default value: `DESC`
$cursor = ""; // string | A pagination cursor returned by a previous call to this endpoint. Provide this to retrieve the next set of results for your original query.  See [Pagination](/basics/api101/pagination) for more information.

try {
    $result = $api_instance->listTransactions($location_id, $begin_time, $end_time, $sort_order, $cursor);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TransactionsApi->listTransactions: ', $e->getMessage(), PHP_EOL;
}
?>