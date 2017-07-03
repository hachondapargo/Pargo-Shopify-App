<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Pargo Shipping App</title>
  <meta name="description" content="Pargo Shoppify App">
  <meta name="author" content="Pargo">

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

	echo $accessToken;
	echo $shopname;
	//echo $scopes;

	  //header('Location: https://pargo.co.za/pargoshopify/php-shopify/home.php');

	}

	echo "Welcome to the Pargo Plugin";

	$shopify = new PHPShopify\ShopifySDK;

	$products = $shopify->Product->get();

	//$products = $shopify->Product->get();

	var_dump($products);

?>

</head>

<body>
  <script src="js/scripts.js"></script>
  <main>
<header>
  <h1>Pargo Shipping</h1>
  <h2>A convenient logistics solution</h2>
</header>
<article>
Automatic Pull-up?
	<div class="card">
      Card
    </div>
  
</article>

<section>

  <article>
  	<div class="card columns eight">
    	<p>Card</p>
  	</div>

  	<div class="card columns four">
    	<p>Card</p>
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
</body>
</html>
