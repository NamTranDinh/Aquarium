<div class="notice" id="posts_notice"></div>
<div class="post_add-container">
    <div class="customer-act">
        <span id="act-title" class="act-title"><b onclick="load_post();">Post</b> / <b onclick="show_detail_post(<?=$sea_id?>);"><?=$sea_name?></b> /<i><?=$description['des_name']??'';?></i>(edit)</span>
        <span>
            <button onclick="show_detail_post(<?=$sea_id?>);" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i><span>Back</span></button>
        </span>
    </div>
    <div class="post_addContent">
        <div class="grid">
            <div class="form-group row">
                <div class="col-md-12">
                    <label class="post_lab-add">Content name</label>
                    <input type="hidden" id="post_inp_ct-sea_id" value="<?=$sea_id?>">
                    <input type="text" id="post_inp_ct-name" class="form-control" value="<?=$description['des_name'];?>">
                    <span class="post_inp_ct-name-error _error"></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label class="post_lab-add">Content</label> <span>(Content above)</span>
                    <textarea name="content-top"></textarea>
                    <input type="hidden" class="content-top" id="content-top" value="<?=htmlspecialchars($description['top_content']);?>">
                </div>
            </div>
            <div class="last_img-post" style="display: flex; flex-direction: column; align-items: center;">
                <?php if($description['img'] != ''):?>
                <h3>Curren image</h3>
                <img width="40%" src="<?=$description['img'];?>" alt="">
                <?php else:?>
                <h3>This content don't have image</h3>
                <?php endif;?>
            </div>
            <div class="form-group row">
                <form enctype="multipart/form-data" method="post" style="width: 100%;">
                <div class="col-md-12" class="post_add-inp-file">
                    <label class="post_lab-add">Photo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="post_upl_content"><i class="fas fa-upload"></i></span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="post_inp-ct-file" aria-describedby="post_upl_content" onchange="getFileName('#post_lab_ct-file')">
                            <label class="custom-file-label" id="post_lab_ct-file" for="post_inp-ct-file">Chose image to upload.</label>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="form-group row" >
                <div class="col-md-12">
                    <label class="post_lab-add">Content</label> <span>(Content below)</span>
                    <textarea name="content-bot"></textarea>
                    <input type="hidden" class="content-bot" id="content-bot" value="<?=htmlspecialchars($description['bot_content']);?>">
                </div>
            </div> 
            <div class="form-group row">
                <button onclick="udp_content_post(<?=$description['id'];?>);" class="btn btn-success post_btn-save">Save</button>
            </div>
        </div>
    </div>
</div>