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
        <?php if (isset($success)) : ?>
            <div style="color: #88d119; font-size: 1.1rem; text-align: center; margin-bottom: 16px; margin-top: -24px;">
                <?= $success; ?>
            </div>
        <?php endif; ?>
        <input type="submit" value="Login" name="login" class="btn btn-block py-2 btn-primary">

        <span class="text-center my-3 d-block">or</span>
        <div>
            <a href="https://accounts.google.com/o/oauth2/auth?response_type=code&redirect_uri=http%3A%2F%2Flocalhost%2FAquarium%2Fviews%2Ffrontend%2F%3Fcontroller%3Dauth&client_id=517241675191-2vu7se0n60oq6qr7qmhjp5dbjro8pa7e.apps.googleusercontent.com&scope=email+profile&access_type=online&approval_prompt=auto" class="btn btn-block py-2 btn-google"><span class="icon-google mr-3"></span> Login with Google</a>
            <a href="#" onclick="load_registration();" class="btn btn-block py-2 btn-facebook">
                <span class="icon-facebook mr-3"></span> Not a member? <b style="color: orange;">Sign up</b>
            </a>
        </div>
    </form>
</div>