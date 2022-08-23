function goBack() {
  window.history.back();
}
function htmlEntities(str) {
  return String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&lsquo;");
}
function validateEmail(email) {
  const re =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}
/** REGEX */
var usernameRegex = /^[a-zA-Z0-9]+$/;
var DMY = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
var YMD = /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/;
var timeReg = /([01]?[0-9]|2[0-3]):[0-5][0-9]/;
var numReg = /^([1-9][0-9]*)$/;
/** REGEX */
/** CONST */
const TIME_LOAD = 300;
/** CONST */

function date_time_picker() {
  $(".datepicker").datepicker({
    format: "dd/mm/yyyy",
    // format: "yyyy-mm-dd"
  });
  $(".timepicker").timepicker({
    timeFormat: "HH:mm",
    interval: "30",
    startTime: new Date(0, 0, 0, 6, 0, 0),
    minHour: 00,
    maxHour: 23,
  });
}
/**
 * Func call page
 * @param {*} $id Tên class of id của btn page
 * @param {*} $funcName hàm phân trang đã đc viết từ trc
 * @param {*} action click, dbclick, hover, ....
 */
function getPage($id, $funcName, action = "click") {
  $($id).on(action, function () {
    $funcName($(this).val());
  });
}
function removeSpace(str) {
  return String(str).replace(/&nbsp;/g, " ");
}
/**
 * @param {*} $id_label
 * chuyền vào id của cái lable mà tham chiếu đến cái input có type = file
 */
function getFileName($id_label) {
  var id_input = "#" + $($id_label).attr("for");
  $file = $(id_input)[0].files;
  if ($file.length > 0) $($id_label).html($(id_input)[0].files[0].name);
  else $($id_label).html("Chose image to upload.");
}
function remove_error(id_class) {
  $(id_class).html("");
}
function Show(id_class, time = 0) {
  $(id_class).show(time);
}
function Hide(id_class, time = 0) {
  $(id_class).hide(time);
}
function Toggle(id_class, time = 0) {
  $(id_class).toggle(time);
}
function FadeIn(id_class, time = 0) {
  if ($(id_class).is(":hidden")) $(id_class).fadeIn(time);
}
function FadeOut(id_class, time = 0) {
  if ($(id_class).is(":visible")) $(id_class).fadeOut(time);
}
function loading($time) {
  $("#animate-rotate").show(300);
  $("body").css("overflow", "hidden");
  setTimeout(function () {
    $("#animate-rotate").hide(300);
    $("body").css("overflow", "");
    return;
  }, $time);
}
function unloading($time = 0) {
  setTimeout(function () {
    $("#animate-rotate").hide(300);
    $("body").css("overflow", "");
  }, $time);
}
function loading_rotate(id_class, time) {
  var rotate_ele = $("#animate-rotate #ani-rotate").addClass("rotate-no-fixed");
  $(id_class).show().append(rotate_ele);
  setTimeout(function () {
    $(id_class).fadeOut();
  }, time);
}
function OnEnter(id_class, $funcName) {
  $(id_class).keydown(function (e) {
    if (e.keyCode === 13) {
      $funcName();
    }
  });
}
function findHref($str) {
  if (window.location.href.indexOf($str) !== -1) return true;
  return false;
}
function redirect_login() {
  var url_redirect = window.location.href;
  $data = {
    ajax: "redirect_login",
    url: url_redirect,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".main_content").html(data);
    },
  };
  adapter_ajax($param);
}
function showMessesTrue(id, data) {
  $notice = $(id);
  data = htmlEntities(data);
  $notice
    .html(data)
    .css("top", "105px")
    .show()
    .addClass("box-green")
    .removeClass("box-red")
    .animate({ right: "3px", opacity: 1 }, 300, function () {
      $(this).click(function () {
        $(this).fadeOut(100);
      });
    });
  setTimeout(function () {
    $notice.fadeOut(1000).animate({
      right: "-100%",
      opacity: 0.2,
    });
  }, 2000);
}
function showMessesWrong(id, data) {
  $notice = $(id);
  data = htmlEntities(data);
  $notice
    .html(data)
    .css("top", "105px")
    .show()
    .addClass("box-red")
    .removeClass("box-green")
    .animate({ right: "3px", opacity: 1 }, 300, function () {
      $(this).click(function () {
        $(this).fadeOut(100);
      });
    });
  setTimeout(function () {
    $notice.fadeOut(1000).animate({
      right: "-100%",
      opacity: 0.2,
    });
  }, 2000);
}
/*
  * Process ajax request
  *
  * $param là một object {'type','url', 'data', 'callback'}
  *
  * default type POST
  /*********************************************************************/
