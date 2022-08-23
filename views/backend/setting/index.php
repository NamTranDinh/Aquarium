<?php
    if(empty($_REQUEST['pg'])) $_REQUEST['pg']='staff';
?>
<div class="customer-act">
    <span>Setting</span>   
</div>
<div class="notice" id="setting_notice">
    <?=$messes['title']??'';?>
</div>
<div class="overlay" id="setting_overlay" style="display: none;"></div>

<ul class="nav nav-tabs setting_tab">
    <li><button onclick="show_staff();" class="btn btn-default st_btn-goStaff <?php echo $_REQUEST['pg']!='staffGr'?'setting__active':'';?>"><i class="fa fa-user"></i> <span>Staff</span></button></li>
    <li><button onclick="show_staff_group();" class="btn btn-default st_btn-goStaffGr <?php echo $_REQUEST['pg']=='staffGr'?'setting__active':'';?>"><i class="fa fa-cog"></i> <span>Staff group</span></button></li>    
</ul>
<div id="setting_panel" <?php echo $_REQUEST['pg']=='staffGr'? 'style="display: none;"':'style="display: block;"';?> >
    <div class="panel panel-primary setting_panel" id="setting_panel-staff">
        <div class="panel-heading setting_panel-head">
            <span><i class="fa fa-user"></i> <span>Staff</span></span>
            <span><button id="btn-add_staff" class="btn btn-success btn-sm "><i class="fas fa-pencil-alt"></i> <span>Add new staff</span></button></span>
        </div>
        <div class="panel-body setting_panel-body" id="staff_load">
            <div class="table-responsive">
                <table class="table table-hover table-user table-striped setting_table">
                    <thead class="setting_thead">
                        <tr>
                            <th class="text-center">STT</th>
                            <th>User name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User group</th>
                            <th class="text-center">Status</th>
                            <th style="width: 10%;"></th>
                        </tr>
                    </thead>
    
                    <tbody class="setting_tbody" id="setting_tbody">
                        <?php 
                            $i=0;
                            foreach($data as $val):
                            $i++;
                            $stt = $i+(($pagination->page-1)*$pagination->limit);
                        ?>
                        <tr class="tr-item-<?=$stt??'';?>" style="display: table-row;">
                            <td class="text-center"><?=$stt?></td>
                            <td><?=$val['username']??'';?></td>
                            <td><?=$val['name']??'';?></td>
                            <td><?=$val['email']??'';?></td>
                            <td><span class="user_group"><i class="fa fa-male"></i> <?=$val['group_name']??'';?></span></td>
                            <td class="text-center"><span class="user_status"><i class="fa fa-<?=$val['status']==0 ? 'lock': 'unlock';?>"></i> <span><?=$val['status']==0 ? 'Locked': 'Active';?></span></span></td>
                            <td class="text-center st_btn" style="padding: 0;">
                                <button onclick="show_edit_item(<?=$stt?>)" class="btn btn-default"><i class="fas fa-edit edit-item" title="Edit"></i></button>
                                <button onclick="deleteStaff(<?=$val['id'];?>, '<?=$val['name']??'';?>')" class="btn btn-default" ><i title="Delete" class="far fa-trash-alt delete-item"></i></button>
                            </td>
                        </tr>
    
                        <tr class="edit-tr-item-<?=$stt??'';?>" style="display: none;">
                            <td class="text-center"><?=$stt??'';?></td>
                            <td><input type="text" class="form-control" value="<?=$val['username']??'';?>" disabled="" style="cursor: not-allowed;"></td>
                            <td><input type="text" class="form-control" id="user_inp-name-<?=$stt??'';?>" value="<?=$val['name']??'';?>"></td>
                            <td><input type="text" class="form-control" id="user_inp-email-<?=$stt??'';?>" value="<?=$val['email']??'';?>"></td>
                            <td>
                                <div class="group-user">
                                    <div class="group-selbox">
                                        <select name="group" id="user_inp-group_id-<?=$stt??'';?>" class="form-control">
                                        <?php foreach($groupData as $grVal):?>
                                            <option value="<?=$grVal['id']??'';?>" <?=$grVal['id']==$val['group_id']?'selected':'';?>><?=$grVal['group_name']??'';?></option>
                                        <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <select class="form-control" id="user_inp-status-<?=$stt??'';?>">
                                    <option value="1" selected="selected">Active</option>
                                    <option value="0">Locked</option>
                                </select>                                
                            </td>
                            <td class="text-center st_btn" style="padding: 0;">
                                <button onclick="updateStaff(<?=$val['id']?>, <?=$stt?>)" class="btn btn-default"><i class="fas fa-save" title="Save" style="color: #EC971F;"></i></button>
                                <button onclick="hide_edit_item(<?=$stt?>)" class="btn btn-default"><i class="fa fa-undo" title="Return" style="color: green;"></i></button>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <?php if($pagination->total_page>1):?>
                <div style="margin-bottom: 1rem;">
                    <?php $pagination->getPage('ajax', 'setting_page-user');?>
                </div>
                <?php endif;?>
            </div>
            <input type="hidden" name="" id="setting_page-user" value="<?=$pagination->page??1;?>">
        </div>        
    </div>
    
    <div class="modal-content setting_add_account">
        <div class="modal-header st_addAccount-head">
            <h4 class="modal-title" style="text-transform: uppercase;"><i class="fa fa-user"></i><span>Add account login</span></h4>
            <button type="button" class="close btn_close-addUser"><span>×</span></button>
        </div>
        <div class="modal-body st_addAccount-body grid">
            <form class="form-horizontal st_addAccount-frm">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Staff Name</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.error-staffName')" id="inp_add-staffName" type="text" class="form-control setting_inp-add" value="" placeholder="Enter staff name (display name)">
                        <span class="error-staffName _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>User name</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.error-userName')" id="inp_add-userName" type="text" class="form-control setting_inp-add" value="" placeholder="Enter user name">
                        <span class="error-userName _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Email</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.error-email')" id="inp_add-email" type="text" class="form-control setting_inp-add" value="" placeholder="Enter email">
                        <span class="error-email _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Password</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.error-password')" id="inp_add-password" type="password" class="form-control setting_inp-add" value="" placeholder="Enter password">
                        <span class="error-password _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Staff group</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="group-user">                        
                            <select id="inp_add-groupName" class="form-control">
                                <?php foreach($groupData as $val):?>
                                <option value="<?=$val['id']??'';?>" <?=($val['group_name']=='Staff') ? 'selected': '';?>><?=$val['group_name']??'';?></option>
                                <?php endforeach;?>
                            </select>                         
                        </div>
                    </div>
                </div>            
            </form>
        </div>
        <div class="modal-footer st_addAccount-footer">
            <button type="button" class="btn btn-primary btn-md btn_save-addUser" onclick="creStaff();"><i class="fa fa-check"></i> <span>Save</span></button>
            <button type="button" class="btn btn-success btn-md btn_close-addUser"><i class="fa fa-undo"></i> <span>Return</span></button>
        </div>        
    </div>
