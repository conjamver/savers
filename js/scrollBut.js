$(document).ready(function() {
    
    
    //Controls the scroll to top function
    $("#scrollBut").click(function(){
        $('html, body').animate({scrollTop : 0},400);
    });
    
    
    //Determine whether to show or hide button
    $(window).scroll(function(){
        if($(this).scrollTop() > 40){
            $("#scrollBut").stop();
            $("#scrollBut").fadeIn();
            
        }else{
            $("#scrollBut").stop();
            $("#scrollBut").fadeOut();
        }
    });
    
});