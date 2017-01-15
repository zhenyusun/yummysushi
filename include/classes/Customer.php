<?php

class Customer extends Sushi {
	protected $_customerID;
	protected $_customerName;
	protected $_customerAddress;
	protected $_customerPhone;
        protected $_customerPostnumber;
        protected $_customerCity;
	protected $_customerEmail;
        protected $_newsletterEmail;
	
	public function setCustomerName($setCustomerName){
        $this->_customerName = $setCustomerName;
	}

	public function setCustomerAddress($setCustomerAddress){
        $this->_customerAddress = $setCustomerAddress;
	}
	
	public function setCustomerPhone($setCustomerPhone){
        $this->_customerPhone = $setCustomerPhone;
	}

        public function setCustomerCity($setCustimerCity){
        $this->_customerCity = $setCustimerCity;
	}

        public function setCustomerPostnumber($setCustomerPostnumber){
        $this->_customerPostnumber = $setCustomerPostnumber;
	}
        
	public function setCustomerEmail($setCustomerEmail){
        $this->_customerEmail = $setCustomerEmail;
	}
	
	public function getCustomerName(){
		$tmpCustomerName = $this->customerName;
		return $tmpCustomerName;
	}

        public function setNewsletterEmail($setNewsletterEmail){
            $this->_newsletterEmail = $setNewsletterEmail;
	}
        
	public function getCustomers(){          
	    try {
			$stmt = $this->sushiConnect()->prepare('SELECT * FROM customers');
			$stmt->execute();
			$customers = $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		return $customers;
	}

        public function getLastCustomersID(){          
            try {
                        $stmt = $this->sushiConnect()->prepare('SELECT * FROM customers ORDER BY c_id DESC LIMIT 1');
                        $stmt->execute();
                        $lastcustomersID = $stmt->fetchAll(PDO::FETCH_OBJ);
                } catch(PDOException $e) {
                        echo 'ERROR: ' . $e->getMessage();
                }
                return $lastcustomersID;
	}
        
	//insert into customers
	public function addCustomers() {
		try {
		  $stmt = $this->sushiConnect()->prepare('INSERT INTO customers (c_name, c_email, c_address, c_postnumber,c_city, c_phoneno, c_datecreated) VALUES(:name,:email,:address,:postnumber,:city,:phone, CURRENT_TIMESTAMP)');
		  $stmt->execute(array(
			':name' => $this->_customerName,
			':email' => $this->_customerEmail,
                        ':postnumber' => $this->_customerPostnumber,
                        ':city' => $this->_customerCity,
			':address' => $this->_customerAddress,
			':phone' => $this->_customerPhone
		  ));
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

        	public function addNewsletters() {
		try {
		  $stmt = $this->sushiConnect()->prepare('INSERT INTO newsletters (n_email,n_date,n_unsubscribed,n_ip) VALUES(:nemail,CURRENT_TIMESTAMP,0,"1.1.1.1" )');
		  $stmt->execute(array(
			':nemail' => $this->_newsletterEmail
		  ));
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}
}
/*End of File*/
?>