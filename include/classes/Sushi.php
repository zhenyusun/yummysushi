<?php

class Sushi {
	//const XML_PATH_INSTALL_DATE = 'global/install/date';
	const DB_SERVER = 'localhost'; // eg, localhost - should not be empty for productive servers
	const DB_SERVER_USERNAME = 'bambooso_yummysushi';
	const DB_SERVER_PASSWORD = '!234qwer';
	const DB_DATABASE = 'bambooso_yummysushi';
	const USE_PCONNECT = 'false'; // use persistent connections?
	const STORE_SESSIONS = 'mysql'; // leave empty '' for default handler or set to 'mysql'
	
	protected $_connection = null;
	
	public function getConnection() {
		return $this->_connection;
	}
	
	public function sushiConnect() {
		if($this->_connection === null) {
			$dbConnString = "mysql:host=".self::DB_SERVER."; dbname=".self::DB_DATABASE;
			$this->_connection = new PDO($dbConnString, self::DB_SERVER_USERNAME, self::DB_SERVER_PASSWORD);
		}
		return $this->_connection;
	}

}