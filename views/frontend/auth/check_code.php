<div>
    <div style="margin-bottom: 16px; border-bottom: 1px solid #CCD0D5;">
        <h3>Enter the authentication code</h3>
    </div>
    <div style="border-bottom: 1px solid #CCD0D5; display: flex; align-items: center; flex-direction: column;">
        <span>Please check the code in your email. This code consists of 6 numbers.</span>
        <input oninput="remove_error('.very_code-error');" type="text" class="form-control" placeholder="Enter verification code" id="veri_code" style="margin: 12px 0;" maxlength="6">
        <span class="_error very_code-error" style="margin-bottom: 8px; display: block;"></span>
    </div>
    <div style="margin-top: 16px; display: flex; justify-content: flex-end;">
        <button class="btn btn-default" style="background-color: #E4E6EB; margin-right: 12px;" onclick="load_login();">Return</button>
        <button class="btn btn-primary" onclick='check_code()'>Continue</button>
        <input type="hidden" id="veri_email" value="<?=$email?>">
    </div>
</div>