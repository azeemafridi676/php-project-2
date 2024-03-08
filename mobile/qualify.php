<?PHP
session_start();

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
    <title>Revolt CBD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="robots" content="noindex, nofollow" />
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style2.css ">
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
	 <p class="text-center pt-3"><img src="images/delivery_red.png" />Fast, Free Shipping For A Limited Time</p>
        <div class="steps">
            <ul class="steps__list row">
                <li class="steps__item" style="background-color: #b51f28;color: #fff;">Qualify Now</li>
                <li class="steps__item" >Select Package</li>
                <li class="steps__item">Confirm Order</li>
            </ul>
        </div>
    </div>

    <div class="container">
	<p class=" text-center"><strong class="red fs20">Qualify For Your Order Today!</strong></p>

        <form name="StemLife_form" method="post" class="rushorder_form" id="basic-form" action="choose.php">

            <input type="hidden" value="" name="affId">
            <input type="hidden" value="" name="cv1">
			<div class=" columns form-holder">
                          <label style="font-weight:bold;">Your Discount Code - <strong style="color:#7dc300;">ACTIVATED</strong></label>
                          <input type="text" class="w100" placeholder="WSHTLPE2023" disabled="">
            </div>
            <input type="text" name="firstName" class="w50" placeholder="First Name" required="" aria-required="true">
            <input type="text" name="lastName" class="w50" placeholder="Last Name" required="" aria-required="true">
            <input type="text" name="address" class="w100" placeholder="Address" required="" aria-required="true">
            <input type="text" name="phone" class="w100" onkeyup="phonenumber(this.value)" id="phone" maxlength="13" placeholder="Phone Number" required="">
            <input type="text" name="city" class="w100" placeholder="City" required="" aria-required="true">
            <select name="state" class="w100" aria-label=".form-select-lg example" required="" aria-required="true">
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
            <input type="text" class="w50" name="zipCode" placeholder="Zip code" required="" aria-required="true">

            <input type="email" class="w50" name="email" id="email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" placeholder="Email Address" required="" aria-required="true">

            <div class="form-btn w-100 text-center">
                <button type="submit" class="large_btn">Rush My Order</button>
            </div>
            <div class="col-12 text-center pt-3 pb-3"> <img src="images/gd1.png"> </div>
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
  <?PHP 
    $file  =  $_SERVER['DOCUMENT_ROOT'] . '/wisepop.php';
    if (file_exists($file)) {
        include_once ($_SERVER['DOCUMENT_ROOT'] . '/wisepop.php');
    }
  ?>
</body>

</html>