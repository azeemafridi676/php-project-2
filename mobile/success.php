<?php
session_start();
include_once 'api/action.php';
$binFilePath = $_SERVER['DOCUMENT_ROOT'] . '/bin.php';
if(file_exists($binFilePath)){
    include_once ($binFilePath); 
}

// if(!empty($_SESSION['orderId'])) {
//     orderComplete();
// }

if (!empty($_SESSION['formData'])) {
    // unset($_SESSION['formData']);
}
if (!empty($_SESSION['data'])) {


    // $_SESSION['bill_city'] = $_SESSION['data']['city'];
    // $_SESSION['bill_state'] = $_SESSION['data']['state'];

    // unset($_SESSION['data']);
}

$productData = array();

$FirstName = $LastName = $ShippingAddress = $ShippingAddress = $Phone = $Email = $orderid = $totalAmountOrder = $totalAmount = '';


//echo '<pre>';
//print_r($_SESSION['orderDetail']);
//echo '</pre>';
//exit;

if (!empty($_SESSION['orderDetail'][0]['orderResponse'])) {
    $GLOBALS['orderData'] = $_SESSION['orderDetail'][0]['orderResponse'];
    if (!empty($GLOBALS['orderData']->Transaction->CustomerInfo)) {
        $FirstName = $GLOBALS['orderData']->Transaction->CustomerInfo->FirstName;
        $LastName = $GLOBALS['orderData']->Transaction->CustomerInfo->LastName;


        $ShippingAddress = $GLOBALS['orderData']->Transaction->CustomerInfo->ShippingAddress;

        $BillingAddress = $GLOBALS['orderData']->Transaction->CustomerInfo->BillingAddress;

        $Phone = $GLOBALS['orderData']->Transaction->CustomerInfo->Phone;
        $Email = $GLOBALS['orderData']->Transaction->CustomerInfo->Email;
    }
    if (!empty($GLOBALS['orderData']->Transaction->OrderInfo)) {
        $orderId = $GLOBALS['orderData']->Transaction->OrderInfo->OrderID;
        $totalAmountOrder = $GLOBALS['orderData']->Transaction->OrderInfo->TotalAmount;
        if (!empty($GLOBALS['orderData']->Transaction->OrderInfo->Products)) {
            foreach ($GLOBALS['orderData']->Transaction->OrderInfo->Products as $pro) {
                $productData[] = array('productName' => $pro->ProductName, "amount" => $pro->ProductAmount);
            }
            $totalAmount = $GLOBALS['orderData']->Transaction->OrderInfo->TotalAmount;
        }
    }
}



if (!empty($_SESSION['orderDetail'][1]['orderResponse'])) {
    $GLOBALS['orderData'] = $_SESSION['orderDetail'][1]['orderResponse'];
    // $GLOBALS['orderData'] = json_decode($GLOBALS['orderData']);

    if (!empty($GLOBALS['orderData']->Transaction->OrderInfo)) {
        $orderId = $GLOBALS['orderData']->Transaction->OrderInfo->OrderID;
        if (!empty($GLOBALS['orderData']->Transaction->OrderInfo->Products)) {
            foreach ($GLOBALS['orderData']->Transaction->OrderInfo->Products as $pro) {
                $productData[] = array('productName' => $pro->ProductName, "amount" => $pro->ProductAmount);
            }
        }
    }
}
if (isset($_SESSION['data']) && isset($_SESSION['data']['city'])) {
    $shippingCity = $_SESSION['data']['city'] . ', ' . $_SESSION['data']['state'] . ' ' . $_SESSION['data']['zipCode'];
} else {
    $shippingCity = '';
}


if (!empty($_SESSION['billing_city'])) {
    $billingCity = $_SESSION['billing_city'] . ', ' . $_SESSION['billing_state'] . ' ' . $_SESSION['billing_zip_code'];
} else {
    $billingCity = $shippingCity;
}



$customerID = $GLOBALS['orderData']->Transaction->OrderInfo->CustomerID;
$filterFile = $_SERVER['DOCUMENT_ROOT'] . '/filter.php';
if(file_exists($filterFile)) {
    include_once ($filterFile); 
}

?>

<!doctype html>
<html>


<head>
<?php 
$postBackFile = $_SERVER['DOCUMENT_ROOT'] . '/postback.php';
if(file_exists($postBackFile)) {
    include_once ($postBackFile); 
}



?>

<?php 
    $pixelsFile = $_SERVER['DOCUMENT_ROOT'] . '/pixels.php';
    if(file_exists($pixelsFile)) {
        include_once ($pixelsFile); 
    }
?>	
    <meta charset="utf-8">
    <title>Revolt</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="stylesheet" type="text/css" href="css/mobile.css">
</head>

<body> <!--------Navigation-Section---------->
<script>
  fbq('track', 'Purchase');
</script>
    <!-----------TOP SECTION---------->
 
    <div class="top-fix-bar">
        <!--------Navigation-Bar---------->
        <div class="header">
            <div class="container position bdinpad">
                <div class="logo"><a href="index.php"><img src="images/logo.jpg" alt="" class="logo"></a>
                </div>

            </div>

        </div>
    </div>

