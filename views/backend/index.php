<?php
    require_once "../common/bootstrap.php";
    $load = new BaseController();
    if(empty($_SESSION['userId'])){
        $_REQUEST['controller'] = 'user';        
    }else $layout = 'index';
    require '../../../Aquarium/system/core/adminApp.php';
    if(!empty($layout)) require_once 'layouts/'.$layout.'.php';
    else $myApp = new App();
    
?>