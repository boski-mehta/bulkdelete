<?php

     require __DIR__.'/vendor/autoload.php';
     use phpish\shopify;
     echo $access_token=$_REQUEST['access_token'];
     $shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
     echo $oid=$_REQUEST['order_id'];
?>

<?php
/*try
	{
		# Making an API request can throw an exception
		
		

	     $orders = $shopify('DELETE  /admin/orders'.$oid.'.json', array('status'=>'open'));
		     print_r($orders);

}
catch (shopify\ApiException $e)
	{
		# HTTP status code was >= 400 or response contained the key 'errors'
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}*/
  ?>
