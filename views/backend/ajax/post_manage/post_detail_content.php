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
            <button onclick="show_edit_content_post(<?=$val['id'];?>, <?=$data['sea_id'];?>)" class="btn btn-edit btn-edit-<?=$val['id']?>" style="display: none;"><i class="fas fa-edit edit-item"></i><span>&nbsp;Edit</span></button>
            <button onclick="del_content_post(<?=$val['id'];?>, '<?=$val['des_name'];?>', <?=$data['sea_id'];?>)" class="btn btn-edit btn-del-<?=$val['id']?>" style="display: none;"><i class="far fa-trash-alt delete-item"></i><span>&nbsp;Delete</span></button>
        </div>
        <h2><?=$val['des_name']??'';?></h2>
        <p><?=$val['top_content']??'';?></p>
        <div style="text-align: center; padding: 16px;"><img width="50%" src="<?=$val['img'];?>"></div>
        <p><?=$val['bot_content']??'';?></p>
    </div>
<?php 
    endforeach;
    else:
?>
    <div class="post_detail-add">
        <h3 style="text-align: center;">The post don't have content. Please add any content!</h3>
        <button onclick="show_add_content_post('<?=$data['sea_id']?>', '<?=$data['sea_name']?>')" class="btn btn-edit post_btn-add-content"><i class="fas fa-pencil-alt"></i> <span>Add new content</span></button>
    </div>
<?php endif; ?>