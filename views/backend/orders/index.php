<div class="orders_container">
    <div class="notice" id="notice"></div>
    <div id="orders-main">
        <div class="customer-act orders-act">
            <span id="act-title">Orders</span>
            <div class="col-md-10 order-radio" style="font-size: 16px;">
                <b style="margin-left: 8px;">&nbsp;&nbsp;Order by:&nbsp;&nbsp;</b>
                <div class="custom-control custom-radio custom-control-inline">
                    <input oninput="order_paging();" type="radio" class="custom-control-input rad-sOrd_by" value="normal" id="ord-sNormal" name="rad_sOrd" checked>
                    <label class="custom-control-label" for="ord-sNormal">Normal</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input oninput="order_paging();" type="radio" class="custom-control-input rad-sOrd_by" value="orderDate" id="ord-sOrd_date" name="rad_sOrd">
                    <label class="custom-control-label" for="ord-sOrd_date">Order date</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input oninput="order_paging();" type="radio" class="custom-control-input rad-sOrd_by" value="total" id="ord-sTotalMoney" name="rad_sOrd">
                    <label class="custom-control-label" for="ord-sTotalMoney">Total money</label>
                </div>
                <span style="padding: 16px 8px; border-left: #d2b793 3px solid;"></span>
                <div class="custom-control custom-radio custom-control-inline">
                    <input oninput="order_paging();" type="radio" class="custom-control-input rad-sADesc" value="asc" id="ord-sAsc" name="ord_sOrd" checked>
                    <label class="custom-control-label" for="ord-sAsc">Asc</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input oninput="order_paging();" type="radio" class="custom-control-input rad-sADesc" value="desc" id="ord-sDesc" name="ord_sOrd">
                    <label class="custom-control-label" for="ord-sDesc">Desc</label>
                </div>
            </div>
            <div class="col-md-1 pad-0 order_notice-icon-box">
                <span class="order_notice-icon" onclick="FadeIn('.order_notice-content', 200)">
                    <?php if ($total_unprocessed > 0) : ?>
                        <span class="order_notice-quantity"><?= $total_unprocessed . '+' ?></span>
                    <?php endif; ?>
                    <span><i class="fas fa-angle-down"></i></span>
                </span>
            </div>
        </div>
        <div class="order_notice-content scrollbar" id="order_notice">
            <div id="scrollbar_height">
                <p>Notices</p>
                <ul class="notice_item" id="load_notice_result">
                    <span style="display: none;" id="row_no" lastId = '<?=count($dataOrdNotice)??0;?>' limit = '<?=ORDERS_NOTICE_LIMIT??10;?>' total = '<?=$total_notice??0;?>'></span>
                    <?php if (!empty($dataOrdNotice)) :?>
                        <?php foreach ($dataOrdNotice as $val) :?>
                            <li onclick="show_detail_order(<?= $val['id'] ?? ''; ?>)">
                                <span><?= $val['order_code'] ?? ''; ?></span>
                                <span>
                                    <p style="margin-bottom: 0; color: <?= $val['check_view'] == 0 ? '#f2f2f2' : '#a2a2a2'; ?>;"><?= $val['cus_name']; ?> has placed a new order</p>
                                    <span style="font-size: 1rem; ;color: <?= $val['check_view'] == 0 ? '#478fca' : '#a2a2a2'; ?>;"><time class="time_notice" datetime="<?= date_format(date_create($val['order_date']), 'Y-m-d H:i:s') ?? ''; ?>"> </time></span>
                                </span>
                                <span class="text-center" style="color: #478fca; <?= $val['check_view'] == 0 ? '' : 'display: none'; ?>;"><i class="fas fa-circle"></i></span>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <h4>Don't have notice.</h4>
                    <?php endif; ?>
                </ul>
                <h4 class="text-center notice_end" style="color: #F9F9F9;"></h4>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $(".time_notice").timeago();
            });
        </script>
        <div class="product-sear panel-sear row no-gutters" style="margin-top: 32px;">
            <div class="form-group col-md-3 pad-0">
                <input onkeyup="order_paging()" id="inp-sOrd-text" class="form-control" type="text" placeholder="Enter order code, cus name, method pay to search" style="padding-right: 46px;">
                <input onclick="order_paging()" id="ckb-sOrd-type" class="ckb-sCus" type="checkbox" title="Search by characters">
            </div>
            <div class="form-group col-md-9 pad-0 row" style="padding-left: 5px; margin-left: 0;">
                <div class="col-md-9 row">
                    <div class="col-md-4 pad-0 chose_orders-box">
                        <input onclick="FadeIn('.chose_orders', 200);" class="form-control chose_order-inp" value="---- All orders ----">
                        <div class="chose_orders">
                            <div class="chose_order-item">
                                <input onclick="order_paging();" type="checkbox" id="order-chose-0" class="checkAll">
                                <label for="order-chose-0">All</label>
                            </div>
                            <div class="chose_order-item">
                                <input oninput="order_paging();" type="checkbox" value="-1" id="order-chose-1" class="chose-item">
                                <label for="order-chose-1" class="chose_val-1">Admin cancel</label>
                            </div>
                            <div class="chose_order-item">
                                <input oninput="order_paging();" type="checkbox" value="0" id="order-chose-2" class="chose-item">
                                <label for="order-chose-2" class="chose_val-0">User cancel</label>
                            </div>
                            <div class="chose_order-item">
                                <input oninput="order_paging();" type="checkbox" value="1" id="order-chose-3" class="chose-item">
                                <label for="order-chose-3" class="chose_val-2">Unprocessed</label>
                            </div>
                            <div class="chose_order-item">
                                <input oninput="order_paging();" type="checkbox" value="2" id="order-chose-4" class="chose-item">
                                <label for="order-chose-4" class="chose_val-3">Processing</label>
                            </div>
                            <div class="chose_order-item">
                                <input oninput="order_paging();" type="checkbox" value="3" id="order-chose-5" class="chose-item">
                                <label for="order-chose-5" class="chose_val-4">Complete</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 pad-0" style="display: flex;">
                        <div class="event_sDate-item">
                            <input oninput="order_paging();" type="text" class="datepicker form-control" placeholder="Start " id="search-date-from">
                        </div>
                        <div class="event_date-gr">to</div>
                        <div class="event_sDate-item">
                            <input oninput="order_paging();" type="text" class="datepicker form-control" placeholder="End " id="search-date-to">
                        </div>
                    </div>
                    <div class="col-md-3 pad-0">
                        <button onclick="order_paging();" style="box-shadow: none;" type="button" class="btn btn-primary btn-large"><i class="fa fa-search"></i> Tìm kiếm</button>
                    </div>
                </div>
                <div class="col-md-3 pad-0" style="padding-left: 5px;">
                    <div class="btn-group order-btn-calendar">
                        <button type="button" onclick="set_current_week()" class="btn btn-default">Week</button>
                        <button type="button" onclick="set_current_month()" class="btn btn-default">Month</button>
                        <button type="button" onclick="set_current_quarter()" class="btn btn-default">Quarter</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="orders-main-body" style="margin-bottom: 50px;">
            <table class="table table-bordered" style="margin-bottom: 0;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th style="width: 3%;"></th>
                        <th class="text-center" style="width: 5%;">STT</th>
                        <th class="text-center">Order code</th>
                        <th class="text-center">Customer name</th>
                        <th class="text-center">Method of payments</th>
                        <th class="text-center">Order date</th>
                        <th class="text-center">Total money</th>
                        <th class="text-center">Status</th>
                        <th style="width: 3%;"></th>
                    </tr>
                </thead>
                <tbody id="order-body" class="setting_tbody">
                    <?php
                    $total_inPage = 0;
                    if (!empty($dataOrders)) :
                        $i = 0;
                        foreach ($dataOrders as $value) :
                            $i++;
                            $stt = $i + (($paging_orders->page - 1) * $paging_orders->limit);
                            $total_inPage += $value['total_money'];
                            $s = $value['status'] ?? 0; ?>
                            <tr style="background-color: #FaFaFa;" class="ord-tr_item">
                                <td style="text-align: center;"><i style="color: #478fca!important;" title="Chi tiết đơn hàng" onclick="toggle_detail_order(<?= $stt ?? $i; ?>)" class="fa fa-plus-circle i-detail-order-<?= $stt ?? $i; ?>"></i></td>
                                <td class="text-center"><?= $stt ?? $i; ?></td>
                                <td class="text-center"><button onclick="show_detail_order(<?= $value['id']?>, '.orders_container');" class="btn btn-default cus_btn-name"><?= $value['order_code'] ?? ''; ?></button></td>
                                <td class="text-center"><?= $value['cus_name'] ?? ''; ?></td>
                                <td class="text-center"><?= $value['method_name'] ?? ''; ?></td>
                                <td class="text-center"><?= date_format(date_create($value['order_date']), 'H:i d/m/Y') ?? ''; ?></td>
                                <td class="text-center"><?= isset($value['total_money']) ? $value['total_money'] . '$' : ''; ?></td>
                                <td class="text-center status_change_bg" style="font-weight: 600;">
                                    <?= $s == 0 ? 'Cancel' : ($s == 1 ? 'Unprocessed' : ($s == 2 ? 'Processing' : ($s == 3 ? 'Complete' : 'Cancel <sup>A</sup>'))); ?>
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
                                                            <th class="text-center" style="width: 8%;">STT</th>
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
                                    Total orders: <span style="color: red;"><b><?= $total_order ?? 0; ?></b></span>&nbsp;&nbsp;
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
                </tbody>
            </table>
        </div>
 
    </div>
</div>