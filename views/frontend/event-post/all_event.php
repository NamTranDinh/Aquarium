<div class="row title">
    <h1>All Event</h1>
</div>
<div style="margin-top: 32px; position: relative;">
    <div class="row" style="padding: 32px 0 16px; background-color: #EFF5FF; display: flex; align-items: center;">
        <div class="col-md-12">
            <div class="form-group row">
                <div class="col-md-6" style="display: flex;">
                    <input type="text" id="event_sText" class="form-control" placeholder="Search" style="font-size: 18px; font-weight: 650;">
                    <button onclick="search_eventG();" type="button" class="btn btn-success">Search</button>
                </div>
                <div class="col-md-6 event_sDate">
                    <div class="event_sDate-item">
                        <input oninput="search_eventG();" type="text" class="datepicker form-control" placeholder="Start date" id="inp-sStartDate" maxlength="12">
                    </div>
                    <div class="event_date-gr">to</div>
                    <div class="event_sDate-item">
                        <input oninput="search_eventG();" type="text" class="datepicker form-control" placeholder="End date" id="inp-sEndDate" maxlength="12">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="load_animate" style="position: absolute; top: 200px; left: 50%; transform: translateX(-50%);"></div>
    <div id="event-guide_all">
    <?php if($count>0):?>
    <div class="row">
        <h2 style="margin: 72px 0 36px;">Results <span class="counter">(<?=$count??0;?>)</span></h2>
    </div>
    <div class="row">
        <div style="display: none;" id="page_dt" total = '<?=$count??0;?>' limit = '<?=EVENT_GUIDE_LIMIT;?>' lastId = '<?=count($data)??0;?>'></div>
        <ul class="all-guide" id="event-guide">
            <?php foreach($data as $val):?>
            <li>
                <a href="?controller=event&id=<?=$val['id'];?>" class="item-guide">
                    <div class="photo">
                        <img width="100%" src="<?=$val['event_sub_img'];?>">
                    </div>
                    <div class="wrapper">
                        <h3 class="name"><?=$val['event_name'];?></h3>
                        <span class="category">Learn More</span>
                    </div>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
        <?php if(count($data)<$count):?>
        <div class="load_more">
            <div class="load"></div>
            <button onclick="load_more_eventG();" class="btn btn-warning">Load More ...</button>
        </div>
        <?php endif;?>
    </div>
    <?php else:?>
        <div class="row">
            <h3  style="margin: 24px 0">No have data !</h3>
        </div>
    <?php endif;?>
    </div>
</div>