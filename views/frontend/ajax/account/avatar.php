<div class="prev_setting">
    <a href="?controller=account#" onclick="load_account();">くSetting</a>
</div>

<div class="top">
    <div class="upd_head">
        <h2>Change avatar</h2>
        <span>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae rem commodi quidem esse similique ipsam officia sint sed laborum expedita.</span>
    </div>
</div>

<div class="upd_avatar acc_setting">
    <div class="acc_inp">
        <img class="user_avatar avatar" src="<?=$_SESSION['avatar'];?>" alt="avatar">
    </div>
    <form enctype="multipart/form-data" method="post">
        <label class="event_lab-add" style="font-size: 1.2rem; font-weight: 600;">Avatar</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="event_upl_sub_img"><i class="fas fa-upload"></i></span>
            </div>
            <div class="custom-file">
                <input oninput="remove_error('.avatar-error')" type="file" class="custom-file-input" id="avatar" aria-describedby="event_upl_sub_img" onchange="getFileName('#account-avatar')">
                <label class="custom-file-label" id="account-avatar" for="avatar">Chose image to upload.</label>
            </div>
        </div>
        <span class="avatar-error _error"></span>
    </form>
    <div class="acc_inp">
        <button onclick="change_avatar_account();" class="btn btn-warning">Upload</button>
    </div>
</div>