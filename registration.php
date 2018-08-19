<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "admin/admin_functions.php"; ?>

<?php
$msg = "";
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $r_password = trim($_POST['r_password']);

  $error = [
    'username' => '',
    'email' => '',
    'password' => ''
];

if(username_exists($username)){
  $error['username'] = "Username already taken";
}

if(email_exists($email)){
  $error['email'] = "Account already exists with this email";
}

if(strlen($password) < 8){
  $error['password'] = "Password should at least contain 8 characters";
}

if($password != $r_password){
  $error['password'] = "Passwords do not match";
}

foreach($error as $key => $value) {
  if(empty($value)){
    unset($error[$key]);
    // login_user($username, $password);
  }

  if(empty($error)){
    register_user($username, $email, $password);
    $msg = "Your account was created successfully";
  }
}
}
?>

    <!-- Navigation -->

    <?php include "includes/navigation.php"; ?>


    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <center><h1>Sign Up</h1></center>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <center><h6><?php echo $msg; ?></h6></center>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control"
                            placeholder="Enter Desired Username" autocomplete="on"
                            value="<?php echo isset($username) ? $username: '' ?>" required>
                            <p><?php echo isset($error['username']) ? $error['username']: '' ?></p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                            placeholder="Enter Email" autocomplete="on"
                            value="<?php echo isset($email) ? $email: '' ?>" required>
                            <p><?php echo isset($error['email']) ? $error['email']: '' ?></p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                            <p><?php echo isset($error['password']) ? $error['password']: '' ?></p>
                        </div>
                        <div class="form-group">
                           <label for="r_password" class="sr-only">Password</label>
                           <input type="password" name="r_password" id="key" class="form-control" placeholder="Repeat Password" required>
                       </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Create Account">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
