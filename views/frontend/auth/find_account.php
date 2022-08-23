<div class="fg_pass">
    <div style="margin-bottom: 16px; border-bottom: 1px solid #CCD0D5;">
        <h3>Find your account</h3>
    </div>
    <div style="border-bottom: 1px solid #CCD0D5;">
        <div>Please enter email to search your account.</div>
        <input oninput="remove_error('.identify_email-error');" type="text" class="form-control" id="identify_email" name="email" placeholder="Email address" style="margin: 16px 0 8px;">
        <span class="_error identify_email-error" style="margin-bottom: 8px; display: block;"></span>
    </div>
    <div style="margin-top: 16px; display: flex; justify-content: flex-end;">
        <button class="btn btn-default" style="background-color: #E4E6EB; margin-right: 12px;" onclick="load_login();">Return</button>
        <button class="btn btn-primary" onclick="confirm_account();">Search</button>
    </div>
</div>
 