<div class="header__left col-md-6 col-sm-6 col-xs-6">
    <div class="header__icon" id="header-open-nab">
        <i class="fas fa-bars"></i>
    </div>
    <div class="header__logo">
        <a href="/Aquarium/views/backend/"><img src="../../public/templates/image/admin_logo.png" alt="AdminLogo"></a>
    </div>
</div>
<div class="header__right col-md-6 col-sm-6 col-xs-6">            
    <div class="header__account">                            
        <a href="#" id="header-open-menu" class="dropdown-toggle header__account-info" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><span class="hello">Hello, <?=$_SESSION['username']??'';?></span></a>
        <ul class="dropdown-menu header__account-menu" id="header-menu">
            <li><a href="/Aquarium/views/backend/?controller=account"><i class="fa fa-user"></i>&nbsp;Account</a></li>
            <li><a href="/Aquarium/views/backend/?controller=user&action=logout"><i class="fa fa-power-off"></i>&nbsp;Logout</a></li>
        </ul>            
    </div>    
</div>