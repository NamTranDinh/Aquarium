<?php
$total_inPage = 0;
if (!empty($dataOrders)) :
    $i = 0;
    foreach ($dataOrders as $value) :
        $i++;
        $stt = $i + (($paging_orders->page - 1) * $paging_orders->limit);
        $total_inPage += $value['total_money'];
        $s = $value['status'] ?? 0;
?>
<tr style="background-color: #FaFaFa;" class="ord-tr_item">
    <td style="text-align: center;"><i style="color: #478fca!important;" title="Chi tiết đơn hàng" onclick="toggle_detail_order(<?= $stt ?? $i; ?>)" class="fa fa-plus-circle i-detail-order-<?= $stt ?? $i; ?>"></i></td>
    <td class="text-center"><?= $stt ?? $i; ?></td>
    <td class="text-center"><button onclick="show_detail_order(<?=$value['id']?>);" class="btn btn-default cus_btn-name"><?=$value['order_code']??'';?></button></td>
    <td class="text-center"><?= $value['cus_name']; ?></td>
    <td class="text-center"><?= $value['method_name'] ?? ''; ?></td>
    <td class="text-center"><?= date_format(date_create($value['order_date']), 'H:i d/m/Y') ?? ''; ?></td>
    <td class="text-center"><?= isset($value['total_money']) ? $value['total_money'] . '$' : ''; ?></td>
    <td class="text-center status_change_bg" style="font-weight: 600;">
        <?= $s == 0 ? 'Cancel' : ($s == 1 ? 'Unprocessed' : ($s == 2 ? 'Processing' : ($s == 3 ? 'Complete': 'Cancel <sup>A</sup>'))); ?>
    </td>
    <td class="text-center st_btn" style="padding: 0; line-height: 45px;">
        <button onclick="del_order('<?=$value['id']??'';?>', '<?=$value['status']??'';?>');" class="btn btn-default"><i title="Delete" class="far fa-trash-alt delete-item"></i></button>
    </td>
</tr>
<tr id="tr-detail-order-<?= $stt ?? $i; ?>" class="no-bg" style="display: none;">
    <td colspan="15" style="padding: 0.75rem;">
        <div class="tabable">
            <ul class="nav nav-tabs">
                <li class="cus_ord-title nav__active">
                    <a data-toggle="tab">Order details</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="alert alert-success" style="display: flex; align-items: center; margin-bottom: 0;">
                        <div>
                            <i class="fa fa-cart-arrow-down"></i>
                            <span>Number of products:&nbsp;</span>
                            <span style="color: #3C763D;"><b><?= count($dataOrdDetail[$i - 1]); ?></b></span>
                        </div>
                        <div style="padding-left: 10px;">
                            <i class="fa fa-dollar"></i>
                            <span>Total money:&nbsp;</span>
                            <span style="color: #3C763D;"><?= isset($value['total_money']) ? '<b>' . $value['total_money'] . '</b>$' : ''; ?></span>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover table-striped" style="margin-bottom: 0;">
                        <thead>
                            <tr style="background-color: #F9F9F9;">
                                <th class="text-center" style="width: 7%;">STT</th>
                                <th class="text-center" style="width: 12%;">Event code</th>
                                <th class="text-left">Event name</th>
                                <th class="text-center" style="width: 12%;">Type</th>
                                <th class="text-center" style="width: 12%;">Quantity</th>
                                <th class="text-center" style="width: 12%;">Price</th>
                                <th class="text-center" style="width: 12%;">Total money</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $j = 0;
                        foreach ($dataOrdDetail[$i - 1] as $val) :
                            $j++;
                        ?>
                            <tr class="cus-tr_item-odr">
                                <td class="text-center"><?= $j ?? ''; ?></td>
                                <td class="text-center"><?= $val['event_code'] ?? '-'; ?></td>
                                <td class="text-left "><?= $val['event_name'] ?? ''; ?></td>
                                <td class="text-center">
                                    <?= $val['type'] == 0 ? 'General': 'VIP'; ?>
                                </td>
                                <td class="text-center "><?= $val['number'] ?? ''; ?></td>
                                <td class="text-center"><?= isset($val['price']) ? $val['price'] . '$' : ''; ?></td>
                                <td class="text-center"><?= isset($val['total_money']) ? $val['total_money'] . '$' : ''; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
        <div class="alert alert-info summany-info" role="alert">
            <div class="sm-info pull-left padd-0">
                Total orders: <span style="color: red;"><b><?= $total_order??0; ?></b></span>&nbsp;&nbsp;
                Total in page: <span style="color: red;"><?= $total_inPage > 0 ? '<b>' . $total_inPage . '</b>$' : 0 ?></span>&nbsp;&nbsp;
                Total money( all ): <span style="color: red;"><?= isset($total_moneyAll) && $total_moneyAll > 0 ? '<b>' . $total_moneyAll . '</b>$' : 0 ?></span>
            </div>
        </div>
        <?php if ($paging_orders->total_page > 1) : ?>
            <div style="margin-bottom: 1rem;">
                <?php $paging_orders->getPage('ajax', 'orders_page'); ?>
            </div>
        <?php endif; ?>
        <input type="hidden" name="" id="orders_page" value="<?= $paging_orders->page ?? 1; ?>">
    </td>
</tr>