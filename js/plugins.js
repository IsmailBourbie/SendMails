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
    $('input[type=radio]').change(function() {
      if(this.value == "yes"){
          $(this).parent().siblings(0).fadeIn();
      } else if (this.value == "no") {
          $(this).parent().siblings(0).fadeOut();
      }
    });

    $('.inputType > input[type=radio]').change(function() {
      var changedElement = $(this).parent(),
          receiversVal = this.value;
          if(receiversVal == "file"){
            console.log($(this).parent().siblings(".inline"));
            changedElement.siblings(".inline").fadeOut(function () {
                changedElement.siblings(".file").fadeIn();
            });
          } else if (receiversVal == "inline") {
            changedElement.siblings(".file").fadeOut(function () {
              changedElement.siblings(".inline").fadeIn();
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


    // send mails data using ajax
    $('form').submit(function (e) {
      e.preventDefault();
      var receivers_file = $('#receivers_file').val().trim(),
        inputs = {
        'sender': $('#sender').val().trim(),
        'receivers': $('#receivers_inline').val().trim(),
        'subject': $('#subject').val().trim(),
        'body': $("#body").val().trim(),
        'attachment': "",
        'images_dir': "",
        'replaced_txt': {
          'key': "",
          'val': ""
        }
      };

      if(receivers_file != "" && receivers_file.substring(receivers_file.lastIndexOf('.') + 1, receivers_file.length) == "json") {
        inputs.receivers = receivers_file;
      }
      console.log(inputs.receivers);
      return false;
      $.ajax({
        'method': 'POST',
        'url': 'app/index.php',
        'dataType': 'json',
        'data':  inputs,
        'contentType': false,
        'cache': false,
        'processData':false,

      }).done(function (msg) {
        console.log(msg);
      });
    });




});
