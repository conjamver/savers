$(document).ready(function () {
    //Variable declaration-----
    
    var tierSelector = $(".tierSelector");
    var tierView = $(".tierView");
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
             
                saverTiers.css("backgroundColor", bg_s);
                resetActive();
                tierSelector[i].classList.add("t-active");
                contentControl("tview-s");

                
            }
            else if(tierSelector[i].classList.contains("tier-a"))
            {
                //alert("Clicked saa");
                saverTiers.css("backgroundColor", bg_a);
                resetActive();
                tierSelector[i].classList.add("t-active");
                contentControl("tview-a");
            }
            else if(tierSelector[i].classList.contains("tier-b"))
            {
                saverTiers.css("backgroundColor", bg_b);
                resetActive();
                tierSelector[i].classList.add("t-active");
                contentControl("tview-b");
            }
            
            else if(tierSelector[i].classList.contains("tier-c"))
            {
               saverTiers.css("backgroundColor", bg_c);
                resetActive();
                tierSelector[i].classList.add("t-active");
                contentControl("tview-c");
            }
        
        
        });//End of event listen
    }//end of looper
    
    
    
    //Function to show/hide Content
    function contentControl(myID){
       // var thisID = document.getElementById(myID);
        var thisView = document.getElementsByClassName("tierView");
        
        for (let i = 0; i < thisView.length; i++) {
            //alert(i);
            //First, remove inactive where = id
            if(thisView[i].id == myID){
               
                //Remove inactive class
                if(thisView[i].classList.contains("inactive")){
                    thisView[i].classList.remove("inactive");
                }
                
            }else{
                if(!thisView[i].classList.contains("inactive")){
                    thisView[i].classList.add("inactive");
                }
            }
        }
        
        
    }//END OF SHOW/HIDE FUNCTION
    

    
    
    
    //Function that gets rid of active class on buttons
    function resetActive(){
        var tier = $(".tierSelector");
        for (let i = 0; i < tierSelector.length; i++) 
        {
            if(tier[i].classList.contains("t-active")){
               tierSelector[i].classList.remove("t-active");
            }
        }
        
    }
    ////END OF FUNCTION
    
    
});//End of document ready


//////NOOOTTEEEE
/*For number of accounts, we can make little white boxes with icon in middle showing number and text underneath number define what it is inside

Total number in that tier
Average interest in that tier.
*/