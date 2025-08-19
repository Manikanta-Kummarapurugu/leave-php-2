
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

if(!empty($data->username) && !empty($data->password)){
    $employee->USERNAME = $data->username;
    $employee->PASSWRD = $data->password;

    if($employee->login()){
        http_response_code(200);
        echo json_encode(array(
            "success" => true,
            "message" => "Login successful",
            "user" => array(
                "EMPID" => $employee->EMPID,
                "EMPLOYID" => $employee->EMPLOYID,
                "EMPNAME" => $employee->EMPNAME,
                "EMPPOSITION" => $employee->EMPPOSITION,
                "COMPANY" => $employee->COMPANY,
                "DEPARTMENT" => $employee->DEPARTMENT,
                "USERNAME" => $employee->USERNAME,
                "ACCSTATUS" => $employee->ACCSTATUS
            )
        ));
    } else{
        http_response_code(401);
        echo json_encode(array(
            "success" => false,
            "message" => "Invalid username or password"
        ));
    }
} else{
    http_response_code(400);
    echo json_encode(array(
        "success" => false,
        "message" => "Username and password are required"
    ));
}
?>
