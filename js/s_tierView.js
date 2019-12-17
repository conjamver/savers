$(document).ready(function () {
    //Variable declaration-----
    
    var tierSelector = $(".tierSelector");
    var saverTiers = $("#saverTiers");
    
    //colours
    var bg_s = "#8e44ad";
    var bg_a = "#3498db";
    var bg_b = "#27ae60";
    var bg_c = "#f39c12";
    //End of var declaration.
    

    //Listen for a click
    for (let i = 0; i < tierSelector.length; i++) {
        tierSelector[i].addEventListener("click", function(){
            
            if(tierSelector[i].classList.contains("tier-s")){
                //alert(saverTiers);
                //saverTiers.style.backgroundColor = bg_s;
                saverTiers.css("backgroundColor", bg_s);
                //execute code to change background colour
            }
            else if(tierSelector[i].classList.contains("tier-a"))
            {
                //alert("Clicked saa");
                saverTiers.css("backgroundColor", bg_a);
            }
            else if(tierSelector[i].classList.contains("tier-b"))
            {
                saverTiers.css("backgroundColor", bg_b);
            }
            
            else if(tierSelector[i].classList.contains("tier-c"))
            {
               saverTiers.css("backgroundColor", bg_c);
            }
        
        
        });//End of event listen
    }//end of looper
});//End of document ready


//////NOOOTTEEEE
/*For number of accounts, we can make little white boxes with icon in middle showing number and text underneath number define what it is inside

Total number in that tier
Average interest in that tier.
*/