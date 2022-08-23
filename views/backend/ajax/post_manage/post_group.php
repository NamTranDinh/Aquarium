<div class="post_container">
    <div class="notice" id="posts_notice"></div>
    <div class="customer-act">
        <span id="act-title">Posts category</span>
        <span>
            <button onclick="show_add_category_post();" class="btn btn-info"><i class="fas fa-pencil-alt"></i> <span>Add new category</span></button>
        </span>
    </div>
    <ul class="nav nav-tabs setting_tab">

        <li><button onclick="load_post()" class="btn btn-default"><i class="far fa-list-alt"></i></i> <span>Posts</span></button></li>
        <li><button class="btn btn-default setting__active"><i class="fas fa-layer-group"></i> <span>Category</span></button></li>

    </ul>
    <div class="post_search row no-gutters">
        <div class="col-md-6 ">
            <input oninput="post_category_paging();" id="inp-sPost_cate" type="text" class="form-control" placeholder="Enter category" style="padding-right: 50px;">
            <input onclick="post_category_paging();" type="checkbox" id="ckb-sPost_cate" title="Search by characters" class="ckb-sPost_cate">
        </div>
        <div class="col-md-6 row no-gutters">
            <div class="col-md-5" style="margin: 0 10px;">
                <button id="btn-sPost" type="button" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
            </div>
        </div>
    </div>
    <div class="panel panel-success post_panel" id="">
        <div class="panel-body setting_panel-body" id="post_table-category">
            <?php if (!empty($data[0]['id'])) : ?>
                <div class="table-responsive">
                    <table class="table table-hover table-user table-striped setting_table">
                        <thead class="setting_thead">
                            <tr>
                                <th class="text-center" style="width: 5%;">STT</th>
                                <th>Category name</th>
                                <th>Parent category name</th>
                                <th class="text-center">Total subcategory</th>
                                <th class="text-center">Total posts</th>
                                <th style="width: 12.5%;">Create</th>
                                <th class="text-center" style="width: 12.5%;">Status</th>
                                <th style="width: 10%;"></th>
                            </tr>
                        </thead>

                        <tbody class="setting_tbody" id="">
                            <?php
                            $i = 0;
                            foreach ($data as $val) :
                                $i++;
                                $stt = $i + (($paging_category->page - 1) * $paging_category->limit);
                            ?>
                                <tr class="tr-item-<?= $stt ?? ''; ?>" style="display: table-row;">
                                    <td class="text-center"><?= $stt ?? ''; ?></td>
                                    <td style="font-size: 1.2rem;"><?= $val['group_name'] ?? ''; ?></td>
                                    <td style="font-size: 1.2rem;"><?= $val['parent_name'] ?? 'Don\'t have parent'; ?></td>
                                    <td class="text-center"><?= $val['total_subcategory'] ?? ''; ?></td>
                                    <td class="text-center"><?= $val['total_posts'] ?? ''; ?></td>
                                    <td><?= date_format(date_create($val['created']), 'H:i d/m/Y') ?? ''; ?></td>
                                    <td class="text-center" style="padding: 0;"><span class="user_status"><i class="fa fa-<?php echo $val['status'] == 0 ? 'lock' : 'unlock'; ?>"></i> <span><?php echo $val['status'] == 0 ? 'Locked' : 'Active'; ?></span></span></td>
                                    <td class="text-center" style="padding: 0;">
                                        <button onclick="toggle_edit_category_post(<?= $stt ?? ''; ?>, 'show')" class="btn btn-default"><i class="fas fa-edit edit-item" title="Edit"></i></button>
                                        <button onclick="del_category_post(<?= $val['id'] ?>, '<?= $val['group_name'] ?>')" class="btn btn-default"><i title="Delete" class="far fa-trash-alt delete-item"></i></button>
                                    </td>
                                </tr>
                                <tr class="tr-edit-item-<?= $stt ?? ''; ?>" style="display: none;">
                                    <td class="text-center"><?= $stt ?? ''; ?></td>
                                    <td style="font-size: 1.2rem;"><input type="text" id="post_inp_ct-name-<?= $val['id']; ?>" class="form-control" value="<?= $val['group_name'] ?? ''; ?>"></td>
                                    <td style="font-size: 1.2rem;">
                                        <select id="post_ct-parentId-<?= $val['id']; ?>" class="form-control">
                                            <option value="<?= $val['parent_id']; ?>" selected <?= $val['parent_name'] != '' ? '' : 'disabled style="background-color: #e2e2e2;"'; ?>><?= $val['parent_name'] != '' ? $val['parent_name'] : 'Don\'t have parent'; ?></option>
                                            <option value="-1">No pic</option>
                                            <?php foreach ($category as $value) : ?>
                                                <option <?= in_array($value['id'], $val['sub_cate_id']) ? 'disabled style="background-color: #e2e2e2;"' : ''; ?> value="<?= $value['id']; ?>"><?= ($value['level'] > 0 ? '|' : '') . str_repeat('&mdash; ', $value['level']) . $value['group_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td class="text-center"><?= $val['total_subcategory'] ?? ''; ?></td>
                                    <td class="text-center"><?= $val['total_posts'] ?? ''; ?></td>
                                    <td><?= date_format(date_create($val['created']), 'H:i d/m/Y') ?? ''; ?></td>
                                    <td class="text-center">
                                        <select class="form-control" id="post_inp_ct-status-<?= $val['id']; ?>">
                                            <option value="1" selected="selected">Active</option>
                                            <option value="0">Locked</option>
                                        </select>
                                    </td>
                                    <td class="text-center st_btn" style="padding: 0;">
                                        <button onclick="udp_category_post(<?= $val['id']; ?>);" class="btn btn-default"><i class="fas fa-save" title="Save" style="color: #EC971F;"></i></button>
                                        <button onclick="toggle_edit_category_post(<?= $stt ?? ''; ?>, 'hide')" class="btn btn-default"><i class="fa fa-undo" title="Return" style="color: green;"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if ($paging_category->total_page > 1) : ?>
                        <div style="margin-bottom: 1rem;">
                            <?php $paging_category->getPage('ajax', 'page_category'); ?>
                        </div>
                    <?php endif; ?>
                    <input type="hidden" id="post_page-category" value="<?= $paging_category->page ?? 1; ?>">
                </div>
            <?php else : ?>
                <div style="display: flex; justify-content: center;margin: 32px;">
                    <h2>No Category Result! </h2>
                    <button onclick="show_add_posts();" class="btn btn-info"><i class="fas fa-pencil-alt"></i> <span>Add new post</span></button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="overlay" id="post_cate_overlay" style="display: none;"></div>
    <div class="modal-content post_cate_box-add" id="post_cate-add">
        <div class="modal-header st_addAccount-head">
            <h4 class="modal-title" style="text-transform: uppercase;"><i class="fas fa-list-ul"></i>Add new category</h4>
            <button onclick="hide_add_category_post();" type="button" class="close"><span>×</span></button>
        </div>
        <div class="modal-body grid">
            <form class="form-horizontal st_addAccount-frm">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Category name</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" oninput="remove_error('.error-post_name')" id="post_add_ct-name" class="form-control" placeholder="Enter category name">
                        <span style="color: red; font-style: italic;" class="error-post_name"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Parent category</label>
                    </div>
                    <div class="col-sm-9">
                        <select id="post_add_ct-parent" class="form-control" selected>
                            <option value="-1"> --- No chose --- </option>
                            <?php foreach ($category as $val) : ?>
                                <option value="<?= $val['id']; ?>"><?= ($val['level'] > 0 ? '|' : '') . str_repeat('&mdash; ', $val['level']) . $val['group_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer st_addAccount-footer">
            <button onclick="cre_category_post();" type="button" class="btn btn-primary"><i class="fa fa-check"></i> <span>Save</span></button>
            <button onclick="hide_add_category_post();" type="button" class="btn btn-default post_cate_btn" data-dismiss="modal"><i class="fa fa-undo"></i> <span>Return</span></button>
        </div>
    </div>
</div>

<script>
    $('.page_category').click(function() {
        post_category_paging($(this).val());
    });
</script>