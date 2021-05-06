<?php

include "header.php";
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

$qry= "SELECT * FROM `category` WHERE `category_id` = $category_id";
$run= mysqli_query($con, $qry);
$data= mysqli_fetch_assoc($run);

if (isset($_POST['submit']))
{
    $category_name= mysqli_real_escape_string($con, $_POST['cat_name']);

    $qry2= "SELECT * FROM `category` WHERE `category_name` = '$category_name';";
    $run2= mysqli_query($con, $qry2);

    if ($category_name == null)
    {
        echo "<p style='color: red; text-align: center; margin: 10px 0;'> Please write something. </p>";
    }

    elseif ($data['category_name'] != $category_name and mysqli_num_rows($run2) > 0)
    {
        echo "<p style='color: red; text-align: center; margin: 10px 0;'> Category already exists. </p>";
    }

    else
    {
        $qry= "UPDATE `category` SET `category_name` = '$category_name' WHERE `category`.`category_id` = $category_id;";

        if (mysqli_query($con, $qry))
        {
            ?>

            <script>
                alert("Category updated.");
                location.replace("category.php");
            </script>

            <?php
        }
    }
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="1" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $data['category_name']; ?>"  placeholder="">
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
