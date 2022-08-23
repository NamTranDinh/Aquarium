<div class="prev_setting">
    <a href="?controller=account#" onclick="load_account();">くSetting</a>
</div>

<div class="top">
    <div class="upd_head">
        <h2>Change email address</h2>
        <span>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae rem commodi quidem esse similique ipsam officia sint sed laborum expedita.</span>
    </div>
</div>

<div class="last_email">
    <p style="font-size: 20px; font-weight: 600; margin-top: -20px;">Current email address</p>
    <span><?= $data['email']; ?></span>
</div>

<div class="upd_email acc_setting">
    <div class="acc_inp">
        <label for="">Enter current email address</label>
        <input oninput="remove_error('.current_email-error');" id="current_email" type="email" class="form-control" placeholder="Enter your current email">
        <span class="current_email-error _error"></span>
    </div>
    <div id="ck-token">
        <div class="acc_inp">
            <button onclick="check_email_account();" class="btn btn-warning" type="button">Continue</button>
        </div>
    </div>

</div>