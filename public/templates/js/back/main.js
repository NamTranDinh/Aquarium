if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
$(function() {
    date_time_picker();
    if (window.location.href.indexOf('?controller=post') !== -1) {
        $('li#post a').addClass('nav__active');
        getPage('.page_posts', post_paging);
    }else if(window.location.href.indexOf('?controller=event') !== -1) {
        $('li#event a').addClass('nav__active');
        getPage('.page_event', event_paging);
    }else if(window.location.href.indexOf('?controller=feedback') !== -1) {
        $('li#feedback a').addClass('nav__active');
    }else if(window.location.href.indexOf('?controller=contact') !== -1) {
        $('li#contact a').addClass('nav__active');
    }else if(window.location.href.indexOf('?controller=customer') !== -1) {
        $('li#customer a').addClass('nav__active');
        getPage('.cus_page', cus_paging);
    }else if(window.location.href.indexOf('?controller=orders') !== -1) {
        $('li#orders a').addClass('nav__active');
        getPage('.orders_page', order_paging);
        status_change_bg();
        checkSearch_order();
        load_ord_notice();
    }else if(window.location.href.indexOf('?controller=revenue') !== -1) {
        $('li#revenue a').addClass('nav__active');
        var $search = window.location.search;
        var $page = 1;
        if($search.indexOf('&page=') !== -1){
            $page = $search.split("=")[2];
        }
        revenue_paging(Number($page));
    }else if(window.location.href.indexOf('?controller=setting') !== -1) {
        $('li#config a').addClass('nav__active');
        getPage('.setting_page-user', paging_staff);
        getPage('.setting_page-group', paging_staff_group);
    }else{
        $('li#dashboard a').addClass('nav__active');
    }

    /** ========= Start HEADER ============ */

    $("#header-open-nab").click(function() {
        if($("#content__left").is(':visible')){
            $("#content__left").hide();
            $("#content__right").toggleClass('col-md-10, col-md-12').css('padding','0 15px');
        }else{
            $("#content__left").show(200);
            $("#content__right").toggleClass('col-md-10, col-md-12').css('padding','0 15px');
        }
    });
     
    $("#header-open-menu").click(function() {
        if($('#header-menu').is(':visible')) $("#header-menu").hide(200);
        else $("#header-menu").show(200);
    });
    $(document).mouseup(function (e) {
        // Đối tượng container chứa popup
        var container = $("#header-menu, .chose_orders");
        // Nếu click bên ngoài đối tượng container thì ẩn nó đi
        if (!container.is(e.target) && container.has(e.target).length === 0){
            container.hide(200);
        }
    });
    $(document).mouseup(function (e) {
        // Đối tượng container chứa popup
        var container = $(".order_notice-content, .change_status_ord");
        // Nếu click bên ngoài đối tượng container thì ẩn nó đi
        if (!container.is(e.target) && container.has(e.target).length === 0){
            container.fadeOut(200);
        }
    });
    
   
    /**========= End HEADER =============*/

    /**========= Start LOGIN =============*/
    $("#log_submit").addClass('disabled');
    $("#log_user").blur(function(){
        if($(this).val().trim() == ''){
            $(this).val('');
            $(".user_validate").show().html('Please fill in this field.').addClass('form_validate-error');
        } else{
            $(".user_validate").hide();
        }
    });
    $("#log_pass").blur(function(){       
        if($(this).val().trim() == ''){
            $(this).val('');
            $(".pass_validate").show().html('Please fill in this field.').addClass('form_validate-error');
        } else{
            $(".pass_validate").hide();
        }
    });
    $("#log_user, #log_pass").on('input', function(){
        if($("#log_user").val().trim() != '') $(".user_validate").hide();
        if($("#log_pass").val().trim() != '') $(".pass_validate").hide();
        if($("#log_user").val().trim() != '' && $("#log_pass").val().trim() != ''){            
            $("#log_submit").removeClass('disabled');
        } 
    });
    /**========= End LOGIN =============*/

    /**========= start account =============*/
    $("#oldpass").on('input', function() {
        $("#oldpass_wrong").html('');
        $(this).removeClass('widget-red');
    });
    $("#newpass").on('input', function() {
        $("#newpass_warm").html('');
        $(this).removeClass('widget-red');
    });
    $("#renewpass").on('input', function() {
        $("#newpass_wrong").html('');
        $(this).removeClass('widget-red');
    });
    
    /**========= end account =============*/

    /**========= start setting =============*/
    // ---- staff ---------
    $('#btn-add_staff').click(function() {
        $("#setting_overlay").fadeIn(300);
        $(".setting_add_account").show().animate({
            'top': "104px",            
            'opacity': "1"
        }, 200);
    });
    $(".btn_close-addUser").click(function() {
        $("#setting_overlay").fadeOut(300);
        $(".setting_add_account").animate({
            'top': "-20%",
            'opacity': "0.4"
        }, 300, function() {
            $(this).fadeOut(100)
        });        
    });
    // --------- staff group ---------
    $("#btn_open-addGr").click(function() {
        $("#setting_overlay").fadeIn(200);
        $(".setting_addGr").show().animate({
            'top': "30vh",            
            'opacity': "1"
        }, 200);
    });
    $(".btn_close-addGr").click(function() {      
        $("#setting_overlay").fadeOut(200);
        $(".setting_addGr").animate({
            'top': "5vh",
            'opacity': "0.2"
        }, 350, function() {
            $(this).fadeOut(150)
        });
    });     
    /**========= end setting =============*/
    
    
    /**========= start orders =============*/
   

    /**========= end orders =============*/
    

});

function deleteContact($id){
		var conf = 'Do u want to delete this contact?';
		if(confirm(conf)){
			var url = '?controller=contact&action=DeleteDataContact&id='+$id;
			location = url;
		}
	}  
function deleteFeedback($id) {
	var conf = 'Do you want to delete this feedback??'
	if(confirm(conf)){
		var url = '?controller=feedback&action=DeleteDataFeedback&id='+$id;
		location = url;
	}
}