var url = "/Aquarium/views/frontend/ajax.php";
function adapter_ajax($param) {
  $.ajax({
    url: $param.url,
    type: $param.type,
    data: $param.data,
    async: true,
    success: $param.callback,
  });
}
function adapter_ajax_with_file($param) {
  $.ajax({
    url: $param.url,
    type: $param.type,
    data: $param.data,
    contentType: false,
    processData: false,
    success: $param.callback,
  });
}
/******************** start auth ********************/
function load_login() {
  $data = { ajax: "load_login" };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".auth_container").html(data);
    },
  };
  adapter_ajax($param);
}
function load_registration() {
  $data = { ajax: "load_registration" };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".auth_container").html(data);
    },
  };
  adapter_ajax($param);
}
function find_account() {
  $data = { ajax: "find_account" };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".auth_container").html(data);
      $("#identify_email").select();
      OnEnter("#identify_email", confirm_account);
    },
  };
  adapter_ajax($param);
}
function confirm_account() {
  var $email = $("#identify_email").val().trim();
  if ($email.length == 0) {
    $(".identify_email-error").html("Email required");
    $("#identify_email").select();
    return false;
  }
  if (!validateEmail($email)) {
    $(".identify_email-error").html("Email is wrong syntax");
    $("#identify_email").select();
    return false;
  }
  $data = {
    ajax: "confirm_account",
    email: $email,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      loading(700);
      setTimeout(function () {
        $(".auth_container").html(data);
      }, 700 + TIME_LOAD);
    },
  };
  adapter_ajax($param);
}
function send_mail() {
  loading(9999);
  $info = $("#info_data").val();
  $data = {
    ajax: "send_mail",
    data: $info,
  };

  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      unloading();
      $(".auth_container").html(data);
      OnEnter("#veri_code", check_code);
    },
  };
  adapter_ajax($param);
}
function check_code() {
  var $token = $("#veri_code").val().trim();
  var $email = $("#veri_email").val();
  var num = /^[0-9]{6}$/;

  if(!num.test($token)){
    $(".very_code-error").html('Verification incorrect');
    $('#veri_code').focus();
    return;
  }

  $data = {
    ajax: "check_code",
    token: $token,
    email: $email,
  };

  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      if (data.indexOf("Verification incorrect") !== -1) {
        $(".very_code-error").html(data);
      } else {
        loading(700);
        setTimeout(function () {
          $(".auth_container").html(data);
          OnEnter("#renew-pass", reset_pass);
        }, 700 + TIME_LOAD);
      }
    },
  };
  adapter_ajax($param);
}
function reset_pass() {
  var $new_pass = $("#new-pass").val();
  var $renew_pass = $("#renew-pass").val();
  var $email = $("#veri_email").val();
  var $token = $("#veri_token").val();
  var new_err = $(".new_pass-error");
  var renew_err = $(".renew_pass-error");
  if ($new_pass.length < 6) {
    new_err.html("Password length > 6");
    return false;
  }
  if ($renew_pass.length < 6) {
    renew_err.html("Password length > 6");
    return false;
  }
  if ($new_pass != $renew_pass) {
    renew_err.html("Password is not the same");
    $("#renew-pass").select();
    return false;
  }
  $data = {
    ajax: "reset_pass",
    token: $token,
    email: $email,
    new_pass: $new_pass,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      loading(700);
      setTimeout(function () {
        $(".auth_container").html(data);
      }, 700 + TIME_LOAD);
    },
  };
  adapter_ajax($param);
}
function register_check_username() {
  var $user_name = $("#user-name").val().trim();
  if ($user_name.length == 0) {
    setTimeout(function () {
      $(".user-name-error").html("Enter your user name");
    }, 500);
    return false;
  }
  if (!usernameRegex.test($user_name)) {
    setTimeout(function () {
      $(".user-name-error").html(
        "Accounts must not contain special characters."
      );
    }, 500);
    return false;
  }

  $data = {
    ajax: "register_check_username",
    username: htmlEntities($user_name),
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      setTimeout(function () {
        remove_error(".user-name-error");
        if (data == 0) {
          $(".user-name-error").html("This account is already in use.");
        }
      }, 600);
    },
  };
  adapter_ajax($param);
}
function register_check_email() {
  var $email = $("#email").val().trim();
  if (!validateEmail($email) && $email) {
    setTimeout(function () {
      $(".email-error").html("Email is wrong syntax");
    }, 600);
    return false;
  }
  if ($email.length == 0) {
    setTimeout(function () {
      $(".email-error").html("Enter your email");
    }, 500);
    return false;
  }
  $data = {
    ajax: "register_check_email",
    email: htmlEntities($email),
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      setTimeout(function () {
        remove_error(".email-error");
        if (data == 0) {
          $(".email-error").html(
            "Email already in use, please choose another email."
          );
        }
      }, 600);
    },
  };
  adapter_ajax($param);
}
function register_account() {
  var $cus_name = $("#cus-name").val().trim();
  var $user_name = $("#user-name").val().trim();
  var $email = $("#email").val().trim();
  var $password = $("#password").val();
  var $confirm_password = $("#confirm-password").val();

  if ($cus_name.length == 0) {
    $(".cus-name-error").html("Enter your name");
    $("#cus-name").select();
    return false;
  }
  if ($user_name.length == 0) {
    $(".user-name-error").html("Enter your user name");
    $("#user-name").select();
    return false;
  }
  if ($email.length == 0) {
    $(".email-error").html("Enter your email");
    $("#email").select();
    return false;
  }
  if ($password.length == 0) {
    $(".password-error").html("Enter password");
    $("#password").select();
    return false;
  }
  if ($password.length < 6) {
    $(".password-error").html("Password length > 6");
    $("#password").select();
    return false;
  }
  if ($confirm_password.length == 0) {
    $(".confirm-password-error").html("Re enter password");
    $("#confirm-password").select();
    return false;
  }
  if ($confirm_password.length < 6) {
    $(".confirm-password-error").html("Password length > 6");
    $("#confirm-password").select();
    return false;
  }
  if ($password != $confirm_password) {
    $(".confirm-password-error").html("Password is not the same");
    $("#confirm-password").select();
    return false;
  }
  $data = {
    ajax: "register_account",
    cus_name: htmlEntities($cus_name),
    username: htmlEntities($user_name),
    email: htmlEntities($email),
    password: $password,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      if (String(data).trim() == "u_check") {
        $("#user-name").select();
      } else if (String(data).trim() == "e_check") {
        $("#email").select();
      } else {
        loading(1500);
        setTimeout(function () {
          $(".auth_container").html(data);
        }, 1500 + TIME_LOAD);
      }
    },
  };
  adapter_ajax($param);
}

