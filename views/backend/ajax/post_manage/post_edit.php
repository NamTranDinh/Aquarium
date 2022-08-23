<div class="notice" id="posts_notice"></div>
<div id="edit-post">
    <div class="add_post_container">
        <div class="customer-act">
            <span id="act-title" class="act-title"><b onclick="load_post();">Post</b>/<b onclick="show_detail_post(<?=$data['sea_id'];?>);"><?=$data['sea_name'];?></b>/<i>Edit</i></span>
            <span>
                <button onclick="show_detail_post(<?=$data['sea_id'];?>);" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i><span>Back</span></button>
            </span>
        </div>
        <div class="post_add_frm" class="grid">
            <div class="form-group row">
                <div class="col-md-12">
                    <label class="post_lab-add">Post name</label>
                    <input oninput="remove_error('.post_inp-name-error')" type="text" id="post_inp-name" class="form-control" placeholder="Enter post name" value="<?=$data['sea_name'];?>">
                    <span class="post_inp-name-error _error"></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label class="post_lab-add">Post introduction</label>
                    <textarea oninput="remove_error('.post_inp-intro-error')" class="form-control" id="post_inp-intro" placeholder="<?=$data['sea_info'];?>" maxlength="200"><?=$data['sea_info'];?></textarea>
                    <span class="post_inp-intro-error _error"></span>
                </div>
            </div>   
            <div class="form-group row">
                <div class="col-md-6">
                    <label class="post_lab-add">Category</label>
                    <select  oninput="remove_error('.post_inp-category-error')" class="form-control" id="post_inp-category">
                        <?php foreach($category as $val):?>
                        <option value="<?=$val['id'];?>" <?=$val['group_name']==$data['group_name']?'selected':'';?> ><?=($val['level']>0?'|':'').str_repeat('&mdash; ', $val['level']).$val['group_name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            
                <div class="col-md-6 post_box-show">
                    <label class="post_lab-add">Show</label>
                    <div >
                        <input type="checkbox" id="post_ckb-status" <?=$data['status']==1?'checked':'';?>>
                        <label for="post_ckb-status">&nbsp;&nbsp;View in public</label>
                    </div>
                </div>
            </div>
            <div class="last_img-post" style="display: flex; flex-direction: column; align-items: center;margin: 1rem 0;">
                <?php if($data['sea_img'] != ''):?>
                <h3>Curren image</h3>
                <img width="100%" src="<?=$data['sea_img'];?>" alt="">
                <?php else:?>
                <h4>This content don't have image</h4>
                <?php endif;?>
            </div>
            <div class="form-group row">
                <form enctype="multipart/form-data" method="post" style="width: 100%;">
                <div class="col-md-12" class="post_add-inp-file">
                    <label class="post_lab-add">Main photo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="post_upl_img"><i class="fas fa-upload"></i></span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="post_inp-file" aria-describedby="post_upl_img" onchange="getFileName('#post_lab-file')">
                            <label class="custom-file-label" id="post_lab-file" for="post_inp-file">Chose image to upload.</label>
                        </div>
                    </div>
                </div>  
                </form>
            </div>
            <div class="last_img-post" style="display: flex; flex-direction: column; align-items: center;margin: 1rem 0;">
            <?php if($data['sea_sub_img'] != ''):?>
                <h3>Curren sub image</h3>
                <img width="25%" src="<?=$data['sea_sub_img'];?>" alt="">
            <?php else:?>
                <h4>This content don't have sub image</h4>
            <?php endif;?>
            </div>
            <div class="form-group row">
                <form enctype="multipart/form-data" method="post" style="width: 100%;">
                    <div class="col-md-12" class="post_add-inp-file">
                        <label class="post_lab-add">Sub photo</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="post_upl_sub_img"><i class="fas fa-upload"></i></span>
                            </div>
                            <div class="custom-file">
                                <input oninput="remove_error('.inp_subFile-error')" type="file" class="custom-file-input" id="post_inp-subFile" aria-describedby="post_upl_sub_img" onchange="getFileName('#post_lab-subFile')">
                                <label class="custom-file-label" id="post_lab-subFile" for="post_inp-subFile">Chose image to upload.</label>
                            </div>
                        </div>
                        <span class="inp_subFile-error _error"></span>
                    </div>  
                </form>
            </div>
            <div class="form-group row">
                <button onclick="udp_posts(<?=$data['sea_id'];?>)" class="btn btn-success post_btn-save">Save</button>
            </div>
        </div>
    </div>
</div>
