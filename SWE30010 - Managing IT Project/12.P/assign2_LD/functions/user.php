<?php
	
	class User {
		private $connect;
		private $id;
		private $email;
		private $profile;
		private $createdDate;
		private $friendsNum;
        private $date_of_birth;
        private $address;
        private $insurance_code;

		//set up a new User
		public function __construct($connect, $userId) {
			$this->connect = $connect;
			$this->id = $userId;
			$this->email = null;
			$this->profile = null;
			$this->createdDate = null;
			$this->friendsNum = null;
            $this->date_of_birth = null;
            $this->address = null;
            $this->insurance_code = null;
		}


		//this function is called to retrieve user's ID
		public function getUserAccountID() {
			$table = 'friends';
			$dbConn = $this->connect->getNewConnection();
			$subId = $this->id;
			$query = "SELECT friend_id FROM $table WHERE friend_id = '$subId'";
			$result = mysqli_query($dbConn, $query);
			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$this->id = $row['friend_id'];
				}
			}
			$this->connect->closeConnection();
			return $this->id;
		}


		//this function is called to retrieve user's Email
		public function getUserEmail() {
			$table = 'friends';
			$dbConnect = $this->connect->getNewConnection();
			$subId = $this->id;
			$query = "SELECT friend_email FROM $table WHERE friend_id = '$subId'";
			$result = mysqli_query($dbConnect, $query);
			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$this->email = $row['friend_email'];
				}
			}
			$this->connect->closeConnection();
			return $this->email;
		}


		//this function is called to retrieve user's Profile Name
		public function getUserProfile() {
			$table = 'friends';
			$dbConnect = $this->connect->getNewConnection();
			$subId = $this->id;
			$query = "SELECT profile_name FROM $table WHERE friend_id = '$subId'";
			$result = mysqli_query($dbConnect, $query);
			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$this->profile = $row['profile_name'];
				}
			}
			$this->connect->closeConnection();
			return $this->profile;
		}


		//this function is called to retrieve user's User Creation Date 
		public function getCreatedDate() {
			$table = 'friends';
			$dbConnect = $this->connect->getNewConnection();
			$subId = $this->id;
			$query = "SELECT date_started FROM $table WHERE friend_id = '$subId'";
			$result = mysqli_query($dbConnect, $query);
			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$this->createdDate = $row['date_started'];
				}
			}
			$this->connect->closeConnection();
			return $this->createdDate;
		}


		//this function is called to retrieve user's Number of Friends
		public function getFriendsNum() {
			$table = 'friends';
			$dbConnect = $this->connect->getNewConnection();
			$subId = $this->id;
			$query = "SELECT num_of_friends FROM $table WHERE friend_id = '$subId'";
			$result = mysqli_query($dbConnect, $query);
			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$this->friendsNum = $row['num_of_friends'];
				}
			}
			$this->connect->closeConnection();
			return $this->friendsNum;
		}


        //this function is called to retrieve user's Date of Birth
		public function getDateOfBirth() {
			$table = 'friends';
			$dbConnect = $this->connect->getNewConnection();
			$subId = $this->id;
			$query = "SELECT date_of_birth FROM $table WHERE friend_id = '$subId'";
			$result = mysqli_query($dbConnect, $query);
			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$this->date_of_birth = $row['date_of_birth'];
				}
			}
			$this->connect->closeConnection();
			return $this->date_of_birth;
		}


        //this function is called to retrieve user's address
		public function getUserAddress() {
			$table = 'friends';
			$dbConnect = $this->connect->getNewConnection();
			$subId = $this->id;
			$query = "SELECT friend_address FROM $table WHERE friend_id = '$subId'";
			$result = mysqli_query($dbConnect, $query);
			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$this->address = $row['friend_address'];
				}
			}
			$this->connect->closeConnection();
			return $this->address;
		}


        //this function is called to retrieve user's address
		public function getUserInsuranceCode() {
			$table = 'friends';
			$dbConnect = $this->connect->getNewConnection();
			$subId = $this->id;
			$query = "SELECT insurance_code FROM $table WHERE friend_id = '$subId'";
			$result = mysqli_query($dbConnect, $query);
			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$this->insurance_code = $row['insurance_code'];
				}
			}
			$this->connect->closeConnection();
			return $this->insurance_code;
		}




	}
?>