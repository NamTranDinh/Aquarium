if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

$(function () {
  load_secondary_list("event");
  load_secondary_list("animal");
  OnEnter("#global-search-inp", searchGlobal);
  if (
    findHref("&action=all") ||
    findHref("?controller=cart") ||
    findHref("?controller=about") ||
    findHref("?controller=search") ||
    findHref("&action=categories") ||
    findHref("?controller=contact") ||
    findHref("?controller=account")
  ) {
    $(".main_nav").addClass("nav_active");
  } else {
    if ($(document).scrollTop() != 0) {
      $(".main_nav").addClass("nav_active");
    }
    $(document).scroll(function () {
      if ($(document).scrollTop() != 0) {
        $(".main_nav").addClass("nav_active");
      } else {
        $(".main_nav").animate({ background: "" }, 250, function () {
          $(this).removeClass("nav_active");
        });
      }
    });
  }

  if (findHref("?controller=search")) {
    $('.search-link').click(function() {
      $('.search-submit').trigger('click');
    });
    getPage(".search_page", searchGlobal_paging);
  }
  if (findHref("?controller=post&action=all")) {
    OnEnter("#animalG_sText", search_animalG);
  }
  if (findHref("?controller=event&action=all")) {
    OnEnter("#event_sText", search_eventG);
    date_time_picker();
  }
  if (findHref("?controller=event")) {
    OnEnter('#comment', cre_comment);
    $(".time_ago").timeago();
  }

 
  $(document).mouseup(function (e) {
    // Đối tượng container chứa popup
    var container = $(".info .info-box");
    // Nếu click bên ngoài đối tượng container thì ẩn nó đi
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      container.fadeOut(200);
    }
  });
  // ========== start login ==========
  $('.btn-link[aria-expanded="true"]')
    .closest(".accordion-item")
    .addClass("active");
  $(".collapse").on("show.bs.collapse", function () {
    $(this).closest(".accordion-item").addClass("active");
  });

  $(".collapse").on("hidden.bs.collapse", function () {
    $(this).closest(".accordion-item").removeClass("active");
  });
  // ========== end login ==========
  // ========== start home =========
  var event_list = $(".event-list");
  var animal_list = $(".animal-list");
  $("#event-nav").hover(
    function () {
      event_list.stop().fadeIn(600);
      $(".secondary-list").stop().animate({ left: '-250px' }, 300);
    },
    function () {
      if ($("#animal-nav").is(":hover")) {
        event_list.stop().hide();
        $(".secondary-list").css("left", "-480px")
        animal_list.stop().slideDown();
      }else{
        event_list.stop().hide(200);
      }
    }
  );
  $("#animal-nav").hover(
    function () {
      animal_list.stop().fadeIn(600);
      $(".secondary-list").stop().animate({ left: '-250px' }, 300);
    },
    function () {
      if ($("#event-nav").is(":hover")) {
        animal_list.stop().hide();
        $(".secondary-list").css("left", "-20px")
        event_list.stop().slideDown();
      }else{
        animal_list.stop().hide(200);
      }
    }
  );

  // ========== end home =========
  // ========== start single-event =========
  $("button.event-modal").click(function () {
    $("body").css("overflow", "hidden");
    Show(".get-ticket-box", 300);
  });
  $("button.header_close").click(function () {
    $("body").css("overflow", "");
    Hide(".get-ticket-box", 300);
  });

  // ========== end single-event =========
 
  // ============== start about ============  
  $('.circle_icon').click(function(){
    $('.second_qst').slideToggle();
  });
  $('.circle_icon2').click(function(){
    $('.second_qst2').slideToggle();
  });
  $('.circle_icon3').click(function(){
    $('.second_qst3').slideToggle();
  });
  // ============== end about ============ 
  
});
 

  

