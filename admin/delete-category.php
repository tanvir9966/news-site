<?php

include "../dbconn.php";

if ($_SESSION['role'] != 1)
{
    ?>

    <script>
        location.replace("post.php");
    </script>

    <?php
}

$category_id= $_GET['id'];

$qry= "DELETE FROM `category` WHERE `category_id` = $category_id";

if (mysqli_query($con, $qry))
{
    ?>

    <script>
        alert("Category deleted successfully.");

        location.replace("category.php");
    </script>

    <?php
}

else
{
    ?>

    <script>
        alert("Something wrong to delete the category.");
    </script>

    <?php
}
