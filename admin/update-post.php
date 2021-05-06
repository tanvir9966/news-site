<?php

include "header.php";
include "../dbconn.php";

if (!isset($_GET['id']))
{
    ?>

    <script>
        location.replace("post.php");
    </script>

    <?php
}

$post_id= mysqli_real_escape_string($con, $_GET['id']);

$qry= "SELECT * FROM `post` WHERE `post_id` = $post_id";
$qry2= "SELECT * FROM `category`";

$run= mysqli_query($con, $qry);
$run2= mysqli_query($con, $qry2);

if ($run == false)
{
    ?>

    <script>
        location.replace("post.php");
    </script>

    <?php
}

$row= mysqli_num_rows($run);

if ($row == 0)
{
    ?>

    <script>
        location.replace("post.php");
    </script>

    <?php
}

$data= mysqli_fetch_assoc($run);

if ($_SESSION['role'] == 0)
{
    if ($_SESSION['user_id'] != $data['author'])
    {
        ?>

        <script>
            location.replace("post.php");
        </script>

        <?php
    }
}

if (isset($_POST['submit']))
{
    $title= mysqli_real_escape_string($con, $_POST['post_title']);
    $desc= mysqli_real_escape_string($con, $_POST['postdesc']);
    $category= mysqli_real_escape_string($con, $_POST['category']);

    if (empty($_FILES['new-image']['name']))
    {
        $qry3= "UPDATE `post` SET `title` = '$title', `description` = '$desc', 
        `category` = $category WHERE `post`.`post_id` = $post_id;";

        if (mysqli_query($con, $qry3))
        {
            if ($data['category'] != $category)
            {
                $qry= "UPDATE `category` SET `post` = `post` - 1 WHERE `category`.`category_id` = " . $data['category'];
                $qry2= "UPDATE `category` SET `post` = `post` + 1 WHERE `category`.`category_id` = $category";

                mysqli_query($con, $qry);
                mysqli_query($con, $qry2);
            }

            ?>

            <script>
                alert("Update successful.");
                location.replace("post.php");
            </script>

            <?php
        }

        else
        {
            echo "<p style='color: red; text-align: center; margin: 10px 0;'> Update failed. </p>";
        }
    }

    else
    {
        $errors= array();

        $file_name= $_FILES['new-image']['name'];
        $file_size= $_FILES['new-image']['size'];
        $tmp_name= $_FILES['new-image']['tmp_name'];
        $file_type= $_FILES['new-image']['type'];
        $file_ext= explode('.' , $file_name);
        $file_ext= strtolower(end($file_ext));
        $file_name= uniqid('', true) . "." . $file_ext;
        $extensions= array("jpeg", "png", "jpg");

        if (in_array($file_ext, $extensions) === false)
        {
            echo "<p style='color: red; text-align: center; margin: 10px 0;'> This type of file is not allowed. </p>";
        }

        elseif ($file_size > (2*1024*1024))
        {
            echo "<p style='color: red; text-align: center; margin: 10px 0;'> Max 2MB file is allowed. </p>";
        }

        else
        {
            $qry3= "UPDATE `post` SET `title` = '$title', `description` = '$desc', 
            `category` = $category, `post_img` = '$file_name' WHERE `post`.`post_id` = $post_id;";

            if (mysqli_query($con, $qry3))
            {
                move_uploaded_file($tmp_name, "upload/" . $file_name);
                unlink("upload/" . $data['post_img']);

                if ($data['category'] != $category)
                {
                    $qry= "UPDATE `category` SET `post` = `post` - 1 WHERE `category`.`category_id` = " . $data['category'];
                    $qry2= "UPDATE `category` SET `post` = `post` + 1 WHERE `category`.`category_id` = $category";

                    mysqli_query($con, $qry);
                    mysqli_query($con, $qry2);
                }

                ?>

                <script>
                    alert("Update successful.");
                    location.replace("post.php");
                </script>

                <?php
            }

            else
            {
                echo "<p style='color: red; text-align: center; margin: 10px 0;'> Update failed. </p>";
            }
        }
    }
}

?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="1" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $data['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5"><?php echo $data['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">

                    <?php

                    while ($data2= mysqli_fetch_assoc($run2))
                    {
                        ?>

                        <option <?php if ($data['category'] == $data2['category_id'])
                        {
                            ?>

                            selected

                            <?php
                        }
                            ?>  value="<?php echo $data2['category_id']; ?>"><?php echo $data2['category_name']; ?></option>

                        <?php
                    }

                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $data['post_img']; ?>" height="150px">
                <input type="hidden" name="old-image" value="">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
