<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/team.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$team = new Team($db);

// query products
$stmt = $team->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
    
    // products array
    $team_arr=array();
//    $location_arr["locations"]=array();
    
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        $team_item=array(
            "id" => $id,
            "name" => $name,
            "captain" => html_entity_decode($captain),
            "donation_total" => $donation_total,
            "donation_goal" => $donation_goal,
            "location_name" => html_entity_decode($location)
        );
        
//        array_push($location_arr["locations"], $location_item);
        array_push($team_arr, $team_item);
    }
    
    echo json_encode($team_arr);
}

else{
    echo json_encode(
        array("message" => "No teams found.")
        );
}
?>
