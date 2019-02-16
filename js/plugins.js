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
});
