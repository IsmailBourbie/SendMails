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

    

});
