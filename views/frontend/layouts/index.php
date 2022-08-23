<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../common/head.php"; ?>
    <link rel="stylesheet" href="/Aquarium/public/templates/css/front/style.css">
    <script src="/Aquarium/public/templates/js/front/ajax.js"></script>
    <script src="/Aquarium/public/templates/js/front/main.js"></script>
    <base href="/Aquarium/views/frontend/">
    <title>Aquarium - Nexus</title>
</head>
<html>

<body>
    <div id="main-body">

        <?php $load->view('frontend.block.header');?>

        <aside id="main_container" style="min-height: 100vh;">
        
            <?php $load->view('frontend.block.header_nav');?>
            
            <div class="main_content container" style="max-width: 1240px; padding: 0 16px;">
                <?php $myApp = new App(); ?>
            </div>
            <div><?php $load->view('frontend.block.animate'); ?></div>
        </aside>

        <?php $load->view('frontend.block.footer');?>
        
    </div>
</body>
</html>

 