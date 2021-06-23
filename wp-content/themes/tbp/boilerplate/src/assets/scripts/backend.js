import * as jQuery from "jquery";
import "jquery-ui/ui/core";
import "bootstrap";
import "block-ui";
import "popper.js";

$(function () {


	let config = typeof backendData !== "undefined" ? backendData : null;

  var check_records = 0,
    check_profile_data = 0;

  function tbp_fetch_data(count, dataRows) {
    var dataNum = dataRows.length;
    var table = $(".table");

    if ($(".check_records").prop("checked")) {
      check_records = 1;
    }

    if ($(".check_profile_data").prop("checked")) {
      check_profile_data = 1;
    }

    var pval = Math.ceil((100 * (count + 1)) / dataNum);

    if (count < dataNum) {

      $.ajax({
        url: config.ajaxUrl,
        dataType: "JSON",
        type: "POST",
        data: {
          action: "check_fighter_boxrec_data",
          boxer_id: dataRows[count].boxer_id,
          boxrec_id: dataRows[count].boxrec_id,
          check_profile_data: check_profile_data,
          check_records: check_records,
        },
      })
        .done(function (response) {

          $(".progress-bar").data("aria-valuenow", pval);
          $(".progress-bar").css({ width: pval + "%" });
          $(".progress-bar").html(pval + "%");

          if (count % 10 == 0) {
            $(".fighter-msg").html(response.result);
          } else {
            $(".fighter-msg").append(response.result);
          }

          tbp_fetch_data(count + 1, dataRows); // Fetch next one
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
          console.log(textStatus + ": " + errorThrown);
          $(".fighter-msg").append(
            "<p>" + textStatus + ": " + errorThrown + "</p>"
          );
        });
    } else {
      console.log("Fetching Fighters Data is completed.");
      console.groupEnd();

      $(".progress").before(
        '<p class="result-msg">Fetching Fighters Data is completed</br><a href="#" class="tbp-unblock">Close Pop up</a></p>'
      );
      $(".blockOverlay, .blockMsg").css("cursor", "auto");
    }
  }

  $(document).on("click", ".tbp-unblock", function (e) {
    e.preventDefault();
    $.unblockUI();
    $(".progress-bar").data("aria-valuenow", 0);
    $(".progress-bar").css({ width: 0 + "%" });
    $(".progress-bar").html(0 + "%");
    $(".result-msg").remove();
    $(".fighter-msg").html("");
  });

  $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });

  $(".get_fighter_boxrec_id").on("click", function () {
    var $this = $(this);
    var parent_table = $this.parents(".table");
    var boxer_name = $this.parents("tr").find("#boxer_name").val();
    var boxer_id = $this.parents("tr").find("#boxer_id").val();
    var boxrec_id_td = $this.parents("tr").find(".boxrec-id");

    parent_table.block({
      message: '<i class="fas fa-sync fa-spin"></i> ',
      overlayCSS: {
        backgroundColor: "#fff",
        opacity: 0.8,
        cursor: "wait",
      },
      css: {
        border: 0,
        padding: 0,
        backgroundColor: "transparent",
      },
    });

    $.ajax({
      url: config.ajaxUrl,
      dataType: "JSON",
      type: "POST",
      data: {
        action: "get_fighter_boxrec_id",
        full_name: boxer_name,
        boxer_id: boxer_id,
      },
      success: function (response) {
        boxrec_id_td.html(response.boxrec_id);
        parent_table.unblock();
        if ($.isNumeric(response.boxrec_id)) {
          $this.remove();
        }
      },
      error: function (errorThrown) {
        console.log(errorThrown);
      },
    });
  });

  $(".check_fighter_boxrec_data").on("click", function () {
    var $this = $(this);
    var parent_table = $this.parents(".table");
    var boxer_id = $this.parents("tr").find("#boxer_id").val();
    var boxrec_id = $this.parents("tr").find(".boxrec-id a").html();
    var check_records = 0,
      check_profile_data = 0;

    if ($(".tbp-data-checkboxes input:checked").length > 0) {
      if ($(".check_records").prop("checked")) {
        check_records = 1;
      }

      if ($(".check_profile_data").prop("checked")) {
        check_profile_data = 1;
      }
    } else {
      $(".tbp-validate-model").modal();
      return false;
    }

    parent_table.block({
      message: '<i class="fas fa-sync fa-spin"></i> ',
      overlayCSS: {
        backgroundColor: "#fff",
        opacity: 0.8,
        cursor: "wait",
      },
      css: {
        border: 0,
        padding: 0,
        backgroundColor: "transparent",
      },
    });

    $.ajax({
      url: config.ajaxUrl,
      dataType: "JSON",
      type: "POST",
      data: {
        action: "check_fighter_boxrec_data",
        boxer_id: boxer_id,
        boxrec_id: boxrec_id,
        check_profile_data: check_profile_data,
        check_records: check_records,
      },
      success: function (response) {
        parent_table.unblock();
        parent_table.block({
          message: response.result,
          overlayCSS: {
            backgroundColor: "#fff",
            opacity: 0.8,
            cursor: "wait",
          },
          timeout: 3000,
          css: {
            border: 0,
            padding: 0,
            backgroundColor: "transparent",
          },
        });
      },
      error: function (errorThrown) {
        console.log(errorThrown);
      },
    });
  });

  $(".table .custom-control-input").on("change", function () {
    var $this = $(this);
    var checkboxValue;
    var boxer_id = $this.parents("tr").find("#boxer_id").val();
    var parent_tr = $this.parents(".table");

    if ($this.is(":checked")) {
      checkboxValue = 1;
    } else {
      checkboxValue = 0;
    }

    parent_tr.block({
      message: '<i class="fas fa-sync fa-spin"></i> ',
      overlayCSS: {
        backgroundColor: "#fff",
        opacity: 0.8,
        cursor: "wait",
      },
      css: {
        border: 0,
        padding: 0,
        backgroundColor: "transparent",
      },
    });

    $.ajax({
      url: config.ajaxUrl,
      dataType: "JSON",
      type: "POST",
      data: {
        action: "change_boxer_visibility",
        visibility: checkboxValue,
        boxer_id: boxer_id,
      },
      success: function (response) {
        if (response.message == "success") {
          parent_tr.unblock();
        }
      },
      error: function (errorThrown) {
        console.log(errorThrown);
      },
    });
  });

  $(".update_all_records").on("click", function () {
    var $this = $(this);
    var dataRows = [];

    if ($(".tbp-data-checkboxes input:checked").length < 1) {
      $(".tbp-validate-model").modal();

      return false;
    }

    $(".table tbody")
      .find("tr")
      .each(function () {
        dataRows.push({
          boxer_id: $(this).find("#boxer_id").val(),
          boxrec_id: $(this).find(".boxrec-id a").html(),
        });
      });

    console.group("Retrieving Form Fighters");
    console.log("Retrieving fighters data process started.");

    $.blockUI({
      message: $(".tbp-model"),
      css: {
        top: "5%",
      },
      overlayCSS: {
        opacity: 0.8,
        cursor: "wait",
      },
    });

    tbp_fetch_data(0, dataRows);
  });
});
