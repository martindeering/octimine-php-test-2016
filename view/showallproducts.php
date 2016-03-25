<?php

/**
 *	showallproducts.php
 *
 *	a content view page that shows all products in the db
 *	version 1.0
 */


writeTraceLog("showallproducts.php starts here ------->");


// instantiate product class
$product = new Product;
$countOfAllProducts = $product->returnCountOfAllProducts();
$countOfAllFoodProducts = $product->returnCountofAllFoodProducts();
$countOfAllClothingProducts = $product->returnCountofAllClothingProducts();

$listOfAllFoodProducts = $product->returnListOfAllFoodProducts();
$listOfAllClothingProducts = $product->returnlistOfAllClothingProducts();

?>
<!-- Begin the HTML body code -->
	<h3>Count of All Products <span class="badge"><?php echo $countOfAllProducts; ?></span></h3>

	<!-- Listing Food Products in Table -->
	<h4>List of All Food Products <span class="badge"><?php echo $countOfAllFoodProducts; ?></span></h4>
	
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Product ID</th>
				<th>Product Name</th>
				<th>Product Price</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $listOfAllFoodProducts; ?>
		</tbody>
	</table>

	<!-- Listing Food Products in Table -->
	<h4>List of All Clothing Products <span class="badge"><?php echo $countOfAllClothingProducts; ?></span></h4>
	
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Product ID</th>
				<th>Product Name</th>
				<th>Product Price</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $listOfAllClothingProducts; ?>
		</tbody>
	</table>

