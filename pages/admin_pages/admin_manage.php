<?php
  include "../../lib/admin_request_handler.php";

  // Logout Function
  if (isset($_POST["logout"])) {
    $_SESSION['loggedin'] = false;
    header('Location: ../admin_pages/admin_signin.php');
  }

  // Validate Admin Login.
  if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) || !$_SESSION['admin']) {
    $_SESSION['loggedin'] = false;
    header('Location: ../admin_pages/admin_signin.php');
  }

  // Handle Request Approval.
  if (isset($_POST["approve"])) {
    handleRequestApproval($db);
  }

  // Handle Request Rejection.
  if (isset($_POST["reject"])) {
    echo "Hello";
    removeRequest($db, "Account Request Rejected");
  }

?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../../styles/admin_styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <title>Admin User Manage</title>
  </head>
    <body class="sb-nav-fixed">
      <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
          <!-- Navbar Brand-->
          <a class="navbar-brand ps-3" href="index.html">BLEM Admin Panel</a>
          <!-- Sidebar Toggle-->
          <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
          <!-- Navbar Search-->
          <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="" method="post">
            <button name="logout" class="btn btn-primary form-inline my-2 my-lg-0">
              Logout
            </button>
          </form>
      </nav>
      <div id="layoutSidenav">
          <div id="layoutSidenav_nav">
              <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                  <div class="sb-sidenav-menu">
                      <div class="nav">
                          <div class="sb-sidenav-menu-heading">Core</div>
                          <a class="nav-link" href="admin_homepage.php">
                              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                              Dashboard
                          </a>
                          <div class="sb-sidenav-menu-heading">Admin Functions</div>
                          <a class="nav-link" href="account_requests.php">
                              <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                              Account Requests
                          </a>
                          <a class="nav-link" href="admin_manage.php">
                              <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                              Manage Users
                          </a>
                      </div>
                  </div>
                  <div class="sb-sidenav-footer">
                      <div class="small">Logged in as:</div>
                      BLEM Admin
                  </div>
              </nav>
          </div>
          <div id="layoutSidenav_content">
              <main>
                  <div class="container-fluid px-4">
                      <?php
                        if(isset($_SESSION['message']) && $_SESSION['message'] != "") {
                          if(isset($_SESSION['request_error']) && $_SESSION['request_error'] == FALSE){
                            $message_status = "info";
                          }
                          else{
                            $message_status = "danger";
                            $_SESSION['request_error'] = FALSE;
                          }
                          echo "<div class='alert alert-".$message_status." alert-dismissible fade show' role='alert' style='text-align:center'>".$_SESSION['message']."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                          $_SESSION['message'] = '';
                        }
                      ?>
                      <h1 class="mt-4">Overview</h1>
                      <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item active">All Users</li>
                      </ol>
                      <div class="card mb-4">
                          <div class="card-header">
                              <i class="fas fa-table me-1"></i>
                              All Users
                          </div>
                          <div class="card-body">

                            <!-- TODO: ADD STYLES -->

                          </div>
                      </div>
                  </div>
              </main>
              <footer class="py-4 bg-light mt-auto">
                  <div class="container-fluid px-4">
                      <div class="d-flex align-items-center justify-content-between small">
                          <div class="text-muted">Copyright &copy; BLEM Banking 2022</div>
                          <div>
                              <a href="#">Privacy Policy</a>
                              &middot;
                              <a href="#">Terms &amp; Conditions</a>
                          </div>
                      </div>
                  </div>
              </footer>
          </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
      <script src="../../js/admin_dashboard.js"></script>
  </body>
</html>