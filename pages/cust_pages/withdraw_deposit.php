<?php
  include "../../lib/transaction_handler.php";

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

  // Deposit Function
  if (isset($_POST["deposit_submit"])) {
    handleDeposit($db);
  }

  // Withdraw Function
  if (isset($_POST["withdraw_submit"])) {
    handleWithdraw($db);
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
    <link rel="stylesheet" href="../../styles/styles.css"/>

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
              <a class="nav-link active" href="withdraw_deposit.php">Withdraw/Deposit</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="transfer_money.php">Transfer Money</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="customer_manage.php">Manage Account</a>
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
    
    <?php
      // Message.
      if(isset($_SESSION['message']) && $_SESSION['message'] != "") {
        if(isset($_SESSION['newAcc']) && $_SESSION['newAcc'] == true){
          $message_status = "success";
        }
        else{
          $message_status = "danger";
        }
        echo "<div class='alert alert-".$message_status." alert-dismissible show' role='alert' style='text-align:center'>".$_SESSION['message']."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        $_SESSION['message'] = '';
      }
    ?>

    <div class="body-content">

      <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-9 col-xl-7">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
              <div class="card-body p-4 p-md-5">
              <h1>Deposit</h1>
              <form action="" method="post">
                <div class="form-group">
                  <div class="form-group p-2">
                      <label for="amount">Account</label>
                      <select class="form-select" name='acc_num' aria-label="Default select example">
                        <?php
                          $query = "SELECT * FROM `account` WHERE `cust_id` = \"".$_SESSION['user_id']."\"";
                          $result = $db->query($query);

                          while ($row = $result->fetch_assoc()){
                            echo "<option value=".$row['acc_number'].">".$row['type']." (x".substr(strval($row['acc_number']), -4).")</option>";
                          }
                        ?>
                      </select>
                    </div>

                    <div class="form-group p-2">
                      <label for="amount">Brief Description</label>
                      <input type="text" class="form-control" placeholder="" name="desc" required />
                    </div>

                    <div class="form-group p-2">
                      <label for="amount">Amount</label>
                      <input type="number" class="form-control" placeholder="$" name="amount" step="0.01" required />
                  </div>
                </div>

                <div class="button-container">
                <button type="submit" class="btn btn-primary" name="deposit_submit">
                Deposit
                </button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div> 
      
      <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-9 col-xl-7">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
              <div class="card-body p-4 p-md-5">
              <h1>Withdraw</h1>
              <form action="" method="post">
                <div class="form-group">

                  <div class="form-group p-2">
                    <label for="amount">Account</label>
                    <select class="form-select" name='acc_num' aria-label="Default select example">
                      <?php
                        $query = "SELECT * FROM `account` WHERE `cust_id` = \"".$_SESSION['user_id']."\"";
                        $result = $db->query($query);

                        while ($row = $result->fetch_assoc()){
                          echo "<option value=".$row['acc_number'].">".$row['type']." (x".substr(strval($row['acc_number']), -4).")</option>";
                        }
                      ?>
                    </select>
                  </div>

                  <div class="form-group p-2">
                    <label for="amount">Brief Description</label>
                    <input type="text" class="form-control" placeholder="" name="desc" required />
                  </div>

                  <div class="form-group p-2">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" placeholder="$" name="amount" step="0.01" required />
                  </div>
                
                </div>

                <div class="button-container">
                <button type="submit" class="btn btn-primary" name="withdraw_submit">
                Withdraw
                </button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div> 

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>