<header id="main_header">
    <div id="toast" class="notice"></div>
    <div class="header-global">
        <div class="logo">
            <a href="/Aquarium/views/frontend"><img height="46px" src="/Aquarium/public/templates/image/aquarium_Logo-1.png" alt=""></a>
        </div>
        <div class="nav">
            <div class="global-search-form">
                <input type="search" class="search-form" id="global-search-inp" placeholder="search" value="<?= isset($_GET['s'])? htmlentities($_GET['s']):'';?>" style="display: none;">
                <a onclick="searchGlobal();" class="top-bar_hov" style="color: whitesmoke;"><i class="fas fa-search"></i></a>
            </div>
            <div id="global-checkOut" style="display: flex;">
                <?php if (isset($_SESSION['cus_id'])) : ?>
                    <div class="info" onclick="FadeIn('.info .info-box', 200);">
                        <?php if (!empty($_SESSION['cart'])) : ?>
                            <span class="order_notice-quantity" style="left: -5px;"><?= count($_SESSION['cart']) ?></span>
                        <?php endif; ?>
                        <figure class="nav-bar_userImg">
                            <img class="user_avatar" src="<?= $_SESSION['avatar'] ?? '/Aquarium/public/templates/upload/avatar/default-avatar.png'; ?>" alt="IMG">
                        </figure>
                        <div class="info-box">
                            <div>
                                <div class="info-head">
                                    <div>
                                        <figure class="nav-bar_userImg">
                                            <img class="user_avatar" src="<?= $_SESSION['avatar'] ?? '/Aquarium/public/templates/upload/avatar/default-avatar.png'; ?>" alt="">
                                        </figure>
                                    </div>
                                    <div class="cus_name"><?= $_SESSION['cus_name']; ?></div>
                                </div>
                                <div class="info-bot">
                                    <a href="?controller=cart"><i class="fas fa-cart-arrow-down" style="color: orange;"></i>&nbsp;&nbsp;<span>CHECK OUT</span><?= isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 ? '<i class="fas fa-circle"></i>' : ''; ?></a>
                                    <a href="?controller=account"><i class="fas fa-cog" style="color: #0a9928;"></i>&nbsp;&nbsp;<span>YOUR ACCOUNT</span></a>
                                    <a href="?controller=auth&action=logout"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;<span>LOGOUT</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="check-out">
                        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) : ?>
                            <span class="order_notice-quantity" style="right: 2px; padding: 2px 6px;"><?= count($_SESSION['cart']) ?></span>
                        <?php endif; ?>
                        <a href="?controller=cart" class="top-bar_hov"><span>CheckOut</span> <i class="fas fa-cart-arrow-down"></i></a>
                    </div>
                    <div class="login"><a href="?controller=auth" class="top-bar_hov"><span>LOGIN</span> <i class="fas fa-sign-in-alt"></i></a></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>