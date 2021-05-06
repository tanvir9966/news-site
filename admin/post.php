<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
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

                  if ($_SESSION['role'] == 1)
                  {
                      $qry= "SELECT * FROM `post` LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id
                        ORDER BY post.post_id DESC LIMIT $offset, $limit";
                  }

                  elseif($_SESSION['role'] == 0)
                  {
                      $qry= "SELECT * FROM `post` LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id
                        where post.author= {$_SESSION['user_id']}
                        ORDER BY post.post_id DESC LIMIT $offset, $limit";
                  }

                  $run= mysqli_query($con, $qry) or die("Failed");

                  if (mysqli_num_rows($run))
                  {
                      ?>

                      <table class="content-table">
                          <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                          </thead>
                          <tbody>

                          <?php

                          while ($data= mysqli_fetch_assoc($run))
                          {
                              ?>

                              <tr>
                                  <td class='id'><?php echo $data['post_id']; ?></td>
                                  <td><?php echo $data['title']; ?></td>
                                  <td><?php echo $data['category_name']; ?></td>
                                  <td><?php echo $data['post_date']; ?></td>
                                  <td><?php echo $data['username']; ?></td>
                                  <td class='edit'><a href='update-post.php?id=<?php echo $data['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                                  <td class='delete'><a href='delete-post.php?id=<?php echo $data['post_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                              </tr>

                              <?php
                          }

                          ?>

                          </tbody>
                      </table>

                      <?php
                  }

                  if ($_SESSION['role'] == 1)
                      $qry2= "SELECT * FROM `post`";
                  elseif ($_SESSION['role'] == 0)
                      $qry2= "SELECT * FROM `post` where post.author= {$_SESSION['user_id']}";

                  $run2= mysqli_query($con, $qry2);

                  if (mysqli_num_rows($run2))
                  {
                      $total_records= mysqli_num_rows($run2);
                      $total_pages= ceil($total_records / $limit);

                      ?>

                      <ul class='pagination admin-pagination'>

                          <?php

                          if ($page > 1)
                              echo '<li><a href="post.php?page='.($page - 1).'">Prev</a></li>';

                          ?>

                          <?php

                          for ($i = 1; $i <= $total_pages; $i++)
                          {
                              ?>

                              <li class="<?php if ($i == $page) echo 'active'; ?>"><a href="post.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                              <?php
                          }

                          if ($page < $total_pages)
                              echo '<li><a href="post.php?page='.($page + 1).'">Next</a></li>';
                          echo '</ul>';
                      }

                  ?>

              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
