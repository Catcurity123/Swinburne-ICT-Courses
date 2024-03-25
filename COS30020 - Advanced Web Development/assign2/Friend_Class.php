<?php
#Initialize Friend's properties
class Friends
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    #Get friend's account
    public function GetAccount($accountId)
    {
        $DatabaseConnection = $this->db->GetConnection();
        $accountList = array();

        $statement = $DatabaseConnection->prepare("SELECT friend_id FROM friends WHERE friend_id != ? ORDER BY profile_name ASC");
        $statement->bind_param("i", $accountId);
        $statement->execute();
        $resultSet = $statement->get_result();

        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                array_push($accountList, $row["friend_id"]);
            }
        }
        return $accountList;
    }
    #Get friend's list
    public function GetFriendList($accountId)
    {
        $DatabaseConnection = $this->db->GetConnection();
        $friendList = array();

        $statement = $DatabaseConnection->prepare("SELECT friend_id2 FROM myfriends WHERE friend_id1 = ?");
        $statement->bind_param("i", $accountId);
        $statement->execute();
        $resultSet = $statement->get_result();

        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                array_push($friendList, $row["friend_id2"]);
            }
        }

        $statement = $DatabaseConnection->prepare("SELECT friend_id1 FROM myfriends WHERE friend_id1 != ? AND friend_id2 = ?");
        $statement->bind_param("ii", $accountId, $accountId);
        $statement->execute();
        $resultSet = $statement->get_result();

        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                array_push($friendList, $row["friend_id1"]);
            }
        }

        return $friendList;
    }
    #Get mutual friend
    public function getMutualFriendList($userId1, $userId2)
    {
        $mutualFriendList = array();

        $user1FriendList = $this->getFriendList($userId1);
        $user2FriendList = $this->getFriendList($userId2);

        $mutualFriendList = array_intersect($user1FriendList, $user2FriendList);

        return $mutualFriendList;
    }
    #Count mutual friend
    public function getMutualFriendCount($userId1, $userId2)
    {
        $count = 0;

        $count = count($this->getMutualFriendList($userId1, $userId2));

        return $count;
    }
    #add friend
    public function AddFriend($userAccount, $friendAccount)
    {
        $DatabaseConnection = $this->db->GetConnection();

        $userId = $userAccount->GetId();
        $friendId = $friendAccount->GetId();

        $friendList = $this->GetFriendList($userId);

        if (!in_array($friendId, $friendList)) {

            $statement = $DatabaseConnection->prepare("INSERT INTO myfriends(friend_id1, friend_id2) VALUES (?,?);");
            $statement->bind_param("ii", $userId, $friendId);
            $statement->execute();

            if ($statement->affected_rows > 0) {
                $friendCount = count($this->GetFriendList($userId));
                if ($userAccount->SetNumOfFriends($friendCount)) {
                    return true;
                }
            }
        }
        return FALSE;
    }
    #remove friend
    public function RemoveFriend($userAccount, $friendAccount)
    {
        $DatabaseConnection = $this->db->GetConnection();

        $userId = $userAccount->GetId();
        $friendId = $friendAccount->GetId();

        $friendList = $this->GetFriendList($userId);

        if (in_array($friendId, $friendList)) {
            $DeleteFlag = false;
            $statement = $DatabaseConnection->prepare("DELETE FROM myfriends WHERE friend_id1 = ? AND friend_id2 = ?;");
            $statement->bind_param("ii", $userId, $friendId);
            $statement->execute();

            if ($statement->affected_rows > 0) {
                $friendCount = count($this->GetFriendList($userId));
                if ($userAccount->SetNumOfFriends($friendCount)) {
                    $DeleteFlag = true;
                }
            }

            $statement = $DatabaseConnection->prepare("DELETE FROM myfriends WHERE friend_id2 = ? AND friend_id1 = ?;");
            $statement->bind_param("ii", $userId, $friendId);
            $statement->execute();

            if ($statement->affected_rows > 0) {
                $friendCount = count($this->GetFriendList($userId));
                if ($userAccount->SetNumOfFriends($friendCount)) {
                    $DeleteFlag = true;
                }
            }
            if ($DeleteFlag) {
                return true;
            }
        }
        return FALSE;
    }
}
