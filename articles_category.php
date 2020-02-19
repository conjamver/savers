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
                    <?php
                  //  $sql = "SELECT * FROM blogs";
                            
                    $ctg = cleanData($_GET['ctg']);        
                            
                    $sql = "SELECT blogs.blog_id, blogs.user_id, blogs.blog_cdate, blogs.blog_head, blogs.blog_img, blogs.blog_ctg, blogs.blog_content, blogs.blog_vis,blogs.blog_slug, blogs.blog_feat, users.firstname, users.lastname, users.user_id FROM blogs INNER JOIN users ON blogs.user_id = users.user_id WHERE blogs.blog_vis = 1 AND blogs.blog_ctg = '$ctg'" . " ORDER BY blog_cdate DESC";      
                     
                            
                            /////TITLE
                    ?>
                            <h1>Articles > <small><?php echo $ctg;?> </small></h1>
                            <hr>
            
                            
                    <?php
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
                                    <img class="img-fluid img-thumbnail" src="/<?php echo $row["blog_img"]; ?>">
                                </div>
                                <!--Blog details -->
                                <div class="col-md-8">

                                    <h3>
                                        <a href="/post/<?php echo $postID . "/" . $row["blog_slug"]; ?>">
                                        
                                        
                                        <?php echo $row["blog_head"]; ?></a></h3>
                                    <!--Blog authour -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6><?php echo "By " . $row["firstname"] . " " . $row["lastname"] . " | " . $datePosted;  ?>
                                            </h6>
                                            <?php 
                                                //Show only partial but never cut off a word
                                                if(strlen($row["blog_content"])>120){  
                                                    echo substr($row["blog_content"],0,120 + strpos($row["blog_content"]," ",120) - 120) . "...";
                                                }
                                                else{
                                                    echo "...";
                                                }
                                            
                                            ?>
                                        </div>
                                    </div>
                                    <!--Blog read more-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="/post/<?php echo $postID . "/" . $row["blog_slug"]; ?>"><button class="btn btn-outline-primary">Read More</button></a>
                                            
                                                <h6 class="d-inline text-right ctg"><?php echo "Category: <i>" . $row['blog_ctg'] . "</i>";  ?></h6>
                                          
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
                        <?php 
                            include 'includes/sidebar.php'; 
                            mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div>
        </section>

    </div>
    
      <?php include 'includes/footer.php'; ?>   

</body>
<script type="application/javascript" src="js/activePage.js"></script>
<script type="application/javascript" src="js/scrollBut.js"></script>

</html>