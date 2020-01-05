//Load HTML doc before we run code
$( document ).ready(function() {
    //Select Amount txtbox and then run key down function
    var titlePage = document.title;
    var navLinks = document.getElementsByClassName("nav-link");
    
    
    
    //Determine which page is active by checking title contents
    if(titlePage.match(/Contact.*/)){
        resetActive();
        navLinks[3].classList.add("active");
    }
    else if(titlePage.match(/About.*/))
    {
        resetActive();
        navLinks[1].classList.add("active");
    }
    else if(titlePage.match(/Savings.*/))
    {
        resetActive();
        navLinks[0].classList.add("active");       
    }
    else if(titlePage.match(/Articles.*/))
    {
        resetActive();
        navLinks[2].classList.add("active");       
    }
    
    else
    {
        resetActive();   
    }
    

 
 
    //////////////RESET FUNCTION//////////////
    function resetActive(){
        var tier = $(".nav-link");
        for (let i = 0; i < tier.length; i++) 
        {
            if(tier[i].classList.contains("active")){
               tier[i].classList.remove("active");
            }
        }
        
    }
    
    
    

});