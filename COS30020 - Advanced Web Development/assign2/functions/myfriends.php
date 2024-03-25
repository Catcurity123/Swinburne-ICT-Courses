<?php
	include_once 'functions/general.php';

	class MyFriend {
		private $db;

		public function __construct($db) {
			$this->db = $db;
		}


		//get all accounts, except the using account
		public function getAllAccounts($id) {
			$connect = $this->db->getNewConnection();
			$list = array();
			$table = 'friends';
			$query = "SELECT friend_id FROM $table WHERE friend_id != '$id' ORDER BY profile_name ASC;";
			$result = mysqli_query($connect, $query);
			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					array_push($list, $row['friend_id']);
				}
			}
			$this->db->closeConnection();
			return $list;	//IDs of all account, except the using account
		}


		//get all friends of the using account, based on myfriends table
		public function getFriendsOfAccount($id) {
			$connect = $this->db->getNewConnection();
			$list = array();
			$table = 'myfriends';
			$query = "SELECT friend_id2 FROM myfriends WHERE friend_id1 = '$id';";
			$result = mysqli_query($connect, $query);

			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					array_push($list, $row['friend_id2']);
				}
				$list = array_unique($list);
			}
			$this->db->closeConnection();
			return $list;	//IDs of all friends of the using account
		}


		//return the list of all mutual friends of 2 accounts
		public function findMutualFriends($id1, $id2) {
			$mutual = array();
			$account_1 = $this->getFriendsOfAccount($id1);	//all friends of using account
			$account_2 = $this->getFriendsOfAccount($id2);  //all friends of friend account
			$mutual = array_intersect($account_1, $account_2);	//find the intersect between them
			return $mutual;
		}

		//count number of elements in list of mutual friend found above
		public function countMutual($id1, $id2) {
			$count = 0;
			$count = count($this->findMutualFriends($id1, $id2));
			return $count;
		}


		//this function is called when Add Friend button is clicked
		public function addNewFriends($me, $friend) {
			$table = 'myfriends';
			$connect = $this->db->getNewConnection();

			$myid = $me->getUserAccountID();
			$friendid = $friend->getUserAccountID();
			$list = $this->getFriendsOfAccount($myid);

			// add new friend to my account
			if (!in_array($friendid, $list)) {
				//insert new friend into myfriends table
				$query = "INSERT INTO $table (friend_id1, friend_id2) VALUES (?,?);";
				if ($stmt = $connect->prepare($query)) {
					 $stmt->bind_param("ss", $myid, $friendid);
					 $stmt->execute();
					 $num = count($this->getFriendsOfAccount($myid)); //count friend num (after adding a new friend)
					if ($me->updateFriendsNum($num)) {
						return true;
					}
				}
			}
			return false;
		}


		public function deleteFriends($me, $friend) {
			$table = 'myfriends';
			$connect = $this->db->getNewConnection();

			$myid = $me->getUserAccountID();
			$friendid = $friend->getUserAccountID();
			$list = $this->getFriendsOfAccount($myid);

			// delete friend of the using account
			if (in_array($friendid, $list)) {
				$query = "DELETE FROM $table WHERE friend_id1 = '$myid' AND friend_id2 = '$friendid';";
				$result = mysqli_query($connect, $query);
				if($result) {
					$num = count($this->getFriendsOfAccount($myid));
					if ($me->updateFriendsNum($num)) {
						return true;
					}
				}
			}
			return false;
		}
	}

	// END OF MY FRIEND CLASS

	//sort the friend list A-Z
	function sortNameAtoZ($conn, $originalList) {
		$connect = $conn->getNewConnection();
		$sortedAccountList = array();
		$table = 'friends';

		$query = "SELECT friend_id FROM $table ORDER BY profile_name ASC;";
		$result = mysqli_query($connect, $query);
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$sortedAccount = $row['friend_id'];
				if (in_array($sortedAccount, $originalList)) {
					array_push($sortedAccountList, $sortedAccount);
				}
			}
		}
		$conn->closeConnection();
		return $sortedAccountList;
	}
?>