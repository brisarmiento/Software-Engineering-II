<?php
  include "../../lib/admin_request_handler.php";

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
  
  if (isset($_POST["view_transactions"])) {
    $_SESSION['POST'] = $_POST;
    header('Location: ../cust_pages/account_transactions.php');
  }

  if (isset($_POST["open_account"])) {
    addAccount($db);
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
              <a class="nav-link" href="withdraw_deposit.php">Withdraw/Deposit</a>
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
          $_SESSION['newAcc'] = false;
        }
        else{
          $message_status = "danger";
        }
        echo "<div class='alert alert-".$message_status." alert-dismissible show' role='alert' style='text-align:center'>".$_SESSION['message']."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        $_SESSION['message'] = '';
      }
    ?>

    <div class="accounts-section-top">
      <?php
        // Homepage Greeting.
        date_default_timezone_set('America/New_York');
        $date = date('F, d Y',strtotime(date("Y-m-d")));
        if(date("a") == 'pm'){
          $time = 'evening';
        }
        else{
          $time = 'morning';
        }
        
        // Get user info.
        $query = "SELECT * FROM `customer` WHERE `ID` = \"".$_SESSION['user_id']."\"";
        $user = $db->query($query)->fetch_assoc();

        echo '<div class="homepage-greeting">';
        echo '<h1>Good '.$time.', '.$user['fname'].'!</h1>';
        echo '<h6>Today\'s date is '.$date.'</h7>';
        echo '</div>';
      ?>
    </div>

    <div class="accounts-section-mid">
      <!-- Account Listings -->
      <div class="account_table">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-4 text-center">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th scope="col">Accounts</th>
                  <th scope="col">Available Balance</th>
                  <th scope="col">Pending Transactions</th>
                </tr>
              </thead>
              <?php
                $query = "SELECT * FROM `account` WHERE `cust_id` = \"".$_SESSION['user_id']."\"";
                $result = $db->query($query);

                $account_total = 0;
                while ($row = $result->fetch_assoc()){
                  echo '<tbody>';
                  echo '<form action="" method="post">';
                  echo '<tr>';
                  echo '<td class="col-md-6"><button type="submit" name="view_transactions" class="btn btn-link">'.$row['type'].' (x'.substr(strval($row['acc_number']), -4).')</button></td>';
                  echo '<td class="align-middle">$'.number_format($row['balance'], 2).'</td>';
                  echo '<td class="align-middle">$'.number_format($row['pending'], 2).'</td>';
                  echo '</tr>';

                  // Hidden Form Data.
                  echo '<input type="hidden" name="acc_num" value='.$row['acc_number'].'>';
                  echo '</form>';
                  
                  $account_total += $row['balance'];
                }
                
                echo '</tbody>';
                echo '<tfoot>';
                echo '<tr class="table-info">';
                echo '<td class="col-md-6">Total</td>';
                echo '<td colspan="2">$'.number_format($account_total, 2).'</td>';
                echo '</tr>';
                echo '</tfoot>';
              ?>
            </table>
          </div>
        </div>
      </div>

      <div class="open-account">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-4 text-center">


            <h4 style="padding: 10px;">Open New Account</h4>

            <form class="my-2 my-lg-0" action="" method="POST">

              <div class="form-group p-2">
                <label for="cpass">Account Type</label>
                <select class="form-select" style="padding: 10px;" name="acc_type">
                  <option selected value="Savings">Savings</option>
                  <option value="Checkings">Checkings</option>
                </select>
              </div>

              <div class="form-group p-2">
                <label for="cpass">Enter SSN</label>
                <input type="password" class="form-control" placeholder="SSN" name="ssn" required />
              </div>

              <div class="form-group p-2">
                <label for="cpass">Enter Password</label>
                <input type="password" class="form-control" placeholder="Password" name="pass" required />
              </div>

              <!-- Hidden Fields -->
              <?php
                echo '<input type="hidden" name="username" value='.$user['username'].'>';
                echo '<input type="hidden" name="email" value='.$user['email'].'>';
                echo '<input type="hidden" name="fname" value='.$user['fname'].'>';
                echo '<input type="hidden" name="lname" value='.$user['lname'].'>';
                echo '<input type="hidden" name="address" value='.$user['address'].'>';
              ?>


              <div class="submit-request">
                <button class="btn btn-info" type="submit" name="open_account">Submit Request</button>
              </div>

            </form>
          </div>
        </div>         
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>