<?php

//import the views

//Common
$homepage = 'index.html';
$errorPage = '404.html';

//Admin
$adminLogin = 'views/admin/adminlogin.php';
$adminDashboard = 'views/admin/dashboard.php';

//Customer
$dineinLogin = 'views/customer/dineinlogin.php';
$dineinSignup = 'views/customer/dineinsignup.php';
$dinein = 'views/customer/dinein.php';
$dineinSummery = 'views/customer/dineinsummery.php';
$onlineOrderLogin = 'views/customer/onlineorderlogin.php';
$onlineOrderSignup = 'views/customer/onlineordersignup.php';
$onlineSummery = 'views/customer/onlineordersummery.php';
$onlineOrder = 'views/customer/onlineorder.php';

//Store
$cashierLogin = 'views/store/cashierlogin.php';
$cashier = 'views/store/cashier.php';
$deliveryPersonLogin = 'views/store/deliverypersonlogin.php';
$deliveryPerson = 'views/store/deliveryperson.php';
$inventory = 'views/store/inventory.php';
$kitchendisplayOrders = 'views/store/kitchendisplayOrders.php';
$kitchendisplayInventory = 'views/store/kitchendisplayInventory.php';
$kitchenManagerLogin = 'views/store/kitchenmanagerlogin.php';
$kitchenManager = 'views/store/kitchenmanager.php';
$stewardLogin = 'views/store/stewardlogin.php';
$steward = 'views/store/steward.php';

//API
$verify = 'api/v1/OTP.php';

//controllers
$dineinlogincontroller='PHP/customer/dineinlogincontroller.php';

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
        require($cashier);
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
    case '/dineinlogincontroller' :
        require($dineinlogincontroller);
        break;
    case '/api/v1/verify' :
        require($verify);
        break;
    case '/deliveryrating' :
            require($deliveryrating);
            break;
    default:
        http_response_code(404);
        require($errorPage);
        break;
}



?>