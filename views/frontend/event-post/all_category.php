<div class="row title">
    <h1>List Category</h1>
</div>
<div style="margin-top: 32px;">
    <div class="row">
        <ul style="width: 100%; list-style: none; padding: 16px; font-size: 25px;background-image: url('/Aquarium/public/templates/upload/public/bg/list_cate-bg.jpg');">
            <?php foreach ($category as $val) : ?>
                <li style="margin-left: <?=48*$val['level'];?>px; font-size: <?=(36-$val['level']*5)>16 ? 36-$val['level']*5 : 16;?>px;">
                    <a href="?controller=post&action=all&cid=<?=$val['id'];?>"><?=$val['group_name'];?></a>
                    <span  style="font-size: <?=(30-$val['level']*5)>16 ? 30-$val['level']*5 : 16;?>px;">(<?=$val['total_posts'] > 1 ? $val['total_posts'].' posts' : $val['total_posts'].' post';?>)</span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>