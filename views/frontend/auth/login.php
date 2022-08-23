<div class="log-bg" style="background-image: url('/Aquarium/public/templates/upload/public/bg/login-bg.jpg');">
    <div class="d-md-flex half">
        <div class="contents" style="width: 100%;">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12">
                        <div class="form-block mx-auto auth_container">
                            <div class="login">
                                <div class="text-center mb-5">
                                    <h3 class="text-uppercase">Login to <strong>Aquarium Nexus</strong></h3>
                        			<span style="margin-top: 12px; border-bottom: 3px solid #d0d0d0; display: block;"></span>
                                </div>
                                <form action="" method="post">
                                    <div class="form-group first">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="Username" id="username" value="<?= $_COOKIE['username'] ?? ($_POST['username'] ?? ''); ?>">
                                    </div>
                                    <div class="form-group last mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password" id="password" value="<?= $_COOKIE['password'] ?? ''; ?>">
                                    </div>
                                    <div class="_error login-error" style="margin-bottom: 8px;"><?= $error ?? ''; ?></div>
                                    <div class="d-sm-flex mb-5 align-items-center">
                                        <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Remember me</span>
                                            <input type="checkbox" name="remember_ckb" <?= (!empty($_COOKIE['remember_ckb'])) ? 'checked' : ''; ?> />
                                            <div class="control__indicator"></div>
                                        </label>
                                        <span class="ml-auto"><a href="#" onclick="find_account();" class="forgot-pass">Forgot Password</a></span>
                                    </div>

                                    <input type="submit" value="Login" name="login" class="btn btn-block py-2 btn-primary">

                                    <span class="text-center my-3 d-block">or</span>
                                    <div>
                                        <a href="<?=$authUrl??'';?>" class="btn btn-block py-2 btn-google"><span class="icon-google mr-3"></span> Login with Google</a>
                                        <a href="#" onclick="load_registration();" class="btn btn-block py-2 btn-facebook">
                                            <span class="icon-facebook mr-3"></span> Not a member? <b style="color: orange;">Sign up</b>
                                        </a>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>