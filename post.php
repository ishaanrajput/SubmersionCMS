<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php session_start(); ?>
<?php include "admin/admin_functions.php" ?>
    <!-- Navigation -->
  <?php include "includes/navigation.php"; ?>

<?php
if(isset($_POST['liked'])){
  $post_id = $_POST['post_id'];
  $user_id = $_POST['user_id'];

  $query = "SELECT * FROM posts WHERE post_id = $post_id";
  $postResult = mysqli_query($connection, $query);
  $post = mysqli_fetch_array($postResult);
  $likes = $post['likes'];

  mysqli_query($connection, "UPDATE posts SET likes = $likes+1 WHERE post_id = $post_id");

  mysqli_query($connection,"INSERT INTO likes(user_id, post_id) VALUES($user_id,$post_id)");
  exit();
}

if(isset($_POST['unliked'])){
  $post_id = $_POST['post_id'];
  $user_id = $_POST['user_id'];

  $query = "SELECT * FROM posts WHERE post_id = $post_id";
  $postResult = mysqli_query($connection, $query);
  $post = mysqli_fetch_array($postResult);
  $likes = $post['likes'];

  mysqli_query($connection, "DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id");
  mysqli_query($connection, "UPDATE posts SET likes = $likes-1 WHERE post_id = $post_id");
  exit();
}
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

              <?php

              if(isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];

              $view_query = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = $the_post_id";
              $send_query = mysqli_query($connection,$view_query);

              $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
              $select_all_posts_query = mysqli_query($connection,$query);

              while($row = mysqli_fetch_assoc($select_all_posts_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_tags = $row['post_tags'];

              ?>

                <!--<h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>-->

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?> " style="text-decoration: none;"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>" style="text-decoration: none;"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time text-primary"></span><?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <div>



                <?php getPostLikes($the_post_id); ?> Likes

                <?php if(isLoggedIn()) { ?>
                &emsp;<a class="like" href="#" style="text-decoration: none;"><span class="glyphicon glyphicon-thumbs-up"></span> Like</a>
                &ensp; <a class="unlike" href="#" style="text-decoration: none;"><span class="glyphicon glyphicon-thumbs-down"></span> Unlike</a><br>
                <br>
              <?php } ?>

                </div>
                <p><?php echo $post_content; ?></p>
                <br>
                <p>Tags: <?php echo $post_tags; ?></p>

                <hr>
            <?php }
          } else{
            header("Location: index.php");
          }
            ?>


            <!-- Blog Comments -->

            <?php
            if(isset($_POST['create_comment'])){

              $the_post_id = $_GET['p_id'];
              $comment_author = $_SESSION['username'];
              $comment_content = escape($_POST['comment_content']);

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

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">

                    <!-- <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" name="comment_author" required>
                    </div> -->

                    <div class="form-group">
                      <label for="comment">Comment</label>
                        <textarea class="form-control" rows="3" name="comment_content"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php
            $the_post_id = $_GET['p_id'];
            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
            $query .= "AND comment_status = 'approved' ";
            //$query .= "ORDER BY comment_id DESC ";
            $show_all_comments = mysqli_query($connection,$query);
            if(!$show_all_comments){
              die("no".mysqli_error($connection));
            }

            while($row = mysqli_fetch_assoc($show_all_comments)){
              $comment_author = $row['comment_author'];
              $comment_content = $row['comment_content'];
              $comment_date = $row['comment_date'];

              $query2 = "SELECT user_image FROM users WHERE username = '{$comment_author}' ";
              $show_all_user_images = mysqli_query($connection,$query2);

              while($ig = mysqli_fetch_assoc($show_all_user_images)){
                $user_image = $ig['user_image'];

            ?>

            <!-- Comment -->
            <div class="media">

                <a class="pull-left" href="#">
                    <img class="media-object" width="80" src="/cms/images/<?php echo $user_image; ?>">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small><?php echo $comment_date; ?></small>
                    </h4>
                    <?php echo $comment_content; ?>
                </div>
            </div>

          <?php }} ?>


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

  <script>

  $(document).ready(function(){
    var post_id = <?php echo $the_post_id; ?>;
    var user_id = <?php echo loggedInUserId(); ?>;

    //LIKES
    $('.like').click(function(){
      $.ajax({
        url:"/cms/post.php?p_id=<?php echo $the_post_id; ?>",
        type: 'post',
        data: {
          'liked': 1,
          'post_id': post_id,
          'user_id': user_id
        }
      });
    });

    //UNLIKE
    $('.unlike').click(function(){
      $.ajax({
        url:"/cms/post.php?p_id=<?php echo $the_post_id; ?>",
        type: 'post',
        data: {
          'unliked': 1,
          'post_id': post_id,
          'user_id': user_id
        }
      });
    });
  });

  </script>
