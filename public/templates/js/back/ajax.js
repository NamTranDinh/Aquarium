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
/** REGEX */
var DMY = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
var YMD = /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/;
var timeReg = /([01]?[0-9]|2[0-3]):[0-5][0-9]/;
var numReg = /^([1-9][0-9]*)$/;
/** REGEX */

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
/*
 * Process ajax request
 *
 * $param là một object {'type','url', 'data', 'callback'}
 *
 * default type POST
 /*********************************************************************/
var url = "/Aquarium/views/backend/ajax.php";
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

/**  ============  ACCOUNT  ==============   */
function toggle_changePass() {
  $(".form-change-password").toggle(100);
  $("#btn-confirm-pass, .btn-confirm-pass").removeClass("disabled");
}
function changePass() {
  var $oldpass = $("#oldpass").val().trim();
  var $newpass = $("#newpass").val().trim();
  var $renewpass = $("#renewpass").val().trim();
  if ($renewpass.length == 0) {
    $("#renewpass").select().addClass("widget-red");
    $("#newpass_wrong").html("Enter this field");
  }
  if ($newpass.length == 0) {
    $("#newpass").select().addClass("widget-red");
    $("#newpass_warm").html("Enter this field");
  }
  if ($oldpass.length == 0) {
    $("#oldpass").select().addClass("widget-red");
    $("#oldpass_wrong").html("Enter this field");
    return false;
  }
  if ($oldpass && $newpass && $renewpass) {
    if ($newpass != $renewpass) {
      $(".new-password").addClass("widget-red");
      $("#newpass_wrong").html("Passwords are not the same!");
      $("#renewpass").select();
      return false;
    }
    $.post(
      url,
      { ajax: "changePass", oldpass: $oldpass, newpass: $newpass },
      function (data) {
        $(".account-info").html(data);
        $(".form-change-password").show();
        if ($("#oldpass_wrong").html() != "") {
          $("#oldpass").select().addClass("widget-red");
        } else if ($("#newpass_warm").html() != "") {
          $("#newpass").addClass("widget-red").select();
        } else {
          $("#oldpass").val("");
          $(".form-change-password").hide();
          $(".notice")
            .show()
            .css("height", "69px")
            .css("padding", "0 16px")
            .css("lineHeight", "69px")
            .animate({ right: "3px", opacity: 1 }, 300, function () {
              $(this).click(function () {
                $(this).hide();
              });
            });
          $(".notice").fadeOut(2500).animate({
            right: "-100%",
            opacity: 0.2,
          });
        }
      }
    );
  }
}
/**  ============  SETTING  ==============   */
function showMesses(id, data) {
  $notice = $(id);
  data = htmlEntities(data);
  if (data.indexOf("exists") > 0 || data.indexOf("can't") > 0) {
    $notice.addClass("box-red");
  } else {
    $notice.addClass("box-green");
    $(".setting_add_account input, .setting_addGr input").val("");
    $(".setting_add_account, .setting_addGr, #setting_overlay").fadeOut(100);
  }
  $notice
    .html(data)
    .css("top", "105px")
    .show()
    .animate({ right: "3px", opacity: 1 }, 300, function () {
      $(this).click(function () {
        $(this).hide();
      });
    });
  $notice.fadeOut(2000).animate({
    right: "-100%",
    opacity: 0.2,
  });
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
/**========= start setting =============*/
function show_staff() {
  $("#setting_panel").show();
  $("#setting_panel-gr").hide();
  $(".st_btn-goStaff").addClass("setting__active");
  $(".st_btn-goStaffGr").removeClass("setting__active");
  window.history.pushState(null, null, "?controller=setting&pg=staff");
}
function show_staff_group() {
  $("#setting_panel-gr").show();
  $("#setting_panel").hide();
  $(".st_btn-goStaffGr").addClass("setting__active");
  $(".st_btn-goStaff").removeClass("setting__active");
  window.history.pushState(null, null, "?controller=setting&pg=staffGr");
}
// ---- staff ---------
function paging_staff($page) {
  $data = { ajax: "st_staff_paging", page: $page };
  window.history.pushState(null, null, "?controller=setting&page=" + $page);
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#staff_load").html(data);
      getPage(".setting_page-user", paging_staff);
    },
  };
  adapter_ajax($param);
}
function creStaff() {
  var $staffName = $("#inp_add-staffName").val().trim();
  var $userName = $("#inp_add-userName").val().trim();
  var $email = $("#inp_add-email").val().trim();
  var $password = $("#inp_add-password").val().trim();
  var $group_id = $("#inp_add-groupName").val().trim();
  var $page = $("#setting_page-user").val();
  if ($staffName.length == 0)
    $(".error-staffName").html("Please enter a display name!");
  if ($userName.length == 0)
    $(".error-userName").html("Please enter username!");
  if ($email.length == 0) $(".error-email").html("Please enter email!");
  if ($password.length == 0)
    $(".error-password").html("Please enter password!");
  if ($staffName && $userName && $email && $password) {
    $data = {
      addUser: "ok",
      ajax: "creStaff",
      name: htmlEntities($staffName),
      username: htmlEntities($userName),
      email: htmlEntities($email),
      password: htmlEntities($password),
      group_id: htmlEntities($group_id),
    };
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        showMesses("#setting_notice", data);
        paging_staff($page);
      },
    };
    adapter_ajax($param);
  }
}
function show_edit_item(id) {
  $(".tr-item-" + id).toggle();
  $(".edit-tr-item-" + id).toggle(200);
}
function hide_edit_item(id) {
  $(".tr-item-" + id).toggle(200);
  $(".edit-tr-item-" + id).toggle();
}
function deleteStaff(id, name) {
  var warning = "Do you want delete staff " + htmlEntities(name);
  var $page = $("#setting_page-user").val();
  if (confirm(warning)) {
    if (id !== 1) {
      $data = {
        ajax: "deleteStaff",
        id_del: id,
      };
      var $param = {
        type: "post",
        url: url,
        data: $data,
        callback: function (data) {
          showMesses("#setting_notice", data);
          paging_staff($page);
        },
      };
      adapter_ajax($param);
    } else {
      showMessesWrong("#setting_notice", "Can't delete account admin");
    }
  }
}
function updateStaff(id, stt) {
  var $name = $("#user_inp-name-" + stt)
    .val()
    .trim();
  var $email = $("#user_inp-email-" + stt)
    .val()
    .trim();
  var $group_id = $("#user_inp-group_id-" + stt).val();
  var $status = $("#user_inp-status-" + stt).val();
  var $page = $("#setting_page-user").val();
  if ($name.length == 0) {
    showMessesWrong("#setting_notice", "Name isn't empty!");
    return false;
  }
  if ($email.length == 0) {
    showMessesWrong("#setting_notice", "Email isn't empty!");
    return false;
  }
  if ($name && $email && $group_id && $status) {
    $data = {
      ajax: "updateStaff",
      id_upd: id,
      name: htmlEntities($name),
      email: htmlEntities($email),
      group_id: htmlEntities($group_id),
      status: htmlEntities($status),
    };
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        showMesses("#setting_notice", data);
        paging_staff($page);
      },
    };
    adapter_ajax($param);
  }
}
// --------- staff group ---------
function paging_staff_group($page) {
  $data = { ajax: "st_staff_group_paging", page: $page };
  window.history.pushState(
    null,
    null,
    "?controller=post&pg=staffGr&page=" + $page
  );
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#group_staff_load").html(data);
      getPage(".setting_page-group", paging_staff_group);
    },
  };
  adapter_ajax($param);
}
function creGroupStaff() {
  var $groupNames = $("#inp_add-groupNames").val().trim();
  var $groupPermission = $("#inp_add-groupPermission").val();
  var $page = $("#setting_page-group").val();
  if ($groupNames.length == 0)
    $(".error-groupName").html("Please enter group name!");
  if ($groupPermission.length == 0)
    $(".error-groupPermission").html("Please enter group permission!");
  else if ($groupPermission >= 10 || $groupPermission <= 0) {
    $(".error-groupPermission").html("Permission in (0, 10)");
    return false;
  }
  if ($groupNames && $groupPermission) {
    $data = {
      addGroup: "ok",
      ajax: "creGroupStaff",
      group_name: htmlEntities($groupNames),
      group_permission: htmlEntities($groupPermission),
    };
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        showMesses("#setting_notice", data);
        paging_staff_group($page);
      },
    };
    adapter_ajax($param);
  }
}
function show_edit_item_group(id) {
  $(".tr-gs-" + id).toggle();
  $(".edit-tr-gs-" + id).toggle(200);
}
function hide_edit_item_group(id) {
  $(".tr-gs-" + id).toggle(200);
  $(".edit-tr-gs-" + id).toggle();
}
function deleteGroupStaff(id, name) {
  var warning = "Do you want delete group " + name;
  var $page = $("#setting_page-group").val();

  if (confirm(warning)) {
    if (id != 1 && id != 2 && id != 3) {
      $data = {
        ajax: "deleteGroupStaff",
        id_del: id,
      };
      var $param = {
        type: "post",
        url: url,
        data: $data,
        callback: function (data) {
          showMesses("#setting_notice", data);
          paging_staff_group($page);
        },
      };
      adapter_ajax($param);
    } else {
      showMessesWrong("#setting_notice", "Can't delete default group!");
    }
  }
}
function updateGroupStaff(id, stt) {
  var $group_name = $("#group_inp-name-" + stt)
    .val()
    .trim();
  var $group_permission = $("#group_inp-permission-" + stt)
    .val()
    .trim();
  $group_name = htmlEntities($group_name);
  var $page = $("#setting_page-group").val();
  if ($group_name.length == 0) {
    showMessesWrong("#setting_notice", "Group name isn't empty!");
    return false;
  }
  if ($group_permission.length == 0) {
    showMessesWrong("#setting_notice", "Group permission isn't empty!");
    return false;
  }
  if (!$group_name && ($group_permission <= 0 || $group_permission >= 10)) {
    showMessesWrong("#setting_notice", "Group permission in (1-10)");
  } else if (id == 1 || id == 2 || id == 3) {
    showMessesWrong("#setting_notice", "Can't update default group!");
  } else {
    $data = {
      ajax: "updateGroupStaff",
      id_upd: id,
      group_name: $group_name,
      group_permission: $group_permission,
    };
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        showMesses("#setting_notice", data);
        paging_staff_group($page);
      },
    };
    adapter_ajax($param);
  }
}
/**========= end setting =============*/
/**========= start posts =============*/
function load_post() {
  var $page = $("#pages").val();
  $data = { ajax: "load_post", page: $page };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".post_container").html(data);
      getPage(".page_posts", post_paging);
    },
  };
  window.history.pushState(null, null, "?controller=post&page="+$page  );
  adapter_ajax($param);
}
function load_post_category() {
  $data = { ajax: "load_post_category" };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".post_container").html(data);
      getPage(".page_category", post_category_paging);
    },
  };
  window.history.pushState(null, null, "?controller=post&action=load_group");
  adapter_ajax($param);
}
// -------- posts ----------
function post_paging($page = 1) {
  var $search_text = $("#inp-sPost").val().trim();
  var $type_s = $("#ckb-sPost").prop("checked");
  var $group_id = $("#sel-sPost_cate").val();
  var $status = $("#sel-sPost_status").val();
  var $order_type;
  window.history.pushState(null, null, "?controller=post&page=" + $page);

  $(".rad-sPost_ADesc").each(function () {
    if ($(this).prop("checked")) $order_type = $(this).val();
  });
  $data = {
    ajax: "post_paging",
    page: $page,
    search: htmlEntities($search_text),
    type_s: $type_s,
    group_id: $group_id,
    status: $status,
    order_type: $order_type,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#post_table").html(data);
      $("#pages").val($page);
      getPage(".page_posts", post_paging);
    },
  };
  adapter_ajax($param);
}
function post_category_paging($page = 1) {
  var $search_text = $("#inp-sPost_cate").val().trim();
  var $type_s = $("#ckb-sPost_cate").prop("checked");
  window.history.pushState(
    null,
    null,
    "?controller=post&action=load_group&page=" + $page
  );

  $data = {
    ajax: "post_category_paging",
    page: $page,
    search: htmlEntities($search_text),
    type_s: $type_s,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#post_table-category").html(data);
      getPage(".page_category", post_category_paging);
    },
  };
  adapter_ajax($param);
}
function show_posts() {
  $("#posts-main").show();
  $("#add-post").hide();
}
function show_add_posts() {
  $("#posts-main").hide();
  $("#add-post").show();
}
function show_edit_post($sea_id) {
  $data = { ajax: "show_edit_post", sea_id: $sea_id };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".post_container").html(data);
    },
  };
  adapter_ajax($param);
}
function cre_posts() {
  var $name = $("#post_inp-name").val().trim();
  var $intro = $("#post_inp-intro").val().trim();
  var $category = $("#post_inp-category").val().trim();
  var $file_img = $("#post_inp-file")[0].files;
  var $sub_img = $("#post_inp-subFile")[0].files;

  if ($name.length == 0) $(".post_inp-name-error").html("Please enter name.");
  if ($intro.length == 0)
    $(".post_inp-intro-error").html("Please enter introduction.");
  if ($category == -1)
    $(".post_inp-category-error").html("Please chose category.");
  if ($file_img.length == 0)
    $(".post_inp-file-error").html("Please upload a photo.");
  if ($sub_img.length == 0)
    $(".inp_subFile-error").html("Please upload a photo.");

  if (
    $name &&
    $intro &&
    $category != -1 &&
    $file_img.length > 0 &&
    $sub_img.length > 0
  ) {
    var $data = new FormData();
    $data.append("ajax", "cre_posts");
    $data.append("sea_name", htmlEntities($name));
    $data.append("sea_info", htmlEntities($intro));
    $data.append("sea_group_id", $category);
    $data.append("post_img", $file_img[0]);
    $data.append("post_sub_img", $sub_img[0]);
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        if (data.indexOf("Successfully") !== -1) {
          $("#post_inp-name").val("");
          $("#post_inp-intro").val("");
          $("#post_lab-file").html("Chose image to upload.");
          $("#post_lab-subFile").html("Chose image to upload.");
          showMessesTrue("#posts_notice", data);
        } else {
          showMessesWrong("#posts_notice", data);
        }
      },
    };
    adapter_ajax_with_file($param);
  }
}
function udp_posts($sea_id) {
  var $name = $("#post_inp-name").val().trim();
  var $intro = $("#post_inp-intro").val().trim();
  var $category = $("#post_inp-category").val().trim();
  var $file_img = $("#post_inp-file")[0].files;
  var $sub_img = $("#post_inp-subFile")[0].files;
  var $status = $("#post_ckb-status").prop("checked");
  if ($name.length == 0) $(".post_inp-name-error").html("Please enter name.");
  if ($intro.length == 0)
    $(".post_inp-intro-error").html("Please enter introduction.");

  if ($name && $intro) {
    var $data = new FormData();
    $data.append("ajax", "udp_posts");
    $data.append("sea_id", $sea_id);
    $data.append("sea_name", htmlEntities($name));
    $data.append("sea_info", htmlEntities($intro));
    $data.append("status", $status);
    if ($category != -1) $data.append("sea_group_id", $category);
    if ($file_img.length > 0) $data.append("post_img", $file_img[0]);
    if ($sub_img.length > 0) $data.append("post_sub_img", $sub_img[0]);
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        if (data.indexOf("Successfully") !== -1) {
          showMessesTrue("#posts_notice", data);
          if ($file_img.length > 0 || $sub_img.length > 0) {
            $(this).fadeOut(1500, function () {
              show_edit_post($sea_id);
            });
          }
        } else {
          showMessesWrong("#posts_notice", data);
        }
      },
    };
    adapter_ajax_with_file($param);
  }
}
function udp_post_status($sea_id) {
  var $status = $("#post_detail-status").val();
  $data = {
    ajax: "udp_post_status",
    status: $status,
    sea_id: $sea_id,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      showMessesTrue("#posts_notice", data);
    },
  };
  adapter_ajax($param);
}
function del_posts($sea_id, $sea_name) {
  var $page = $("#post_page-animal").val();
  mess = "Do you want delete post " + $sea_name;
  if (!confirm(mess)) {
    return false;
  }
  $data = {
    ajax: "del_posts",
    sea_id: $sea_id,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      showMessesTrue("#posts_notice", data);
      post_paging($page);
    },
  };
  adapter_ajax($param);
}
// -------- post-detail -------
function show_detail_post($sea_id) {
  $data = {
    ajax: "show_detail_post",
    sea_id: $sea_id,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".post_container").html(data);
    },
  };
  adapter_ajax($param);
}
function show_detail_content_post($sea_id) {
  $data = {
    ajax: "show_detail_content_post",
    sea_id: $sea_id,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#post_detail-content").html(data);
    },
  };
  adapter_ajax($param);
}
function show_add_content_post($id, $name) {
  $data = {
    ajax: "show_add_content_post",
    sea_id: $id,
    sea_name: $name,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".post_container").html(data);
      CKEDITOR.replace("content-top", { height: 300 });
      CKEDITOR.replace("content-bot", { height: 300 });
    },
  };
  adapter_ajax($param);
}
function show_edit_content_post($id, $sea_id) {
  $data = {
    ajax: "show_edit_content_post",
    id: $id,
    sea_id: $sea_id,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".post_container").html(data);
      $("textarea").hide();
      CKEDITOR.replace("content-top", { height: 300 });
      CKEDITOR.replace("content-bot", { height: 300 });
      var top_content = $("#content-top").val();
      var bot_content = $("#content-bot").val();
      CKEDITOR.instances["content-top"].setData(top_content);
      CKEDITOR.instances["content-bot"].setData(bot_content);
    },
  };
  adapter_ajax($param);
}
function cre_content_post() {
  var $sea_id = $("#post_inp_ct-sea_id").val().trim();
  var $content_name = $("#post_inp_ct-name").val().trim();
  var $file_img = $("#post_inp-ct-file")[0].files;
  var $content_top = CKEDITOR.instances["content-top"].getData();
  var $content_bot = CKEDITOR.instances["content-bot"].getData();
  if ($content_name.length == 0)
    $(".post_inp_ct-name-error").html("Please enter content name.");
  if ($content_top.length == 0) alert("Please fill the content");

  if ($content_name && $content_top) {
    var $data = new FormData();
    $data.append("ajax", "cre_content_post");
    $data.append("sea_id", $sea_id);
    $data.append("des_name", htmlEntities($content_name));
    $data.append("top_content", $content_top);
    if ($file_img.length > 0) $data.append("img", $file_img[0]);
    if ($content_bot.length > 0) $data.append("bot_content", $content_bot);
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        if (data.indexOf("Successfully") !== -1) {
          $("#post_inp_ct-name").val("");
          $("#post_lab_ct-file").html("Chose image to upload.");
          CKEDITOR.instances["content-top"].setData("");
          CKEDITOR.instances["content-bot"].setData("");
          showMessesTrue("#posts_notice", data);
        } else {
          showMessesWrong("#posts_notice", data);
        }
      },
    };
    adapter_ajax_with_file($param);
  }
}
function udp_content_post($id) {
  var $sea_id = $("#post_inp_ct-sea_id").val();
  var $content_name = $("#post_inp_ct-name").val().trim();
  var $file_img = $("#post_inp-ct-file")[0].files;
  var $content_top = CKEDITOR.instances["content-top"].getData();
  var $content_bot = CKEDITOR.instances["content-bot"].getData();
  if ($content_name.length == 0)
    $(".post_inp_ct-name-error").html("Please enter content name.");
  if ($content_top.length == 0) alert("Please fill the content");
  if ($content_name && $content_top) {
    var $data = new FormData();
    $data.append("ajax", "udp_content_post");
    $data.append("id", $id);
    $data.append("sea_id", $sea_id);
    $data.append("des_name", htmlEntities($content_name));
    $data.append("top_content", $content_top);
    if ($file_img.length > 0) $data.append("img", $file_img[0]);
    if ($content_bot.length > 0) $data.append("bot_content", $content_bot);
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        if (data.indexOf("Successfully") !== -1) {
          showMessesTrue("#posts_notice", data);
          if ($file_img.length > 0) {
            $(this).fadeOut(1500, function () {
              show_edit_content_post($id, $sea_id);
            });
          }
        } else {
          showMessesWrong("#posts_notice", data);
        }
      },
    };
    adapter_ajax_with_file($param);
  }
}
function del_content_post($content_id, $content_name, $sea_id) {
  mess = "Do you want delete content " + $content_name;
  if (!confirm(mess)) {
    return false;
  }
  $data = {
    ajax: "del_content_post",
    id: $content_id,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      showMessesTrue("#posts_notice", data);
      show_detail_content_post($sea_id);
    },
  };
  adapter_ajax($param);
}
// -------- post-category ----------
function show_add_category_post() {
  $("#post_cate-add").show().animate(
    {
      top: "25%",
      opacity: "1",
    },
    200
  );
  $("#post_cate_overlay").fadeIn(150);
}
function hide_add_category_post() {
  $("#post_cate-add").animate(
    {
      top: "0",
      opacity: "0.3",
    },
    350,
    function () {
      $("#post_cate-add").fadeOut(200);
    }
  );
  $("#post_cate_overlay").fadeOut(150);
}
function toggle_edit_category_post($id, $action) {
  if ($action == "show") {
    $(".tr-item-" + $id).hide();
    $(".tr-edit-item-" + $id).show(200);
  } else {
    $(".tr-item-" + $id).show(200);
    $(".tr-edit-item-" + $id).hide();
  }
}
function cre_category_post() {
  var $page = $("#post_page-category").val();
  var $group_name = $("#post_add_ct-name").val().trim();
  var $parent_id = $("#post_add_ct-parent").val();
  if ($group_name.length == 0) {
    $(".error-post_name").html("Please enter category name");
  } else {
    $data = {
      ajax: "cre_category_post",
      group_name: htmlEntities($group_name),
      parent_id: $parent_id,
    };
    $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        if (data.indexOf("Successfully") !== -1) {
          showMessesTrue("#posts_notice", data);
          hide_add_category_post();
          $("#post_add_ct-name").val("");
          post_category_paging($page);
        } else {
          showMessesWrong("#posts_notice", data);
        }
      },
    };
    adapter_ajax($param);
  }
}
function udp_category_post($id) {
  var $page = $("#post_page-category").val();
  var $category_name = $("#post_inp_ct-name-" + $id)
    .val()
    .trim();
  var $parent_id = $("#post_ct-parentId-" + $id).val();
  var $status = $("#post_inp_ct-status-" + $id).val();

  if ($category_name.length == 0) {
    showMessesWrong("#posts_notice", "Category name not be empty!");
    $("#post_inp_ct-name-" + $id).select();
    return false;
  }
  if ($category_name) {
    var $data = {
      ajax: "udp_category_post",
      id: $id,
      group_name: $category_name,
      parent_id: $parent_id,
      status: $status,
    };
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        if (data.indexOf("Successfully") !== -1) {
          showMessesTrue("#posts_notice", data);
          post_category_paging($page);
        } else {
          showMessesWrong("#posts_notice", data);
          $("#post_inp_ct-name-" + $id).select();
        }
      },
    };
    adapter_ajax($param);
  }
}
function del_category_post($id, $name) {
  mess =
    "Do you want delete category " + $name + ", all subcategory and posts??";
  if (confirm(mess)) {
    var $page = $("#post_page-category").val();
    $data = {
      ajax: "del_category_post",
      id: $id,
    };
    $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        post_category_paging($page);
        showMessesTrue("#posts_notice", data);
      },
    };
    adapter_ajax($param);
  }
}
/**========= end posts =============*/
/**========= start event =============*/
function load_event() {
  var $page = $("#pages").val();
  $data = { ajax: "load_event", page: $page };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".event_container").html(data);
      getPage(".page_event", event_paging);
    },
  };
  adapter_ajax($param);
}
// ------- event ---------
function toggle_edit_event($id, $action) {
  if ($action == "show") {
    $(".tr-item-" + $id).hide();
    $(".tr-edit-item-" + $id).show(200);
  } else {
    $(".tr-item-" + $id).show(200);
    $(".tr-edit-item-" + $id).hide();
  }
}
function event_paging($page = 1) {
  var $search_text = $("#inp-sEvent").val().trim();
  var $type_s = $("#ckb-sEvent").prop("checked");
  var $min_price = $("#sel-sEvent-minPrice").val();
  var $max_price = $("#sel-sEvent-maxPrice").val();
  var $date_start = $("#inp-sStartDate").val();
  var $date_end = $("#inp-sEndDate").val();
  var $order_type;
  window.history.pushState(null, null, "?controller=event&page=" + $page);

  $(".rad-event_sADesc").each(function () {
    if ($(this).prop("checked")) $order_type = $(this).val();
  });
  $data = {
    ajax: "event_paging",
    page: $page,
    type_s: $type_s,
    search: htmlEntities($search_text),
    date_start: htmlEntities($date_start),
    date_end: htmlEntities($date_end),
    min_price: $min_price,
    max_price: $max_price,
    order_type: $order_type,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#event_table").html(data);
      $("#pages").val($page);
      date_time_picker();
      getPage(".page_event", event_paging);
    },
  };
  adapter_ajax($param);
}
function cre_event() {
  var $page = $("#page-event").val();
  var $name = $("#name").val().trim();
  var $locations = $("#location").val().trim();
  var $eventFile = $("#eventFile")[0].files;
  var $eventSubFile = $("#eventSubFile")[0].files;
  var $intro = $("#intro").val().trim();
  var $dayStart = $("#dayStart").val().trim();
  var $dayEnd = $("#dayEnd").val().trim();
  var $timeStart = $("#timeStart").val().trim();
  var $timeEnd = $("#timeEnd").val().trim();
  var $tkNum = $("#tkNum").val().trim();
  var $tkPrice = $("#tkPrice").val().trim();

  if ($name.length == 0) {
    $(".name-error").html("Please enter name.");
    $("#name").focus();
    return false;
  }
  if ($locations.length == 0) {
    $(".locations-error").html("Please enter location.");
    $("#location").focus();
    return false;
  }
  if ($eventFile.length == 0) {
    $(".file-error").html("Please upload a photo.");
    $("#eventFile").focus();
    return false;
  }
  if ($eventSubFile.length == 0) {
    $(".subFile-error").html("Please upload a photo.");
    $("#eventSubFile").focus();
    return false;
  }
  if ($intro.length == 0) {
    $(".intro-error").html("Please enter intro.");
    $("#intro").focus();
    return false;
  }
  if ($dayStart.length == 0) {
    $(".dayStart-error").html("Please enter date start.");
    return false;
  } else if (!DMY.test($dayStart)) {
    alert("Date start syntax incorrect (dd/mm/yyyy).");
    $("#dayStart").focus();
    return false;
  }
  if ($timeStart.length == 0) {
    $(".timeStart-error").html("Please chose time!");
    return false;
  } else if (!timeReg.test($timeStart)) {
    alert("Time start syntax incorrect (hh/mm).");
    return false;
  }
  if ($dayEnd.length == 0) {
    $(".dayEnd-error").html("Please enter date end.");
    return false;
  } else if (!DMY.test($dayEnd)) {
    alert("Date end syntax incorrect (dd/mm/yyyy).");
    $("#dayEnd").focus();
    return false;
  }
  if ($timeEnd.length == 0) {
    $(".timeEnd-error").html("Please chose time!");
    return false;
  } else if (!timeReg.test($timeEnd)) {
    alert("Time end syntax incorrect (hh/mm).");
    return false;
  }
  if ($tkNum.length == 0) {
    $(".tkNum-error").html("Please enter ticket number.");
    $("#tkNum").focus();
    return false;
  } else if (!numReg.test($tkNum)) {
    $(".tkNum-error").html("Ticket number is syntax incorrect.");
    $("#tkNum").select();
    return false;
  }
  if ($tkPrice.length == 0) {
    $(".tkPrice-error").html("Please enter ticket price.");
    $("#tkPrice").focus();
    return false;
  } else if (!numReg.test($tkPrice)) {
    $(".tkPrice-error").html("Ticket price is syntax incorrect.");
    $("#tkPrice").select();
    return false;
  }
  if (
    $name &&
    $locations &&
    $eventFile.length > 0 &&
    $eventSubFile.length > 0 &&
    $intro &&
    $dayStart &&
    $dayEnd &&
    $timeStart &&
    $timeEnd &&
    $tkNum &&
    $tkPrice
  ) {
    var $data = new FormData();
    $data.append("ajax", "cre_event");
    $data.append("event_name", htmlEntities($name));
    $data.append("event_img", $eventFile[0]);
    $data.append("event_sub_img", $eventSubFile[0]);
    $data.append("event_intro", htmlEntities($intro));
    $data.append("ticket_price", $tkPrice);
    $data.append("ticket_num", $tkNum);
    $data.append("time_start", $dayStart + " " + $timeStart);
    $data.append("time_end", $dayEnd + " " + $timeEnd);
    $data.append("locations", htmlEntities($locations));

    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        if (data.indexOf("Successfully") !== -1) {
          showMessesTrue("#event_notice", data);
          $("#name").val("");
          $("#location").val("");
          $("#event_lab-file").html("Chose image to upload.");
          $("#event_lab-subFile").html("Chose image to upload.");
          $("#intro").val("");
          $("#dayStart").val("");
          $("#dayEnd").val("");
          $("#tkNum").val("");
          $("#tkPrice").val("");
          event_paging($page);
        } else {
          showMessesWrong("#event_notice", data);
        }
      },
    };
    adapter_ajax_with_file($param);
  }
}
function udp_event_base($id) {
  var $page = $("#page-event").val();
  var $name = $("#event_inp-name-" + $id)
    .val()
    .trim();
  var $ticket_num = $("#event_inp-ticket_num-" + $id)
    .val()
    .trim();
  var $ticket_price = $("#event_inp-ticket_price-" + $id)
    .val()
    .trim();
  var $dStart = $("#event_inp-dStart-" + $id)
    .val()
    .trim();
  var $tStart = $("#event_inp-tStart-" + $id)
    .val()
    .trim();
  var $dEnd = $("#event_inp-dEnd-" + $id)
    .val()
    .trim();
  var $tEnd = $("#event_inp-tEnd-" + $id)
    .val()
    .trim();
  var $locations = $("#event_inp-locations-" + $id)
    .val()
    .trim();
  var $status = $("#event_inp-status-" + $id).val();

  if ($name.length == 0) {
    showMessesWrong("#event_notice", "Event name cannot be empty !");
  } else {
    $data = {
      ajax: "udp_event_base",
      id: $id,
      event_name: htmlEntities($name),
      ticket_num: htmlEntities($ticket_num),
      ticket_price: htmlEntities($ticket_price),
      time_start: $dStart + " " + $tStart,
      time_end: $dEnd + " " + $tEnd,
      locations: htmlEntities($locations),
      status: $status,
    };
    $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        if (data.indexOf("Successfully") !== -1) {
          showMessesTrue("#event_notice", data);
          event_paging($page);
        } else {
          showMessesWrong("#event_notice", data);
          $("#event_inp-name-" + $id).select();
        }
      },
    };
    adapter_ajax($param);
  }
}
function del_event($id, $evenName) {
  mess = "Do you want delete event '" + $evenName + "'";
  if (confirm(mess)) {
    var $page = $("#page-event").val();
    $data = {
      ajax: "del_event",
      id: $id,
    };
    $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        event_paging($page);
        showMessesTrue("#event_notice", data);
      },
    };
    adapter_ajax($param);
  }
}
// ------- event detail ---------
function show_detail_event($id) {
  $data = {
    ajax: "show_detail_event",
    id: $id,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".event_container").html(data);
      date_time_picker();
    },
  };
  adapter_ajax($param);
}
function show_detail_content_event($eventId) {
  $data = {
    ajax: "show_detail_content_event",
    event_id: $eventId,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#event_detail-content").html(data);
    },
  };
  adapter_ajax($param);
}
function show_add_content_event($id, $eventName) {
  $data = {
    ajax: "show_add_content_event",
    id: $id,
    event_name: $eventName,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".event_container").html(data);
      CKEDITOR.replace("content", { height: 300 });
    },
  };
  adapter_ajax($param);
}
function show_edit_content_event($id, $eventId) {
  $data = {
    ajax: "show_edit_content_event",
    id: $id,
    event_id: $eventId,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".event_container").html(data);
      CKEDITOR.replace("content", { height: 300 });
      var content = $("#des_content").val();
      CKEDITOR.instances["content"].setData(content);
    },
  };
  adapter_ajax($param);
}
function show_edit_detail_event($id) {
  $("body").css("overflow", "hidden");
  $("#event-add_content").addClass("disabled");
  $($id).show().animate(
    {
      top: "18%",
      opacity: "1",
    },
    200
  );
  $("#event_overlay").fadeIn(100);
}
function hide_edit_detail_event($id) {
  $("body").css("overflow", "");
  $("#event-add_content").removeClass("disabled");
  $($id).animate(
    {
      top: "-100px",
      opacity: "0.3",
    },
    300,
    function () {
      $($id).fadeOut(200);
    }
  );
  $("#event_overlay").fadeOut(150);
}
function udp_event_detail($id) {
  var $name = $("#event_inp-name").val().trim();
  var $intro = $("#event_inp-intro").val().trim();
  var $file_img = $("#event_inp-file")[0].files;
  var $file_sub_img = $("#eventSubFile")[0].files;

  if ($name.length == 0) {
    $(".error-event_name").html("Name is not empty!");
  } else {
    var $data = new FormData();
    $data.append("ajax", "udp_event_detail");
    $data.append("id", $id);
    $data.append("event_name", htmlEntities($name));
    $data.append("event_intro", htmlEntities($intro));
    if ($file_img.length > 0) $data.append("event_img", $file_img[0]);
    if ($file_sub_img.length > 0)
      $data.append("event_sub_img", $file_sub_img[0]);
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        if (data.indexOf("exist") !== -1) {
          showMessesWrong("#notice", data);
        } else if (data.indexOf("button") !== -1) {
          if ($file_img.length > 0) {
            $("#event_detail").html(data);
          }
          hide_edit_detail_event("#event-edit");
          showMessesTrue("#notice", "Successfully update!");
        } else {
          showMessesWrong("#notice", data);
        }
      },
    };
    adapter_ajax_with_file($param);
  }
}
function udp_event_detail_base($id) {
  var $locations = $("#location").val().trim();
  var $dayStart = $("#dayStart").val().trim();
  var $dayEnd = $("#dayEnd").val().trim();
  var $timeStart = $("#timeStart").val().trim();
  var $timeEnd = $("#timeEnd").val().trim();
  var $tkPrice = $("#tkPrice").val().trim();

  if ($locations.length == 0) {
    $(".locations-error").html("Please enter location.");
    $("#location").focus();
    return false;
  }
  if ($dayStart.length == 0) {
    $(".dayStart-error").html("Please enter date start.");
    return false;
  } else if (!DMY.test($dayStart)) {
    alert("Date start syntax incorrect (dd/mm/yyyy).");
    $("#dayStart").focus();
    return false;
  }
  if ($timeStart.length == 0) {
    $(".timeStart-error").html("Please chose time!");
    return false;
  } else if (!timeReg.test($timeStart)) {
    alert("Time start syntax incorrect (hh/mm).");
    return false;
  }
  if ($dayEnd.length == 0) {
    $(".dayEnd-error").html("Please enter date end.");
    return false;
  } else if (!DMY.test($dayEnd)) {
    alert("Date end syntax incorrect (dd/mm/yyyy).");
    $("#dayEnd").focus();
    return false;
  }
  if ($timeEnd.length == 0) {
    $(".timeEnd-error").html("Please chose time!");
    return false;
  } else if (!timeReg.test($timeEnd)) {
    alert("Time end syntax incorrect (hh/mm).");
    return false;
  }
  if ($tkPrice.length == 0) {
    $(".tkPrice-error").html("Please enter ticket price.");
    $("#tkPrice").focus();
    return false;
  } else if (!numReg.test($tkPrice)) {
    $(".tkPrice-error").html("Ticket price is syntax incorrect.");
    $("#tkPrice").select();
    return false;
  }
  if (
    $locations &&
    $dayStart &&
    $dayEnd &&
    $timeStart &&
    $timeEnd &&
    $tkPrice
  ) {
    var $data = {
      ajax: "udp_event_detail_base",
      id: $id,
      locations: htmlEntities($locations),
      time_start: $dayStart + " " + $timeStart,
      time_end: $dayEnd + " " + $timeEnd,
      ticket_price: $tkPrice,
    };
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        $("#event_base").html(data);
        showMessesTrue("#notice", "Successfully update");
        hide_edit_detail_event("#event_base-edit");
      },
    };
    adapter_ajax($param);
  }
}
function cre_content_event() {
  var $event_id = $("#content-event_id").val().trim();
  var $content_name = $("#content-name").val().trim();
  var $file_img = $("#content-file")[0].files;
  var $content = CKEDITOR.instances["content"].getData();
  if ($content_name.length == 0)
    $(".name-error").html("Please enter content name.");
  if ($content.length == 0) alert("Please fill the content");

  if ($content_name && $content) {
    var $data = new FormData();
    $data.append("ajax", "cre_content_event");
    $data.append("event_id", $event_id);
    $data.append("des_name", htmlEntities($content_name));
    $data.append("des_content", $content);
    if ($file_img.length > 0) $data.append("des_img", $file_img[0]);
    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        if (data.indexOf("Successfully") !== -1) {
          $("#content-name").val("");
          $("#event_lab-file").html("Chose image to upload.");
          CKEDITOR.instances["content"].setData("");
          showMessesTrue("#notice", data);
        } else {
          showMessesWrong("#notice", data);
        }
      },
    };
    adapter_ajax_with_file($param);
  }
}
function udp_content_event($id) {
  var $event_id = $("#content-event_id").val().trim();
  var $content_name = $("#content-name").val().trim();
  var $file_img = $("#content-file")[0].files;
  var $content = CKEDITOR.instances["content"].getData();
  if ($content_name.length == 0)
    $(".name-error").html("Please enter content name.");
  if ($content.length == 0) alert("Please fill the content");
  if ($content_name && $content) {
    var $data = new FormData();
    $data.append("ajax", "udp_content_event");
    $data.append("id", $id);
    $data.append("event_id", $event_id);
    $data.append("des_name", htmlEntities($content_name));
    $data.append("des_content", $content);
    if ($file_img.length > 0) $data.append("des_img", $file_img[0]);

    var $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        if (
          data.indexOf("Curren") !== -1 ||
          data.indexOf("Successfully") !== -1
        ) {
          showMessesTrue("#notice", "Successfully update!");
          $("#event_lab-file").html("Chose image to upload.");
          if ($file_img.length > 0) {
            $(".last_img-event").html(data);
          }
        } else {
          showMessesWrong("#notice", data);
        }
      },
    };
    adapter_ajax_with_file($param);
  }
}
function del_content_event($id, $eventContent, $eventId) {
  mess = "Do you want delete content '" + $eventContent + "'";
  if (confirm(mess)) {
    $data = {
      ajax: "del_content_event",
      id: $id,
    };
    $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        showMessesTrue("#notice", data);
        show_detail_content_event($eventId);
      },
    };
    adapter_ajax($param);
  }
}
/**========= end event =============*/
/**========= start customer =============*/
function load_cus() {
  var $page = $("#pages").val();
  $data = { ajax: "load_cus", page: $page };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".customer_container").html(data);
      getPage(".cus_page", cus_paging);
    },
  };
  adapter_ajax($param);
}
function cus_paging($page = 1) {
  var $search_text = $("#inp-sCus-text").val().trim();
  var $type_s = $("#ckb-sCus-type").prop("checked");
  var $search_op = $("#sel-sCus").val();
  var $order_by;
  var $order_type;
  window.history.pushState(null, null, "?controller=customer&page=" + $page);

  $(".rad-cus_sOrd").each(function () {
    if ($(this).prop("checked")) $order_by = $(this).val();
  });
  $(".rad-cus_sADesc").each(function () {
    if ($(this).prop("checked")) $order_type = $(this).val();
  });

  $data = {
    ajax: "cus_paging",
    page: $page,
    search_text: $search_text,
    type_s: $type_s,
    search_op: $search_op,
    order_by: $order_by,
    order_type: $order_type,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#cus_tbody").html(data);
      $("#pages").val($page);
      getPage(".cus_page", cus_paging);
    },
  };
  adapter_ajax($param);
}
function cus_detail_paging($page, $cus_id) {
  $data = {
    ajax: "cus_detail_paging",
    page: $page,
    id: $cus_id,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#cus_order-history").html(data);
      $(".cus_detail_page").click(function () {
        cus_detail_paging($(this).val(), $cus_id);
      });
    },
  };
  adapter_ajax($param);
}
function show_cre_cus() {
  $("#cre_cus-box").show().animate(
    {
      top: "10%",
      opacity: "1",
    },
    200
  );
  $("#overlay").fadeIn(150);
}
function hide_cre_cus() {
  $("#cre_cus-box").animate(
    {
      top: "-200px",
      opacity: "0.3",
    },
    350,
    function () {
      $("#cre_cus-box").fadeOut(200);
    }
  );
  $("#overlay").fadeOut(150);
}
function cre_cus() {
  var $page = $("#cus_page").val();
  var $customer_userName = $("#customer_userName").val().trim();
  var $customer_pass = $("#customer_pass").val().trim();
  var $customer_name = $("#customer_name").val().trim();
  var $customer_phone = $("#customer_phone").val().trim();
  var $customer_email = $("#customer_email").val().trim();
  var $customer_addr = $("#customer_addr").val().trim();
  var $customer_dateBirth = $("#customer_dateBirth").val().trim();
  var $gender;
  $(".customer_gender").each(function () {
    if ($(this).prop("checked")) {
      $gender = $(this).val();
    }
  });
  if ($customer_userName.length == 0)
    $(".error-userName").html("Please enter userName");
  if ($customer_pass.length == 0) $(".error-pass").html("Please enter pass");
  if ($customer_name.length == 0) $(".error-name").html("Please enter name");
  if ($customer_phone.length == 0) $(".error-phone").html("Please enter phone");
  if ($customer_email.length == 0) $(".error-email").html("Please enter email");

  if ($customer_dateBirth.length != 0) {
    if (!DMY.test($customer_dateBirth)) {
      $(".error-dateBirth").html(
        "Date birth is syntax incorrect. (dd-mm-yyyy)"
      );
    }
  }

  if (
    $customer_userName &&
    $customer_pass &&
    $customer_name &&
    $customer_phone &&
    $customer_email
  ) {
    $data = {
      ajax: "cre_cus",
      username: htmlEntities($customer_userName),
      password: $customer_pass,
      cus_name: htmlEntities($customer_name),
      phone: htmlEntities($customer_phone),
      email: htmlEntities($customer_email),
      address: htmlEntities($customer_addr),
      datebirth: htmlEntities($customer_dateBirth),
      gender: $gender,
    };
    $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        if (data.indexOf("Successfully") !== -1) {
          showMessesTrue("#notice", data);
          $("#frm-crcust input.form-control").val("");
          cus_paging($page);
          hide_cre_cus();
        } else {
          showMessesWrong("#notice", data);
        }
      },
    };
    adapter_ajax($param);
  }
}
function udp_cus($id) {
  var $customer_name = $("#customer_name").val().trim();
  var $customer_phone = $("#customer_phone").val().trim();
  var $customer_email = $("#customer_email").val().trim();
  var $customer_birthday = $("#customer_birthday").val().trim();
  var $customer_addr = $("#customer_addr").val().trim();
  var $customer_gender;

  $(".customer_gender").each(function () {
    if ($(this).prop("checked")) {
      $customer_gender = $(this).val();
    }
  });

  if ($customer_name.length == 0)
    $(".error-customer_name").html("Name is not empty");
  if ($customer_phone.length == 0)
    $(".error-customer_phone").html("Phone is not empty");

  if ($customer_birthday.length != 0) {
    if (!DMY.test($customer_birthday)) {
      $(".error-dateBirth").html(
        "Date birth is syntax incorrect. (dd-mm-yyyy)"
      );
      return false;
    }
  }
  if ($customer_name && $customer_phone) {
    $data = {
      ajax: "udp_cus",
      id: $id,
      cus_name: htmlEntities($customer_name),
      phone: htmlEntities($customer_phone),
      email: htmlEntities($customer_email),
      datebirth: htmlEntities($customer_birthday),
      address: htmlEntities($customer_addr),
      gender: $customer_gender,
    };
    $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        showMessesTrue("#notice", "Successfully updated!");
        hide_edit_cus();
        $("#customer-info").html(data);
      },
    };
    adapter_ajax($param);
  }
}
function udp_cus_status($id, $status) {
  if ($status == 1) {
    conf = "Do you want lock this account?";
    $status = 0;
  } else {
    conf = "Do you want unlock this account?";
    $status = 1;
  }
  if (confirm(conf)) {
    var $page = $("#cus_page").val();
    $data = {
      ajax: "udp_cus_status",
      id: $id,
      status: $status,
    };
    $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        showMessesTrue("#notice", data);
        cus_paging($page);
      },
    };
    adapter_ajax($param);
  }
}
function del_cus($cus_id, $cusName) {
  var $page = $("#cus_page").val();
  conf = "Do you want delete customer '" + $cusName + "'";
  if (confirm(conf)) {
    $data = {
      ajax: "del_cus",
      cus_id: $cus_id,
    };
    $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        if (data.indexOf("Successfully") !== -1) {
          showMessesTrue("#notice", data);
          cus_paging($page);
        } else {
          showMessesWrong("#notice", data);
        }
      },
    };
    adapter_ajax($param);
  }
}
function show_detail_cus($id) {
  $data = {
    ajax: "show_detail_cus",
    id: $id,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $(".customer_container").html(data);
      date_time_picker();
      $(".cus_detail_page").click(function () {
        cus_detail_paging($(this).val(), $("#cus_id").val());
      });
    },
  };
  adapter_ajax($param);
}
function show_edit_cus() {
  Hide("#item-customer, #cus-btn_edit, #cus-btn_back");
  Show("#edit-item-customer, #cus-btn_save, #cus-btn_return");
}
function hide_edit_cus() {
  Show("#item-customer, #cus-btn_edit, #cus-btn_back");
  Hide("#edit-item-customer, #cus-btn_save, #cus-btn_return");
}
function toggle_detail_order($id) {
  $(".i-detail-order-" + $id).toggleClass("fa-minus-circle");
  $(".i-detail-order-" + $id).toggleClass("fa-plus-circle");
  $("#tr-detail-order-" + $id).toggle(100);
}
function show_order_detail_cus($id) {
  $data = {
    ajax: "show_order_detail_cus",
    id: $id,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#order_content").html(data);
    },
  };
  adapter_ajax($param);
}
function show_order_history_cus($cus_id) {
  $data = {
    ajax: "show_order_history_cus",
    id: $cus_id,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#order_content").html(data);
      $(".cus_detail_page").click(function () {
        cus_detail_paging($(this).val(), $cus_id);
      });
    },
  };
  adapter_ajax($param);
}
function del_order_cus($orderId, $cusId, $status) {
  var conf = "Do you want delete this orders?";
  if (confirm(conf)) {
    if ($status == 1 || $status == 2) {
      showMessesWrong(
        "#notice",
        "Orders cannot be deleted when they are pending or in progress"
      );
    } else {
      var $page = $("#cus_detail_page").val();
      $data = {
        ajax: "del_order_cus",
        orderId: $orderId,
      };
      $param = {
        type: "post",
        url: url,
        data: $data,
        callback: function (data) {
          cus_detail_paging($page, $cusId);
          showMessesTrue("#notice", data);
        },
      };
      adapter_ajax($param);
    }
  }
}
/**========= end customer =============*/

