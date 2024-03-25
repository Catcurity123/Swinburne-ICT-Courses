<?php
	class Authentication {
		private $db;
		private $id;
		private $key;

		public function __construct($db) {
			$this->db = $db;
		}

		public function authSessionSetup() {
			if (isset($_SESSION['AUTH'])) {
				return $_SESSION['AUTH'];
			}
		}

		//*when SIGN UP or LOGIN successful -> set a new session* 
		private function sessionUpdate($id, $key) {
			$authSession = array();
			$authSession['ID'] = $id;
			$authSession['KEY'] = $key;
			$_SESSION['AUTH'] = $authSession; 
		}

		//AUTHENTICATE
		//Return TRUE if any account has already logged in, FALSE is not account is using
		public function isAuth() {
			if (isset($_SESSION['AUTH'])) {
				if ($_SESSION['AUTH']['ID']) {
					return true;
				}
			}
			return false;
		}


		//SIGN UP: verify that the registered email is unique
		public function verifyUniqueEmail($email) {
			$connection = $this->db->getNewConnection();
			$isUnique = true; //at first, the email is considered unique
			$table = 'friends';

			// this function works based on user input (email)
			// therefore we used Prepared Statement to prevent SQL injection
			$query = "SELECT friend_email FROM $table WHERE friend_email = ?";
			if ($stmt = $connection->prepare($query)) {
				$stmt->bind_param("s", $email);
				$stmt->execute();
				$stmt->store_result();
				// if there are any rows returned -> the entered email exists in the database already
				if ($stmt->num_rows > 0) {
					$isUnique = false;
				}
			}
			$this->db->closeConnection();
			return $isUnique;
		}


		//*SIGN UP: this function is called when the Register button is clicked*
		public function signup($email, $profile, $pass) {
			$isUnique = $this->verifyUniqueEmail($email);
			$connection = $this->db->getNewConnection();
			
			$result = null; 
			$table = 'friends';


			//STAGE 1: Clean entered data and ensure data integrity before inserting into the database
			//prevent SQL injection: add slashes before " ' symbols
			$email = stripcslashes($email);
            $email = mysqli_real_escape_string($connection, $email);

            $profile = stripcslashes($profile);
            $profile = mysqli_real_escape_string($connection, $profile);

            $pass = stripcslashes($pass);
            $pass = mysqli_real_escape_string($connection, $pass);
            $pass = htmlentities($pass);
            
	   	    
	    	//use md5 hashing algorithms to encrypt password -> 32 bits encrypted string
            $hashed = md5($pass);


            //STAGE 2: Insert new account information into the database
			if ($isUnique) {
				$date = date("Y/m/d");

				//prepared statement to prevent SQL injection
				$query = "INSERT INTO $table (friend_email, password, profile_name, date_started, num_of_friends)
                        VALUES (?,?,?,?,0);";
				if ($stmt = $connection->prepare($query)) {
					 $stmt->bind_param("ssss", $email, $hashed, $profile, $date);
					 $stmt->execute();
					 $result = true;
				}
				else {
					$result = false;
				}
			}
			
			//  return the signup status: successful or failed?
			if ($result) {
				$this->db->closeConnection();
				return true; //create new account successfully
			}
			else {
				$this->db->closeConnection();
				return false; //failed to create new account
			}
		}


		//*LOG IN: this function is called when Login button is clicked*
		public function login($email, $pass) {
			$connection = $this->db->getNewConnection();
			$table = 'friends';

			//STAGE 1: Clean entered data and ensure data integrity before inserting into the database
			//prevent SQL injection: add slashes before " ' symbols
			$email = stripcslashes($email);
            $email = mysqli_real_escape_string($connection, $email);

            $pass = stripcslashes($pass);
            $pass = mysqli_real_escape_string($connection, $pass);
            $pass = htmlentities($pass);

	    	
	    	//hash the password submitted to Login page to comapre with the hashed password in the database
	    	$hashed = md5($pass);

	    	//STAGE 2: Compare the inputs on Login page to account information stored in the database
			$query = "SELECT friend_id FROM $table WHERE friend_email = ? AND password = ?;";
			if ($stmt = $connection->prepare($query)) {
				$stmt->bind_param("ss", $email, $hashed);
				$stmt->execute();
				$result = $stmt->get_result();
				while ($row = $result->fetch_assoc()) {
				    $this->id = $row['friend_id'];
					$this->key = md5(uniqid($this->id, true));
					$this->sessionUpdate($this->id, $this->key);
				}
			}
			$this->db->closeConnection();
		}


		//LOGOUT: destroy the session of current user account 
		public function logout() {
			$this->id = null;
			$this->key = null;
			$this->sessionUpdate($this->id, $this->key);
		}
	}
?>