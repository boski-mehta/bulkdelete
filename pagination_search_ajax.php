<?php
     require __DIR__.'/vendor/autoload.php';
     use phpish\shopify;
     $access_token=$_REQUEST['access_token'];
     $shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
	  $query_title=$_REQUEST['title'];
	   $query_title =str_replace('"','',$query_title);
?>
<?php
try
	{
		if(isset($_REQUEST['title']) && $_REQUEST['title']!='' && $_REQUEST['status']==''){
			
			           
						   $TotalnoOfProduct = $shopify('GET /admin/products/count.json',array('title'=>$query_title));
							//echo "total products=".$TotalnoOfProduct=sizeof($products);
							$limit=50; // Number of product per page
							$noofPages=$TotalnoOfProduct/$limit;
							$noofPages=abs(round($noofPages));
			?>
			<button type="button" id="showLess"><i class="fa fa-long-arrow-left"></i></button> <ul id="pagination-list">
												 
						  <?php
						     for($i=1;$i<=$noofPages;$i++)
							 {?>
								<li class="page-link" onclick="getPagingSearch(this.id,<?php echo $limit; ?>,<?php echo $query_title; ?>)" 
								    id="<?php echo $i; ?>"><?php echo $i; ?></li>
								
						  <?php } ?>
												  
								
						  </ul>
						   <button type="button" id="loadMore"><i class="fa fa-long-arrow-right"></i></button>
			
		<?php	
		}else{
			
			
			
						
						
						
							$TotalnoOfProduct = $shopify('GET /admin/products/count.json',array('title'=>$query_title));
							//echo "total products=".$TotalnoOfProduct=sizeof($products);
							$limit=50; // Number of product per page
							$noofPages=$TotalnoOfProduct/$limit;
							$noofPages=abs(round($noofPages));
		
		?>				
						 
						<button type="button" id="showLess"><i class="fa fa-long-arrow-left"></i></button> <ul id="pagination-list">
												 
						  <?php
						     for($i=1;$i<=$noofPages;$i++)
							 {?>
								<li class="page-link" onclick="getPagingALLProduct(this.id,<?php echo $limit; ?>)" id="<?php echo $i; ?>"><?php echo $i; ?></li>
								
						  <?php } ?>
												  
								
						  </ul>
						   <button type="button" id="loadMore"><i class="fa fa-long-arrow-right"></i></button>
		<?php				   
		}
	}
	catch (shopify\ApiException $e)
	{
		# HTTP status code was >= 400 or response contained the key 'errors'
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
	catch (shopify\CurlException $e)
	{
		# cURL error
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
?>
