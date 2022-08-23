<div class="grid">
    <div class="row">
        <div class="col-md-12">
            <div class="dashboard-title">
                <i class="fas fa-check-square"></i>
                <span>Activity today</span>
            </div>
        </div>
    </div>
    <div class="row report" style="color: #f8f8f8;"> 
        <div class="col-md-4 col-sm-12">
            <div class="box-green infobox-content">
                <div class="infobox-icon"><i class="far fa-credit-card"></i></div>
                <div class="infobox-data">
                    <h3 class="infobox-title">Sales money</h3>
                    <span class="infobox-data-number"><?=$data['sale_money']??'0';?>$</span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="box-blue infobox-content">
                <div class="infobox-icon"><i class="fas fa-shopping-cart"></i></div>
                <div class="infobox-data infobox_order_prod">
                    <span>
                        <h3 class="infobox-title">Order number :&nbsp;</h3>
                        <span class="infobox-data-number"><?=$data['order_num']??'-';?></span>
                    </span>
                    <span>
                        <h3 class="infobox-title">Order product :&nbsp;</h3>
                        <span class="infobox-data-number"><?=$data['ord_product']??'-';?></span>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="box-orange infobox-content">
                <div class="infobox-icon"><i class="fas fa-arrow-circle-left"></i></div>
                <div class="infobox-data">
                    <h3 class="infobox-title">Order cancel</h3>
                    <span class="infobox-data-number"><?=$data['order_cancel']??'-';?></span>
                </div>
            </div>
        </div>
      
    </div>

    <div class="row dashboard-body">
        <div class="col-md-4 col-sm-12">
            <div class="widget widget-green">
                <div class="widget-header alert-success">
                    <h3 class="widget-title"><i class="fa fa-play-circle"></i>Activity</h3>
                </div>
                <div class="widget-body">
                    <div class="row">
                        <div class="info col-md-7 col-xs-7">Sales money</div>
                        <div class="info col-md-5 col-xs-5 data text-right"><b><?=$data['sale_money']??'0';?>$</b></div>
                        <div class="info col-md-7 col-xs-7">Order number</div>
                        <div class="info col-md-5 col-xs-5 data text-right"><b><?=$data['order_num']??'-';?></b></div>
                        <div class="info col-md-7 col-xs-7">Order product</div>
                        <div class="info col-md-5 col-xs-5 data text-right"><b><?=$data['ord_product']??'-';?></b></div>
                        <div class="info col-md-7 col-xs-7">Order cancel</div>
                        <div class="info col-md-5 col-xs-5 data text-right"><b><?=$data['order_cancel']??'-';?></b></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="widget widget-blue">
                <div class="widget-header alert-info">
                    <h3 class="widget-title"><i class="fab fa-ioxhost"></i>Event information</h3>
                </div>
                <div class="widget-body">
                    <div class="row">
                        <div class="info col-md-7 col-xs-7">Event left</div>
                        <div class="info col-md-5 col-xs-5 data text-right"><b><?=$data['event_left']??'-';?></b></div>
                        <div class="info col-md-7 col-xs-7">The event has ended </div>
                        <div class="info col-md-5 col-xs-5 data text-right"><b><?=$data['event_end']??'-';?></b></div>
                        <div class="info col-md-7 col-xs-7">Event is almost over</div>
                        <div class="info col-md-5 col-xs-5 data text-right"><b><?=$data['event_almostOver']??'-';?></b></div>
                        <div class="info col-md-7 col-xs-7">Event sold out</div>
                        <div class="info col-md-5 col-xs-5 data text-right"><b><?=$data['event_soldOut']??'-';?></b></div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-md-4 col-sm-12">
            <div class="widget widget-orange">
                <div class="widget-header alert-warning">
                    <h3 class="widget-title"><i class="far fa-newspaper"></i>New</h3>
                </div>
                <div class="widget-body">
                    <div class="row">
                        <div class="info col-md-7 col-xs-7">Order</div>
                        <div class="info col-md-5 col-xs-5 data text-right"><b><?=$data['order_num']??'-';?></b></div>
                        <div class="info col-md-7 col-xs-7">Member</div>
                        <div class="info col-md-5 col-xs-5 data text-right"><b><?=$data['new_mem']??'-';?></b></div>
                        <div class="info col-md-7 col-xs-7">Post/Event</div>
                        <div class="info col-md-5 col-xs-5 data text-right"><b><?=$data['new_post']??'-';?>/<?=$data['new_event']??'-';?></b></div>
                        <div class="info col-md-7 col-xs-7">Feedback/Contact</div>
                        <div class="info col-md-5 col-xs-5 data text-right"><b><?=$data['new_feedBack']??'-';?>/<?=$data['new_contact']??'-';?></b></div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="row" style="margin: 0; overflow: hidden; ">
        <div class="chart-report col">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-success">
                        <div class="panel-heading"><i class="fa fa-align-left"></i> Weekly sales <b><?=$data['week_sale']??'0';?></b>$</div>
                        <div class="panel-body das_chart">
                            <div class="das_chart-body week">
                            <?php foreach($data['day_chart'] as $key => $val):?> 
                                <div style="height: <?=$val['total_all'] != 0 ? ($val['total_all']/$data['week_sale']*100) : '0';?>%;">
                                    <span class="total"><?=$val['total_all']??0;?></span>
                                    <span class="key"><?=$key<6 ? 'T'.($key+2) : 'CN';?></span>
                                </div>
                            <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="fa fa-align-left"></i> Monthly sales <b><?=$data['month_sale']??'0';?></b>$</div>
                        <div class="panel-body das_chart">
                            <div class="das_chart-body month">
                            <?php foreach($data['month_chart'] as $key => $val):?> 
                                    <div style="height: <?=$val['total_all'] != 0 ? ($val['total_all']/$data['month_sale']*100) : '0';?>%;">
                                    <span class="total"><?=$val['total_all']??0;?></span>
                                    <span class="key">W<?=$key+1;?></span>
                                </div>
                            <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-warning">
                        <div class="panel-heading"><i class="fa fa-align-left"></i> Quarterly sales <b><?=$data['quarter_sale']??'0';?></b>$</div>
                        <div class="panel-body das_chart">
                            <div class="das_chart-body quarter">
                            <?php foreach($data['quarter_chart'] as $key => $val):?> 
                                    <div style="height: <?=$val['total_all'] != 0 ? ($val['total_all']/$data['quarter_sale']*100) : '0';?>%;">
                                    <span class="total"><?=$val['total_all']??0;?></span>
                                    <span class="key">Month <?=$key;?></span>
                                </div>
                            <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
