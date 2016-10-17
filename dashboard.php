<?php
require __DIR__.'/conf.php'; //Configuration
     require __DIR__.'/vendor/autoload.php';
     use phpish\shopify;
     $access_token=$_REQUEST['access_token'];
     $shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );

?>

<?php
try
	{
		# Making an API request can throw an exception
		
		

	     $orders = $shopify('GET /admin/orders.json', array('status'=>'open'));
		 $count=0;
		foreach($orders as $singleorder)
		{
			$id=$singleorder['id']; 
			$title=$singleorder['name']; 
			$order_number=$singleorder['order_number']
			
		     

			

			?>

<!-- HTML Content for Product  START      -->

<div class="feed-product-main-clearfix">

	<div class="product-card-container">
        <span class="product-title-text"><?php echo $id; ?></span>
		<span class="product-title-text"><?php echo $title; ?></span>
		<span class="product-title-text"><?php echo $order_number; ?></span>
		<span class="product-title-text delete" onclick="delete_order(<?php echo $id; ?>);">Delete</span>
    </div>
     

	<?php
	$count++;
	}

	//echo "welcome".$count;

	$item_per_page=5;
	$pages = ceil($count/$item_per_page);



	}
	catch (shopify\ApiException $e)
	{
		# HTTP status code was >= 400 or response contained the key 'errors'
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
	
	?>
<script>
function delete_order(order_id){
	alert(1);
 var access_token='<?php echo $access_token ?>';
	       var shop='<?php echo $_REQUEST['shop'] ?>';
 $.ajax({
                    url: '/order-delete.php?order_id='+ order_id+'&access_token='+access_token+'&shop='+shop,
                    success: function(data){
                   alert(data.html());
                    }
                });
}
</script>

