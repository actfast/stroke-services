<?php
header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: access");
// header("Access-Control-Allow-Methods: GET");
// header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/participant.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$participant = new Participant($db);

// set ID property of product to be edited
$participant->team_id = isset($_GET['team_id']) ? $_GET['team_id'] : die();
//print tea;
// query products
$stmt = $participant->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
    
    // participants array
    $participant_arr=array();
    
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        $participant_item=array(
            "user_id" => $user_id,
            "participant_name" => html_entity_decode($participant_name),
            "story" => html_entity_decode($story),
            "donation_total" => $donation_total,
            "donation_goal" => $donation_goal
        );
        
        //        array_push($location_arr["locations"], $location_item);
        array_push($participant_arr, $participant_item);
    }
    
    echo json_encode($participant_arr);
}

else{
    echo json_encode(
        array("message" => "No team participants found.")
        );
}
?>