/******************** end auth **********************/
/******************** start home **********************/
function searchGlobal() {
  var search_bar = $("#global-search-inp");
  if (search_bar.is(":hidden")) {
    search_bar.show(200);
    search_bar.select();
  } else {
    $search_text = $("#global-search-inp").val().trim();
    if ($search_text.length != 0) {
      location = '?controller=search&s='+$search_text.replaceAll(' ', '+');
    } else {
      search_bar.fadeOut(200);
    }
  }
}
function searchGlobal_paging($page = 1){
  $search_text = $('#search_global').val().trim();
  $data = {
    ajax: "searchGlobal_paging",
    page: $page,
    s: htmlEntities($search_text),
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".results-list").html(data);
      getPage(".search_page", searchGlobal_paging);
      window.history.pushState(null, null, "?controller=search&s="+$search_text+'&page='+$page);
    },
  };
  adapter_ajax($param);
}
function load_secondary_list($list_name) {
  $data = {
    ajax: "load_secondary_list",
    list_name: $list_name,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("." + $list_name + "-list").html(data);
    },
  };
  adapter_ajax($param);
}
/******************** end home **********************/
/******************** start Animal Guide **********************/
function check_load_moreBtn() {
  var $offset = $("#page_dt").attr("lastId");
  var $total = $("#page_dt").attr("total");
  if (Number($offset) >= Number($total)) {
    $(".load_more").html("");
  }
}
function load_more_animalG($check_search = 0) {
  var $limit = $("#page_dt").attr("limit");
  var $offset = $("#page_dt").attr("lastId");
  var $total = $("#page_dt").attr("total");
  var $search_text = "";
  var $category_id = -1;
  if (Number($check_search) != 0 || findHref("&cid")) {
    $search_text = $("#animalG_sText").val().trim();
    $category_id = $("#animalG_sCate").val();
  }

  $data = {
    ajax: "load_more_animalG",
    limit: Number($limit),
    offset: Number($offset),
    search_text: htmlEntities($search_text),
    category_id: Number($category_id),
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $offset = Number($limit) + Number($offset);
      $("#page_dt").attr("lastId", Number($offset));

      $(".load_more .btn").hide();
      loading_rotate(".load_more .load", TIME_LOAD);
      setTimeout(function () {
        $("#animal-guide").append(data);
        if (Number($offset) >= Number($total)) {
          $(".load_more").html("");
        } else {
          $(".load_more .btn").show();
        }
      }, Number(TIME_LOAD + 300));
    },
  };
  adapter_ajax($param);
}
function search_animalG() {
  if (findHref("&cid")) {
    window.history.pushState(null, null, "?controller=post&action=all");
  }

  var $search_text = $("#animalG_sText").val().trim();
  var $category_id = $("#animalG_sCate").val();

  $data = {
    ajax: "search_animalG",
    search_text: htmlEntities($search_text),
    category_id: Number($category_id),
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#animal-guide_all").hide();
      loading_rotate(".load_animate", TIME_LOAD);
      setTimeout(function () {
        $("#animal-guide_all").show().html(data);
        check_load_moreBtn();
      }, Number(TIME_LOAD + 300));
    },
  };
  adapter_ajax($param);
}
/******************** end Animal Guide **********************************/
/******************** start Event guide **********************************/
function load_more_eventG($check_search = 0) {
  var $limit = $("#page_dt").attr("limit");
  var $offset = $("#page_dt").attr("lastId");
  var $total = $("#page_dt").attr("total");
  var $search_text = "";
  var $date_start = "";
  var $date_end = "";

  if (Number($check_search) != 0) {
    $search_text = $("#event_sText").val().trim();
    $date_start = $("#inp-sStartDate").val().trim();
    $date_end = $("#inp-sEndDate").val().trim();
  }

  $data = {
    ajax: "load_more_eventG",
    limit: $limit,
    offset: $offset,
    search_text: htmlEntities($search_text),
    date_start: htmlEntities($date_start),
    date_end: htmlEntities($date_end),
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $offset = Number($limit) + Number($offset);
      $("#page_dt").attr("lastId", Number($offset));

      $(".load_more .btn").hide();
      loading_rotate(".load_more .load", TIME_LOAD);
      setTimeout(function () {
        $("#event-guide").append(data);
        if (Number($offset) >= Number($total)) {
          $(".load_more").html("");
        } else {
          $(".load_more .btn").show();
        }
      }, Number(TIME_LOAD + 300));
    },
  };
  adapter_ajax($param);
}
function search_eventG() {
  var $search_text = $("#event_sText").val().trim();
  var $date_start = $("#inp-sStartDate").val().trim();
  var $date_end = $("#inp-sEndDate").val().trim();
  $data = {
    ajax: "search_eventG",
    search_text: htmlEntities($search_text),
    date_start: htmlEntities($date_start),
    date_end: htmlEntities($date_end),
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#event-guide_all").hide();
      loading_rotate(".load_animate", TIME_LOAD);
      setTimeout(function () {
        $("#event-guide_all").show().html(data);
        check_load_moreBtn();
      }, Number(TIME_LOAD + 300));
    },
  };
  adapter_ajax($param);
}
/******************** end Event guide **********************/
/******************** start single event **********************/
function ticket_plus(id_class, inp_id, max = 999) {
  $(id_class).click(function () {
    var count = $(inp_id).val();
    if (count < max) {
      $(inp_id).val(Number(count) + 1);
    }
  });
}
function ticket_minus(id_class, inp_id, min = 0) {
  $(id_class).click(function () {
    var count = $(inp_id).val();
    if (count > min) {
      $(inp_id).val(count - 1);
    }
  });
}
function ticket_checkValue(
  box_id,
  id_plus,
  id_minus,
  inp_id,
  cls_remove,
  max = 999,
  min = 0
) {
  $(box_id).click(function () {
    var count = $(inp_id).val();
    if (count > min) {
      $(id_minus).addClass(cls_remove);
    } else {
      $(id_minus).removeClass(cls_remove);
    }
    if (count < max) {
      $(id_plus).addClass(cls_remove);
    } else {
      $(id_plus).removeClass(cls_remove);
    }
  });
}
/**
 *
 * @param {*} box_id khối tổng
 * @param {*} id_plus id or class của btn +
 * @param {*} id_minus id or class của btn -
 * @param {*} inp_id id or class của input chứa val
 * @param {*} cls_remove class này xem check dk để remove
 */
