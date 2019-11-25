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
    $isSuccess = "";
    $orderByVal = "";
    $orderByTxt = ""; //Used for display type of filter
    $excludeTxt = "";
    
    
    
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
            $isSuccess = true; //Display Success Message
        }
        
    
     }
    
    
    ///DETERMINE HOW TO ORDER THE SQL RESULTS///    
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
        }
        else if($filterBy == "HI"){
            $orderByVal = "s_intTotal DESC";
            $orderByTxt = "Highest Rate";
        }
        else if($filterBy == "LI"){
            $orderByVal = "s_intTotal ASC";
            $orderByTxt = "Lowest Rate";
            
        }else{
            //Default to this value if user does something fishy in URL
             $orderByVal = "s_rank.rank_id ASC";   
        }
   }
    
     ///DETERMINE WHAT ITEMS TO EXCLUDE///
    
    if(isset($_GET['ex_ctier'])){
        
        $excludeTxt = $excludeTxt . " AND s_rank.rank_id < 4 ";
    }
    if(isset($_GET['ex_honey'])){
        $excludeTxt = $excludeTxt . " AND savers.s_hmoon = 0 ";
    }
          
    
    
           //Create SQL string for getting saving account data

          //  $sql = "SELECT banks.bank_name, banks.bank_abbr, banks.bank_url, savers.saver_id, savers.saver_name, savers.saver_date, savers.v_rate, savers.b_rate, savers.req, s_rank.rank, s_rank.rank_color FROM (banks INNER JOIN savers ON banks.bank_id = savers.bank_id) INNER JOIN s_rank ON savers.rank_id = s_rank.rank_id WHERE savers.visible = 1" . $excludeTxt . "ORDER BY " . $orderByVal;

            $sql = "SELECT banks.bank_name, banks.bank_abbr, banks.bank_url, savers.saver_id, savers.saver_name, savers.saver_date, savers.v_rate, savers.b_rate, savers.req, savers.s_hmoon, savers.max_bal, s_rank.rank, s_rank.rank_color, (savers.v_rate + savers.b_rate) AS s_intTotal FROM (banks INNER JOIN savers ON banks.bank_id = savers.bank_id) INNER JOIN s_rank ON savers.rank_id = s_rank.rank_id WHERE savers.visible = 1 ". $excludeTxt . "ORDER BY " . $orderByVal;

                    
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
            
            $resultCount = mysqli_num_rows($result);//Counts actual results from query
            
    
            //echo $this_page_first_result = ($page - 1) * $results_per_page;

        //echo ($results_per_page * $_GET['page']);  **DEBUG PURPOSES
    ?>
    
</head>
<!-- Inspiration -->
<!-- https://www.hostgator.com/blog/top-10-most-popular-design-templates-for-gator-website-builder/ -->

