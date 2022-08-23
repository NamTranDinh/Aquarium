<div class="event-container">
    <div class="event-top" id="event_detail" style="background-image: url('<?= $data['event_img'] ?>'); ">
        <div class="event-title">
            <div class="text text-light">
                <h1><?= $data['event_name'] ?></h1>
                <h3><?= $data['event_intro'] ?></h3>
                <div class="sideblock-actions" style="width: 200px; height: 70px;"><button class="event-modal btn btn-default">Get Tickets</button></div>
            </div>
        </div>
    </div>

    <div class="grid event-content" id="event_detail-content">
        <div class="row no-gutters">
            <div class="col-md-9">
                <?php foreach ($description as $val) : ?>
                    <div class="event-des">
                        <div class="event_content-des" style='display: flex; align-items: center;'>
                            <div class="" style="width: <?= !empty($val['des_img']) ? '62%' : '100%'; ?>;">
                                <h2><?= $val['des_name'] ?? ''; ?></h2>
                                <p style="font-size: 1.2rem !important;"><?= $val['des_content'] ?? ''; ?></p>
                            </div>
                            <div style="display: <?php echo !empty($val['des_img']) ? 'flex' : 'none'; ?>; width: 35%;">
                                <img width="100%" height="317.09" src="<?= $val['des_img']; ?>" style="box-shadow: 4px 4px 0 3px #764b4b;">
                            </div>
                        </div>
                    </div>
                <?php
                endforeach; ?>
                <div style="min-height: 505px;">
                    <h2 style="margin-top: 36px; margin-left: -20px;">Event location</h2>
                    <hr>
                    <div style="display: flex; justify-content: center; align-content: center;">
                        <iframe src="https://maps.google.com/maps?q=<?= str_replace(' ', '+', $data['locations']); ?>&output=embed" width="400" height="400" frameborder="0"></iframe>
                    </div>
                    <hr style="margin-top: 25px; margin-bottom: 0;">
                </div>

                <div id="main_feedback">
                    <h2 style="margin-left: -20px;">Comment</h2>
                    <div class="feed_back">
                        <div class="num_cmt_sort">
                            <span style="font-weight: bold;"><span class="total_comment"><?=$total??0;?></span> Comment</span>
                        </div>
                        <input type="hidden" name="" id="event_id" value='<?=$_REQUEST['id'];?>'>
                        <?php if (isset($_SESSION['cus_id'])) : ?>
                            <div class="box-comment">
                                <figure class="comment_ava">
                                    <img src="<?= $_SESSION['avatar'] ?? '/Aquarium/public/templates/upload/avatar/default-avatar.png'; ?>" style="border-radius: 50%;">
                                </figure>
                                <div class="my_cmt">
                                    <input id="comment" class="form-control " type="text" placeholder="Write Comment...">
                                </div>
                            </div>
                        <?php endif; ?>
                        <div id="box_comment-view">
                        <?php foreach ($comment_data as $val) : ?>
                            <div class="ava_name_cmt" id="cmt-<?=$val['id']?>">
                                <figure class="comment_ava">
                                    <img src="<?= $val['avatar']?? '/Aquarium/public/templates/upload/avatar/default-avatar.png'; ?>" style="border-radius: 50%;">
                                </figure>
                                <div class="name_cmt">
                                    <p class="name"><?=$val['cus_name'];?></p>
                                    <p class="content_cmt"><?=$val['comment'];?></p>
                                    <span class="time_ago_cmt"><time class="time_ago" datetime="<?= date_format(date_create($val['created']), 'Y-m-d H:i:s') ?? ''; ?>"> </time></span>
                                    <?php if(isset($_SESSION['cus_id']) && $val['customer_id'] == $_SESSION['cus_id']):?>
                                        <span onclick="del_comment(<?=$val['id'];?>);" class="del_cmt">Delete</span>
                                    <?php endif;?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <?php if($total > 3):?>
                            <div onclick="view_more_comment();" class="view_more">View all comments.</div>
                        <?php endif;?>
                    </div>
                </div>
            </div>


            <div class="col-md-3" id="event_base">
                <aside class="sideblock">
                    <div class="sideblock-wrap">
                        <div class="max-height-wrap">
                            <header class="sideblock-header">
                                <h3>Event Details</h3>
                                <hr>
                            </header>
                            <div class="sideblock-sub-block">
                                <span class="sideblock-thin-heading">Date &amp; Time</span>
                                <div class="sideblock-fatty">
                                    <p>Begin</p>
                                    <p><strong><?= date_format(date_create($data['time_start']), 'F j, Y, g:i a') ?></strong></p>
                                </div>
                                <div class="sideblock-fatty">
                                    <p>End</p>
                                    <p><strong><?= date_format(date_create($data['time_end']), 'F j, Y, g:i a') ?></strong></p>
                                    <hr>
                                </div>
                            </div>
                            <div class="sideblock-sub-block">
                                <span class="sideblock-thin-heading">Price</span>
                                <div class="pricing-manual">
                                    <div>
                                        <p>General Admission: &nbsp;$<strong><?= $data['ticket_price'] ?? ''; ?></strong></p>
                                        <p>VIP Admission: &nbsp;$<strong><?= $data['ticket_price'] + 20 ?? ''; ?></strong><br></p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="sideblock-sub-block"> <span class="sideblock-thin-heading">Location: </span> <strong><?= $data['locations'] ?? ''; ?>
                                    <hr>
                                </strong></div>
                            <footer class="sideblock-actions"> <button class="event-modal btn btn-default">Get Tickets</button></footer>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <div class="get-ticket-box" style="display: none;">
        <div class="modal-wrap" tabindex="-1"></div>
        <div class="modal_container">
            <div id="event-ticket-modal" class="event-ticket-modal">
                <button onclick="remove_error('.get_tik-error')" class="btn close header_close">x</button>
                <header class="header">
                    <h3>Get Tickets</h3>
                </header>
                <div class="form-inputs">
                    <div class="ticket-spinners">
                        <div class="form-input-quantity">
                            <label><strong>General</strong><span class="price">$<?= $data['ticket_price']; ?></span></label>
                            <div class="form-counter">
                                <button class="btn btn-default ticket-general-minus hover-change"><i class="fas fa-minus"></i></button>
                                <input class="spinner-value zero" id="ticket-general-value" disabled type="text" value="0">
                                <button onclick="remove_error('.get_tik-error')" class="btn btn-default ticket-general-plus hover-change"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="form-input-quantity">
                            <label><strong>VIP Ticket</strong><span class="price">$<?= $data['ticket_price'] + 20; ?></span></label>
                            <div class="form-counter">
                                <button class="btn btn-default ticket-vip-minus hover-change"><i class="fas fa-minus"></i></button>
                                <input class="spinner-value zero" id="ticket-vip-value" disabled type="text" value="0">
                                <button onclick="remove_error('.get_tik-error')" class="btn btn-default ticket-vip-plus hover-change"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div style="color: red; font-weight: 600; margin-bottom: -15px;" class="get_tik-error"></div>
                    <input type="hidden" name="" id="max_num" value="<?= $data['ticket_num']; ?>">
                    <button onclick="submit_addToCard(<?= $data['id']; ?>, <?= $data['ticket_price']; ?>);" class="btn btn-warning btn-large add-card">Add To Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>