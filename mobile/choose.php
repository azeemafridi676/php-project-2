<?php
session_start();

// include_once 'api/config.php';
// include_once 'api/action.php';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_GET['error'])) {
    unset($_SESSION['form_data']);
    $_SESSION['form_data'] = $_POST;
}
$title = 'Choose Package';

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
                <li class="steps__item" style="background-color: #b51f28;color: #fff;" >Select Package</li>
                <li class="steps__item">Confirm Order</li>
            </ul>
        </div>
    </div>
    <div class="container">
       
		<p class=" text-center pb-3"><strong class=" fs20"> <span class="red">Approved</span> - Select Your Revolt<br> CBD Gummies Package Below: </strong>
		
		</p>
		
		<strong><span class="red">APPROVED! </span>Free Packages Confirmed</strong>
		<p class="fs13">
Limited supply available as of <strong id="currentDate" class="red"></strong>. We currently have product in stock and ready to ship within 24 hours.
<br />
Sell Out Risk: <strong class="red">HIGH</strong></p>
        <div class="product-selection">
            <div class="product product1 active" data-pkg="875" data-sub="197.70" data-unsub="224.50" data-desc="BUY 3 GET 2 FREE">

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
                        <div class="package-info ">
                            <span class="package-info__title red">5 Month CBD Relief Pack</span>
                            <span class="package-info__price">
                                <p class="price-first"></p>
                                <span>
                                    <span class="price-top" data-nosub="$44.90" data-sub="$39.54">$39.54 Per Pack</span>
                                </span>
                            </span>
                            <span class="package-info__retail mb-3"> Retail - <span>$449.95</span> </span>
                            <span class="package-info__total"></span>

                        </div>
                        <div class="package_product ">
                            <img src="images/checkout3.png" />
							<div class="package__save">
                                                    <span class="package__save_title">SAVE</span>
                                                    <span class="package__save_item save-price price-top2" data-nosub="$225+" data-sub="$250+">$250+</span>
                                                </div>
                        </div>

                        <div class="col-12 text-center">
                            <a href="javascript:void(0)" data-id="3" class="button-b_button btn__send btn_pulse2 small_btn loading-btn select-product">
                                Select Package
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="product product2" data-pkg="874" data-sub="148.92" data-unsub="171.36" data-desc="BUY 2 GET 1 FREE">

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
                        <div class="package-info ">
                            <span class="package-info__title red">3 Month CBD Relief Pack</span>
                            <span class="package-info__price">
                                <p class="price-first"></p>
                                <span>
                                    <span class="price-top" data-nosub="$57.12" data-sub="$49.64">$49.64 Per Pack</span>
                                </span>
                            </span>
                            <span class="package-info__retail mb-3"> Retail - <span > $269.97</span> </span>
                            <span class="package-info__total"></span>
                        </div>
                        <div class="package_product ">
                            <img src="images/checkout2.png" />
							<div class="package__save">
                                                    <span class="package__save_title">SAVE</span>
                                                    <span class="package__save_item save-price price-top2" data-nosub="$98+" data-sub="$119+">$119+</span>
                                                </div>
                        </div>
                        <div class="col-12 text-center">
                            <a href="javascript:void(0)" data-id="2" class="button-b_button btn__send   small_btn loading-btn select-product">
                                Select Package
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="product product3 " data-pkg="873" data-sub="118.08" data-unsub="136.08" data-desc="BUY 1 GET 1 FREE">

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
                        <div class="package-info ">
                            <span class="package-info__title red">2 Month CBD Relief Pack</span>
                            <span class="package-info__price">
                                <p class="price-first"></p>
                                <span>
                                    <span class="price-top" data-nosub="$68.04" data-sub="$59.04">$59.04 Per Pack</span>
                                </span>
                            </span>
                            <span class="package-info__retail mb-3"> Retail - <span >$179.98</span> </span>
                            <span class="package-info__total"></span>
                        </div>
                        <div class="package_product ">
                            <img src="images/checkout1.png" />
							<div class="package__save">
                                                    <span class="package__save_title">SAVE</span>
                                                    <span class="package__save_item save-price price-top2" data-nosub="$43" data-sub="$60">$60</span>
                                                </div>
                        </div>
                        <div class="col-12 text-center">
                            <a href="javascript:void(0)" data-id="1" class="button-b_button btn__send   small_btn loading-btn select-product">
                                Select Package
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script>
        $(document).ready(function(e) {
            $('.select-product').click(function(e) {
                var selid = $(this).attr('data-id');
                var recurring_val = '&rec_v=0';
                if($('#is_reaccouring').is(':checked'))
                {
                    recurring_val = '&rec_v=1';
                }
                window.location.href = "shipping.php?pidx=" + selid + recurring_val;
            });

        });
    </script>

    <script type="text/javascript">
        $(document).scroll(function() {

            if ($(this).scrollTop() > 110) {
                $('.top-fix-bar').addClass('fixed-nav');
            } else {
                $('.top-fix-bar').removeClass('fixed-nav');
            }
        });
    </script>

    <script>
        $(window).scroll(function() {
            let height = $(document).height();
            let top = $(window).scrollTop();
            if (top > 200 && top < (height - 1400)) {
                $('.float-wrap').addClass('show');
            } else {
                $('.float-wrap').removeClass('show');
            }
        });
        function updateProductPrice() 
        {
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
        }

        $("#is_reaccouring").change(function() {
            updateProductPrice();
        });
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
  <?php 
    $wiseFile = $_SERVER['DOCUMENT_ROOT'] . '/wisepop.php';
    if(file_exists($wiseFile)){
        include_once ($wiseFile); 
    }
  ?>
</body>

</html>