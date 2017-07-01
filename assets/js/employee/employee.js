$(function() {
  $("a.hyperlink").on("click",function(e) {
    e.preventDefault();
    $.post(this.href,function(data) {
      $("#employee-content-body").html(data);
    });
  });
});	