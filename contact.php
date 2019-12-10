<?php include 'includes/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>


    <?php include 'includes/header.php'; ?>
    <?php include 'includes/funcs.php'; ?>
    
    
    <?php
    if(isset($_POST['c_submit'])){
        $c_name = cleanData($_POST['c_name']);
        $c_email = cleanData($_POST['c_email']);
        $c_subject = cleanData($_POST['c_subject']);
        $c_message = cleanData($_POST['c_message']);
        
        ////Check length backend and data on here. Make sure email correct.
        ///
        
        
        //Run email function if validation meets
        
        
        //Run SQL and store the queries...
        // -> prepare statements.
        
    }
    
    ?>


</head>
<!-- Inspiration -->
<!-- https://www.hostgator.com/blog/top-10-most-popular-design-templates-for-gator-website-builder/ -->

<body>
    <button class="btn btn-sm btn-primary" id="scrollBut" title="Go to top of page"><i class="far fa-arrow-alt-circle-up"></i></button>
    <?php include 'includes/nav.php'; ?>


    <div id="main">
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

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

                            <!--Name section--->
                            <div class="form-group">
                                <label for="c_name">Name:</label>
                                <input name="c_name" type="text" class="form-control" placeholder="Enter name" id="c_email" maxlength="32">
                            </div>


                            <!--Email Section --->
                            <div class="form-group">
                                <label for="c_email">Email address:</label>
                                <input name="c_email" type="c_email" class="form-control" placeholder="Enter email" id="c_email" maxlength="64">
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
                                <textarea name="c_message" rows="6" class="form-control" maxlength="500" placeholder="Enter your message here. Maximum 500 words."></textarea>
                                <span>Words left: #</span>
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
</html>