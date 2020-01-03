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
                        <section id="blog-body">
                            <h1>Articles</h1>
                            <hr>
                            <?php
                  //  $sql = "SELECT * FROM blogs";
                            
                    $sql = "SELECT blogs.blog_id, blogs.user_id, blogs.blog_cdate, blogs.blog_head, blogs.blog_img, blogs.blog_ctg, blogs.blog_vis, blogs.blog_feat, users.firstname, users.lastname, users.user_id FROM blogs INNER JOIN users ON blogs.user_id = users.user_id";      
                            
                            
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) { 
                        $postID = $row["blog_id"];
                        //Formating date from SQL server
                        $timePosted = strtotime($row["blog_cdate"]);
                        $datePosted = date("F d, Y ", $timePosted);
                        ?>
                            <div class="row blog-item">
                                <!--Image section-->
                                <div class="col-md-4">
                                    <img class="img-fluid" src="<?php echo $row["blog_img"]; ?>">
                                </div>
                                <!--Blog details -->
                                <div class="col-md-8">

                                    <h3><a href="post.php?id=<?php echo $postID; ?>"><?php echo $row["blog_head"]; ?></a></h3>
                                    <!--Blog authour -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6><?php echo $row["firstname"] . " " . $row["lastname"]; ?>
                                                <small><br><?php echo $datePosted;  ?></small>
                                            </h6>
                                        </div>
                                    </div>
                                    <!--Blog read more-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="post.php?id=<?php echo $postID; ?>"><button class="btn btn-outline-primary">Read More</button></a>
                                        </div>
                                        <!--Blog category-->
                                        <div class="col-md-6 text-right">
                                            <span class="badge badge-primary">
                                                <h6><?php echo $row['blog_ctg'];  ?></h6>
                                            </span>
                                        </div>
                                    </div>

                                    
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
                  
                    </div>
                </div>
            </div>
        </section>

    </div>
</body>
<script type="application/javascript" src="js/activePage.js"></script>
<script type="application/javascript" src="js/scrollBut.js"></script>

</html>