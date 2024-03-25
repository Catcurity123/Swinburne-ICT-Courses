<?php
	class MyDatabase {
		private $connect;
		private $host;
		private $user;
		private $pwrd;
		private $dbnm;

		public function __construct() {
			// $host = "feenix-mariadb.swin.edu.au";
			// $user = "s103488557";
			// $pwrd = "281203";
			// $dbnm = "s103488557_db"; 

			$host = "db";
			$user = "MYSQL_USER";
			$pwrd = "MYSQL_PASSWORD";
			$dbnm = "MYSQL_DATABASE";

			//setup database
			$this->host = $host;
			$this->user = $user;
			$this->pwrd = $pwrd;
			$this->dbnm = $dbnm;

			//the database is created seperately as the $connect below is the only one without db name
			$this->connect = @mysqli_connect($this->host, $this->user, $this->pwrd);
			$query = "CREATE DATABASE IF NOT EXISTS $dbnm;";
			$result = @mysqli_query($this->connect, $query);
		}

		// CONNECTION OPERATIONS: Set - Get - Close the connection
		public function setNewConnection() {
			$this->connect = @mysqli_connect($this->host, $this->user, $this->pwrd, $this->dbnm);
		}

		public function getNewConnection() {
			$this->setNewConnection();
			return $this->connect;
		}

		public function getConnection() {
			return $this->connect;
		}

		public function closeConnection() {
			if ($this->connect) {
				if (mysqli_ping($this->connect)) {
					mysqli_close($this->connect);
				}
			}
		}

		
		//DATABASE & TABLES SETUP
		//This function is called when the first page (index.php) displays
		public function init() {
			$this->setNewConnection();

			$friends = 'friends';
			$myfriends = 'myfriends';

			//prepare hashed password before entering password for 10 initial accounts
			$passwordArray = array('oEJa5m', 'ac4aPl', '7a2dFY', '8Sxaaaa', 's5AKeN', 'gL46Ot', '8mE5a2', 'K3k2a8', 'Ma4Bw9', 'kJfo8g');
			$hashedArray = array();
			foreach ($passwordArray as $p) {
			 	$hashed = md5($p); //return 32 chars
			 	array_push($hashedArray, $hashed);
			}

			//create 2 tables: friends
			$query = " 
			CREATE TABLE IF NOT EXISTS $friends (
                friend_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                friend_email VARCHAR(50) NOT NULL,
                password VARCHAR(32) NOT NULL,
                profile_name VARCHAR(30) NOT NULL,
                date_started DATE NOT NULL,
                num_of_friends INT UNSIGNED,
                date_of_birth VARCHAR(50) NOT NULL,
                friend_address VARCHAR(50) NOT NULL,
                insurance_code VARCHAR(50) NOT NULL,
                UNIQUE (friend_email)
            )";

			$result = @mysqli_multi_query($this->connect, $query);
			if ($result) {
				return true;
			}
			
			return false;
		}
	}
?>