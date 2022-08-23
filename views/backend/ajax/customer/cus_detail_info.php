<div id="item-customer">
    <div class="col-md-12 row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Customer name</label>
                <div class="col-md-8"><?=$cusInfo['cus_name'];?> </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">User name</label>
                <div class="col-md-8"><?=$cusInfo['username'];?> </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Phone</label>
                <div class="col-md-8"><?=$cusInfo['phone'];?> </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Email</label>
                <div class="col-md-8"><?=$cusInfo['email'];?> </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Gender</label>
                <div class="col-md-8">
                    <input type="radio" disabled="" name="gender" <?=$cusInfo['gender']==0?'checked':''?>>Male&nbsp;
                    <input type="radio" disabled="" name="gender" <?=$cusInfo['gender']==1?'checked':''?>>Female
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Datebirth</label>
                <div class="col-md-8"><?=substr($cusInfo['datebirth'], 0, 4)!=='0000'?date_format(date_create($cusInfo['datebirth']), 'd/m/Y')??'':'-';?> </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Address</label>
                <div class="col-md-8"><?=$cusInfo['address'];?> </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Day created</label>
                <div class="col-md-8"><?=date_format(date_create($cusInfo['created']), 'H:i d/m/Y')??'';?></div>
            </div>
        </div>
    </div>
</div>

<div id="edit-item-customer" style="display: none;">
    <div class="col-md-12 row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Customer name</label>
                <div class="col-md-8">
                    <input oninput="remove_error('.error-customer_name');" type="text" id="customer_name" class="form-control" value="<?=$cusInfo['cus_name'];?>">
                    <span style="color: red;" class="error-customer_name"></span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">User name</label>
                <div class="col-md-8"><?=$cusInfo['username'];?> </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Phone</label>
                <div class="col-md-8">
                    <input oninput="remove_error('.error-customer_phone');" type="text" id="customer_phone" class="form-control" value="<?=$cusInfo['phone'];?>">
                    <span style="color: red;" class="error-customer_phone"></span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Email</label>
                <div class="col-md-8">
                    <input type="text" id="customer_email" class="form-control" value="<?=$cusInfo['email'];?>">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Gender</label>
                <div class="col-md-8">
                    <input type="radio" class="customer_gender" name="gender1" <?=$cusInfo['gender']==0?'checked':''?> value="0">Male&nbsp;
                    <input type="radio" class="customer_gender" name="gender1" <?=$cusInfo['gender']==1?'checked':''?> value="1"> Female
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Datebirth</label>
                <div class="col-md-8">
                    <input type="text" class="customer_birthday form-control" id="customer_birthday" value="<?=substr($cusInfo['datebirth'], 0, 4)!=='0000'?date_format(date_create($cusInfo['datebirth']), 'd/m/Y')??'':'';?>" placeholder="dd/mm/yyyy">
                </div>
                <script>
                    $('.customer_birthday').datepicker({
                        format: "dd/mm/yyyy"
                    });
                </script>
            </div>
        </div>
    </div>
    <div class="col-md-12 row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Address</label>
                <div class="col-md-8">
                    <textarea id="customer_addr" class="form-control" style="max-height: 120px;"><?=$cusInfo['address'];?></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 lb_cus-deltail">Day created</label>
                <div class="col-md-8"><?=date_format(date_create($cusInfo['created']), 'H:i d/m/Y')??'';?></div>
            </div>
        </div>
    </div>
</div>