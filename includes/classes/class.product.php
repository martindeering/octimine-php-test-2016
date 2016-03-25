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
		$table = "`_products_table`";

	// Initiate Database connection
		$connection = Database::getConnection();

	// SELECT product data
		$query = "
		SELECT COUNT(*) 
		FROM ".$table;
		try
		{
			$statement = $connection->prepare($query);
			$statement->bindParam(':product_type', $product_type, PDO::PARAM_STR, 12);
			$result = $statement->execute();
		} catch(PDOException $e) {
			writeTraceLog("returnCountOfAllFoodProducts(): This statement returned false: ".$query);
			// function in functions.php
			handle_sql_errors($query, $e->getMessage());
		}

		$data = $statement->fetch(PDO::FETCH_ASSOC);
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
		writeTraceLog("returnCountOfAllFoodProducts() starts here ------->");

	// ASSIGN the table name, product_type
		$table = "`products_table`";
		$product_type = "food";

	// Initiate Database connection
		$connection = Database::getConnection();
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// SELECT product data
		$query = "
		SELECT COUNT(*) 
		FROM ".$table."
		WHERE `product_type` = :product_type
		";

		try
		{
			$statement = $connection->prepare($query);
			$statement->bindParam(':product_type', $product_type, PDO::PARAM_STR, 12);
			$result = $statement->execute();
		} catch(PDOException $e) {
			writeTraceLog("returnCountOfAllFoodProducts(): This statement returned false: ".$query);
			// function in functions.php
			handle_sql_errors($query, $e->getMessage());
		}

		$data = $statement->fetch(PDO::FETCH_ASSOC);
		$count = $data['COUNT(*)'];

	// Return to controller
		return $count;

	exit;
	}



	/**
	 *	return count of all clothing products
	 */
	public static function returnCountOfAllClothingProducts()
	{
	// add trace
		writeTraceLog("returnCountOfAllClothingProducts() starts here ------->");

	// ASSIGN the table name, product_type
		$table = "`products_table`";
		$product_type = "clothing";

	// Initiate Database connection
		$connection = Database::getConnection();

	// SELECT product data
		$query = "
		SELECT COUNT(*) 
		FROM ".$table."
		WHERE `product_type` = :product_type
		";
		try
		{
			$statement = $connection->prepare($query);
			$statement->bindParam(':product_type', $product_type, PDO::PARAM_STR, 12);
			$result = $statement->execute();
		} catch(PDOException $e) {
			writeTraceLog("returnCountOfAllFoodProducts(): This statement returned false: ".$query);
			// function in functions.php
			handle_sql_errors($query, $e->getMessage());
		}

		$data = $statement->fetch(PDO::FETCH_ASSOC);
		$count = $data['COUNT(*)'];

	// Return to controller
		return $count;

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