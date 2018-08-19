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


                                  <!-- /.row -->

                  <div class="row">
                      <div class="col-lg-4 col-md-6">
                          <div class="panel panel-primary">
                              <div class="panel-heading">
                                  <div class="row">
                                      <div class="col-xs-3">
                                          <i class="fa fa-file-text fa-5x"></i>
                                      </div>
                                      <div class="col-xs-9 text-right">

                                      <?php
                                      $query = "SELECT * FROM posts WHERE post_author = '{$_SESSION['username']}'";
                                      $select_all_post = mysqli_query($connection,$query);
                                      $post_counts = mysqli_num_rows($select_all_post);
                                      echo "<div class='huge'>{$post_counts}</div>";
                                      ?>

                                          <div>Posts</div>
                                      </div>
                                  </div>
                              </div>
                              <a href="posts.php">
                                  <div class="panel-footer">
                                      <span class="pull-left">View Details</span>
                                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                      <div class="clearfix"></div>
                                  </div>
                              </a>
                          </div>
                      </div>
                      <div class="col-lg-4 col-md-6">
                          <div class="panel panel-green">
                              <div class="panel-heading">
                                  <div class="row">
                                      <div class="col-xs-3">
                                          <i class="fa fa-comments fa-5x"></i>
                                      </div>
                                      <div class="col-xs-9 text-right">

                                        <?php
                                        $query = "SELECT * FROM comments WHERE comment_author = '{$_SESSION['username']}'";
                                        $select_all_comment = mysqli_query($connection,$query);
                                        $comment_counts = mysqli_num_rows($select_all_comment);
                                        echo "<div class='huge'>{$comment_counts}</div>";
                                        ?>

                                        <div>Comments</div>
                                      </div>
                                  </div>
                              </div>
                              <a href="comments.php">
                                  <div class="panel-footer">
                                      <span class="pull-left">View Details</span>
                                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                      <div class="clearfix"></div>
                                  </div>
                              </a>
                          </div>
                      </div>

                  </div>
                                  <!-- /.row -->


<?php

$query = "SELECT * FROM posts WHERE post_status = 'banned' ";
$select_all_pos = mysqli_query($connection,$query);
$p_ban_counts = mysqli_num_rows($select_all_pos);

$query = "SELECT * FROM comments WHERE comment_status = 'banned' ";
$select_all_com = mysqli_query($connection,$query);
$c_ban_counts = mysqli_num_rows($select_all_com);
?>

                    <div class="row">
                      <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['CMS Data', 'Count'],

<?php
$element_text = ['Active Posts', 'Banned Posts', 'Comments', 'Banned Comments'];
$element_count = [$post_counts, $p_ban_counts, $comment_counts, $c_ban_counts];

for($i=0; $i<4; $i++){
  echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
}
?>

        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


                    </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"; ?>
