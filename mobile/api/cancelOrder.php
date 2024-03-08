<?php
include_once 'config.php';
// echo "<pre>";
// print_r($_POST);

$customer_id = $_POST['customer_id'];
$email = $_POST['email'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://openapi.responsecrm.com/api/v2/open/customers?CustomerID='.$customer_id.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: ApiKey '.$GLOBALS['apiKey'].'',
    'Idempotency-Key: '.$GLOBALS['IdempotencyKey'].'getCustomer'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$response = json_decode($response);
//
//print_r($response);
//exit;

if(($response->Status == 0 && empty($response->Customers)) || $response->Status == 1){
    echo json_encode($response);
    exit;
}else if($response->Status == 0 && !empty($response->Customers)){
    if($response->Customers[0]->Email == $email){

        $postData = [
            "CustomerIDs" => [$response->Customers[0]->CustomerID]
        ];

        $postData = json_encode($postData);

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://openapi.responsecrm.com/api/v2/open/customers/mark-cancelled',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_HTTPHEADER => array(
            'Authorization: ApiKey '.$GLOBALS['apiKey'].'',
            'Idempotency-Key: '.$GLOBALS['IdempotencyKey'].'mark-cancelled',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        exit;

    }else{
        echo json_encode([
            "Status" => 0,
            "error" => true,
        ]);
        exit;
    }
}



exit;

