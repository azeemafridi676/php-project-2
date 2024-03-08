<?php
session_start();
if (isset($_GET['is_test'])) {
    $_POST = array(
        'affId' => '',
        'cv1' => '',
        'firstName' => 'crystal',
        'lastName' => 'kumpla',
        'address' => '81 C SLT',
        'phone' => '44447778898494',
        'city' => 'LHR',
        'state' => 'Alabama',
        'zipCode' => '54499',
        'email' => 'crystal@test.com'
    );
}
include_once 'api/config.php';
include_once 'api/action.php';

if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('@(iPad|iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)@', $useragent)) {
        header('Location: ./mobile/');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_GET['error'])) {
    unset($_SESSION['data']);
    unset($_SESSION['address_data']);

    $_SESSION['data'] = $_POST;
    $_SESSION['address_data'] = $_POST;

    authUser();
}
$title = 'Review Order';

?>

<!doctype html>
<html>


<head>
    <?php
    $pixelsFile = '../pixels.php';
    if (file_exists($pixelsFile)) {
        include_once $pixelsFile;
    }

    ?>
    <meta charset="utf-8">
    <title>Revolt CBD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />



    <link rel="stylesheet" type="text/css" href="fonts/fonts.css">

    <link rel="stylesheet" type="text/css" href="css/cart.css">
    <link href="css/slick.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/media.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link href="css/jquery.fancybox.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/cart-from-validation.css">
    <link rel="stylesheet" type="text/css" href="css/checkout.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <!-- styles for the upsell modal -->

    <style>
        #upsell-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            width: 100vw;
            height: 100vh;
            position: fixed;
            z-index: 1001;
        }

        .fixed {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(to bottom, #ffffff 30%, #e1e1e1 70%);
            overflow: hidden;
            padding: 20px;
            z-index: 1004;
            border-radius: 15px;

        }

        .upsell-modal {
            display: flex;
            flex-direction: column;
            width: fit-content;
            margin: 0 auto;
        }

        .modal-container {
            display: flex;
            align-items: center;
        }

        .modal-text {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            row-gap: 2rem;
        }

        .modal-text>.h1 {
            color: #B51F27;
            font-size: 32px;
            font-weight: 700;

        }

        .modal-text>.h2 {

            font-size: 40px;
            font-weight: 700;
            color: #282828;
        }

        .modal-text>.h3 {
            font-size: 20px;
            font-weight: 500;
            color: black;
        }

        .modal-text>.h4 {
            font-size: 16.66px;
            font-weight: 500;
            color: black;
            margin-bottom: 2rem;
        }

        .modal-buttons {
            display: flex;
            flex-direction: column;
        }

        .modal-submit {
            margin: 0 5rem;
            border: none;
            border-radius: .5rem;
            background-color: #6fd007;
            padding: 2rem .5rem;
            font-size: 24px;
            color: white;
            font-weight: 500;
        }




        .modal-reject {
            background: none;
            margin-top: 1rem;
            margin-left: auto;
            margin-right: auto;
            border: none;
            width: fit-content;
            color: #282828;
            font-weight: bold;
            font-size: 18px;
        }



        @media all and (max-width: 900px) {

            .modal-container {
                flex-direction: column;
                flex-wrap: wrap;
            }
        }

        @media all and (max-width: 780px) {
            .modal-image img {
                transform: scale(0.8);
            }

            .modal-text>.h1 {
                font-size: 28px;
            }

            .modal-text>.h2 {
                font-size: 36px;
            }

            .modal-text>.h3 {
                font-size: 16px;
            }

            .modal-text>.h4 {
                font-size: 12.66px;
            }

            .modal-submit {
                margin: 0 1rem;
                padding: 1rem .5rem;
                font-size: 20px;
            }

            .modal-reject {

                padding: 1rem .5rem;
                font-size: 14px;
            }
        }

        @media all and (max-width: 540px) {
            .modal-text>.h1 {
                font-size: 22px;
            }

            .modal-text>.h2 {
                font-size: 26px;
            }

            .modal-text>.h3 {
                font-size: 10px;
            }

            .modal-text>.h4 {
                font-size: 8.7px;
            }

            .modal-submit {
                margin: 0 .8rem;
                padding: .8rem .4rem;
                font-size: 16px;
            }

            .modal-reject {
                padding: .8rem .4rem;
                font-size: 10px;
            }
        }

        @media all and (max-width: 470px) {
            .fixed {
                width: 250px;
            }
        }

        @media all and (max-width: 350px) {
            .modal-text>.h1 {
                font-size: 20px;
            }

            .modal-text>.h2 {
                font-size: 20px;
            }

            /* font size increased */
            .modal-text>.h3 {
                font-size: 10.5px;
            }

            .modal-text>.h4 {
                font-size: 10.2px;
            }

            /* ********** */

            .modal-submit {
                margin: 0 .8rem;
                padding: .8rem .4rem;
                font-size: 16px;
            }

            .modal-reject {
                padding: .8rem .4rem;
                font-size: 10px;
            }

            /* width increased in mobile view */
            .fixed {
                width: 210px;
            }

            /* *********** */
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0.95);
            }
        }

        .modal-btn_pulse {
            -webkit-transition: 0.3s;
            -o-transition: 0.3s;
            transition: 0.3s;
            animation: 1s ease-in-out infinite alternate pulse;
        }

        .modal-submit:hover {
            background-color: white;
            color: #B51F27;
        }

        .modal-submit:active {
            background-color: #B51F27;
            color: black;
        }

        .modal-reject:hover {
            color: #DD44AB;
        }

        .modal-reject:active {
            color: black;
        }
    </style>

    <!-- end of style for upsell modal -->


    <!-- html for upsell modal -->

    <div id="upsell-overlay" style="display: none;"></div>

    <div class="fixed" id="upsell-modal" style="display: none;">
        <div class=" upsell-modal">
            <div class="modal-container">
                <div class="modal-image">
                    <!-- src attribute will be set using javascript according to selected product -->
                    <img src="" alt="error showing picture" id="modal-img">
                </div>
                <div class="modal-text">
                    <p class="h1"> Exclusive Offer</p>
                    <p class="h2">Double Your Value</p>
                    <p class="h3">
                        Upgrade from 800MG (32 gummies/ packet) <br>
                        <b>to 1600MG (64 gummies/ packet)</b>
                    </p>
                    <p class="h4">
                        For Only <b>$10</b> More Per Packet
                    </p>

                </div>
            </div>
            <div class="modal-buttons">
                <button class="modal-submit modal-btn_pulse" id="upsellAccept">Yes, I Want To Add This</button>
                <button class="modal-reject" id="upsellReject">No, Thank You</button>
            </div>
        </div>
    </div>

    <!-- end of html for upsell modal -->

    <!--------Navigation-Section---------->


    <!-----------TOP SECTION---------->
    <div class="tpstrip">
        <div class="container bdinpad">
            <p class="tpstrip-txt">Warning: Due to extremely high media demand, there is limited supply of Revolt CBD
                Gummies in stock as of <span class="currentDate"></span> HURRY!</p>
        </div>
    </div>
    <div class="top-fix-bar">
        <!--------Navigation-Bar---------->
        <div class="header">
            <div class="container position bdinpad">
                <div class="row">
                    <div class="col-6">
                        <div class="logo"><a href="index.php"><img src="images/logo.jpg" alt="" class="logo"></a>
                        </div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="offer_header red">
                            Internet Exclusive Offers<br />
                            Available to USA Residents Only
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="checkout_content">



        <div class="container">


            <!-----------Checkout SECTION------->
            <div class="row">


                <!-----------Checkout_left SECTION------->
                <div class="col-8">
                    <div class="order__left">
                        <div class="steps">
                            <ul class="steps__list row">
                                <li class="steps__item">1. Shipping Info</li>
                                <li class="steps__item" style="background-color: #b51f28;color: #fff;">2. Finish Order
                                </li>
                                <li class="steps__item">3. Summary</li>
                            </ul>
                            <div class="approved-text">
                                <strong class="red"><span class="emphasis">APPROVED!</span> Free Packages
                                    Confirmed</strong>
                            </div>
                            <p>
                                Limited supply available as of
                                <span class="full-date date-container2"><span class="currentDate"></span></span>.
                                We currently have product <strong>in stock</strong> and ready to ship within 24 hours.
                            </p>
                            <p class="status-pr ">Sell Out Risk: <span class="red">HIGH</span></p>
                        </div>
                    </div>
                    <div class="product-selection">
                        <div class="product product1 active" onclick="setProductId(34374)" data-pkg="875" data-sub="197.70" data-unsub="224.50" data-desc="BUY 3 GET 2 FREE">

                            <div class="package-item ">
                                <div class="package_header">
                                    <div class="package_title">
                                        BUY 3 GET 2 FREE
                                    </div>
                                    <div class="package_shipping">
                                        FREE SHIPPING
                                    </div>
                                </div>
                                <div class="package_content ">
                                    <div class="package_select ">
                                        <img src="images/check_checkout.png" class="active_show" />
                                        <img src="images/check_checkout-reg.png" class="active_hide" />
                                    </div>
                                    <div class="package_product ">
                                        <img src="images/checkout3.png" />
                                        <div class="package__save">
                                            <span class="package__save_title">SAVE</span>
                                            <span class="package__save_item save-price price-top2" data-nosub="$225+" data-sub="$250+">$250+</span>
                                        </div>
                                    </div>
                                    <div class="package-info">
                                        <span class="package-info__title red">5 Month CBD Relief Pack</span>
                                        <span class="package-info__price">
                                            <p class="price-first"></p>
                                            <span>
                                                <span class="price-top" data-nosub="$44.90" data-sub="$39.54">$39.54</span>
                                                <p style="font-size:13px; font-weight:bold; margin-top:-5px;">Per Pack
                                                </p>
                                            </span>
                                        </span>
                                        <span class="package-info__retail mb-3 product1"> Retail -
                                            <span>$449.95</span></span>
                                        <span class="package-info__total"></span>
                                        <span class="package-info__btn" onclick="setProductId(34374)">Select
                                            Package</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="product product2" onclick="setProductId(34373)" data-pkg="874" data-sub="148.92" data-unsub="171.36" data-desc="BUY 2 GET 1 FREE">

                            <div class="package-item ">
                                <div class="package_header">
                                    <div class="package_title">
                                        BUY 2 GET 1 FREE
                                    </div>
                                    <div class="package_shipping">
                                        FREE SHIPPING
                                    </div>
                                </div>
                                <div class="package_content ">
                                    <div class="package_select ">
                                        <img src="images/check_checkout.png" class="active_show" />
                                        <img src="images/check_checkout-reg.png" class="active_hide" />
                                    </div>
                                    <div class="package_product ">
                                        <img src="images/checkout2.png" />
                                        <div class="package__save">
                                            <span class="package__save_title">SAVE</span>
                                            <span class="package__save_item save-price price-top2" data-nosub="$98+" data-sub="$119+">$119+</span>
                                        </div>
                                    </div>
                                    <div class="package-info ">
                                        <span class="package-info__title red">3 Month CBD Relief Pack</span>
                                        <span class="package-info__price">
                                            <p class="price-first"></p>
                                            <span>
                                                <span class="price-top" data-nosub="$57.12" data-sub="$49.64">$49.64</span>
                                                <p style="font-size:13px; font-weight:bold; margin-top:-5px;">Per Pack
                                                </p>
                                            </span>
                                        </span>
                                        <span class="package-info__retail mb-3 product2"> Retail - <span> $269.97</span>
                                        </span>
                                        <span class="package-info__total"></span>
                                        <span class="package-info__btn" onclick="setProductId(34373)">Select
                                            Package</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class=" product product3 " onclick="setProductId(34372)" data-pkg=" 873" data-sub="118.08" data-unsub="136.08" data-desc="BUY 1 GET 1 FREE">

                            <div class="package-item">
                                <div class="package_header">
                                    <div class="package_title">
                                        BUY 1 GET 1 FREE
                                    </div>
                                    <div class="package_shipping">
                                        FREE SHIPPING
                                    </div>
                                </div>
                                <div class="package_content ">
                                    <div class="package_select ">
                                        <img src="images/check_checkout.png" class="active_show" />
                                        <img src="images/check_checkout-reg.png" class="active_hide" />
                                    </div>
                                    <div class="package_product ">
                                        <img src="images/checkout1.png" />
                                        <div class="package__save">
                                            <span class="package__save_title">SAVE</span>
                                            <span class="package__save_item save-price price-top2" data-nosub="$43" data-sub="$60">$60</span>
                                        </div>

                                    </div>
                                    <div class="package-info ">
                                        <span class="package-info__title red">2 Month CBD Relief Pack</span>
                                        <span class="package-info__price">
                                            <p class="price-first"></p>
                                            <span>
                                                <span class="price-top" data-nosub="$68.04" data-sub="$59.04">$59.04</span>
                                                <p style="font-size:13px; font-weight:bold; margin-top:-5px;">Per Pack
                                                </p>
                                            </span>
                                        </span>
                                        <span class="package-info__retail mb-3 product3"> Retail - <span> $179.98</span>
                                        </span>
                                        <span class="package-info__total"></span>
                                        <span class="package-info__btn" onclick="setProductId(34372)">Select
                                            Package</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="stamps">
                        <img src="images/stamps.png" />
                    </div>

                    <div class="gurantee_box">
                        <div class="gurantee_header">
                            30 DAY MONEY BACK GUARANTEE
                        </div>
                        <div class="row px-3">
                            <div class="col-3 pt-3">
                                <img src="images/moneyback.png" />
                            </div>
                            <div class="col-9">
                                <div class="row" hidden>
                                    <div class="col-6 text-center">
                                        <strong class="red">Product</strong><br />
                                        <span id="sub-prodnm">BUY 3 GET 2 FREE</span>
                                    </div>
                                    <div class="col-6 text-center">
                                        <strong class="red">Total</strong><br />
                                        <span id="sub-tot">$197.70</span>
                                    </div>
                                </div>
                                <p>We are so confident in our products and services, that we back it
                                    with a 30 day money back guarantee. If for any reason you are not
                                    fully satisfied with our products, simply return the purchased products
                                    in the original container within 30 days of when you received your
                                    order. We will refund you 100% of the purchase price - with
                                    absolutely no hassle.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-----------Checkout_left SECTION------->
                <div class="col-4">
                    <div class="payment_box">
                        <div class="payment_header">
                            FINAL STEP:<br />
                            PAYMENT INFORMATION
                        </div>
                        <span style="color:#FF0000; font-weight:bold;">
                            <div class="errorMessage"></div>
                        </span>
                        <div class="accepted_cards">
                            <strong>We Accept</strong>
                            <img src="images/cards.png" />
                        </div>
                        <div class="payment_form">

                            <!-- action="api/createOrder.php" -->
                            <form id="checkoutForm" method="post">
                                <label for="payment_as_shipping" class="payment_as_shipping_label">
                                    <input type="checkbox" value="1" name="billingSameAsShipping" checked="checked" class="payment_as_shipping" id="payment_as_shipping">
                                    <span>Billing same as Shipping</span>
                                </label>
                                <div style="display: none;" class="billing-info">

                                    <div class="billing-title">Billing Information</div>
                                    <div class="form-holder">
                                        <label>First Name: </label>
                                        <input type="text" class="form-control" name="billingFirstName" value="" placeholder="Billing First Name">

                                    </div>
                                    <div class="form-holder" placeholder="Last Name*">
                                        <label>Last Name: </label>
                                        <input type="text" class="form-control" name="billingLastName" value="" placeholder="Billing Last Name">

                                    </div>
                                    <div class=" form-holder">
                                        <label>Address:</label>
                                        <input type="text" class="form-control" id="gmap_autocomplete" name="billingAddress" value="" placeholder="Billing Address">

                                    </div>
                                    <div class=" form-holder">
                                        <label>Zip Code:</label>
                                        <input type="tel" class="form-control numeric-data" maxlength="5" id="zip" name="billingZip" value="" placeholder="Billing Zip Code">

                                    </div>
                                    <div class="form-holder">
                                        <label>City:</label>
                                        <input type="text" class="form-control" id="city" name="billingCity" value="" placeholder="Billing City">

                                    </div>
                                    <div class=" form-holder">
                                        <label>State/Region:</label>
                                        <select name="state" class="w100 form-control" aria-label=".form-select-lg example" aria-required="true">
                                            <option selected="" value="">Select State</option>
                                            <option value="Alabama">Alabama</option>
                                            <option value="Alaska">Alaska</option>
                                            <option value="Arizona">Arizona</option>
                                            <option value="Arkansas">Arkansas</option>
                                            <option value="California">California</option>
                                            <option value="Colorado">Colorado</option>
                                            <option value="Connecticut">Connecticut</option>
                                            <option value="Delaware">Delaware</option>
                                            <option value="District Of Columbia">District Of Columbia</option>
                                            <option value="Florida">Florida</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Hawaii">Hawaii</option>
                                            <option value="Idaho">Idaho</option>
                                            <option value="Illinois">Illinois</option>
                                            <option value="Indiana">Indiana</option>
                                            <option value="Iowa">Iowa</option>
                                            <option value="Kansas">Kansas</option>
                                            <option value="Kentucky">Kentucky</option>
                                            <option value="Louisiana">Louisiana</option>
                                            <option value="Maine">Maine</option>
                                            <option value="Maryland">Maryland</option>
                                            <option value="Massachusetts">Massachusetts</option>
                                            <option value="Michigan">Michigan</option>
                                            <option value="Minnesota">Minnesota</option>
                                            <option value="Mississippi">Mississippi</option>
                                            <option value="Missouri">Missouri</option>
                                            <option value="Montana">Montana</option>
                                            <option value="Nebraska">Nebraska</option>
                                            <option value="Nevada">Nevada</option>
                                            <option value="New Hampshire">New Hampshire</option>
                                            <option value="New Jersey">New Jersey</option>
                                            <option value="New Mexico">New Mexico</option>
                                            <option value="New York">New York</option>
                                            <option value="North Carolina">North Carolina</option>
                                            <option value="North Dakota">North Dakota</option>
                                            <option value="Ohio">Ohio</option>
                                            <option value="Oklahoma">Oklahoma</option>
                                            <option value="Oregon">Oregon</option>
                                            <option value="Pennsylvania">Pennsylvania</option>
                                            <option value="Rhode Island">Rhode Island</option>
                                            <option value="South Carolina">South Carolina</option>
                                            <option value="South Dakota">South Dakota</option>
                                            <option value="Tennessee">Tennessee</option>
                                            <option value="Texas">Texas</option>
                                            <option value="Utah">Utah</option>
                                            <option value="Vermont">Vermont</option>
                                            <option value="Virginia">Virginia</option>
                                            <option value="Washington">Washington</option>
                                            <option value="West Virginia">West Virginia</option>
                                            <option value="Wisconsin">Wisconsin</option>
                                            <option value="Wyoming">Wyoming</option>

                                        </select>
                                    </div>

                                    <div class="billing-title">Payment Information</div>
                                </div>
                                <input type="hidden" name="productID" id="productId" value="">
                                <input type="hidden" name="inlineRadioOptions" id="" value="no">
                                <input type="hidden" name="cc_type" id="cc_type" value="VI">
                                <label>Card Number: </label>
                                <input type="text" name="cc_number" id="cc_number" class="cc_number w100 switch-card validate-credit-card js-add-cc-type floatlabel" placeholder="Card Number" required>
                                <label>Name On Card: </label>
                                <input type="text" class="w100" name="cardName" placeholder="Name on Card" required>
                                <div class="w100">
                                    <label>Card Expiry Date :</label>
                                    <select class="form-select inline-50" id="month" name="month" required>
                                        <option value="">Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <select id="year" name="year" class="form-select inline-50" required>
                                        <option value="">Year</option>
                                    </select>

                                </div>
                                <label>Security Code :</label>
                                <input placeholder="CVV" class="cc_code w100 floatlabel" type="tel" name="cc_cvv2" id="cc_code" maxlength="3" autocomplete="cc-csc" required="required" style="transition: all 0.2s ease-in-out 0s;">
                                <div class="w50 placeholder_text">Where can I find my Security Code?</div>

                                <div class="secure-icon"><span>Secure 256-bit SSL Encryption</span></div>

                                <div class="text-center">
                                    <button type="submit" class="large_btn">Rush My Order</button>
                                    <div class="section section-check">

                                        <label for="special-gift" class="regular">
                                            <input type="checkbox" <?php echo (isset($_SESSION['flow']) && $_SESSION['flow'] == 'check') ? 'checked' : ''; ?> id="special-gift" value="34569" name="special-gift" class="paymentas_shipping form-check-input" style="-webkit-appearance: checkbox;width: 15px;height:  15px;display:inline-block" />
                                            <span class="dim-checkbox"></span>
                                            <span>As a special gift you will get instant access to one of our dedicated Revolt Health Coaches for only $99.95, save 50%.</span>
                                        </label>
                                        <label for="is_reaccouring" class="regular">
                                            <input type="checkbox" value="1" <?php echo (isset($_SESSION['flow']) && $_SESSION['flow'] == 'check') ? 'checked' : ''; ?> id="is_reaccouring" name="is_reaccouring" class="paymentas_shipping form-check-input" style="width: 15px;height:  15px;display:inline-block">
                                            <span class="dim-checkbox"></span>
                                            <span>Subscribe & Save</span>
                                        </label>
                                    </div>

                                </div>
                                <div class="popup" id="processingPopup">
                                    <div class="popup-content">
                                        <div class="loading-animation"></div>
                                        Please wait for 5 to 10 seconds while we process your request.
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <!-----------Checkout_right SECTION------->


                <!-----------Checkout_right SECTION------->
            </div>
        </div>

    </div>

    <!-----------Checkout SECTION------->

    <!-----------FOOTER---------->
    <section class="footer-top">
        <div class="ftrstrip dsplay">
            <div class="container bdinpad">

                <ul class="ftrstrip-list dsplay">
                    <li>
                        <img src="images/safety.png" alt="">
                        <p><span class="span1">Safe & Secure </span><br>
                            <span class="span2">Encrypted Checkout</span>
                        </p>
                    </li>
                    <li>
                        <img src="images/deliver.png" alt="">
                        <p> <span class="span1">Fast Shipping</span><br>
                            <span class="span2">Across U.S.A. </span>
                        </p>
                    </li>
                    <li>
                        <img src="images/contact.png" alt="">
                        <p><span class="span1">Phone & Email </span><br>
                            <span class="span2">Customer Support</span>
                        </p>
                    </li>
                </ul>
            </div>
        </div>

    </section>

    <footer class="dsplay">
        <div class="container bdinpad">
            <p class="text-center s2txt bdfont">© 2023 REVOLT CBD</p>
            <ul class="ftrlist1">
                <li>Revolt CBD 216 S. 22nd Elwood, IN 46031 US </li>
                <li> support@tryrevoltcbd.com</li>
                <li><a href="/ss/terms.php" target="_blank">Terms &amp; Conditions</a></li>
                <li><a href="/ss/privacy.php" target="_blank">Priacy Policy</a></li>
            </ul>
            <div class="text-center">
                <p> * The product is not approved by the FDA. This product is not intended to diagnose, treat, cure, or
                    prevent any disease. Photographs are for dramatization purposes only and may include models.
                    Results may vary based on time and degree of product usage.</p>
                <br>
                <p>These statements have not been evaluated by the FDA. If you are pregnant, nursing, taking
                    medications, or have a medical condition, consult your physician before using this product.
                    Representations regarding the efficacy and safety of CBD have not been evaluated by the Food and
                    Drug Administration. The FDA only evaluates foods and drugs, not supplements or products like these
                    products. These products are not intended to diagnose, prevent, treat, or cure any disease. <a href="https://pubmed.ncbi.nlm.nih.gov/26341731/" target="_blank">Click Here</a> to find evidence
                    of a test, analysis, research or study describing the benefits, performance or efficacy of CBD based
                    on the expertise of relevant professionals.</p>
            </div>


        </div>
    </footer>
    <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="js/slick.js"></script>
    <script type="text/javascript" src="js/popupwindow.js"></script>
    <script src="js/bookmarkscroll.js"></script>
    <script src="js/common.js"></script>
    <script type="text/javascript" src="js/jquery.h5validate.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="js/social-proof.js"></script>

    <script type="text/javascript">
        $(document).scroll(function() {

            if ($(this).scrollTop() > 110) {
                $('.top-fix-bar').addClass('fixed-nav');
            } else {
                $('.top-fix-bar').removeClass('fixed-nav');
            }
        });
        (() => {
            let year_satart = 2024;
            let year_end = 2035; // current year
            let year_selected = 2023;

            let option = '';
            option = '<option value="">Year</option>'; // first option

            for (let i = year_satart; i <= year_end; i++) {
                let selected = (i === year_selected ? ' selected' : '');
                option += '<option value="' + (i - 2000) + '"' + selected + '>' + i + '</option>';
            }

            document.getElementById("year").innerHTML = option;
        })();
    </script>

    <script>
        // Get all the product divs
        const productDivs = document.querySelectorAll('.product');

        // Add click event listener to each product div
        productDivs.forEach((productDiv) => {
            productDiv.addEventListener('click', () => {
                // Remove 'active' class from all product divs
                productDivs.forEach((div) => {
                    div.classList.remove('active');
                });

                // Add 'active' class to the clicked product div
                productDiv.classList.add('active');
            });
        });
    </script>

    <script>
        // 34173

        function setProductId(id) {
            var is_reaccouring = $('#is_reaccouring').is(':checked');

            if (is_reaccouring) {
                $('.product1 .price-top').html($('.product1 .price-top').attr('data-sub') + "<br>");
                $('.product1 .price-top2').html($('.product1 .price-top2').attr('data-sub'));

                $('.product2 .price-top').html($('.product2 .price-top').attr('data-sub') + "<br>");
                $('.product2 .price-top2').html($('.product2 .price-top2').attr('data-sub'));

                $('.product3 .price-top').html($('.product3 .price-top').attr('data-sub') + "<br>");
                $('.product3 .price-top2').html($('.product3 .price-top2').attr('data-sub'));
            } else {
                $('.product1 .price-top').html($('.product1 .price-top').attr('data-nosub') + "<br>");
                $('.product1 .price-top2').html($('.product1 .price-top2').attr('data-nosub'));

                $('.product2 .price-top').html($('.product2 .price-top').attr('data-nosub') + "<br>");
                $('.product2 .price-top2').html($('.product2 .price-top2').attr('data-nosub'));

                $('.product3 .price-top').html($('.product3 .price-top').attr('data-nosub') + "<br>");
                $('.product3 .price-top2').html($('.product3 .price-top2').attr('data-nosub'));
            }
            if (id == '34372' || id == '34342') {
                if (is_reaccouring) {
                    $("#sub-prodnm").html("ME: Revolt CBD Subscription Buy 1 Get 1 Free");
                    $("#sub-tot").html('$118.08');
                    $("#productId").val('34342');
                } else {
                    $("#sub-prodnm").html("ME: Revolt CBD Gummies - 2 Packets");
                    $("#sub-tot").html('$136.08');
                    $("#productId").val('34372');
                }
            } else if (id == '34373' || id == '34345') {
                if (is_reaccouring) {
                    $("#sub-prodnm").html("ME: Revolt CBD Subscription Buy 2 Get 1 Free");
                    $("#sub-tot").html('$148.92');
                    $("#productId").val('34345');
                } else {
                    $("#sub-prodnm").html("ME: Revolt CBD Gummies - 3 Packets");
                    $("#sub-tot").html('$171.36');
                    $("#productId").val('34373');
                }
            } else if (id == '34374' || id == '34346') {
                if (is_reaccouring) {
                    $("#sub-prodnm").html("ME: Revolt CBD Subscription Buy 3 Get 2 Free");
                    $("#sub-tot").html('$197.70');
                    $("#productId").val('34346');
                } else {
                    $("#sub-prodnm").html("ME: Revolt CBD Gummies - 5 Packets");
                    $("#sub-tot").html('$224.50');
                    $("#productId").val('34374');
                }
            }
        }

        $("#is_reaccouring").change(function() {
            var productId = $("#productId").val();
            setProductId(productId);
        });



        $(document).ready(function() {


                // variables for upsellmodal, overlay for modal and upsell buttons

                var upsellmodel = document.getElementById('upsell-modal');
                var upoverlay = document.getElementById('upsell-overlay');
                var upsellaccept = document.getElementById('upsellAccept');
                var upsellreject = document.getElementById('upsellReject');


                setProductId('34374');
                var showShowing = $("#shipping-billing").html();

                $("#checkoutForm").on("submit", function(e) {
                    e.preventDefault();
                    productsList = ['34372', '34373', '34374', '34342', '34345', '34346'];
                    var selectedProduct = $("#productId").val();

                    // show the overlay and modal
                    upoverlay.style.display = 'block';
                    upsellmodel.style.display = 'block';

                    // set the image for the upsell popup modal according to the selected product
                    switch (selectedProduct) {
                        case "<?php echo $GLOBALS['OriginalProductID1']; ?>":
                            document.getElementById("modal-img").src = "images/product1.png";

                            var productId = <?php echo $GLOBALS['OriginalProductID1']; ?>;
                            break;
                        case "<?php echo $GLOBALS['OriginalProductID2']; ?>":
                            document.getElementById("modal-img").src = "images/product2.png";
                            var productId = <?php echo $GLOBALS['OriginalProductID2']; ?>;
                            break;
                        case "<?php echo $GLOBALS['OriginalProductID3']; ?>":
                            document.getElementById("modal-img").src = "images/product3.png";
                            var productId = <?php echo $GLOBALS['OriginalProductID3']; ?>;
                            break;
                        case "<?php echo $GLOBALS['SaveAndSubscribeProduct1']; ?>":
                            document.getElementById("modal-img").src = "images/product1.png";

                            var productId = <?php echo $GLOBALS['SaveAndSubscribeProduct1']; ?>;
                            break;
                        case "<?php echo $GLOBALS['SaveAndSubscribeProduct2']; ?>":
                            document.getElementById("modal-img").src = "images/product2.png";
                            var productId = <?php echo $GLOBALS['SaveAndSubscribeProduct2']; ?>;
                            break;
                        case "<?php echo $GLOBALS['SaveAndSubscribeProduct3']; ?>":
                            document.getElementById("modal-img").src = "images/product3.png";
                            var productId = <?php echo $GLOBALS['SaveAndSubscribeProduct3']; ?>;
                            break;
                        default:
                            break;
                    }

                    var formData = $(this).serializeArray();
                    var isSubscribed = document.getElementById('is_reaccouring').checked;
                    var subsValue = isSubscribed ? "YES" : "NO";

                    if (!productsList.includes(selectedProduct)) {
                        alert("Please select a package");
                    } else {


                        /* 

                        if upsell modal is accepted then this below function will push addition data with form i.e. product id of that upsell product shown in model.
                        */

                        upsellaccept.onclick = function() {

                            upsellmodel.style.display = 'none';
                            upoverlay.style.display = 'none';

                            formData.push({
                                name: "upsellDoubleProductID",
                                value: productId
                            });

                            $.ajax({

                                method: "POST",
                                url: "api/createOrder.php",
                                data: formData,

                                beforeSend: function() {
                                    document.getElementById('processingPopup').style.display = 'block';
                                },

                                success: res => {
                                    $.LoadingOverlay("hide");
                                    console.log(res);
                                    const data = JSON.parse(res);
                                    console.log(data);
                                    if (data.Status === 1) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Something went wrong!',
                                        });
                                    } else if (res.includes("Invalid Credit Card Number")) {
                                        document.getElementById('processingPopup').style.display = 'none';
                                        $(".errorMessage").show();
                                        $(".errorMessage")
                                            .text("Your card was declined. Please check your card number, CVV, and expiration date again and then resubmit.");
                                        $("html, body").animate({
                                            scrollTop: $(".errorMessage").offset().top - 100
                                        }, 1000);
                                        $(".errorMessage").animate({
                                                marginLeft: '-=10px'
                                            }, 1000)
                                            .animate({
                                                marginLeft: '+=20px'
                                            }, 1000)
                                            .animate({
                                                marginLeft: '-=20px'
                                            }, 800)
                                            .animate({
                                                marginLeft: '+=20px'
                                            }, 400)
                                            .animate({
                                                marginLeft: '-=10px'
                                            }, 1000);

                                        return false;
                                    } else {

                                        redirectToSubsPage();

                                    }

                                }
                            })
                        }


                        // if upsell is rejected then no additional data is added and ajax is initiated.


                        upsellreject.onclick = function() {

                            upoverlay.style.display = 'none';
                            upsellmodel.style.display = 'none';

                            $.ajax({

                                method: "POST",
                                url: "api/createOrder.php",
                                data: formData,

                                beforeSend: function() {
                                    document.getElementById('processingPopup').style.display = 'block';
                                },

                                success: res => {
                                    $.LoadingOverlay("hide");
                                    console.log(res);
                                    const data = JSON.parse(res);
                                    console.log(data);
                                    if (data.Status === 1) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Something went wrong!',
                                        });
                                    } else if (res.includes("Invalid Credit Card Number")) {
                                        document.getElementById('processingPopup').style.display = 'none';
                                        $(".errorMessage").show();
                                        $(".errorMessage")
                                            .text("Your card was declined. Please check your card number, CVV, and expiration date again and then resubmit.");
                                        $("html, body").animate({
                                            scrollTop: $(".errorMessage").offset().top - 100
                                        }, 1000);
                                        $(".errorMessage").animate({
                                                marginLeft: '-=10px'
                                            }, 1000)
                                            .animate({
                                                marginLeft: '+=20px'
                                            }, 1000)
                                            .animate({
                                                marginLeft: '-=20px'
                                            }, 800)
                                            .animate({
                                                marginLeft: '+=20px'
                                            }, 400)
                                            .animate({
                                                marginLeft: '-=10px'
                                            }, 1000);

                                        return false;
                                    } else {

                                        redirectToSubsPage();

                                    }

                                }
                            })
                        }

                    }
                });

                // Function to handle redirection
                function redirectToSubsPage(subsValue) {
                    const origin = window.location.origin;
                    var pathArray = window.location.pathname.split('/');
                    pathArray.pop();
                    // var newURL = window.location.protocol + "//" + window.location.host + ("/" + pathArray.join("/") + "/dev/success.php").replace("//" , "/")+"?subs=" + subsValue
                    var newURL = window.location.protocol + "//" + window.location.host + ("/" + pathArray.join("/") + "/success.php").replace("//", "/") + "?subs=" + subsValue
                    window.location.href = newURL;
                }

                $("input[name='inlineRadioOptions']").change(function() {
                    if ($(this).val() === 'no') {
                        $("#shipping-billing").html(showShowing)
                        $("#shipping-billing").show();
                    } else {
                        $("#shipping-billing").html('')
                        $("#shipping-billing").hide();
                    }
                });


                $(".cc_number").on("change", function() {
                    var e = $(".cc_number");
                    e.hasClass("AX") ? $("#your-cvv").text("This 4-digit code can be found on the front of your American Express card, above your card number.") : (e.hasClass("VI") || e.hasClass("MC") || e.hasClass("DI"), $("#your-cvv").text("This 3-digit code can be found on the back of your card."))
                })
            }), $(".cc_number").on("keypress", function() {
                var e = $(".cc_number");
                e.hasClass("VI") ? ($("#your-card").attr("src", "assets/images/creditCard-visa.webp"), $("#cc_code").attr("maxlength", "3"), $("#cc_number").attr("maxlength", "19"), $("#cc_number").mask("0000 0000 0000 0000")) : e.hasClass("MC") ? ($("#your-card").attr("src", "assets/images/creditCard-mc.webp"), $("#cc_code").attr("maxlength", "3"), $("#cc_number").attr("maxlength", "19"), $("#cc_number").mask("0000 0000 0000 0000")) : e.hasClass("AX") ? ($("#your-card").attr("src", "assets/images/creditCards-amex.webp"), $("#cc_code").attr("maxlength", "4"), $("#cc_number").attr("maxlength", "18"), $("#cc_number").mask("0000 000000 00000")) : (e.hasClass("DI") ? $("#your-card").attr("src", "assets/images/creditCard-discover.webp") : $("#your-card").attr("src", "assets/images/creditCard-default.webp"), $("#cc_code").attr("maxlength", "3"), $("#cc_number").attr("maxlength", "19"), $("#cc_number").mask("0000 0000 0000 0000"))
            }), $("#cc_code").focus(function() {
                var e = $(".cc_number");
                e.hasClass("VI") ? $("#your-code").attr("src", "assets/images/creditCard-cvc.webp") : e.hasClass("MC") ? $("#your-code").attr("src", "assets/images/creditCard-cvc.webp") : e.hasClass("AX") ? $("#your-code").attr("src", "assets/images/creditCard-ccvc.png") : e.hasClass("DI") ? $("#your-code").attr("src", "assets/images/creditCard-cvc.webp") : $("#your-code").attr("src", "assets/images/creditCard-default.webp")
            }), $("#cc_code").blur(function() {
                var e = $(".cc_number");
                e.hasClass("VI") ? $("#your-card").attr("src", "assets/images/creditCard-visa.webp") : e.hasClass("MC") ? $("#your-card").attr("src", "assets/images/creditCard-mc.webp") : e.hasClass("AX") ? $("#your-card").attr("src", "assets/images/creditCard-amex.webp") : e.hasClass("DI") && $("#your-card").attr("src", "assets/images/creditCard-discover.webp")
            }),
            $(".validate-credit-card").on("input", function() {
                try {
                    var e = $(this).val().replace(/\D/g, ""),
                        t = !1,
                        a = "";
                    (e.match(/^4/) ? (a = "VI", $('input[name="cc_type"]').val(a), $('input[name="cc_number"]').mask("0000 0000 0000 0000"), $('input[name="cc_cvv2"]').mask("000"), $(".js-add-cc-type").removeClass("VI").removeClass("DI").removeClass("AX").removeClass("MC").addClass(a)) : e.match(/^5[1-5]/) ? (a = "MC", $('input[name="cc_type"]').val(a), $('input[name="cc_number"]').mask("0000 0000 0000 0000"), $('input[name="cc_cvv2"]').mask("000"), $(".js-add-cc-type").removeClass("VI").removeClass("DI").removeClass("AX").removeClass("MC").addClass(a)) : e.match(/^(?:6011|65[0-9]{2}|64[4-9][0-9])/) ? (a = "DI", $('input[name="cc_type"]').val(a), $('input[name="cc_number"]').mask("0000 0000 0000 0000"), $('input[name="cc_cvv2"]').mask("000"), $(".js-add-cc-type").removeClass("VI").removeClass("DI").removeClass("AX").removeClass("MC").addClass(a)) : e.match(/^(?:34|37)/) ? (a = "AX", $('input[name="cc_type"]').val(a), $('input[name="cc_number"]').mask("0000 000000 00000"), $('input[name="cc_cvv2"]').mask("0000"), $(".js-add-cc-type").removeClass("VI").removeClass("DI").removeClass("AX").removeClass("MC").addClass(a)) : ($('input[name="cc_type"]').val(""), $('input[name="cc_number"]').mask("0000 0000 0000 0000"), $('input[name="cc_cvv2"]').mask("000"), $(".js-add-cc-type").removeClass("VI").removeClass("DI").removeClass("AX").removeClass("MC")), e.match(/^4[0-9]{15}$/) ? t = !0 : e.match(/^5[1-5][0-9]{14}$/) ? t = !0 : e.match(/^(?:6011|65[0-9]{2}|64[4-9][0-9])[0-9]{12}$/) ? t = !0 : e.match(/^(?:34|37)[0-9]{13}$/) && (t = !0), t) ? function(e) {
                        return !/[^0-9-\s]+/.test(e) && i(e)
                    }(e) ? this.setCustomValidity(""): this.setCustomValidity(""): this.setCustomValidity("")
                } catch (err) {

                }
            }), $(".validate-credit-card").focusout(function() {
                $(this).val($.trim($(this).val()))
            }), $('input[name="cc_cvv2"]').focus(function() {
                $(".js-add-cc-type").addClass("cvv_view")
            }), $('input[name="cc_cvv2"]').focusout(function() {
                $(".js-add-cc-type").removeClass("cvv_view")
            }), $.isFunction($.fn.mask) && ("undefined" != typeof no_cc_mask && no_cc_mask || ($('input[name="cc_number"]').mask("0000 0000 0000 0000"), $('input[name="cc_expire_date_month_year"]').mask("00/00"), $('input[name="cc_cvv2"]').mask("000")));


        $(document).ready(function() {
            $(".cardYear").keyup(function(e) {
                formatString(e)
            });
        });

        function formatString(e) {
            var inputChar = String.fromCharCode(event.keyCode);
            var code = event.keyCode;
            var allowedKeys = [8];
            if (allowedKeys.indexOf(code) !== -1) {
                return;
            }

            event.target.value = event.target.value.replace(
                /^([1-9]\/|[2-9])$/g, '0$1/' // 3 > 03/
            ).replace(
                /^(0[1-9]|1[0-2])$/g, '$1/' // 11 > 11/
            ).replace(
                /^([0-1])([3-9])$/g, '0$1/$2' // 13 > 01/3
            ).replace(
                /^(0?[1-9]|1[0-2])([0-9]{2})$/g, '$1/$2' // 141 > 01/41
            ).replace(
                /^([0]+)\/|[0]+$/g, '0' // 0/ > 0 and 00 > 0
            ).replace(
                /[^\d\/]|^[\/]*$/g, '' // To allow only digits and `/`
            ).replace(
                /\/\//g, '/' // Prevent entering more than 1 `/`
            );
        }
        let timer = 1080; // 2 minutes in seconds
        let milSec = 60; // 2 minutes in seconds
        let interval;
    </script>
    <script>
        // Get the current date
        var currentDate = new Date();

        // Format the date as desired (e.g., "May 27, 2023")
        var formattedDate = currentDate.toLocaleDateString("en-US", {
            year: "numeric",
            month: "long",
            day: "numeric"
        });

        // Display the formatted date in all elements with the class "currentDate"
        var elements = document.getElementsByClassName("currentDate");
        for (var i = 0; i < elements.length; i++) {
            elements[i].innerHTML = formattedDate;
        }
    </script>
    <script>
        // Get references to the checkbox and billing-info div
        const checkbox = document.getElementById('payment_as_shipping');
        const billingInfoDiv = document.querySelector('.billing-info');

        // Add an event listener to the checkbox for state changes
        checkbox.addEventListener('change', function() {
            // If the checkbox is checked, hide the billing-info div
            if (checkbox.checked) {
                billingInfoDiv.style.display = 'none';
            } else {
                // If the checkbox is unchecked, display the billing-info div
                billingInfoDiv.style.display = 'block';
            }
        });
    </script>
    <script>
        var customerFirst = ['Liam', 'Emma', 'Noah', 'Olivia', 'William', 'Ava', 'James', 'Isabella', 'Logan', 'Sophia', 'Benjamin', 'Mia', 'Mason', 'Charlotte', 'Elijah', 'Amelia', 'Oliver', 'Evelyn', 'Jacob', 'Abigail', 'Lucas', 'Harper', 'Michael', 'Emily', 'Alexander', 'Elizabeth', 'Ethan', 'Avery', 'Daniel', 'Sofia', 'Matthew', 'Ella', 'Aiden', 'Madison', 'Henry', 'Scarlett', 'Joseph', 'Victoria', 'Jackson', 'Aria', 'Samuel', 'Grace', 'Sebastian', 'Chloe', 'David', 'Camila', 'Carter', 'Penelope', 'Wyatt', 'Riley', 'Jayden', 'Layla', 'John', 'Lillian', 'Owen', 'Nora', 'Dylan', 'Zoey', 'Luke', 'Mila', 'Gabriel', 'Aubrey', 'Anthony', 'Hannah', 'Isaac', 'Lily', 'Grayson', 'Addison', 'Jack', 'Eleanor', 'Julian', 'Natalie', 'Levi', 'Luna', 'Christopher', 'Savannah', 'Joshua', 'Brooklyn', 'Andrew', 'Leah', 'Lincoln', 'Zoe', 'Mateo', 'Stella', 'Ryan', 'Hazel', 'Jaxon', 'Ellie', 'Nathan', 'Paisley', 'Aaron', 'Audrey', 'Isaiah', 'Skylar', 'Thomas', 'Violet', 'Charles', 'Claire', 'Caleb', 'Bella', 'Josiah', 'Aurora', 'Christian', 'Lucy', 'Hunter', 'Anna', 'Eli', 'Samantha', 'Jonathan', 'Caroline', 'Connor', 'Genesis', 'Landon', 'Aaliyah', 'Adrian', 'Kennedy', 'Asher', 'Kinsley', 'Cameron', 'Allison', 'Leo', 'Maya', 'Theodore', 'Sarah', 'Jeremiah', 'Madelyn', 'Hudson', 'Adeline', 'Robert', 'Alexa', 'Easton', 'Ariana', 'Nolan', 'Elena', 'Nicholas', 'Gabriella', 'Ezra', 'Naomi', 'Colton', 'Alice', 'Angel', 'Sadie', 'Brayden', 'Hailey', 'Jordan', 'Eva', 'Dominic', 'Emilia', 'Austin', 'Autumn', 'Ian', 'Quinn', 'Adam', 'Nevaeh', 'Elias', 'Piper', 'Jaxson', 'Ruby', 'Greyson', 'Serenity', 'Jose', 'Willow', 'Ezekiel', 'Everly', 'Carson', 'Cora', 'Evan', 'Kaylee', 'Maverick', 'Lydia', 'Bryson', 'Aubree', 'Jace', 'Arianna', 'Cooper', 'Eliana', 'Xavier', 'Peyton', 'Parker', 'Melanie', 'Roman', 'Gianna', 'Jason', 'Isabelle', 'Santiago', 'Julia', 'Chase', 'Valentina', 'Sawyer', 'Nova', 'Gavin', 'Clara', 'Leonardo', 'Vivian', 'Kayden', 'Reagan', 'Ayden', 'Mackenzie', 'Jameson', 'Madeline', 'Noah', 'William', 'James', 'Logan', 'Benjamin', 'Mason', 'Elijah', 'Oliver', 'Jacob', 'Lucas', 'Michael', 'Alexander', 'Ethan', 'Daniel', 'Matthew', 'Aiden', 'Henry', 'Joseph', 'Jackson', 'Samuel', 'Sebastian', 'David', 'Carter', 'Wyatt', 'Jayden', 'John', 'Owen', 'Dylan', 'Luke', 'Gabriel', 'Anthony', 'Isaac', 'Grayson', 'Jack', 'Julian', 'Levi', 'Christopher', 'Joshua', 'Andrew', 'Lincoln', 'Mateo', 'Ryan', 'Jaxon', 'Nathan', 'Aaron', 'Isaiah', 'Thomas', 'Charles', 'Caleb', 'Josiah', 'Christian', 'Hunter', 'Eli', 'Jonathan', 'Connor', 'Landon', 'Adrian', 'Asher', 'Cameron', 'Leo', 'Theodore', 'Jeremiah', 'Hudson', 'Robert', 'Easton', 'Nolan', 'Nicholas', 'Ezra', 'Colton', 'Angel', 'Brayden', 'Jordan', 'Dominic', 'Austin', 'Ian', 'Adam', 'Elias', 'Jaxson', 'Greyson', 'Jose', 'Ezekiel', 'Carson', 'Evan', 'Maverick', 'Bryson', 'Jace', 'Cooper', 'Xavier', 'Parker', 'Roman', 'Jason', 'Santiago', 'Chase', 'Sawyer', 'Gavin', 'Leonardo', 'Kayden', 'Ayden', 'Jameson', 'Kevin', 'Bentley', 'Zachary', 'Everett', 'Axel', 'Tyler', 'Micah', 'Vincent', 'Weston', 'Miles', 'Wesley', 'Nathaniel', 'Harrison', 'Brandon', 'Cole', 'Declan', 'Luis', 'Braxton', 'Damian', 'Silas', 'Tristan', 'Ryder', 'Bennett', 'George', 'Emmett', 'Justin', 'Kai', 'Max', 'Diego', 'Luca', 'Ryker', 'Carlos', 'Maxwell', 'Kingston', 'Ivan', 'Maddox', 'Juan', 'Ashton', 'Jayce', 'Rowan', 'Kaiden', 'Giovanni', 'Eric', 'Jesus', 'Calvin', 'Abel', 'King', 'Camden', 'Amir', 'Blake', 'Alex', 'Brody', 'Malachi', 'Emmanuel', 'Jonah', 'Beau', 'Jude', 'Antonio', 'Alan', 'Elliott', 'Elliot', 'Waylon', 'Xander', 'Timothy', 'Victor', 'Bryce', 'Finn', 'Brantley', 'Edward', 'Abraham', 'Patrick'];
        var customerLast = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        var products = ['Revolt CBD Gummies', 'Revolt CBD Gummies', 'Revolt CBD Gummies', 'Revolt CBD Gummies', 'Revolt CBD Gummies'];

        var customerStates = ['AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'FL', 'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM', 'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VT', 'VA', 'WA', 'WV', 'WI', 'WY'];
        var customerQuantities = ['2', '3', '5'];

        function getRandomValue(arr) {
            return arr[Math.floor(Math.random() * arr.length)];
        }

        function setContentOfElement(id, text) {
            try {
                const elementFound = document.getElementById(id);
            } catch (error) {
                console.error("Element with id " + id + " not found");
            }
        }

        function getById(id) {
            return document.getElementById(id);
        }

        function updateNotification() {
            var customerFirstName = getRandomValue(customerFirst);
            var customerLastName = getRandomValue(customerLast);
            var quantity = Math.floor(Math.random() * 5) + 1; // Random quantity between 1 and 5
            var product = getRandomValue(products);
            var minutesAgo = Math.floor(Math.random() * 60); // Random minutes between 0 and 59
            var state = getRandomValue(customerStates); // Random state

            var customerName = customerFirstName + ' ' + customerLastName;

            setContentOfElement('notify-customer', customerName)
            setContentOfElement('notify-quantity', quantity)
            setContentOfElement('notify-product', product)
            setContentOfElement('notify-ago', minutesAgo + ' minutes ago')
            setContentOfElement('notify-state', state)

            // Show the notification
            const elementSelected = document.querySelector('.custom-notification');
            if (elementSelected) {
                elementSelected.style.display = 'block';
            }

            // Hide the notification after 5 seconds
            setTimeout(function() {
                const elementSelected = document.querySelector('.custom-notification');
                if (elementSelected) {
                    elementSelected.style.display = 'none';
                }
            }, 5000);

            // Update notification after 9 seconds
            setTimeout(updateNotification, 9000);
        }

        // Initial display of the notification
        updateNotification();
    </script>

    <script>
        $(document).ready(function() {
            $('#processingPopup').hide();

            $('form').submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Show the processing popup
                $('#processingPopup').show();

                // Disable the submit button
                $('button[type="submit"]').prop('disabled', true);

                // Simulate a 10-second delay using setTimeout
                setTimeout(function() {
                    // Hide the popup after 10 seconds
                    $('#processingPopup').hide();
                    $('button[type="submit"]').prop('disabled', false);

                    // Redirect the user to the next page
                }, 10000); // 10,000 milliseconds = 10 seconds
            });
        });
    </script>
    <?PHP
    $pixelsFile = $_SERVER['DOCUMENT_ROOT'] . '/wisepop.php';

    if (file_exists($pixelsFile)) {
        include_once $pixelsFile;
    }
    ?>
</body>

</html>