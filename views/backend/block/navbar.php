<?php $per = isset($_SESSION['permission']) ? (int)($_SESSION['permission']) : 0;?>
    
<ul class="nav nav-pills nav-list nav-stacked content__left-bar">
    <?php if($per >= 1):?>  <li id="dashboard">     <a href=""><i class="fab fa-gg-circle"></i><b>Dashboard</b></a></li> <?php endif;?>
    <?php if($per >= 3):?>  <li id="post">          <a href="?controller=post"><i class="far fa-list-alt"></i><b>Post management</b></a></li> <?php endif;?>
    <?php if($per >= 3):?>  <li id="event">         <a href="?controller=event"><i class="fas fa-dungeon"></i><b>Event management</b></a></li> <?php endif;?>
    <?php if($per >= 3):?>  <li id="feedback">      <a href="?controller=feedback"><i class="fab fa-bootstrap"></i><b> Feedback</b></a></li> <?php endif;?>
    <?php if($per >= 3):?>  <li id="contact">       <a href="?controller=contact"><i class="far fa-copyright"></i><b>Contact</b></a></li> <?php endif;?>
    <?php if($per >= 6):?>  <li id="customer">      <a href="?controller=customer"><i class="fas fa-users" style="padding: 0 10px;"></i><b>Customer</b></a></li> <?php endif;?>
    <?php if($per >= 6):?>  <li id="orders">        <a href="?controller=orders"><i class="fas fa-cart-arrow-down"></i><b>Orders</b></a></li> <?php endif;?>
    <?php if($per == 10):?> <li id="revenue">       <a href="?controller=revenue"><i class="fab fa-connectdevelop"></i><b>Revenue</b></a></li> <?php endif;?>
    <?php if($per == 10):?> <li id="config">        <a href="?controller=setting"><i class="fab fa-empire" style="padding: 0 13px;"></i><b>Setting</b></a></li> <?php endif;?>
</ul>