//console.log("meowdy - js loaded");
(function ($) {
  $(document).ready(function () {
    console.log("jquery init");
    const forward = () => {
      //console.log('forward');
      let currDot = $("#timeLine .active");
      let curIndex = currDot.prevAll().length;
      let liLen = $("#timeLine ul li").length;
      console.log("Index: " + curIndex);
      console.log("Length: " + liLen);
      if (curIndex < liLen - 2) {
        currDot.next("li").addClass("active");
        currDot.removeClass("active");
        $(".slide[data-slide=" + curIndex + "]").removeClass("shown");
        $(".slide[data-slide=" + (curIndex + 1) + "]").addClass("shown");
      } else {
        currDot.removeClass("active");
        setTimeout(function () {
          $("#timeLine li:nth-child(1)").addClass("active");
          $(".slide").removeClass("shown");
          $(".slide[data-slide=0]").addClass("shown");
        }, 2500);
      }
    };
    //forward();
    $(".tl-item:not(.flag)").on("click", function () {
      console.log("clicked");
      //forward();
      $("#timeLine li").removeClass("active");
      $(this).addClass("active");
      //$(this).parent().css('border', '1px solid red');
      var parentIndex = $(this).prevAll().length;
      console.log("parent: ", parentIndex);
      $(".slide").removeClass("shown");
      $(".slide[data-slide=" + parentIndex + "]").addClass("shown");
    });

    $("#heroWrapper").each(function () {
      var hovered = false;
      var loop = window.setInterval(function () {
        if (!hovered) {
          forward();
          //console.log("forwarded");
        }
      }, 2500);

      $(this).hover(
        function () {
          hovered = true;
        },
        function () {
          hovered = false;
        }
      );
    });
  });
})(jQuery);
