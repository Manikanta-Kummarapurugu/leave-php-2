
<?php
include_once '../../config/database.php';
include_once '../../config/cors.php';
include_once '../../models/Department.php';

$database = new Database();
$db = $database->getConnection();

$department = new Department($db);
$stmt = $department->read();
$num = $stmt->rowCount();

if($num > 0) {
    $departments_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $department_item = array(
            "DEPTID" => $DEPTID,
            "DEPARTMENT" => $DEPARTMENT,
            "DESCRIPTION" => $DESCRIPTION
        );
        array_push($departments_arr, $department_item);
    }

    http_response_code(200);
    echo json_encode($departments_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No departments found."));
}
?>
