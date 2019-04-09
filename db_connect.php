<?php

/**
 * A class file to connect to database
 */
class DB_CONNECT {
	
	var $conn;
	// constructor
	function __construct() {
		// connecting to database
		$this->connect();
	}
	
	//destructor
	function __destruct() {
		// closing db connection
		$this->close();
	}
	
	/**
	 * Function to connect with database
	 */
	function connect() {
		// import database connection variables
		require_once dirname(__FILE__).'/db_config.php';
		// Connecting to mysql database
		$this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
		// Check connection
 		if (!$this->conn) {
			die("Connection failed: " . mysqli_connect_error());
		} 
		// returing connection cursor
		return  $this->conn ;
	}
	
	/**
	 * Function to close db connection
	 */
	function close() {
		// closing db connection
		mysqli_close($this->connect());
	}
	
	function query($query) {
		return mysqli_query($this->conn, $query); 
	}
	
	function num_rows($result) {
		return mysqli_num_rows($result);
	}
	
}


function array_saif_usmani_single($array) { 
	if (!is_array($array)) { 
		return FALSE; 
	} 
	$result = array(); 
	
	foreach ($array as $key => $value) { 
		if (is_array($value)) { 
		  $result = array_merge($result, array_saif_usmani_single($value)); 
		} 
		else { 
		  $result[$key] = $value; 
		} 
	} 
	return $result; 
} 
?>