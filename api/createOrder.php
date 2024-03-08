<?php
// Start a session
session_start();

// Include configuration file
include_once 'config.php';

// Check if the request method is POST and user session data is not empty
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['data'])) {
    // Extract payment information from the POST data
    $cardMonth = $_POST['month'];
    $cardYear = $_POST['year'];
    $cardName = '';

    /* 
    Set session variable for double product upsell based on double 
    product upsell set or not from prev page. that session variable 
    will be used in success and upsell pages.
    */

    if (isset($_POST['upsellDoubleProductID'])) {
        $_SESSION['upsellDoubleProductID'] = $_POST['upsellDoubleProductID'];
    }

    // Check if billing information should be the same as shipping
    if (!empty($_POST['billingSameAsShipping'])) {
        $billingFirstName = $_SESSION['data']['firstName'];
        $billingLastName = $_SESSION['data']['lastName'];
        $billingAddress = $_SESSION['data']['address'];
        $billingCity = $_SESSION['data']['city'];
        $billingState = $_SESSION['data']['state'];
        $billingZip = $_SESSION['data']['zipCode'];
    } else {
        $billingFirstName = $_POST['billingFirstName'];
        $billingLastName = $_POST['billingLastName'];
        $billingAddress = $_POST['billingAddress'];
        $billingCity = $_POST['billingCity'];
        $billingState = $_POST['billingState'];
        $billingZip = $_POST['billingZip'];
    }

    // Use fallback values if card information is not present
    $cardMonth = !empty($cardMonth) ? $cardMonth : $_SESSION['data']['cardMonth'];
    $cardYear = !empty($cardYear) ? $cardYear : $_SESSION['data']['cardYear'];
    $cardNumber = $_POST['cc_number'];
    $_SESSION['binnumber'] = $cardNumber;
    $cardName = $_POST['cardName'];
    $cardSecurityCode = $_POST['cc_cvv2'];

    // Prepare data for API request
    $postData = array(
        "CustomerID" => $_SESSION['data']['CustomerID'],
        "IpAddress" => $GLOBALS['IpAddress'],
        "ShippingAddress" => array(
            "FirstName" => $_SESSION['data']['firstName'],
            "LastName" => $_SESSION['data']['lastName'],
            "Address1" => $_SESSION['data']['address'],
            "Address2" => '',
            "City" => $_SESSION['data']['city'],
            "CountryISO" => "us",
            "State" => $_SESSION['data']['state'],
            "zipCode" => $_SESSION['data']['zipCode']
        ),
        "BillingAddress" => array(
            "FirstName" => $billingFirstName,
            "LastName" => $billingLastName,
            "Address1" => $billingAddress,
            "Address2" => '',
            "City" => $billingCity,
            "CountryISO" => "us",
            "State" => $billingState,
            "ZipCode" => $billingZip
        ),
        "PaymentInformation" => array(
            "ExpMonth" => $cardMonth,
            "ExpYear" => $cardYear,
            "CCNumber" => $cardNumber,
            "NameOnCard" => $cardName,
            "CVV" => $cardSecurityCode,
            "ProcessorID" => isset($GLOBALS['FB_US_ProcesserID']) ? $GLOBALS['FB_US_ProcesserID'] : ''
        )
    );

    // Add additional data to the request
    $postData["OrderID"] = isset($_SESSION['orderId']) ? $_SESSION['orderId'] : '';
    if ($postData["OrderID"] == '') {
        unset($postData["OrderID"]);
    }
    $postData["Products"][] = array("ProductID" => $_POST['productID']);

    // Convert data to JSON format
    $data = json_encode($postData);

    //  Log order data to file.
    logToFile("################ ORDER ###################");
    logToFile($data);
    logToFile("###################################");


    // Create an order using the API
    $response = createOrder($data);

    // Decode the JSON response
    $decoded_json = json_decode($response);

    //  Log response data to file.
    logToFile("############## ORDER RESPONSE #####################");
    logToFile($response);
    logToFile("###################################");

    // Set session variable with payment information
    $_SESSION['PaymentInformation'] = array(
        "ExpMonth" => $cardMonth,
        "ExpYear" => $cardYear,
        "CCNumber" => $cardNumber,
        "NameOnCard" => $cardName,
        "CVV" => $cardSecurityCode,
        "ProcessorID" => isset($GLOBALS['FB_US_ProcesserID']) ? $GLOBALS['FB_US_ProcesserID'] : ''
    );

    // Set session variable for special gift
    if (isset($_POST['special-gift'])) {
        $_SESSION['special-gift'] = 1;
    }

    // Log order details
    $_SESSION['orderDetail'][] = array('orderResponse' => $decoded_json, 'cardNumber' => $cardNumber);

    // Output the API response
    echo $response;
}

// Function to create an order using cURL
function createOrder($data) {
    $curl = curl_init();
    curl_setopt_array(
        $curl,
        array(
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
                'Idempotency-Key: ' . $GLOBALS['IdempotencyKey'] . 'addOrder',
                'Content-Type: application/json'
            ),
        )
    );
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function logToFile($var)
{
    ob_flush();
    ob_start();
    var_dump($var);
    $bufferContents = ob_get_contents();
    ob_end_clean();
    file_put_contents("Logs.txt", $bufferContents, FILE_APPEND);
}


