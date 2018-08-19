<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "admin/admin_functions.php"; ?>

<?php
    echo loggedInUserId();

    if(userLikedThisPost(24)){
      echo "user liked";
    } else{
      echo "did not";
    }
