<?php

class Participant {
    // database connection and table name
    private $conn;
    private $table_name = "participant";
    
    // object properties
    public $team_id;
    public $user_id;
   // public $participant_name;
    public $story;
    public $donation_total;
    public $donation_goal;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // read products
    function read(){
        // select all query
        $query = "SELECT
               t.user_id, t.story, t.donation_total, t.donation_goal, concat(u.firstname,' ',u.lastname) as participant_name
            FROM
                " . $this->table_name . " t
            LEFT JOIN
                    users u
                        ON t.user_id = u.id
            WHERE
                    t.team_id = ?";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // bind id of team to be read
        $stmt->bindParam(1, $this->team_id);
        
        // execute query
        $stmt->execute();
        
        return $stmt;
        // get retrieved row
//         $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
//         // set values to object properties
//         $this->user_id = $row['user_id'];
//    //     $this->participant_name = $row['participant_name'];
//         $this->story = $row['story'];
//         $this->donation_goal = $row['donation_goal'];
//         $this->donation_total = $row['donation_total'];
    }
    
}
