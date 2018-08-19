<?php include "includes/sub_header.php"; ?>

<?php include "sub_functions.php"; ?>

<?php
$query = "SELECT * FROM users WHERE username = '{$_SESSION['username']}' ";
$select_image = mysqli_query($connection,$query);
if(!$select_image){
  die(mysqli_error($connection));
}
while($row = mysqli_fetch_assoc($select_image)){
  $user_image = $row['user_image'];
  $first_name = $row['first_name'];
  $last_name = $row['last_name'];
  $email = $row['email'];
  $role = $row['role'];
}
?>

<?php
$query = "SELECT * FROM posts WHERE post_author = '{$_SESSION['username']}'";
$select_all_post = mysqli_query($connection,$query);
$post_counts = mysqli_num_rows($select_all_post);
?>

<?php
$query = "SELECT * FROM comments WHERE comment_author = '{$_SESSION['username']}'";
$select_all_comment = mysqli_query($connection,$query);
$comment_counts = mysqli_num_rows($select_all_comment);
?>

<?php
  $query = "SELECT likes FROM posts WHERE post_author = '{$_SESSION['username']}'";
  $select_likes = mysqli_query($connection,$query);
  $total = 0;
  while($row = mysqli_fetch_array($select_likes)){
    $likes = $row['likes'];
    $total += $likes;
  }
?>


    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/sub_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

              <!-- Page Heading -->
              <div class="row">
                  <div class="col-lg-12">

                      <div class="col-lg-4">
                      <h1 class="page-header">
                          Welcome
                          <small><?php echo $_SESSION['username']; ?></small>
                      </h1>
                      <h2>
                      <!-- <?php echo "Users Online: ".users_online(); ?> <br> -->
                    </h2>
                    <h3>Profile</h3>
                    <a href="profile.php"><img src="../images/<?php echo $user_image; ?>" width="150" alt="+ Add Image"></a><br>
                    <font color="white"><p>i</p></font>
                  </div>

                  <div class="col-lg-4">
                    <br><br><h2>Name<br>
                    <small><?php echo "$first_name"." "."$last_name" ; ?></small></h2>
                    <h2>Email<br>
                    <small><?php echo "$email" ; ?></small></h2>
                    <h2>Role<br>
                    <small><?php echo "$role" ; ?></small></h2>
                  </div>

                  <div class="col-lg-4">
                    <br><br><h2>Posts Submitted<br>
                    <small><?php echo "$post_counts"; ?></small></h2>
                    <h2>Comments Submitted<br>
                    <small><?php echo "$comment_counts" ; ?></small></h2>
                    <h2>Karma<br>
                    <small><?php echo "$total"; ?></small></h2>
                  </div>
                  </div>
              </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/sub_footer.php"; ?>
