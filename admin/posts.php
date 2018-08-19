<?php include "includes/admin_header.php"; ?>
<?php include "admin_functions.php"; ?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Welcome admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                        <?php
                        if(isset($_GET['source'])){
                          $source = $_GET['source'];
                        } else {
                          $source = "";
                        }

                        switch($source){
                          case 'add_post':
                          include "post_manipulation/add_post.php";
                          break;

                          case 'edit_post':
                          include "post_manipulation/edit_post.php";
                          break;

                          case 'my_posts':
                          include "includes/view_my_posts.php";
                          break;

                          default:
                          include "includes/view_all_posts.php";
                          break;
                        }
                        ?>

                          </tbody>
                        </table>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"; ?>
