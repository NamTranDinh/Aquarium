<div class="notice" id="posts_notice"></div>
<div class="post_add-container">
    <div class="customer-act">
        <span id="act-title" class="act-title"><b onclick="load_post();">Post</b> / <b onclick="show_detail_post(<?=$sea_id?>);"><?=$sea_name??'';?></b> / <i>Add content</i></span>
        <span>
            <button onclick="show_detail_post(<?=$sea_id?>);" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i><span>Back</span></button>
        </span>
    </div>
    <div class="post_addContent">
        <div class="grid">
            <div class="form-group row">
                <div class="col-md-12">
                    <label class="post_lab-add">Content name</label>
                    <input type="hidden" id="post_inp_ct-sea_id" value="<?=$sea_id?>" >
                    <input oninput="remove_error('.post_inp_ct-name-error')" type="text" id="post_inp_ct-name" class="form-control" placeholder="Content name">
                    <span class="post_inp_ct-name-error _error"></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label class="post_lab-add">Content</label> <span>(Content above)</span>
                    <textarea name="content-top"></textarea>
                </div>
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
            <button onclick="Toggle('.post_content-bot')" class="btn btn-primary"><i class="fas fa-plus"></i><span> Add bot content</span></button>
            <div class="form-group row post_content-bot" style="display: none;">
                <div class="col-md-12">
                    <label class="post_lab-add">Content</label> <span>(Content below)</span>
                    <textarea name="content-bot"></textarea>
                </div>
            </div> 
            
            <div class="form-group row">
                <button onclick="cre_content_post();" class="btn btn-success post_btn-save">Save</button>
            </div>
        </div>
    </div>
</div>
 