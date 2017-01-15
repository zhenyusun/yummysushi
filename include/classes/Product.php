<?php

class Product extends Sushi {
	
	function __construct() {
		/*Instantiate Class*/
  	}	
	
	protected $productID;
	
	protected $productName;



	/*class properties*/
	public function setProductID($setProductID){
			$this->productID = $setProductID;
	}
	
	
	/*class functions data access layer*/     
	public function getProducts($categoryID){          
		try {
			$stmt = $this->sushiConnect()->prepare('SELECT * FROM products p INNER JOIN category c ON p_category = c.ca_id WHERE p_image != "" AND p_category = :id AND p.p_dateadded <= CASE WHEN p.p_dateadded = "0000-00-00 00:00:00" THEN "0000-00-00 00:00:00" ELSE CURRENT_TIMESTAMP END ORDER BY p.p_display ASC');
			$stmt->execute(array('id' => $categoryID));
			$products = $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		return $products;
	}
	
	public function getProductsPackByProductID(){          
		try {
			$stmt = $this->sushiConnect()->prepare('SELECT * FROM products_pack WHERE pp_pid = :productid');
			$stmt->execute(array('productid' => $this->productID));
			$productspack = $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		return $productspack;
	}        
	
		 
}
/*End of File*/