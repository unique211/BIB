<?php
require_once(__DIR__ . '\autoload.php');

// Configure OAuth2 access token for authorization: oauth2
SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken('EAAAEHSCTkIq6OcNF7DVHmjMgYZ9fb7srm-VmGWBbS7mUXbgH3P1Y4xtH5D-4W8i');
// SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken('EAAAEFzdEilDgtDCURfS5vQ-iuR3VuOSaWKtvH79XaACUe-Gvl55k35DM9R8Tl3n');

$api_instance = new SquareConnect\Api\V1ItemsApi();
$location_id = "0PZ0MMCQ5WH1A"; // string | The ID of the location to list items for.
$batch_token = ""; // string | A pagination cursor to retrieve the next set of results for your original query to the endpoint.

try {
    $result = $api_instance->listItems($location_id, $batch_token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling V1ItemsApi->listItems: ', $e->getMessage(), PHP_EOL;
}
?>