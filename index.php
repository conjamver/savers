<?php include 'includes/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dosh Alley | Savings comparison and Financial articles</title>
  
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

         //  $sql = "SELECT banks.bank_name, banks.bank_abbr, banks.bank_url, savers.saver_id, savers.saver_name, savers.saver_date, savers.v_rate, savers.b_rate, savers.req, savers.s_hmoon, savers.max_bal, s_rank.rank, s_rank.rank_color, s_rank.rank_id, (savers.v_rate + savers.b_rate) AS s_intTotal FROM (banks INNER JOIN savers ON banks.bank_id = savers.bank_id) INNER JOIN s_rank ON savers.rank_id = s_rank.rank_id WHERE savers.visible = 1 ". $excludeTxt . "ORDER BY " . $orderByVal;
    
    
            $sql = "SELECT banks.bank_name, banks.bank_abbr, banks.bank_url, savers.saver_id, savers.saver_name, savers.saver_date, savers.v_rate, savers.b_rate, savers.req, savers.s_hmoon, savers.max_bal, s_rank.rank, s_rank.rank_color, s_rank.rank_id, (savers.v_rate + savers.b_rate) AS s_intTotal FROM (banks INNER JOIN savers ON banks.bank_id = savers.bank_id) INNER JOIN s_rank ON savers.rank_id = s_rank.rank_id WHERE savers.visible = 1 ". $excludeTxt . "ORDER BY " . $orderByVal;
    
    
    
            
    
    
                          
            //Master SQL string for statistics
            $master_stat_sql = "SELECT banks.bank_name, banks.bank_abbr, banks.bank_url, savers.saver_id, savers.saver_name, savers.v_rate, savers.b_rate, savers.s_hmoon, savers.max_bal, s_rank.rank, s_rank.rank_color, s_rank.rank_id, (savers.v_rate + savers.b_rate) AS s_intTotal FROM (banks INNER JOIN savers ON banks.bank_id = savers.bank_id) INNER JOIN s_rank ON savers.rank_id = s_rank.rank_id WHERE savers.visible = 1";

                    
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
                        <div class="col-10 text-left">
                              <strong><i class="fas fa-exclamation-circle"></i> Error: </strong><?php echo $alertErr; ?>
                        </div>
                        
                        <div class="col-2 text-right">
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
                        <div class="col-10 text-left">
                              <strong><i class="far fa-check-circle"></i> Success! </strong><?php echo "Interest rates for $" . number_format($_GET['saveAmount'],"0") . " have been generated below."; ?>
                        </div>
                        
                        <div class="col-2 text-right">
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
                        <div id="welcomeTxt">
                            <h1 class="">
                                    
                                Welcome to Dosh Alley
                            </h1>
                            <div>
                           
                            </div>
                            
                        </div>
                        <h3>Enter savings amount:</h3>
                        
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
                                     <i class="far fa-question-circle honeymoonPop" data-toggle="popover" data-trigger="focus" title="Honeymoon period?" data-placement="top" data-content="Savings account with introductory bonus interest rate."></i>
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
                                                        //Display Rank information
                                                        
                            
                                                       
                                                        
                                                        if($row["rank_id"] <= 4){
                                                            echo $row["rank"];
                                                            if ($row["rank"] != "TBA"){
                                                               echo " Tier"; 
                                                            } 
                                                        }else{
                                                            echo "C";
                                                            if ($row["rank"] != "TBA"){
                                                               echo " Tier"; 
                                                            } 
                                                        }
                            
                            
                                                        //END OF RANK INFORMATION

                                                    ?>

                                            </span>
                                                </div>
                                        </div>
                                    
                                    <!--START Saver and Bank header -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="saver-pad">
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
                                    </div>
                                    <!--ENDSaver and Bank header -->
                                    
                                    <div class="row">
                               
                                        <div class="col-md-8">
                                            <div class="saver-pad">
                                            <i class="far fa-calendar-alt"></i>
                                            <strong>Last Edited:</strong>
                                            <?php echo date("d/m/Y",strtotime($row['saver_date'])); ?>
                                            </div>
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
                                                              
                                                            //OLD FORMULA, Basic yearly int calc
                                                            echo "$" . number_format($saveAmount * (($row["v_rate"] + $row["b_rate"]) / 100),"2"); 
                                                                
                                                        /* COMPOUND YEAR FORMULA
                                                            $yearlyC = 0;
                                                            $yearlyC =  $saveAmount * pow((1 + (($row["v_rate"] + $row["b_rate"])/100)/12),12);
                                                            
                                                            echo "$" . number_format($yearlyC - $saveAmount,2);
                                                            
                                                            */
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
                                            <div class="saver-pad">
                                            <strong><i class="far fa-star"></i> Bonus Condition
                                                <br>
                                                <small>
                                                        
                                                    <?php echo $row["req"]; ?>
                                                </small>
                                            </strong>
                                            </div>
                                        </div>
                                    </div>    
                                    <!--END of of savings desc -->
                                    <br>
                                    
                                    <!--Start of additional notes -->
                                    <div class="row saverNotes">
                                        <div class="col-md-12">
                                            <div class="saver-pad">
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
                                    </div>
                                    
                                   
                                         <div class="testI">
                                             <hr>
                                             <div class="saver-pad">



                                                    <!--Start of footer -->
                                                    <a class="saverLinks" href="<?php echo $row["bank_url"]; ?>" target="_blank"><i class="fas fa-external-link-alt"></i> Visit website</a>
                                                  
                                                </div>
                                                <!--End of footer-->
                                        </div>
                                    

                                    
                                    
                                    <!--End of savings Points -->
                          
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
        <section id="saverTiers" class="sectionBody">
            
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
                        <div class="tierSelector tier-s t-active" style="">
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
                        <div id="tview-s" class="tierView">
                            <h2>S TIER</h2>
                            <?php include 'includes/tier_desc.php'; ?> 

                            
                         
                            
                            <!--Tier stats/information --->
                            <div class="row">
                                
                                 <!--NO. OF ACCOUNTS --->
                                <div class = "col-3">
                                    <div class="tier-stat-cont text-center">
                                                <?php 
                                                
                                                //What rank to look for
                                                $stat_rank = " AND s_rank.rank_id = 1";
                                                
                                                //Join the strings together
                                                $stat_sql = $master_stat_sql . $stat_rank;

                    
                                                // Run Query
                                                $stat_result = mysqli_query($conn, $stat_sql);
                                        
                                     
                                                
                                                ?>
                                        <i class="fas fa-piggy-bank"></i>
                                        <br>
                                        <span>
                                            <strong>
                                                  <?php
                                                echo mysqli_num_rows($stat_result);
                                            
                                            ?>
                                           </strong>
                                            <br>
                                            <small>
                                                No. of Savers
                                            </small>
                                        </span>
                                    
                                    </div>
                                
                                </div>
                                <!--END OF NO. OF ACCOUNTS --->
                                
                                
                                 <!--AVERAGE INTEREST --->
                                <div class = "col-3">
                                    <div class="tier-stat-cont text-center">
                                        <i class="fas fa-chart-line"></i>
                                        <br>
                                        <span>
                                          <?php
                                            //CALCULATE THE AVERAGE INTEREST
                                            $s_average = 0;
                                            while($row = mysqli_fetch_assoc($stat_result)) { 
                       
                                                $s_average = $s_average + ($row["v_rate"] + $row["b_rate"]);
                                                
                                            }
                                          
                                             echo number_format($s_average / mysqli_num_rows($stat_result),"2") . "%"
                                            
                                               //END OF CALCULATE THE AVERAGE INTEREST
                                            ?>
                                            
                                            <br>
                                            <small>
                                                Avg. Interest
                                            </small>
                                        </span>
                                    
                                    </div>
                                
                                </div>
                                <!--END OF AVERAGE INTEREST --->                           
                            </div>
                             <!--END OF Tier stats/information --->
                            
                            
                            
                        </div>
                        <div id="tview-a" class="tierView inactive">
                            <h2>A TIER</h2>
                            <?php include 'includes/tier_desc.php'; ?> 

                                                        <!--Tier stats/information --->
                            <div class="row">
                                
                                 <!--NO. OF ACCOUNTS --->
                                <div class = "col-3">
                                    <div class="tier-stat-cont text-center">
                                                <?php 
                                                
                                                //What rank to look for
                                                $stat_rank = " AND s_rank.rank_id = 2";
                                                
                                                //Join the strings together
                                                $stat_sql = $master_stat_sql . $stat_rank;

                    
                                                // Run Query
                                                $stat_result = mysqli_query($conn, $stat_sql);
                                        
                                     
                                                
                                                ?>
                                        <i class="fas fa-piggy-bank"></i>
                                        <br>
                                        <span>
                                            <strong>
                                                  <?php
                                                echo mysqli_num_rows($stat_result);
                                            
                                            ?>
                                           </strong>
                                            <br>
                                            <small>
                                                No. of Savers
                                            </small>
                                        </span>
                                    
                                    </div>
                                
                                </div>
                                <!--END OF NO. OF ACCOUNTS --->
                                
                                
                                 <!--AVERAGE INTEREST --->
                                <div class = "col-3">
                                    <div class="tier-stat-cont text-center">
                                        <i class="fas fa-chart-line"></i>
                                        <br>
                                        <span>
                                          <?php
                                            //CALCULATE THE AVERAGE INTEREST
                                            $s_average = 0;
                                            while($row = mysqli_fetch_assoc($stat_result)) { 
                       
                                                $s_average = $s_average + ($row["v_rate"] + $row["b_rate"]);
                                                
                                            }
                                          
                                             echo number_format($s_average / mysqli_num_rows($stat_result),"2") . "%"
                                            
                                               //END OF CALCULATE THE AVERAGE INTEREST
                                            ?>
                                            
                                            <br>
                                            <small>
                                                Avg. Interest
                                            </small>
                                        </span>
                                    
                                    </div>
                                
                                </div>
                                <!--END OF AVERAGE INTEREST --->                           
                            </div>
                             <!--END OF Tier stats/information --->
                        </div>
                        <div id="tview-b" class="tierView inactive">
                            <h2>B TIER</h2>
                            <?php include 'includes/tier_desc.php'; ?>  
                            
                            
                                                        <!--Tier stats/information --->
                            <div class="row">
                                
                                 <!--NO. OF ACCOUNTS --->
                                <div class = "col-3">
                                    <div class="tier-stat-cont text-center">
                                                <?php 
                                                
                                                //What rank to look for
                                                $stat_rank = " AND s_rank.rank_id = 3";
                                                
                                                //Join the strings together
                                                $stat_sql = $master_stat_sql . $stat_rank;

                    
                                                // Run Query
                                                $stat_result = mysqli_query($conn, $stat_sql);
                                        
                                     
                                                
                                                ?>
                                        <i class="fas fa-piggy-bank"></i>
                                        <br>
                                        <span>
                                            <strong>
                                                  <?php
                                                echo mysqli_num_rows($stat_result);
                                            
                                            ?>
                                           </strong>
                                            <br>
                                            <small>
                                                No. of Savers
                                            </small>
                                        </span>
                                    
                                    </div>
                                
                                </div>
                                <!--END OF NO. OF ACCOUNTS --->
                                
                                
                                 <!--AVERAGE INTEREST --->
                                <div class = "col-3">
                                    <div class="tier-stat-cont text-center">
                                        <i class="fas fa-chart-line"></i>
                                        <br>
                                        <span>
                                          <?php
                                            //CALCULATE THE AVERAGE INTEREST
                                            $s_average   = 0;
                                            while($row = mysqli_fetch_assoc($stat_result)) { 
                       
                                                $s_average = $s_average + ($row["v_rate"] + $row["b_rate"]);
                                                
                                            }
                                          
                                             echo number_format($s_average / mysqli_num_rows($stat_result),"2") . "%"
                                            
                                               //END OF CALCULATE THE AVERAGE INTEREST
                                            ?>
                                            
                                            <br>
                                            <small>
                                                Avg. Interest
                                            </small>
                                        </span>
                                    
                                    </div>
                                
                                </div>
                                <!--END OF AVERAGE INTEREST --->                           
                            </div>
                             <!--END OF Tier stats/information --->
                            
                        </div>
                        <div id="tview-c" class="tierView inactive">
                            <h2>C TIER and below</h2>
                            <?php include 'includes/tier_desc.php'; ?> 
                            
                                                                   <!--Tier stats/information --->
                            <div class="row">
                                
                                 <!--NO. OF ACCOUNTS --->
                                <div class = "col-3">
                                    <div class="tier-stat-cont text-center">
                                                <?php 
                                                
                                                //What rank to look for
                                                $stat_rank = " AND s_rank.rank_id > 3";
                                                
                                                //Join the strings together
                                                $stat_sql = $master_stat_sql . $stat_rank;

                    
                                                // Run Query
                                                $stat_result = mysqli_query($conn, $stat_sql);
                                        
                                     
                                                
                                                ?>
                                        <i class="fas fa-piggy-bank"></i>
                                        <br>
                                        <span>
                                            <strong>
                                                  <?php
                                                echo mysqli_num_rows($stat_result);
                                            
                                            ?>
                                           </strong>
                                            <br>
                                            <small>
                                                No. of Savers
                                            </small>
                                        </span>
                                    
                                    </div>
                                
                                </div>
                                <!--END OF NO. OF ACCOUNTS --->
                                
                                
                                 <!--AVERAGE INTEREST --->
                                <div class = "col-3">
                                    <div class="tier-stat-cont text-center">
                                        <i class="fas fa-chart-line"></i>
                                        <br>
                                        <span>
                                          <?php
                                            //CALCULATE THE AVERAGE INTEREST
                                            $s_average   = 0;
                                            while($row = mysqli_fetch_assoc($stat_result)) { 
                       
                                                $s_average = $s_average + ($row["v_rate"] + $row["b_rate"]);
                                                
                                            }
                                          
                                            echo number_format($s_average / mysqli_num_rows($stat_result),"2") . "%"
                                            
                                            
                                            
                                            //number_format($s_average / mysqli_num_rows($stat_result),"0") . "%"
                                            
                                               //END OF CALCULATE THE AVERAGE INTEREST
                                            ?>
                                            
                                            <br>
                                            <small>
                                                Avg. Interest
                                            </small>
                                        </span>
                                    
                                    </div>
                                
                                </div>
                                <!--END OF AVERAGE INTEREST --->                           
                            </div>
                             <!--END OF Tier stats/information --->
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!--====END Saver tier legend dashboard ====--> 
        
        
        <section id="" class="sectionBody">
            <!--START Contact US section-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Contact Us</h1>
                        <hr>
                        <h3>It is incredibly important to hear feedback from you. We endeavour to provide the most accurate services.</h3>
                        <a href="contact.php"><button class="btn btn-lg btn-primary">Contact us!</button></a>
                    </div>
                </div>
               
    
            </div>
        </section>
        
        
        
</div>
  <?php include 'includes/footer.php'; ?>   

</body>
    <script type="application/javascript" src="js/activePage.js"></script>
<script type="application/javascript" src="js/closeAlert.js"></script>
<script type="application/javascript" src="js/amtValidate.js"></script>
<script type="application/javascript" src="js/s_calcView.js"></script>
<script type="application/javascript" src="js/s_tierView.js"></script>
<script type="application/javascript" src="js/scrollBut.js"></script>

<script>
//HONEYMOON POP OVER
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
</script>


    
</html>