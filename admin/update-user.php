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

$user_id= $_GET['id'];

if (isset($_POST['submit']))
{
    $fname= mysqli_real_escape_string($con, $_POST['f_name']);
    $lname= mysqli_real_escape_string($con, $_POST['l_name']);
    $user= mysqli_real_escape_string($con, $_POST['username']);
    $role= mysqli_real_escape_string($con, $_POST['role']);

    $qry= "SELECT * FROM `user` WHERE `user_id` = $user_id;";
    $run= mysqli_query($con, $qry) or die("Query failed.");
    $data= mysqli_fetch_assoc($run);

    $qry2= "SELECT * FROM `user` WHERE `username` = '$user';";
    $run2= mysqli_query($con, $qry2);

    if ($data['username'] != $user and mysqli_num_rows($run2) > 0)
    {
        echo "<p style='color: red; text-align: center; margin: 10px 0;'> Username already exists. </p>";
    }

    else
    {
        $qry= "UPDATE `user` SET `first_name` = '$fname', `last_name` = '$lname', 
`username` = '$user', `role` = '$role' WHERE `user`.`user_id` = $user_id;";

        if (mysqli_query($con, $qry))
        {
            header("Location: users.php");
        }
    }
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">

                  <?php

                  $qry= "SELECT * FROM `user` WHERE `user_id` = '$user_id'";
                  $run= mysqli_query($con, $qry) or die("Failed");

                  if (mysqli_num_rows($run))
                  {
                      while ($data= mysqli_fetch_assoc($run))
                      {
                          ?>

                          <!-- Form Start -->
                          <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                              <div class="form-group">
                                  <input type="hidden" name="user_id"  class="form-control" value="1" placeholder="" >
                              </div>
                              <div class="form-group">
                                  <label>First Name</label>
                                  <input type="text" name="f_name" class="form-control" value="<?php echo $data['first_name']; ?>" placeholder="" required>
                              </div>
                              <div class="form-group">
                                  <label>Last Name</label>
                                  <input type="text" name="l_name" class="form-control" value="<?php echo $data['last_name']; ?>" placeholder="" required>
                              </div>
                              <div class="form-group">
                                  <label>User Name</label>
                                  <input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>" placeholder="" required>
                              </div>
                              <div class="form-group">
                                  <label>User Role</label>
                                  <select class="form-control" name="role" value="<?php echo $data['role']; ?>">

                                      <?php

                                      if ($data['role'] == 0)
                                      {
                                          ?>

                                          <option value="0" selected>normal User</option>
                                          <option value="1">Admin</option>

                                          <?php
                                      }

                                      else
                                      {
                                          ?>

                                          <option value="0">normal User</option>
                                          <option value="1" selected>Admin</option>

                                          <?php
                                      }

                                      ?>

                                  </select>
                              </div>
                              <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                          </form>
                          <!-- /Form -->

                          <?php
                      }
                  }

                  ?>

              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
