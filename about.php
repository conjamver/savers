<?php include 'includes/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>


    <?php include 'includes/header.php'; ?>
    <?php include 'includes/funcs.php'; ?>



</head>
<!-- Inspiration -->
<!-- https://www.hostgator.com/blog/top-10-most-popular-design-templates-for-gator-website-builder/ -->

<body>
    <button class="btn btn-sm btn-primary" id="scrollBut" title="Go to top of page"><i class="far fa-arrow-alt-circle-up"></i></button>
    <?php include 'includes/nav.php'; ?>


    <div id="main">
        <!--Welcome Banner -->
        <section id="abt-banner">
            <div class="container">
                <div class = "row">
                    <div class="col-md-12">
                        <h1>Our Mission</h1>
                        <h2>We strive to educate Australians to make the most out of their finances. </h2>
                    </div>
                </div>
            </div>
        </section>
        
        <!--About Section --->
        <section id="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>
                            About us
                        </h2>
                        <p>Dosh Alley is a free website that provides that provides a Saving Account comparison application as well as additional content on securing your finances. 
                            </p>

<p>It was started by a young individual name Connor, who has always been passionate about web programming and eventually delved into the world of Australian finance. </p>

                       

                    </div>
                    
                    <div class="col-md-6">
                        <img class="img-fluid" src="img/envi_study.png">
                    </div>


                </div>

            </div>
            
            <!--Our Mission Section --->
            <div class="container">
                <div class="row">
                    
                    <div class ="col-md-6">
                       <img class="img-fluid" src="img/pig_bank.png">
                    </div>
                    <div class ="col-md-6">
                        <h2>Our mission</h2>
                        <p>We believe that every aussie deserves to make the most out of their finances. Our savings account comparison application is our first step for helping  Aussies maximising their returns. </p>
                            
                            <p>We also aim to deliver information in a way that is easily understandable to people who may know absolutely nothing about finance. We understand that the subject of life is not taught in most Australian education systems. </p>
                        
                            <p>We ensure all products we review are reliable and trustworthy. We are strong to those values.</p>
                    </div>
                </div>
            </div>
        </section>






    </div>
    <?php include 'includes/footer.php'; ?>

</body>
<script type="application/javascript" src="js/scrollBut.js"></script>
</html>