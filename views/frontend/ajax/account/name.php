<div class="prev_setting">
    <a href="?controller=account#" onclick="load_account();">くSetting</a>
</div>

<div class="top">
    <div class="upd_head">
        <h2>Personal information</h2>
        <span>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae rem commodi quidem esse similique ipsam officia sint sed laborum expedita.</span>
    </div>
</div>

<div class="upd_name acc_setting">
    <form name="upd_name_frm" action="" method="post">


        <div class="form-group">
            <label for="">Full name</label>
            <input oninput="remove_error('.name-error');" class="form-control" id="name" type="text" value="<?= $data['cus_name'] ?? ''; ?>" placeholder="Enter name">
            <span class="name-error _error"></span>
        </div>

        <div style="display: flex; justify-content: space-between;">
            <div class="form-group" style="width: 45%;">
                <label for="">Date birth</label>
                <input oninput="remove_error('.datebirth-error');" class="form-control datepicker" id="datebirth" type="text" value="<?= $data['datebirth'] != '0000-00-00' ? date_format(date_create($data['datebirth']), 'd/m/Y') : ''; ?>" placeholder="(Vd:12/09/1999)" maxlength="10">
                <span class="datebirth-error _error"></span>
            </div>

            <div class="form-group" style="width: 45%;">
                <label class="sex" for="">Gender</label>
                <span><input id="Male" name="sex" class="gender" type="radio" value="0" <?= $data['gender'] == 0 ? 'checked' : ''; ?>><label for="Male" class="gt" style="font-size: 1.2rem;">&nbsp;&nbsp;Male</label></span>&nbsp;
                <span><input id="Female" name="sex" class="gender" type="radio" value="1" <?= $data['gender'] == 1 ? 'checked' : ''; ?>><label for="Female" class="gt" style="font-size: 1.2rem;">&nbsp;&nbsp;Female</label></span>
            </div>
        </div>

        <div class="form-group">
            <label for="">Phone</label>
            <input class="form-control" id="phone" type="text" value="<?= $data['phone'] ?? ''; ?>" placeholder="Enter phone">
        </div>

        <div class="form-group">
            <label for="">Address</label>
            <input class="form-control" id="address" type="text" value="<?= $data['address'] ?? ''; ?>" placeholder="Enter address">
        </div>

        <div class="acc_inp">
            <button onclick="change_name_account()" class="btn btn-warning" type="button">Save change</button>
        </div>
    </form>
</div>