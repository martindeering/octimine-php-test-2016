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
	<h3>Inventory of Products <span class="label label-success"><?php echo $countOfAllProducts; ?> Items</span></h3>
	<br /><br />

	<!-- Listing Food Products in Table -->
	<h4>List of All Food Products <span class="label label-info"><?php echo $countOfAllFoodProducts; ?> Items</span></h4>
	
	<table class="table table-hover">
		<thead>
			<tr>
				<th class="col-xs-2">Product ID</th>
				<th>Product Name</th>
				<th>Product Price</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $listOfAllFoodProducts; ?>
			<tr>
			</tr>
		</tbody>
	</table>

	<form action='index.php' method='post' name='addNewProduct' class='form-horizontal'>
		<div class="form-group">
			<label for="product_name" class="control-label sr-only">Name</label>
			<div class="col-xs-4 col-sm-offset-2">
				<input type="text" class="form-control" name="product_name" placeholder="Name">
			</div>
			<label for="inputProductPrice" class="control-label sr-only">Price</label>
			<div class="col-xs-2 col-sm-offset-1">
				<input type="text" class="form-control" name="product_price" placeholder="Price">
			</div>
			<input type='hidden' name='product_type' value='food' />
			<button class="btn btn-primary col-sm-offset-1" type='submit' name='action' value='addNewProduct'>Add New Item</button>
		</div>
	</form>
	<br /><br />

	<!-- Listing Food Products in Table -->
	<hr /><br /><br />
	<h4>List of All Clothing Products <span class="label label-info"><?php echo $countOfAllClothingProducts; ?> Items</span></h4>
	
	<table class="table table-hover">
		<thead>
			<tr>
				<th class="col-xs-2">Product ID</th>
				<th>Product Name</th>
				<th>Product Price</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $listOfAllClothingProducts; ?>
		</tbody>
	</table>

	<form action='index.php' method='post' name='addNewProduct' class='form-horizontal'>
		<div class="form-group">
			<label for="product_name" class="control-label sr-only">Name</label>
			<div class="col-xs-4 col-sm-offset-2">
				<input type="text" class="form-control" name="product_name" placeholder="Name">
			</div>
			<label for="inputProductPrice" class="control-label sr-only">Price</label>
			<div class="col-xs-2 col-sm-offset-1">
				<input type="text" class="form-control" name="product_price" placeholder="Price">
			</div>
			<input type='hidden' name='product_type' value='clothing' />
			<button class="btn btn-primary col-sm-offset-1" type='submit' name='action' value='addNewProduct'>Add New Item</button>
		</div>
	</form>
