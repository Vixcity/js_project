$(function(){

  $('.nano').nanoScroller({
    preventPageScrolling: true
  });
  $("#main").find('.description').load("content.html", function(){
    $(".nano").nanoScroller();
    $("#main").find("img").load(function() {
        $(".nano").nanoScroller();
    });
  });


});

