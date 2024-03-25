<?php

class HitCounter {
    private $connection;
    private $tableName;

    public function __construct($host, $username, $userpassword, $dbname, $tablename) {
        $this->connection = new mysqli($host, $username, $userpassword, $dbname);
        $this->tableName = $tablename;

        if ($this->connection->connect_error) {
            die("Failed to connect to MySQL: " . $this->connection->connect_error);
        }
    }

    public function getHits() {
        $query = "SELECT hits FROM $this->tableName WHERE id = 1";
        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hits = $row["hits"];
            echo "This page has received $hits hits.";
        } else {
            echo "Hits: 0";
        }
    }

    public function setHits() {
        $query = "UPDATE $this->tableName SET hits = hits + 1 WHERE id = 1";
        $result = $this->connection->query($query);

        if (!$result) {
            echo "Error updating hits: " . $this->connection->error;
        }
    }

    public function closeConnection() {
        $this->connection->close();
    }

    public function startOver() {
        $query = "UPDATE $this->tableName SET hits = 0 WHERE id = 1";
        $result = $this->connection->query($query);
        echo "This page has received 0 hit.";
        if (!$result) {
            echo "Error starting over: " . $this->connection->error;
        }
    }
}

?>