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
                <td class="text-center st_btn">
                    <button onclick="show_edit_item(<?=$stt?>)" class="btn btn-default"><i class="fas fa-edit edit-item" title="Edit"></i></button>
                    <button onclick="deleteStaff(<?=$val['id'];?>, '<?=$val['name'];?>')" class="btn btn-default" ><i title="Delete" class="far fa-trash-alt delete-item"></i></button>
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
                <td class="text-center st_btn">
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
    <input type="hidden" name="" id="setting_page-user" value="<?=$pagination->page??1;?>">
</div>