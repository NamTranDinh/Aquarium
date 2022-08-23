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