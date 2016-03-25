<?php

/**
 *	showallproducts.php
 *
 *	a content view page that shows all products in the db
 *	version 1.0
 */


writeTraceLog("showallproducts.php starts here ------->");


instantiate product class
$product = new Product;
$countOfAllProducts = $product->returnCountofAllProducts();
//$countOfAllFoodProducts = $product->returnCountofAllFoodProducts();
//$countOfAllClothingProducts = $product->returnCountofAllClothingProducts();
//$listOfAllFoodProducts = $product->listOfAllFoodProducts();
//$listOfAllClothingProducts = $product->listOfAllClothingProducts();

?>
<!-- Begin the HTML body code -->
<div class='someclass'>
	<h1>Count of All Products *badgehere*<?php echo $countOfAllProducts; ?></h1>
	<h1>List All Products</h1>
	<p>To do into table</p>
</div>
