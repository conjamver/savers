
//Load HTML doc before we run code
$( document ).ready(function() {
    //Select Amount txtbox and then run key down function
    var amtInput = $('#saveAmount');
    var amtSubmit = $('#submitAmount');

    amtInput.keyup(function(){
        //Check if a valid Number
        if(isNaN(amtInput.val())){

            //add error class and disable submit button
            amtInput.addClass("errInput");
            submitAmount.disabled = true;

        }else{
             //remove error class
            amtInput.removeClass("errInput");
            submitAmount.disabled = false;
        }
    });

});