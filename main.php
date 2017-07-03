<?php

session_start(); //start a session

require 'vendor/autoload.php';
//use sandeepshetty\shopify_api;

//Access Database

$db = new Mysqli("localhost", "webuser", "5wj2pPUM3pX4FwdM", "pargo_shopify");

if($db->connect_errno){
  die('Connect Error: ' . $db->connect_errno);
}

$select_settings = $db->query("SELECT * FROM tbl_appsettings WHERE id = 1");
$app_settings = $select_settings->fetch_object();


//use sandeepshetty\shopify_api;

// 1. Initialize

$config = array(
    'ShopUrl' => 'pargobox.myshopify.com',
    'ApiKey' => 'e7d89fd48235f7ce534f33aca979b125',
    'SharedSecret' => '1ed94be70a341b53fe18da0ff397474f',
);

PHPShopify\ShopifySDK::config($config);

// 2.Create the authentication request

//your_authorize_url.php
//$scopes = 'read_products,write_products,read_script_tags,write_script_tags';
//This is also valid
$scopes = array('read_content', 'write_content', 'read_themes', 'write_themes', 'read_products', 'write_products', 'read_customers', 'write_customers', 'read_orders', 'write_orders', 'read_script_tags', 'write_script_tags', 'read_fulfillments', 'write_fulfillments', 'read_shipping', 'write_shipping'); 

$redirectUrl = 'https://pargo.co.za/pargoshopify/php-shopify/start.php';

\PHPShopify\AuthHelper::createAuthRequest($scopes, $redirectUrl);


/*

//your_redirect_url.php
PHPShopify\ShopifySDK::config($config);
$accessToken = \PHPShopify\AuthHelper::getAccessToken();
//Now store it in database or somewhere else

$_SESSION['accessToken'] = $accessToken;
$_SESSION['shopname'] = $shopname;
$_SESSION['$scopes'] = $scopes;

*/

/**

if(!empty($_GET['shop'])){ 

$shop = $_GET['shop']; //shop name

$db->query("
     INSERT INTO tbl_usersettings 
     SET access_token = '$accessToken',
     store_name = '$shop'
 ");

//save the signature and shop name to the current session
  $_SESSION['shopify_signature'] = $_GET['signature'];
  $_SESSION['shop'] = $shop;

  header('Location: https://pargo.co.za/pargoshopify/php-shopify/start.php');

}

**/

?>