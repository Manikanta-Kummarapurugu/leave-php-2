
<?php
include_once '../../config/database.php';
include_once '../../config/cors.php';
include_once '../../models/LeaveType.php';

$database = new Database();
$db = $database->getConnection();

$leaveType = new LeaveType($db);
$stmt = $leaveType->read();
$num = $stmt->rowCount();

if($num > 0) {
    $leave_types_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $leave_type_item = array(
            "LEAVTID" => $LEAVTID,
            "LEAVETYPE" => $LEAVETYPE,
            "DESCRIPTION" => $DESCRIPTION
        );
        array_push($leave_types_arr, $leave_type_item);
    }

    http_response_code(200);
    echo json_encode($leave_types_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No leave types found."));
}
?>
