
<?php
include_once '../../config/database.php';
include_once '../../config/cors.php';
include_once '../../models/Leave.php';

$database = new Database();
$db = $database->getConnection();

$leave = new Leave($db);
$stmt = $leave->read();
$num = $stmt->rowCount();

if($num > 0) {
    $leaves_arr = array();
    $leaves_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $leave_item = array(
            "LEAVEID" => $LEAVEID,
            "EMPLOYID" => $EMPLOYID,
            "DATESTART" => $DATESTART,
            "DATEEND" => $DATEEND,
            "NODAYS" => $NODAYS,
            "SHIFTTIME" => $SHIFTTIME,
            "TYPEOFLEAVE" => $TYPEOFLEAVE,
            "REASON" => $REASON,
            "LEAVESTATUS" => $LEAVESTATUS,
            "ADMINREMARKS" => $ADMINREMARKS,
            "DATEPOSTED" => $DATEPOSTED
        );
        array_push($leaves_arr["records"], $leave_item);
    }

    http_response_code(200);
    echo json_encode($leaves_arr["records"]);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No leaves found."));
}
?>
