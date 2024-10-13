(function ($) {
  $(document).ready(function () {
    const forward = () => {
      let currDot = $("#timeLine .active");
      let curIndex = currDot.prevAll().length;
      let liLen = $("#timeLine ul li").length;

      if (curIndex < liLen - 2) {
        currDot.next("li").addClass("active");
        currDot.removeClass("active");
        $(".slide[data-slide=" + curIndex + "]").removeClass("shown");
        $(".slide[data-slide=" + (curIndex + 1) + "]").addClass("shown");
      } else if (curIndex != 8) {
        currDot.removeClass("active");
        $("#timeLine li:nth-child(9)").addClass("active");
        setTimeout(function () {
          $("#timeLine li:nth-child(9)").removeClass("active");
          $(".slide").removeClass("shown");
          $(".slide[data-slide=0]").addClass("shown");
        }, 2500);
      } else {
        $("#timeLine li:nth-child(1)").addClass("active");
      }
    };
    $(".tl-item:not(.flag)").on("click", function () {
      $("#timeLine li").removeClass("active");
      $(this).addClass("active");
      var parentIndex = $(this).prevAll().length;
      $(".slide").removeClass("shown");
      $(".slide[data-slide=" + parentIndex + "]").addClass("shown");
    });

    $("#heroWrapper").each(function () {
      var hovered = false;
      var loop = window.setInterval(function () {
        if (!hovered) {
          forward();
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
