<div id="sidebar-body">
    <h4>Recent Posts</h4>
    <?php 
    $sqlRecent = "SELECT * FROM blogs";
    $resultRecent = mysqli_query($conn, $sqlRecent);
    
    if (mysqli_num_rows($resultRecent) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($resultRecent)) { ?>
        <a href="#"><?php echo $row['blog_heading']; ?></a>
        <br>
    <br>
    
    <?php }
} else {
    echo "Error loading recent posts";
}
    
    ?>
    <hr>
    <h4>Categories</h4>
    <hr>
    
</div>