<?php
#Sort account function
    function SortAccount($db, $accountIdList){
        $DatabaseConnection = $db->GetConnection();
        $list = array();
        $statement = $DatabaseConnection->prepare("SELECT friend_id FROM friends ORDER BY profile_name ASC");
        $statement->execute();
        $resultSet = $statement->get_result();

        if($resultSet){
            while($row = $resultSet->fetch_assoc()){
                $id = $row["friend_id"];
                if(in_array($id, $accountIdList)){
                    array_push($list, $id);
                }
            }
        }
        $db->CloseConnection();
        return $list;
    }
?>