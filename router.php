<?php

//import the views

//Common
$homepage = 'index.html';
$errorPage = '404.html';

//Admin
$adminLogin = 'routes/admin/adminlogin.php';
$adminDashboard = 'routes/admin/dashboard.php';

//Customer
$dineinLogin = 'routes/customer/dineinlogin.php';
$dineinSignup = 'routes/customer/dineinsignup.php';
$dinein = 'routes/customer/dinein.php';
$dineinSummery = 'routes/customer/dineinsummery.php';
$onlineOrderLogin = 'routes/customer/onlineorderlogin.php';
$onlineOrderSignup = 'routes/customer/onlineordersignup.php';
$onlineSummery = 'routes/customer/onlineordersummery.php';
$onlineOrder = 'routes/customer/onlineorder.php';

//Store
$cashierLogin = 'routes/store/cashierlogin.php';
$cashier = 'routes/store/cashier.php';
$deliveryPersonLogin = 'routes/store/deliverypersonlogin.php';
$deliveryPerson = 'routes/store/deliveryperson.php';
$inventory = 'routes/store/inventory.php';
$kitchendisplayOrders = 'routes/store/kitchendisplayOrders.php';
$kitchendisplayInventory = 'routes/store/kitchendisplayInventory.php';
$kitchenManagerLogin = 'routes/store/kitchenmanagerlogin.php';
$kitchenManager = 'routes/store/kitchenmanager.php';
$stewardLogin = 'routes/store/stewardlogin.php';
$steward = 'routes/store/steward.php';

//API
$verify = 'routes/api/v1/OTP.php';


//Get the incoming request
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        require($homepage);
        break;
    case '' :
        require($homepage);
        break;
    case '/admin/login' :
        require($adminLogin);
        break;
    case '/admin' :
        require($adminDashboard);
        break;
    case '/dinein/login' :
        require($dineinLogin);
        break;
    case '/dinein/signup' :
        require($dineinSignup);
        break;
    case '/dinein/summery' :
        require($dineinSummery);
        break;
    case '/dinein' :
        require($dinein);
        break;
    case '/online/login' :
        require($onlineOrderLogin);
        break;
    case '/online/signup' :
        require($onlineOrderSignup);
        break;
    case '/online/summery' :
        require($onlineSummery);
        break;
    case '/online' :
        require($onlineOrder);
        break;
    case '/cashier/login' :
        require($onlineOrderSignup);
        break;
    case '/cashier' :
        require($onlineOrder);
        break;
    case '/deliveryperson/login' :
        require($deliveryPersonLogin);
        break;
    case '/deliveryperson' :
        require($deliveryPerson);
        break;
    case '/inventory' :
        require($inventory);
        break;
    case '/kitchendisplayOrders' :
        require($kitchendisplayOrders);
        break;
    case '/kitchendisplayInventory' :
        require($kitchendisplayInventory);
        break;
    case '/kitchenmanager/login' :
        require($kitchenManagerLogin);
        break;
    case '/kitchenmanager' :
        require($kitchenManager);
        break;
    case '/steward/login' :
        require($stewardLogin);
        break;
    case '/steward' :
        require($steward);
        break;
    case '/api/v1/verify' :
        require($verify);
        break;
    default:
        http_response_code(404);
        require($errorPage);
        break;
}



?>