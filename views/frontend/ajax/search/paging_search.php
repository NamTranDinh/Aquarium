<?php if (count($data_search) > 0) : ?>
    <?php foreach ($data_search as $val) : ?>
        <a class="result item-with-border-overlay" href="<?= $val['event'] == 1 ? '?controller=event&id=' . $val['id'] : '?controller=post&id=' . $val['id']; ?>">
            <div class="photo"> <img width="250" height="175" src="<?= $val['img']; ?>" alt=""></div>
            <div class="text">
                <span class="post-type"><?= $val['event'] == 1 ? 'EVENT' : 'ANIMAL'; ?></span>
                <h4 class="post-name"><?= $val['name'] ?? ''; ?></h4>
                <p class="excerpt"><?= $val['excerpt'] ?? ''; ?></p>
                <span class="learn-more">Learn More</span>
            </div>
        </a>
    <?php endforeach; ?>
    <?php if ($paging_search->total_page > 1) : ?>
        <div style="margin: 1rem 0;">
            <?php $paging_search->getPage('ajax', 'search_page'); ?>
        </div>
    <?php endif; ?>
<?php else : ?>
    <h3 class="no-results">Sorry, we couldn't find any content matching "<?= htmlentities($_GET['s']) ?? ''; ?>"</h3>
<?php endif; ?>