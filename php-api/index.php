
<?php
include_once 'config/cors.php';

$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Remove /php-api from the path if present
$path = str_replace('/php-api', '', $path);

switch($path) {
    case '/leaves':
        if($method === 'GET') {
            include 'api/leaves/read.php';
        } elseif($method === 'POST') {
            include 'api/leaves/create.php';
        }
        break;
    
    case (preg_match('/\/leaves\/(\d+)/', $path, $matches) ? true : false):
        $id = $matches[1];
        if($method === 'GET') {
            $_GET['id'] = $id;
            include 'api/leaves/read_one.php';
        } elseif($method === 'PUT') {
            $_GET['id'] = $id;
            include 'api/leaves/update.php';
        }
        break;
    
    default:
        http_response_code(404);
        echo json_encode(array("message" => "Endpoint not found"));
        break;
}
?>
