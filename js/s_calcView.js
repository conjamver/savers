//Load HTML doc before we run code
$( document ).ready(function() {
        //Declare Variables
        var s_btnYear = document.getElementsByClassName("s_btnYear");
        var s_btnMonth = document.getElementsByClassName("s_btnMonth");
        var myIndex = 0;

        for(let i = 0; i < s_btnYear.length; i++){
            s_btnYear[i].addEventListener("click", function(){ 
                myindex = i;
                
                //Select the individiual saver
                var amtViewInt = document.getElementsByClassName("amtViewInt")[myindex];
                
                //Get view type collection related to amtViewInt parent
                var s_viewType = amtViewInt.getElementsByClassName("s_viewType");
                
                    if(s_viewType[1].classList.contains('inactive')) {
                        s_viewType[0].classList.add("inactive");
                        s_viewType[1].classList.remove("inactive");
                    }
                   
            });
            

            
        }
    });

    

