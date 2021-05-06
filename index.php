<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">

                        <?php

                        include "dbconn.php";

                        $limit= 3;

                        if (isset($_GET['page']))
                            $page= $_GET['page'];
                        else
                            $page= 1;

                        $offset= ($page -1) * $limit;

                        $qry= "SELECT * FROM `post` LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id
                        ORDER BY post.post_id DESC LIMIT $offset, $limit";

                        $run= mysqli_query($con, $qry) or die("Failed");

                        if (mysqli_num_rows($run))
                        {
                            while ($data= mysqli_fetch_assoc($run))
                            {
                                ?>

                                <div class="post-content">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a class="post-img" href="single.php?id=<?php echo $data['post_id']; ?>"><img src="admin/upload/<?php echo $data['post_img']; ?>" alt=""/></a>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="inner-content clearfix">
                                                <h3><a href='single.php?id=<?php echo $data['post_id']; ?>'><?php echo $data['title']; ?></a></h3>
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
                                                <p class="description">
                                                    <?php echo substr($data['description'], 0, 130) . "..."; ?>
                                                </p>
                                                <a class='read-more pull-right' href='single.php?id=<?php echo $data['post_id']; ?>'>read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        }

                        else
                        {
                            echo "<h2>No record found.</h2>";
                        }

                        $qry2= "SELECT * FROM `post`";

                        $run2= mysqli_query($con, $qry2);

                        if (mysqli_num_rows($run2))
                        {
                            $total_records= mysqli_num_rows($run2);
                            $total_pages= ceil($total_records / $limit);

                            ?>

                            <ul class='pagination admin-pagination'>

                                <?php

                                if ($page > 1)
                                    echo '<li><a href="index.php?page='.($page - 1).'">Prev</a></li>';

                                ?>

                                <?php

                                for ($i = 1; $i <= $total_pages; $i++)
                                {
                                    ?>

                                    <li class="<?php if ($i == $page) echo 'active'; ?>"><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                                    <?php
                                }

                                if ($page < $total_pages)
                                    echo '<li><a href="index.php?page='.($page + 1).'">Next</a></li>';
                                echo '</ul>';
                            }

                        ?>

                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
