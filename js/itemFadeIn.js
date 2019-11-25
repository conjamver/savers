$( document ).ready(function() {
    var scrollPos = 0;
    var itemFade = document.querySelector('.itemFade');
    
    function checkPosition(){
        let windowY = window.scrollY;
        //alert(windowY);
        
        
        
        //Get current position of scroll
        scrollPos = windowY
    }
    
    
    //run scroll function
    window.addEventListener('scroll', checkPosition);
    
    
    
    //Source: https://dev.to/changoman/showhide-element-on-scroll-w-vanilla-js-3odm
});