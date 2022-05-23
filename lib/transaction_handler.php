<?php
    //includes file with db connection
    include "../../config.php";

    function handleWithdraw($db) {
        $amount = trim($_POST['amount']);
        $acc_num = $_POST['acc_num'];
        $desc = $_POST['desc'];

        $query = "SELECT * FROM `account` WHERE `acc_number` = \"".$acc_num."\"";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $balance = $row['balance'];

        if($amount > $balance && $amount < 5){
            $_SESSION['message'] = 'Cannot withdraw from account with balance lower than $5.00';
            return;
        }
        if($amount < 5){
            $_SESSION['message'] = 'All deposits and withdrawls must be made with more than $5.00';
            return;
        }
        if($amount > $balance){
            $_SESSION['message'] = 'Withdraw amount exceeds account balance';
            return;
        }

        // Update Account Balance.
        $new_balance = $balance - $amount;
        $query = "UPDATE `account` SET `balance` = \"".$new_balance."\" WHERE `acc_number` = \"".$acc_num."\"";
        $db->query($query);

        // Select Customer Info
        $query = "SELECT * FROM `customer` WHERE `ID` = \"".$_SESSION['user_id']."\"";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $recip_name = $row['fname'];

        date_default_timezone_set('America/New_York');
        $date = date("Y-m-d h:i:sa");

        $query = "INSERT INTO `transaction` VALUES 
        (NULL, '".$acc_num."', 'Withdraw', '".$desc."', '".$recip_name."', '".$acc_num."', '".$amount."', '".$new_balance."', '".$date."')";
        $db->query($query);
        header('Location: ../cust_pages/customer_homepage.php');
        
    }

    function handleDeposit($db) {
        $amount = trim($_POST['amount']);
        $acc_num = $_POST['acc_num'];
        $desc = $_POST['desc'];

        $query = "SELECT * FROM `account` WHERE `acc_number` = \"".$acc_num."\"";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $balance = $row['balance'];

        if($amount < 5){
            $_SESSION['message'] = 'All deposits and withdrawls must be made with more than $5';
            return;
        }

        $new_balance = $balance + $amount;
        $query = "UPDATE `account` SET `balance`=\"".$new_balance."\" WHERE `acc_number`=\"".$acc_num."\"";
        $db->query($query);

        // Select Customer Info
        $query = "SELECT * FROM `customer` WHERE `ID` = \"".$_SESSION['user_id']."\"";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $recip_name = $row['fname'];

        date_default_timezone_set('America/New_York');
        $date = date("Y-m-d h:i:sa");
        $query = "INSERT INTO transaction VALUES 
        (NULL, '".$acc_num."', 'Deposit', '".$desc."', '".$recip_name."', '".$acc_num."', '".$amount."', '".$new_balance."', '".$date."')";
        mysqli_query($db, $query);
      
        header('Location: ../cust_pages/customer_homepage.php');
    }
?>