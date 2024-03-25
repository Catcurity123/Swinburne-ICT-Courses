<?php
//Database class 
class DataBase
{
    private $Host;
    private $Username;
    private $Password;
    private $Name;
    private $Connection;

    //Constructor for the calss
    public function __construct()
    {
        include "DB_Cre.php"; //Include the credential of database
        $this->Host = $host;
        $this->Username = $user;
        $this->Password = $passwd;
        $this->Name = $dbname;
    }

    //Set Connection Function 
    public function SetConnection()
    {
        try {
            // Create a new mysqli object
            $this->Connection = new mysqli($this->Host, $this->Username, $this->Password);

            // Check if the connection was successful
            if ($this->Connection->connect_error) {
                // If there was an error, throw a new exception with the error message
                throw new Exception("Connection failed: " . $this->Connection->connect_error);
            }

            // Select the database
            mysqli_select_db($this->Connection, $this->Name);
        } catch (mysqli_sql_exception $e) {
            // Handle mysqli_sql_exception
            die("<span style='color:red'>Error: " . $e->getMessage() . "</span>");
        } catch (Exception $e) {
            // Handle other exceptions
            die("<span style='color:red'>Error: " . $e->getMessage() . "</span>");
        }
    }

    public function GetConnection()
    {
        $this->SetConnection();
        return $this->Connection;
    }


    //Close Connection Function
    public function CloseConnection()
    {
        try {
            if ($this->Connection) {
                $this->Connection->close();
            }
        } catch (Exception $e) {
            // Handle the exception here
            echo "<span style='color:red'>Error closing database connection: " . $e->getMessage() . "</span>";
        }
    }

    //Initialize the Database
    public function InitDatabase()
    {
        //Connect to the database
        $this->SetConnection();
        //Create "friends" and "myfriend" tables
        $query = "CREATE TABLE IF NOT EXISTS friends (
                `friend_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `friend_email` VARCHAR(50) NOT NULL,
                `password` VARCHAR(20) NOT NULL,
                `profile_name` VARCHAR(30) NOT NULL,
                `date_started` DATE NOT NULL,
                `num_of_friends` INT UNSIGNED,
                UNIQUE (friend_email)
            );
            
            CREATE TABLE IF NOT EXISTS myfriends (
                `friend_id1` INT NOT NULL,
                `friend_id2` INT NOT NULL,
                CHECK (friend_id1 <> friend_id2),
                CONSTRAINT `FK_friend_id1`
                          FOREIGN KEY (`friend_id1`)
                          REFERENCES `friends` (`friend_id`)
                          ON DELETE CASCADE
                          ON UPDATE CASCADE,
                CONSTRAINT `FK_friend_id2`
                          FOREIGN KEY (`friend_id2`)
                          REFERENCES `friends` (`friend_id`)
                          ON DELETE CASCADE
                          ON UPDATE CASCADE
            );
        ";
        //Execute the query
        $result = mysqli_multi_query($this->Connection, $query);
        //Ensure execution
        if ($result) {
            return true;
        }
        return false;
    }

    //Populate some sample data
    public function PopulateSampleData()
    {
        // Connect to database
        $this->SetConnection();

        // Check if records already exist in `friends` table
        $sql = "SELECT COUNT(*) AS count FROM `friends` WHERE `friend_email` IN (
            'appa@gmail.com',
            'cara@gmail.com',
            'Wojin@gmail.com',
            'Gutta@gmail.com',
            'Tress@gmail.com',
            'Becca@gmail.com',
            'Das@gmail.com',
            'Tom@yahoo.com',
            'Teppo@gmail.com',
            'Chappio@gmail.com'
        )";
        $result = mysqli_query($this->Connection, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row['count'] > 0) {
            return false;
        }

        // Insert statement into "friends" table
        $query = "INSERT INTO `friends` (`friend_email`, `password`, `profile_name`, `date_started`, `num_of_friends`) VALUES
            ('appa@gmail.com', 'abcd123', 'Anna', '2018/02/01', 4),
            ('cara@gmail.com', 'abcd12345', 'Cara', '2012/01/30', 4),
            ('Wojin@gmail.com', 'abcd1234567', 'Wojin', '2018/07/23', 4),
            ('Gutta@gmail.com', 'abcd123456', 'Gutta', '2012/03/10', 4),
            ('Tress@gmail.com', 'abcdfg', 'Tress', '2011/12/22', 4),
            ('Becca@gmail.com', 'xcvefd', 'Becca', '2012/12/12', 4),
            ('Das@gmail.com', 'asdg', 'Kristyn', '2008/08/27', 4),
            ('Tom@yahoo.com', 'Tom123', 'Tom', '2019/10/08', 4),
            ('Teppo@gmail.com', 'Teppo32', 'Teppo', '2008/07/13', 4),
            ('Chappio@gmail.com', 'Chappio321', 'Chappio', '2012/04/14', 4);";

        // Execute query
        $result = mysqli_multi_query($this->Connection, $query);

        // Check for errors
        if (!$result) {
            echo "Error inserting records into `friends` table: " . mysqli_error($this->Connection) . "<br>";
            return false;
        }

        // Insert statement into "myfriends" table
        $query = "INSERT INTO `myfriends` (`friend_id1`, `friend_id2`) VALUES
            (1, 2),
            (1, 3),
            (2, 3),
            (2, 4),
            (3, 4),
            (3, 5),
            (4, 5),
            (4, 6),
            (5, 6),
            (5, 7),
            (6, 7),
            (6, 8),
            (7, 8),
            (7, 9),
            (8, 9),
            (8, 10),
            (9, 10),
            (9, 1),
            (10, 1),
            (10, 2);";

        // Execute query
        $result = mysqli_query($this->Connection, $query);

        // Check for errors
        if (!$result) {
            echo "Error inserting records into `myfriends` table: " . mysqli_error($this->Connection) . "<br>";
            return false;
        }
        return true;
    }


    //Drop table function for debugging 
    public function DropTables()
    {
        $this->SetConnection();
        // Check if the connection has been established
        if (!$this->Connection) {
            die("Connection not established");
        }

        // Define the SQL query to drop the 'myfriends' table
        $query1 = "DROP TABLE IF EXISTS myfriends";

        // Execute the SQL query to drop the 'myfriends' table
        mysqli_query($this->Connection, $query1);

        // Define the SQL query to drop the 'friends' table
        $query2 = "DROP TABLE IF EXISTS friends";

        // Execute the SQL query to drop the 'friends' table
        mysqli_query($this->Connection, $query2);

        // Check if there were any errors
        if (mysqli_error($this->Connection)) {
            die("<span style='color:red'>Error dropping tables: " . mysqli_error($this->Connection) . "</span>");
        }

        // Print a success message
        echo "<span style='color:green'>Tables dropped successfully</span>";
    }
}
