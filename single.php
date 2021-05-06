<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">

                        <?php

                        include "dbconn.php";

                        if (!isset($_GET['id']))
                        {
                            ?>

                            <script>
                                location.replace("index.php");
                            </script>

                            <?php
                        }

                        if (isset($_GET['id']))
                        {
                            if (!is_numeric($_GET['id']))
                            {
                                ?>

                                <script>
                                    location.replace("index.php");
                                </script>

                                <?php

                                die();
                            }
                        }

                        $qry= "SELECT * FROM `post` LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id where `post`.post_id = {$_GET['id']}";

                        $run= mysqli_query($con, $qry) or die("Failed");

                        if (mysqli_num_rows($run))
                        {
                            $data= mysqli_fetch_assoc($run);

                            ?>

                            <div class="post-content single-post">
                                <h3><?php echo $data['title']; ?></h3>
                                <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?cid=<?php echo $data['category']; ?>'><?php echo $data['category_name']; ?></a>
                                </span>
                                    <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php echo $data['author']; ?>'><?php echo $data['username']; ?></a>
                                </span>
                                    <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $data['post_date']; ?>
                                </span>
                                </div>
                                <img class="single-feature-image" src="admin/upload/<?php echo $data['post_img']; ?>" alt=""/>
                                <p class="description">
                                    <?php echo $data['description']; ?>
                                </p>
                            </div>

                            <?php

                        }

                        else
                        {
                            echo "<h2>No news found.</h2>";
                        }

                        ?>

                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
