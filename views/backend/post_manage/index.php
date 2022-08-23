<div class="post_container">
    <div class="notice" id="posts_notice"></div>
    <div id="posts-main" >
        <div class="customer-act">
            <span id="act-title">Posts</span>
            <span>
                <button onclick="show_add_posts();" class="btn btn-info"><i class="fas fa-pencil-alt"></i> <span>Add new post</span></button>                
            </span>
        </div>
        <ul class="nav nav-tabs setting_tab">
            <li><button class="btn btn-default setting__active"><i class="far fa-list-alt"></i></i> <span>Posts</span></button></li>
            <li><button onclick="load_post_category()" class="btn btn-default"><i class="fas fa-layer-group"></i> <span>Category</span></button></li>
        </ul>

        <div class="post_search row no-gutters">
            <div class="col-md-3">
                <input oninput="post_paging()" id="inp-sPost" type="text" class="form-control" placeholder="Enter name, category or author" style="padding-right: 50px;">
                <input onclick="post_paging();" type="checkbox" id="ckb-sPost" title="Search by characters" class="ckb-sPost">
            </div>
            <div style="width: 15%; padding: 0 8px;">
                <select oninput="post_paging();" id="sel-sPost_status" class="form-control sel-sCus">
                    <option value="-1" selected>---All posts--- </option>
                    <option value="1">Posts active</option>
                    <option value="0">Posts locked</option>
                </select>
            </div>
            
            <div class="col-md-6 row" style="margin-left: 4px;">
                <div class="col-md-4">
                    <select oninput="post_paging()" id="sel-sPost_cate" class="form-control" selected>
                        <option value="-1"> --- All category --- </option>
                        <?php foreach($category as $val):?>
                        <option value="<?=$val['id'];?>"><?=($val['level']>0?'|':'').str_repeat('&mdash; ', $val['level']).$val['group_name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-md-8 order-radio" style="padding: 0;">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input oninput="post_paging();" type="radio" class="custom-control-input rad-sPost_ADesc" value="asc" id="cus-sAsc" name="ord_sCus" checked>
                        <label class="custom-control-label" for="cus-sAsc">Asc</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input oninput="post_paging();" type="radio" class="custom-control-input rad-sPost_ADesc" value="desc" id="cus-sDesc" name="ord_sCus">
                        <label class="custom-control-label" for="cus-sDesc">Desc</label>
                    </div>
                    <div>
                        <button id="btn-sPost" type="button" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-success post_panel" id="">
            <div class="panel-body setting_panel-body" id="post_table">
                <?php if(!empty($data)):?>
                <div class="table-responsive">
                    <table class="table table-hover table-user table-striped setting_table">
                        <thead class="setting_thead">
                            <tr>
                                <th class="text-center" style="width: 5%;">STT</th>
                                <th style="width: 15%;">Name</th>
                                <th style="width: 20%;">Default Img</th>
                                <th style="width: 12%;">Introduction</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th style="width: 13%;">Create</th>
                                <th class="text-center" style="width: 12%;">Status</th>
                                <th style="width: 8%;"></th>
                            </tr>
                        </thead>

                        <tbody class="setting_tbody" id="">
                            <?php                         
                                $i=0;
                                foreach($data as $val):
                                $i++;                                
                                $stt = $i+(($paging_posts->page-1)*$paging_posts->limit);
                                $sea_info = substr($val['sea_info'], 0, 40).'...';
                            ?>
                            <tr class="tr-item-" style="display: table-row;">
                                <td class="text-center"><?=$stt??'';?></td>
                                <td><button onclick="show_detail_post(<?=$val['sea_id'];?>);" class="btn post_btn-name"><?=$val['sea_name']??'';?></button></td>
                                <td style="padding: 3px;"><img style="width: 100%;" src="<?=$val['sea_img']??'';?>" alt=""></td>
                                <td><?=$sea_info??'';?></td>
                                <td><?=$val['group_name']??'';?></td>
                                <td><?=$val['name']??'';?></td>
                                <td><?=date_format(date_create($val['created']), 'H:i d/m/Y')??'';?></td>
                                <td class="text-center" style="padding: 0;"><span class="user_status"><i class="fa fa-<?=$val['status']==0 ? 'lock': 'unlock';?>"></i> <span><?=$val['status']==0 ? 'Locked': 'Active';?></span></span></td>                   
                                <td class="text-center" style="padding: 0;">
                                    <button onclick="show_edit_post(<?=$val['sea_id'];?>)" class="btn btn-default"><i class="fas fa-edit edit-item" title="Edit"></i></button>
                                    <button onclick="del_posts(<?=$val['sea_id'];?>, '<?=$val['sea_name'];?>');" class="btn btn-default" ><i title="Delete" class="far fa-trash-alt delete-item"></i></button>
                                </td>
                            </tr> 
                            <?php endforeach;?>
                        </tbody>
                    </table>  
                    <?php if($paging_posts->total_page>1):?>
                    <div style="margin-bottom: 1rem;">
                        <?php $paging_posts->getPage('ajax', 'page_posts');?>
                    </div>
                    <?php endif;?>
                    <input type="hidden" id="post_page-animal" value="<?=$paging_posts->page??1;?>">
                </div>
                <?php else:?>
                    <div style="display: flex; justify-content: center;margin: 32px;">
                        <h2>No Post Result! Please&nbsp;&nbsp;</h2>
                        <button onclick="show_add_posts();" class="btn btn-info"><i class="fas fa-pencil-alt"></i> <span>Add new post</span></button>                
                    </div>
                <?php endif;?>
            </div>  
        </div>
    </div>

    <div id="add-post" style="display: none;">
        <div class="add_post_container">
            <div class="customer-act">
                <span id="act-title">Add new post</span>
                <span>
                    <button onclick="cre_posts()" class="btn btn-info" id="post_add-save"><i class="fas fa-pencil-alt"></i> <span>Save</span></button>
                    <button onclick="load_post();" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i><span>Back</span></button>
                </span>
            </div>
            <div class="post_add_frm grid">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="post_lab-add">Post name</label>
                        <input oninput="remove_error('.post_inp-name-error')" type="text" id="post_inp-name" class="form-control" placeholder="Enter post name">
                        <span class="post_inp-name-error _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="post_lab-add">Post introduction</label>
                        <textarea oninput="remove_error('.post_inp-intro-error')" class="form-control" id="post_inp-intro" placeholder="Enter article introduction" maxlength="200" style="max-height: 150px;"></textarea>
                        <span class="post_inp-intro-error _error"></span>
                    </div>
                </div>   
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="post_lab-add">Category</label>
                        <select  oninput="remove_error('.post_inp-category-error')" class="form-control" id="post_inp-category">
                            <option value="-1" selected> ---- Chose category ---- </option>
                            <?php foreach($category as $val):?>
                            <option value="<?=$val['id'];?>"><?=($val['level']>0?'|':'').str_repeat('&mdash; ', $val['level']).$val['group_name'];?></option>
                            <?php endforeach;?>
                        </select>
                        <span class="post_inp-category-error _error"></span>
                    </div>                   
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
                                <input  oninput="remove_error('.post_inp-file-error')" type="file" class="custom-file-input" id="post_inp-file" aria-describedby="post_upl_img" onchange="getFileName('#post_lab-file')">
                                <label class="custom-file-label" id="post_lab-file" for="post_inp-file">Chose image to upload.</label>
                            </div>
                        </div>
                        <span class="post_inp-file-error _error"></span>
                    </div>  
                
                    <div class="col-md-12" class="post_add-inp-file" style="margin-top: 16px;">
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
                    <button onclick="cre_posts()" class="btn btn-success post_btn-save">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
 