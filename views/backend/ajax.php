
<?php
    require_once "../common/bootstrap.php";

    if(isset($_REQUEST['ajax'])){ 
        require "../../controllers/AjaxController.php";
        $ajaxObject = new AjaxController();
        $action = $_REQUEST['ajax'];
        $ajaxObject->$action();
    }
?>