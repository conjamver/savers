<?php include 'includes/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    
    <?php include 'includes/header.php'; ?>
    <?php 
        $pageTitle = ""; //Title name for webpages
        $pageDesc = ""; //Description of page
        include 'includes/funcs.php'; 


          //  $sql = "SELECT * FROM blogs";
        $postID = cleanData($_GET['id']);

        $sql = "SELECT blogs.blog_id, blogs.user_id, blogs.blog_cdate,blogs.blog_edate, blogs.blog_head, blogs.blog_img, blogs.blog_ctg, blogs.blog_content, blogs.blog_vis,blogs.blog_slug, blogs.blog_feat, users.firstname, users.lastname, users.user_id FROM blogs INNER JOIN users ON blogs.user_id = users.user_id WHERE blogs.blog_vis = 1 AND blogs.blog_id = $postID";  

        //Main Result
        $result = mysqli_query($conn, $sql);
        
    
        //Run only if there is result
        if (mysqli_num_rows($result) > 0) {
            $result_meta = mysqli_query($conn, $sql);
            $metaData = mysqli_fetch_assoc($result_meta);
            $pageTitle = "Dosh Alley | " . $metaData['blog_head'];
            
            //Create the description
            //Show only partial but never cut off a word
            if(strlen($metaData["blog_content"])>140){  
                $pageDesc =  substr($metaData["blog_content"],0,140 + strpos($metaData["blog_content"]," ",140) - 140) . "...";
            }
            else{
                echo "...";
            }

        }else{
            $pageTitle = "Dosh Alley | Error";
        }
    
    
        
    ?>
    <!--SEO title and description of article -->
    <title><?php echo $pageTitle; ?></title>
    <meta name="description" content="<?php echo $pageDesc ?>">
    
    
    


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
                

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) { 
                        $postID = $row["blog_id"];
                        //Formating date from SQL server
                        $timePosted = strtotime($row["blog_cdate"]);
                        $datePosted = date("F d, Y ", $timePosted);
                            
                        $timeEdited = strtotime($row["blog_edate"]);
                        $dateEdited = date("F d, Y ", $timeEdited);
                        ?>
                            <!--BLOG IMAGE-->
                            <div class="row">
                                <div class="col-md-12">
                                    <img class="img-fluid img-thumbnail" src="/<?php echo $row["blog_img"]; ?>">
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
                                     <h5>Category: <i><a href="/articles_category/<?php echo $row["blog_ctg"]; ?>"><?php echo $row["blog_ctg"];?></a></i></h5>
                                </div>
                            </div>
                            
                            <hr>
                            
                             <!--BLOG Content-->
                            <div class="row">
                                <div class="col-md-12">
                                   <?php echo $row["blog_content"];  ?>  
                                </div>
                            
                            </div>
                            
                       
                            
                            <!--BLOG Footer-->
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <span>
                                   <?php echo "Post lasted edited on: <i>" . $dateEdited . "</i>";  ?> 
                                    </span>
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