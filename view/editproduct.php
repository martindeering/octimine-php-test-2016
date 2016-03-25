<?php

/**
 *	editproduct.php
 *
 *	a content view page that shows all products in the db
 *	version 1.0
 */


writeTraceLog("editproduct.php starts here ------->");

// Get the POST variables
$product_id = $_POST['product_id'];
$product_type = $_POST['product_type'];

// instantiate product class
$thisProduct = new Product;
$countOfAllProducts = $thisProduct->returnCountOfAllProducts();
$thisProduct->getProductByID($product_id);

// Set variables, get product lists
if ($product_type == "food")
{
	$heading = "Food";
	//$countOfAllTheseProducts = $product->returnCountofAllFoodProducts();
} else {
	$heading = "Clothing";
	//$countOfAllTheseProducts = $product->returnCountofAllClothingProducts();
}


?>
<!-- Begin the HTML body code -->
	<h3>Inventory of Products <span class="label label-success"><?php echo $countOfAllProducts; ?> Items</span></h3>
	<br /><br />

	<h3>Edit <?php echo $heading; ?> Product Item</h3>
	<!-- Listing Food Products in Table -->
	
	<table class="table table-hover">
		<thead>
			<tr>
				<th class="col-xs-2">Product ID</th>
				<th class="col-xs-4">Product Name</th>
				<th class="col-xs-2">Product Price</th>
				<th class="col-xs-4">&nbsp;</th>
			</tr>
		</thead>
	</table>

	<form action="index.php" method="post" name="updateProduct" class="form-horizontal">
		<div class="form-group">
			<p class="col-xs-2"><?php echo $thisProduct->product_id ?></p>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="product_name" value="<?php echo $thisProduct->product_name?>" autocomplete="off">
			</div>
			<label for="inputProductPrice" class="control-label sr-only">Price</label>
			<div class="col-xs-2">
				<input type="text" class="form-control" name="product_price" value="<?php echo $thisProduct->product_price?>" autocomplete="off">
			</div>
			<input type="hidden" name="product_id" value="<?php echo $thisProduct->product_id ?>" />
			<input type="hidden" name="product_type" value="food" />
			<button class="btn btn-warning col-sm-offset-2" type="submit" name="action" value="updateProduct">Update</button>
		</div>
	</form>
	<br /><br />
