<div class="notice" id="posts_notice"></div> 
<div class=" post_detail-all" >
    <div class="post_detail-head customer-act">
        <span id="act-title" class="act-title"><b onclick="load_post()">Post</b> / <i><?=$data['sea_name']??'';?></i></span>
        <span>
            <button onclick="load_post()" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i><span>Back</span></button>
        </span>
    </div>
    <?php if(isset($data)): ?>
    <div class="post_dv_add-content">
        <button onclick="show_add_content_post('<?=$data['sea_id'];?>', '<?=$data['sea_name']?>')" class="btn btn-edit post_btn-add-content"><i class="fas fa-pencil-alt"></i><span>Add content</span></button>
    </div>
    <div class="post_detail-container">
        <div class="post_detail-top" style="position: relative; display: flex; justify-content: center; height: 454px;"
                onmouseover="Show('.post_detail-btn');Show('.post_detailSel')" 
                onmouseout="Hide('.post_detail-btn');Hide('.post_detailSel')" >
            <select oninput="udp_post_status(<?=$data['sea_id'];?>);" class="form-control post_detailSel" id="post_detail-status">
                <option <?=$data['status'] == 1? 'selected': '';?> value="1">Active</option>
                <option <?=$data['status'] == 0? 'selected': '';?> value="0">Locked</option>
            </select> 
            <button onclick="show_edit_post(<?=$data['sea_id'];?>)" class="btn btn-edit post_detail-btn" style="display: none;"><i class="fas fa-edit edit-item"></i><span>Edit</span></button>
            <img width="100%" height="100%" src="<?=$data['sea_img']?>" alt="SHARKS!">
            <div class="post_detail-title">
                <div class="text text-light">
                    <h1><?=$data['sea_name']?></h1>
                    <h5><?=$data['group_name']?></h5>
                    <p><?=$data['sea_info']?></p>
                </div>
            </div>
        </div>
        <div class="post_detail-content" id="post_detail-content">
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
                <?php if($val['img']!=''):?>
                <div style="text-align: center; padding: 16px;"><img width="50%" src="<?=$val['img'];?>" ></div>
                <?php endif;?>
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
        </div>
    </div>
    <?php else: ?>
        <h1 style="text-align: center;">No result found.</h1>
    <?php endif;?>
</div>  