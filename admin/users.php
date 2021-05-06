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
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">

                  <?php

                  include "../dbconn.php";

                  $limit= 3;

                  if (isset($_GET['page']))
                      $page= $_GET['page'];
                  else
                      $page= 1;

                  $offset= ($page -1) * $limit;

                  $qry= "SELECT * FROM `user` ORDER BY `user_id` DESC LIMIT $offset, $limit";
                  $run= mysqli_query($con, $qry) or die("Failed");

                  if (mysqli_num_rows($run) > 0)
                  {
                      ?>

                      <table class="content-table">
                          <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                          </thead>
                          <tbody>

                          <?php

                          while ($data= mysqli_fetch_assoc($run))
                          {
                              ?>

                              <tr>
                                  <td class='id'><?php echo $data['user_id']; ?></td>
                                  <td><?php echo $data['first_name'] . " " . $data['last_name']; ?></td>
                                  <td><?php echo $data['username']; ?></td>
                                  <td>
                                    <?php

                                    if ($data['role'] == 1)
                                        echo "Admin";
                                    else
                                        echo "Normal user";

                                    ?>
                                  </td>
                                  <td class='edit'><a href='update-user.php?id=<?php echo $data['user_id']; ?>'><i class='fa fa-edit'></i></a></td>
                                  <td class='delete'><a href='delete-user.php?id=<?php echo $data['user_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                              </tr>

                              <?php
                          }

                          ?>

                          </tbody>
                      </table>


                      <?php
                  }

                  $qry2= "SELECT * FROM `user`";
                  $run2= mysqli_query($con, $qry2);

                  if (mysqli_num_rows($run2))
                  {
                      $total_records= mysqli_num_rows($run2);
                      $total_pages= ceil($total_records / $limit);

                      ?>

                        <ul class='pagination admin-pagination'>

                            <?php

                            if ($page > 1)
                                echo '<li><a href="users.php?page='.($page - 1).'">Prev</a></li>';

                            ?>

                      <?php

                      for ($i = 1; $i <= $total_pages; $i++)
                      {
                          ?>

                          <li class="<?php if ($i == $page) echo 'active'; ?>"><a href="users.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                          <?php
                      }

                      if ($page < $total_pages)
                          echo '<li><a href="users.php?page='.($page + 1).'">Next</a></li>';
                      echo '</ul>';
                  }

                  ?>

              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
