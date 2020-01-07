<?php include 'includes/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Dosh Alley | Articles</title>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/funcs.php'; ?>



</head>
<!-- Inspiration -->
<!-- https://www.hostgator.com/blog/top-10-most-popular-design-templates-for-gator-website-builder/ -->

<body>
    <div id="main">
        <?php include 'includes/nav.php'; ?>
        <!--Blog Choose Section -->
        <section>

            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <section id="post-body">
                           
                            <?php
                  //  $sql = "SELECT * FROM blogs";
                    $postID = cleanData($_GET['id']);
                            
                    $sql = "SELECT blogs.blog_id, blogs.user_id, blogs.blog_cdate, blogs.blog_head, blogs.blog_img, blogs.blog_ctg, blogs.blog_content, blogs.blog_vis,blogs.blog_slug, blogs.blog_feat, users.firstname, users.lastname, users.user_id FROM blogs INNER JOIN users ON blogs.user_id = users.user_id WHERE blogs.blog_vis = 1 AND blogs.blog_id = $postID";  
                            
                            
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) { 
                        $postID = $row["blog_id"];
                        //Formating date from SQL server
                        $timePosted = strtotime($row["blog_cdate"]);
                        $datePosted = date("F d, Y ", $timePosted);
                        ?>
                            <!--BLOG IMAGE-->
                            <div class="row">
                                <div class="col-md-12">
                                    <img class="img-fluid" src="<?php echo $row["blog_img"]; ?>">
                                </div>
                            </div>
                             <!--BLOG Header-->
                            <div class="row">
                                <div class="col-md-12">
                                    <h1><?php echo $row['blog_head']; ?></h1>
                                </div>
                            </div>
                             <!--BLOG Sub Details-->
                            <div class="row">
                                <div class="col-md-8">
                                    <h5>
                                          <?php echo "By " . $row["firstname"] . " " . $row["lastname"] . " | " . $datePosted;  ?>
                                    </h5>
                                </div>
                                
                                 <div class="col-md-4">
                                     <h5><?php echo "Category: <i>" . $row["blog_ctg"] . "</i>";  ?></h5>
                                </div>
                            </div>
                            <hr>
                            
                             <!--BLOG Content-->
                            <div class="row">
                                <div class="col-md-12">
                                   <?php echo $row["blog_content"];  ?>  
                                </div>
                            </div>
                            <?php }
                    } else {
                        echo "No blog posts to show.";
                    }
                    
                    
                    ?>
                        </section>
                        <!--Printing the title -->
                    </div>
                    <div class="col-md-3">
                        <?php 
                            include 'includes/sidebar.php'; 
                            mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div>
        </section>

    </div>
</body>
<script type="application/javascript" src="js/activePage.js"></script>
<script type="application/javascript" src="js/scrollBut.js"></script>

</html>