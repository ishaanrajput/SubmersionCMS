<?php include "admin_functions.php"; ?>
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
  $query = "SELECT * FROM comments WHERE comment_author = '{$_SESSION['username']}' ORDER BY comment_id DESC";
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
    echo "<td><a data-toggle='tooltip' title='Approve Comment' href='comments.php?approve={$comment_id}'><center><i class='fa fa-check'></i></center></a></td>";
    echo "<td><a data-toggle='tooltip' title='Ban Comment' href='comments.php?ban={$comment_id}'><center><i class='fa fa-ban'></i></center></a></td>";
    echo "<td><a data-toggle='tooltip' title='Delete Comment' href='comments.php?delete={$comment_id}'><center><i class='fa fa-trash'></i></center></a></td>";
    echo "</tr>";

}


   ?>

</tbody>
</table>

<?php

if(isset($_GET['approve'])){
  $the_comment_id = escape($_GET['approve']);
  $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
  $approve_comment_query = mysqli_query($connection,$query);
  if(!$approve_comment_query){
    die("brb".mysqli_error($connection));
  }
  header("Location: comments.php?source=my_comments");
}

if(isset($_GET['ban'])){
  $the_comment_id = escape($_GET['ban']);
  $query = "UPDATE comments SET comment_status = 'banned' WHERE comment_id = $the_comment_id";
  $ban_comment_query = mysqli_query($connection,$query);
  if(!$ban_comment_query){
    die("whbrb".mysqli_error($connection));
  }
  header("Location: comments.php?source=my_comments");
}

if(isset($_GET['delete'])){
  $the_comment_id = escape($_GET['delete']);
  $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
  $delete_query = mysqli_query($connection,$query);
  header("Location: comments.php?source=my_comments");
}
?>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
