<?php

class Order {
    /*variables for orders*/
    var $intOrderID, $intCustomerID, $intDelivery;
    
    /*variables for order_items*/
    var $intProductID, $doublePrices;
    
    function order() {
    }

    public function  setOrderID($setOrderID){
        $this->intOrderID = $setOrderID;
    }
    
    public function  setCustomerID($setCustomerID){
        $this->intCustomerID = $setCustomerID;
    }
    
    public function setDelivery($setDelivery){
        $this->intDelivery = $setDelivery;
    }
    
    public function setProductID($setProductID){
        $this->intProductID = $setProductID;
    }
	
    public function addCustomers() {
            $connection = new dbConn();
            $conObj = $connection->connect();
            $sql_str =  "INSERT INTO customers VALUES('','". $this->customerName ."', '". $this->customerEmail."', '". $this->customerAddress."', '".$this->customerPhone."','',current_timestamp,'')";           
            return $conObj->query($sql_str);
    }

    public function addOrders() {
            $connection = new dbConn();
            $conObj = $connection->connect();
            $sql_str =  "INSERT INTO orders VALUES('',CURRENT_TIMESTAMP,'". $this->intCustomerID."', ". $this->intDelivery.")";           
            return $conObj->query($sql_str);
    }
    
    public function addOrderItem() {
            $connection = new dbConn();
            $conObj = $connection->connect();
            $sql_str =  "INSERT INTO orders VALUES('',".$this->intOrderID.",". $this->intProductID.", ". $this->doublePrices.")";           
            return $conObj->query($sql_str);
    }
    
}
/*End of File*/