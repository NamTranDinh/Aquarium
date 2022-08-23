<?php
if (!empty($data)) :
    $i = 0;
    $total_money = 0;
    foreach ($data as $val) :
        $i++;
        $stt = $i + (($paging_cus->page - 1) * $paging_cus->limit);
        $total_money += $val['total_money'];
?>
        <tr style="display: table-row;">
            <td class="text-center"><?= $stt ?? $i ?></td>
            <td class="text-center"><button onclick="show_detail_cus(<?= $val['id'] ?>);" class="btn btn-default cus_btn-name"><?= $val['customer_code'] ?? ''; ?></button></td>
            <td class="text-center"><button onclick="show_detail_cus(<?= $val['id'] ?>);" class="btn btn-default cus_btn-name"><?= $val['cus_name'] ?? ''; ?></button></td>
            <td><?= $val['username'] ?? ''; ?></td>
            <td><?= $val['email'] ?? '-'; ?></td>
            <td class="text-center"><?= $val['phone'] ?? ''; ?></td>
            <td class="text-center"><?= $val['last_purchase'] != NULL  ? date_format(date_create($val['last_purchase']), 'H:i d/m/Y') : '-'; ?></td>
            <td class="text-right"><?= isset($val['total_money']) ? '<b>' . $val['total_money'] . '</b>$' : '-'; ?></td>
            <td class="text-center"><span class="user_status"><i class="fa fa-<?= $val['status'] == 0 ? 'lock' : 'unlock'; ?>"></i> <span><?= $val['status'] == 0 ? 'Locked' : 'Active'; ?></span></span></td>
            <td class="text-center cus_btn" style="padding: 0;">
                <button onclick="udp_cus_status(<?= $val['id']; ?>, <?= $val['status']; ?>)" class="btn btn-default">
                    <?php if ($val['status'] == 1) : ?>
                        <i title="Lock  " class="fas fa-user-lock"></i>
                    <?php else : ?>
                        <i title="Unlock" class="fas fa-unlock"></i>
                    <?php endif; ?>
                </button>
                <button onclick="del_cus(<?= $val['id']; ?>, '<?= $val['cus_name']; ?>');" class="btn btn-default"><i title="Delete" class="far fa-trash-alt delete-item"></i></button>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr class="no-bg">
        <td colspan="10">
            <h6 class="text-center">No have data!</h6>
        </td>
    </tr>
<?php endif; ?>
<tr class="no-bg">
    <td colspan="10" style="padding: 0;">
        <div class="alert alert-info ">
            <div class=" sm-info ">
                Number customers: <span style="color: red;"><b><?= $num_customers ?></b></span>&nbsp;&nbsp;
                Total in page: <span style="color: red;"><b><?= isset($total_money) && $total_money > 0 ? $total_money . '$' : 0; ?></b></span>&nbsp;&nbsp;
                Total money( all ): <span style="color: red;"><b><?= $total_all > 0 ? $total_all . '$' : 0 ?></b></span>
            </div>
        </div>
        <?php if ($paging_cus->total_page > 1) : ?>
            <div style="margin-bottom: 1rem;">
                <?php $paging_cus->getPage('ajax', 'cus_page'); ?>
            </div>
        <?php endif; ?>
        <input type="hidden" name="" id="cus_page" value="<?= $paging_cus->page ?? 1; ?>">
    </td>
</tr>