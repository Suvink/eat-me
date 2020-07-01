<?php

//import the views

//Common
$homepage = 'index.html';
$errorPage = '404.html';

//Admin
$adminLogin = './routes/admin/adminlogin.php';
$adminDashboard = 'routes/admin/dashboard';

//Customer
$dinein = 'routes/customer/dineinlogin.php';

//Get the incoming request
$request = $_SERVER['REQUEST_URI'];
echo ($request);

switch ($request) {
    case '/' :
        require($homepage);
        break;
    case '' :
        require($homepage);
        break;
    case '/admin' :
        require($adminLogin);
        break;
    case '/dinein' :
        require($dinein);
        break;
    default:
        http_response_code(404);
        require($errorPage);
        break;
}



?>