<div id="container-feedback">
    <div class="customer-act">
        <span>Feedback</span>
    </div>
    <ul class="nav nav-tabs setting_tab">
        <li><button class="btn btn-default st_btn-goStaff"><i class="fa fa-user"></i><span>Feedback User</span></button></li>
    </ul>
    <form action="?controller=feedback" method="post">
        <div class="post_search row no-gutters">
            <div class="col-md-6 ">
                <input id="inp-sPost" name="keyword" type="search" class="form-control" placeholder="Enter name, Event to search" value="<?= $keyword ?? ''; ?>">
            </div>
            <div class="col-md-6 row ">
                <div class="col-md-6">
                    <button name="search_submit" type="submit" value="1" class="btn btn-primary"  style="margin-left: 20px;" ><i class="fa fa-search"></i> Tìm kiếm</button>
                </div>
            </div>
        </div>
    </form>
    <div id="setting_panel">
        <div class="panel panel-primary setting_panel" id="setting_panel-staff">
            <div class="panel-body setting_panel-body" id="staff_load">
                <div class="table-responsive">
                    <table class="table table-hover table-user table-striped setting_table">
                        <thead class="setting_thead">
                            <tr>
                                <th class="text-center" style="width:10%;">STT</th>
                                <th>Name</th>
                                <th>Even</th>
                                <th>Comment</th>
                                <th class="text-center">Day created</th>
                                <th class="text-center" style="width: 15%;">Delete Feedback</th>
                            </tr>
                        </thead>
                        <tbody class="setting_tbody" id="setting_tbody">
                            <?php
                            $i = 0;
                            foreach ($data as $val) :
                                $i++;
                                $stt = $i + (($fBack_paging->page - 1) * $fBack_paging->limit);
                            ?>
                                <tr style="display: table-row;">
                                    <td class="text-center"><?= $stt ?? $i; ?></td>
                                    <td><?= $val['cus_name'] ?? ''; ?></td>
                                    <td><?= $val['event_name'] ?? ''; ?></td>
                                    <td><?= $val['comment'] ?? ''; ?></td>
                                    <td class="text-center"><?= $val['created'] ?? ''; ?></td>
                                    <td width="13%;" class="text-center st_btn">
                                        <button onclick="deleteFeedback(<?= $val['id']; ?>)" class="btn btn-default btn-danger">Delete <i title="Delete" class="far fa-trash-alt delete-item"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="no-bg">
                                <td colspan="6" style="padding: 12px 0;">
                                    <?php if (isset($fBack_paging) && $fBack_paging->total_page > 1) :
                                        $fBack_paging->getPage('', 'fBack_page');
                                    endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>