<?php include "includes/sub_header.php"; ?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/sub_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Welcome
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>


<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Post Id</th>
      <th>Author</th>
      <th>Date</th>
      <th>Content</th>
      <th>In Response To</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>

  <?php
  $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection,$_GET['id']). " ";
  $select_comments = mysqli_query($connection, $query);

  if(!$select_comments){
    die("ERROR");
  }

  while($row = mysqli_fetch_assoc($select_comments)){
    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_author = $row['comment_author'];
    $comment_content = $row['comment_content'];
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];

    echo "<tr>";
    echo "<td>{$comment_id}</td>";
    echo "<td>{$comment_post_id}</td>";
    echo "<td>{$comment_author}</td>";
    echo "<td>{$comment_date}</td>";
    echo "<td>{$comment_content}</td>";

    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
    $select_post_id_query = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_post_id_query)){
      $post_id = $row['post_id'];
      $post_title = $row['post_title'];
      echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
    }

    echo "<td>{$comment_status}</td>";
    echo "<td><a href='post_comments.php?approve=$comment_id&id=".$_GET['id']."'><center><i class='fa fa-check'></i></center></a></td>";
    echo "<td><a href='post_comments.php?ban=$comment_id&id=".$_GET['id']."'><center><i class='fa fa-ban'></i></center></a></td>";
    echo "<td><a href='post_comments.php?delete=$comment_id&id=".$_GET['id']."'><center><i class='fa fa-trash'></i></center></a></td>";
    echo "</tr>";

}


   ?>

</tbody>
</table>

<?php

if(isset($_GET['approve'])){
  $the_comment_id = $_GET['approve'];
  $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
  $approve_comment_query = mysqli_query($connection,$query);
  if(!$approve_comment_query){
    die("brb".mysqli_error($connection));
  }
  header("Location: post_comments.php?id=".$_GET['id']."");
}

if(isset($_GET['ban'])){
  $the_comment_id = $_GET['ban'];
  $query = "UPDATE comments SET comment_status = 'banned' WHERE comment_id = $the_comment_id";
  $ban_comment_query = mysqli_query($connection,$query);
  if(!$ban_comment_query){
    die("whbrb".mysqli_error($connection));
  }
  header("Location: post_comments.php?id=".$_GET['id']."");
}

if(isset($_GET['delete'])){
  $the_comment_id = $_GET['delete'];
  $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
  $delete_query = mysqli_query($connection,$query);
  header("Location: post_comments.php?id=".$_GET['id']."");
}
?>

</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include "includes/sub_footer.php"; ?>
