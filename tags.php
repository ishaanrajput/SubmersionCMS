<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php session_start(); ?>

<?php include "includes/navigation.php"; ?>

<?php
$query = "SELECT post_tags FROM posts";
$select_all_tags_query = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_all_tags_query)){
    $post_tags = $row['post_tags'];

    echo "<center><h2><a href=''>$post_tags</a></h2></center>";
}
?>

<?php include "includes/footer.php"; ?>
