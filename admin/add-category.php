<?php

include "header.php";

include "../dbconn.php";

if (isset($_POST['save']))
{
    $category= mysqli_real_escape_string($con, $_POST['cat']);

    $qry= "SELECT * FROM `category` WHERE `category_name` = '$category'";
    $run= mysqli_query($con, $qry);

    if ($category == null)
    {
        echo "<p style='color: red; text-align: center; margin: 10px 0;'> Please write something. </p>";
    }

    elseif (mysqli_num_rows($run) > 0)
    {
        echo "<p style='color: red; text-align: center; margin: 10px 0;'> Category already exists. </p>";
    }

    else
    {
        $qry= "INSERT INTO `category` (`category_name`, `post`) VALUES
 ('$category', '0');";

        if (mysqli_query($con, $qry))
        {
            ?>

            <script>
                alert("Category added.");
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
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name">
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php

include "footer.php";

?>
