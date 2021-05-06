<?php include "header.php";

if ($_SESSION['role'] != 1)
{
    ?>

    <script>
        location.replace("post.php");
    </script>

    <?php
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Website Settings</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">

                <?php

                include "../dbconn.php";

                $qry= "SELECT * FROM `settings`";
                $run= mysqli_query($con, $qry);

                if (mysqli_num_rows($run) > 0)
                {
                    while ($data= mysqli_fetch_assoc($run))
                    {
                        ?>

                        <!-- Form -->
                        <form  action="save-settings.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="website_name">Website Name</label>
                                <input type="text" name="website_name" value="<?php echo $data['websiteName']; ?>" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="logo">Website Logo</label>
                                <input type="file" name="logo">
                                <img src="images/<?php echo $data['logo']; ?>">
                                <input type="hidden" name="old_logo" value="<?php echo $data['logo']; ?>" >
                            </div>
                            <div class="form-group">
                                <label for="footer_desc">Footer Description</label>
                                <textarea name="footer_desc" class="form-control" rows="5" required><?php echo $data['footerDesc']; ?></textarea>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                        </form>
                        <!--/Form -->

                        <?php
                    }
                }

                ?>

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
