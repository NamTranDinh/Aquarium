<div class="event-container">
    <div class="event-top" style="background-image: url('<?=$data['sea_img']?>');">
        <div class="event-title">
            <div class="text text-light">
                <h1><?= $data['sea_name'] ?></h1>
                <h3><?= $data['group_name'] ?></h3>
                <p style="font-size: 1.2rem;"><?= $data['sea_info'] ?></p>
            </div>
        </div>
    </div>
    <div class="event-content" id="event-content">
        <?php
        foreach ($description as $val) :
        ?>
            <div class="event_content-des">
                <h2><?= $val['des_name'] ?? ''; ?></h2>
                <p><?= $val['top_content'] ?? ''; ?></p>
                <?php if ($val['img'] != '') : ?>
                    <div style="text-align: center; padding: 16px;"><img width="50%" src="<?= $val['img']; ?>"></div>
                <?php endif; ?>
                <p><?= $val['bot_content'] ?? ''; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <div style="margin-top: 36px; display: flex; flex-direction: column; align-items: center;">
        <h5>BY: <?=$data['name']??'ADMIN';?></h5>
        <p><?=$data['created'];?></p>
    </div>
</div>