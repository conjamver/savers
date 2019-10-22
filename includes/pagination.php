<div class = "row">
      <!--START OF PAGINATION --> 
    <div class="col-md-4">
        <strong>
            Showing <?php echo $this_page_first_result + 1 . "-" . ($results_per_page * $page - ($results_per_page - $resultCount)); ?> of <?php echo $number_of_results; ?> Results
            <br>
            <small class="badge badge-secondary">
                <i class="fas fa-filter"></i> Filter: 
                <?php 
                
                
                if(isset($_GET['filterBy'])){
                        echo $orderByTxt; 
                    }else{
                        echo "Highest Tier";
                    }
                
                ?>
            </small>
            <small class="badge badge-success">
                <i class="fas fa-coins"></i> 
                <?php 
                    if(isset($_GET['saveAmount'])){
                        echo "$" . number_format($saveAmount); 
                    }else{
                        echo "---";
                    }
                
                    
                    
                ?>
            </small>
        </strong>
    </div>
    <div class="col-md-4 text-center">

        <ul class="pagination justify-content-center">

        <?php
        ////Back button functionality/////    
        if($page == 1){
            echo '<li class="page-item disabled"><a class="page-link" href="#">Back</a></li>';
        }else{
            echo '<li class="page-item"><a class="page-link" href="index.php?'. htmlspecialchars(updateUrl('page',$page - 1)) .'">Back</a></li>';
        }
         ////END Back button functionality/////     
        ?>


        <?php
            //Display Pagination Links
            for ($i=1;$i<=$number_of_pages;$i++){ 

                //Print active link 
                if($page == $i){

                    echo '<li class="page-item active">';
                    echo '<a class="page-link" href="index.php?' . htmlspecialchars(updateUrl('page',$i)) . '">' . $i . '</a>'; 

                    echo '</li>';
                //Print normal link 
                }else{

                    echo '<li class="page-item">';
                    echo '<a class="page-link" href="index.php?' . htmlspecialchars(updateUrl('page',$i)) . '">' . $i . '</a>'; 
                    echo '</li>'; 
                }
            }
            ////END OF PAGINATION
           ?>

        <?php
        ////Next button functionality/////   
        //Disable if we are on last page    
        if($results_per_page * $page == $number_of_results) {
            echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
        }else{
            echo '<li class="page-item"><a class="page-link" href="index.php?'. htmlspecialchars(updateUrl('page',$page + 1)) .'">Next</a></li>';
        }
         ////END OF Next button functionality/////     
        ?>

        </ul>  

    </div>
    <div class="col-md-4">

    </div>
</div>