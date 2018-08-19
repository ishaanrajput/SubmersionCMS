<?php include "includes/sub_header.php"; ?>
<?php include "sub_functions.php"; ?>

<?php
if(isset($_SESSION['username'])){
  $username = escape($_SESSION['username']);

  $query = "SELECT * FROM users WHERE username = '{$username}' ";
  $select_user_profile_query = mysqli_query($connection,$query);
  if(!$select_user_profile_query){
    die("no".mysqli_error($connection));
  }

  while($row = mysqli_fetch_array($select_user_profile_query)){

    $user_id = $row['user_id'];
    $username = $row['username'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $user_image = $row['user_image'];
    $role = $row['role'];

  }
}
?>

<?php
if(isset($_GET['edit_user'])){
  $the_user_id = escape($_GET['edit_user']);

  $query = "SELECT * FROM users WHERE user_id = $the_user_id";
  $select_users_query = mysqli_query($connection, $query);
  if(!$select_users_query){
    die("no".mysqli_error($connection));
  }

  while($row = mysqli_fetch_assoc($select_users_query)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $user_image = $row['user_image'];
    $role = $row['role'];
}

}


if(isset($_POST['edit_user'])){

  $username = escape($_POST['username']);
  $password = escape($_POST['password']);
  $r_password = escape($_POST['r_password']);
  $first_name = escape($_POST['first_name']);
  $last_name = escape($_POST['last_name']);
  $email = escape($_POST['email']);

  $user_image = $_FILES['image']['name'];
  $user_image_temp = $_FILES['image']['tmp_name'];

  // $role = $_POST['role']
if($password == ''){
  die("Password cannot be left blank.");
}
else if($password == $r_password){
  move_uploaded_file($user_image_temp, "../images/$user_image");

//  if(empty($post_image)){
//    $query = "SELECT * FROM posts WHERE post_id = $the_user_id";
//    $select_image = mysqli_query($connection,$query);
//    while($row = mysqli_fetch_assoc($select_image)){
//      $post_image = $row['post_image'];
//    }
//  }
  $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
  $query = "UPDATE users SET ";
  $query .= "username = '{$username}', ";
  $query .= "password = '{$password}', ";
  $query .= "first_name = '{$first_name}', ";
  $query .= "last_name = '{$last_name}', ";
  $query .= "email = '{$email}', ";
  $query .= "user_image = '{$user_image}' ";
  $query .= "WHERE username = '{$username}' ";

  $edit_user_query = mysqli_query($connection,$query);
  if(!$edit_user_query){
    die("no".mysqli_error($connection));
  }

}
else{
  die("Passwords do not match.");
}
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

                        <h1 class="page-header">
                            Welcome
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                    </div>
                </div>

                <div class="col-xs-12">

                <form action="" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label for="username">Username</label>
                    <input value="<?php echo $username; ?>" class="form-control" type="text" name="username">
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password">
                  </div>

                  <div class="form-group">
                    <label for="r_password">Repeat Password</label>
                    <input class="form-control" type="password" name="r_password">
                  </div>

                  <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input value="<?php echo $first_name; ?>" class="form-control" type="text" name="first_name">
                  </div>

                  <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input value="<?php echo $last_name; ?>" class="form-control" type="text" name="last_name">
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input value="<?php echo $email; ?>" class="form-control" type="email" name="email">
                  </div>

                  <div class="form-group">
                    <label for="user_image">Profile Picture</label>
                    <input value="<?php echo $user_image; ?>" class="" type="file" name="image">
                  </div>

                  <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                  </div>
                </form>

                </div>


            </div>
        </div>
        <!-- /#page-wrapper -->
<?php include "includes/sub_footer.php"; ?>
