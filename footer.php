<?php 
include "connection.php"; 
?>

<!--start footer-->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 col-lg-4">
                    <div class="widget_title">
                        <h4><span>About Us</span></h4>
                    </div>
                    <div class="widget_content">
                        <p>Donec earum rerum hic tenetur ans sapiente delectus, ut aut reiciendise voluptat maiores alias consequaturs aut perferendis doloribus asperiores.</p>
                        <ul class="contact-details-alt">
                            <li><i class="fa fa-map-marker"></i> <p><strong>Address</strong>: India</p></li>
                            <li><i class="fa fa-phone"></i> <p><strong>Phone</strong>:<a href="tel:1234567890"> (+91) 12345 67890 </a></p></li>
                            <li><i class="fa fa-envelope"></i> <p><strong>Email</strong>: <a href="mailto:noreply@edge.com" class="hidden-sm">noreply@edge.com</a></p></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-4">
                    <div class="widget_title">
                        <h4><span>Recent Blogs</span></h4>
                    </div>
                    <div class="widget_content">
                        <ul class="links">
                          <?php
                        if(isset($connection)){
                            $sqlquery = $connection->prepare("select * from `blogs` order by `blog_id` desc limit 3 ");
                            $sqlquery->execute();
                            $results = $sqlquery;
                            foreach($results as $result){
                                $blog_date = $result['blog_created_date'];
                                $date = (explode(" ", $blog_date));
                                $date = (explode("-", $date[0]));
                                $day = $date[2];
                                $month = $date[1];
                                $year = $date[0];
                          ?>
                            <li><a href="blog-post.php?blog_id=<?php echo $result['blog_id']; ?>"><?php echo $result['blog_title']; ?><span> <?php echo monthName($month) . $day . "," . $year; ?> </span></a></li>
                          <?php
                            }
                        }
                          ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-4">
                    <div class="widget_title">
                        <h4><span>Flickr Gallery</span></h4>
                    </div>
                    <div class="widget_content">
                        <div class="flickr">
                            <ul id="flickrFeed" class="flickr-feed"></ul>
                        </div>
                    </div>
                </div>

            <div class="col-sm-6">
                <p class="copyright">Copyright &copy;Edge <?php echo date('Y'); ?></p>
            </div>

            </div>
        </div>
    </footer>
<!--end footer-->
