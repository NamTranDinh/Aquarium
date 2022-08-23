<?php
    require_once "../common/bootstrap.php";
    $load = new BaseController();
    require_once '../../../Aquarium/system/core/publicApp.php';
    
    if(isset($_REQUEST['controller'])){
        $con = $_REQUEST['controller'];
        if($con=='auth') $layout = 'login';
        else $layout = 'index';
    } else $layout = 'index';
    
    if(!empty($layout)) require_once 'layouts/'.$layout.'.php';
    
?>


