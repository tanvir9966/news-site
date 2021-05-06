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
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>

                    <?php

                    include "../dbconn.php";

                    $limit= 3;

                    if (isset($_GET['page']))
                        $page= $_GET['page'];
                    else
                        $page= 1;

                    $offset= ($page -1) * $limit;

                    $qry= "SELECT * FROM `category` order by `category_id` desc LIMIT $offset, $limit";
                    $run= mysqli_query($con, $qry);

                    while ($data= mysqli_fetch_assoc($run))
                    {
                        ?>

                        <tr>
                            <td class='id'><?php echo $data['category_id']; ?></td>
                            <td><?php echo $data['category_name']; ?></td>
                            <td><?php echo $data['post']; ?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $data['category_id']; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $data['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>

                        <?php
                    }

                    ?>

                    </tbody>
                </table>

                <?php

                $qry2= "SELECT * FROM `category`";
                $run2= mysqli_query($con, $qry2);

                if (mysqli_num_rows($run2))
                {
                    $total_records= mysqli_num_rows($run2);
                    $total_pages= ceil($total_records / $limit);

                ?>

                <ul class='pagination admin-pagination'>

                    <?php

                    if ($page > 1)
                        echo '<li><a href="category.php?page='.($page - 1).'">Prev</a></li>';

                    ?>

                    <?php

                    for ($i = 1; $i <= $total_pages; $i++)
                    {
                        ?>

                        <li class="<?php if ($i == $page) echo 'active'; ?>"><a href="category.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                        <?php
                    }

                    if ($page < $total_pages)
                        echo '<li><a href="category.php?page='.($page + 1).'">Next</a></li>';
                    echo '</ul>';

                }

                ?>

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
