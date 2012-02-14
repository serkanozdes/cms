<?php
$top_url = explode('/', $_SERVER['REQUEST_URI']);
$a_pos = array_search('admin', $top_url);
$current = $top_url[$a_pos + 1];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Bootstrap, from Twitter</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<!-- Le styles -->
    <?php echo Asset::styles()?>
 <style>
body {
	padding-top: 20px;
	/* 60px to make the container go all the way to the bottom of the topbar */
}
</style>
 <?php echo Asset::scripts()?>
    <script>
    $(document).ready(function(e)
    {    	
    	$('#<?php echo $current?>').addClass('active');
    })
</script>
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72"
	href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114"
	href="images/apple-touch-icon-114x114.png">
</head>

<body>

	<div class="container">
		<div class="header">
			<h1 class="pull-left">Logo</h1>
			<div class="pull-right">
				<a href="">View site</a> <a href="">Logout</a>
			</div>
		</div>
		<div class="clear"></div>
		<ul class="nav nav-tabs">
			<li id="language"><a href="<?php echo URL::to('admin/language')?>">Languages</a></li>
			<li id="banner"><a href="<?php echo URL::to('admin/banner')?>">Banners</a></li>
			<li id="category"><a href="<?php echo URL::to('admin/category')?>">Categories</a></li>
			<li id="product"><a href="<?php echo URL::to('admin/product')?>">Products</a></li>
			<li id="offer"><a href="<?php echo URL::to('admin/offer')?>">Offers</a></li>
			<li id="all_products"><a
				href="<?php echo URL::to('admin/all_products')?>">All Products</a></li>
		</ul>
        <?php echo $content?>        
	</div>
	<!-- /container -->

	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
    
</body>
</html>
