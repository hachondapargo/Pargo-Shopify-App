<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Pargo Shipping App</title>
  <meta name="description" content="Pargo Shoppify App">
  <meta name="author" content="Pargo">

  <script src="https://cdn.shopify.com/s/assets/external/app.js"></script>

  <script type="text/javascript">
    ShopifyApp.init({
      apiKey: 'e7d89fd48235f7ce534f33aca979b125',
      shopOrigin: 'pargobox.myshopify.com',
      debug: false,
  forceRedirect: false
    });

 </script>  

 <script type="text/javascript">
  ShopifyApp.ready(function(){
    ShopifyApp.Bar.initialize({
      icon: 'https://pargo.co.za/pargoshopify/php-shopify/images/pargo-logo-small.png',
      title: 'Pargo Pargo Shoppify App',
      buttons: {
        primary: {
          label: 'Save',
          message: 'save',
          callback: function(){
            ShopifyApp.Bar.loadingOn();
            //doSomeCustomAction();
          }
        }
      }
    });
  });
</script>

  <link rel="stylesheet" href="css/styles.css?v=1.0">
  <link rel="stylesheet" href="css/uptown.css?v=1.0">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->

  <?php

	session_start(); //start a session

	require 'vendor/autoload.php';
	//use sandeepshetty\shopify_api;

	$db = new Mysqli("localhost", "webuser", "5wj2pPUM3pX4FwdM", "pargo_shopify");

	if($db->connect_errno){
	  die('Connect Error: ' . $db->connect_errno);
	}

	$config = array(
	    'ShopUrl' => 'pargobox.myshopify.com',
	    'ApiKey' => 'e7d89fd48235f7ce534f33aca979b125',
	    'SharedSecret' => '1ed94be70a341b53fe18da0ff397474f',
	);


	//your_redirect_url.php
	PHPShopify\ShopifySDK::config($config);
	$accessToken = \PHPShopify\AuthHelper::getAccessToken();
	//Now store it in database or somewhere else

	//Save Token to session

	$_SESSION['accessToken'] = $accessToken;

	//For 3rd Part Apps, using access token and reconfigure

	$config2 = array(
    'ShopUrl' => 'pargobox.myshopify.com',
    'AccessToken' => $accessToken,
	);

	PHPShopify\ShopifySDK::config($config2);


	/*

	$accessToken = $_SESSION['accessToken'];
	$shopname    = $_SESSION['shopname'];
	$scopes      = $_SESSION['$scopes'];

	*/

	if(!empty($_GET['shop'])){ 

	$shopname = $_GET['shop']; //shop name

	$db->query("
	     INSERT INTO tbl_usersettings 
	     SET access_token = '$accessToken',
	     store_name = '$shopname'
	 ");

	//echo $accessToken;
	//echo $shopname;
	//echo $scopes;

	  //header('Location: https://pargo.co.za/pargoshopify/php-shopify/home.php');

	}

	//echo "Welcome to the Pargo Plugin";

	$shopify = new PHPShopify\ShopifySDK;

	//$products = $shopify->Product->get();

	//$products = $shopify->Product->get();

	//var_dump($products);

	$addPargoCarrierService = array(
    "name" => "Pargo Carrier Service",
    "active" => "true",
    "carrier_service_type" => "api",
    "callback_url" => "https://pargo.co.za/pargoshopify/php-shopify/rates.php",
    "service_discovery" => true,
    "format" => "json"
    );

  $findPargoCarrierService = null;

  $pargoCarrierServiceParams = array(
    "name" => "Pargo Carrier Service"
  );

  $findPargoCarrierService = $shopify->CarrierService->get($pargoCarrierServiceParams);

  if(empty($findPargoCarrierService)){ 

  $shopify->CarrierService->post($addPargoCarrierService);

  }
	
  /* VAR DUMPS 

  var_dump($allCarrierServices);
  echo "end vardump Carrier<br>";


  print_r($allCarrierServices);

  echo "end print r of Carrier<br>";

  */

  /*To DELETE Carrier 

  $pargocarrierserviceid = 15733191;

  $shopify->CarrierService($pargocarrierserviceid)->delete();

  echo "Carrier DELETED";

 $allCarrierServices = $shopify->CarrierService->get();

 var_dump($allCarrierServices);

 echo "after Carrier DELETED";

 /*

	$addPargoFulfilmentService = array(
    "name" => "Pargo Fulfillment",
    "handle" => "pargo_fulfillment_service",
    "format" =>"json",
    "email" =>"hachonda@pargo.co.za",
    "callback_url" => "https://pargo.co.za/pargoshopify/php-shopify/rates.php",
    "inventory_management" => false,
    "provider_id" => null,
    "tracking_support" => false,
    "requires_shipping_method" =>false
    );

   

	//$shopify->FulfillmentService->post($addPargoFulfilmentService);


  $allFulfilmentServices = $shopify->FulfillmentService->get();

  var_dump($allFulfilmentServices);

echo "end vardump Fulfil";


print_r($allFulfilmentServices);

echo "end print r Fulfil";

*/


/**TO Delete Fullfillment*

$pargofulfillmentserviceid = 1553031;

$shopify->FulfillmentService($pargofulfillmentserviceid)->delete();

echo "Fulfillment DELETED";

$allFulfilmentServices = $shopify->FulfillmentService->get();

var_dump($allFulfilmentServices);

echo "after Fulfillment DELETED";

*/


/*Inserting Pargo Script Tag*/

$addPargoScriptTag = array(
    "event" => "onload",
    "src" => "https://pargo.co.za/pargoshopify/php-shopify/js/pargo-js.js",
    "display_scope" => "all"
    );

$shopify->ScriptTag->post($addPargoScriptTag);

//$allPargoScriptTags = $shopify->ScriptTag->get();

//echo "All script tags";

//var_dump($allPargoScriptTags);


//End PHP section


?>

</head>

<body>

  <script src="js/scripts.js"></script>
  

  <main>
<header  class="" style="padding-top:10px">
<img width="180px" src="https://pargo.co.za/pargoshopify/php-shopify/images/pargo-logo-small.png" class="align-center">
  <!--h1>Pargo Shipping</h1>
  <h2>A convenient logistics solution</h2-->
</header>
<article>
<p>
	<div class="card">
      
    </div>
</p>
</article>

<section>

  <article>
  	<div class="card columns eight">
    	<div style="display:inline-block;"><!--i class="icon-cart"--></i><h5>Plugin Settings</h5></div>
    <p>

      <div class="row">
        <label>Label</label>
        <input type="text" />
      </div>
      <div class="row">
        <label><input type="radio" name="option1a" checked="checked">Option</label>
        <label><input type="radio" name="option1a">Option</label>
      </div>
      <div class="row">
        <select><option>Select</option></select>
      </div>
      <div class="row">
        <label><input type="checkbox" name="option2a" checked="checked">Option</label>
        <label><input type="checkbox" name="option2a">Option</label>
      </div>
      <div class="row">
        <textarea></textarea>
      </div>
    </p>
  	</div>

  	<div class="columns four card secondary">
    	<div style="display: inline-block;"><h5>My Pargo</h5><!--i class="icon-home"></i--></div>
    <p>
      <div class="misc-pub-section">
      <p><a href="https://pargo.co.za/mypargo" target="_blank" style="background: #ffeb3b;padding: 10px 10px;display: block;text-align: center;color: #333;text-decoration: none;"><b>Login</b> to your myPargo account</a></p>
      <p>Email Pargo: <a href="mailto:info@pargo.co.za">info@pargo.co.za</a></p>
      <p>Call Pargo: 021 447 3636</p>
      <p>About Pargo: <a href="http://pargo.co.za/faq/" target="_blank">FAQ</a></p>
      
      </div>

    </p>
  	</div>
 </article>

</section>

  <footer>
   <article class="help">
    <span></span>
    <p>Learn more about <a href="#">Pargo</a> at our website <a href="https://pargo.co.za/faq/">FAQ here.</a></p>
  </article>
  </footer>

</main>

<?php

echo "<p>Hachiz Debug Code:</p><br><br>";

$allCarrierServices = $shopify->CarrierService->get();

var_dump($allCarrierServices);
echo "end vardump Carrier<br>";

?>
</body>
</html>
