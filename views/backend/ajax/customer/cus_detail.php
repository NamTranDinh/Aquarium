<div class="customer_container">
    <div class="notice" id="notice"></div>
    <div id="customer-main" class="grid" style="margin-bottom: 150px;">
        <div class="customer-act">
            <span id="act-title" class="act-title"><b onclick="load_cus();">Customer</b> / <i><?=$cusInfo['customer_code']??'';?></i></span>
            <span>
                <button onclick="show_edit_cus()" id="cus-btn_edit" class="btn btn-info"><i class="far fa-edit"></i> <span>Edit</span></button>
                <button onclick="load_cus();" id="cus-btn_back" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i> <span>Back</span></button>
                <button onclick="udp_cus(<?=$cusInfo['id'];?>);" id="cus-btn_save" class="btn btn-success" style="display: none;"><i class="fas fa-check"></i> <span>Save</span></button>
                <button onclick="hide_edit_cus()" id="cus-btn_return" class="btn btn-warning" style="display: none;"><i class="fas fa-undo-alt"></i> <span>Return</span></button>
            </span>
        </div>
        <div class="customer-info col-md-12" id="customer-info">
            <div id="item-customer">
                <div class="col-md-12 row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Customer name</label>
                            <div class="col-md-8"><?=$cusInfo['cus_name'];?> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">User name</label>
                            <div class="col-md-8"><?=$cusInfo['username'];?> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Phone</label>
                            <div class="col-md-8"><?=$cusInfo['phone'];?> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Email</label>
                            <div class="col-md-8"><?=$cusInfo['email'];?> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Gender</label>
                            <div class="col-md-8">
                                <input type="radio" disabled="" name="gender" <?=$cusInfo['gender']==0?'checked':''?> >Male&nbsp;
                                <input type="radio" disabled="" name="gender" <?=$cusInfo['gender']==1?'checked':''?> >Female
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Datebirth</label>
                            <div class="col-md-8"><?=substr($cusInfo['datebirth'], 0, 4)!=='0000'?date_format(date_create($cusInfo['datebirth']), 'd/m/Y')??'':'-';?> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Address</label>
                            <div class="col-md-8"><?=$cusInfo['address'];?> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Day created</label>
                            <div class="col-md-8"><?=date_format(date_create($cusInfo['created']), 'H:i d/m/Y')??'';?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="edit-item-customer" style="display: none;">
                <div class="col-md-12 row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Customer name</label>
                            <div class="col-md-8">
                                <input oninput="remove_error('.error-customer_name');" type="text" id="customer_name" class="form-control" value="<?=$cusInfo['cus_name'];?>">
                                <span style="color: red;" class="error-customer_name"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">User name</label>
                            <div class="col-md-8"><?=$cusInfo['username'];?> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Phone</label>
                            <div class="col-md-8">
                                <input oninput="remove_error('.error-customer_phone');" type="text" id="customer_phone" class="form-control" value="<?=$cusInfo['phone'];?>">
                                <span style="color: red;" class="error-customer_phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Email</label>
                            <div class="col-md-8">
                                <input type="text" id="customer_email" class="form-control" value="<?=$cusInfo['email'];?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Gender</label>
                            <div class="col-md-8">
                                <input type="radio" class="customer_gender" name="gender1" <?=$cusInfo['gender']==0?'checked':''?> value="0">Male&nbsp;
                                <input type="radio" class="customer_gender" name="gender1" <?=$cusInfo['gender']==1?'checked':''?> value="1"> Female
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Datebirth</label>
                            <div class="col-md-8">
                                <input type="text" class="customer_birthday datepicker form-control" id="customer_birthday" value="<?=substr($cusInfo['datebirth'], 0, 4)!=='0000'?date_format(date_create($cusInfo['datebirth']), 'd/m/Y')??'':'';?>" placeholder="dd/mm/yyyy">
                                <span style="color: red;" class="error-dateBirth"></span>
                            </div>
                            <script>
                                $('.customer_birthday').datepicker({
                                    format: "dd/mm/yyyy"
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Address</label>
                            <div class="col-md-8">
                                <textarea id="customer_addr" class="form-control" style="max-height: 120px;"><?=$cusInfo['address'];?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 lb_cus-deltail">Day created</label>
                            <div class="col-md-8"><?=date_format(date_create($cusInfo['created']), 'H:i d/m/Y')??'';?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="order_content">
            <div>
                <h4 id="order_info">Order history</h4>
            </div>

            <div class="orders-main-body">
                <table class="table table-bordered" style="margin-bottom: 0;">
                    <thead>
                        <tr style="background-color: #f2f2f2;">
                            <th style="width: 3%;"></th>
                            <th class="text-center" style="width: 5%;">STT</th>
                            <th class="text-center">Order code</th>
                            <th class="text-center">Method of payments</th>
                            <th class="text-center">Order date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Total money</th>
                            <th style="width: 3%;"></th>
                        </tr>
                    </thead>
                    <tbody id="cus_order-history">
                        <?php 
                        $total_inPage = 0;
                        if(!empty($cusOrder)):
                            $i=0;
                            foreach($cusOrder as $value):
                            $i++;
                            $stt = $i+(($paging_cus_detail->page-1)*$paging_cus_detail->limit);
                            $total_inPage += $value['total_money'];
                            $s = $value['status']??0;
                        ?>
                        <tr style="background-color: #FaFaFa;" class="ord-tr_item">
                            <td style="text-align: center;"><i style="color: #478fca!important;" title="Chi tiết đơn hàng" onclick="toggle_detail_order(<?=$stt??$i;?>)" class="fa fa-plus-circle i-detail-order-<?=$stt??$i;?>"></i></td>
                            <td class="text-center"><?=$stt??$i;?></td>
                            <td class="text-center"><button onclick="show_order_detail_cus(<?=$value['id']?>);" class="btn btn-default cus_btn-name"><?=$value['order_code']??'';?></button></td>
                            <td class="text-center" style="width: 25%;"><?=$value['method_name']??'';?></td>
                            <td class="text-center"><?=date_format(date_create($value['order_date']), 'H:i d/m/Y')??'';?></td>
                            <td class="text-center">
                                <?=$s==0?'Cancel':($s==1?'Unprocessed':($s==2?'Processing':'Complete'));?>
                            </td>
                            <td class="text-center"><?=isset($value['total_money'])?$value['total_money'].'$':'';?></td>
                            <td class="text-center st_btn" style="padding: 0;">
                                <button onclick="del_order_cus(<?=$value['id'];?>, <?=$cusInfo['id'];?>, <?=$value['status'];?>);" class="btn btn-default" ><i title="Delete" class="far fa-trash-alt delete-item"></i></button>
                            </td>
                        </tr>
                        <tr id="tr-detail-order-<?=$stt??$i;?>" style="display: none;">
                            <td colspan="15">
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
                                                    <span style="color: #3C763D;"><b><?=count($cus_odrDetail[$i-1]);?></b></span>
                                                </div>
                                                <div style="padding-left: 10px;">
                                                    <i class="fa fa-dollar"></i>
                                                    <span>Total money:&nbsp;</span>
                                                    <span style="color: #3C763D;"><?=isset($value['total_money'])?'<b>'.$value['total_money'].'</b>$':'';?></span>
                                                </div>
                                            </div>
                                            <table class="table table-bordered table-hover table-striped" style="margin-bottom: 0;">
                                                <thead>
                                                    <tr style="background-color: #F9F9F9;">
                                                        <th class="text-center" style="width: 7%;">STT</th>
                                                        <th class="text-center"style="width: 15%;">Event code</th>
                                                        <th class="text-left">Event name</th>
                                                        <th class="text-center">Type</th>
                                                        <th class="text-center"style="width: 15%;">Quantity</th>
                                                        <th class="text-center"style="width: 15%;">Price</th>
                                                        <th class="text-center"style="width: 15%;">Total money</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $j=0;
                                                        foreach($cus_odrDetail[$i-1] as $val):
                                                        $j++;
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
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    <?php else:?>
                        <tr>
                            <td colspan="10" ><h6 class="text-center">No have data!</h6></td>
                        </tr>
                    <?php endif;?>
                        <tr>
                            <td colspan="10" style="padding: 0;">
                                <div class="alert alert-info summany-info" role="alert">
                                    <div class="sm-info pull-left padd-0">
                                        Total orders: <span style="color: red;"><b><?=$total_order;?></b></span>&nbsp;&nbsp;
                                        Total in page: <span style="color: red;"><?=$total_inPage>0?'<b>'.$total_inPage.'</b>$':0?></span>&nbsp;&nbsp;
                                        Total money( all ): <span style="color: red;"><?=$total_moneyAll>0?'<b>'.$total_moneyAll.'</b>$':0?></span>
                                    </div>
                                </div>
                                <?php if($paging_cus_detail->total_page>1):?>
                                <div style="margin-bottom: 1rem;">
                                    <?php $paging_cus_detail->getPage('ajax', 'cus_detail_page');?>
                                </div>
                                <?php endif;?>
                                <input type="hidden" name="" id="cus_detail_page" value="<?=$paging_cus_detail->page??1;?>">
                                <input type="hidden" name="" id="cus_id" value="<?=$cusInfo['id'];?>">  
                            </td>
                        </tr>
                    </tbody>
                </table>
            
            </div>
        </div>

    </div>
</div>
<?php
 