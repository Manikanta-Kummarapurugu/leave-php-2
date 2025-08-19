
<?php
include_once '../../config/database.php';
include_once '../../config/cors.php';
include_once '../../models/Company.php';

$database = new Database();
$db = $database->getConnection();

$company = new Company($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->COMPANYNAME) && !empty($data->COMPANYADDRESS)) {
    
    $company->COMPANYNAME = $data->COMPANYNAME;
    $company->COMPANYADDRESS = $data->COMPANYADDRESS;
    $company->COMPANYCONTACTNO = $data->COMPANYCONTACTNO ?? '';

    if($company->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Company was created."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create company."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create company. Data is incomplete."));
}
?>
