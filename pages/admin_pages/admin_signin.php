<?php
  include "../../lib/admin_signin_confirm.php";
  
  // Register Form is Submitted
  if (isset($_POST["admin_signin"])) {
    handleAdminSignIn($db);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/styles.css" />


    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css"
    rel="stylesheet"
    />

    <!-- FontAwesome Icons -->
    <script
      src="https://kit.fontawesome.com/2727c3ff62.js"
      crossorigin="anonymous"
    ></script>

    <title>Login</title>
  </head>

  <body>
    <div class="signin-page">
      <section class="vh-200">
          <!-- Status Message -->
          <?php 
            if(isset($_SESSION['message']) && $_SESSION['message'] != "") {
              if(isset($_SESSION['regdone']) && $_SESSION['regdone'] == true){
                $message_status = "success";
                $_SESSION['regdone'] = false;
              }
              else{
                $message_status = "danger";
              }
              echo "<div class='alert alert-".$message_status." alert-dismissible show' role='alert' style='text-align:center'>".$_SESSION['message']."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
              $_SESSION['message'] = '';
            }
          ?>
          <div class="container py-5 h-100">
              <div class="row justify-content-center align-items-center h-100">
                  <div class="col-6 col-lg-12 col-xl-5">
                      <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                          <div class="card-body p-4 p-md-5">
                              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Staff Login</h3>
                              <form action="" method="post">

                                  <!-- Row #1 -->
                                  <div class="row">
                                    <div class="form-group">
                                        <input type="text" name="user" id="user" class="form-control form-control-lg" required/>
                                        <label class="form-label" for="user">Username</label>
                                    </div>
                                  </div>

                                  <!-- Row #2 -->
                                  <div class="row">
                                    <div class="form-group">
                                        <input type="password" name="password" id="pass" class="form-control form-control-lg" required/>
                                        <label class="form-label" for="pass">Password</label>
                                    </div>
                                  </div>

                                  <center>
                                  <button type="submit" class="btn btn-primary btn-lg" name="admin_signin">
                                  Login
                                  </button>
                                  <a href="../../index.php" class="btn btn-dark btn-lg" role="button" aria-pressed="true">Return Home</a>
                                  </center>
                                

                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>     
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
