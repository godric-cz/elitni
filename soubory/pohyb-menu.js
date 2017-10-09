
(function(){

  var isFixed = false;

  document.onscroll = function(e) {
    var top = e.pageY || window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    if(top > 182 && !isFixed) {
      menu.classList.add("fixed");
      isFixed = true;
    } else if(top <= 182 && isFixed) {
      menu.classList.remove("fixed");
      isFixed = false;
    }
  };

})();
