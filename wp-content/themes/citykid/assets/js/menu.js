document.addEventListener("DOMContentLoaded", function(){
  
  const navSelector = ".sticky-header-on";
  const navTopbarSelector = ".sticky-header-on .topbar-section";

  const navScrollClass = "scroll";  
  const navFixedTopClass = "fixed-top";  
  const topbarTooggleClass = "visually-hidden"; 

  const topbarSelector = document.querySelector('.topbar-section');
  const navbarSelector = document.querySelector('.navbar-section');
  let navbarHeight = 0, topbarrHeight = 0;
  if(topbarSelector !== null){
    navbarHeight = navbarSelector.offsetHeight;
    document.querySelector(':root').style.setProperty('--citykid-navbar-height', navbarSelector.offsetHeight + 'px');
  }
  if(topbarSelector !== null){
    topbarrHeight = topbarSelector.offsetHeight;
    document.querySelector(':root').style.setProperty('--citykid-topbar-height', topbarSelector.offsetHeight + 'px');
  }
  

  if(document.querySelectorAll(navSelector).length > 0){
    let headerHeight = document.querySelector(navSelector).offsetHeight;
    window.addEventListener('scroll', function() {
        if (window.scrollY > topbarrHeight) {
          document.querySelector(navSelector).classList.add(navFixedTopClass, navScrollClass);
          if(document.querySelector(navTopbarSelector)){
            document.querySelector(navTopbarSelector).classList.add(topbarTooggleClass);
          }
          // add padding top to show content behind navbar
        
          document.querySelector(':root').style.setProperty('--citykid-header-height', headerHeight + 'px');
        } else {
          document.querySelector(navSelector).classList.remove(navFixedTopClass, navScrollClass);
          if(document.querySelector(navTopbarSelector)){
            document.querySelector(navTopbarSelector).classList.remove(topbarTooggleClass);
          }
          
          // remove padding top from body
          document.querySelector(':root').style.setProperty('--citykid-header-height', 0);
        } 
    });
  }
  
  
  
}); 
