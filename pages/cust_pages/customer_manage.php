<?php
include '../../config.php';

// Logout Function
if (isset($_POST["logout"])) {
  $_SESSION['loggedin'] = false;
  header('Location: ../cust_pages/customer_signin.php');
}
// Validate Login.
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
  $_SESSION['loggedin'] = false;
  header('Location: ../cust_pages/customer_signin.php');
}

//creates query to get user info from CUSTOMER view
$query = "SELECT * FROM `customer` WHERE `username` = \"" . $_SESSION['user'] . "\"";

//gets info from db
$results = $db->query($query);
$row = $results->fetch_assoc();

//creates variables from queried values
$user = $row['username'];
$email = $row['email'];
$Fname = $row['fname'];
$Lname = $row['lname'];
$address = $row['address'];

//closes connection and clears results
$results->free();
$db->close();
?>

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

  <title>Banking App</title>
</head>

<body style="background-color: #cccccc;">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="customer_homepage.php">Accounts</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="withdraw_deposit.php">Withdraw/Deposit</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="transfer_money.php">Transfer Money</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="customer_manage.php">Manage Account</a>
          </li>
        </ul>

        <form class="d-flex form-inline my-2 my-lg-0" action="" method="POST">
          <button name="logout" class="btn btn-info form-inline my-2 my-lg-0">
            Logout
          </button>
        </form>
      </div>
    </div>
  </nav>

    <section class="vh-200">
      <!-- Status Message -->
      <?php 
          if(isset($_SESSION['message']) && $_SESSION['message'] != "") {
              echo "<div class='alert alert-danger alert-dismissible show' role='alert' style='text-align:center'>".$_SESSION['message']."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
              $_SESSION['message'] = '';
          }
      ?>
      <div class="container py-5 h-50">
          <div class="row justify-content-center align-items-center h-100">
              <div class="col-12 col-lg-9 col-xl-7">
                  <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                      <div class="card-body p-4 p-md-5">
                          <h2 class="mb-4 pb-2 pb-md-0 mb-md-5">Profile and Settings</h2>

                          <!-- Row #2 -->
                          <div class="row">
                              <div class="col-md-6 mb-1">
                                  <div class="form-group">
                                      <h5>Username</h5>
                                      <?php echo $user; ?>
                                  </div>
                              </div>
                          </div>

                          <!-- Row #2 -->
                          <div class="row">
                              <div class="col-md-12 mb-2">
                                  <div class="form-group">
                                      <h5>Email</h5>
                                      <?php echo $email; ?>
                                  </div>
                              </div>
                          </div>


                          <!-- Row #2 -->
                          <div class="row">
                              <div class="col-md-12 mb-2">
                                  <div class="form-group">
                                      <h5>First Name</h5>
                                      <?php echo $Fname; ?>
                                  </div>
                              </div>
                          </div>

                          <!-- Row #2 -->
                          <div class="row">
                              <div class="col-md-12 mb-2">
                                  <div class="form-group">
                                      <h5>Last Name</h5>
                                      <?php echo $Lname; ?>
                                  </div>
                              </div>
                          </div>

                          <!-- Row #2 -->
                          <div class="row">
                              <div class="col-md-12 mb-2">
                                  <div class="form-group">
                                      <h5>Address</h5>
                                      <?php echo $address; ?>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>

</html>