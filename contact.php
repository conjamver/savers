<?php include 'includes/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
    

<head>

    <title>Dosh Alley | Contact Us</title>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/funcs.php'; ?>
    
    
    <?php
    //Declare variables
    $errCount = 0;
        
    //Generate Error Message.
    if(isset($_GET['contact'])){
        switch($_GET['contact']){
            case "empty":
                $errMsg = "You have one or more empty fields in contact form.";
                break;
            case "invalidEmail":
                $errMsg = "Email entered is a invalid format.";
                break;
                
            case "invalidName":
                $errMsg = "Name entered is a invalid format.";
                break;
                
            case "invalidMessage":
                $errMsg = "Message entered must be less than 500 characters.";
                break;
                
            case "invalidSubject":
                $errMsg = "Topic is invalid. Please ensure topic selected from drop down.";
                break;
                
            case "sent":
                $errMsg = "Your message has been sent. We will contact you as soon as we can.";
                break;
    
        }
    }
        
    
    if(isset($_POST['c_submit'])){
        $errMsg = "";
        $c_name = cleanData($_POST['c_name']);
        $c_email = cleanData($_POST['c_email']);
        $c_subject = cleanData($_POST['c_subject']);
        $c_message = cleanData($_POST['c_message']);
        
        ////Check length backend and data on here. Make sure email correct.
        ///
        
        //Check for any empty fields
        if(empty($c_name) || empty($c_email) || empty($c_subject) || empty($c_message)){
            header("Location: contact.php?contact=empty&c_name=$c_name&c_email=$c_email&c_subject=$c_subject");
            
            exit();
        }
        else{
            
                //name validation
                 if(strlen($c_name) >32 || strlen($c_name) < 1 || ctype_alpha($c_name) == false){
                header("Location: contact.php?contact=invalidName&c_name=$c_name&c_email=$c_email&c_subject=$c_subject");
                     exit();
             }

                //email validation
                elseif(!filter_var($c_email, FILTER_VALIDATE_EMAIL ) || strlen($c_email) >64 || strlen($c_email) < 1){
                   header("Location: contact.php?contact=invalidEmail&c_name=$c_name&c_email=$c_email&c_subject=$c_subject");
                    
                    exit();
                }


                //Message Validation
                elseif(strlen($c_message) >500 || strlen($c_message) < 1){
                    header("Location: contact.php?contact=invalidMessage&c_name=$c_name&c_email=$c_email&c_subject=$c_subject");
                    exit();

                }

                //Select box limitation *Stops html manipulation
                  elseif(strlen($c_subject) >48 || strlen($c_subject) < 1){
                    header("Location: contact.php?contact=invalidSubject&c_name=$c_name&c_email=$c_email&c_subject=$c_subject");
                      exit();

                }
            

            }//End of else statement
        
        
        //GENERATE THE EMAIL
        $mailTo = "connor.j.vernon97@gmail.com";
        $headers = "From: " . $c_email;
        $txt = "You have recieved a email from: " .$c_name."\n\n".$c_message;
        
        mail($mailTo, $subject, $txt,$headers);
        
        
        //INSERT SQL INTO DATABASE
        //$contactSQL = "INSERT INTO contact_queries(contact_ip,contact_name,contact_email,contact_subject,contact_msg,contact_date) VALUES ('". $_SERVER['REMOTE_ADDR'] ."','$c_name','$c_email','$c_subject','$c_message','" . date("Y-m-d H:i:sa") . "')";
        
        $contactSQL = "INSERT INTO contact_queries(contact_ip,contact_name,contact_email,contact_subject,contact_msg,contact_date) VALUES (?,?,?,?,?,?)";
        
        //CREATE PREPARED STATEMENT
        $stmt = mysqli_stmt_init($conn);
        
        //PREPARE THE PREPARED STATEMENT - first we check if function succeeds.
        if(!mysqli_stmt_prepare($stmt, $contactSQL)){
            echo "SQL statement has failed.";
        }else{
            //run some code here
            //BIND THE PARAMETERS TO THE PLACEHOLDERS
            mysqli_stmt_bind_param($stmt, "ssssss",$_SERVER['REMOTE_ADDR'],$c_name,$c_email,$c_subject,$c_message,date("Y-m-d H:i:sa"));
            mysqli_stmt_execute($stmt);
        }
        
        
        //mysqli_stmt_prepare();
        
        
        
        mysqli_query($conn,$contactSQL);

        header("Location: contact.php?contact=sent"); 

        }//END of FORM CONDITIONS
        
        
        //Run SQL and store the queries...
        // -> prepare statements.
        
  
    
    ?>


