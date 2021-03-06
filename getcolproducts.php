<?php
     require __DIR__.'/vendor/autoload.php';
     use phpish\shopify;
     $access_token=$_REQUEST['access_token'];
     $shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
     echo $_REQUEST['colid'];
?>

<?php
	try
	{
		# Making an API request can throw an exception
		/*if(isset($_REQUEST['colid']) && $_REQUEST['colid']!=''){
			//alert(1);
		$products = $shopify('GET /admin/products.json?collection_id='.$_REQUEST['colid'], array('published_status'=>'published'));
		}
		else {
			alert(2);
	       $products = $shopify('GET /admin/products.json', array('published_status'=>'published'));
		}*/
		//print_r($products);
		 $products = $shopify('GET  /admin/products.json?collection_id='.$_REQUEST['colid'], array('published_status'=>'published'));
		print_r($products);
		exit;
		foreach($products as $singleproduct)
		{
			$title=$singleproduct['title']; // Product Title
			$variants=$singleproduct['variants'];
		        $p_id1=$singleproduct['id'];

			foreach($variants as $variants){
				$price=$variants['price']; // Product PRice
			}
		        $images=$singleproduct['images'];

			foreach($images as $images){
				$src=$images['src']; //Image Source
			}

			?>

<!-- HTML Content for Product  START      -->

<div class="product-card-clearfix">

	<div class="product-card-container">

          <div class="ribbon ribbon-<?php echo $p_id1; ?>"><span>SHARED</span></div>

      		<div class="product-card-image-container product-image-<?php echo $p_id1; ?>" style='background-image: url(<?php echo $src; ?>)'>
            <!-- Opacity Layer -->
              <div class="product-card-image-container-background-hover product-opacity-<?php echo $p_id1; ?>"></div>
            <!-- Product Details Layer -->
              <div class="product-card-image-container-content-hover product-details-<?php echo $p_id1; ?>">
                  <div class="product-details-container">
                      <div class="product-icon-container" style="margin-bottom: 15px;">
                         <span class="product-icon-clearfix">

                         </span>
                      </div>

                      <div style="margin-top: 15px;">
                        <span class="product-title-text"><?php echo $title; ?></span>
                      </div>

                      <div style="margin-top: 15px;">
                        <span class="product-card-price-text" style="margin-right: 3px;">$<?php echo $price; ?></span>
                        <span class="product-card-price-text" style="font-size: 12px; color: #888;">$<?php echo $price; ?></span>
                      </div>
                  </div>
                  <div class="preview-button-container">
                    <a id="preview-button-<?php echo $p_id1; ?>" class="preview-button" style="height: 19px; width: calc(100% - 42px);"><i class="fa fa-eye" aria-hidden="true"></i> Preview</a>
                  </div>
              </div>
          </div>

          <div id="<?php echo $p_id1; ?>"  class="share-button-container?>" >

                <script>
                	$(document).ready(function(){
                		var OrigonalTag = '<?php echo $OrigonalTag; ?>';

                		var pid_1 = '<?php echo $p_id1; ?>';
                		//alert(pid_1);
                		var pattern = /shared/;
                		var pattern1 = / shared/;

                		var exists = pattern.test(OrigonalTag);
                		var exists1 = pattern1.test(OrigonalTag);
                		if(exists || exists1 ){
                			var tags_1 = '"<?php echo $tags; ?>"';
                			//alert(tags_1);

                		        var _id = '#'+ pid_1;


                		//$(_id).html('<button type=button class=share-button onclick=unshareButton('+pid_1+',"'+tags_1+'");>UnShare</button>');
                		$(_id).html("<button type='button' class='reset-button'  id='reset-button-<?php echo $p_id1; ?>' onclick='unshareButton("+pid_1+","+tags_1+");'><i class='fa fa-times' aria-hidden='true'></i> Reset</button>");

                		}else{
                			var _id = '#'+ pid_1;
                			<?php
                			if($OrigonalTag == '')
                			{
                			  $OrigonalTag="shared";
                			}
                			else{
                			   $OrigonalTag=$OrigonalTag.",shared";
                			}
                			?>
                			var tags_1 = '"<?php echo $OrigonalTag; ?>"';

                			  //$(_id).html('<button type="button" class=share-button onclick=shareButton('+pid_1+',"'+tags_1+'");>Share</button>');
                	$(_id).html("<button type='button' class='share-button' id='share-button-<?php echo $p_id1; ?>' onclick='shareButton("+pid_1+","+tags_1+");'><i class='fa fa-bullhorn' aria-hidden='true'></i> Share</button>");
                		}
                	});
                </script>

	           </div>

      </div>

</div>

<!-- Show / Hide Product Details -->
<script>
  $('.product-image-<?php echo $p_id1; ?>').hover(function() {
    // Show / Hide Product Details Opacity Container
      $('.product-opacity-<?php echo $p_id1; ?>').toggle();
    // Show / Hide Product Details Container
      $('.product-details-<?php echo $p_id1; ?>').toggle();
  });
</script>

<!-- Preview Drop Down -->
<script>
$(document).ready(function(){

      $('#preview-button-<?php echo $p_id1; ?>').click(function() {
              $('#preview-container').addClass("preview-container-animate");
              $('.close-preview-container').css('display', 'flex');
      });

      $('#close-preview-button').click(function() {
              $('#preview-container').removeClass("preview-container-animate");
              $('.close-preview-container').css('display', 'none');
      });

  });
</script>

<!-- Shared Banner -->
<script>
$(document).ready(function(){
    if ( $( "#reset-button-<?php echo $p_id1; ?>" ).length != 0) {
      $('.ribbon-<?php echo $p_id1; ?>').css( "display", "block" );
    } else {
      $('.ribbon-<?php echo $p_id1; ?>').css( "display", "none" );
    }
});

$(document).ready(function(){
    $( "#reset-button-<?php echo $p_id1; ?>" ).click( function()  {
      $('.ribbon-<?php echo $p_id1; ?>').css( "display", "none" );
    });
});

$(document).ready(function(){
    $( "#share-button-<?php echo $p_id1; ?>" ).click( function()  {
      $('.ribbon-<?php echo $p_id1; ?>').css( "display", "block" );
    });
});
</script>
<!-- HTML Content for Product END    -->

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
	<script>
	function shareButton(pid){

               var access_token='<?php echo $access_token ?>';
	       var shop='<?php echo $_REQUEST['shop'] ?>';


                $.ajax({
                    url: '/sharebutton.php?pid='+ pid+'&access_token='+access_token+'&shop='+shop,
                    success: function(data){

                    }
                });
            }
	</script>
