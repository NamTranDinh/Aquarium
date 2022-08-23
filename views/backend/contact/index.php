<div id="contact-main">
    <div class="customer-act" >
        <span>Contact</span>
    </div>
    <ul class="nav nav-tabs setting_tab">
        <li><button class="btn btn-default st_btn-goStaff"><i class="fa fa-user"></i>
                <span>Contact User</span></button></li>
    </ul>
    <form action="?controller=contact" method="post">
        <div class="post_search row no-gutters">
            <div class="col-md-6 ">
                <input id="inp-sPost" name="keyword" type="search" class="form-control" placeholder="Enter name, email to search" value="<?= $keyword ?? ''; ?>">
            </div>
            <div class="col-md-6 row ">
                <div class="col-md-6">
                    <button style="margin-left:20px;" name="search_submit" type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                </div>
            </div>
        </div>
    </form>
    <div id="setting_panel">
        <div class="panel panel-primary setting_panel">
            <div class="panel-body setting_panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-user table-striped setting_table">
                        <thead class="setting_thead">
                            <tr>
                                <th class="text-center" style="width:10%;">STT</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Day create</th>
                                <th class="text-center" style="width: 10%;">Delete Contact</th>
                            </tr>
                        </thead>
                        <tbody class="setting_tbody" id="setting_tbody">
                            <?php
                                $i = 0;
                                foreach ($data as $val) :
                                $i++;
                                $stt = $i + (($contact_paging->page - 1) * $contact_paging->limit);
                            ?>
                                <tr style="display: table-row;">
                                    <td class="text-center"><?= $stt ?? $i; ?></td>
                                    <td><?= $val['name'] ?? ''; ?></td>
                                    <td><?= $val['email'] ?? ''; ?></td>
                                    <td><?= $val['title'] ?? ''; ?></td>
                                    <td><?= $val['content'] ?? '' ?></td>
                                    <td style="text-align:center; " width="16%"><img src="<?= $val['img'] ?? ''; ?>" width="100%;"></td>
                                    <td class="text-center"><?= $val['created'] ?? ''; ?></td>
                                    <td width="13%;" class="text-center st_btn">
                                        <button onclick="deleteContact(<?= $val['id']; ?>)" class="btn btn-default btn-danger">Delete <i title="Delete" class="far fa-trash-alt delete-item"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="no-bg">
                                <td colspan="10" style="padding: 12px 0; border-bottom:none">
                                    <?php if (isset($contact_paging) && $contact_paging->total_page > 1) :
                                        $contact_paging->getPage('', 'contact_paging');
                                    endif;?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
