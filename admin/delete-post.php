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

    die();
}

$post_id= mysqli_real_escape_string($con, $_GET['id']);

$qry= "SELECT * FROM `post` WHERE `post_id` = $post_id";
$run= mysqli_query($con, $qry);

if ($run == false)
{
    ?>

    <script>
        location.replace("post.php");
    </script>

    <?php

    die();
}

$row= mysqli_num_rows($run);

if ($row == 0)
{
    ?>

    <script>
        location.replace("post.php");
    </script>

    <?php

    die();
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

        die();
    }
}

$img= $data['post_img'];

$qry= "DELETE FROM `post` WHERE `post_id` = $post_id";
$qry2= "SELECT * FROM `post` WHERE `post_id` = $post_id";
$run2= mysqli_query($con, $qry2);
$data2= mysqli_fetch_assoc($run2);

if (mysqli_query($con, $qry))
{
    $qry= "UPDATE `category` SET `post` = `post` - 1 WHERE `category`.`category_id` = " . $data2['category'];
    mysqli_query($con, $qry);

    unlink("upload/" . $img);

    ?>

    <script>
        alert("Post deleted successfully.");

        location.replace("post.php");
    </script>

    <?php
}

else
{
    ?>

    <script>
        alert("Something wrong to delete the post.");
    </script>

    <?php
}
