<?php
/**
 *	index.php for product inventory
 *
 *	the controller script
 *		get action variable from $_POST or $_GET
 *		switch between actions depending on $action
 *	output the html
 *		require meta_header.html file
 *		load the content div according to switch case
 *	version 1.0
 *	copyright  
 */


// Actions Required:
	// add new product
	// remove product
	// update product
	// list all products
	// count food products
	// count clothing products


// QUESTIONS
	// session data?
		// perhaps for validation? or do js validation on page?
			// would be better via php?


// set variables
require_once('includes/init.php');
$debug_data = "on";


writeTraceLog("index.php starts here ------->");


// Check for action variables, with _POST taking precedence over GET
if (isset($_POST['action']))
{
	$action = filter_var($_POST['action'], FILTER_SANITIZE_STRING);
	$debug_data .= "POST action = ".$action."<br />";
}
else if (isset($_GET['action']))
{
	$action = filter_var($_GET['action'], FILTER_SANITIZE_STRING);
	$debug_data .= "GET action = ".$action."<br />";
}
else
{
	$action = "default";
}


// switch between actions depending on action variable
// each $_SESSION['CONTENT'] matches a view file
switch ($action) 
{
	case 'default':
		// usually a GET call, and the first action for the website
		// call up the home page
			// list all products by type
		$_SESSION['CONTENT'] = 'showallproducts';
	break;


// Product actions set
	case 'addNewProduct':
		$thisProduct = new Product;
		$result = PRODUCT::addNewProduct();
	break;


	case 'removeProduct':
		$thisProduct = new Product;
		$result = PRODUCT::removeProduct();
	break;


	case 'editProduct':
		$_SESSION['CONTENT'] = 'editproduct';
	break;


	case 'updateProduct':
		$thisProduct = new Product;
		$result = PRODUCT::updateProduct();
		$_SESSION['CONTENT'] = 'showallproducts';
	break;
}

?>
<!-- Begin the HTML code -->
<?php require_once('view/meta_header.html') ?>
	<!--- content container  -->
	<div class="container">

		<!--- content view file starts  -->
		<div class="view">
			<?php loadContent('content', ''); // decided by the action switch ?>
		</div>
		<!-- end view div -->

		<?php require_once('view/footer.php'); ?>
	</div>
	<!-- end container div -->

</body>
</html>