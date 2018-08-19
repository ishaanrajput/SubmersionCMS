<?php
include_once "sub_functions.php";
if(isset($_POST['create_post'])){

  $post_title = escape($_POST['title']);
  $post_author = $_SESSION['username'];
  $post_category_id = escape($_POST['post_category_id']);
  $post_status = 'approved';

  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];

  $post_tags = escape($_POST['post_tags']);
  $post_content = escape($_POST['post_content']);
  $post_date = date('d-m-y');


  move_uploaded_file($post_image_temp, "../images/$post_image");

  $query = "INSERT INTO posts(post_category_id,post_title,post_author,
  post_date,post_image,post_content,post_tags,post_status) ";
  $query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}',
  now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' ) ";

  $create_post_query = mysqli_query($connection,$query);
}
?>

<div class="col-xs-12">

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Post Title</label>
    <input class="form-control" type="text" name="title">
  </div>
</div>

  <div class="col-xs-3">
  <div class="form-group">
    <label for="post_category_id">Post Category</label><br>
    <!--<input class="form-control" type="text" name="post_category_id">-->
    <div class="custom-select">
    <select class="form-control" name="post_category_id" id="post_category">

      <?php
      $query = "SELECT * FROM categories";
      $select_categories = mysqli_query($connection,$query);

      while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<option class='h' value='{$cat_id}'>{$cat_title}</option>";
      }
      ?>

    </select>
  </div>
  </div>
</div>

<div class="col-xs-12">

  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input class="form-group" type="file" name="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input class="form-control" type="text" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" type="text" name="post_content" id="body" cols="30" rows="7"></textarea>
  </div>



  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
  </div>
</form>

</div>
