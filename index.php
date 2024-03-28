<?php

use src\controllers\BaseController;
use src\controllers\IndexController;
use src\Request;

require_once 'config.php';
require_once 'vendor/autoload.php';
require_once 'src/db/MongoDBClient.php';
require_once 'src/adapter/APIInterface.php';
require_once 'src/adapter/BaseAdapter.php';
require_once 'src/controllers/BaseController.php';
require_once 'src/controllers/IndexController.php';
require_once 'src/Request.php';
require_once 'src/Response.php';

// Get the required data from the Request
$request = new Request();
// Check the Api-Token is valid
BaseController::checkToken();
try {
    // Autoload all Adapter classes
    $files = glob('src/adapter/*.php');
    foreach ($files as $file) {
        require_once $file;
    }

    // Dynamic create a new instance of the controller
    $controller = new IndexController($request->adapter);
    // Get the product list dynamically
    $result = $controller->getProductList();
    // return the response data request format type
    $response = $request->response->responseData($result, $request->format);
    // Print the result
    print_r($response);
} catch (Exception|Error $e) {
    include 'src/views/404.php';
}
