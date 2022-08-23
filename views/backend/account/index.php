<div class="notice box-green">
    <?=$susses??'';?> 
</div>
<div class="customer-act">
    <span><?=$title??'';?></span>
    <button class="btn btn-primary" onclick="goBack();"><i class="fas fa-chevron-circle-left"></i><span>Back</span></button>
</div>
<div class="grid account-info">
    <div class="form-horizontal account_content">
        <div class="form-group row">
            <div class="account_info-label col-md-4">
                <label for="name">Name</label>
            </div>
            <div class="col-md-8">
                <span class="account_data"><?=$data['name']??'';?></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="account_info-label col-md-4">
                <label for="name">Date created</label>
            </div>
            <div class="col-md-8">
                <span class="account_data"><?=$data['created']??'';?></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="account_info-label col-md-4">
                <label for="name">Password</label>
            </div>
            <div class="col-md-7 padd-0">
                <button class="btn btn-primary" id="btn-changepass" style="display: inline-block;" onclick="toggle_changePass()"><i class="fa fa-retweet"></i> Change Password</button>
                <div class="form-hide form-change-password" style="display: none;">
                    <div>
                        <div class="form-group">
                            <input type="text" id="oldpass" class="field_pass form-control" placeholder="Current password" value="<?=$_POST['oldpass'] ?? '';?>">
                            <span class="text-danger" id="oldpass_wrong"><?=$error??'';?></span>
                        </div>
                        <div class="form-group">                            
                            <input type="password" id="newpass" class="field_pass form-control new-password" placeholder="New password" value="<?=isset($warming)?$pass:'';?>">
                            <span class="text-danger" id="newpass_warm"><?=$warming??'';?></span>
                        </div>
                        <div class="form-group">
                            <input type="password" id="renewpass" class="field_pass form-control new-password" placeholder="Fill new password" value="<?=isset($warming)?$pass:'';?>">
                            <span class="text-danger" id="newpass_wrong"></span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" id="btn-confirm-pass" onclick="changePass()">Change password</button>
                            <button class="btn btn-default btn-sm account_cancel-pass" id="btn-cancel-pass" onclick="toggle_changePass()">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="account_info-label col-md-4">
                <label for="name">Email</label>
            </div>
            <div class="col-md-8">
                <span class="account_data"><?=$data['email']??'';?></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="account_info-label col-md-4">
                <label for="name">User group </label>
            </div>
            <div class="col-md-8">
                <span class="user_group"><i class="fa fa-male"></i> <?=$data['group_name'];?></span>
            </div>
        </div>
    </div>     
</div>
 