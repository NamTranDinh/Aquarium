<div class="notice" id="notice"></div>
<div class="post_add-container">
    <div class="customer-act">
        <span id="act-title" class="act-title"><b onclick="load_event();">Event</b> / <b onclick="show_detail_event(<?=$event_id?>);"><?=$event_name??'';?></b> /<i><?=$description['des_name']??'';?></i>(edit)</span>
        <span>
            <button onclick="show_detail_event(<?=$event_id?>);" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i><span>Back</span></button>
        </span>
    </div>
    <div class="event_addContent">
        <div class="grid">
            <div class="form-group row event_frm-add">
                <form enctype="multipart/form-data" method="post" class="<?=$description['des_img'] != ''?'col-md-8':'col-md-12'?>">
                <div>
                    <label class="post_lab-add">Content name</label>
                    <input type="hidden" id="content-event_id" value="<?=$event_id?>">
                    <input oninput="remove_error('.name-error')" type="text" id="content-name" class="form-control" value="<?=$description['des_name'];?>">
                    <span class="name-error _error"></span>
                </div>
                <div class="post_add-inp-file">
                    <label class="event_lab-add">Main photo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="event_upl_img"><i class="fas fa-upload"></i></span>
                        </div>
                        <div class="custom-file">
                            <input  oninput="remove_error('.file-error')" type="file" class="custom-file-input" id="content-file" aria-describedby="event_upl_img" onchange="getFileName('#event_lab-file')">
                            <label class="custom-file-label" id="event_lab-file" for="content-file">Chose image to upload.</label>
                        </div>
                    </div>
                    <span class="file-error _error"></span>
                </div>
                </form>
                <div class="last_img-event col-md-4" style="display: <?=$description['des_img'] != ''?'flex':'none';?>;">
                    <h3>Curren image</h3>
                    <img width="90%" src="<?=$description['des_img'];?>" alt='no_image'>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label class="post_lab-add">Content</label>
                    <textarea name="content"></textarea>
                    <input type="hidden" class="content" id="des_content" value="<?=htmlspecialchars($description['des_content']);?>">
                </div>
            </div> 
            <div class="form-group row">
                <button onclick="udp_content_event(<?=$id;?>);" class="btn btn-success post_btn-save">Save</button>
            </div>
        </div>
    </div>
</div>
 