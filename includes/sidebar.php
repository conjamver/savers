<div id="sidebar-body">
   
    <h4>Featured Posts</h4>
    <?php 
    $sqlRecent = "SELECT * FROM blogs WHERE blog_feat = 1 AND blog_vis = 1";
    $resultRecent = mysqli_query($conn, $sqlRecent);
    
    if (mysqli_num_rows($resultRecent) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($resultRecent)) { 
      //Formating date from SQL server
        $timePosted = strtotime($row["blog_cdate"]);
        $datePosted = date("F d, Y ", $timePosted);
      
    ?>
    
    <div class="featuredblog-item">
        <a href="/post/<?php echo $row['blog_id'] . "/" . $row["blog_slug"]; ?>"><i class="far fa-edit"></i> <?php echo $row['blog_head']; ?></a>
        <small class="text-secondary d-block">- <?php echo $datePosted;?></small>
    </div>
   
    
    
    
    <?php }
} else {
    echo "Error loading featured posts";
}
    
    ?>

    <hr>
    <h4>Categories</h4>
    <?php
        $sqlCtg = "SELECT DISTINCT * FROM blogs WHERE blog_vis = 1";
        $resultCtg = mysqli_query($conn, $sqlCtg);
        $ctg = "";
    
        if (mysqli_num_rows($resultCtg) > 0) {
            
            while($row = mysqli_fetch_assoc($resultCtg)) { 
                $ctg = $row['blog_ctg'];
                 
              
                
                //Count using SQL
                $sqlCtgCount = "SELECT blog_ctg FROM blogs WHERE blog_ctg = '$ctg' AND blog_vis = 1";
                $resultCtgCount = mysqli_query($conn, $sqlCtgCount);
                //END of counting
    
                ?>
    
                <a href="/articles_category/<?php echo $row["blog_ctg"]; ?>"><i class="fas fa-layer-group"></i> <?php echo $ctg; ?></a>
                <span class="badge badge-primary"><?php echo mysqli_num_rows($resultCtgCount); ?></span>
    
                <br>
    
        <?php 
            }
            
            
        }else{
            echo "Error loading category";
        }
    
    ?>
    <hr>
    
</div>