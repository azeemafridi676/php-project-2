<?php

$querystring = '?' . $_SERVER['QUERY_STRING'];

/* Redirect based on browser */

if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('@(iPad|iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)@', $useragent)) {
        header('Location: ./mobile/' . $querystring);
    }
}

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
<html>

<head>
    <?php
    $pixelsPath = $_SERVER['DOCUMENT_ROOT'] . '/pixels.php';
    if (file_exists($pixelsPath)) {
        include_once($pixelsPath);
    }
    ?>
    <meta charset="utf-8" />
    <title>Revolt CBD Gummies</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

    <link rel="stylesheet" type="text/css" href="css/style2.css" />
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&amp;display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <script type="text/javascript">
        function getDate(days) {
            var monthNames = new Array(
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec"
            );
            var now = new Date();
            now.setDate(now.getDate() + days);
            var nowString =
                monthNames[now.getMonth()] +
                " " +
                now.getDate() +
                ", " +
                now.getFullYear();
            document.write(nowString);
        }
    </script>
</head>

<body>
    <div id="container">
        <div class="tophdr" id="header">
            <div class="contentWrap" style="position: relative">
                <p class="hdrtxt">
                    <span>WARNING:</span> Due to extremely high media demand, there is
                    limited supply of Revolt Gummies in stock as of
                    <b>
                        <script type="text/javascript">
                            getDate(0);
                        </script>
                    </b>
                </p>
            </div>
        </div>
    </div>

    <div id="section1">
        <div class="sec1inner">
            <div class="contentWrap" style="position: relative">
                <div class="lft-content">
                    <img src="images/logo (2).png" alt="" class="s1-logo" />
                    <img src="images/top-txt.png" alt="" class="top-txt" />
                    <p class="s1hding">Medical Strength Male Enhancement</p>
                    <p class="s1hding2">
                        GET MAXIMUM <br />
                        <span>SEXUAL BENEFITS</span>
                    </p>
                    <div class="doctor">
                        <img src="images/rx.png" width="504" height="88" alt="" class="rx" />
                    </div>
                    <img src="images/arrow.png" width="534" height="106" alt="" class="s1-arrow" />
                    <img src="images/as-seen.png" width="467" height="44" alt="" class="as-seen" />
                    <img src="images/main_product.png" alt="" class="s1-prod2" />
                    <img src="images/main_product.png" alt="" class="s1-prod1" />
                    <img src="images/gummies.png" alt="" class="s1-gummies" />

                    <img src="images/us-seal.png" width="173" height="173" alt="" class="us-seal" />
                    <div class="clearall"></div>
                    <p class="report-txt">Customers Report:</p>

                    <ul class="s1list">
                        <li>
                            <span>Bigger &amp; Long-Lasting Erections </span><br />Maximum
                            pleasure &amp; intensified orgasms
                        </li>
                        <li>
                            <span>Surge In Sex Drive &amp; Energy </span><br />Ramps up
                            stamina &amp; staying power
                        </li>
                        <li>
                            <span>Increased Sexual Confidence </span><br />Experience
                            vitality &amp; peak performance
                        </li>
                    </ul>
                </div>

                <div class="rgt-frm">
                    <div class="frm-top"><img src="images/frm-top.png" alt="" /></div>
                    <div class="form-position">
                        <form name="StemLife_form" method="post" class="" id="lpFrm" action="checkout.php">
                            <input type="hidden" value="" name="affId">
                            <input type="hidden" value="" name="cv1">

                            <div class="form-fields">
                                <div class="blank"></div>
                                <div class="frmElemts halfl">
                                    <input class="form-control" placeholder="First Name" type="text" name="firstName" required="">
                                </div>
                                <div class="frmElemts halfr">
                                    <input class="form-control" placeholder="Last Name" type="text" name="lastName" required="">
                                </div>
                                <div class="frmElemts">
                                    <input class="form-control" placeholder="Your Address" type="text" id="street1" name="address" required="">
                                </div>
                                <div class="frmElemts halfl">
                                    <input class="form-control" placeholder="Your City" type="text" id="fields_city" name="city" required="">
                                </div>
                                <div class="frmElemts halfr">
                                    <input class="form-control" id="fields_zip" name="zipCode" placeholder="Zip Code" title="Zip Code" type="tel" minlength="5" maxlength="5" required="">
                                </div>
                                <div class="frmElemts">
                                    <select id="fields_state" class="form-control required" name="state" required="">
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
                                <div class="frmElemts">
                                    <input class="form-control" placeholder="Email Address" type="email" name="email" required="">
                                </div>
                                <div class="frmElemts">
                                    <input id="fields_phone" class="form-control" placeholder="Phone" name="phone" type="tel" required="">
                                </div>
                                <div class="frm-btm">
                                    <img src="images/lock.png" alt="" class="lock" width="199" height="10" />
                                    <input id="partialSubmit" type="image" src="images/button.png" class="submit pulse">

                                    <img src="images/frm-btm.png" alt="" class="security" width="164" height="39" />
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="section2">
        <div class="sec2inner">
            <div class="contentWrap" style="position: relative">
                <p class="sec2hding">
                    <span>THE SEXUAL HEALTH DIVIDE </span><br />ARE YOU SUFFERING FROM
                    THE FOLLOWING SYMPTOMS
                </p>
                <p class="s2txt">
                    Leading surveys on sexual health and satisfaction levels among<br />
                    American men have revealed the following:
                </p>
                <div class="red-box">
                    <div class="s2box1">
                        <center>
                            <img src="images/icon1-sec2.png" width="200" height="197" alt="" />
                        </center>
                        <p class="s2box-txt">
                            Say sexual health impacts on overall life satisfaction
                        </p>
                    </div>
                    <div class="s2box2">
                        <center>
                            <img src="images/icon2-sec2.png" width="200" height="197" alt="" />
                        </center>
                        <p class="s2box-txt">
                            Of men suffer from Small Penis<br />
                            Syndrome
                        </p>
                    </div>
                    <div class="s2box3">
                        <center>
                            <img src="images/icon3-sec2.png" width="200" height="197" alt="" />
                        </center>
                        <p class="s2box-txt">
                            Believe <br />embarrassment is a major sexual barrier
                        </p>
                    </div>
                    <div class="s2box4">
                        <center>
                            <img src="images/icon4-sec2.png" width="200" height="197" alt="" />
                        </center>
                        <p class="s2box-txt">
                            Avoid sex altogether because of lack of sexual confidence
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="section3">
        <div class="sec3inner">
            <div class="contentWrap" style="position: relative">
                <img src="images/main_product.png" alt="" class="s3-prod1" />
                <img src="images/main_product.png" alt="" class="s3-prod2" />
                <img src="images/gummies.png" alt="" class="s3-gummies" />
                <img src="images/us-seal.png" width="120" height="120" alt="" class="satisfaction-seal" />
                <p class="s3hding">
                    <span>Revolt Gummies</span><br />
                    MALE ENHANCEMENT SYSTEM
                </p>
                <p class="sec3txt">
                    <b>Made with a blend of clinical strength ingredients,
                        <span>
                            Revolt Gummies's is a male enhancement system</span>
                        that has been formulated to restore your sexual youth and
                        performance and help you experience an intense, blissful &amp;
                        powerful sex life.</b><br /><br />

                    <strong>Revolt Gummies's</strong> formula treats the root
                    cause of sexual dysfunctions, ensuring that you are able to satisfy
                    your partner, consistently! Made with herbal extracts and active
                    botanicals, <strong>Revolt Gummies's</strong> is
                    completely safe to use and is free from any harmful side effects.
                </p>
                <p class="sec3txt2">
                    TRIPLE INTENSITY<br /><span>MALE ENHANCEMENT</span><br />FOR MAXIMUM
                    RESULTS
                </p>
                <p class="sec3txt3">
                    The pro-sexual nutrient matrix in Revolt Gummies helps
                    boost the 3S's of Sex - Size, Stamina &amp; Satisfaction, helping
                    you peak perform and pleasure your partner just like you did in your
                    20's!
                </p>
                <p class="sec3txt4">
                    <b>Revolt Gummies </b> is proudly made in the United
                    States of America at a certified manufacturing facility to meet
                    statutory industry standards. Every purchase is backed by a
                    Satisfaction Guarantee, so that you can enjoy the benefits with
                    confidence.
                </p>
                <div class="btn-strip">
                    <p class="btn-txt">
                        <span>ORDER YOUR Revolt Gummies TODAY!</span><br />
                        Experience Sexual Power, Pleasure &amp; Performance
                    </p>
                    <a href="javascript:void(0)" class="cta"><img src="images/button.png" width="275" height="70" alt="" class="sec3btn pulse" /></a>
                </div>
            </div>
        </div>
    </div>

    <div id="section4">
        <div class="contentWrap">
            <p class="s4hding">
                <span>THE SCIENCE BEHIND </span> <br />BETTER, LONGER &amp; MORE
                INTENSE SEX!
            </p>
            <img src="images/clink-seal.png" width="156" height="156" alt="" class="s4seal" />
            <p class="s4txt">
                <span>The blood flow to the penis is responsible for erections while
                    the<br />
                    holding capacity of the penis chambers is what influences sexual
                    stamina<br />
                    and staying power. <b>Revolt Gummies</b> helps boost both
                    to help you and your partner partner enjoy intense orgasms and
                    complete satisfaction.</span><br /><br />
                <strong>Revolt Gummies </strong> pro-sexual nutrient blend
                is quickly absorbed into the bloodstream to stimulate Nitric Oxide
                production - this in turn boosts the flow of blood to the penile
                chambers helping you enjoy harder and stronger erections. On the other
                hand it also expands the penis chambers allowing it to hold more blood
                in order to drastically increase sexual stamina, strength and staying
                power.
            </p>

            <p class="s4txt2">
                <b>Revolt Gummies </b> utilizes a breakthrough rapid
                absorption and extended release technology. Rapid absorption of the
                ingredients into the bloodstream aid in delivering instant surge of
                sexual power while the extended release technology delivers sustained
                results that help you enjoy on command erections and stamina to last
                all night long.
            </p>

            <img src="images/s4img.png" width="325" height="369" alt="" class="s4img" />
            <p class="s4txt3">
                <span>Revolt Gummies</span> WORKS BY TRIGGERING THE TWO
                MECHANISMS <br />KNOWN TO INCREASE PENIS SIZE, FUNCTION AND
                PERFORMANCE. THESE ARE:
            </p>
            <p class="s4txt4">AN INCREASE IN "FREE" TESTOSTERONE AND</p>
            <p class="s4txt5">NITRIC OXIDE PRODUCTION TO THE PENIS.</p>

            <div class="s4btn-strip">
                <p class="btn-txt">
                    <span>ORDER YOUR Revolt Gummies TODAY!</span><br />
                    Experience Sexual Power, Pleasure &amp; Performance
                </p>
                <a href="javascript:void(0)" class="cta"><img src="images/button.png" width="275" height="70" alt="" class="sec3btn pulse" /></a>
            </div>
        </div>
    </div>

    <div id="section5">
        <div class="sec5inner">
            <div class="contentWrap">
                <p class="s5hding">
                    <span>Customer Reported<br />BENEFITS OF Revolt Gummies
                    </span>
                    <br />ADVANCED MALE ENHANCEMENT!
                </p>
                <p class="sec5txt">
                    <span>Revolt Gummies Male Enhancement System</span>
                    offers multiple sexual health benefits to help you <br />enjoy hard
                    erections, increased stamina and peak performance.
                </p>
                <div class="s5benefits">
                    <div class="s5box1">
                        <p class="bnft-txt">IMPROVED LIBIDO &amp; SEX DRIVE*</p>
                        <p class="bnft-txt2">
                            Get ready to<br />experience a torrent of desire &amp; passion
                            with <b>Revolt Gummies</b>, which replenishes sexual
                            energy stores across the body like never before.
                        </p>
                    </div>
                    <div class="s5box2">
                        <p class="bnft-txt">INCREASED STAYING <br />POWER*</p>
                        <p class="bnft-txt2">
                            Bid goodbye to pre-<br />mature ejaculations!
                            <b>Revolt Gummies </b> floods your penile chambers
                            with a gush of blood letting you last 5X more than usual.
                        </p>
                    </div>
                    <div class="s5box5">
                        <p class="bnft-txt">BIGGER, HARDER &amp; LONGER ERECTIONS*</p>
                        <p class="bnft-txt2">
                            <b>Revolt Gummies </b> lets you achieve rock hard
                            erections on command helping you and your partner enjoy insane
                            sexual sessions, whenever you desire.
                        </p>
                    </div>
                    <div class="s5box4">
                        <p class="bnft-txt">IMPROVED SEXUAL CONFIDENCE*</p>
                        <p class="bnft-txt2">
                            Equipped with youthful sexual powers &amp; energy, you are sure
                            to experience sexual confidence like never before, 
                            Revolt Gummies gives you greater success with the most desirable
                            women!
                        </p>
                    </div>
                    <div class="s5box3">
                        <p class="bnft-txt">INCREASED <br />PENIS <br />SIZE*</p>
                        <p class="bnft-txt2">
                            An increase in penile chamber capacity and regular boost in
                            blood flow may help add those inches to your penis size, both
                            length &amp; girth wise.
                        </p>
                    </div>
                </div>
                <img src="images/main_product.png" alt="" class="s5-prod1" />
                <img src="images/main_product.png" alt="" class="s5-prod2" />
                <img src="images/main_product.png" alt="" class="s5-prod3" />
                <img src="images/gummies.png" alt="" class="s5-gummies" />
                <img src="images/satisfaction-seal.png" width="127" height="108" alt="" class="s5img" />
                <img src="images/one-img.png" width="79" height="118" alt="" class="s5img2" />
                <p class="s5lft-txt">
                    <span>Our product backed with a</span><br />100% Satisfaction
                    <br />Guarantee!
                </p>
                <p class="s5rgt-txt">
                    <span>THE NUMBER ONE</span><br />MALE ENHANCEMENT<br /><b>
                        GUMMY IN THE US</b>
                </p>
                <div class="clearall"></div>
                <div class="s5btn-strip">
                    <p class="btn-txt">
                        <span>ORDER YOUR Revolt Gummies TODAY!</span><br />
                        Experience Sexual Power, Pleasure &amp; Performance
                    </p>
                    <a href="javascript:void(0)" class="cta"><img src="images/button.png" width="275" height="70" alt="" class="sec3btn pulse" /></a>
                </div>
            </div>
        </div>
    </div>

    <div id="section7">
        <div class="sec7inner">
            <div class="contentWrap" style="position: relative">
                <p class="s7hding">
                    <span>REAL MEN, REAL RESULTS</span><br />Success Stories From Our
                    Customers
                </p>
                <p class="s7txt">
                    <span>Revolt Gummies has helped hundreds of men across all
                        ages</span>
                    beat sexual dysfunction <br />and enjoy a fuller and more satisfying
                    sex life.
                </p>
                <div class="slider">
                    <div class="slide1">
                        <div class="lft-box">
                            <img src="images/man1.png" width="155" height="158" alt="" class="sliderimg" />
                            <img src="images/star.png" width="101" height="18" alt="" class="star" />
                            <p class="sldr-tstimnl">
                                “<b>Revolt Gummies </b> is truly the best male
                                enhancement system in the market! Unlike other products that
                                have synthetics, <b>Revolt Gummies </b> is made
                                with herbal extracts and botanicals which have been clinically
                                proven to boost virility. I did a thorough research before
                                picking up the product and the results have been truly
                                phenomenal. Highly recommended. ”
                            </p>
                            <p class="tstmnl-name"><span>- Carlos Velez, 43 </span></p>
                        </div>
                        <div class="rgt-box">
                            <p class="clearall"></p>
                            <img src="images/man2.png" width="155" height="158" alt="" class="sliderimg" />
                            <img src="images/star.png" width="101" height="18" alt="" class="star" />
                            <p class="sldr-tstimnl">
                                “The age related ED issues were very frustrating and no gummy
                                seemed to work! When my friend recommended
                                <b>Revolt Gummies </b>, I decided I will give it a
                                try and I am glad I did! It has helped me boost my sexual
                                stamina, size and confidence. And guess who is a bigger fan of
                                <b>Revolt Gummies </b> than me, my wife! ”
                            </p>
                            <p class="tstmnl-name2"><span>- Rob Greco, 54</span></p>
                        </div>
                    </div>
                    <div class="slide2">
                        <div class="lft-box">
                            <img src="images/man3.png" width="155" height="158" alt="" class="sliderimg" />
                            <img src="images/star.png" width="101" height="18" alt="" class="star" />
                            <p class="sldr-tstimnl">
                                “Its great to know that my favorite male enhancement
                                supplement is now available in the market without a
                                prescription! I have been using
                                <b>Revolt Gummies </b> for a few months now and the
                                results have been truly "huge"! I am able to enjoy harder
                                erections, increased sexual drive and stamina, which lets me
                                enjoy love making just like I used to when I was in my 30s! ”
                            </p>
                            <p class="tstmnl-name" style="padding: 25px 0 0 21px">
                                <span>- Vincent Harper, 49</span>
                            </p>
                        </div>
                        <div class="rgt-box">
                            <p class="clearall"></p>
                            <img src="images/man4.png" width="155" height="158" alt="" class="sliderimg" />
                            <img src="images/star.png" width="101" height="18" alt="" class="star" />
                            <p class="sldr-tstimnl">
                                “Age related decline in sexual health along with onset of mild
                                ED had left me pretty shattered. I came across
                                <b>Revolt Gummies </b> on a very reputed blog for
                                male health and decided to give it a try. It has been the best
                                decision I ever made. My sex drive has really taken off, my
                                erections are back to their firm and the increase in sexual
                                stamina is just amazing! ”
                            </p>
                            <p class="tstmnl-name2" style="padding: 25px 0 0 21px">
                                <span>- Sean Carter, 56</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="section8">
        <div class="contentWrap" style="position: relative">
            <img src="images/logo.png" width="168" height="57" alt="" class="s8-logo" />
            <img src="images/rx.png" width="504" height="88" alt="" class="s8no-pres" />
            <p class="s8hding">Medical Strength Male Enhancement</p>
            <p class="s8hding2">
                Get Maximum <br />
                <span>Sexual Benefits</span>
            </p>
            <img src="images/us-seal.png" width="173" height="173" alt="" class="s8seal2" />
            <img src="images/main_product.png" alt="" class="s8-prod1" />
            <img src="images/main_product.png" alt="" class="s8-prod2" />
            <img src="images/main_product.png" alt="" class="s8-prod3" />
            <img src="images/gummies.png" alt="" class="s8-gummies" />

            <div class="clearall"></div>
            <p class="report-txt">Customers Report:</p>

            <ul class="s8list">
                <li>
                    <span>Bigger &amp; Long-Lasting Erections </span><br />Maximum
                    pleasure &amp; intensified orgasms
                </li>
                <li>
                    <span>Surge In Sex Drive &amp; Energy </span><br />Ramps up stamina
                    &amp; power
                </li>
                <li>
                    <span>Increased Sexual Confidence </span><br />Experience vitality
                    &amp; peak performance
                </li>
            </ul>
            <a href="javascript:void(0)" class="cta"><img src="images/button.png" width="275" height="70" alt="" class="sec8btn pulse" /></a>
        </div>
    </div>

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

    <!--popup processing wrapper-->
    <section id="loading-indicator1" class="popup-loading-wrapper" style="display: none">
        <div class="popup">
            <div class="custom-notification-image-wrapper">
                <img style="max-width: 20%" src="images/product.png" />
            </div>
            <p>Please wait a moment</p>
            <h3>Your Product Is Being Reserved</h3>
            <img src="images/icon-loading_fqv5fd.png" alt="" class="loading-image" />
        </div>
    </section>
    <!--end popup processing wrapper-->

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/slick.js"></script>
    <script src="js/jquery.liveaddress.min.js"></script>
    <script src="js/jquery.mask.min.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".slider").slick({
                dots: true,
                autoplay: true,
                autoplaySpeed: 15000,
                adaptiveHeight: true,
                fade: false,
                focusOnSelect: false,
                arrows: false,
                slidesToShow: 1,
            });

            $(".cta").on("click", function() {
                $("html, body").animate({
                        scrollTop: "0px",
                    },
                    "slow"
                );
                return false;
            });
        });
        // $("#fields_phone").mask("(000) 000-0000");

        $.LiveAddress({
            key: "16396943306610135",
            addresses: [{
                id: "shipping",
                address1: "#street1",
                address2: "#street2",
                locality: "#fields_city",
                state_abbreviation: "#fields_state",
                postal_code: "#fields_zip",
            }, ],
        });

        //   $("#lpFrm").on("submit", function (e) {
        //     if (!e.isDefaultPrevented()) {
        //       e.preventDefault();
        //       submitPartial();
        //     }
        //   });

        //   function submitPartial() {
        //     $("#loading-indicator1").show();
        //     $("#partialSubmit").attr("disabled", "disabled");

        //     $.ajax({
        //       type: "POST",
        //       url: "/partial",
        //       dataType: "json",
        //       data: $("#lpFrm").serialize(),
        //     })
        //       .done(function () {
        //         window.location.href = "/checkout";
        //       })
        //       .fail(function (response) {
        //         let data = response.responseJSON;
        //         let error = "";
        //         switch (response.status) {
        //           case 418:
        //             error = response.responseText;
        //             break;
        //           case 419:
        //             error = "Session Expired, please refresh the page";
        //             break;
        //           case 422:
        //             $.each(data.errors, function (key, value) {
        //               console.log(value);
        //               error += value + "\n";
        //             });
        //             break;
        //         }
        //         $("#loading-indicator1").hide();
        //         $("#partialSubmit").removeAttr("disabled");
        //         alert(error);
        //       });
        //   }
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
    <?PHP
    $pixelsFile = $_SERVER['DOCUMENT_ROOT'] . '/wisepop.php';

    if (file_exists($pixelsFile)) {
        include_once $pixelsFile;
    }
    ?>
</body>

</html>