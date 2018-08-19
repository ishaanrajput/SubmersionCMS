<?php include "includes/admin_header.php"; ?>

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

                          case 'my_comments':
                          include "includes/view_my_comments.php";
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
<?php include "includes/admin_footer.php"; ?>
