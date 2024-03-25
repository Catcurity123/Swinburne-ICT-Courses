<?php
#Initialize Account's properties
class Account{
    private $db;
    private $id;
    private $email;
    private $profileName;
    private $dateStarted;
    private $numOfFriends;
    #Account constructor
    public function __construct($db, $userId)
    {
        $this->db = $db;
        $this->id = $userId;
        $this->email = null;
        $this->profileName = null;
        $this->dateStarted = null;
        $this->numOfFriends = null;
    }
    #Get user's email
    public function GetEmail(){
        $DatabaseConnection = $this->db->GetConnection();
        $_id = $this->id;
        $statement = $DatabaseConnection->prepare("SELECT friend_email FROM friends WHERE friend_id = ?");
        $statement->bind_param("i", $_id);
        $statement->execute();
        $resultSet = $statement->get_result();

        if($resultSet){
            while($row = $resultSet->fetch_assoc()){
                $this->email = $row["friend_email"];
            }
        }

        return $this->email;
    }
    #Get user's ID
    public function GetId(){
        $DatabaseConnection = $this->db->GetConnection();
        $_id = $this->id;
        $statement = $DatabaseConnection->prepare("SELECT friend_id FROM friends WHERE friend_id = ?");
        $statement->bind_param("i", $_id);
        $statement->execute();
        $resultSet = $statement->get_result();

        if($resultSet){
            while($row = $resultSet->fetch_assoc()){
                $this->id = (int)$row["friend_id"];
            }
        }

        return $this->id;
    }
    #Get User's profile name
    public function GetProfileName(){
        $DatabaseConnection = $this->db->GetConnection();
        $_id = $this->id;
        $statement = $DatabaseConnection->prepare("SELECT profile_name FROM friends WHERE friend_id = ?");
        $statement->bind_param("i", $_id);
        $statement->execute();
        $resultSet = $statement->get_result();

        if($resultSet){
            while($row = $resultSet->fetch_assoc()){
                $this->profileName = $row["profile_name"];
            }
        }

        return $this->profileName;
    }
    #Get user's started date
    public function GetDateStarted(){
        $DatabaseConnection = $this->db->GetConnection();
        $_id = $this->id;
        $statement = $DatabaseConnection->prepare("SELECT date_started FROM friends WHERE friend_id = ?");
        $statement->bind_param("i", $_id);
        $statement->execute();
        $resultSet = $statement->get_result();

        if($resultSet){
            while($row = $resultSet->fetch_assoc()){
                $this->dateStarted = $row["date_started"];
            }
        }

        return $this->dateStarted;
    }
    #Get num of friend of the user
    public function GetNumOfFriend(){
        $DatabaseConnection = $this->db->GetConnection();
        $_id = $this->id;
        $statement = $DatabaseConnection->prepare("SELECT num_of_friends FROM friends WHERE friend_id = ?");
        $statement->bind_param("i", $_id);
        $statement->execute();
        $resultSet = $statement->get_result();

        if($resultSet){
            while($row = $resultSet->fetch_assoc()){
                $this->numOfFriends = $row["num_of_friends"];
            }
        }

        return $this->numOfFriends;
    }
    #set num of friend of the user
    public function SetNumOfFriends($number){
        $DatabaseConnection = $this->db->GetConnection();
        $_id = $this->id;
        $statement = $DatabaseConnection->prepare("UPDATE friends SET num_of_friends = ? WHERE friend_ID = ?");
        $statement->bind_param("ii", $number, $_id);
        $statement->execute();
        $resultSet = $statement->get_result();

        if($resultSet){
            return true;
        }

        return False;
    }
    #Count all friends except mutal
    public function CountAllFriendsExcludingMutual()
    {
        $DatabaseConnection = $this->db->GetConnection();
        $_id = $this->id;
        $statement = $DatabaseConnection->prepare("
            SELECT COUNT(friend_id) AS total_friends
            FROM friends
            LEFT JOIN myfriends ON friends.friend_id = myfriends.friend_id1 OR friends.friend_id = myfriends.friend_id2
            WHERE (myfriends.friend_id1 IS NULL AND myfriends.friend_id2 IS NULL)
               OR (myfriends.friend_id1 <> ? AND myfriends.friend_id2 <> ?)
        ");
        $statement->bind_param("ii", $_id, $_id);
        $statement->execute();
        $resultSet = $statement->get_result();
    
        if ($resultSet && $row = $resultSet->fetch_assoc()) {
            return $row['total_friends'];
        }
    
        return 0;
    }



}
