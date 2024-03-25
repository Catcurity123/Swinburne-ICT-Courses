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

			$host = "localhost";
			$user = "root";
			$pwrd = "";
			$dbnm = "asm2";

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

			//create 2 tables: friends and myfriends
			$query = " 
			CREATE TABLE IF NOT EXISTS $friends (
                friend_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                friend_email VARCHAR(50) NOT NULL,
                password VARCHAR(32) NOT NULL,
                profile_name VARCHAR(30) NOT NULL,
                date_started DATE NOT NULL,
                num_of_friends INT UNSIGNED,
                UNIQUE (friend_email)
            );

            CREATE TABLE IF NOT EXISTS $myfriends (
                friend_id1 INT NOT NULL,
                friend_id2 INT NOT NULL,
                CHECK (friend_id1 != friend_id2) 
            );

            /* add constraints for myfriends table */
            ALTER TABLE $myfriends
                    ADD CONSTRAINT FK_friend_id1
                    FOREIGN KEY (friend_id1)
                    REFERENCES friends (friend_id)
                    ON DELETE CASCADE
                    ON UPDATE CASCADE,
                    ADD CONSTRAINT FK_friend_id2
                    FOREIGN KEY (friend_id2)
                    REFERENCES friends (friend_id)
                    ON DELETE CASCADE
                    ON UPDATE CASCADE;

            /* insert 10 initial accounts into friends table (with hashed password above)*/
            INSERT INTO $friends (friend_email, password, profile_name, date_started, num_of_friends) 
            VALUES
                ('louis222@dahn.com', '$hashedArray[0]', 'Louis Dahn', '2023/07/06', 1),
                ('SamuelERahn@rhyta.com', '$hashedArray[1]', 'Samuel E. Rahn', '2023/03/09', 2),
                ('LarryJCummins@armyspy.com', '$hashedArray[2]', 'Larry J. Cummins', '2022/12/03', 2),
                ('Carols@rhyta.com', '$hashedArray[3]', 'Carol E. Stephens', '2023/02/19', 3),
                ('ShellyNNew@rhyta.com', '$hashedArray[4]', 'Shelly N. New', '2022/06/10', 2),
                ('MarthaRHenley@dayrep.com', '$hashedArray[5]', 'Martha R. Henley', '2022/11/11', 3),
                ('GuillermoMSherron@jourrapide.com', '$hashedArray[6]', 'Guillermo M. Sherron', '2023/03/29', 2),
                ('PearlAVenegas@dayrep.com', '$hashedArray[7]', 'Pearl A. Venegas', '2022/03/01', 3),
                ('DavidJTaylor@armyspy.com', '$hashedArray[8]', 'David J. Taylor', '2023/07/14', 2),
                ('MaryMSantiago@dayrep.com', '$hashedArray[9]', 'Mary M. Santiago', '2022/04/16', 3);

            INSERT INTO $myfriends (friend_id1, friend_id2) VALUES
                (1, 2), 
                (2, 3), (2, 4),
                (3, 4), (3, 5),
                (4, 5), (4, 6), (4, 8),
                (5, 6), (5, 7),
                (6, 7), (6, 8), (6, 3),
                (7, 8), (7, 9),
                (8, 9), (8, 10), (8, 2),
                (9, 1), (9, 10),
                (10, 1), (10, 2), (10, 4);
	        ";
			
			$result = @mysqli_multi_query($this->connect, $query);
			if ($result) {
				return true;
			}
			
			return false;
		}
	}
?>