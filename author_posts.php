<?php session_start(); ?>
<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
    <!-- Navigation -->
  <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

              <?php

              if(isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];
                $the_post_author = $_GET['author'];
              }

              $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ORDER BY post_id DESC";
              $select_all_posts_query = mysqli_query($connection,$query);
              ?>

              <center><h2>All Posts By <?php echo $the_post_author; ?></h2></center>

              <?php
              while($row = mysqli_fetch_assoc($select_all_posts_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,200).'...';

              ?>

                <!--<h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>-->

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?> "><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time text-primary"></span><?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                  <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?> ">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php } ?>


            <!-- Blog Comments -->

            <?php
            if(isset($_POST['create_comment'])){

              $the_post_id = $_GET['p_id'];
              $comment_author = $_POST['comment_author'];
              $comment_content = $_POST['comment_content'];

              $query = "INSERT INTO comments ";
              $query .= "(comment_post_id, comment_author,
              comment_content, comment_status, comment_date) ";
              $query .= "VALUES($the_post_id,'{$comment_author}','{$comment_content}','approved',now())" ;

              $create_comment_query = mysqli_query($connection,$query);
              if(!$create_comment_query){
                die("Query Error".mysqli_error($connection));
              }

              // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
              // $query .= "WHERE post_id = $the_post_id";
              // $update_comment_count = mysqli_query($connection,$query);

            }
            ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
<?php include "includes/footer.php"; ?>
