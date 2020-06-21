<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

  <?php include "includes/admin_sidebar.php"; ?>

  <div id="content-wrapper">
    <div class="container-fluid">
    <h1>Welcome to Admin Page <span class="text-success"><?php echo $_SESSION['userrole'] ?></span></h1>
    <hr>
            <div class="row">



            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="far fa-clipboard"></i>
                  </div>
                  <!-- post count number -->
                    <?php
                    $sql_post="SELECT * FROM posts";
                    $sql_post_result=mysqli_query($conn, $sql_post);
                    $count_posts=mysqli_num_rows($sql_post_result);             
                    ?>
                    <div>Total Post: <?php echo $count_posts;  ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="posts.php">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>



            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="far fa-comment"></i>
                  </div>
                    <!-- comment count nunmber -->
                  <?php
                    $sql_comment="SELECT * FROM comments";
                    $sql_comment_result=mysqli_query($conn, $sql_comment);
                    $count_comments=mysqli_num_rows($sql_comment_result);             
                    ?>
                    <div>Total Comment: <?php echo $count_comments;  ?></div>                 
                </div>
                <a class="card-footer text-white clearfix small z-1" href="comments.php">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>


  
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-list-ul"></i>
                  </div>
                    <!-- category count nunmber -->
                    <?php
                    $sql_category="SELECT * FROM categories";
                    $sql_category_result=mysqli_query($conn, $sql_category);
                    $count_category=mysqli_num_rows($sql_category_result);             
                    ?>
                    <div>Total Category: <?php echo $count_category;  ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="categories.php">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="far fa-file-image"></i>
                  </div>

                    <!-- category count nunmber -->
                    <?php
                    $sql_portfolio="SELECT * FROM portfolios";
                    $sql_portfolio_result=mysqli_query($conn, $sql_portfolio);
                    $count_portfolio=mysqli_num_rows($sql_portfolio_result);             
                    ?>
                    <div>Total Portfolios: <?php echo $count_portfolio;  ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="portfolio.php">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>



          <!-- start of chart -->
          <div class="col-12 d-flex">

          <!-- pie chart -->
          <?php     $sql_approved="SELECT * FROM comments WHERE comment_status='approved'";
                    $sql_approved_result=mysqli_query($conn, $sql_approved);
                    $count_approved=mysqli_num_rows($sql_approved_result);    ?>

          <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['A', 'B'],
                ['Approved (<?php echo $count_approved; ?>)',  <?php echo $count_approved; ?>],
                ['Unapproved (<?php echo ($count_comments-$count_approved); ?>)',  <?php echo ($count_comments-$count_approved); ?>],
              ]);
              var options = {
                title: 'Approved and Unapproved Comments'
              };
              var chart = new google.visualization.PieChart(document.getElementById('piechart'));
              chart.draw(data, options);
            }
          </script>
    <div class="col-6">
    <div id="piechart"></div>
    </div>


    <!-- column chart -->

    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Items','Numbers'],
          ['Post', <?php echo $count_posts; ?>],
          ['Comment',  <?php echo $count_comments; ?>],
          ['Category',  <?php echo $count_category; ?>],
          ['Portfolio',  <?php echo $count_portfolio; ?>]
        ]);

        var options = {
          chart: {
            title: 'Number of İtems',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div class="col-6">
    <div id="columnchart_material"></div>

    </div>

        
          </div> 
<!-- en of charts -->

      <?php include "includes/admin_footer.php"; ?>