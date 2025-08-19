
<?php
include_once '../../config/database.php';
include_once '../../config/cors.php';
include_once '../../models/Department.php';

$database = new Database();
$db = $database->getConnection();

$department = new Department($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->DEPARTMENT)) {
    
    $department->DEPARTMENT = $data->DEPARTMENT;
    $department->DESCRIPTION = $data->DESCRIPTION ?? '';

    if($department->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Department was created."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create department."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create department. Data is incomplete."));
}
?>
