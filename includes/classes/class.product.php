<?php
/**
 *	class.product.php
 *	
 */
 
 
// TO DO
// if time: $result = session::comparePostandSessionFingerprints();


// Methods needed:
//	Count of all products
//	count of products by type (food and clothing)
//	list all products by type (food and clothing)
// 	add product to the db
//	remove product from db
//	edit product in db


class Product
{	
/*
 *	Properties
 */

	public $product_id;
	public $product_type;
	public $product_name;
	public $product_price;


	public function __construct()
	{
		$this->product_id = '';
		$this->product_type = '';
		$this->product_name = '';
		$this->product_price = '';
	}


	public function setProductData($product_id, $product_type, $product_name, $product_price)
	{
		$this->product_id = $product_id;
		$this->product_type = $product_type;
		$this->product_name = $product_name;
		$this->product_price = $product_price;
	}


	public function getProductData()
	{
		echo $this->product_id."<br />";
		echo $this->product_type."<br />";
		echo $this->product_name."<br />";
		echo $this->product_price."<br />";
	}



	/**
	 *	return count of all products
	 */
	public static function returnCountOfAllProducts()
	{
	// add trace
		writeTraceLog("returnCountofAllProducts() starts here ------->");

	// ASSIGN the table name
		$table = "products_table";

	// Initiate Database connection
		$connection = Database::getConnection();

	// SELECT product data
		$query = "
		SELECT COUNT(*) 
		FROM ".$table;
		$statement = $connection->prepare($query);
		$result = $statement->execute();
		$data = $statement->fetch(PDO::FETCH_ASSOC);
		if (!$result)
		{
			writeTraceLog("returnCountofAllProducts(): This statement returned false: ".$query);
			$warning = "Sorry, but there was a database problem. Please try again.";
			session::addSessionGeneralWarning($warning);
			return;
		}
		$count = $data['COUNT(*)'];

	// Return to controller
		return $count;
	exit;
	}



	/**
	 *	return count of all food products
	 */
	public static function returnCountOfAllFoodProducts()
	{
	// add trace
		

	// Initiate Database connection


	// COUNT product data


	// Return to controller


	exit;
	}



	/**
	 *	return count of all clothing products
	 */
	public static function returnCountOfAllClothingProducts()
	{
	// add trace
		

	// Initiate Database connection


	// COUNT product data


	// Return to controller


	exit;
	}



//	list all products by type (food and clothing)
	/**
	 *	return list of all food products
	 */
	public static function returnListOfAllFoodProducts()
	{
	// add trace
		

	// Initiate Database connection


	// SELECT product data


	// Return to controller


	exit;
	}




//	list all products by type (food and clothing)
	/**
	 *	return list of all clothing products
	 */
	public static function returnListOfAllClothingProducts()
	{
	// add trace
		

	// Initiate Database connection


	// SELECT product data


	// Return to controller


	exit;
	}



	/**
	 *	add a new product to the database
	 */
	public static function addNewProduct($product_type, $product_name, $product_price)
	{
	// add trace
		

	// VERIFY all required variables have content

		
	// ASSIGN the $_POST variables to named variables


	// VALIDATE all required variables

		
	// Initiate Database connection


	// INSERT product data


	// Return to controller


	exit;
	}



	/**
	 *	remove a product from the database
	 */
	public static function removeProduct($product_type, $product_name)
	{
	// add trace
		

	// VERIFY all required variables have content

		
	// ASSIGN the $_POST variables to named variables


	// VALIDATE all required variables

		
	// Initiate Database connection


	// DELETE product data


	// Return to controller


	exit;
	}



	/**
	 *	edit a product in the database
	 */
	public static function editProduct($product_type, $product_name)
	{
	// add trace
		

	// VERIFY all required variables have content

		
	// ASSIGN the $_POST variables to named variables


	// VALIDATE all required variables

		
	// Initiate Database connection


	// UPDATE product data


	// Return to controller


	exit;
	}



}
?>