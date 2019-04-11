// $(function() {
//   var divs = $(".group");
//   var now = 0; // currently shown div
//   divs
//     .hide()
//     .first()
//     .show(); // hide all divs except first
//   $(".save").hide();
//   $(".prev").hide();
//   $("button[name=next]").click(function() {
//     divs.eq(now).hide();
//     //now = (now + 1 < divs.length) ? now + 1 : 0;
//     if (now + 1 <= divs.length) {
//       now = now + 1;
//       if (now == divs.length - 1) {
//         divs.eq(now).show();
//         $(".next").hide();
//         $(".prev").show();
//         $(".save").show();
//       } else {
//         $(".prev").show();
//         divs.eq(now).show();
//         $(".save").hide(); // show next
//       }
//     }
//   });
//   $("button[name=prev]").click(function() {
//     divs.eq(now).hide();
//     // now = (now > 0) ? now - 1 : divs.length - 1;

//     if (now > 0) {
//       now = now - 1;
//       divs.eq(now).show(); // show previous
//       if(now==0){
//         $(".prev").hide();
//       }
//     }
//   });
// });
// $(function() {
//   if ($total == count(q1)) {
//   }
// });
$(function() {
  var divs = $('.group');
  var now = 0; // currently shown div
  divs.hide().first().show(); // hide all divs except first
  $("button[name=save]").click(function() {
      divs.eq(now).hide();
      now = (now + 1 < divs.length) ? now + 1 : 0;
      if(now== divs.length-1){
          $('save').removeClass('displaybutton');
      }else{
          divs.eq(now).show(); // show next
      }
    
  });
  $("button[name=prev]").click(function() {
      divs.eq(now).hide();
      now = (now > 0) ? now - 1 : divs.length - 1;
      divs.eq(now).show(); // show previous
  });
});
$(function(){
if($total==count(q1)){

}
});
