<?php


function redirect($location){
  return header("Location: ".$location);
  exit;
}

function ifItIsMethod($method = null){
  if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
    return true;
  }
  return false;
}

function checkLoggedInAndRedirect($redirectLocation=null){
  if(isLoggedIn()){
    redirect($redirectLocation);
  }
}

function isLoggedIn(){
  if(isset($_SESSION['role'])){
    return true;
  }
  return false;
}

function loggedInUserId(){
  global $connection;
  if(isLoggedIn()){
    $query = "SELECT * FROM users WHERE username ='" . $_SESSION['username'] ."'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_array($result);
    return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;
  }
  return false;
}

function userLikedThisPost($post_id = ''){
  global $connection;
  $query = "SELECT * FROM likes WHERE user_id=" .loggedInUserId()." AND post_id={$post_id}";
  $result = mysqli_query($connection, $query);
  return mysqli_num_rows($result) >= 1? true: false;

}

function getPostLikes($post_id){
  global $connection;
  $query = "SELECT * FROM likes WHERE post_id=$post_id";
  $result = mysqli_query($connection, $query);
  if(!$result){ die(mysqli_error($connection));}
  echo mysqli_num_rows($result);
}

// function query(){
//   global $connection;
//   return mysqli_query($connection, $query);
// }

function escape($string){
  global $connection;
  return mysqli_real_escape_string($connection, trim(strip_tags($string)));
}

function users_online(){
  global $connection;
  $session = session_id();
  $time = time();
  $time_out_in_seconds = 30;
  $time_out = $time - $time_out_in_seconds;

  $query = "SELECT * FROM users_online WHERE session = '$session' ";
  $send_query = mysqli_query($connection,$query);
  $count = mysqli_num_rows($send_query);

  if($count == NULL){
    mysqli_query($connection, "INSERT INTO users_online(session,time)VALUES('$session','$time')");
  } else{
    mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
  }
    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
    return $count_user = mysqli_num_rows($users_online_query);
}

function username_exists($username){
  global $connection;

  $query = "SELECT username FROM users WHERE username = '$username'";
  $result = mysqli_query($connection, $query);

  if(mysqli_num_rows($result) > 0){
    return true;
  }
  else{
    return false;
  }
}

function email_exists($email){
  global $connection;

  $query = "SELECT email FROM users WHERE email = '$email'";
  $result = mysqli_query($connection, $query);

  if(mysqli_num_rows($result) > 0){
    return true;
  }
  else{
    return false;
  }
}

function register_user($username, $email, $password){
  global $connection;

    $username = mysqli_real_escape_string($connection,$username);
    $email = mysqli_real_escape_string($connection,$email);
    $password = mysqli_real_escape_string($connection,$password);

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
    $query = "INSERT INTO users(username,email,password,role) ";
    $query .= "VALUES('{$username}','{$email}','{$password}','subscriber' ) ";

    $create_new_user = mysqli_query($connection,$query);
}

function login_user($username, $email){
  global $connection;
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = mysqli_real_escape_string($connection,$username);
  $password = mysqli_real_escape_string($connection,$password);

  $query = "SELECT * FROM users WHERE username = '{$username}' ";
  $select_user_query = mysqli_query($connection,$query);
  if(!$select_user_query){
    die("QUERY FAILED".mysqli_error($connection));
  }

  while($row = mysqli_fetch_array($select_user_query)){

    $db_user_id = $row['user_id'];
    $db_username = $row['username'];
    $db_password = $row['password'];
    $db_first_name = $row['first_name'];
    $db_last_name = $row['last_name'];
    $db_role = $row['role'];

  }

  if(password_verify($password,$db_password)){
    $_SESSION['username'] = $db_username;
    $_SESSION['first_name'] = $db_first_name;
    $_SESSION['last_name'] = $db_last_name;
    $_SESSION['role'] = $db_role;
    header("Location: ../index.php");
  }
  else {
    header("Location: ../index.php");
  }
}


?>
