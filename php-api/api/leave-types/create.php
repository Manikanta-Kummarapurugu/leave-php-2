
<?php
include_once '../../config/database.php';
include_once '../../config/cors.php';
include_once '../../models/LeaveType.php';

$database = new Database();
$db = $database->getConnection();

$leaveType = new LeaveType($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->LEAVETYPE)) {
    
    $leaveType->LEAVETYPE = $data->LEAVETYPE;
    $leaveType->DESCRIPTION = $data->DESCRIPTION ?? '';

    if($leaveType->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Leave type was created."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create leave type."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create leave type. Data is incomplete."));
}
?>
