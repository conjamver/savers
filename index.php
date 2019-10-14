<?php include 'includes/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    
  
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/funcs.php'; ?>
    
    <?php
    
    //Declare variables
    $saveAmount = "";
    $filterBy = "";
    $alertErr = "";
    $isError = false;
    $orderByVal = "";
    $orderByTxt = ""; //Used for display type of filter
    
    
    
    //Start of form handling
    if(isset($_GET['submitAmount'])) {
        
        //Sanitise values before we run SQL
        $saveAmount = cleanData($_GET["saveAmount"]);
        $filterBy = cleanData($_GET["filterBy"]);
        
        
        //Validate data
        if (!is_numeric($saveAmount)){
            //Echo Error Message
            $alertErr = 'Please make sure savings amount is a valid number.';
            $isError = true;
        }else{
            $isError = false;
        }
        
    
     }
    
    
    //DETERMINE HOW TO ORDER THE SQL RESULTS    
   if(!isset($_GET['filterBy'])){
        $orderByVal = "s_rank.rank_id ASC";
    }else{
        if($filterBy == "HT"){
           $orderByVal = "s_rank.rank_id ASC"; 
            $orderByTxt = "Highest Tier";
             
        }
        else if($filterBy == "LT"){
            $orderByVal = "s_rank.rank_id DESC";
            $orderByTxt = "Lowest Tier";
            
        }else if($filterBy == "LE"){
             $orderByVal = "savers.saver_date DESC";
            $orderByTxt = "Last Edited";
        }else{
            //Default to this value if user does something fishy in URL
             $orderByVal = "s_rank.rank_id ASC";   
        }
   }
       
    
    
           //Create SQL string for getting saving account data
            $sql = "SELECT banks.bank_name, banks.bank_abbr, banks.bank_url, savers.saver_name, savers.saver_date, savers.v_rate, savers.b_rate, savers.req, s_rank.rank, s_rank.rank_color, s_points.point_type, s_points.point_desc FROM ((banks INNER JOIN savers ON banks.bank_id = savers.bank_id) INNER JOIN s_rank ON savers.rank_id = s_rank.rank_id) LEFT JOIN s_points ON savers.saver_id = s_points.s_id WHERE savers.visible = 1 ORDER BY " . $orderByVal;
                    
            // Run Query
            $result = mysqli_query($conn, $sql);
    
    
            //START OF PAGINATION
            $results_per_page = 9;
            $number_of_results = mysqli_num_rows($result);

            //Calculate the number of pages by dividing total by results per page
            $number_of_pages = ceil($number_of_results/$results_per_page);

            //////////PAGINATION VALIDATION//////////
            //URL page number validation. IF GET page variable not set, default to 1.
            if(!isset($_GET['page'])){
                $page = 1;
            }else{
                //Only set page num if header value is a number
                //results per page must be less than total results and greater than 0
                if(is_numeric($_GET['page']) && ($results_per_page * $_GET['page']) <= $number_of_results  + $results_per_page && $_GET['page'] > 0){
                    $page = $_GET['page'];  
                }else{
                    $page = 1;
                }
                
            }
            //////////END PAGINATION VALIDATION//////////

            //SQL limit - Find the first result Example (Page 1 will be 0, page 2 will be 9)
            $this_page_first_result = ($page - 1) * $results_per_page;
    
                        
            //re run query with limit
            $sql2 = $sql . " LIMIT " . $this_page_first_result . "," . $results_per_page; 
            $result = mysqli_query($conn,$sql2);

        //echo ($results_per_page * $_GET['page']);  **DEBUG PURPOSES
    ?>
    
</head>
<!-- Inspiration -->
<!-- https://www.hostgator.com/blog/top-10-most-popular-design-templates-for-gator-website-builder/ -->