</div>

<div id="setting_panel-gr" <?php echo $_REQUEST['pg']=='staffGr'? 'style="display: block;"':'style="display: none;"';?>>
    <div class="panel panel-danger setting_panel" id="setting_panel-staffGr" >
        <div class="panel-heading setting_panel-head">
            <span><i class="fa fa-users"></i> <span>Group staff</span></span>        
            <span><button id="btn_open-addGr" class="btn btn-success btn-sm "><i class="fas fa-pencil-alt"></i> <span>Add new group staff</span></button></span>
        </div>
        <div class="panel-body setting_panel-body" id="group_staff_load">
            <div class="table-responsive ">
                <table class="table table-hover table-user table-striped setting_table">
                    <thead class="setting_thead">
                        <tr>
                            <th class="text-center ind">STT</th>
                            <th>Group name</th>
                            <th>Group permission</th>
                            <th>Date created</th>
                            <th class="text-center">Account number</th>
                            <th style="width: 10%;"></th>
                        </tr>
                    </thead>
                    <tbody class="setting_tbody" id="setting_tbody-staff">
                        <?php 
                            $j=0;
                            foreach($data_gr as $val):
                            $j++;
                            $stt = $j+(($pagination_gr->page-1)*$pagination_gr->limit);
                        ?>
                        <tr class="tr-gs-<?=$stt??'';?>" style="display: table-row;">
                            <td class="text-center"><?=$stt?></td>
                            <td><?=$val['group_name']??'';?></td>
                            <td><?=$val['group_permission']??'';?></td>
                            <td><?=$val['created']??'';?></td>
                            <td class="text-center"><?=$val['count']??'';?></td>
                            <td class="text-center st_btn">
                                <button onclick="show_edit_item_group(<?=$stt?>)" class="btn btn-default"><i class="fas fa-edit edit-item" title="Edit"></i></button>
                                <button onclick="deleteGroupStaff(<?=$val['id']?>, '<?=$val['group_name'];?>')" class="btn btn-default"><i title="Delete" class="far fa-trash-alt delete-item"></i></button>
                            </td>
                        </tr>

                        <tr class="edit-tr-gs-<?=$stt??'';?>" style="display: none;">
                            <td class="text-center"><?=$stt??'';?></td>
                            <td><input type="text" class="form-control" value="<?=$val['group_name']??'';?>" id="group_inp-name-<?=$stt??'';?>"></td>
                            <td><input type="text" class="form-control" value="<?=$val['group_permission']??'';?>" id="group_inp-permission-<?=$stt??'';?>"></td>
                            <td><input type="text" class="form-control" value="<?=$val['created']??'';?>" disabled="" style="cursor: not-allowed;"></td>
                            <td class="text-center"><input type="text" class="form-control" value="<?=$val['count']??'';?>" disabled="" style="cursor: not-allowed;"></td>
                            <td class="text-center st_btn">
                                <button onclick="updateGroupStaff(<?=$val['id']?>, <?=$stt?>)" class="btn btn-default"><i class="fas fa-save" title="Save" style="color: #EC971F;"></i></button>
                                <button onclick="hide_edit_item_group(<?=$stt?>)" class="btn btn-default"><i class="fa fa-undo" title="Return" style="color: green;"></i></button>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <?php if($pagination_gr->total_page>1):?>
                <div style="margin-bottom: 1rem;">
                    <?php $pagination_gr->getPage('ajax', 'setting_page-group');?>
                </div>
                <?php endif;?>
                <input type="hidden" id="setting_page-group" value="<?=$pagination_gr->page??1;?>">
            </div>
        </div>
    </div>

    <div class="modal-content setting_addGr">
        <div class="modal-header st_addAccount-head">
            <h4 class="modal-title" style="text-transform: uppercase;"><i class="fa fa-user"></i>Add group staff</h4>
            <button type="button" class="close btn_close-addGr"><span>×</span></button>
        </div>
        <div class="modal-body grid">
            <form class="form-horizontal st_addAccount-body st_addAccount-frm">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Group name</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" oninput="remove_error('.error-groupName')" id="inp_add-groupNames" name="group_name" class="form-control" value="" placeholder="Enter group name">
                        <span class="error-groupName _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Group permission</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" oninput="remove_error('.error-groupPermission')" id="inp_add-groupPermission" name="group_permission" class="form-control" value="" placeholder="Enter group permission (1-9)" min="1" max="9">
                        <span class="error-groupPermission _error"></span>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer st_addAccount-footer">
            <button type="button" class="btn btn-primary btn-sm btn-addGr" onclick="creGroupStaff();"><i class="fa fa-check"></i> <span>Save</span></button>
            <button type="button" class="btn btn-default btn-sm btn_close-addGr" data-dismiss="modal"><i class="fa fa-undo"></i> <span>Return</span></button>
        </div>
    </div>
</div>