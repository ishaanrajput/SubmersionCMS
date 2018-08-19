<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<?php
if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $r_password = $_POST['r_password'];

  $username = mysqli_real_escape_string($connection,$username);
  $email = mysqli_real_escape_string($connection,$email);
  $password = mysqli_real_escape_string($connection,$password);
  $r_password = mysqli_real_escape_string($connection,$r_password);

  if(!empty($username) && !empty($email) && !empty($password)){
  if($password == $r_password){
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
    $query = "INSERT INTO users(username,email,password,role) ";
    $query .= "VALUES('{$username}','{$email}','{$password}','subscriber' ) ";

    $create_new_user = mysqli_query($connection,$query);

    $msg = "Your account has been created successfully";

  }
  else{
    $msg = "Passwords do not match.";
  }
} else {
    $msg = "No field can be left blank.";
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
                <center><h1>Contact</h1></center>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6><?php echo $msg; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
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
