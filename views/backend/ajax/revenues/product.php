<div class="revenue-main-body grid">
    <div class="quick-info row">
        <div class="col-md-4">
            <div class="report_box alert-warning">
                <div class="icon">
                    <i class="fas fa-clock" style="color: #9ABC32;"></i>
                </div>
                <div class="content">
                    <h3 style="color: #9ABC32;"><b><?= $data['total_product'] ?? 0; ?></b> / <b><?= $data['total_quantityAll'] ?? 0; ?></b></h3>
                    <span class="text-center">Total event / Total quantity</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="report_box alert-info">
                <div class="icon">
                    <i class="fas fa-sync-alt" style="color: orange;"></i>
                </div>
                <div class="content">
                    <h3 style="color: orange;"><?= isset($data['total_moneyAll']) && $data['total_moneyAll'] > 0 ? '<b>' . $data['total_moneyAll'] . '</b>$' : 0 ?></h3>
                    <span class="text-center">Total sales</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="report_box alert-success">
                <div class="icon">
                    <i class="fas fa-tag" style="color: #2D98D0;"></i>
                </div>
                <div class="content">
                    <h3 style="color: #2D98D0;">0</h3>
                    <span class="text-center">Amount of discount</span>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-striped" style="margin-bottom: 0;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th class="text-center" style="width: 5%;">STT</th>
                <th class="text-center" style="width: 12%;">Event code</th>
                <th class="text-left">Event name</th>
                <th class="text-center" style="width: 12%;">Type</th>
                <th class="text-center" style="width: 12%;">Total quantity</th>
                <th class="text-center" style="width: 12%;">Price</th>
                <th class="text-center" style="width: 12%;">Total money</th>
            </tr>
        </thead>
        <tbody class="setting_tbody">
            <?php
            if (!empty($data['product'])) :
                $i = 0;
                foreach ($data['product'] as $val) :
                    $i++;
                    $stt = $i + (($paging_revenue->page - 1) * $paging_revenue->limit); ?>
                    <tr class="cus-tr_item-odr">
                        <td class="text-center"><?= $stt ?? $i; ?></td>
                        <td class="text-center"><?= $val['event_code'] ?? '-'; ?></td>
                        <td class="text-left "><?= $val['event_name'] ?? ''; ?></td>
                        <td class="text-center">
                            <?= $val['type'] == 0 ? 'General': 'VIP'; ?>
                        </td>
                        <td class="text-center "><?= $val['quantity_sold'] ?? ''; ?></td>
                        <td class="text-center"><?= isset($val['price']) ? $val['price'] . '$' : ''; ?></td>
                        <td class="text-center"><?= isset($val['total_money']) ? $val['total_money'] . '$' : ''; ?></td>
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
                    <div class="alert-info" style="padding: 12px;">
                        <?php if (isset($paging_revenue) && $paging_revenue->total_page > 1) : ?>
                            <div>
                                <?php $paging_revenue->getPage('ajax', 'revenue_page'); ?>
                            </div>
                        <?php endif; ?>
                        <input type="hidden" name="" id="revenue_page" value="<?php echo $paging_revenue->page ?? 1; ?>">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>