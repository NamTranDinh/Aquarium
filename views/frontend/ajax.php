
<?php
    require_once "../common/bootstrap.php";

    if(isset($_REQUEST['ajax'])){ 
        require "../../frontControllers/AjaxController.php";
        $ajaxObject = new AjaxController();
        $action = $_REQUEST['ajax'];
        $ajaxObject->$action();
    }
?>