/**========= START orders =============*/
function load_order() {
  var $page = $("#pages").val();
  $data = { ajax: "load_order", page: $page };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#content__right").html(data);
      date_time_picker();
      checkSearch_order();
      status_change_bg();
      load_ord_notice();
      getPage(".orders_page", order_paging);
    },
  };
  adapter_ajax($param);
}
function order_paging($page = 1) {
  var $search_text = $("#inp-sOrd-text").val().trim();
  var $type_s = $("#ckb-sOrd-type").prop("checked");
  var $search_op = [];
  var $date_start = $("#search-date-from").val().trim();
  var $date_end = $("#search-date-to").val().trim();
  var $order_by;
  var $order_type;
  window.history.pushState(null, null, "?controller=orders&page=" + $page);

  $(".chose-item").each(function () {
    if ($(this).prop("checked")) $search_op.push($(this).val());
  });
  if ($(".checkAll").prop("checked")) {
    $search_op = [];
  }
  $(".rad-sOrd_by").each(function () {
    if ($(this).prop("checked")) $order_by = $(this).val();
  });
  $(".rad-sADesc").each(function () {
    if ($(this).prop("checked")) $order_type = $(this).val();
  });

  $data = {
    ajax: "order_paging",
    page: $page,
    search_text: htmlEntities($search_text),
    type_s: $type_s,
    search_op: $search_op,
    date_start: htmlEntities(formatDate($date_start, "ymd", "-")),
    date_end: htmlEntities(formatDate($date_end, "ymd", "-")),
    order_by: $order_by,
    order_type: $order_type,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#order-body").html(data);
      status_change_bg();
      $("#pages").val($page);
      getPage(".orders_page", order_paging);
    },
  };
  adapter_ajax($param);
}
function show_detail_order(
  $odrId,
  $container = ".orders_container",
  $option = 0
) {
  $type = "edit";
  if (String($container) != ".orders_container") {
    $type = "view";
  }
  $data = {
    ajax: "show_detail_order",
    id: $odrId,
    type: $type,
    option: $option,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $($container).html(data);
      status_change_bg();
      status_check_ord();
    },
  };
  adapter_ajax($param);
}
function udp_order_status($orderId) {
  var conf = "Click ok to update.";
  if (confirm(conf)) {
    var $status;
    $(".status-item").each(function () {
      if ($(this).prop("checked")) $status = $(this).val();
    });
    $data = {
      ajax: "udp_order_status",
      orderId: $orderId,
      status: $status,
    };
    $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        showMessesTrue("#notice", "Successfully updated");
        $("#ordDetail-status").html(data);
        status_change_bg();
        status_check_ord();
      },
    };
    adapter_ajax($param);
  }
}
function del_order($orderId, $status) {
  var conf = "Do you want delete this orders?";
  if (confirm(conf)) {
    if ($status == 1 || $status == 2) {
      showMessesWrong(
        "#notice",
        "Orders cannot be deleted when they are pending or in progress"
      );
    } else {
      var $page = $("#orders_page").val();
      $data = {
        ajax: "del_order",
        orderId: $orderId,
      };
      $param = {
        type: "post",
        url: url,
        data: $data,
        callback: function (data) {
          order_paging($page);
          showMessesTrue("#notice", data);
        },
      };
      adapter_ajax($param);
    }
  }
}
function load_notice() {
  var $limit = $("#row_no").attr("limit");
  var $offset = $("#row_no").attr("lastId");
  var $total = $("#row_no").attr("total");
  if (Number($offset) < Number($total)) {
    $data = {
      ajax: "load_notice",
      limit: $limit,
      offset: $offset,
    };
    $param = {
      type: "post",
      url: url,
      data: $data,
      callback: function (data) {
        $offset = Number($limit) + Number($offset);
        $("#row_no").attr("lastId", Number($offset));
        $("#load_notice_result").append(data);
        $(".time_notice").timeago();
      },
    };
    adapter_ajax($param);
  } else {
    $(".notice_end").html("That is all !");
  }
}
function load_ord_notice() {
  $("#order_notice").scroll(function () {
    var $ord_scrollTop = Math.round($("#order_notice").scrollTop());
    var $scroll_height = Math.round($("#scrollbar_height").height());
    var $ord_height = Math.round($("#order_notice").height());
    if ($ord_scrollTop > $scroll_height - $ord_height + 15) {
      load_notice();
    }
  });
}
function status_change_bg() {
  $(".status_change_bg").each(function () {
    var item = $(this).html().trim();
    if (item == "Cancel") $(this).css("background", "rgb(211 47 48 / 88%)");
    else if (item == "Unprocessed")
      $(this).css("background", "rgb(229 172 0 / 94%)");
    else if (item == "Processing") $(this).css("background", "#9fafe8c9");
    else if (item == "Complete") $(this).css("background", "#9ABC32");
    else $(this).css("background", "rgb(211 47 48 / 88%)");
  });
}
function status_check_ord() {
  var status = $(".ordDetail-status .status_change_bg").attr("status");
  $(".status-item").each(function () {
    if ($(this).val() == status) {
      $(this).prop("checked", true);
    }
  });
}
function checkSearch_order() {
  $(".checkAll").change(function () {
    var mainInp = $(".chose_order-inp");
    if ($(this).is(":checked")) {
      $(".chose-item").each(function () {
        $(this).prop("checked", true);
      });
    } else {
      $(".chose-item").each(function () {
        $(this).prop("checked", false);
      });
    }
    mainInp.val("---- All orders ----");
  });
  $(".chose-item").click(function () {
    var mainInp = $(".chose_order-inp");
    var val = "";
    $(".chose-item").each(function (i) {
      if ($(this).prop("checked")) {
        val = val + $(".chose_val-" + i).html() + ", ";
      }
      mainInp.val(val.slice(0, val.length - 2));
    });
    if ($(this).is(":checked")) {
      var isAllChecked = 0;
      $(".chose-item").each(function () {
        if (!this.checked) isAllChecked = 1;
      });
      if (isAllChecked == 0) {
        $(".checkAll").prop("checked", true);
        mainInp.val("---- All orders ----");
      }
    } else {
      $(".checkAll").prop("checked", false);
    }
    if (mainInp.val().trim().length == 0) {
      mainInp.val("---- All orders ----");
    }
  });
}
/**========= end orders =============*/
/**========= start revenue =============*/
function load_revenue($option = 1) {
  $data = {
    ajax: "load_revenue",
    option: $option,
  };
  var $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#content__right").html(data);
      $(".rev-classify").each(function () {
        if ($(this).val() == $option) {
          $(this).prop("checked", true);
        }
      });
      date_time_picker();
      revenue_paging($("#pages").val());
    },
  };
  adapter_ajax($param);
}
function revenue_paging($page = 1) {
  var $option;
  var $order_type;
  var $search_text = $("#inp-sRev-text").val().trim();
  var $type_s = $("#ckb-sRev-type").prop("checked");
  var $date_start = $("#search-date-from").val().trim();
  var $date_end = $("#search-date-to").val().trim();
  window.history.pushState(null, null, "?controller=revenue&page=" + $page);

  $(".rev-classify").each(function () {
    if ($(this).prop("checked")) {
      $option = $(this).val();
    }
  });
  if ($option == 1)
    $("#inp-sRev-text").attr(
      "placeholder",
      "Enter order code, cus name, method pay to search"
    );
  else if ($option == 2)
    $("#inp-sRev-text").attr(
      "placeholder",
      "Enter customer code, customer name, phone, email to search"
    );
  else if ($option == 3)
    $("#inp-sRev-text").attr(
      "placeholder",
      "Enter event code, event name to search"
    );
  $(".rev-sADesc").each(function () {
    if ($(this).prop("checked")) $order_type = $(this).val();
  });
  $data = {
    ajax: "revenue_paging",
    page: $page,
    option: $option,
    search_text: htmlEntities($search_text),
    type_s: $type_s,
    date_start: htmlEntities(formatDate($date_start, "ymd", "-")),
    date_end: htmlEntities(formatDate($date_end, "ymd", "-")),
    order_type: $order_type,
  };
  $param = {
    type: "post",
    url: url,
    data: $data,
    callback: function (data) {
      $("#revenue-body").html(data);
      $("#pages").val($page);
      getPage(".revenue_page", revenue_paging);
    },
  };
  adapter_ajax($param);
}
/**========= end revenue =============*/