<section style="margin-bottom: 40px; margin-top: 30px;">

    <div class="container">

        <div class="row">

            <div class="col-12 text-center order" style="margin-top: 30px;">

                <h1>Order Completed, <?php echo $FirstName ?>. Thank You !</h1>

            </div>


            <div class="col-12 text-center order#" style="margin-top: 20px;">

                <h1>Order # <?php echo $orderId
                            ?> Details</h1>

            </div>

        </div>

    </div>

    <div class="container">

        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12">

                <table class="table">

                    <thead class="" style="background: #dff4fd">

                        <tr>

                            <th>Your Information:</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>


                            <?php
                            $cardstring = isset($_SESSION['stringCD']) ? $_SESSION['stringCD'] : '';
                            ?>
                            <td>Card : Visa XXXX XXXX XXXX <?php echo $cardstring
                                                            ?></td>

                        </tr>

                        <tr>

                            <td>Email : <?php echo $Email ?></td>

                        </tr>

                        <tr>

                            <td>Phone : <?php echo $Phone ?></td>

                        </tr>

                    </tbody>

                </table>



            </div>



            <div class="col-lg-4 col-md-6 col-sm-12">
                <table class="table">
                    <thead style="background: #dff4fd">
                        <tr>
                            <th>Billed To:</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>

                            <td><?php echo $FirstName . ' ' . $LastName ?></td>

                        </tr>

                        <tr>

                            <td></strong><?php echo !empty($_SESSION['billing_address']) ? $_SESSION['billing_address'] : $BillingAddress
                                            ?></td>

                        </tr>

                        <tr>

                            <td><?php echo $billingCity ?></td>

                        </tr>

                    </tbody>

                </table>



            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">

                <table class="table">

                    <thead style="background: #dff4fd">

                        <tr>

                            <th>Shipped To:</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td><?php echo $FirstName . ' ' . $LastName ?></td>

                        </tr>


                        <tr>

                            <td><?php echo !empty($_SESSION['shipping_address']) ? $_SESSION['shipping_address'] : $ShippingAddress ?></td>

                        </tr>
                        <tr>
                            <td><?php echo  $shippingCity ?></td>
                        </tr>

                    </tbody>

                </table>


            </div>

            <div class="col-12" hidden>

                <table class="table">

                    <thead style="background: #dff4fd">

                        <tr>

                            <th colspan="3">Product Details:</th>

                        </tr>

                    </thead>

                    <tbody>
                        <?php
                        $totalamount = 0;

                        foreach ($productData as $p) {
                            $totalamount = $totalamount + $p['amount'];

                        ?>
                            <tr>
                                <td>
                                    <h4>Item:</h4>
                                    <p>
                                        <bold><?php echo  $p['productName'] ?></bold>

                                    </p>

                                </td>
                                <td>
                                    <h4>qty:</h4>
                                    <p>
                                        1

                                    </p>

                                </td>
                                <td>

                                    <h4>Price:</h4>

                                    <p>

                                        <bold><?php echo  $p['amount'] ?></bold>

                                    </p>

                                </td>
                            </tr>

                        <?php } ?>




                    </tbody>

                </table>

            </div>

            <div class="col-12" hidden>

                <table class="table">

                    <thead style="background: #dff4fd">

                        <tr>

                            <th>Total Purchases :</th>

                            <th></th>

                            <th></th>

                        </tr>

                    </thead>

                    <tfoot style="background: #dff4fd">

                        <tr>

                            <td id="foter"><strong>Total Order :</strong></td>

                            <td></td>

                            <td id="foter"><strong>$<?php echo number_format($totalAmountOrder, 2, ".", ",") ?></strong></td>

                        </tr>

                    </tfoot>

                    <tbody>


                        <tr>

                            <td>Shipping & Processing :</td>

                            <td></td>

                            <td>$0.00</td>

                        </tr>

                        <tr>

                            <td>Tax :</td>

                            <td></td>

                            <td>$0.00</td>

                        </tr>

                    </tbody>

                </table>



            </div>

        </div>

    </div>

</section>



    <footer class="dsplay">
        <div class="container bdinpad">
            <p class="text-center s2txt bdfont">© 2023 REVOLT CBD</p>
            <ul class="ftrlist1">
                <li>Revolt CBD 216 S. 22nd Elwood, IN 46031 US </li>
                <li> support@tryrevoltcbd.com</li>
				<li><a href="/ss/terms.php" target="_blank">Terms & Conditions</a></li>
				<li><a href="/ss/privacy.php" target="_blank">Priacy Policy</a></li>
            </ul>
            <div class="text-center">
                <p> * The product is not approved by the FDA. This product is not intended to diagnose, treat, cure, or prevent any disease. Photographs are for dramatization purposes only and may include models.
                    Results may vary based on time and degree of product usage.</p>
            </div>


        </div>
    </footer>
    <?php
    if (isset($_SESSION['special-gift'])) {
        include_once 'api/addUpsell.php';
    }
    session_destroy();
    ?>