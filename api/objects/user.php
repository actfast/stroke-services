<?php
// 'user' object
class User{
    
    // database connection and table name
    private $conn;
    private $table_name = "users";
    
    // object properties
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $shirt_size;
    
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
    
    function create(){
        
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                firstname=:firstname, lastname=:lastname, email=:email, password=:password, shirt_size=:shirt_size";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
//         $this->firstname=htmlspecialchars(strip_tags($this->firstname));
//         $this->lastname=htmlspecialchars(strip_tags($this->lastname));
//         $this->email=htmlspecialchars(strip_tags($this->email));
        
        // bind values
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":shirt_size", $this->shirt_size);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        
        return false;
        
    }
}