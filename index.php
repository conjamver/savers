<?php include 'includes/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include 'includes/header.php'; ?>
    <?php include 'includes/funcs.php'; ?>
    
    <?php
    
     //Declare
     $saveAmount = "";
    
    //Start of form handling
    if(isset($_GET['submitAmount'])) {
       
        $saveAmount = cleanData($_GET["saveAmount"]);
    }
    
    ?>
    
</head>
<!-- Inspiration -->
<!-- https://www.hostgator.com/blog/top-10-most-popular-design-templates-for-gator-website-builder/ -->

<body>
    <?php include 'includes/nav.php'; ?>
  
    <div id="main">
         <!--Welcome Banner --> 
        <section id="home-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 text-center">
                    </div>
                    <div class="col-md-8 text-center">

                        <!--Start Search Bar --> 
                        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                            
                            <h1>Current Savings Amount</h1>
                            
                            <div class="input-icon">
                                <input type="text" class="" name="saveAmount" maxlength="16" value="<?php echo $saveAmount; ?>" placeholder="Enter savings amount here">
                                <span>$</span>
                            </div>
                           
                            <input type="submit" name="submitAmount" class="btn btn-success">
                            <!--End Search Bar --> 
                        </form>
                        
                    </div>
                  
                    
                </div>
               
            </div>
        </section>
        
        <section id="blog-featuredBody">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Top Savings Accounts</h2>
                        <div class="row">
                    <?php
                    //Create SQL string for getting saving account data
                    $sql = "SELECT banks.bank_name, banks.bank_abbr, banks.bank_url, savers.saver_name, savers.saver_date, savers.v_rate, savers.b_rate, savers.req, s_rank.rank, s_rank.rank_color FROM (banks INNER JOIN savers ON banks.bank_id = savers.bank_id) INNER JOIN s_rank ON savers.rank_id = s_rank.rank_id WHERE savers.visible = 1 ORDER BY s_rank.rank_id ASC";
                    
                    // Run Query
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) { 
                       // $postID = $row["ID"];
                        
                        
                            ?>
                        <!--START Each Saver item -->
                        <div class ="col-md-4 saver-outerBody">
                            <section class="blog-featured">
                                <div class="blog-featuredContent">
                                    
                                            <div class="row">
                                             <div class="col-md-12">
                                            <span class="badge" style="background-color:<?php echo $row['rank_color']; ?>">
                                                <?php 
                                                        //Display Rank
                                                        echo $row["rank"];
                                                        if ($row["rank"] != "TBA"){
                                                           echo " Tier"; 
                                                        }

                                                    ?>

                                            </span>
                                                </div>
                                        </div>
                                    
                                    <!--START Saver and Bank header -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>
                                                <i class="fas fa-university"></i>
                                                <?php 

                                            //Now abbreviation instead if exists
                                            if($row['bank_abbr'] == NULL){
                                                echo $row["bank_name"]; 
                                            }else{
                                                echo $row["bank_abbr"]; 
                                            }


                                            //End of Bank header
                                            ?>

                                            </h3>

                                            <h5>
                                                <?php 
                                                //Savings Name
                                                echo "- " . $row["saver_name"]; 
                                            ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <!--ENDSaver and Bank header -->
                                    
                                    <div class="row">
                               
                                        <div class="col-md-8">
                                            <i class="far fa-calendar-alt"></i>
                                            <strong>Last Edited:</strong>
                                            <?php echo date("d/m/Y",strtotime($row['saver_date'])); ?>
                                        </div>
                                    </div>
                                    <hr>
                                  
                                    <!--Start of saver rates -->
                                    <div class="row">
                                    
                                        <div class ="col-md-6 text-center">
                                            
                                            <strong>Variable Rate</strong>
                                            <br>
                                            <?php echo $row["v_rate"];?>%
                                        </div>
                                        <div class ="col-md-6 text-center">
                                            <strong>Bonus Rate</strong>
                                            <br>
                                            <?php echo $row["b_rate"]; ?>%
                                        </div>
                                          <div class="col-md-12 text-center">
                                            <strong>Monthly interest</strong>
                                              <h4>
                                                  <?php 
                                                        //Only print if value is numeric and value is set.
                                                        if (isset($saveAmount) && is_numeric($saveAmount)){
                                                              echo "$" . number_format($saveAmount * (($row["v_rate"] + $row["b_rate"]) / 100) / 12,"2"); 
                                                        }else{
                                                            echo "___";
                                                        }
                                                        
                                                      
                                                       // echo $row["v_rate"] + $row["b_rate"];
                                                        
                                                  ?>
                                              </h4>
                                        </div>
                                    <!--END of saver rates -->
                                    </div>
                                    
                                    <!--Start of savings desc -->
                                    <div class="row">
                                        <div class="col-md-12">
                                        <hr>
                                        <strong>Bonus Condition</strong>
                                        <p><?php echo $row["req"]; ?></p>  
                                        </div>
                                    </div>    
                                    <!--END of of savings desc -->
                                    <hr>
                                    
                                    <!--Start of savings Pros -->
                                    
                                    
                                    <!--End of savings Pros -->
                                    <hr>
                                    <!--Start of footer -->
                                    <a href="<?php echo $row["bank_url"]; ?>" target="_blank"><i class="fas fa-external-link-alt"></i> Visit Website</a>
                                    <!--End of footer-->
                                    
                                </div>
                            </section>
                        </div>
                        <!--END Each Saver item -->
                        <?php
                            
                        }
                    }
                        
                        ?>
                        
                            </div>
                    </div>
                </div>
                <!--END OF SAVINGS APPLICATION -->
                
 
                
            </div>
              <!--END About section -->
        </section>
        <section id="about">
            <!--START About section -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Advantages of Savers</h1>
                        <hr>
                    </div>
                </div>
               
    
                 <div class="row">
                    <div class="col-md-6 text-center">
                        <div class="about-container">
                        <i class="fas fa-laptop"></i>
                        <h3>Usability</h3>
                        <p>Savers compacts insights into flash card sized reports so that users can compare accounts with ease. This ensures you can find your best savings account in the fastest way possible. </p>
                    </div>
                    </div> 
                    <div class="col-md-6 text-center">
                        <div class="about-container">
                        <i class="fas fa-laptop"></i>
                        <h3>Speed</h3>
                        <p>Your monthly interest one click away.  </p>
                    </div>
                     </div>
                </div>
        </div>
        </section>
        
        
        
</div>
  <?php include 'includes/footer.php'; ?>   

</body>

</html>