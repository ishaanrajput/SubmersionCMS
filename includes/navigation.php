<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">My Blog</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php
                $query = "SELECT * FROM categories LIMIT 7";
                $select_all_categories = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($select_all_categories)){
                  $cat_title = $row['cat_title'];
                  $cat_id = $row['cat_id'];
                  echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";

                }

                ?>

                </ul>
                <ul class="nav navbar-nav navbar-right">

                  <?php
                  if(isset($_SESSION['username'])){
                    if($_SESSION['role']=='admin'){
                      echo "<li><a href='admin'><span class='glyphicon glyphicon-log-in'></span> Admin</a></li>";
                      echo '<li><a href="includes/logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>';
                    }
                    else if($_SESSION['role']=='subscriber'){
                      echo "<li><a href='subscriber/sub_index.php'><span class='glyphicon glyphicon-log-in'></span> Profile</a></li>";
                      echo '<li><a href="includes/logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>';
                    }
                  } else{
                    echo '<li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>';
                    echo '<li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
                  }
                  ?>


                </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
