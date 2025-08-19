
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../models/Employee.php';

$database = new Database();
$db = $database->getConnection();

$employee = new Employee($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->EMPLOYID) &&
    !empty($data->EMPNAME) &&
    !empty($data->USERNAME) &&
    !empty($data->PASSWRD)
){
    $employee->EMPLOYID = $data->EMPLOYID;
    $employee->EMPNAME = $data->EMPNAME;
    $employee->EMPADDRESS = $data->EMPADDRESS;
    $employee->EMPCONTACT = $data->EMPCONTACT;
    $employee->EMPPOSITION = $data->EMPPOSITION;
    $employee->EMPSEX = $data->EMPSEX;
    $employee->COMPANY = $data->COMPANY;
    $employee->DEPARTMENT = $data->DEPARTMENT;
    $employee->USERNAME = $data->USERNAME;
    $employee->PASSWRD = $data->PASSWRD;
    $employee->AVELEAVE = isset($data->AVELEAVE) ? $data->AVELEAVE : 15;

    if($employee->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Employee was created."));
    } else{
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create employee."));
    }
} else{
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create employee. Data is incomplete."));
}
?>
