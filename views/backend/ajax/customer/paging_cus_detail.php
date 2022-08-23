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
        <button onclick="del_order_cus(<?=$value['id'];?>, <?=$cus_id;?>, <?=$value['status'];?>);" class="btn btn-default" ><i title="Delete" class="far fa-trash-alt delete-item"></i></button>
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
                                <th class="text-center" style="width: 15%;">Event code</th>
                                <th class="text-left">Event name</th>
                                <th class="text-center">Type</th>
                                <th class="text-center" style="width: 15%;">Quantity</th>
                                <th class="text-center" style="width: 15%;">Price</th>
                                <th class="text-center" style="width: 15%;">Total money</th>
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
        <div class="alert alert-info" role="alert">
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
        <input type="hidden" name="" id="cus_id" value="<?=$cus_id;?>">
    </td>
</tr>