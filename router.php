<?php

//import the views

//Common
$homepage = 'index.html';
$errorPage = '404.html';

//Admin
$adminDashboard = 'views/admin/dashboard.php';
$staffDetails = 'views/admin/managestaffdetails.php';
$staffManage='views/admin/staffmanage.php';
$menuUpdate='views/admin/menuupdate.php';

//Customer
$dineinLogin = 'views/customer/dineinlogin.php';
$dinein = 'views/customer/dinein.php';
$dineinorder = 'views/customer/dineinorder.php';
$dineinSummery = 'views/customer/dineinsummery.php';
$onlineOrderLogin = 'views/customer/onlineorderlogin.php';
$onlineSummery = 'views/customer/onlineordersummery.php';
$onlineOrder = 'views/customer/onlineorder.php';
$onlineProfile = 'views/customer/onlinecustomerprofile.php';

//Store
$cashier = 'views/store/cashier.php';
$cashierPlaceOrder = 'views/store/cashierplaceorder.php';
$cashierCheckOrders = 'views/store/cashiercheckorders.php';
$deliveryPerson = 'views/store/deliveryperson.php';
$inventory = 'views/store/inventory.php';
$kitchendisplayOrders = 'views/store/kitchendisplayorders.php';
$kitchendisplayDineinOrders = 'views/store/kitchendisplaydineinorders.php';
$kitchendisplayInventory = 'views/store/kitchendisplayinventory.php';
$kitchenRetrieve = 'views/store/kitchenretrieve.php';
$kitchenMenuUpdate = 'views/store/kitchenMenuUpdate.php';
$steward = 'views/store/steward.php';
$staffLogin = 'views/store/stafflogin.php';
$grn='views/store/grn.php';


//API
$verify = 'api/v1/OTP.php';
$review = 'api/v1/Review.php';
$reservetable= 'api/v1/TableReservation.php';
$ongoingorders= 'api/v1/Ongoingorders.php';
$minorStaffAvailability= 'api/v1/MinorStaffAvailability.php';
$minorStaffOrder= 'api/v1/MinorStaffOrder.php';

//controllers
$dineinlogincontroller='PHP/customer/dineinlogincontroller.php';

//Get the incoming request
$request = $_SERVER['REQUEST_URI'];

//extract the params and clean the URL
if(strpos($request, "?")){
    $params = explode('?', $request)[1];
    $request = explode('?', $request)[0];
}else{
    $params = "";
}


switch ($request) {
    case '/' :
        require($homepage.$params);
        break;
    case '' :
        require($homepage);
        break;
    case '/admin' :
        require($adminDashboard);
        break;
    case '/admin/staffmanage':
        require($staffManage);
        break;
    case '/admin/menu/update':
        require($menuUpdate);
        break;
    case '/dinein/login' :
        require($dineinLogin);
        break;
    case '/dinein/order' :
        require($dineinorder);
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
    case '/online/summery' :
        require($onlineSummery);
        break;
    case '/online/profile' :
        require($onlineProfile);
        break;
    case '/online' :
        require($onlineOrder);
        break;
    case '/cashier' :
        require($cashier);
        break;
    case '/cashier/placeorder':
        require($cashierPlaceOrder);
        break;
    case '/cashier/checkorders':
        require($cashierCheckOrders);
        break;
    case '/deliveryperson' :
        require($deliveryPerson);
        break;
    case '/inventory':
        require($inventory);
        break;
    case '/kitchendisplay/orders':
        require($kitchendisplayOrders);
        break;
    case '/kitchendisplay/dinein/orders':
        require($kitchendisplayDineinOrders);
        break;
    case '/kitchendisplay/inventory':
        require($kitchendisplayInventory);
        break;
    case '/kitchen/retrieve':
        require($kitchenRetrieve);
        break;
    case '/kitchen/menu/update':
        require($kitchenMenuUpdate);
        break;
    case '/grn':
        require($grn);
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
    case '/staff/login' :
        require($staffLogin);
        break;
    case '/staff/details' :
        require($staffDetails);
    case '/api/v1/review' :
        require($review);
        break;
    case '/api/v1/reserve/table' :
        require($reservetable);
        break;
    case '/api/v1/ongoingorders' :
        require($ongoingorders);
        break;
    case '/api/v1/minorStaffAvailability' :
            require($minorStaffAvailability);
            break;
            
    case '/api/v1/minorStaffOrder' :
                require($minorStaffOrder);
                break;
    default:
        http_response_code(404);
        require($errorPage);
        break;
}
