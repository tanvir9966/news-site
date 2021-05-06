<?php

session_start();

if (!isset($_SESSION['username']))
{
    ?>

    <script>
        location.replace("../admin");
    </script>

    <?php
}

if ($_SESSION['role'] != 1)
{
    ?>

    <script>
        location.replace("post.php");
    </script>

    <?php
}

include "../dbconn.php";

$qry= "SELECT * FROM `settings`";
$run= mysqli_query($con, $qry);
$data= mysqli_fetch_assoc($run);

$web_name= mysqli_real_escape_string($con, $_POST['website_name']);
$footer_desc= mysqli_real_escape_string($con, $_POST['footer_desc']);

if (empty($_FILES['logo']['name']))
{
    $qry3= "UPDATE `settings` SET `websiteName` = '$web_name', `footerDesc` = '$footer_desc'";

    if (mysqli_query($con, $qry3))
    {
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

    $file_name= $_FILES['logo']['name'];
    $file_size= $_FILES['logo']['size'];
    $tmp_name= $_FILES['logo']['tmp_name'];
    $file_type= $_FILES['logo']['type'];
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
        $qry3= "UPDATE `settings` SET `websiteName` = '$web_name', `logo` = '$file_name', `footerDesc` = '$footer_desc'";

        if (mysqli_query($con, $qry3))
        {
            move_uploaded_file($tmp_name, "images/" . $file_name);
            unlink("images/" . $data['logo']);

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
