<?php
// Include configuration file
include_once 'config.php';
include_once 'action.php';
// include_once 'api/action.php';

// Check if user session data is not empty
if (!empty($_SESSION['data'])) {
    // Extract payment information from session
    $cardMonth = $_SESSION['PaymentInformation']['ExpMonth'];
    $cardYear = $_SESSION['PaymentInformation']['ExpYear'];
    $cardName = $_SESSION['PaymentInformation']['NameOnCard'];
    $cardNumber = $_SESSION['PaymentInformation']['CCNumber'];
    $cardSecurityCode = $_SESSION['PaymentInformation']['CVV'];

    // Check if cc_expire_date_month_year is present in POST data
    if (!empty($_POST['cc_expire_date_month_year'])) {
        // Extract and update card month and year from POST data
        $csvYear = $_POST['cc_expire_date_month_year'];
        $csvYear = explode("/", $csvYear);
        $cardMonth = $csvYear[0];
        $cardYear = $csvYear[1];
    }

    // Use fallback values if card information is not present
    $cardMonth = !empty($cardMonth) ? $cardMonth : $_SESSION['data']['cardMonth'];
    $cardYear = !empty($cardYear) ? $cardYear : $_SESSION['data']['cardYear'];
    $cardNumber = !empty($cardNumber) ? $cardNumber : $_SESSION['data']['cc_number'];
    $cardName = !empty($cardName) ? $cardName : $_SESSION['data']['cardName'];
    $cardSecurityCode = !empty($cardSecurityCode) ? $cardSecurityCode : $_SESSION['data']['cc_cvv2'];


    // Set product ID based on double product upsell set or not

    if (isset($_SESSION['UPDoubleProductID'])) {

        // if set then get its id and set the corressponding double upsell product id.

        $selectedProduct = $_SESSION['UPDoubleProductID']; 

        switch ($selectedProduct)
        {
            // below three cases are for standard products

            case $GLOBALS['OriginalProductID1']:
                $productId = $GLOBALS['DoubleProductUpsellID1'];
                break;
            case $GLOBALS['OriginalProductID2']:
                $productId = $GLOBALS['DoubleProductUpsellID2'];
                break;
            case $GLOBALS['OriginalProductID3']:
                $productId = $GLOBALS['DoubleProductUpsellID3'];
                break;

            // below three cases are for id save and subscribe checkbox is selected.

            case $GLOBALS['SaveAndSubscribeProduct1']:
                $productId = $GLOBALS['DoubleProductUpsellID1'];
                break;
            case $GLOBALS['SaveAndSubscribeProduct2']:
                $productId = $GLOBALS['DoubleProductUpsellID2'];
                break;
            case $GLOBALS['SaveAndSubscribeProduct3']:
                $productId = $GLOBALS['DoubleProductUpsellID3'];
                break;
            default:
                break;
        

        }

    } else {

        // if the double upsell is not selected then get healthy upsell id as product id

        $productId = $GLOBALS['HealthUpsellID'];
        
    }

    // Prepare data for API request
    $postData = array(
        "CustomerID" => $_SESSION['data']['CustomerID'],
        "IpAddress" => $GLOBALS['IpAddress'],
        "BillingAddress" => array(
            "FirstName" => $_SESSION['data']['firstName'],
            "LastName" => $_SESSION['data']['lastName'],
            "Address1" => $_SESSION['data']['address'],
            "City" => $_SESSION['data']['city'],
            "CountryISO" => "us",
            "State" => $_SESSION['data']['state'],
            "zipCode" => $_SESSION['data']['zipCode']
        ),
        "PaymentInformation" => array(
            "ExpMonth" => $cardMonth,
            "ExpYear" => $cardYear,
            "CCNumber" => $cardNumber,
            "NameOnCard" => $cardName,
            "CVV" => $cardSecurityCode,
            "ProcessorID" => isset($GLOBALS['FB_US_ProcesserID']) ? $GLOBALS[''] : ''
        ),

        "Products" => array(
            array(
                "ProductID" => $productId,
                "OrderID" => $GLOBALS['orderData']->Transaction->OrderInfo->OrderID
            )
        )


    );



    // Convert data to JSON format
    $data = json_encode($postData);


    // Order Log data to file
    if (isset($_SESSION['UPDoubleProductID'])) { 
        logToFile2("############## ORDER #####################");
        logToFile2($data);
        logToFile2("###################################");
    } else {
        logToFile("############## ORDER #####################");
        logToFile($data);
        logToFile("###################################");
    }


    //createing diff idempotency key based on double product is set or health upsell.

    if (isset($_SESSION['UPDoubleProductID'])) {
        $IdempotencyKey = $GLOBALS['IdempotencyKey'] . "_2";
    } else {
        $IdempotencyKey = $GLOBALS['IdempotencyKey'];
    }


    // Initialize cURL session
    $curl = curl_init();
    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => $GLOBALS['apiUrl'] . '/api/v2/open/orders',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            'Authorization: ApiKey ' . $GLOBALS['apiKey'],
            'Idempotency-Key: ' . $IdempotencyKey . 'addOrder',
            'Content-Type: application/json'
        ),
    ));
    // Execute cURL session and get response
    $response = curl_exec($curl);

    // Response Log data to file
    if (isset($_SESSION['UPDoubleProductID'])) {
        logToFile2("############## ORDER #####################");
        logToFile2($response);
        logToFile2("###################################");
    } else {
        logToFile("############## ORDER #####################");
        logToFile($response);
        logToFile("###################################");
    }
    
    // Close cURL session
    curl_close($curl);

    
    

    // Extract last 4 digits of card number
    $cardstring = substr($cardNumber, -4);

    // Set session variable with last 4 digits of card
    $_SESSION['stringCD'] = $cardstring;

    // Add order details to session
    $_SESSION['orderDetail'][] = array('orderResponse' => json_decode($response), 'cardNumber' => $cardNumber);


    
}


