<?php

class Location {
// database connection and table name
private $conn;
private $table_name = "location";

// object properties
public $id;
public $name;
public $description;
public $created;

// constructor with $db as database connection
public function __construct($db){
    $this->conn = $db;
}

// read products
function read(){
    
    // select all query
    $query = "SELECT
                p.id, p.name, p.description, p.created
            FROM
                " . $this->table_name . " p
            ORDER BY
                p.name DESC";
    
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    
    // execute query
    $stmt->execute();
    
    return $stmt;
}

function readOne(){
    
    // query to read single record
    $query = "SELECT
                p.id, p.name, p.description
            FROM
                " . $this->table_name . " p
            WHERE
                p.id = ?";
    
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
    
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
    
    // execute query
    $stmt->execute();
    
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // set values to object properties
    $this->name = $row['name'];
    $this->description = $row['description'];
}

}