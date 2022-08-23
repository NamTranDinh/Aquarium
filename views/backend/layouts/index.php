<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../common/head.php"; ?>
    <link rel="stylesheet" href="/Aquarium/public/templates/css/back/style.css">
    <script src="/Aquarium/public/templates/js/back/ajax.js"></script>
    <script src="/Aquarium/public/templates/js/back/main.js"></script>
    <base href="/Aquarium/views/backend/">
    <title>Admin</title>
</head>
<body>
<div id="warp" class="container-fluid">
    <header id="header_warp" class="row">
        <?php
            $load->view('backend.block.header');
        ?>
    </header>
    <div id="content_warp" class="row"> 
        <div id="content__left" class="col-md-2">
            <?php
                $load->view('backend.block.navbar');
            ?>
        </div>
        <div id="content__right" class="col">
            <?php
                $myApp = new App();
            ?>
        </div>             
    </div>
    <div id="footer_wrap" class="no-gutters">
        <div style="display: none;">
            <input type="hidden" value="<?=$_GET['page']??'1';?>" id="pages">
        </div>
    </div>
</div>
</body>
</html>
 
