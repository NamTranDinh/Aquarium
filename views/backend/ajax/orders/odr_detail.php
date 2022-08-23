<div class="orders_container">
    <div class="notice" id="notice"></div>
    <div id="event-main">
        <div class="customer-act">
            <?php if($type!=='view'):?>
                <span id="act-title" class="act-title"><b onclick="load_order()">Orders</b> / <i><?= $dataOrder['order_code']; ?></i></span>
                <span>
                    <button onclick="load_order()" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i><span>Back</span></button>
                </span>
            <?php else:?>
                <span id="act-title" class="">Orders / <i><?= $dataOrder['order_code']; ?></i></span>
                <span>
                    <button onclick="load_revenue(<?=$option;?>);" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i><span>Back</span></button>
                </span>
            <?php endif;?>
        </div>
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered table-striped" style="margin-top: 30px;">
                    <thead>
                        <tr style="background-color: #F9F9F9;">
                            <th class="text-center" style="width: 7%;">STT</th>
                            <th class="text-center">Event code</th>
                            <th class="text-left">Event name</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total money</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $j = 0;
                        $total = 0;
                        foreach ($dataOrdDetail as $val) :
                            $j++;
                            $total += $val['total_money'];
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
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="morder-info" style="padding: 4px;">
                            <div class="tab-contents" style="padding: 8px 6px;">
                                <div class="form-group row">
                                    <div class="col-md-5">
                                        <label class="bold-600">Order code</label>
                                    </div>
                                    <div class="col-md-7"><?= $dataOrder['order_code']; ?></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-5">
                                        <label class="bold-600">Customer</label>
                                    </div>
                                    <div class="col-md-7" style="font-style: italic;"><?= $dataOrder['cus_name'] ?? ''; ?></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-5">
                                        <label class="bold-600">Order date</label>
                                    </div>
                                    <div class="col-md-7"><?= date_format(date_create($dataOrder['order_date']), 'H:i d/m/Y') ?? ''; ?></div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-5">
                                        <label class="bold-600">Note</label>
                                    </div>
                                    <div class="col-md-7">
                                        <textarea readonly="" id="note-order" cols="" class="form-control" rows="3" style="border-radius: 0;"><?= $dataOrder['note'] ?? ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h5 class="lighter" style="margin-top: 0;">
                            <i class="fa fa-info-circle blue"></i>
                            Payment information | History
                        </h5>

                        <div class="morder-info" style="padding: 4px;">
                            <div class="tab-contents" style="padding: 8px 6px;">
                                <div class="form-group row">
                                    <div class="col-md-5">
                                        <label class="bold-600">Method</label>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="input-group" style="display: flex; flex-direction: column;">
                                            <?php foreach ($orderMethod as $val) : ?>
                                                <div style="margin-bottom: 6px;"><input disabled="" type="radio" class="payment-method" <?= $dataOrder['order_method_id'] == $val['id'] ? 'checked' : ''; ?> value="<?= $val['id'] ?? ''; ?>">&nbsp;<?= $val['name'] ?? ''; ?></div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-5">
                                        <label class="bold-600">Total</label>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="bold-600" style="color: orange;"><?= $total > 0 ? $total . '$' : 0 ?></div>
                                    </div>
                                </div>
                                <?php if(empty($option)):?>
                                <div class="form-group row " id="ordDetail-status">
                                    <div class="col-md-5">
                                        <label class="bold-600">Status</label>
                                    </div>
                                    <div class="col-md-7 ordDetail-status">
                                        <span class=" bold-600 status_change_bg <?= $dataOrder['status'] == 0 ? 'disabled' : ''; ?>" onclick="FadeIn('.change_status_ord', 200)" status='<?=$dataOrder['status'];?>'>
                                            <?php $s = $dataOrder['status'];
                                            echo $s == 0 ? 'Cancel' : ($s == 1 ? 'Unprocessed' : ($s == 2 ? 'Processing' : ($s == 3 ? 'Complete' : 'Cancel <sup>A</sup>'))); ?>
                                        </span>
                                        <div class="change_status_ord" style="display: none;">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <span>
                                                    <input type="radio" class="custom-control-input status-item" value="-1" id="ord-Cancel" name="rad_sOrd">
                                                    <label class="custom-control-label" for="ord-Cancel">Cancel</label>
                                                </span>
                                                <span>
                                                    <input type="radio" class="custom-control-input status-item" value="1" id="ord-Unprocessed" name="rad_sOrd">
                                                    <label class="custom-control-label" for="ord-Unprocessed">Unprocessed</label>
                                                </span>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <span>
                                                    <input type="radio" class="custom-control-input status-item" value="2" id="ord-Processing" name="rad_sOrd">
                                                    <label class="custom-control-label" for="ord-Processing">Processing</label>
                                                </span>
                                                <span>
                                                    <input type="radio" class="custom-control-input status-item" value="3" id="ord-Complete" name="rad_sOrd">
                                                    <label class="custom-control-label" for="ord-Complete">Complete</label>
                                                </span>
                                            </div>
                                             
                                            <div class="text-center">
                                                <button onclick="udp_order_status(<?=$dataOrder['id']??'';?>);" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>