<?php
session_start();
if(!isset($_SESSION["flag"]))
{
    header("Location:../index.html");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    SIIC 
  </title>
 
   
    
 <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
     <!-- Main css -->
  <link rel="stylesheet" href="css/style.css">
    
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="https://www.srmiic.com/" class="simple-text logo-mini">
         <i class="now-ui-icons business_bulb-63"></i>
          </a>
        <a href="https://www.srmiic.com/" class="simple-text logo-normal">INCUBATION CENTER
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="active ">
            <a href="admin.php">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li>
            <a href="notification.php">
              <i class="now-ui-icons ui-1_send"></i>
              <p>Notifications</p>
            </a>
          </li>
          <li>
            <a href="user.php">
              <i class="now-ui-icons users_single-02"></i>
              <p>User Profile</p>
            </a>
          </li>

<li>
            <a href="table_student.php">
              <i class="now-ui-icons business_badge"></i>
              <p>Registered User</p>
            </a>
          </li>

          <li>
            <a href="#">
              <i class="now-ui-icons files_single-copy-04"></i>
              <p>Quiz</p>
            </a>
          </li>
          <li class="active-pro">
            <a href="logout.php">
              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
              <p>Sign Out</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>            <a class="navbar-brand" href="#pablo">Announcements</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
           </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header">
        <div class="header text-center">
        </div>
      </div>
         <div class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                
              </div>
              <div class="card-body">
           <div class="notification">
                        <h3 class="form-title">Announcement</h3>
                        <form  action="notif.php" method="POST" class="register-form" id="register-form">
                            <div class="form-group">

                                <input type="text" name="Subject"  placeholder="Subject"/>
                            </div>
                            <div class="form-group">

                                <input type="text" name="message"  placeholder="Message Description"/>
                            </div>

                            <div class="form-group"> </div>
                            <div class="form-group form-button">
                                <input type="submit" name="send" id="send" class="form-submit" value="Send"/>
                            </div>
                        </form>
                  </div>
                </div>
              </div>
            </div>
             </div>
        </div>
<!--
      <div class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Notifications</h4>
              </div>
              <div class="card-body">

                <div class="alert alert-info alert-with-icon" data-notify="container">
                  <button type="button" aria-hidden="true" class="close">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                  </button>
                  <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                  <span data-notify="message">Welcome to SIIC and Thank You to Join us. Welcome to the World Of Innovation.</span>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
-->
      <footer class="footer">
        <div class="container-fluid">
        <hr>
          <div class="copyright" id="copyright">
            &copy;
            <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by
            <a href="#" target="_blank">Utkarsh Shukla</a>. Coded by
            <a href="#" target="_blank">Yash Narag</a>.
              <p text-align=left >Supported By SRMIST</p>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
</body>

</html>