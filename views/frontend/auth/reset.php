<div>
    <div style="margin-bottom: 16px; border-bottom: 1px solid #CCD0D5;">
        <h3>Password Reset</h3>
    </div>
    <div style="border-bottom: 1px solid #CCD0D5; display: flex; align-items: center; flex-direction: column;">
        <div class="form-group" style="width: 80%;">
            <label for="new-pass" style="font-weight: 600; font-size: 1.2rem;">New password</label>
            <input oninput="remove_error('.new_pass-error');" type="password" class="form-control" placeholder="Enter your new password" id="new-pass">
            <span class="_error new_pass-error" style="display: block;"></span>
        </div>
        <div class="form-group" style="width: 80%;">
            <label for="renew-pass" style="font-weight: 600; font-size: 1.2rem;">Renew password</label>
            <input oninput="remove_error('.renew_pass-error');" type="password" class="form-control" placeholder="Re-enter new password" id="renew-pass">
            <span class="_error renew_pass-error" style="display: block;"></span>
        </div>
    </div>
    <div style="margin-top: 16px; display: flex; justify-content: flex-end;">
        <button class="btn btn-default" style="background-color: #E4E6EB; margin-right: 12px;" onclick="load_login();">Return</button>
        <button class="btn btn-primary" onclick='reset_pass()'>Continue</button>
        <input type="hidden" id="veri_email" value="<?= $email ?>">
        <input type="hidden" id="veri_token" value="<?= $token ?>">
    </div>
</div>
 