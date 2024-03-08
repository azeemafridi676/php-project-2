<?php

$querystring = '?' . $_SERVER['QUERY_STRING'];



session_start();


include_once 'api/config.php';


/* Get URL parameters for affiliateID, customer values, and flow to automatically checkmark box on checkout page for subscribe & save */

if (!empty($_REQUEST['affid'])) {
  $_SESSION['affid'] = $_REQUEST['affid'];
  $_SESSION['s1'] = $_REQUEST['s1'];
} elseif (!empty($_REQUEST['affId'])) {
  $_SESSION['affid'] = $_REQUEST['affId'];
} else {
  $_SESSION['affid'] = '';
}

if (!empty($_REQUEST['c1'])) {
  $_SESSION['c1'] = $_REQUEST['c1'];
  $_SESSION['s1'] = $_REQUEST['c1'];
} elseif (!empty($_REQUEST['C1'])) {
  $_SESSION['c1'] = $_REQUEST['C1'];
  $_SESSION['s1'] = $_REQUEST['C1'];
} else {
  $_SESSION['c1'] = '';
}

if (!empty($_REQUEST['flow'])) {
  $_SESSION['flow'] = $_REQUEST['flow'];
} else {
  $_SESSION['flow'] = '';
}

if (!empty($_REQUEST['clickid'])) {
  $_SESSION['clickid'] = $_REQUEST['clickid'];
}

/* END */

/* add click to CRM for tracking affiliates */

$curl = curl_init();
$dataPost = '{
	    "SessionID": null,
        "ClientID": 3334,
        "siteId": ' . $GLOBALS['siteId'] . ',
        "IpAddress":"' . $_SESSION['IpAddress'] . '",
        "RequestUri": "' . ((isset($_SERVER) && isset($_SERVER['SCRIPT_URI'])) ? $_SERVER['SCRIPT_URI'] : '') . '",
		"PageType": "Presell",
		"AffiliateID":"' . isset($_SESSION['affid']) ? $_SESSION['affid'] : '' . '",
		"SubAffiliateID":"' . $_SESSION['s1'] . '"
		
    }';

curl_setopt_array(
  $curl,
  array(
    CURLOPT_URL => $GLOBALS['apiUrl'] . '/api/v2/open/clicks',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $dataPost,
    CURLOPT_HTTPHEADER => array(
      'Authorization: ApiKey ' . $GLOBALS['apiKey'],
      'Idempotency-Key: ' . $GLOBALS['IdempotencyKey'] . 'importClicks',
      'Content-Type: application/json'
    ),
  )
);


$response = curl_exec($curl);
curl_close($curl);
$sessionId = '';
if ($response && isset($response->Result)) {
  $sessionId = $response->Result->SessionID;
}

/* END */



?>

<!DOCTYPE html>
<?php
$file = $_SERVER['DOCUMENT_ROOT'] . '/pixels.php';
if (file_exists($file)) {
  include_once($_SERVER['DOCUMENT_ROOT'] . '/pixels.php');
}
?>

<html data-arp-injected="true">
<link type="text/css" rel="stylesheet" id="dark-mode-custom-link" />
<link type="text/css" rel="stylesheet" id="dark-mode-general-link" />
<style lang="en" type="text/css" id="dark-mode-custom-style"></style>
<style lang="en" type="text/css" id="dark-mode-native-style"></style>
<style lang="en" type="text/css" id="dark-mode-native-sheet"></style>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

  <meta name="viewport" content="width=640" />
  <title>Revolt Gummies</title>
  <link rel="icon" type="image/x-icon" href="images/favicon.png" />

  <link rel="preload" href="fonts/Geomanist-Bold.woff" as="font" type="font/woff" crossorigin="" />

  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/slick.css" />

  <script type="text/javascript" charset="UTF-8" src="js/api.js"></script>
</head>

