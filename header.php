<?php

include "dbconn.php";

$page= basename($_SERVER['PHP_SELF']);

switch ($page)
{
    case "single.php":
        if (isset($_GET['id']))
        {
            if (!is_numeric($_GET['id']))
            {
                ?>

                <script>
                    location.replace("index.php");
                </script>

                <?php
            }

            else
            {
                $qry_title= "SELECT * FROM `post` WHERE `post_id` = {$_GET['id']}";
                $run_title= mysqli_query($con, $qry_title);
                $data_title= mysqli_fetch_assoc($run_title);
                $page_title= $data_title['title'];
            }
        }
        break;

    case "category.php":
        if (isset($_GET['cid']))
        {
            if (!is_numeric($_GET['cid']))
            {
                ?>

                <script>
                    location.replace("index.php");
                </script>

                <?php
            }

            else
            {
                $qry_title= "SELECT * FROM `category` WHERE `category_id` = {$_GET['cid']}";
                $run_title= mysqli_query($con, $qry_title);
                $data_title= mysqli_fetch_assoc($run_title);
                $page_title= $data_title['category_name'];
            }
        }
        break;

    case "author.php":
        if (isset($_GET['aid']))
        {
            if (!is_numeric($_GET['aid']))
            {
                ?>

                <script>
                    location.replace("index.php");
                </script>

                <?php
            }

            else
            {
                $qry_title= "SELECT * FROM `user` WHERE `user_id` = {$_GET['aid']}";
                $run_title= mysqli_query($con, $qry_title);
                $data_title= mysqli_fetch_assoc($run_title);
                $page_title= $data_title['first_name'] . " " .  $data_title['last_name'];
            }
        }
        break;

    case "search.php":
        if (isset($_GET['search']))
            $page_title= "Search: " . $_GET['search'];
        break;

    default:
        $page_title= "News site";
        break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">

                <?php

                $qry= "SELECT * FROM `settings`";
                $run= mysqli_query($con, $qry);
                $data= mysqli_fetch_assoc($run);

                ?>

                <a href="index.php" id="logo"><img src="admin/images/<?php echo $data['logo'] ?>" height="88px" width="303px"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php

                include "dbconn.php";

                $qry= "SELECT * FROM `category` WHERE post > 0";
                $run= mysqli_query($con, $qry) or die("Failed");

                if (mysqli_num_rows($run))
                {
                    ?>

                    <ul class='menu'>
                        <li><a href='index.php'>Home</a></li>

                        <?php

                        $active= "";

                        while ($data= mysqli_fetch_assoc($run))
                        {
                            if (isset($_GET['cid']))
                            {
                                if ($data['category_id'] == $_GET['cid'])
                                    $active= "active";
                                else
                                    $active= "";
                            }

                            ?>

                            <li><a class="<?php echo $active; ?>" href='category.php?cid=<?php echo $data['category_id']; ?>'><?php echo $data['category_name']; ?></a></li>

                            <?php
                        }

                        ?>

                    </ul>

                    <?php
                }

                ?>

            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
