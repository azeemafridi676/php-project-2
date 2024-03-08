<?php
session_start();
include_once 'api/config.php';
include_once 'api/action.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_GET['error'])) {
 
    $_SESSION['data'] = $_POST;
    $_SESSION['address_data'] = $_POST;

    authUser();
}


if($_GET['pidx']&&$_GET['rec_v'])
{
    if ($_GET['pidx'] == 3) {
        $productId = 34346;
    } else if ($_GET['pidx'] == 2) {
        $productId = 34345;
    } else if ($_GET['pidx'] == 1) {
        $productId = 34342;
    }
}
else
{
    if ($_GET['pidx'] == 3) {
        $productId = 34374;
    } else if ($_GET['pidx'] == 2) {
        $productId = 34373;
    } else if ($_GET['pidx'] == 1) {
        $productId = 34372;
    }
}
 

?>
<!doctype html>
<html>


<head>
<?php 
        $pixelsFile = $_SERVER['DOCUMENT_ROOT'] . '/pixels.php';
        if(file_exists($pixelsFile)){
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

    <!-----------TOP SECTION---------->
   
         <!--------Navigation-Bar---------->
        <div class="header">
            <div class="container position bdinpad">
                <div class="logo"><a href="index.php"><img src="images/logo.jpg" alt="" class="logo"></a>
                </div>

            </div>

        </div>
     <div class="container">
	 <p class="text-center pt-3 "><img src="images/delivery_red.png" />Fast, Free Shipping For A Limited Time</p>
        <div class="steps">
            <ul class="steps__list row">
                <li class="steps__item" >Qualify Now</li>
                <li class="steps__item" >Select Package</li>
                <li class="steps__item" style="background-color: #b51f28;color: #fff;" >Confirm Order</li>
            </ul>
        </div>
    </div>

    <div class="container">
	<p class=" text-center pb-3"><strong class=" fs20"> <span class="red">Final Step</span>- Payment Information
 </strong><br />
		<span  class=" text-center fs13">Your order will be processed on our secure servers</span>
		</p>
		<div class="accepted_cards">
                            <strong>We Accept</strong>
                            <img src="images/cards.png">
                        </div>
        <div class="payment_form">
<!-- id="discountApplied" -->
<h6  class="alert discount-applied" style="display: block;" >
    SUCCESS!!! COUPON APPLIED TO YOUR ORDER
</h6>
<!--
<h6 id="discountDisabled" class="alert alert-danger discount-alert" style="display: none;">
    WARNING: COUPON DISABLED!<br> SAVINGS NO LONGER APPLIED!
</h6>
-->

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
 <select name="billingState" class="w100 form-control" aria-label=".form-select-lg example"  aria-required="true">
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
                      
</div>
<div class="billing-title">Payment Information</div>
                <input type="hidden" name="productID" id="productId" value="<?php echo $productId ?>">
                <input type="hidden" name="inlineRadioOptions" id="" value="no">
                <input type="hidden" name="cc_type" id="cc_type" value="VI">
                <label>Card Number: </label>
                 <input type="text" name="cc_number" id="cc_number" class="form-control cc_number switch-card validate-credit-card js-add-cc-type floatlabel" placeholder="Card Number" required>
                <label>Name On Card: </label>
                <input type="text" name="cardName" placeholder="Name on Card" required class="form-control">
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
                <input placeholder="CVV" class="cc_code floatlabel form-control" type="tel" name="cc_cvv2" id="cc_code" maxlength="3" autocomplete="cc-csc" required="required" style="transition: all 0.2s ease-in-out 0s;">
 
                <div style="font-size:12px; font-weight:bold; padding:2px;">The CVV code is the 3 numbers on the back of your card</div>
				<img src="./images/cvvnumber.png">

                <div class="secure-icon"><span>Secure 256-bit SSL Encryption</span></div>
<div class="text-center">
<span style="color:#FF0000; font-weight:bold;"><div class="errorMessage"></div></span>
                    <button type="submit" class="large_btn btn_pulse">Rush My Order</button>
					<br/>
					<?php if ($_SESSION['flow'] == 'uncheck') { ?> <div style="display:none"> <?php } ?>
                            <label for="special-gift" class="dim">
                                <input type="checkbox" <?php echo (isset($_SESSION['flow']) && $_SESSION['flow'] == 'check') ? 'checked' : ''; ?> id="special-gift"
                                    value="34569" name="special-gift"
                                    class="paymentas_shipping form-check-input"
                                    style="-webkit-appearance: checkbox;width: 15px;height:  15px;display:inline-block" />
                                    <span class="dim-checkbox"></span>
                                <span>As a special gift you will get instant access to one of our dedicated Revolt Health Coaches for only $99.95, save 50%.</span>
                            </label>
                            <label for="is_reaccouring" class="dim" style="padding-left:8px;">
                                <input type="checkbox" value="1" <?php echo (isset($_SESSION['flow']) && $_SESSION['flow'] == 'check') ? 'checked' : ''; ?> id="is_reaccouring"
                                    name="is_reaccouring" class="paymentas_shipping form-check-input"
                                    style="width: 15px;height:  15px;display:inline-block">
                                    <span class="dim-checkbox"></span>
                                <span>Subscribe & Save</span>
                            </label>
                                    
					<?php if ($_SESSION['flow'] == 'uncheck')  { ?></div> <?php } ?>
					 <div class="col-12 text-center pt-3 pb-3"> <img src="images/gd1.png"> </div>
					  <div class="col-12 text-center pt-3 pb-3"> <img src="images/safe.png"> </div>
                </div>

<div class="popup" id="processingPopup">
    <div class="popup-content">
        <div class="loading-animation">Loading...</div>
    </div>
</div>
                <div data-lastpass-icon-root="true" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div>
            </form>
        </div>
		
		<!--
		<div class="gurantee_box">
                        <div class="gurantee_header">
                            30 DAY MONEY BACK GUARANTEE
                        </div>
                        <div class="row px-3">
					
                            <div class="col-12">
                                <div class="row">
                                   
									<div class="col-6 text-center">
                                        <strong class="red">Product</strong><br>
                                        <span id="sub-prodnm">Revolt CBD Subscription Buy 3 Get 2 Free</span>
                                    </div>
                                    <div class="col-6 text-center">
                                        <strong class="red">Total</strong><br>
                                        <span id="sub-tot">$197.70</span>
                                    </div> 
                                </div>
                                <p>  <img src="images/moneyback.png" style="float:left; width:125px; height:125px;" />We are so confident in our products and services, that we back it
                                    with a 30 day money back guarantee. If for any reason you are not
                                    fully satisfied with our products, simply return the purchased products
                                    in the original container within 30 days of when you received your
                                    order. We will refund you 100% of the purchase price - with
                                    absolutely no hassle.</p>
                            </div>
                        </div>
                    </div> -->
    </div>
 
    <!-----------FOOTER---------->


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

    <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
        $(window).scroll(function() {
            let height = $(document).height();
            let top = $(window).scrollTop();
            if (top > 200 && top < (height - 1400)) {
                $('.float-wrap').addClass('show');
            } else {
                $('.float-wrap').removeClass('show');
            }
        });
    </script>
 

    <script>
         // Function to handle redirection
    function redirectToSubsPage(subsValue) {
        const origin = window.location.origin;
        var pathArray = window.location.pathname.split('/');
        pathArray.pop();
        // var subsUrl = "https://tryrevoltme.com/dev/mobile/success.php?subs=" + subsValue;
        var newURL = window.location.protocol + "//" + window.location.host + ("/" + pathArray.join("/") + "/success.php").replace("//", "/") + "?subs=" + subsValue

        window.location.href = newURL;
    }

    $("#is_reaccouring").change(function() {
        var is_reaccouring = $('#is_reaccouring').is(':checked');
        if (is_reaccouring) {
            $('#discountDisabled').hide();
            $('#discountApplied').show();
        } else {
            $('#discountApplied').hide();
            $('#discountDisabled').show();
        }
        var id = $("#productId").val();
        setProductId(id);
    });

    function setProductId(id) {
        var is_reaccouring = $('#is_reaccouring').is(':checked');
        if (id == '34372' || id == '34342') {
            if (is_reaccouring) {
                $("#sub-prodnm").html("Revolt CBD Subscription Buy 1 Get 1 Free");
                $("#sub-tot").html('$118.08');
                $("#productId").val('34342');
            } else {
                $("#sub-prodnm").html("Revolt CBD Gummies - 2 Packets");
                $("#sub-tot").html('$136.08');
                $("#productId").val('34372');
            }
        } else if (id == '34373' || id == '34345') {
            if (is_reaccouring) {
                $("#sub-prodnm").html("Revolt CBD Subscription Buy 2 Get 1 Free");
                $("#sub-tot").html('$148.92');
                $("#productId").val('34345');
            } else {
                $("#sub-prodnm").html("Revolt CBD Gummies - 3 Packets");
                $("#sub-tot").html('$171.36');
                $("#productId").val('34373');
            }
        } else if (id == '34374' || id == '34346') {
            if (is_reaccouring) {
                $("#sub-prodnm").html("Revolt CBD Subscription Buy 3 Get 2 Free");
                $("#sub-tot").html('$197.70');
                $("#productId").val('34346');
            } else {
                $("#sub-prodnm").html("Revolt CBD Gummies - 5 Packets");
                $("#sub-tot").html('$224.50');
                $("#productId").val('34374');
            }
        }
    }

    $(document).ready(function() {
        setProductId('<?php echo $productId?>');
        var showShowing = $("#shipping-billing").html();

        $("#checkoutForm").on("submit", function(e) {
            e.preventDefault();
            productsList = ['34372', '34373', '34374', '34342', '34345', '34346']
            var selectedProduct = $("#productId").val();
            if (!productsList.includes(selectedProduct)) {
                alert("Please select package");
            } else {
                $.ajax({
                    beforeSend: function() {
                        $('#spinner-div').show();
                        $('#processingPopup').show();
                        $('#rushOrderButton').prop('disabled', true);
                    },
                    method: "POST",
                    url: "api/createOrder.php",
                    data: $(this).serializeArray(),
                    complete: function() {
                        $('#spinner-div').hide();
                        $('#processingPopup').hide();
                        $('#rushOrderButton').prop('disabled', false);
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
                        } else if (data['Transaction']['OrderInfo']['OrderID'] === null) {
                            $(".errorMessage").show();
                            $(".errorMessage").text("Your card was declined. Please check your card number, CVV, and expiration date again and then resubmit. If your card continues to decline, call your bank or try another card.");
                            return false;
                        } else {
                            redirectToSubsPage($("#is_reaccouring").prop("checked") ? "YES" : "NO");
                        }
                    }
                });
            }
        });

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
                var e = $(this).val().replace(/\D/g, ""),
                    t = !1,
                    a = "";
                (e.match(/^4/) ? (a = "VI", $('input[name="cc_type"]').val(a), $('input[name="cc_number"]').mask("0000 0000 0000 0000"), $('input[name="cc_cvv2"]').mask("000"), $(".js-add-cc-type").removeClass("VI").removeClass("DI").removeClass("AX").removeClass("MC").addClass(a)) : e.match(/^5[1-5]/) ? (a = "MC", $('input[name="cc_type"]').val(a), $('input[name="cc_number"]').mask("0000 0000 0000 0000"), $('input[name="cc_cvv2"]').mask("000"), $(".js-add-cc-type").removeClass("VI").removeClass("DI").removeClass("AX").removeClass("MC").addClass(a)) : e.match(/^(?:6011|65[0-9]{2}|64[4-9][0-9])/) ? (a = "DI", $('input[name="cc_type"]').val(a), $('input[name="cc_number"]').mask("0000 0000 0000 0000"), $('input[name="cc_cvv2"]').mask("000"), $(".js-add-cc-type").removeClass("VI").removeClass("DI").removeClass("AX").removeClass("MC").addClass(a)) : e.match(/^(?:34|37)/) ? (a = "AX", $('input[name="cc_type"]').val(a), $('input[name="cc_number"]').mask("0000 000000 00000"), $('input[name="cc_cvv2"]').mask("0000"), $(".js-add-cc-type").removeClass("VI").removeClass("DI").removeClass("AX").removeClass("MC").addClass(a)) : ($('input[name="cc_type"]').val(""), $('input[name="cc_number"]').mask("0000 0000 0000 0000"), $('input[name="cc_cvv2"]').mask("000"), $(".js-add-cc-type").removeClass("VI").removeClass("DI").removeClass("AX").removeClass("MC")), e.match(/^4[0-9]{15}$/) ? t = !0 : e.match(/^5[1-5][0-9]{14}$/) ? t = !0 : e.match(/^(?:6011|65[0-9]{2}|64[4-9][0-9])[0-9]{12}$/) ? t = !0 : e.match(/^(?:34|37)[0-9]{13}$/) && (t = !0), t) ? function(e) {
                    return !/[^0-9-\s]+/.test(e) && i(e)
                }(e) ? this.setCustomValidity(""): this.setCustomValidity(""): this.setCustomValidity("")
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

    // Display the formatted date in the HTML element with the id "currentDate"
    document.getElementById("currentDate").innerHTML = formattedDate;
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
<!-- <script>
$(document).ready(function () {
    $('#checkoutForm').submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Show the processing popup
        $('#processingPopup').show();

        // Disable the Rush My Order button
        $('#rushOrderButton').prop('disabled', true);

        // Simulate a 4-second delay using setTimeout
        setTimeout(function () {
            // Submit the form data via AJAX
            $.ajax({
                type: 'POST',
                 data: $('#checkoutForm').serialize(),
                success: function (response) {
                    // Handle the response as needed
                    $('#processingPopup').hide();
                    $('#rushOrderButton').prop('disabled', false);
                    // You can display a success message or perform additional actions here.
                },
                error: function () {
                    // Handle errors if the submission fails
                    $('#processingPopup').hide();
                    $('#rushOrderButton').prop('disabled', false);
                    // You can display an error message or perform additional actions here.
                }
            });
        }, 4000); // 4,000 milliseconds = 4 seconds
    });
});
</script> -->
<?PHP  
$file = $_SERVER['DOCUMENT_ROOT'] . '/wisepop.php';
if(file_exists($file)){
  include_once ($_SERVER['DOCUMENT_ROOT'] . '/wisepop.php');     
}
?>
</body>

</html>