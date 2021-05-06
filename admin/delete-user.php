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

$user_id= $_GET['id'];

$qry= "DELETE FROM `user` WHERE `user_id` = $user_id";

if (mysqli_query($con, $qry))
{
    ?>

    <script>
        alert("User deleted successfully.");

        location.replace("users.php");
    </script>

    <?php
}

else
{
    ?>

    <script>
        alert("Something wrong to delete the user.");
    </script>

    <?php
}
