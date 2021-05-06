<?php

include "../dbconn.php";

session_start();

if (isset($_FILES['fileToUpload']))
{
    $errors= array();

    $file_name= $_FILES['fileToUpload']['name'];
    $file_size= $_FILES['fileToUpload']['size'];
    $tmp_name= $_FILES['fileToUpload']['tmp_name'];
    $file_type= $_FILES['fileToUpload']['type'];
    $file_ext= explode('.' , $file_name);
    $file_ext= strtolower(end($file_ext));
    $file_name= uniqid('', true) . "." . $file_ext;
    $extensions= array("jpeg", "png", "jpg");

    if (in_array($file_ext, $extensions) === false)
    {
        ?>

        <script>
            alert("This type of file is not allowed.");
            location.replace("add-post.php");
        </script>

        <?php
    }

    elseif ($file_size > (2*1024*1024))
    {
        ?>

        <script>
            alert("Max 2MB of file is allowed.");
            location.replace("add-post.php");
        </script>

        <?php
    }

    else
    {
        $title= mysqli_real_escape_string($con, $_POST['post_title']);
        $description= mysqli_real_escape_string($con, $_POST['postdesc']);
        $category= mysqli_real_escape_string($con, $_POST['category']);
        $date= date("d M, Y");
        $author= $_SESSION['user_id'];

        $qry= "INSERT INTO `post` (`title`, `description`, `category`, `post_date`, `author`,
        `post_img`) VALUES ('$title', '$description', '$category', '$date', '$author', '$file_name');";
        $qry2 = "UPDATE `category` SET `post` = `post` + 1 WHERE `category`.`category_id` = $category";

        $run= mysqli_query($con, $qry);
        $run2= mysqli_query($con, $qry2);

        if ($run and $run2)
        {
            move_uploaded_file($tmp_name, "upload/" . $file_name);

            ?>

            <script>
                location.replace("post.php");
            </script>

            <?php
        }

        else
        {
            echo "<div class='alert alert-danger'> Operation failed. </div>";
        }
    }
}