function ticket_plus_minus(
  box_id,
  id_plus,
  id_minus,
  inp_id,
  cls_remove,
  max = 999,
  min = 0
) {
  ticket_plus(id_plus, inp_id, max);
  ticket_minus(id_minus, inp_id, min);
  ticket_checkValue(box_id, id_plus, id_minus, inp_id, cls_remove, max, min);
}
$(function () {
  var max = Number($(".form-inputs #max_num").val());
  ticket_plus_minus(
    ".mfp-content",
    ".ticket-general-plus",
    ".ticket-general-minus",
    "#ticket-general-value",
    "hover-change",
    max
  );
  ticket_plus_minus(
    ".mfp-content",
    ".ticket-vip-plus",
    ".ticket-vip-minus",
    "#ticket-vip-value",
    "hover-change",
    max
  );
});
function submit_addToCard($event_id, $ticket_price = 99, check_mess = 0) {
  var $gen_num = $("#ticket-general-value").val();
  var $vip_num = $("#ticket-vip-value").val();

  if ($gen_num == 0 && $vip_num == 0) {
    $(".get_tik-error").html("Ticket can't not equal zero");
  } else {
    $data = {
      ajax: "submit_addToCard",
      event_id: $event_id,
      gen_num: $gen_num,
      vip_num: $vip_num,
      ticket_price: $ticket_price,
    };
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        $("#global-checkOut").html(data);
        $("body").css("overflow", "");
        Hide(".get-ticket-box", 300);
        if (check_mess == 0) {
          showMessesTrue("#toast", "You have successfully added!");
        }
        setTimeout(function () {
          $("#ticket-general-value").val(0);
          $("#ticket-vip-value").val(0);
          $(".info").click(function () {
            FadeIn(".info .info-box", 200);
          });
        }, 300);
      },
    };
    adapter_ajax($param);
  }
}
function view_more_comment() {
  $event_id = $("#event_id").val();
  $data = {
    ajax: "view_more_comment",
    event_id: $event_id,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#box_comment-view").append(data);
      $(".time_ago").timeago();
      $(".view_more").remove();
    },
  };
  adapter_ajax($param);
}
function cre_comment() {
  var $event_id = $("#event_id").val();
  var $comment = $("#comment").val().trim();
  var total_comment = $(".total_comment").html();
  $("#comment").addClass("disabled");
  if ($comment.length != 0) {
    $data = {
      ajax: "cre_comment",
      comment: htmlEntities($comment),
      event_id: $event_id,
    };
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        setTimeout(function () {
          $("#comment").val("");
          $("#box_comment-view").prepend(data);
          $(".total_comment").html(Number(total_comment) + 1);
          $(".time_ago").timeago();
          $("#comment").removeClass("disabled");
        }, 500);
      },
    };
    adapter_ajax($param);
  }
}
function del_comment($cmt_id) {
  var conf = 'Do you want delete this comment?'
  var total_comment = $(".total_comment").html();
  if(!confirm(conf)) return;
  $data = {
    ajax: "del_comment",
    cmt_id : $cmt_id,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function () {
      $('#cmt-'+$cmt_id).remove();
      $(".total_comment").html(Number(total_comment) - 1);
    },
  };
  adapter_ajax($param);
}
/******************** end single event **********************/

