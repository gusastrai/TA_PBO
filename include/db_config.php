<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'rumah_sakit');

class DB_con {
	private $connection;
	function __construct(){
		$this->connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);
		
		if ($this->connection->connect_error) die('Database error -> ' . $this->connection->connect_error);
		
	}

	function get_con() {
		return $this->connection;
	}

}