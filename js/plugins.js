$(document).ready(function() {
  // tooltip
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });


// auto resize of textarea
  $('textarea.autosize').each(function () {
        $(this).attr('style', 'height:' + (this.scrollHeight - 15) + 'px;');
    }).on('input', function () {
        this.style.height = "auto";
        this.style.height = (this.scrollHeight - 15) + "px";
    });

    // hide element depending on radio buttons yes or no
    $('.hasSomething > input[type=radio]').change(function() {
      if(this.value == "yes"){
          $(this).parent().siblings(0).fadeIn();
          $(this).parent().siblings(0).children('input').attr("required", true);
      } else if (this.value == "no") {
          $(this).parent().siblings(0).fadeOut();
          $(this).parent().siblings(0).children('input').attr("required", false);
      }
    });

    $('.inputType > input[type=radio]').change(function() {
      var changedElement = $(this).parent(),
          receiversVal = this.value;
          if(receiversVal == "file"){
            changedElement.siblings(".inline").fadeOut(function () {
                changedElement.siblings(".file").fadeIn();
                changedElement.siblings(".file").children('input, textarea').attr("required", true);
                changedElement.siblings(".inline").children('input, textarea').attr("required", false);
            });
          } else if (receiversVal == "inline") {
            changedElement.siblings(".file").fadeOut(function () {
              changedElement.siblings(".inline").fadeIn();
              changedElement.siblings(".inline").children('input, textarea').attr("required", true);
              changedElement.siblings(".file").children('input, textarea').attr("required", false);
            });
          }
    });

    // show html config btn on html file selected
    $("input[name=bodyType]").change(function(){
      if (this.value == 'file') {
        $('#showHtmlModal').fadeIn();
      } else {
        $('#showHtmlModal').fadeOut();
      }
    });

    // add template names to the inputes
    $('.tempName').blur(function () {
      var inputVal = this.value.replace(/\\+/g, '/').replace(/\/+/g, '/'),
          endOfStr = this.value.indexOf('/') === -1 ? this.value.length - 1 : this.value.indexOf('/');

      if (inputVal != "") {
          $('.tempName').each(function () {
            if (this.value == "") {
              $(this).val(inputVal.substring(0, endOfStr + 1));
            }
          });
      }
    });

    $('#configForm').submit(function(e){
      e.preventDefault();
      $('#HtmlConfigModal').modal('hide');
    });
    $('#configForm').on('reset',function(e){
      $(this).find('input[value=no]').click();
      $('#HtmlConfigModal').modal('hide');
    });

    // send mails data using ajax
    $('form.main-form').submit(function (e) {
      e.preventDefault();
      var receivers_file = $('#receivers_file').val().trim(),
          body_file = $('#body_file').val().trim(),
          inputs = {
            'sender': $('#sender').val().trim(),
            'subject': $('#subject').val().trim(),
            'receivers_type': $("input[name=receiversType]:checked").val(),
            'body_type': $("input[name=bodyType]:checked").val(),
          };
      // check for type of inputs:
      // receivers_file
      if ($("input[name=receiversType]:checked").val() == "file") {inputs.receivers = $('#receivers_file').val().trim()}else {
        inputs.receivers = $('#receivers_inline').val().trim();
      }
      // body_file
      if ($("input[name=bodyType]:checked").val() == "file") {inputs.body = $('#body_file').val().trim()} else {
        inputs.body = $('#body').val().trim();
      }
      // there is attachments files
      if ($("input[name=hasAttachment]:checked").val() == "yes") {inputs.attachments = $("#attachment_file").val().trim();}
      // there is images
      if ($("input[name=hasImages]:checked").val() == "yes") {inputs.images_temp = $("#images_temp").val().trim();}
      // there is reeplaced text
      if ($("input[name=hasReplaced]:checked").val() == "yes") {inputs.replaced_txt = $("#replaced_txt").val().trim();}

      $.ajax({
        'method': 'POST',
        'url': 'app/index.php',
        'dataType': 'json',
        'data':  inputs,
      }).done(function (msg) {
        console.log(msg);
      });
    });




});
