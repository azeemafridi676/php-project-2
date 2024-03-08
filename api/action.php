<?php
include_once 'config.php';
/*********
 *
 * Api authentication to verify either APi connected properly
 *
 */


 // function to log to file for health upsell
function logToFile($var)
{
    ob_flush();
    ob_start();
    var_dump($var);
    $bufferContents = ob_get_contents();
    ob_end_clean();
    file_put_contents("UpsellLogs.txt", $bufferContents, FILE_APPEND);
}
//function to log to file for double upsell
function logToFile2($var)
{
    ob_flush();
    ob_start();
    var_dump($var);
    $bufferContents = ob_get_contents();
    ob_end_clean();
    file_put_contents("UpsellLogs2.txt", $bufferContents, FILE_APPEND);
}

function authUser()
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $GLOBALS['apiUrl'] . '/api/v2/open/test-auth',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: ApiKey ' . $GLOBALS['apiKey'],
            'Idempotency-Key: ' . $GLOBALS['IdempotencyKey'] . 'authUser'
        ),
    )
    );

    $response = curl_exec($curl);

    curl_close($curl);
    $response = json_decode($response);
    $GLOBALS['response'] = $response;
    importClicks($response->ClientID);
}

/*********
 * @param $postData
 * order creation after successfull payments
 *
 */

function addOrder($postData)
{

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
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                'Authorization: ApiKey ' . $GLOBALS['apiKey'],
                'Idempotency-Key: ' . $GLOBALS['IdempotencyKey'] . 'addOrder',
                'Content-Type: application/json'
            ),
        )
    );
    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response);
    // if($response->status==1)
    // {
    //     header('Location:checkout.php?error=1');
    // }
    if ($response->Status === 1) {
        header('Location: https://tryrevoltcbd.com/aff/mobile/payment.php?error=1');
    } elseif ($response->Transaction->OrderInfo->OrderID === null) {
        header('Location: https://tryrevoltcbd.com/aff/mobile/payment.php?error=1');
    } else {
        unset($_SESSION['orderDetail']);
        $_SESSION['orderDetail'][] = array('productOrderResponse' => $response);
        $_SESSION['orderId'] = $response->Transaction->OrderInfo->OrderID;
    }
}

/************
 * @param $ClientID
 * before order processing we need to call import clicks
 */

function importClicks($ClientID)
{

    $response = isset($GLOBALS['response']) ? $GLOBALS['response'] : null;

    $sessionId = '';
    if (isset($response) && isset($response->Result) && isset($response->Result->SessionID)) {
        $sessionId = $response->Result->SessionID;
    }


    if (isset($response) && $response->Status == 0 && !empty($_SESSION['data'])) {
        createCustomer($ClientID, $sessionId); // customer creation
    }
}

/*********
 * @param $ClientID
 * customer creation in order to send customer id for order
 *
 */
function createCustomer($ClientID, $sessionId = null)
{
    if (!empty($_SESSION['affid'])) {
        $AffiliateID = $_SESSION['affid'];
    } else {
        $AffiliateID = '';
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $GLOBALS['apiUrl'] . '/api/v2/open/customers',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
        "SiteID": ' . $GLOBALS['siteId'] . ',
        "FirstName": "' . $_SESSION['data']['firstName'] . '",
        "LastName": "' . $_SESSION['data']['lastName'] . '",
        "Address1": "' . $_SESSION['data']['address'] . '",
        "City": "' . $_SESSION['data']['city'] . '",
        "State": "' . $_SESSION['data']['state'] . '",
        "ZipCode": "' . $_SESSION['data']['zipCode'] . '",
        "Phone": "' . $_SESSION['data']['phone'] . '",
        "Email": "' . $_SESSION['data']['email'] . '",
        "IpAddress": "' . $_SESSION['IpAddress'] . '",
        "CustomValue1": "' . $_SESSION['c1'] . '",
        "CountryISO":"us",
        "SessionID":"' . $sessionId . '",
        "AffiliateID":"' . $AffiliateID . '",
		"SubAffiliateID":"' . (isset($_SESSION['s1']) ? $_SESSION['s1'] : '') . '"
    }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: ApiKey ' . $GLOBALS['apiKey'],
            'Idempotency-Key: ' . $GLOBALS['IdempotencyKey'] . 'customer',
            'Content-Type: application/json'
        ),
    )
    );

    $response = curl_exec($curl);

    curl_close($curl);
    $response = json_decode($response);

    //exit;
    if ($response->Status == 0) {
        // unset($_SESSION['data']);
        // unset($_SESSION['formData']);

        $_SESSION['data']['CustomerID'] = $response->CustomerID;
        $_SESSION['data']['ClientID'] = $ClientID;
    }
}

function orderComplete()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $GLOBALS['apiUrl'] . '/api/v2/open/complete/' . $_SESSION['orderId'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Authorization: ApiKey ' . $GLOBALS['apiKey'],
            'Idempotency-Key: ' . $GLOBALS['IdempotencyKey'] . 'importClicks',
            'Content-Type: application/json'
        ),
    )
    );

    $response = curl_exec($curl);

    curl_close($curl);
}
