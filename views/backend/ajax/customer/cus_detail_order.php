<div>
    <h4 id="order_info">Order detail</h4>
</div>
<div class="orders-main-body">
    <button type="button" class="btn btn-default bg-warning" onclick="show_order_history_cus(<?=$cusId??'';?>)" style="color: #412e2e;"><i class="fa fa-arrow-left"></i> Back</button>
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
                $j=0;
                $total = 0;
                foreach($dataOrdDetail as $val):
                $j++;
                $total += $val['total_money'];
            ?>
                <tr class="cus-tr_item-odr">
                    <td class="text-center"><?=$j??'';?></td>
                    <td class="text-center"><?=$val['event_code']??'-';?></td>
                    <td class="text-left "><?=$val['event_name']??'';?></td>
                    <td class="text-center">
                        <?= $val['type'] == 0 ? 'General': 'VIP'; ?>
                    </td>
                    <td class="text-center "><?=$val['number']??'';?></td>
                    <td class="text-center"><?=isset($val['price'])?$val['price'].'$':'';?></td>
                    <td class="text-center"><?=isset($val['total_money'])?$val['total_money'].'$':'';?></td>
                </tr>
                <?php endforeach;?>
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
                                <div class="col-md-7"><?=$dataOrder['order_code'];?></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label class="bold-600">Customer</label>
                                </div>
                                <div class="col-md-7" style="font-style: italic;"><?=$dataOrder['cus_name']??'';?></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label class="bold-600">Order date</label>
                                </div>
                                <div class="col-md-7"><?=date_format(date_create($dataOrder['order_date']), 'H:i d/m/Y')??'';?></div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label class="bold-600">Note</label>
                                </div>
                                <div class="col-md-7">
                                    <textarea readonly="" id="note-order" cols="" class="form-control" rows="3" style="border-radius: 0;"><?=$dataOrder['note']??'';?></textarea>
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
                                        <?php foreach($orderMethod as $val):?>
                                        <div style="margin-bottom: 6px;"><input disabled="" type="radio" class="payment-method" <?=$dataOrder['order_method_id']==$val['id']?'checked':'';?> value="<?=$val['id']??'';?>">&nbsp;<?=$val['name']??'';?></div>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label class="bold-600">Total</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="bold-600" style="color: orange;"><?=$total>0?$total.'$':0?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>