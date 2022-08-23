<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../common/head.php"; ?>
    <link rel="stylesheet" href="/Aquarium/public/templates/css/back/style.css">
    <script src="/Aquarium/public/templates/js/back/ajax.js"></script>
    <script src="/Aquarium/public/templates/js/back/main.js"></script>
    <title>Login Admin</title>
</head>
<body>
    <div class="row login_overlay">
        <div class="login_container col-lg-4 col-md-6 col-sm-8" id="login-form">
            <div class="login-frame">
                <h3 class="heading col-md-12"><i class="fa fa-lock"></i><span>LOGIN</span></h3>
                <div class="col-md-12 ">
                    <form class="form-horizontal login-form frm-sm" method="post" action="">
                        <div class="form-group input-icon">
                            <label class="sr-only control-label">Username</label>
                            <input id="log_user" type="text" name="username" value="<?php echo $_POST['username'] ?? ''; ?>" class="form-control login__input" placeholder="UserName">
                            <i class="fa fa-user icon-right login_icon "></i>
                            <div class="form-validate user_validate"></div>
                        </div>
                        <div class="form-group input-icon">
                            <label class="sr-only control-label">Password</label>
                            <input id="log_pass" type="password" name="password" class="form-control login__input" placeholder="Password">
                            <i class="fa fa-lock icon-right login_icon"></i> 
                            <div class="form-validate pass_validate"></div>
                        </div>
                        <ul id="" class="text-danger col-md-12 login__error-mess">
                            <?php  echo isset($error) ? $error : '' ?>
                            <?php //var_dump($dt)?>
                        </ul>
                        <div class="form-group login_submit">
                            <input id="log_submit" type="submit" name="login" value="Login" class="btn btn-primary btn-md"/>
                        </div>
                    </form>
                </div>
            </div>    
        </div>    
    </div>
</body>
</html>
 