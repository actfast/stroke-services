<?php

class Team {
    // database connection and table name
    private $conn;
    private $table_name = "team";
    
    // object properties
    public $id;
    public $name;
    public $captain;
    public $donation_total;
    public $donation_goal;
    public $location;
    public $story;
    public $created;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // read products
    function read(){
        
        // select all query
        $query = "SELECT
                t.id, t.name, concat(u.firstname,' ',u.lastname) as captain, t.donation_total, t.donation_goal, l.name as location, t.created
            FROM
                " . $this->table_name . " t
             LEFT JOIN
                    users u
                        ON t.captain = u.id
             LEFT JOIN
                    location l
                        ON t.location = l.id
            ORDER BY
                t.name ASC";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }
    
}
