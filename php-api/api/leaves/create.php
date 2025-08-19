
<?php
include_once '../../config/database.php';
include_once '../../config/cors.php';
include_once '../../models/Leave.php';

$database = new Database();
$db = $database->getConnection();

$leave = new Leave($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->EMPLOYID) &&
   !empty($data->DATESTART) &&
   !empty($data->DATEEND) &&
   !empty($data->SHIFTTIME) &&
   !empty($data->TYPEOFLEAVE) &&
   !empty($data->REASON)) {

    $leave->EMPLOYID = $data->EMPLOYID;
    $leave->DATESTART = $data->DATESTART;
    $leave->DATEEND = $data->DATEEND;
    $leave->SHIFTTIME = $data->SHIFTTIME;
    $leave->TYPEOFLEAVE = $data->TYPEOFLEAVE;
    $leave->REASON = $data->REASON;

    if($leave->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Leave application created successfully."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create leave application."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create leave. Data is incomplete."));
}
?>
