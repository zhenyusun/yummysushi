<?php

class Customer {
	var $customerID, $customerName, $customerAddress, $customerPhone, $customerEmail;
	
	public function setCustomerName($setCustomerName){
            $this->customerName = $setCustomerName;
	}

	public function setCustomerAddress($setCustomerAddress){
            $this->customerAddress = $setCustomerAddress;
	}
	
	public function setCustomerPhone($setCustomerPhone){
            $this->customerPhone = $setCustomerPhone;
	}

	public function setCustomerEmail($setCustomerEmail){
            $this->customerEmail = $setCustomerEmail;
	}
	
	public function getCustomerName(){
            $tmpCustomerName = $this->customerName;
            return $tmpCustomerName;
	}
        
	public function getCustomers(){          
	    $connection = new dbConn();
		$conObj = $connection->connect();
		$sql_str =  "SELECT * FROM customers";
		$getRows = $conObj->query($sql_str);
	return $getRows;
	}
	
	//insert into customers
	public function addCustomers() {
		$connection = new dbConn();
		$conObj = $connection->connect();
		$sql_str =  "INSERT INTO customers VALUES('','". $this->customerName ."', '". $this->customerEmail."', '". $this->customerAddress."', '".$this->customerPhone."','',current_timestamp,'')";           
		return $conObj->query($sql_str);
	}

}

/*End of File*/