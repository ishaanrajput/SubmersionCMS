
<?php
if(isset($_POST['checkBoxArray'])){

  foreach($_POST['checkBoxArray'] as $postValueId) {
    $bulk_options = escape($_POST['bulk_options']);

    switch($bulk_options){
      case 'approved':
      $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}' ";
      $update_status = mysqli_query($connection, $query);
      break;

      case 'banned':
      $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}' ";
      $update_status = mysqli_query($connection, $query);
      break;

      case 'delete':
      $query = "DELETE FROM posts WHERE post_id = '{$postValueId}' ";
      $delete_status = mysqli_query($connection, $query);
      break;
      default:

      break;
    }

  }
}
?>

<form action="" method='post'>
<table class="table table-bordered table-hover">
  <div id="bulkOptionsContainer" class="col-xs-4">
    <select class="form-control" name="bulk_options" id="">
      <option value="">Bulk Options</option>
      <option value="approved">Approve</option>
      <option value="banned">Ban</option>
      <option value="delete">Delete</option>
    </select>
   </div>
   <div class="col-xs-4">
     <input type="submit" name="submit" class="btn btn-success" value="Apply">
     <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
   </div>
  <thead>

    <tr>
      <th><input id="selectAllBoxes" type="checkbox"></th>
      <th>Author</th>
      <th>Date</th>
      <th>Title</th>
      <th>Likes</th>
      <th>Views</th>
      <th>Category</th>
      <th>Image</th>
      <th>Tags</th>
      <th>Comments</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>

  <?php
  $query = "SELECT * FROM posts WHERE post_author = '{$_SESSION['username']}' ORDER BY post_id DESC";
  $select_posts = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_posts)){
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_status = $row['post_status'];
    $post_category_id = $row['post_category_id'];
    $post_comment_count = $row['post_comment_count'];
    $post_views = $row['post_views'];
    $likes = $row['likes'];

    //echo "<br>";
    echo "<tr>";
    ?>

<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

    <?php
    echo "<td>{$post_author}</td>";
    echo "<td>{$post_date}</td>";
    echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
    echo "<td>{$likes}</td>";
    echo "<td>{$post_views}</td>";

    $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
    $select_categories_id = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_categories_id)){
      $cat_id = escape($row['cat_id']);
      $cat_title = escape($row['cat_title']);

    echo "<td>{$cat_title}</td>";

}


    echo "<td><img width='100' src='../images/$post_image'></td>";
    echo "<td>{$post_tags}</td>";

    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
    $send_comment_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($send_comment_query);
    $comment_id = escape($row['comment_id']);

    $count_comments = mysqli_num_rows($send_comment_query);
    echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";


    echo "<td>{$post_status}</td>";
    echo "<td><a href='posts.php?approve={$post_id}'><center><i class='fa fa-check'></i></center></a></td>";
    echo "<td><a href='posts.php?ban={$post_id}'><center><i class='fa fa-ban'></i></center></a></td>";
    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'><center><i class='fa fa-edit'></i></center></a></td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='posts.php?delete={$post_id}'><center><i class='fa fa-trash'></i></center></a></td>";
    echo "</tr>";
  }
   ?>

</tbody>
</table>
</form>
<?php

if(isset($_GET['approve'])){
  $the_post_id = escape($_GET['approve']);
  $query = "UPDATE posts SET post_status = 'approved' WHERE post_id = $the_post_id";
  $approve_post_query = mysqli_query($connection,$query);
  if(!$approve_post_query){
    die("brb".mysqli_error($connection));
  }
  header("Location: posts.php");
}

if(isset($_GET['ban'])){
  $the_post_id = escape($_GET['ban']);
  $query = "UPDATE posts SET post_status = 'banned' WHERE post_id = $the_post_id";
  $ban_post_query = mysqli_query($connection,$query);
  if(!$ban_post_query){
    die("whbrb".mysqli_error($connection));
  }
  header("Location: posts.php");
}

if(isset($_GET['delete'])){
  $the_post_id = $_GET['delete'];
  $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
  $delete_query = mysqli_query($connection,$query);
  header("Location: posts.php");
}
?>
