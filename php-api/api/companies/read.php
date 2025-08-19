
<?php
include_once '../../config/database.php';
include_once '../../config/cors.php';
include_once '../../models/Company.php';

$database = new Database();
$db = $database->getConnection();

$company = new Company($db);
$stmt = $company->read();
$num = $stmt->rowCount();

if($num > 0) {
    $companies_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $company_item = array(
            "COMPANYID" => $COMPANYID,
            "COMPANYNAME" => $COMPANYNAME,
            "COMPANYADDRESS" => $COMPANYADDRESS,
            "COMPANYCONTACTNO" => $COMPANYCONTACTNO
        );
        array_push($companies_arr, $company_item);
    }

    http_response_code(200);
    echo json_encode($companies_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No companies found."));
}
?>
