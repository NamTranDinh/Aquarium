<?php 
    if(count($description)>0):
    foreach($description as $val):
?>
    <div class="post_detail-des" 
                    onmouseover="Show('.btn-edit-<?=$val['id']?>');
                                    Show('.btn-del-<?=$val['id']?>');" 
                    onmouseout=" Hide('.btn-edit-<?=$val['id']?>');
                                    Hide('.btn-del-<?=$val['id']?>')">
        <div class="post_detail-box-btn">
            <button onclick="show_edit_content_event(<?=$val['id']?>, <?=$data['id'];?>)" class="btn btn-edit btn-edit-<?=$val['id']?>" style="display: none;"><i class="fas fa-edit edit-item"></i><span>&nbsp;Edit</span></button>
            <button onclick="del_content_event(<?=$val['id'];?>,'<?=$val['des_name'];?>', <?=$data['id'];?>)" class="btn btn-edit btn-del-<?=$val['id']?>" style="display: none;"><i class="far fa-trash-alt delete-item"></i><span>&nbsp;Delete</span></button>
        </div>
        <div class="event_content-des" style='display: flex; '>
            <div class="" style="width: <?=!empty($val['des_img'])?'70%':'100%';?>;">
                <h2><?=$val['des_name']??'';?></h2>
                <p style="font-size: 1.2rem;"><?=$val['des_content']??'';?></p>
            </div>
            <div style="display: <?php echo !empty($val['des_img'])?'flex':'none';?>; width: 30%;">
                <img width="100%" src="<?=$val['des_img'];?>" >
            </div>
        </div>
    </div>
<?php 
    endforeach;
    else:
?>
    <div class="post_detail-add">
        <h3 style="text-align: center;">The event don't have content. Please add any content!</h3>
        <button onclick="show_add_content_event(<?=$data['id'];?>, '<?=$data['event_name']?>')" class="btn btn-edit post_btn-add-content"><i class="fas fa-pencil-alt"></i> <span>Add new content</span></button>
    </div>
<?php endif; ?>