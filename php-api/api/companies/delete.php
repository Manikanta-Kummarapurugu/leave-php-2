
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/Company.php';

$database = new Database();
$db = $database->getConnection();

$company = new Company($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->COMPANYID)) {
    $company->COMPANYID = $data->COMPANYID;

    if ($company->delete()) {
        http_response_code(200);
        echo json_encode(array("message" => "Company was deleted."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete company."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to delete company. Data is incomplete."));
}
?>
