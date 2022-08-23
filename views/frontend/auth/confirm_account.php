<?php if (isset($info_acc) && is_array($info_acc)) : $data = json_encode($info_acc); ?>
    <div style="margin-bottom: 16px; border-bottom: 1px solid #CCD0D5;">
    <h3>Reset your password</h3>
</div>
    <div style="border-bottom: 1px solid #CCD0D5; display: flex; align-items: center;">
        <div style="width: 60%;">
            <div>Click send to receive the code.</div>
        </div>
        <div style="width: 40%;">
            <div style="display: flex; flex-direction: column; align-items: center;">
                <img height="60px" src="<?= $info_acc['avatar'] ?? ''; ?>" alt="">
                <span><?= $info_acc['cus_name'] ?? ''; ?></span>
            </div>
        </div>
    </div>
    <div style="margin-top: 16px; display: flex; justify-content: flex-end;">
        <button class="btn btn-default" style="background-color: #E4E6EB; margin-right: 12px;" onclick="find_account();">Aren't you?</button>
        <button class="btn btn-primary" onclick='send_mail()'>Send</button>
        <input type="hidden" value='<?= $data ?>' name="" id="info_data">
    </div>
<?php else : ?>
    <div style="margin-bottom: 16px; border-bottom: 1px solid #CCD0D5;">
        <h3>Account does not exist!</h3>
    </div>
    <div style="margin-top: 16px; display: flex; justify-content: flex-end;">
        <button class="btn btn-default" style="background-color: #E4E6EB; margin-right: 12px;" onclick="find_account();">Return</button>        
    </div>
<?php endif; ?>
