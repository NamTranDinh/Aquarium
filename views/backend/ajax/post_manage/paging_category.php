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
<?php elseif (isset($search)) : ?>
    <div style="display: flex; justify-content: center;margin: 32px;">
        <h2>No search results for <b> '<?= $search ?? ''; ?>' </b> ! </h2>
    </div>
<?php else : ?>
    <div class="post_detail-add">
        <h3 style="text-align: center;">The post don't have content. Please add any content!</h3>
        <button onclick="show_add_content_post('<?= $data['sea_id'] ?>', '<?= $data['sea_name'] ?>')" class="btn btn-edit post_btn-add-content"><i class="fas fa-pencil-alt"></i> <span>Add new content</span></button>
    </div>
<?php endif; ?>