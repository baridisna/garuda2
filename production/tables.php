  <?php
    //make coonection to Database
    include 'generate.php';

  session_start();

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
    //the SQL query to be executed
    $query1 = "SELECT tipe, percentage FROM averagedatavertical ORDER BY percentage DESC LIMIT 3";
    //storing the result of the executed query
    $result1 = $link->query($query1);
    if (!$result1) {
      die ('SQL Error: ' . mysqli_error($link));
    }
    //initialize the array to store the processed data
    
    $query2 ="SELECT tipe, percentage FROM averagedatavertical ORDER BY percentage ASC LIMIT 3";

    $result2 = $link->query($query2);
    if (!$result2) {
      die ('SQL Error: ' . mysqli_error($link));
    }
  ?>


<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- css untuk table top 3 dan bottom 3 -->
    <link href="../build/css/topbot3.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Survey Garuda</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['username']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
              <br/>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-edit"></i> Survey <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.php">Isi Questionaire</a></li>
                      <li><a href="form_upload.php">Form Upload</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Dashboard <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.php">Chart</a></li>
                      <li><a href="tables.php">Top 3 and Bottom 3</a></li>
                    </ul>
                  </li>
                  <li><a href="edit_form.php"><i class="fa fa-bar-chart-o"></i> Edit Form <span class="fa"></span></a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt=""><?php echo $_SESSION['username']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="index.php?logout='1"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <h1><b> Table TOP 3 </b></h1>
            <table class="data-table">
              <caption class="title">Top3 Aspek</caption>
              <thead>
                <tr>
                  <th>NO</th>
                  <th>TIPE</th>
                  <th>PERCENTAGE</th>
               </tr>
              </thead>
              <tbody>
  
                <?php
                  $no   = 1;
                  $total  = 0;
                  while ($row = mysqli_fetch_array($result1))
                {
                    echo '<tr>
                    <td>'.$no.'</td>
                    <td>'.$row['tipe'].'</td>
                    <td>'.$row['percentage'].'</td>
                    </tr>';
                    $no++;
                  } ?>
              </tbody>
            </table>

            <br/><br/>

            <h1><b>Table BOTTOM 3</b></h1>
            <table class="data-table">
              <caption class="title">Bottom3 Aspek</caption>
              <thead>
                <tr>
                  <th>NO</th>
                  <th>TIPE</th>
                  <th>PERCENTAGE</th>
                </tr>
              </thead>
              <tbody>

                <?php
                  $no   = 1;
                  $total  = 0;
                while ($row = mysqli_fetch_array($result2))
                {
                  echo '<tr>
                      <td>'.$no.'</td>
                      <td>'.$row['tipe'].'</td>
                      <td>'.$row['percentage'].'</td>
                    </tr>';
                    $no++;
                } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>