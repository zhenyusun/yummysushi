<?php

class Category extends Sushi {
	
	function __construct() {
		/*Instantiate Class*/
  	}	
	
	/*
	ca_id
	ca_name
	ca_parentid
	*/
	public function getCategories() {
		try {
			$stmt = $this->sushiConnect()->prepare('SELECT * FROM category ORDER BY ca_order DESC');
			$stmt->execute();
			$categories = $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		return $categories;
	}

	public function getCountImagesForCategories() {
		try {
			$stmt = $this->sushiConnect()->prepare('SELECT COUNT(p_image) AS "totalimage",p_image,p_category,ca_name,ca_url,ca_id,ca_order FROM (select * from products p INNER JOIN category c on c.ca_id = p.p_category where p_image <> "") a group by p_category ORDER BY ca_order ASC;');
			$stmt->execute();
			$categories = $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		return $categories;
	}	
	/*
	* Returns false on failure
	* $id = category id as stored in DB
	*/
	public function getCatById($id) {
		try {
			$stmt = $this->sushiConnect()->prepare('SELECT * FROM category WHERE ca_id = :id');
			$stmt->execute(array('id' => $id));
			$category = $stmt->fetch(PDO::FETCH_OBJ);
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		return $category;
	}
	
	/*
	* Returns false on failure
	* $name = category name as stored in DB ca_url
	*/
	public function getCatByName($name) {
		try {
			$stmt = $this->sushiConnect()->prepare('SELECT * FROM category WHERE ca_url = :name');
			$stmt->execute(array('name' => $name));
			$category = $stmt->fetch(PDO::FETCH_OBJ);
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		return $category;
	}
}
/*End of File*/