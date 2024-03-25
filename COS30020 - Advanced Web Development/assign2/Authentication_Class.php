<?php
#Initialize Authentication's properties
class Authentication{
    private $Db;
    private $Id;
    private $Key;
    #Authentication constructor
    public function __construct($Database)
    {
        $this->Db = $Database;
    }
    #Check email's uniqueness
    public function CheckUnique($email){
        $DatabaseConnection = $this->Db->GetConnection();
        $UniqueFlag = true;

        $statement = $DatabaseConnection->prepare("SELECT friend_email FROM friends WHERE friend_email = ?");
        $statement->bind_param("s", $email);
        $statement->execute();
        $result = $statement->get_result();

        if($result->num_rows > 0){
            $UniqueFlag = false;
        }
        return $UniqueFlag;
    }
    #Register an account
    public function register($email, $profileName, $passwd){
        $DatabaseConnection = $this->Db->GetConnection();
        $UniqueEmail = $this->CheckUnique($email);

        if($UniqueEmail){
            $currentDate = date("y/m/d");
            $statement = $DatabaseConnection->prepare("INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends)VALUES (?,?,?,?, 0);");
            $statement->bind_param("ssss", $email, $passwd, $profileName, $currentDate);
            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
    #Log in an account
    public function Login($email, $passwd){
        
        $DatabaseConnection = $this->Db->GetConnection();
        $statement = $DatabaseConnection->prepare("SELECT friend_id FROM friends WHERE friend_email = ? AND password = ?");
        $statement->bind_param("ss", $email, $passwd);
        $statement->execute();
        $resultSet = $statement->get_result();
        
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $this->Id = $row["friend_id"];
                $this->Key = md5(uniqid($this->Id, true));
                $this->UpdateSession($this->Id, $this->Key);
            }
        }
    }
    #Log out an account
    public function Logout()
    {
        $this->Id = null;
        $this->Key = null;

        $this->UpdateSession($this->Id, $this->Key);
    }
    #update account's session
    private function UpdateSession($Id, $Key)
    {
        $authenticate_Session = array();
        $authenticate_Session["USER_ID"] = $Id;
        $authenticate_Session["KEY"] = $Key;

        $_SESSION["AUTH_SESSION"] = $authenticate_Session;
    }
    #Authenticate user's session
    public function Authenticated()
    {
        if (isset($_SESSION["AUTH_SESSION"])) {
            if ($_SESSION["AUTH_SESSION"]["USER_ID"]) {
                return true;
            }
        }
        return false;
    }
    #Get Authentication Session
    public function getAuthSession()
    {
        return $_SESSION["AUTH_SESSION"];
    }
}
