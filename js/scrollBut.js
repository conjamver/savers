$(document).ready(function() {
    scrollBut = document.getElementById("scrollBut");
    
    //CODE WRONG
    document.addEventListener("scroll", function(){ 
        if(document.body.scrolltop > 100 || document.documentElement.scrolltop > 100){
            scrollbut.style.display = "block";
            
        }else{
            scrollBut.style.display = "none";
        }
    });
    
    scrollbut.addEventListener("scroll", function(){ 
        alert("test");
    
    });
});