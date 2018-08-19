<div class="col-md-4">

    <!-- Blog Search Well -->
    <br>
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit"class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
      </form>
        <!-- /.input-group -->
    </div>


        <div class="well">
          <?php
            if(!isset($_SESSION['username'])){
            echo "<h4>Login</h4>";
            echo "<form action='includes/login.php' method='post'>";
            echo "<div class='form-group'>";
            echo "    <input name='username' type='text' placeholder='Enter Username' class='form-control' required>";
            echo "</div>";
            echo "<div class='input-group'>";
            echo "    <input name='password' type='password' placeholder='Enter Password' class='form-control' required>";
            echo "    <span class='input-group-btn'>";
            echo "      <button class='btn btn-primary' name='login' type='submit'>Login</button>";
            echo "    </span>";
            echo "</div>";
            echo "</form>";
            }
            else if(isset($_SESSION['username'])){
              ?>
              <h4>Welcome <?php echo $_SESSION['username']; ?></h4>
              <?php
              if($_SESSION['role'] == 'admin'){
              echo "<a class='btn btn-primary' href='admin/posts.php?source=my_posts'>View My Posts</a>";
              echo "&ensp;";
              echo "<a class='btn btn-primary' href='admin/index.php'>View My Profile</a>";
            } else {
              echo "<a class='btn btn-primary' href='subscriber/posts.php'>View My Posts</a>";
              echo "&ensp;";
              echo "<a class='btn btn-primary' href='subscriber/sub_index.php'>View My Profile</a>";
            }
            } ?>
        </div>

<?php
    $query = "SELECT * FROM categories LIMIT 4";
    $select_categories_sidebar = mysqli_query($connection,$query);

?>
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                      <?php
                      while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                      }
                      ?>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
  <!-- <?php include "widget.php"; ?> -->

</div>