<body cz-shortcut-listen="true">
  <div class="container">
    <div class="getheight">
      <div id="section-one">
        <div class="flex">
        </div>

        <img src="images/section11.jpg" width="639" height="816" alt="top" />
        <div class="lead-scroll">
          <a href="#footerxyz" id="anchor" class="lead-link" data-placement="top" data-toggle="tooltip" data-original-title="START HERE">
            <svg class="arrows">
              <path class="a1" stroke-linecap="round" stroke-linejoin="round" d="M0 0 L30 32 L60 0"></path>
              <path class="a2" stroke-linecap="round" stroke-linejoin="round" d="M0 20 L30 52 L60 20"></path>
              <path class="a3" stroke-linecap="round" stroke-linejoin="round" d="M0 40 L30 72 L60 40"></path>
            </svg>
          </a>
        </div>
      </div>

      <div id="section-two">
        <p class="s2-txt1" style="text-align: left; padding-left: 10px">
          <span>The Sexual Health Divide </span><br />
          Are You Suffering From The <br />
          Following Symptoms
        </p>
        <p class="s2-txt2" style="text-align: left; padding-left: 10px">
          Leading surveys on sexual health and satisfaction levels among
          American men have revealed the following:
        </p>
        <div class="both-part">
          <div class="s2-lft">
            <img src="images/s2-img1.png" alt="" class="s2-img1" width="196" height="187" />
          </div>
          <div class="s2-rgt">
            <p class="s2-rgt-txt">
              Say sexual health influences on overall life satisfaction
            </p>
          </div>
          <p class="clearall"></p>
          <div class="s2-rgt2">
            <p class="s2-rgt2-txt">Suffer from Small Penis Syndrome</p>
          </div>
          <div class="s2-lft2">
            <img src="images/s2-img2.png" alt="" class="s2-img1" width="196" height="187" />
          </div>
          <p class="clearall"></p>
          <div class="s2-lft">
            <img src="images/s2-img3.png" alt="" class="s2-img1" width="195" height="187" />
          </div>
          <div class="s2-rgt">
            <p class="s2-rgt-txt">
              Believe embarrassment is a major sexual barrier
            </p>
          </div>
          <p class="clearall"></p>
          <div class="s2-rgt2">
            <p class="s2-rgt2-txt">
              Avoid sex altogether because of lack of sexual confidence
            </p>
          </div>
          <div class="s2-lft2">
            <img src="images/s2-img4.png" alt="" class="s2-img1" width="193" height="187" />
          </div>
        </div>
      </div>

      <div id="section-three">
        <p class="s3-txt1">
          <span>INTRODUCING Revolt Gummies </span><br />Male
          Enhancement System
        </p>
        <img src="images/s3-line.png" alt="" class="s3-line" width="533" height="10" />
        <p class="s3-txt2">
          Made with a blend of natural ingredients,
          <b>Revolt Gummies </b> is a male enhancement system that
          has been formulated to restore your sexual youth and performance and
          help you experience an intense, blissful &amp; powerful sex life.
          <br /><br />
          <b>Revolt Gummies </b> treats the root cause of sexual
          dysfunctions, ensuring that you are able to satisfy your partner,
          consistently!
        </p>

        <div class="order-bg">
          <p class="order-bg-txt">
            <span>ORDER YOUR <b>Revolt Gummies CBD </b> TODAY!</span>
            <br />Experience Sexual Power, Pleasure &amp; Performance
          </p>
        </div>
      </div>

      <div id="section-four">
        <p class="s3-txt1">
          <span>The Revolt Gummies BEHIND </span><br />BETTER, LONGER &amp;
          INTENSE SEX!
        </p>
        <img src="images/s3-line.png" alt="" class="s3-line" />
        <p class="s4-txt1">
          The blood flow to the penis is responsible for erections while the
          holding capacity of the penis chambers is what influences sexual
          stamina and staying power. <b>Revolt Gummies </b> helps
          boost both to help you and your partner partner enjoy intense
          orgasms and complete satisfaction.
        </p>
        <p class="s4-txt2">
          <b>Revolt Gummies </b> stimulates Nitric Oxide production
          to boost the flow of blood to the penile chambers for harder and
          stronger erections. It also expands the penis chambers allowing it
          to hold more blood, increasing sexual stamina, strength and power.
        </p>
        <img src="images/doc.png" alt="" class="doc" width="265" height="479" />
        <img src="images/seal2.png" alt="" class="seal2" />
        <img src="images/blood-img.png" alt="" class="blood-img" width="409" height="274" />
        <img src="images/orange-bg.png" alt="" class="orange-bg" />
        <p class="orange-bg-txt">
          <b>Revolt Gummies </b> utilizes a breakthrough rapid
          absorption and extended release technology. Rapid absorption of the
          ingredients into the bloodstream extended release technology
          delivers sustained results that help you enjoy on command erections
          and stamina to last all night long.
        </p>
        <div class="clearall"></div>
        <p class="s4-txt3">
          <span><b>Revolt Gummies </b> </span>works by triggering the two
          mechanisms known to increase penis size, function and performance.
          These are:
        </p>
        <img src="images/s4-img.png" alt="" class="s4-img" />
        <img src="images/step1.png" alt="" class="step1" />
        <p class="s4-txt4">An increase in "free" <br />testosterone and</p>
        <img src="images/step2.png" alt="" class="step2" />
        <p class="s4-txt4">
          Nitric Oxide <br />
          production to the <br />
          penis.
        </p>
        <br />
        <div class="order-bg" style="margin-top: 6px">
          <p class="order-bg-txt">
            <span>ORDER YOUR <b>Revolt Gummies </b> TODAY!</span><br />Experience Sexual Power, Pleasure &amp;
            Performance
          </p>
        </div>
      </div>

      <div id="section-five">
        <p class="s3-txt1">
          <span>The Benefits of <b>Revolt Gummies </b></span><br />ADVANCED MALE ENHANCEMENT!
        </p>
        <img src="images/s3-line.png" alt="" class="s3-line" />
        <p class="s4-txt1">
          <span>Revolt Gummies Male Enhancement System</span>
          offers multiple sexual health benefits to help you enjoy hard
          erections, increased stamina and peak performance.
        </p>
        <ul class="sec5-list">
          <li>
            <img src="images/s5-img1.png" alt="" id="object1" style="margin: 0 0 7px 0" width="620" height="217" /><br />
            <span>IMPROVED LIBIDO &amp; SEX DRIVE</span><br />Get ready to
            experience a torrent of desire &amp; passion with
            <b>Revolt Gummies </b>, which replenishes sexual energy
            stores across the body like never before.
          </li>
          <li>
            <img src="images/s5-img5.png" alt="" id="object5" style="margin: 0 0 7px 0" width="620" height="217" /><br />
            <span>BIGGER, HARDER &amp; LONGER ERECTIONS</span><br />
            <b>Revolt Gummies </b> lets you achieve rock hard
            erections helping you and your partner enjoy insane sexual
            sessions, whenever you desire.
          </li>
          <li>
            <img src="images/s5-img2.png" alt="" id="object2" style="margin: 0 0 7px 0" width="620" height="217" /><br />
            <span>INCREASED STAYING POWER</span><br />
            Bid goodbye to pre-mature ejaculations!
            <b>Revolt Gummies </b> floods your penile chambers with
            a gush of blood letting you last 5X more than usual.
          </li>
          <li>
            <img src="images/s5-img3.png" alt="" id="object3" style="margin: 0 0 7px 0" width="620" height="217" /><br />
            <span>INCREASED PENIS SIZE</span><br />Increase in penile chamber
            capacity and regular boost in blood flow may help add those inches
            to your penis size, both length &amp; girth wise.
          </li>
          <li>
            <img src="images/s5-img4.png" alt="" id="object4" style="margin: 0 0 7px 0" width="620" height="217" /><br /><span>IMPROVED SEXUAL CONFIDENCE</span><br />Equipped with
            youthful sexual powers &amp; energy, you are sure to experience
            sexual confidence like never before, gives you greater success
            with the most desirable women!
          </li>
        </ul>
        <div class="seal-bg">
          <img src="images/us-seal.png" width="120" height="120" alt="" class="s5seal" />
          <p class="seal-txt1">
            Revolt Gummies is proudly made in the United States of
            America
            <span>at a certified manufacturing facility to meet statutory
              industry standards.</span>
          </p>
        </div>
        <div class="order-bg" style="margin-top: 17px">
          <p class="order-bg-txt">
            <span>ORDER YOUR <b>Revolt Gummies </b> TODAY!</span>
            <br />Experience Sexual Power, Pleasure &amp; Performance
          </p>
        </div>
      </div>

      <div id="section7">
        <p class="s7-txt1">
          <span>REAL MEN, REAL RESULTS</span><br />SUCCESS STORIES
        </p>
        <img src="images/line2.png" alt="" class="s7-line" width="628" height="7" />
        <p class="s7-txt2">
          <span><b>Revolt Gummies </b> has helped hundreds of men
            across all ages</span>
          beat sexual dysfunction and enjoy a fuller and sex life.
        </p>
        <p class="clearall"></p>
        <div class="slider slick-initialized slick-slider">
          <button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button" style="display: block"></button>
          <div aria-live="polite" class="slick-list draggable">
            <div class="slick-track" style="
                  opacity: 1;
                  width: 3600px;
                  transform: translate3d(-600px, 0px, 0px);
                " role="listbox">
              <div class="slide4 slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" style="width: 600px" tabindex="-1">
                <img src="images/s7-slid4.png" alt="" class="s7-slid-img" width="199" height="199" />
                <p class="sec7-text3">
                  I stumbled upon Revolt Gummies on the web and on
                  seeing that they were offering a Free Bottle, I decide to
                  give it a try, and man, am I glad I did. I have been a
                  customer for 6 months, and the results have been truly
                  amazing! Apart from the boost in libido and stamina, the
                  added inches (Yes! I am serious) is a big plus!
                </p>

                <p class="sec7-text4">- George B. <span>| NV </span></p>
                <center>
                  <img src="images/stars.png" alt="" class="stars" width="95" height="16" />
                </center>
              </div>
              <div class="slide1 slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" style="width: 600px" tabindex="-1" role="option" aria-describedby="slick-slide00">
                <img src="images/s7-slid1.png" alt="" class="s7-slid-img" width="199" height="199" />
                <p class="sec7-text3">
                  As a patient of ED, just the mention of sex would leave me
                  sweating! However, Revolt Gummies changed all of
                  that! It has helped me enjoy on-command erections and
                  satisfy my wife, whenever, wherever! Highly Recommended!
                </p>

                <p class="sec7-text4">- Daniel M. <span>| WA </span></p>
                <center>
                  <img src="images/stars.png" alt="" class="stars" width="95" height="16" />
                </center>
              </div>
              <div class="slide2 slick-slide" data-slick-index="1" aria-hidden="true" style="width: 600px" tabindex="-1" role="option" aria-describedby="slick-slide01">
                <img src="images/s7-slid2.png" alt="" class="s7-slid-img" width="199" height="199" />
                <p class="sec7-text3">
                  Revolt Gummies is definitely a game changer! It
                  has helped restore not just my stamina but also my
                  confidence. The fact that my wife loves the product more
                  than I do, says it all!
                </p>

                <p class="sec7-text4">- Brian L. <span>| NY </span></p>
                <center>
                  <img src="images/stars.png" alt="" class="stars" width="95" height="16" />
                </center>
              </div>
              <div class="slide3 slick-slide" data-slick-index="2" aria-hidden="true" style="width: 600px" tabindex="-1" role="option" aria-describedby="slick-slide02">
                <img src="images/s7-slid3.jpg" alt="" class="s7-slid-img" width="199" height="199" />
                <p class="sec7-text3">
                  As a patient of ED, just the mention of sex would leave me
                  sweating! However, Revolt Gummies changed all of
                  that! Just 3 months into the program, I can confidently say,
                  my ED is completely cured. It has also helped me enjoy
                  on-command erections and satisfy my wife, whenever,
                  wherever! Highly Recommended!
                </p>

                <p class="sec7-text4">- William K. <span>| VA </span></p>
                <center>
                  <img src="images/stars.png" alt="" class="stars" width="95" height="16" />
                </center>
              </div>
              <div class="slide4 slick-slide" data-slick-index="3" aria-hidden="true" style="width: 600px" tabindex="-1" role="option" aria-describedby="slick-slide03">
                <img src="images/s7-slid4.png" alt="" class="s7-slid-img" width="199" height="199" />
                <p class="sec7-text3">
                  I stumbled upon Revolt Gummies on the web and on
                  seeing that they were offering a Free Bottle, I decide to
                  give it a try, and man, am I glad I did. I have been a
                  customer for 6 months, and the results have been truly
                  amazing! Apart from the boost in libido and stamina, the
                  added inches (Yes! I am serious) is a big plus!
                </p>

                <p class="sec7-text4">- George B. <span>| NV </span></p>
                <center>
                  <img src="images/stars.png" alt="" class="stars" width="95" height="16" />
                </center>
              </div>
              <div class="slide1 slick-slide slick-cloned" data-slick-index="4" aria-hidden="true" style="width: 600px" tabindex="-1">
                <img src="images/s7-slid1.png" alt="" class="s7-slid-img" width="199" height="199" />
                <p class="sec7-text3">
                  As a patient of ED, just the mention of sex would leave me
                  sweating! However, Revolt Gummies changed all of
                  that! It has helped me enjoy on-command erections and
                  satisfy my wife, whenever, wherever! Highly Recommended!
                </p>

                <p class="sec7-text4">- Daniel M. <span>| WA </span></p>
                <center>
                  <img src="images/stars.png" alt="" class="stars" width="95" height="16" />
                </center>
              </div>
            </div>
          </div>

          <button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next" role="button" style="display: block"></button>
        </div>
      </div>

      
    </div>
    <div class="clearall"></div>
    <div class="fixbox">
      <div class="stick_bar">
        <img src="images/product.png" alt="" class="bottle" width="590" height="1063" />
        <img src="images/gummies.png" alt="" class="ftr-gummies" width="408" height="168" />
        <div class="btn">
          <a href="qualify.php" class="button pulse">Order Now</a>
        </div>
        <img src="images/btn-secure.png" alt="" class="security2" width="265" height="65" />
      </div>

      <footer class="dsplay" id="footerxyz">
        <div class="container bdinpad">
          <p class="text-center s2txt bdfont">© 2023 REVOLT CBD</p>
          <ul class="ftrlist1">
            <li>Revolt CBD 216 S. 22nd Elwood, IN 46031 US </li>
            <li> support@tryrevoltcbd.com</li>
            <li><a href="/ss/terms.php" target="_blank">Terms &amp; Conditions</a></li>
            <li><a href="/ss/privacy.php" target="_blank">Priacy Policy</a></li>
            <li class="text-center">
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
            </li>
          </ul>


        </div>
      </footer>

    </div>
  </div>

  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/slick.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(".slider").slick({
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 8000,
        adaptiveHeight: false,
        fade: false,
        focusOnSelect: false,
      });
    });

    $(document).scroll(function() {
      var $elem = $(".fixbox");
      var $window = $(window);

      var docViewTop = $window.scrollTop();
      var docViewBottom = docViewTop + $window.height();

      var elemTop = $elem.offset().top;
      var elemBottom = elemTop + $elem.height();

      if (
        elemTop >= docViewBottom ||
        elemTop + $(".stick_bar").height() >= docViewBottom
      ) {
        $(".stick_bar").css("position", "fixed");
      } else {
        $(".stick_bar").css({
          position: "relative"
        });
      }

      $("#object1").each(function() {
        var imagePos = $(this).offset().top;

        var topOfWindow = $(window).scrollTop();
        if (imagePos < topOfWindow + 700) {
          $(this).addClass("zoomIn");
        }
      });

      $("#object2").each(function() {
        var imagePos = $(this).offset().top;

        var topOfWindow = $(window).scrollTop();
        if (imagePos < topOfWindow + 700) {
          $(this).addClass("zoomIn");
        }
      });

      $("#object3").each(function() {
        var imagePos = $(this).offset().top;

        var topOfWindow = $(window).scrollTop();
        if (imagePos < topOfWindow + 700) {
          $(this).addClass("zoomIn");
        }
      });

      $("#object4").each(function() {
        var imagePos = $(this).offset().top;

        var topOfWindow = $(window).scrollTop();
        if (imagePos < topOfWindow + 700) {
          $(this).addClass("zoomIn");
        }
      });

      $("#object5").each(function() {
        var imagePos = $(this).offset().top;

        var topOfWindow = $(window).scrollTop();
        if (imagePos < topOfWindow + 700) {
          $(this).addClass("zoomIn");
        }
      });
    });
  </script>
  <link rel="stylesheet" type="text/css" href="css/loading.css" />
  <style>
    /*CSS FOR MODAL*/
    #app_common_modal,
    #error_handler_overlay {
      position: fixed;
      top: 0;
      left: 0;
      padding: 0;
      margin: 0;
      width: 100%;
      height: 100%;
      z-index: 2147483647;
      background: #333;
      background: rgba(255, 255, 255, 0.8);
      display: none;
      overflow-x: hidden;
      -webkit-overflow-scrolling: touch;
    }

    #app_common_modal .app_modal_body,
    #error_handler_overlay .error_handler_body {
      max-width: 600px;
      -webkit-background-clip: padding-box;
      font-family: Verdana, Geneva, sans-serif;
      box-sizing: border-box;
      outline: 0;
    }

    #error_handler_overlay .error_handler_body {
      margin: 100px auto;
      width: 95%;
      padding: 20px;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #999;
      border: 1px solid rgba(0, 0, 0, 0.2);
      border-radius: 0;
      -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
      box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
      font-size: 14px;
      line-height: 1.42857143;
      color: #333;
      position: relative;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
    }

    #app_common_modal_close,
    #error_handler_overlay_close {
      position: absolute;
      right: -10px;
      top: -10px;
      color: #fff;
      background-color: #333;
      border: 2px solid #fff;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      text-align: center;
      cursor: pointer;
      text-decoration: none;
      font-weight: 700;
      line-height: 26px;
      padding: 0;
      margin: 0;
    }

    #app_common_modal .app_modal_body {
      margin: 100px auto;
      min-width: inherit;
      width: 95%;
      min-height: 400px;
      padding: 2.5%;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #999;
      border: 1px solid rgba(0, 0, 0, 0.2);
      border-radius: 0;
      -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
      box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
      font-size: 14px;
      line-height: 1.42857143;
      color: #333;
      position: relative;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      -ms-box-sizing: border-box;
    }

    #app_common_modal .app_modal_body iframe {
      min-height: 400px;
      width: 100%;
      border: 1px solid #d5d6ef;
    }

    .exitpop-content {
      position: fixed;
      height: 400px;
      width: 708px;
      margin: -200px 0 0 -354px;
      top: 50%;
      left: 50%;
      text-align: left;
      padding: 0;
      border: none;
      z-index: 2147483647;
    }

    .exitpopup-overlay {
      background: rgba(0, 0, 0, 0.6);
      height: 100%;
      left: 0;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 2147483647;
      display: none;
    }

    .exitpop-content img {
      display: block;
      margin: 0 auto;
      position: relative;
      text-align: center;
      max-width: 100%;
      height: auto;
    }

    .exitpop-discountbar {
      background-color: red;
      border-bottom: 4px dashed #fff;
      color: #fff;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 15px;
      font-weight: 700;
      height: 50px;
      line-height: 50px;
      position: fixed;
      text-align: center;
      top: 0;
      width: 100%;
      z-index: 9999;
      display: none;
    }

    .app-load-spinner {
      display: none;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      width: 100px;
      height: 100px;
      margin: auto;
      background-color: #333;
      border-radius: 100%;
    }

    #loading-indicator::after,
    #loading-indicator::before {
      box-sizing: border-box;
      left: 50%;
      position: absolute;
      top: 50%;
    }

    .all-card-types li {
      float: left;
      margin-right: 20px;
    }

    #loading-indicator {
      background-color: rgba(0, 0, 0, 0.5);
      bottom: 0;
      box-sizing: border-box;
      font-size: 1px;
      height: 100%;
      left: 0;
      margin: 0 !important;
      padding: 0 !important;
      position: fixed;
      right: 0;
      top: 0;
      width: 100%;
      z-index: 2147483646;
    }

    #loading-indicator::before {
      background: url(../images/loading.gif) center center no-repeat rgba(0, 0, 0, 0);
      content: "";
      height: 70px;
      margin-left: -35px;
      margin-top: -70px;
      width: 70px;
      z-index: 2;
    }

    #loading-indicator::after {
      background: #fff;
      border-radius: 5px;
      color: #000;
      content: "Processing, one moment please... ";
      font-family: arial;
      font-size: 17px;
      height: 110px;
      line-height: 98px;
      margin-left: -150px;
      margin-top: -75px;
      padding-top: 35px;
      text-align: center;
      width: 300px;
      z-index: 1;
    }

    @-webkit-keyframes scaleout {
      0% {
        -webkit-transform: scale(0);
      }

      100% {
        -webkit-transform: scale(1);
        opacity: 0;
      }
    }

    @keyframes scaleout {
      0% {
        transform: scale(0);
        -webkit-transform: scale(0);
      }

      100% {
        transform: scale(1);
        -webkit-transform: scale(1);
        opacity: 0;
      }
    }

    @media screen and (max-device-width: 767px) and (orientation: landscape) {

      #app_common_modal .app_modal_body,
      #error_handler_overlay .error_handler_body {
        margin: 20px auto;
      }

      #app_common_modal .app_modal_body iframe {
        min-height: 360px;
      }
    }

    @media (max-device-width: 767px) {
      #app_common_modal .app_modal_body {
        margin: 2% auto;
      }
    }
  </style>
  <script>
    $(document).on("click", "#app_common_modal_close", function() {
      $("#app_common_modal").remove();
    });

    function openNewWindow(
      page_url,
      type,
      window_name,
      width,
      height,
      top,
      left,
      features
    ) {
      if (!type) {
        type = "popup";
      }

      if (!width) {
        width = 480;
      }

      if (!height) {
        height = 480;
      }

      if (!top) {
        top = 50;
      }

      if (!left) {
        left = 50;
      }

      if (!features) {
        features = "resizable,scrollbars";
      }

      if (type == "popup") {
        var settings = "height=" + height + ",";
        settings += "width=" + width + ",";
        settings += "top=" + top + ",";
        settings += "left=" + left + ",";
        settings += features;

        win = window.open(page_url, window_name, settings);
        win.window.focus();
      } else if (type == "modal") {
        var html = "";
        html += '<div id="app_common_modal">';
        html +=
          '<div class="app_modal_body"><a href="javascript:void(0);" id="app_common_modal_close">X</a><iframe src="' +
          page_url +
          '" frameborder="0"></iframe></div>';
        html += "</div>";

        if (!$("#app_common_modal").length) {
          $("body").append(html);
        }
        $("#app_common_modal").fadeIn();
      }
    }
  </script>
</body>
<?php
$file2 = $_SERVER['DOCUMENT_ROOT'] . '/wisepop.php';
if (file_exists($file2)) {
  include_once($_SERVER['DOCUMENT_ROOT'] . '/wisepop.php');
}
?>

</html>