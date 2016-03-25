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
	 *	return product data by ID
	 */
	public function getProductByID($product_id)
	{
		writeTraceLog("getProductByID() starts here ------->");
	// Database
		$connection = Database::getConnection();
		$query = "
		SELECT * 
		FROM `products_table`
		WHERE `product_id` = :product_id
		";

// add the error handling here
		try
		{
			$statement = $connection->prepare($query);
			$statement->bindParam(':product_id', $product_id, PDO::PARAM_INT, 11);
			$result = $statement->execute();
		} catch(PDOException $e) {
			writeTraceLog("getProductByID(): This statement returned false: ".$query);
			// function in functions.php
			handle_sql_errors($query, $e->getMessage());
		}

		$data = $statement->fetch(PDO::FETCH_ASSOC);

		$thisProduct = new Product;
		self::setProductData($data['product_id'], $data['product_type'], $data['product_name'], $data['product_price']);

		return;
	}



	/**
	 *	return count of all products
	 */
	public static function returnCountOfAllProducts()
	{
	// add trace
		writeTraceLog("returnCountofAllProducts() starts here ------->");

	// ASSIGN the table name
		$table = "`products_table`";

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



	/**
	 *	return list of all food products
	 */
	public static function returnListOfAllFoodProducts()
	{
	// add trace
		writeTraceLog("returnListOfAllFoodProducts() starts here ------->");

	// ASSIGN the table name
		$table = "`products_table`";
		$product_type = "food";

	// Initiate Database connection
		$connection = Database::getConnection();

	// SELECT product data
		$query = "
		SELECT `product_id` 
		FROM ".$table."
		WHERE `product_type` = :product_type
		ORDER BY `product_id` ASC
		";
		try
		{
			$statement = $connection->prepare($query);
			$statement->bindParam(':product_type', $product_type, PDO::PARAM_STR, 12);
			$result = $statement->execute();
		} catch(PDOException $e) {
			writeTraceLog("returnListOfAllFoodProducts(): This statement returned false: ".$query);
			// function in functions.php
			handle_sql_errors($query, $e->getMessage());
		}

		$data = $statement->fetchAll(PDO::FETCH_ASSOC);

	// OUTPUT the data in table form
		// Includes Edit and Remove buttons
		$output = "";
		foreach($data as $key)
		{
			$thisProduct = new Product;
			$thisProduct->getProductByID($key['product_id']);
			
			$output .= 
			"
				<tr>
					<td>".$thisProduct->product_id."</td>
					<td>".$thisProduct->product_name."</td>
					<td>".$thisProduct->product_price."</td>
					<td>					
						<div class='btn-toolbar pull-right'>
							<div class='btn-group'>
								<form action='index.php' method='post' name='editProduct'>
									<input type='hidden' name='product_id' value='".$thisProduct->product_id."'>
									<input type='hidden' name='product_type' value='".$thisProduct->product_type."'>
									<button type='submit' name='action' class='btn btn-primary' value='editProduct'>Edit</button>
								</form>
							</div>
							<div class='btn-group'>
								<form action='index.php' method='post' name='removeProduct'>
									<input type='hidden' name='product_id' value='".$thisProduct->product_id."'>
									<input type='hidden' name='product_type' value='".$thisProduct->product_type."'>
									<button type='submit' name='action' class='btn btn-danger' value='removeProduct'>Remove</button>
								</form>
							</div>
						</div>
					</td>
				</tr>
			";
		}

	// Return to controller
		return $output;

		exit;
	}



	/**
	 *	return list of all clothing products
	 */
	public static function returnListOfAllClothingProducts()
	{
	// add trace
		writeTraceLog("returnListOfAllClothingProducts() starts here ------->");

	// ASSIGN the table name
		$table = "`products_table`";
		$product_type = "clothing";

	// Initiate Database connection
		$connection = Database::getConnection();

	// SELECT product data
		$query = "
		SELECT `product_id` 
		FROM ".$table."
		WHERE `product_type` = :product_type
		ORDER BY `product_id` ASC
		";
		try
		{
			$statement = $connection->prepare($query);
			$statement->bindParam(':product_type', $product_type, PDO::PARAM_STR, 12);
			$result = $statement->execute();
		} catch(PDOException $e) {
			writeTraceLog("returnListOfAllClothingProducts(): This statement returned false: ".$query);
			// function in functions.php
			handle_sql_errors($query, $e->getMessage());
		}

		$data = $statement->fetchAll(PDO::FETCH_ASSOC);

	// OUTPUT the data in table form
		// Includes Edit and Remove buttons
		$output = "";
		foreach($data as $key)
		{
			$thisProduct = new Product;
			$thisProduct->getProductByID($key['product_id']);
			
			$output .= 
			"
				<tr>
					<td>".$thisProduct->product_id."</td>
					<td>".$thisProduct->product_name."</td>
					<td>".$thisProduct->product_price."</td>
					<td>					
						<div class='btn-toolbar pull-right'>
							<div class='btn-group'>
								<form action='index.php' method='post' name='editProduct'>
									<input type='hidden' name='product_id' value='".$thisProduct->product_id."'>
									<input type='hidden' name='product_type' value='".$thisProduct->product_type."'>
									<button type='submit' name='action' class='btn btn-primary' value='editProduct'>Edit</button>
								</form>
							</div>
							<div class='btn-group'>
								<form action='index.php' method='post' name='removeProduct'>
									<input type='hidden' name='product_id' value='".$thisProduct->product_id."'>
									<input type='hidden' name='product_type' value='".$thisProduct->product_type."'>
									<button type='submit' name='action' class='btn btn-danger' value='removeProduct'>Remove</button>
								</form>
							</div>
						</div>
					</td>
				</tr>
			";
		}

	// Return to controller
		return $output;

		exit;
	}



	/**
	 *	add a new product to the database
	 */
	public static function addNewProduct()
	{
	// add trace
		writeTraceLog("addNewProduct() starts here ------->");

	// ASSIGN the table name
		$table = "`products_table`";

	// VERIFY all required variables have content
		if (
			empty($_POST['product_type']) || 
			empty($_POST['product_name']) ||
			empty($_POST['product_price'])
			) 
		{
// TURN THIS INTO A MODAL DIALOGUE
			echo "
				<div class='panel panel-danger col-sm-6 col-sm-offset-3'>
					<div class='panel-heading'>
						<h3 class='panel-title'>Incomplete Form!</h3>
					</div>
					<div class='panel-body'>One or more fields were left blank!</div>
				</div>
			";
			return;
			exit;
		}

	// ASSIGN the post variables to named variables
		$product_type = trim(strip_tags(filter_var($_POST['product_type'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)));
		$product_name = trim(strip_tags(filter_var($_POST['product_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)));
		$product_price = trim(strip_tags(filter_var($_POST['product_price'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)));

	// Initiate Database connection
		$connection = Database::getConnection();

	// SELECT product data
		$query = "
		INSERT INTO ".$table."
		(`product_type`, `product_name`, `product_price`) 
		VALUES
		(:product_type, :product_name, :product_price);
		";
		try
		{
			$statement = $connection->prepare($query);
			$statement->bindParam(':product_type', $product_type, PDO::PARAM_STR, 12);
			$statement->bindParam(':product_name', $product_name, PDO::PARAM_STR, 30);
			$statement->bindParam(':product_price', $product_price, PDO::PARAM_STR, 11);
			$result = $statement->execute();
		} catch(PDOException $e) {
			writeTraceLog("addNewProduct(): This statement returned false: ".$query);
			// function in functions.php
			handle_sql_errors($query, $e->getMessage());
		}
		
	// Return to controller
		return true;
	}



	/**
	 *	remove a product from the database
	 */
	public static function removeProduct()
	{
	// add trace
		writeTraceLog("removeProduct() starts here ------->");

	// ASSIGN the table name
		$table = "`products_table`";

	// VERIFY all required variables have content
		$product_id = $_POST['product_id'];
		$product_type = $_POST['product_type'];
		
//		echo "id = ".$product_id." and type = ".$product_type;

	// Initiate Database connection
		$connection = Database::getConnection();

	// DELETE product data
		$query = "
		DELETE FROM ".$table."
		WHERE `product_id` = :product_id
		";
		
		try
		{
			$statement = $connection->prepare($query);
			$statement->bindParam(':product_id', $product_id, PDO::PARAM_STR, 11);
			$result = $statement->execute();
		} catch(PDOException $e) {
			writeTraceLog("removeProduct(): This statement returned false: ".$query);
			// function in functions.php
			handle_sql_errors($query, $e->getMessage());
		}
	// Return to controller
		return;

		exit;
	}



	/**
	 *	edit a product in the database
	 */
	public static function updateProduct()
	{
	// add trace
		writeTraceLog("addNewProduct() starts here ------->");

	// ASSIGN the table name
		$table = "`products_table`";
	// VERIFY all required variables have content
		if (
			empty($_POST['product_id']) || 
			empty($_POST['product_name']) ||
			empty($_POST['product_price'])
			) 
		{
// TURN THIS INTO A MODAL DIALOGUE
			echo "
				<div class='panel panel-danger col-sm-6 col-sm-offset-3'>
					<div class='panel-heading'>
						<h3 class='panel-title'>Incomplete Form!</h3>
					</div>
					<div class='panel-body'>One or more fields were left blank!</div>
				</div>
			";
			return;
			exit;
		}

	// ASSIGN the post variables to named variables
		$product_id = $_POST['product_id'];
		$product_name = trim(strip_tags(filter_var($_POST['product_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)));
		$product_price = trim(strip_tags(filter_var($_POST['product_price'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)));

// VALIDATE all required variables

		
	// Initiate Database connection
		$connection = Database::getConnection();

	// SELECT product data
		$query = "
		UPDATE `products_table`
		SET `product_price` = :product_price, `product_name` = :product_name
		WHERE `product_id` = $product_id
		";
		try
		{
			$statement = $connection->prepare($query);
			// CANNOT figure out why this bindparam isn't working...
			//$statement->bindParam(':product_id', $product_id, PDO::PARAM_STR, 11);
			$statement->bindParam(':product_name', $product_name, PDO::PARAM_STR, 30);
			$statement->bindParam(':product_price', $product_price, PDO::PARAM_STR, 11);
			$result = $statement->execute();
		} catch(PDOException $e) {
			handle_sql_errors($query, $e->getMessage());
			writeTraceLog("addNewProduct(): This statement returned false: ".$query);
			// function in functions.php
			
		}
		
	// Return to controller
		return;

		exit;
	}

}
?>