<body>
    <?php include 'includes/nav.php'; ?>
    
    <!--Alert Section --> 
    <?php
    if ($isError == true) { 
    //Display error when value is true
    ?>
            <div id="alertContainer" class="alert alertErr">
                <div class="container">
                    <div class="row">
                        <div class="col-11 text-left">
                              <strong><i class="fas fa-exclamation-circle"></i> Error: </strong><?php echo $alertErr; ?>
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
   <?php }
    ?>

     <!--End Alert Section -->
    
    
    <div id="main">
         <!--Welcome Banner --> 
        <section id="home-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 text-center">
                    </div>
                    <div class="col-md-8 text-center">
                        <!--|||Start Search Bar||| -->
                        <h1>Current Savings Amount</h1>

                        <form method="GET" class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?'. http_build_query($_GET);?>">
                                  
                         
                            <input type="text" id="saveAmount" class="form-control" style="width:80%;" name="saveAmount" maxlength="16" value="<?php echo $saveAmount; ?>" placeholder="Enter savings amount here">
                            

                            <input type="submit" id="submitAmount" name="submitAmount" style="width:20%;" class="btn btn-success">
                            <br>
                            <!--Search Filters -->
                           
                            
                            <div class="form-group">
                               
                                <select class="form-control-sm" id="filterAmount" name="filterBy">
                                    <option value="HT" <?php if(isset($filterBy) && $filterBy=="HT") echo "selected";?>>Highest Tier</option>
                                    <option value="LT" <?php if(isset($filterBy) && $filterBy=="LT") echo "selected";?>>Lowest Tier</option>
                                    <option value="LE" <?php if(isset($filterBy) && $filterBy=="LE") echo "selected";?>>Last Edited</option>
                                </select>
                            </div>
                            <!--||||End Search Bar|||| -->
                        </form>
                        

                    </div>


                </div>

            </div>
        </section>
        
        <!--START OF SAVER BAR -->
        <section id="saverResultsBar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                         <h2>
                             Comparing Savings Accounts
                        </h2>
                        <hr>
                        
                         <?php 
                        //Output pagination code
                        include 'includes/pagination.php'; 
                        ?>
                        
                    </div>
                </div>
            </div>
        </section>
        <!--END OF SAVER BAR --> 
        
        
        <section id="blog-featuredBody">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
        
                        <div class="row">
                  
                    <?php
             
                            
              
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
                                        </div>
                                        <div class = "row">
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
                                        </div>
                                    <!--END of saver rates -->
                                    
                                    
                                    <!--Start of savings desc -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr>
                                            <strong>Bonus Condition
                                                <br>
                                                <small>
                                                    <?php echo $row["req"]; ?>
                                                </small>
                                            </strong>
                                        </div>
                                    </div>    
                                    <!--END of of savings desc -->
                                    <hr>
                                    
                                    <!--Start of savings Pointss -->
                                    <div class = "row">
                                        <!--Pros -->
                                        <div class="col-md-12">
                                            <strong>Strengths
                                            <br>
                                            <small>
                                            <?php 
                                                if($row["point_type"] == 1){
                                                    echo '<i class="far fa-smile-beam"></i> ';
                                                    echo $row["point_desc"];  
                                                }  
                                            ?>
                                                </small>
                                            </strong>
                                        </div>
                                    </div>
                                    <!--Cons -->
                                    <div class = "row">
                                        <div class="col-md-12">
                                                 <strong>Weakness
                                            <br>
                                            <small>
                                                
                                            <?php 
                                                if($row["point_type"] == 2){
                                                    echo '<i class="far fa-frown"></i> ';
                                                   echo $row["point_desc"];  
                                                }  
                                            ?>
                                                </small>
                                            </strong>
                                        </div>
                                    </div>
                                    
                                    <!--End of savings Points -->
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
        
        
        <!--START OF SAVER BAR BOTTOM -->
        <section id="saverResultsBar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <hr>
                        
                         <?php 
                        //Output pagination code
                        include 'includes/pagination.php'; 
                        ?>
                        
                    </div>
                </div>
            </div>
        </section>
        <!--END OF SAVER BAR BOTTOM --> 
        
        
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
<script type="application/javascript" src="js/closeAlert.js"></script>
<script type="application/javascript" src="js/amtValidate.js"></script>
    
</html>