<?php
	if (strpos($_SERVER['SERVER_NAME'], ".com") === false) 
		{
			define('DB_USER', "root");		//database user name
			define('DB_PASSWORD',"");		// db password
			define('DB_DATABASE',"car");		// database name
			define('DB_SERVER', "localhost");		// db server
		}
?>