/******************** start cart **********************/
// cart
function change_num_ticket_cart($i, $event_id, $type) {
  var ticket_num = $(".tr-cart-item-" + $i + " td input");
  var price = $(".tr-cart-item-" + $i + " td span.price");
  var total_money = $(".tr-cart-item-" + $i + " td span.total_money");
  ticket = ticket_num.val();
  if (Number(ticket_num.val()) < 0 || Number(ticket_num.val()) == "") {
    ticket = 1;
    setTimeout(function () {
      ticket_num.val(1);
    }, 300);
  }
  if (Number(ticket_num.val()) > Number(ticket_num.attr("max"))) {
    ticket = Number(ticket_num.attr("max"));
    setTimeout(function () {
      ticket_num.val(Number(ticket_num.attr("max")));
    }, 300);
  }
  total_money.html(Number(ticket) * Number(price.html()));
  var total_all_cart = 0;
  $(".cart-item").each(function (index) {
    total = Number($(".cart-item td span.total_money-" + index).html());
    total_all_cart += total;
  });
  $(".total_all_cart").html(total_all_cart);
  var $data = {
    ajax: "change_num_ticket_cart",
    event_id: $event_id,
    type: $type,
    ticket_num: ticket,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: "",
  };
  adapter_ajax($param);
}
function del_cart_item($event_id, $type) {
  var conf = "Do you want delete this item ?";
  if (!confirm(conf)) {
    return false;
  }
  $data = {
    ajax: "del_cart_item",
    event_id: $event_id,
    type: $type,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#cart-table").hide();
      loading(1000);
      setTimeout(function () {
        submit_addToCard($event_id, 1, 1);
        showMessesTrue("#toast", "Successfully deleted!");
        $("#cart-table").show().html(data);
      }, 1000 + TIME_LOAD);
    },
  };
  adapter_ajax($param);
}
function del_cart_all() {
  var conf = "Do you want delete all item ?";
  if (!confirm(conf)) {
    return false;
  }
  $data = {
    ajax: "del_cart_item",
    del: 1,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#cart-table").hide();
      loading(1000);
      setTimeout(function () {
        submit_addToCard(1, 1, 1);
        showMessesTrue("#toast", "Successfully deleted!");
        $("#cart-table").show().html(data);
      }, 1000 + TIME_LOAD);
    },
  };
  adapter_ajax($param);
}
function disableF5(e) {
  if ((e.which || e.keyCode) === 116) {
    e.preventDefault();
    conf = "Do you want to refresh the page?";
    if (confirm(conf)) {
      location = window.location.href;
    }
  }
}
function load_cart() {
  $data = { ajax: "load_cart" };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".main_content").html(data);
      $(document).off("keydown", disableF5);
    },
  };
  adapter_ajax($param);
}
function load_order() {
  $data = { ajax: "load_order" };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".main_content").html(data);
      getPage(".order_page", order_paging);
      $(document).on("keydown", disableF5);
      $(".cus_ord-title.nav_cur").click(function () {
        if (!$(this).hasClass("nav__active")) {
          $(".cus_ord-title.nav_cur").removeClass("nav__active");
          $(this).addClass("nav__active");
        }
      });
    },
  };
  adapter_ajax($param);
}
function load_payment() {
  $data = { ajax: "load_payment" };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".main_content").html(data);
      $(document).on("keydown", disableF5);
    },
  };
  adapter_ajax($param);
}
// order
function toggle_detail_order($id) {
  $(".i-detail-order-" + $id).toggleClass("fa-minus-circle");
  $(".i-detail-order-" + $id).toggleClass("fa-plus-circle");
  $("#tr-detail-order-" + $id).toggle(100);
}
function order_paging($page = 1, $type = -1) {
  if ($type == -1) {
    $type = $(".cus_ord-title.nav__active.nav_cur").attr("type_data");
  }
  $data = {
    ajax: "order_paging",
    page: $page,
    type: $type,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#cus_order-history").html(data);
      getPage(".order_page", order_paging);
    },
  };
  adapter_ajax($param);
}
function order_cancel($order_id) {
  var conf = "Do you want to cancel the order?";
  if (!confirm(conf)) {
    return;
  }
  var $page = $("#order_page").val();
  $data = {
    ajax: "order_cancel",
    order_id: $order_id,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      showMessesTrue("#toast", data);
      order_paging($page, 0);
    },
  };
  adapter_ajax($param);
}
// payment
function change_address_payment(check_ord = 0) {
  var $name = $(".modal__address #name").val().trim();
  var $phone = $(".modal__address #phone").val().trim();
  var $address = $(".modal__address #address").val().trim();
  var $gender;

  $(".modal__address .gender").each(function () {
    if ($(this).prop("checked")) {
      $gender = $(this).val();
    }
  });
  if ($name.length == 0) {
    $(".name-error").html("Enter your name");
    $(".modal__address #name").select();
    return false;
  }
  if ($phone.length == 0) {
    $(".phone-error").html("Enter your phone");
    $(".modal__address #phone").select();
    return false;
  }
  if ($address.length == 0) {
    $(".address-error").html("Enter your address");
    $(".modal__address #address").select();
    return false;
  }
  if (check_ord != 0) {
    return true;
  }
  $(".close-model").trigger("click");
  $data = {
    ajax: "change_address_payment",
    cus_name: htmlEntities($name),
    phone: htmlEntities($phone),
    address: htmlEntities($address),
    gender: htmlEntities($gender),
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      setTimeout(function () {
        $('.cus_name').html($name);
        showMessesTrue("#toast", data);
      }, 300);
    },
  };
  adapter_ajax($param);
}
function order_ticket() {
  if (change_address_payment(1)) {
    var $order_method_id = $("#pay_method").val();
    var $note = $("#note").val().trim();

    $data = {
      ajax: "order_ticket",
      order_method_id: $order_method_id,
      note: htmlEntities($note),
    };
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function () {
        loading(1500);
        setTimeout(function () {
          load_cart();
          setTimeout(function () {
            $('.order_notice-quantity').hide();
            showMessesTrue("#toast", "You ordered succeed!");
          });
        }, 1500 + TIME_LOAD);
      },
    };
    adapter_ajax($param);
  } else {
    $("#address").trigger("click");
    setTimeout(function () {
      change_address_payment(1);
    }, 600);
  }
}