<body>
    <button class="btn btn-sm btn-primary" id="scrollBut" title="Go to top of page"><i class="far fa-arrow-alt-circle-up"></i></button>
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
    if ($isSuccess == true){
        //Display Success message
        ?>
        <div id="alertContainer" class="alert alertSuccess">
                <div class="container">
                    <div class="row">
                        <div class="col-11 text-left">
                              <strong><i class="far fa-check-circle"></i> Success! </strong><?php echo "Interest rates for $" . number_format($_GET['saveAmount'],"0") . " have been generated below."; ?>
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
                    <div class="col-md-8">
                        <!--|||Start Search Bar||| -->
                        <h1 class="text-center">Current Savings Amount</h1>
                        
                        <form method="GET" class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?'. http_build_query($_GET);?>">
                                  
                         <!--Saver bar -->
                         <div id="saveContainer">
                            <i class="fas fa-dollar-sign inputIcon"></i>
                                
                                 <input type="text" id="saveAmount" class="form-control" style="width:80%;" name="saveAmount" maxlength="16" value="<?php echo $saveAmount; ?>" placeholder="Enter savings amount here">
                            

                             <input type="submit" id="submitAmount" name="submitAmount" style="width:20%;" class="btn btn-success">
                         </div>
                            
                       
                            <!--Search Filters -->
                            
                            <div id="saveFiltersOuter">
                            <strong>Sort by:</strong>
                            
                            <div id="saveFilters">
                                <select class="form-control-sm" id="filterAmount" name="filterBy">
                                    <option value="HT" <?php if(isset($filterBy) && $filterBy=="HT") echo "selected";?>>Highest Tier</option>
                                    <option value="LT" <?php if(isset($filterBy) && $filterBy=="LT") echo "selected";?>>Lowest Tier</option>
                                    
                                    <option value="HI" <?php if(isset($filterBy) && $filterBy=="HI") echo "selected";?>>Highest Rate</option>
                                    
                                    <option value="LI" <?php if(isset($filterBy) && $filterBy=="LI") echo "selected";?>>Lowest Rate</option>
                                    
                                    <option value="LE" <?php if(isset($filterBy) && $filterBy=="LE") echo "selected";?>>Last Edited</option>
                                </select>


                                <!--Exclude check boxes -->
                               
                                <!--Exclude lower than ctier -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input  " type="checkbox" id="ex_ctier" value="true" name="ex_ctier" <?php if(isset($_GET['ex_ctier'])) echo "checked"; ?>>
                                    <span class="chkSort"></span>
                                    <label class="form-check-label " for="ex_ctier">
                                        B Tier and above
                                    </label>
                                </div>
                                
                                <!--Exclude introductory rate accounts -->
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input "  type="checkbox" id="ex_honey" value="true" name="ex_honey" <?php if(isset($_GET['ex_honey'])) echo "checked"; ?>
                                           >
                                   
                                    <label class="form-check-label " for="ex_honey">
                                        No honeymoon
                                    </label>
                                </div>



                            </div>
                          </div>
                        <!--END OF Search Filters -->
                      
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

                                        <div class="col-md-6 text-center">

                                            <strong>Variable Rate</strong>
                                            <br>
                                            <?php echo $row["v_rate"];?>%
                                        </div>

                                        <div class="col-md-6 text-center">

                                            <strong>Bonus Rate</strong>
                                            <br>
                                            <?php echo $row["b_rate"]; ?>%
                                        </div>
                                    </div>
                                       
                                        <div class="amtViewInt">
                                            <div class="row">
                                                <!---Monthly Interest--->
                                                <div class="col-md-12 text-center s_viewType s_viewTypeMth">


                                                    <strong>Monthly interest</strong>
                                                    <h4>
                                                        <?php 
                                                        //Only print if value is numeric and value is set.
                                                        if (isset($saveAmount) && is_numeric($saveAmount)){
                                                              echo "$" . number_format($saveAmount * (($row["v_rate"] + $row["b_rate"]) / 100) / 12,"2"); 
                                                        }else{
                                                            echo "___";
                                                        }
                            
                                                         //Determine if Honey Moon account
                                                        if($row['s_hmoon'] == true){
                                                            echo "^";
                                                        }
                                                
                                                        
                                                  ?>
                                                    </h4>
                                                    
                                                    <?php 
                                                    if(is_null($row["max_bal"])){ ?>
                                                      <span class="text-secondary">Max balance unknown</span>  
                                                   
                                           
                                                    <?php
                                                    }else{ ?>
                                                    
                                                     <span class="text-secondary">Max balance $<?php echo number_format($row["max_bal"],"0"); ?> </span>   
                                                    
                                                    <?php
                                                    }
                                                    
                                                    ?>
                                                    
                                                    

                                                    <!---END Monthly Interest--->

                                                </div>
                                                
                                                    <!---Yearly Interest--->
                                                    <div class="col-md-12 text-center inactive s_viewType s_viewTypeYr">
                                                        <strong>Yearly interest</strong>
                                                        <h4>
                                                            <?php 
                                                        //Only print if value is numeric and value is set.
                                                        if (isset($saveAmount) && is_numeric($saveAmount)){
                                                              echo "$" . number_format($saveAmount * (($row["v_rate"] + $row["b_rate"]) / 100),"2"); 
                                                        }else{
                                                            echo "___";
                                                        }
 
                                                        //Determine if Honey Moon account
                                                        if($row['s_hmoon'] == true){
                                                            echo "^";
                                                        }
                                                            
                                                        ?>
                                                        <br>
                                                          
                                                        </h4>
                                                        
                                                        
                                                                 <?php 
                                                    if(is_null($row["max_bal"])){ ?>
                                                      <span class="text-secondary">Max balance unknown</span>  
                                                   
                                           
                                                    <?php
                                                    }else{ ?>
                                                    
                                                     <span class="text-secondary">Max balance $<?php echo number_format($row["max_bal"],"0"); ?> </span>   
                                                    
                                                    <?php
                                                    }
                                                    
                                                    ?>
                                                        
                                                        
                                                        
                                                    </div> <!---END Yearly Interest--->

                                            </div>
                                            <!---Saving rate controls--->
                                            <div class="row">
                                                
                                                <div class="col-md-12 text-center">
                                                   
                                                    
                                                     
                                                    <button class="btn btn-sm btn-outline-primary s_btnMonth active">Month</button>
                                                    <button class="btn btn-sm btn-outline-primary s_btnYear">Year</button>
                                                </div>

                                            </div>
                                        </div><!---END Saving Interview view interface--->

                                        <!---END Saving rate controls--->
                                        <!--END of saver rates -->
                                    
                                    
                                    <!--Start of savings desc -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr class="hr-noPad">
                                            <strong><i class="far fa-star"></i> Bonus Condition
                                                <br>
                                                <small>
                                                        
                                                    <?php echo $row["req"]; ?>
                                                </small>
                                            </strong>
                                        </div>
                                    </div>    
                                    <!--END of of savings desc -->
                                    <hr class="hr-noPad">
                                    
                                    <!--Start of additional notes -->
                                    <div class="row">
                                        <div class="col-md-12">
                                    <strong style="font-size:14px;">
                                        Additional Notes
                                        <br>
                                        <small>   
                                        <?php 
                                        if($row['s_hmoon'] == true){
                                            echo "^ Bonus interest has a honeymoon period.";
                                        }else{
                                            echo "N/A";
                                        }

                                        ?>
                                        </small> 
                                            </strong>
                                        </div>
                                    </div>
                                    
                                    <!--End of savings Points -->
                                    <hr class="">
                                    <!--Start of footer -->
                                    <a class="saverLinks" href="<?php echo $row["bank_url"]; ?>" target="_blank"><i class="fas fa-external-link-alt"></i> Visit website</a>
                                    
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
        
        <!--====START Saver tier legend dashboard ====--> 
        <section id="saverTiers">
            
        <!--Header --> 
          <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Saver Tiers</h1>
                        <hr>
                    </div>
                </div>
            </div>
            
            
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <div class="tierSelector tier-s" style="">
                            <h2>S Tier</h2>
                        </div>
                        <div class="tierSelector tier-a" style="">
                            <h2>A Tier</h2>
                        </div> 
                        <div class="tierSelector tier-b" style="">
                            <h2>B Tier</h2>
                        </div> 
                        <div class="tierSelector tier-c" style="">
                            <h2>C Tier and below </h2>
                        </div> 
                    </div>
                    <div class="col-md-6 text-left">
                        <div class="tierView">
                            <h2>S TIER</h2>
                            <p>S Tier will ensure maximum savings with great interest rates that are easy to achieve. This rank also has unique features to aid saving such as custom round ups, fee free ATMs and user friendly saving reports.
                            
                            <p>No. of S Tier Accounts: xxxx</p>
                        </div>
                        <div class="tierView">
                            <h2>A TIER</h2>
                            <p>Fee free accounts that have balanced rates</p>
                            <ul>
                                <li>High interest rates with no penalties</li>
                               
                                
                            </ul>
                        </div>
                        <div class="tierView">
                            <h2>B TIER</h2>
                            <p>These fee free saving accounts feature generous interest rates where the bonus can be achieved easily. These accounts will have poor variable rates if bonuses are not met. </p>
                            
                        </div>
                        <div class="tierView">
                            <h2>C TIER and below</h2>
                            <p>For long term saving, it is advised to seek better options. Any saving accounts with monthly fees, rough penalties and a poor variables rate are characteristics to avoid.</p>
                            
                            <p>Below are the characteristics for lower tier accounts</p>
                            <ul>
                                <li>Any monthly admin fees for accounts</li>
                                <li>Bonus only involves introductory rate</li>
                                <li>Poor interest rate</li>   
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!--====END Saver tier legend dashboard ====--> 
        
        
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
<script type="application/javascript" src="js/s_calcView.js"></script>
<script type="application/javascript" src="js/s_tierView.js"></script>
<script type="application/javascript" src="js/scrollBut.js"></script>


    
</html>