</head>
<!-- Inspiration -->
<!-- https://www.hostgator.com/blog/top-10-most-popular-design-templates-for-gator-website-builder/ -->

<body>
    <button class="btn btn-sm btn-primary" id="scrollBut" title="Go to top of page"><i class="far fa-arrow-alt-circle-up"></i></button>
    <?php include 'includes/nav.php'; ?>


    <div id="main">
        
        <!--Error message generator-->
        <?php
        if (isset($_GET['contact'])){
            if($_GET['contact'] != "sent"){
        //Display error Message message
        ?>
    <div id="alertContainer" class="alert alertErr">
                <div class="container">
                    <div class="row">
                        <div class="col-11 text-left">
                              <strong><i class="fas fa-exclamation-circle"></i> Error: </strong><?php echo $errMsg; ?>
                        </div>
                        
                        <div class="col-1 text-right">
                             <!--Exit alert button --> 
                            <span class="alertExit">
                                <i class="far fa-times-circle"></i>
                            </span>
                        </div>
                        
                    </div>
                     
                   
    
                </div>
            </div> 
        
        
        
   <?php 
        }//end of error message html
        else{  
        
        ?>
            
        <div id="alertContainer" class="alert alertSuccess">
                <div class="container">
                    <div class="row">
                        <div class="col-11 text-left">
                              <strong><i class="far fa-check-circle"></i> Success! </strong><?php echo $errMsg; ?>
                        </div>
                        
                        <div class="col-1 text-right">
                             <!--Exit alert button --> 
                            <span class="alertExit">
                                <i class="far fa-times-circle"></i>
                            </span>
                        </div>
                        
                    </div>
                     
                   
    
                </div>
            </div> 
        
        
        
        
        <?php 
             }
        
        
        }//End of checking contact variable set
    ?>
        
        
        
        <!--Banner -->
        <section id="abt-banner" class="">
            <div class="container">
                <div class = "row">
                    <div class="col-md-12">
                        <h1>Have some questions?</h1>
                        <h2>Please contact us via the form below.</h2>
                    </div>
                </div>
            </div>
        </section>
        <!--Contact form section --->
        <section id="contact-form" class="sectionBody">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Contact Dosh Alley</h2>
                        <p>All fields must be filled for your query to be sent to us.</p>
                        <hr>

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

                            <!--Name section--->
                            <div class="form-group">
                                <label for="c_name">Name:</label>
                                <input name="c_name" type="text" class="form-control" placeholder="Enter name" id="c_email" maxlength="32" value="<?php if(isset($_GET['c_name'])) echo $_GET['c_name']; ?>">
                                
                               
                            </div>


                            <!--Email Section --->
                            <div class="form-group">
                                <label for="c_email">Email address:</label>
                                <input name="c_email" type="c_email" class="form-control" placeholder="Enter email" id="c_email" maxlength="64" value="<?php if(isset($_GET['c_email'])) echo $_GET['c_email']; ?>">
                            </div>


                            <!--Topic Section --->
                            <div class="form-group">
                                <label for="c_subject">Select topic:</label>
                                <select name="c_subject" id="c_subject" class="form-control">
                                    <option>General Enquiry</option>
                                    <option>Bugs and errors related to Dosh Alley</option>
                                    <option>Ideas for Dosh Alley</option>
                                    
                                </select>
                            </div>
                            
                            <!--Body Section --->
                            
                            
                            <!--Topic Section --->
                            <div class="form-group">
                                <label for="c_message">Your message:</label>
                                <textarea id="c_message" name="c_message" rows="6" class="form-control" maxlength="500" placeholder="Enter your message here. Maximum 500 words."><?php if(isset($_GET['c_message'])) echo $_GET['c_message']; ?></textarea>
                                <span>Words left: </span><span id="word-counter"></span>
                            </div>
                            
                            
                            
                            
                            <button name="c_submit" type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </section>
        
        




    </div>
    <?php include 'includes/footer.php'; ?>

</body>
<script type="application/javascript" src="js/scrollBut.js"></script>
<script type="application/javascript" src="js/activePage.js"></script>
<script type="application/javascript" src="js/closeAlert.js"></script>
    <script type="application/javascript" src="js/textCount.js"></script>
</html>