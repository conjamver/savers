//Load HTML doc before we run code
$( document ).ready(function() {

    //declare
    var alertErr = $(".alertExit");
    var saveAmount = $("#saveAmount");
    //Close Error Box **THIS CAN BE OPTIMISED TO SEARCH parent then
    for (let i = 0; i < alertErr.length; i++) {

        alertErr[i].addEventListener("click", function(){

        this.parentElement.parentElement.parentElement.parentElement.classList.add("inactive");



        });

    }

});


    
    
