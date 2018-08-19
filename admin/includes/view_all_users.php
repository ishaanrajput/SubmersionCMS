<?php include "admin_functions.php"; ?>
<table class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>User Image</th>
      <th>Role</th>
    </tr>
  </thead>
  <tbody>

  <?php
  $query = "SELECT * FROM users";
  $select_users = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_users)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $user_image = $row['user_image'];
    $role = $row['role'];

    echo "<tr>";
    echo "<td>{$user_id}</td>";
    echo "<td>{$username}</td>";
    echo "<td>{$first_name}</td>";
    echo "<td>{$last_name}</td>";

//     $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
//     $select_categories_id = mysqli_query($connection,$query);
//
//     while($row = mysqli_fetch_assoc($select_categories_id)){
//       $cat_id = $row['cat_id'];
//       $cat_title = $row['cat_title'];
//
//     echo "<td>{$cat_title}</td>";
//
// }

    echo "<td>{$email}</td>";
    echo "<td><img width='100' src='../images/$user_image'></td>";
    echo "<td>{$role}</td>";
    //echo "<td>{$user_status}</td>";
    echo "<td><a data-toggle='tooltip' title='Make Admin' href='users.php?grant={$user_id}'><center><i class='fa fa-unlock'></i></center></a></td>";
    echo "<td><a data-toggle='tooltip' title='Revoke Admin' href='users.php?revoke={$user_id}'><center><i class='fa fa-lock'></i></center></a></td>";
    echo "<td><a data-toggle='tooltip' title='Delete User' href='users.php?delete={$user_id}'><center><i class='fa fa-trash'></i></center></a></td>";
    echo "</tr>";
  }
   ?>

</tbody>
</table>

<?php

if(isset($_GET['grant'])){
  $the_user_id = escape($_GET['grant']);
  $query = "UPDATE users SET role = 'admin' WHERE user_id = $the_user_id";
  $grant_user_query = mysqli_query($connection,$query);
  if(!$grant_user_query){
    die("brb".mysqli_error($connection));
  }
  header("Location: users.php");
}

if(isset($_GET['revoke'])){
  $the_user_id = escape($_GET['revoke']);
  $query = "UPDATE users SET role = 'subscriber' WHERE user_id = $the_user_id";
  $grant_user_query = mysqli_query($connection,$query);
  if(!$grant_user_query){
    die("brb".mysqli_error($connection));
  }
  header("Location: users.php");
}

if(isset($_GET['delete'])){
  if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'admin'){
  $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
  $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
  $delete_query = mysqli_query($connection,$query);
  header("Location: users.php");
}
}
}
?>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
