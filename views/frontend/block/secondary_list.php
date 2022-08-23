<?php if($list_op == 'event'):?>
<ul class="secondary-list">
    <div class="left">
        <span class="secondary-heading">Recently</span>
        <?php foreach($data as $val):?>
        <li class="secondary-item"> <a href="?controller=event&id=<?=$val['id'];?>" class="secondary-link"><?=$val['event_name']??'';?></a></li>
        <?php endforeach;?>
        <li class="secondary-item"> <a href="?controller=event&action=all" class="secondary-link">All Event</a></li>
    </div>
    <div class="right">
        <a href="?controller=event&action=all" class="promo" style="background-image: url('<?=$val['event_sub_img']?>')">
            <div class="promo-heading">All New Event</div> <span class="promo-cta" style="font-size: 16px;">Book Now</span>
        </a>
    </div>
</ul>
<?php elseif($list_op == 'animal'):?>
    <ul class="secondary-list">
    <div class="left">
        <span class="secondary-heading">Species</span>
        <?php foreach($data as $val):?>
        <li class="secondary-item"> <a href="?controller=post&id=<?=$val['sea_id'];?>" class="secondary-link"><?=$val['sea_name']??'';?></a></li>
        <?php endforeach;?>
        <li class="secondary-item"> <a href="?controller=post&action=all" class="secondary-link">All Animals</a></li>
        <span class="secondary-heading">Category</span>
        
        <?php foreach($listCate as $val):?>
        <li class="secondary-item"> <a href="?controller=post&action=all&cid=<?=$val['id']?>" class="secondary-link"><?=$val['group_name']??'';?></a></li>
        <?php endforeach;?>
        <li class="secondary-item"> <a href="?controller=post&action=categories" class="secondary-link">All Category</a></li>
    </div>
    <div class="right">
        <a href="?controller=post&action=all" class="promo" style="background-image: url('<?=$data[0]['sea_sub_img']?>')">
            <div class="promo-heading">All New Shark</div> <span class="promo-cta" style="font-size: 16px;">View Now</span>
        </a>
    </div>
</ul>
<?php endif;?>
