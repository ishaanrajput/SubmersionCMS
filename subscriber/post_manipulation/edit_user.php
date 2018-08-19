<?php

if(isset($_GET['edit_user'])){
  $the_user_id = $_GET['edit_user'];

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

  $user_image = escape($_FILES['image']['name']);
  $user_image_temp = escape($_FILES['image']['tmp_name']);

  // $role = $_POST['role']
if($password == ''){
  die("Password cannot be left blank.");
}
else if($password == $r_password){
  move_uploaded_file($user_image_temp, "../images/$user_image");
  $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
  if(empty($post_image)){
    $query = "SELECT * FROM posts WHERE post_id = $the_user_id";
    $select_image = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_image)){
      $post_image = $row['post_image'];
    }
  }

  $query = "UPDATE users SET ";
  $query .= "username = '{$username}', ";
  $query .= "password = '{$password}', ";
  $query .= "first_name = '{$first_name}', ";
  $query .= "last_name = '{$last_name}', ";
  $query .= "email = '{$email}', ";
  $query .= "user_image = '{$user_image}' ";
  $query .= "WHERE user_id = {$the_user_id} ";

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
    <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
  </div>
</form>

</div>
