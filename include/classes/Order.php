<?php

class Order extends Sushi {
    function __construct() {
		/*Instantiate Class*/
  	}	
    
    /*variables for orders*/
    protected $_intOrderID;
    protected $_intCustomerID;
    protected $_intDelivery;
    protected $_intNoOfPeople;
    protected $_strComment;
    protected $_strDatetime;
    
    /*variables for order_items*/
    Protected $_intProductID, $_doublePrices, $_strProductName, $_intQuantity;
    
    function order() {
    }

    public function  setOrderID($setOrderID){
        $this->_intOrderID = $setOrderID;
    }
    
    public function  setCustomerID($setCustomerID){
        $this->_intCustomerID = $setCustomerID;
    }
    
    public function setDelivery($setDelivery){
        $this->_intDelivery = $setDelivery;
    }
    
    public function setProductID($setProductID){
        $this->_intProductID = $setProductID;
    }
    
    public function setNoOfPeople($setNoOfPeople){
        $this->_intNoOfPeople = $setNoOfPeople;
    }
    
    public function setComment($setComment) {
        $this->_strComment = $setComment;    
    }
    
    public function setDatetime($setDatetime) {
        $this->_strDatetime = $setDatetime;    
    }
    
    public function setPrices($setPrices) {
        $this->_doublePrices = $setPrices;
    }
    
    public function setProductName($setProductName){
        $this->_strProductName = $setProductName;
    }
    
    public function setProductQuantity($setProductQuantity){
        $this->_intQuantity = $setProductQuantity;
    }
	/*
	move to Customer.php
    public function addCustomers() {
            $connection = new dbConn();
            $conObj = $connection->connect();
            $sql_str =  "INSERT INTO customers VALUES('','". $this->customerName ."', '". $this->customerEmail."', '". $this->customerAddress."', '".$this->customerPhone."','',current_timestamp,'')";           
            return $conObj->query($sql_str);
    }
	*/
    public function addOrders() {
            /*YO FRANK*/
            /*
            I don't know that the fields are, so just change them in PREPARE and EXECUTE
            This should work, but I haven't tested
            
            just paste this down into addOrder and change details
            */
            try {
              $stmt = $this->sushiConnect()->prepare('INSERT INTO orders (o_datecreated,o_customerid,o_people,o_ordertime,o_delivery,o_comment) VALUES(CURRENT_TIMESTAMP,:customerid,:people,:ordertime,:delivery,:comment)');
              $stmt->execute(array(
                    ':customerid' => $this->_intCustomerID,
                    ':people' => $this->_intNoOfPeople,
                    ':ordertime' => $this->_strDatetime,
                    ':delivery' => $this->_intDelivery,
                    ':comment' => $this->_strComment
              ));
            } catch(PDOException $e) {
              echo 'Error: ' . $e->getMessage();
            }
    }

    
    public function getLastOrderID(){          
        try {
                    $stmt = $this->sushiConnect()->prepare('SELECT * FROM orders ORDER BY o_id DESC LIMIT 1');
                    $stmt->execute();
                    $lastOrderID = $stmt->fetchAll(PDO::FETCH_OBJ);
            } catch(PDOException $e) {
                    echo 'ERROR: ' . $e->getMessage();
            }
            return $lastOrderID;
    }
    
    public function getCustomersByOrderID(){
        try {
                    $stmt = $this->sushiConnect()->prepare('SELECT * FROM customers INNER JOIN orders ON c_id = o_customerid WHERE o_id = :o_id');
                    $stmt->execute(array(
                    ':o_id' => $this->_intOrderID));
                    $customersByOrderID = $stmt->fetchAll(PDO::FETCH_OBJ);
            } catch(PDOException $e) {
                    echo 'ERROR: ' . $e->getMessage();
            }
            return $customersByOrderID;
    }

        
    public function getOrderItemsByOrderID(){
        try {
                    $stmt = $this->sushiConnect()->prepare('SELECT * FROM orders INNER JOIN order_item ON o_id = oi_oid WHERE o_id = :o_id');
                    $stmt->execute(array(
                    ':o_id' => $this->_intOrderID));
                    $orderItemsByOrderID = $stmt->fetchAll(PDO::FETCH_OBJ);
            } catch(PDOException $e) {
                    echo 'ERROR: ' . $e->getMessage();
            }
            return $orderItemsByOrderID;
    }
    
    public function addOrderItem(){
            try {
              $stmt = $this->sushiConnect()->prepare('INSERT INTO order_item (oi_oid, oi_pid, oi_price, oi_pname, oi_quantity) VALUES(:oi_oid,:oi_pid,:oi_price,:oi_pname,:oi_quantity)');
              $stmt->execute(array(
                    ':oi_oid' => $this->_intOrderID,
                    ':oi_pid' => $this->_intProductID,
                    ':oi_price' => $this->_doublePrices,
                    ':oi_pname' => $this->_strProductName,
                    ':oi_quantity' => $this->_intQuantity
              ));
            } catch(PDOException $e) {
              echo 'Error: ' . $e->getMessage();
            }        
        
    }
    /*
    public function addOrderItem() {
            $connection = new dbConn();
            $conObj = $connection->connect();
            $sql_str =  "INSERT INTO orders VALUES('',".$this->intOrderID.",". $this->intProductID.", ". $this->doublePrices.")";           
            return $conObj->query($sql_str);
    }
    */

    
}
/*End of File*/