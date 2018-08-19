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

                        <?php
                        if(isset($_GET['source'])){
                          $source = escape($_GET['source']);
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

                          default:
                          include "includes/view_all_comments.php";
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
<?php include "includes/sub_footer.php"; ?>
