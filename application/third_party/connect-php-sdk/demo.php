<?php
require_once(__DIR__ . '\autoload.php');

// $access_token = 'EAAAEFzdEilDgtDCURfS5vQ-iuR3VuOSaWKtvH79XaACUe-Gvl55k35DM9R8Tl3n';
$access_token = 'EAAAEF4sFKXL40dr8msQ9ym-Zz54xeU9Vr61uN5dwc7SNtTLC8ER8xSqXlhApZMF';
# setup authorization
\SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($access_token);
# create an instance of the Location API
$locations_api = new \SquareConnect\Api\LocationsApi();

try {
  $locations = $locations_api->listLocations();
  print_r($locations->getLocations());
} catch (\SquareConnect\ApiException $e) {
  echo "Caught exception!<br/>";
  print_r("<strong>Response body:</strong><br/>");
  echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
  echo "<br/><strong>Response headers:</strong><br/>";
  echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
  exit(1);
}
?>