function set_current_week() {
  var date = new Date();
  var first = date.getDate() - 6;
  var last = date.getDate();
  var start = new Date(date.getFullYear(), date.getMonth(), first)
    .toISOString()
    .split("T")[0];
  var end = new Date(date.setDate(last)).toISOString().split("T")[0];
  $("#search-date-from").val(formatDate(start));
  $("#search-date-to").val(formatDate(end));
}

function set_current_month() {
  var date = new Date();
  var first = new Date(date.getFullYear(), date.getMonth(), 2);
  var last = new Date(date.getFullYear(), date.getMonth() + 1, 1);
  var start = first.toISOString().split("T")[0];
  var end = last.toISOString().split("T")[0];
  $("#search-date-from").val(formatDate(start));
  $("#search-date-to").val(formatDate(end));
}

function set_current_quarter() {
  var date = new Date();
  var quarter = Math.floor(date.getMonth() / 3);
  var firstDate = new Date(date.getFullYear(), quarter * 3, 2);
  var lastDate = new Date(firstDate.getFullYear(), firstDate.getMonth() + 3, 1);
  var start = firstDate.toISOString().split("T")[0];
  var end = lastDate.toISOString().split("T")[0];
  // $('#search-date-from').datepicker("setDate", firstDate);
  // $('#search-date-to').datepicker("setDate", new Date(firstDate.getFullYear(), firstDate.getMonth() + 3, 1));
  $("#search-date-from").val(formatDate(start));
  $("#search-date-to").val(formatDate(end));
}

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
