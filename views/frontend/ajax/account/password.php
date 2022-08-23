<div class="prev_setting">
    <a href="?controller=account#" onclick="load_account();">くSetting</a>
</div>

<div class="top">
    <div class="upd_head">
        <h2>Change Password</h2>
        <span>This is the password used to log in. Set a secure password using at least 8 characters, including lowercase and uppercase letters, numbers, and special characters.</span>
    </div>
</div>

<div class="upd_pass acc_setting">
    <div class="acc_inp">
        <label for="">Current password</label>
        <input oninput="remove_error('.last_pass-error');" id="last_pass" class="form-control" type="password" placeholder="Enter current password">
        <span class="last_pass-error _error"></span>
    </div>
    <div class="acc_inp">
        <label for="">Enter new password</label>
        <input oninput="remove_error('.new_pass-error');" id="new_pass" class="form-control" type="password" placeholder="Enter new password">
        <span class="new_pass-error _error"></span>
    </div>
    <div class="acc_inp">
        <label for="">Re-enter new password</label>
        <input oninput="remove_error('.renew_pass-error');" id="renew_pass" class="form-control" type="password" placeholder="Re-enter new password">
        <span class="renew_pass-error _error"></span>
    </div>
    <div class="acc_inp">
        <button onclick="change_password_account();" class="btn btn-warning">Save change</button>
    </div>
</div>