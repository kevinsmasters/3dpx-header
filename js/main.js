console.log('meowdy - js loaded');

const forward =()=> {
    let currDot = $('#timeLine .active');
    let curIndex = currDot.index( "li" );
    let liLen = $("#timeLine ul li").length;
    //console.log("Index: " + curIndex );
    //console.log("Length: " + liLen);
    if(curIndex < liLen -2) {
      currDot.next('li').addClass('active');
      currDot.removeClass('active');
      $('.slide[data-slide='+curIndex  +']').removeClass('shown');
      $('.slide[data-slide='+(curIndex +1) +']').addClass('shown');
    } else {
      currDot.removeClass('active');
      setTimeout(function() {
        $('#timeLine li:nth-child(1)').addClass('active');
        $('.slide').removeClass('shown');
        $('.slide[data-slide=0]').addClass('shown');
      }, 2500
      
      )
      
    }
  }
  //forward();
  $('.dot:not(.flag)').on('click', function(){
    //forward();
    $('li').removeClass('active');
    $(this).parent().addClass('active');
    let parentIndex = $(this).parent().index( "li" );
    //console.log("parent: ", parentIndex);
    $('.slide').removeClass('shown');
    $('.slide[data-slide='+(parentIndex) +']').addClass('shown');
  });
  
  $('#heroWrapper').each(function () {
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