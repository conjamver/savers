//Load HTML doc before we run code
$( document ).ready(function() {
        //Declare Variables
        var s_btnYear = document.getElementsByClassName("s_btnYear");
        var s_btnMonth = document.getElementsByClassName("s_btnMonth");
        var s_btnAllYr = document.getElementsByClassName("s_btnAllYr");
        var s_btnAllMth = document.getElementsByClassName("s_btnAllMth");
        var amtViewInt = document.getElementsByClassName("amtViewInt");  
        var myIndex = 0;
       
        

    
        //Looper for yearly view 
        for(let i = 0; i < s_btnYear.length; i++){
            s_btnYear[i].addEventListener("click", function(){ 
                myindex = i;
                
                //Select the individiual saver
                var amtViewInt = document.getElementsByClassName("amtViewInt")[myindex];
                
                //Get view type collection related to amtViewInt parent
                var s_viewType = amtViewInt.getElementsByClassName("s_viewType");
                    
                    //Show/Hide elements
                    if(s_viewType[1].classList.contains('inactive')) {
                        s_viewType[0].classList.add("inactive");
                        s_viewType[1].classList.remove("inactive");
                        
                        //Select active class on button
                        //Check if active class exist first.
                        if(!s_btnYear[i].classList.contains('active')){
                            s_btnYear[i].classList.add("active");
                            s_btnMonth[i].classList.remove("active");   
                        }

                    }
                
                //Determine whether to disable buttons
                if(countView("s_viewTypeYr") == 0){
                    toggleBtn(true,s_btnAllYr);
                    
                }else{
                    //Activate button again
                    toggleBtn(false,s_btnAllYr);
                }
                
                
                if(countView("s_viewTypeMth") == 0){
                    toggleBtn(true,s_btnAllMth);
                    
                }else{
                    //Activate button again
                    toggleBtn(false,s_btnAllMth);
                    
                }    

            });
  
        }
        
          
        //looper for monthly interest
        for(let i = 0; i < s_btnMonth.length; i++){
            s_btnMonth[i].addEventListener("click", function(){ 
                myindex = i;
                
                //Select the individiual saver
                var amtViewInt = document.getElementsByClassName("amtViewInt")[myindex];
                
                //Get view type collection related to amtViewInt parent
                var s_viewType = amtViewInt.getElementsByClassName("s_viewType");
                
                    if(s_viewType[0].classList.contains('inactive')) {
                        s_viewType[1].classList.add("inactive");
                        s_viewType[0].classList.remove("inactive");
                        
                         //Select active class on button
                        if(!s_btnMonth[i].classList.contains('active')){
                             s_btnYear[i].classList.remove("active");
                            s_btnMonth[i].classList.add("active");
                        }
                       
                    }
                //alert(countView("s_viewTypeYr"));
                
                 //Determine whether to disable buttons
                if(countView("s_viewTypeYr") == 0){
                    toggleBtn(true,s_btnAllYr);
                    
                }else{
                    //Activate button again
                    toggleBtn(false,s_btnAllYr);
                }
                
              if(countView("s_viewTypeMth") == 0){
                    toggleBtn(true,s_btnAllMth);
                    
                }else{
                    //Activate button again
                    toggleBtn(false,s_btnAllMth);
                    
                }
                

                   
            });
            

            
        }
    
    
    
         //Button that toggles yearly view on all savers visible.
         for (let i = 0; i < s_btnAllYr.length; i++) {
             s_btnAllYr[i].addEventListener("click", function () {

                 myindex = i;
                 //Run looper when we click button.
                 for (let y = 0; y < amtViewInt.length; y++) {

                     //Get buttons in each individual saver item
                     var s_btn = amtViewInt[y].getElementsByTagName("button");
                     var s_viewType = amtViewInt[y].getElementsByClassName("s_viewType");
                     
                     
                     //Show/Hide elements
                    if(s_viewType[1].classList.contains('inactive')) {
                        s_viewType[0].classList.add("inactive");
                        s_viewType[1].classList.remove("inactive");
                    }
                     
                     
                     //loop through all buttons within saver
                     for (let x = 0; x < s_btn.length; x++) {
                        
                         //Remove active class from all month buttons
                         if(!s_btn[x].classList.contains("s_btnYear")){
                             s_btn[x].classList.remove("active");
                        
                         }
                         
                         //Add active class to year button
                         if(s_btn[x].classList.contains("s_btnYear")){
                            s_btn[x].classList.add("active");
                         }


                     }//End of button looper

                 }//End of Saver Item Loops
           
                 
                 //Determine whether to disable buttons
                if(countView("s_viewTypeYr") == 0){
                    toggleBtn(true,s_btnAllYr);
                    
                }else{
                    //Activate button again
                    toggleBtn(false,s_btnAllYr);
                }
                 
                 
               //alert(countView("s_viewTypeMth"));
                 
                 if(countView("s_viewTypeMth") == 0){
                    toggleBtn(true,s_btnAllMth);
                    
                }else{
                    //Activate button again
                    toggleBtn(false,s_btnAllMth);
                    
                }
                 
                

             });//End of click event listener

         }//End of Year all button looper.

    
    
    
    
    
    
    ////**************FUNCTIONS OF SAVER ITEMS*********************////
    
    
    //toggleOn is boolean, 
    function toggleBtn(toggleOn,myClass){
        //declare var
        var thisClass = myClass;
        
        if(toggleOn == true){
            for(let z = 0; z < thisClass.length; z++){
                thisClass[z].classList.add("disabled");
            }
        //Toggle Off
        }else{ 
             for(let z = 0; z < thisClass.length; z++){
                thisClass[z].classList.remove("disabled");
             }
        }
    }
    
    
    //function that count s_viewType elements. Takes class name parameter
    function countView(myClass){
        var yearCount = 0;
        var thisClass = document.getElementsByClassName(myClass);
        
        //Loop through all savers with year class?
        for (let i = 0; i < thisClass.length; i++) {
             
            //alert(s_viewTypeYr[i].textContent);
            if(thisClass[i].classList.contains("inactive")){
                yearCount++;
            }
            
        }
        
       return yearCount;
    }//End of count function
    
    
   
    

}); //End of DOCUMENT GET READY


    

