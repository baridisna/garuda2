<?php
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

  $query = "SELECT pertanyaan, dimensi FROM pertanyaan";
    //storing the result of the executed query
    $result = $link->query($query);
    if (!$result) {
      die ('SQL Error: ' . mysqli_error($link));
    }
 ?>
?>

<!DOCTYPE html>
<html lang="en">
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
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link href="assets/css/survei.css" rel="stylesheet">
    <style type="text/css">
      .likertsurvey li {
  display:inline-block;
  width:15%;
  text-align:center;
  vertical-align: top;
}
    </style>
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
                    <li>
                      <a href="index.php?logout='1"><i class="fa fa-sign-out pull-right"></i> Log Out <?php echo $_SESSION['username']; ?></a>

                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <form action="form.php" method="post">


        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Form Elements</h3>
              </div>
                    <?php
                      while ($row = mysqli_fetch_array($result))
                      {
                        echo ('<div class="x_panel">
                                <div class="x_title">
                                  '.$row['pertanyaan'].'</div>
                                  <ul class="likertsurvey">
                                    <li>
                                        <label class="pilihan likertsurvey">
                                          <input type="radio" name="'.$row['dimensi'].'" value="1">
                                          <img src="./images/sangat_tidak_setuju.png">
                                        </label><br>
                                        <label>Sangat Tidak Setuju</label>
                                    </li>

                                    <li>
                                        <label class="pilihan likertsurvey">
                                          <input type="radio" name="'.$row['dimensi'].'" value="2">
                                          <img src="./images/tidak_setuju.png">
                                        </label><br>
                                        <label>Tidak Setuju</label>
                                    </li>
                                    <li>
                                        <label class="pilihan">
                                          <input type="radio" name="'.$row['dimensi'].'" value="3">
                                          <img src="./images/agak_tidak_setuju.png">
                                        </label><br>
                                        <label>Agak Tidak Setuju</label>
                                    </li>

                                    <li>
                                        <label class="pilihan">
                                          <input type="radio" name="'.$row['dimensi'].'" value="4">
                                          <img src="./images/agak_setuju.png">
                                        </label><br>
                                        <label>Agak Setuju</label>
                                    </li>

                                    <li>
                                        <label class="pilihan">
                                          <input type="radio" name="'.$row['dimensi'].'" value="5">
                                          <img src="./images/setuju.png">
                                        </label><br>
                                       <label>Setuju</label>
                                    </li>

                                    <li>
                                        <label class="pilihan">
                                          <input type="radio" name="'.$row['dimensi'].'" value="6">
                                          <img src="./images/sangat_setuju.png">
                                        </label><br>
                                        <label>Sangat Setuju</label>
                                    </li></ul></div>');
                                 }
                               ?>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-1 col-sm-1 col-xs-1"></div>
              <div class="col-md-10 col-sm-10 col-xs-10">

              </div>
              <div class="col-md-1"> </div>
            </div>
            <!--bisa disumbit-->
                    <div class="col-md-4">
                        <div class="buttons">
                          <button class="clear">Clear</button>
                          <button name="submit" class="submit">Submit</button>
                    			<div class="popup" onclick="myFunction()">Click me!
                      				<span class="popuptext" id="myPopup">Popup text...</span>
                          </div>
                        </div>
                      </div>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-1 col-sm-1 col-xs-1"></div>
            </div>

          </div>
        </div>
            </form>
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
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

  </body>
</html>
