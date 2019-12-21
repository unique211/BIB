<?php
require_once(__DIR__ . '\autoload.php');

// Configure OAuth2 access token for authorization: oauth2
SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken('EAAAEF4sFKXL40dr8msQ9ym-Zz54xeU9Vr61uN5dwc7SNtTLC8ER8xSqXlhApZMF');

$api_instance = new SquareConnect\Api\TransactionsApi();
$location_id = "SHXT1N848QZ4R"; // string | The ID of the transaction's associated location.
$body = new \SquareConnect\Model\ChargeRequest(); // \SquareConnect\Model\ChargeRequest | An object containing the fields to POST for the request.  See the corresponding object definition for field details.

$body->setIdempotencyKey('1');

$var1 = new \SquareConnect\Model\Money;
 $var1->setAmount(100);
 $var1->setCurrency('INR');

 $body->setAmountMoney($var1);
 $lineItems = array();
 array_push($lineItems, $body);

 $body->setCardNonce('abcd');
 $body->setCustomerCardId('1111 4444 5555 6666');
 $body->setDelayCapture(True);
 $body->setReferenceId('1111');
 $body->setNote('test');
 $body->setCustomerId('QR7A559M417AK8GZQKXPS51828');


 $var2 = new \SquareConnect\Model\Address;
 $var2->setAddressLine1('rajkot');
 $var2->setAddressLine2('rajkot');
 $var2->setAddressLine3('rajkot');
 $var2->setLocality('rajkot1');
 $var2->setSublocality('rajkot11');
 $var2->setSublocality2('rajkot111');
 $var2->setSublocality3('rajkot1111');
 $var2->setAdministrativeDistrictLevel1('rajkot2');
 $var2->setAdministrativeDistrictLevel2('rajkot22');
 $var2->setAdministrativeDistrictLevel3('rajkot222');
 $var2->setPostalCode('360004');
 $var2->setCountry('IN');
 $var2->setFirstName('Arzoo');
 $var2->setLastName('Shaikh');
 $var2->setOrganization('ALLY');
 $body->setBillingAddress($var2);
 array_push($lineItems, $body);


 $var3 = new \SquareConnect\Model\Address;
 $var3->setAddressLine1('jamnagar');
 $var3->setAddressLine2('jamnagar');
 $var3->setAddressLine3('jamnagar');
 $var3->setLocality('jamnagar1');
 $var3->setSublocality('jamnagar11');
 $var3->setSublocality2('jamnagar111');
 $var3->setSublocality3('jamnagar1111');
 $var3->setAdministrativeDistrictLevel1('jamnagar2');
 $var3->setAdministrativeDistrictLevel2('jamnagar22');
 $var3->setAdministrativeDistrictLevel3('jamnagar222');
 $var3->setPostalCode('361012');
 $var3->setCountry('IN');
 $var3->setFirstName('Arzoo');
 $var3->setLastName('Shaikh');
 $var3->setOrganization('ALLY');
 $body->setShippingAddress($var3);
 array_push($lineItems, $body);


 $body->setBuyerEmailAddress('arzoo.rkcet@gmial.com');
 $body->setOrderId('5000');


 $var4 = new \SquareConnect\Model\AdditionalRecipient;
 $var4->setLocationId($location_id);
 $var4->setDescription('testing data');
 
 
 $var5 = new \SquareConnect\Model\Money;
 $var5->setAmount(500);
 $var5->setCurrency('INR');

 $var4->setAmountMoney($var5);
 $additional=array();
 array_push($additional, $var4);
 $body->setAdditionalRecipients($additional);
 
 
 

try {
    $result = $api_instance->charge($location_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TransactionsApi->charge: ', $e->getMessage(), PHP_EOL;
}
?>