/******************** end cart **********************/
/******************** start account *****************/
function load_setting(type) {
  $data = {
    ajax: "load_setting",
    type: type,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".setting_model").html(data);
      if (type == "password")
        OnEnter(".acc_inp input", change_password_account);
      if (type == "name") {
        OnEnter(".acc_inp input", change_name_account);
        date_time_picker();
      }
      // $(document).on("keydown", disableF5);
    },
  };
  adapter_ajax($param);
}
function load_account() {
  $data = {
    ajax: "load_account",
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".setting_model").html(data);
      $(document).off("keydown", disableF5);
    },
  };
  adapter_ajax($param);
}
function change_password_account() {
  var $last_pass = $("#last_pass").val().trim();
  var $new_pass = $("#new_pass").val().trim();
  var $renew_pass = $("#renew_pass").val().trim();

  if ($last_pass.length < 6) {
    $(".last_pass-error").html("Password min length is 6.");
    $("#last_pass").select();
    return false;
  }
  if ($new_pass.length < 6) {
    $(".new_pass-error").html("Password min length is 6.");
    $("#new_pass").select();
    return false;
  }
  if ($renew_pass.length < 6) {
    $(".renew_pass-error").html("Password min length is 6.");
    $("#renew_pass").select();
    return false;
  }
  if ($new_pass != $renew_pass) {
    $(".renew_pass-error").html("Password is not the same.");
    $("#renew_pass").select();
    return false;
  }
  $data = {
    ajax: "change_password_account",
    last_pass: $last_pass,
    new_pass: $new_pass,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      if (data.indexOf("successfully") !== -1) {
        loading(700);
        setTimeout(function () {
          showMessesTrue("#toast", data);
          $("#last_pass").val("");
          $("#new_pass").val("");
          $("#renew_pass").val("");
          $('._error').html('');
        }, 700 + TIME_LOAD);
      } else {
        $("#last_pass").select();
        $(".last_pass-error").html(data);
      }
    },
  };
  adapter_ajax($param);
}
function check_email_account() {
  var $current_email = $("#current_email").val().trim();
  if (!validateEmail($current_email)) {
    $(".current_email-error").html("Email is wrong syntax");
    $("#current_email").select();
    return false;
  }
  loading(9999);
  $data = {
    ajax: "check_email_account",
    current_email: htmlEntities($current_email),
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      if (data.indexOf("incorrect") !== -1) {
        unloading(500);
        setTimeout(function () {
          $(".current_email-error").html(data);
          $("#current_email").select();
          return false;
        }, 500 + TIME_LOAD);
      } else {
        unloading();
        $("#ck-token").html(data);
        $("#current_email").attr('disabled', 'disabled');
      }
    },
  };
  adapter_ajax($param);
}
function change_email_account() {
  var $token = $("#token").val().trim();
  var $new_email = $("#new_email").val().trim();
  var $current_email = $("#current_email").val().trim();

  if ($token.length == 0) {
    $(".token-error").html("Enter verification code");
    $("#token").select();
    return false;
  }
  if (!validateEmail($new_email)) {
    $(".new_email-error").html("Email is wrong syntax");
    $("#new_email").select();
    return false;
  }

  if ($current_email == $new_email) {
    $(".new_email-error").html("Email same as current email");
    $("#new_email").select();
    return false;
  }

  $data = {
    ajax: "change_email_account",
    token: Number($token),
    new_email: htmlEntities($new_email),
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      if (data.indexOf("incorrect") !== -1) {
        $(".token-error").html(data);
        $("#token").select();
      } else if (data.indexOf("already") !== -1) {
        $(".new_email-error").html(data);
        $("#new_email").select();
      } else {
        loading(1000);
        setTimeout(function () {
          load_setting("email");
          showMessesTrue("#toast", data);
        }, 1000 + TIME_LOAD);
      }
    },
  };
  adapter_ajax($param);
}
function change_name_account() {
  var $name = $("#name").val().trim();
  var $phone = $("#phone").val().trim();
  var $address = $("#address").val().trim();
  var $datebirth = $("#datebirth").val().trim();
  var $gender;

  $(".gender").each(function () {
    if ($(this).prop("checked")) {
      $gender = $(this).val();
    }
  });
  if ($name.length == 0) {
    $(".name-error").html("Name isn't empty.");
    $("#name").select();
    return false;
  }

  if (!DMY.test($datebirth) && $datebirth.length != 0) {
    $(".datebirth-error").html("Birthday wrong format (dd/mm/yyyy)");
    // $("#datebirth").trigger("click");
    // $("#datebirth").focus();
    return false;
  }
  $data = {
    ajax: "change_name_account",
    cus_name: htmlEntities($name),
    phone: htmlEntities($phone),
    address: htmlEntities($address),
    datebirth: htmlEntities(formatDate($datebirth, "ymd", "-")),
    gender: $gender,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      loading(1000);
      setTimeout(function () {
        load_setting("name");
        $('.cus_name').html($name);
        showMessesTrue("#toast", data);
      }, 1000 + TIME_LOAD);
    },
  };
  adapter_ajax($param);
}
function change_avatar_account() {
  var $avatar = $("#avatar")[0].files;
  if ($avatar.length == 0) {
    $(".avatar-error").html("Please upload a photo.");
    return false;
  }
  var $data = new FormData();
  $data.append("ajax", "change_avatar_account");
  $data.append("avatar", $avatar[0]);
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      if (data.indexOf("/avatar") !== -1) {
        loading(700);
        setTimeout(function () {
          showMessesTrue("#toast", "Change avatar successfully.");
          $(".user_avatar").attr("src", data);
        }, 700 + TIME_LOAD);
      } else {
        showMessesWrong("#toast", data);
      }
    },
  };
  adapter_ajax_with_file($param);
}
/******************** end account *******************/
function formatDate($str, type = "DMY", style = "/") {
  //2021-05-28
  //30/06/2021
  if ($str.length != 10) return false;
  if ($str.indexOf("-") !== -1) $str = $str.replaceAll("-", "-");
  if ($str.indexOf("/") !== -1) $str = $str.replaceAll("/", "-");

  if (YMD.test($str)) {
    $arr = $str.split("-");
  } else if (DMY.test($str)) {
    $arr = $str.split("-").reverse();
  } else {
    return false;
  }
  if (type.toUpperCase() == "DMY")
    return $arr[2] + style + $arr[1] + style + $arr[0];
  else if (type.toUpperCase() == "YMD")
    return $arr[0] + style + $arr[1] + style + $arr[2];
  else return false;
}
