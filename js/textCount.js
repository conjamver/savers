//Load HTML doc before we run code
$( document ).ready(function() {

    //declare Variables
    var textArea = $("#c_message");
    var wordCounter = $("#word-counter");
    var maxAmt = 500;
    var words = textArea.val().length;
    
    //Initiate starting limit
   // var words = textArea.value.length;
    wordCounter.text(maxAmt - words);
    
    
    //Determine the colour to display when page first loads
        if((maxAmt - words) < maxAmt && (maxAmt - words) >= 250){
            wordCounter.css("color", "green");
        }else if((maxAmt - words) < 250 && (maxAmt - words) >= 50)
        {
           wordCounter.css("color", "orange"); 
        }else if((maxAmt - words) < 50 && (maxAmt - words) >=0){
            wordCounter.css("color", "red"); 
        }
    
    
    
    
    
    //Execute when user keu up in text area
    textArea.on('keyup', function() {
   
        //Get amount of words
        words = this.value.length;
        wordCounter.text(maxAmt - words);
        
        //Determine the colour to display
        if((maxAmt - words) < maxAmt && (maxAmt - words) >= 250){
            wordCounter.css("color", "green");
        }else if((maxAmt - words) < 250 && (maxAmt - words) >= 50)
        {
           wordCounter.css("color", "orange"); 
        }else if((maxAmt - words) < 50 && (maxAmt - words) >=0){
            wordCounter.css("color", "red"); 
        }
        
    });
    
});


    
    
