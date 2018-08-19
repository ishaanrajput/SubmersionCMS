<?php
include "sub_functions.php";
if(isset($_POST['create_user'])){

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
  $query = "INSERT INTO users(username,password,first_name,last_name,
  email,user_image,role) ";
  $query .= "VALUES('{$username}','{$password}','{$first_name}',
  '{$last_name}','{$email}','{$user_image}','subscriber' ) ";

  $create_user_query = mysqli_query($connection,$query);

  echo "New User Created: "." "."<a href='users.php'>View Users</a> ";
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
    <input class="form-control" type="text" name="username">
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
    <input class="form-control" type="text" name="first_name">
  </div>

  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input class="form-control" type="text" name="last_name">
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input class="form-control" type="email" name="email">
  </div>

  <div class="form-group">
    <label for="user_image">Profile Picture</label>
    <input class="" type="file" name="image">
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
  </div>
</form>

</div>
