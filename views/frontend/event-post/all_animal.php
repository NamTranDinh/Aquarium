<div class="row title">
    <h1>Animal Guide</h1>
</div>
<div style="margin-top: 32px; position: relative;">
    <div class="row" style="padding: 32px 0 16px; background-color: #EFF5FF; display: flex; align-items: center;">
        <div class="col-md-12">
            <div class="form-group row">
                <div class="col-md-8" style="display: flex;">
                    <input type="text" id="animalG_sText" class="form-control" placeholder="Search" style="font-size: 18px; font-weight: 650;">
                    <button onclick="search_animalG()" type="button" class="btn btn-success">Search</button>
                </div>
                <div class="col-md-4">
                    <select oninput="search_animalG()" class="form-control" id="animalG_sCate">
                        <option value="-1">Filter by Category</option>
                        <?php foreach ($category as $val) : ?>
                            <option <?= $cate_id == $val['id'] ? 'selected' : ''; ?> value="<?= $val['id']; ?>"><?= ($val['level'] > 0 ? '|' : '') . str_repeat('&mdash; ', $val['level']) . $val['group_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="load_animate" style="position: absolute; top: 200px; left: 50%; transform: translateX(-50%);"></div>
    <div id="animal-guide_all">
        <?php if ($count > 0) : ?>
            <div class="row">
                <h2 style="margin: 72px 0 36px;">Results <span class="counter">(<?= $count ?? 0; ?>)</span></h2>
            </div>
            <div class="row">
                <div style="display: none;" id="page_dt" total='<?= $count ?? 0; ?>' limit='<?= ANIMAL_GUIDE_LIMIT; ?>' lastId='<?= count($data) ?? 0; ?>'></div>
                <ul class="all-guide" id="animal-guide">
                    <?php foreach ($data as $val) : ?>
                        <li>
                            <a href="?controller=post&id=<?= $val['sea_id']; ?>" class="item-guide">
                                <div class="photo">
                                    <img width="100%" src="<?= $val['sea_sub_img']; ?>">
                                </div>
                                <div class="wrapper">
                                    <h3 class="name"><?= $val['sea_name']; ?></h3>
                                    <span class="category"><?= $val['group_name']; ?></span>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if (count($data) < $count) : ?>
                    <div class="load_more">
                        <div class="load"></div>
                        <button onclick="load_more_animalG();" class="btn btn-warning">Load More ...</button>
                    </div>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <div class="row">
                <h3 style="margin: 24px 0">No have data !</h3>
            </div>
        <?php endif; ?>
    </div>
</div>
