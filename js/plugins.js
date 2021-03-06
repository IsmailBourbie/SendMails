$(document).ready(function() {
  // tooltip
  $(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });

  // auto resize of textarea
  $("textarea.autosize")
    .each(function() {
      $(this).attr("style", "height:" + (this.scrollHeight - 15) + "px;");
    })
    .on("input", function() {
      this.style.height = "auto";
      this.style.height = this.scrollHeight - 15 + "px";
    });

  $("form.main-form").submit(function($e) {
    $e.preventDefault();
    let formData = {
      sender: {
        email: $("#sender_email")
          .val()
          .trim(),
        name: $("#sender_name")
          .val()
          .trim()
      },
      receivers: {
        type: $("input[name=receiversType]:checked", "form.main-form")
          .val()
          .trim(),
        data: ""
      },
      body: {
        type: $("input[name=bodyType]:checked", "form.main-form")
          .val()
          .trim(),
        data: "",
        subject: $("#subject")
          .val()
          .trim(),
        configuration: {
          images: {
            hasImages: $("input[name=hasImages]:checked", "#configForm")
              .val()
              .trim(),
            path: ""
          },
          replacedText: {
            hasReplacedText: $("input[name=hasReplaced]:checked", "#configForm")
              .val()
              .trim(),
            keys: ""
          }
        }
      },
      attachments: {
        hasAttachments: $("input[name=hasAttachment]:checked", "form.main-form")
          .val()
          .trim(),
        attachmentsFiles: ""
      }
    };
    // check for receivers type
    if (formData.receivers.type == "inline") {
      formData.receivers.data = $("#receivers_inline")
        .val()
        .trim();
    } else if (formData.receivers.type == "file") {
      formData.receivers.data = $("#receivers_file")
        .val()
        .trim();
    }

    // check for body type
    if (formData.body.type == "inline") {
      formData.body.data = $("#body_inline")
        .val()
        .trim();
    } else if (formData.body.type == "file") {
      formData.body.data = $("#body_file")
        .val()
        .trim();
    }

    // check for configuration params
    //// hasImages:
    if (formData.body.configuration.images.hasImages == "true") {
      formData.body.configuration.images.path = $("#images_temp")
        .val()
        .trim();
    } else if (formData.body.configuration.images.hasImages == "false") {
      formData.body.configuration.images.path = "";
    }
    //// hasReplaced
    if (formData.body.configuration.replacedText.hasReplacedText == "true") {
      formData.body.configuration.replacedText.keys = $("#replaced_txt")
        .val()
        .trim();
    } else if (formData.body.configuration.hasReplacedText == "false") {
      formData.body.configuration.replacedText.keys = "";
    }

    // check for attachments type
    if (formData.attachments.hasAttachments == "true") {
      formData.attachments.attachmentsFiles = $("#attachment_file")
        .val()
        .trim();
    } else if (formData.attachments.hasAttachments == "false") {
      formData.attachments.attachmentsFiles = "";
    }
    console.log(formData);

    $.ajax({
      method: "POST",
      url: "mail",
      dataType: "json",
      data: formData
    }).done(function(msg) {
      console.log(msg);
    });
  });

  $(".hasSomething > input[type=radio]").change(function() {
    if (this.value == "true") {
      $(this)
        .parent()
        .siblings(0)
        .fadeIn();
      $(this)
        .parent()
        .siblings(0)
        .children("input")
        .attr("required", true);
    } else if (this.value == "false") {
      $(this)
        .parent()
        .siblings(0)
        .fadeOut();
      $(this)
        .parent()
        .siblings(0)
        .children("input")
        .attr("required", false);
    }
  });

  $(".inputType > input[type=radio]").change(function() {
    var changedElement = $(this).parent(),
      receiversVal = this.value;
    if (receiversVal == "file") {
      changedElement.siblings(".inline").fadeOut(function() {
        changedElement.siblings(".file").fadeIn();
        changedElement
          .siblings(".file")
          .children("input, textarea")
          .attr("required", true);
        changedElement
          .siblings(".inline")
          .children("input, textarea")
          .attr("required", false);
      });
    } else if (receiversVal == "inline") {
      changedElement.siblings(".file").fadeOut(function() {
        changedElement.siblings(".inline").fadeIn();
        changedElement
          .siblings(".inline")
          .children("input, textarea")
          .attr("required", true);
        changedElement
          .siblings(".file")
          .children("input, textarea")
          .attr("required", false);
      });
    }
  });

  // show html config btn on html file selected
  $("input[name=bodyType]").change(function() {
    if (this.value == "file") {
      $("#showHtmlModal").fadeIn();
    } else {
      $("#showHtmlModal").fadeOut();
    }
  });

  // add template names to the inputs
  $(".tempName").blur(function() {
    var inputVal = this.value.replace(/\\+/g, "/").replace(/\/+/g, "/"),
      endOfStr =
        this.value.indexOf("/") === -1
          ? this.value.length - 1
          : this.value.indexOf("/");

    if (inputVal != "") {
      $(".tempName").each(function() {
        if (this.value == "") {
          $(this).val(inputVal.substring(0, endOfStr + 1));
        }
      });
    }
  });

  $("#configForm").submit(function(e) {
    e.preventDefault();
    $("#HtmlConfigModal").modal("hide");
  });
  $("#configForm").on("reset", function(e) {
    $(this)
      .find("input[value=no]")
      .click();
    $("#HtmlConfigModal").modal("hide");
  });
});
