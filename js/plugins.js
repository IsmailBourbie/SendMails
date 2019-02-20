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
      } else {
          $(this).parent().siblings(0).fadeOut();
      }
    });

    // show html config btn on html file selected
    $("#chooseHtmlFile").change(function(){
      if (this.value != '') {
        $('#showHtmlModal').fadeIn();
      } else {
        $('#showHtmlModal').fadeOut();
      }
    });


    // send mails data using ajax
    $('form').submit(function (e) {
      e.preventDefault();
      var inputs = {
        'sender': $('#sender').val().trim(),
        'receivers': "",
        'subject': $('#subject').val().trim(),
        'body': "",
        'attachment': "",
        'images_dir': "",
        'replaced_txt': {
          'key': "",
          'val': ""
        }
      };
      if($('#receivers_inline').val().trim() != "") {
        inputs.receivers = $('#receivers_inline').val().trim();
      }

      if($('#receivers_file').val() != "") {
        inputs.receivers = $('#receivers_file').prop('files')[0];
      }
      console.log(new FormData(this));
      $.ajax({
        'method': 'POST',
        'url': 'app/index.php',
        'dataType': 'json',
        data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,

      }).done(function (msg) {
        console.log(msg);
      });
    });




});
