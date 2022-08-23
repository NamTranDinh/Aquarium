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
<?php elseif(isset($search)):?>
    <div style="display: flex; justify-content: center;margin: 32px;">
        <h2>No search results for '<?=$search??'';?>' <?php echo isset($category[0]['group_name']) ? "and category = '".$category[0]['group_name']."'" : '';?>! </h2>
    </div>
<?php else:?>
    <div style="display: flex; justify-content: center;margin: 32px;">
        <h2>No Post Result! Please&nbsp;&nbsp;</h2>
        <button onclick="show_add_posts();" class="btn btn-info"><i class="fas fa-pencil-alt"></i> <span>Add new post</span></button>                
    </div>
<?php endif;?>