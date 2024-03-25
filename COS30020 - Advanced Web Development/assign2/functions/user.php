<?php
	
	class User {
		private $connect;
		private $id;
		private $email;
		private $profile;
		private $createdDate;
		private $friendsNum;

		//set up a new User
		public function __construct($connect, $userId) {
			$this->connect = $connect;
			$this->id = $userId;
			$this->email = null;
			$this->profile = null;
			$this->createdDate = null;
			$this->friendsNum = null;
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


		//Increase/Decrease number of friends when DELETE or ADD button is clicked
		public function updateFriendsNum($number) {
			$table = 'friends';
			$dbConnect = $this->connect->getNewConnection();
			$subId = $this->id;
			$query = "UPDATE $table SET num_of_friends = '$number' WHERE friend_id = '$subId'";
			if ($this->getFriendsNum() >= 0) {
				$result = mysqli_query($dbConnect, $query);
				if ($result) {
					return true;
					$this->db->closeConnection();
				}
			}
			$this->connect->closeConnection();
			return false;
		}
	}
?>