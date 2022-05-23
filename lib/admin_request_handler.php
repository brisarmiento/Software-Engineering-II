<?php
    //includes file with db connection
    include '../../config.php';

    function handleRequestApproval($db) {
        //takes input passed from form and assigns to variables.
        $acc_type = $_POST['acc_type'];
        $user = $_POST['user'];
		$pass = $_POST['pass'];
		$email = $_POST['email'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$address = $_POST['address'];

        // Initialize message and unique ID's variables.
        $message = "";
        $cust_id = 0;
        $acc_num = 0;

        // Determine if this User already exists.
        $query = "SELECT * FROM `customer` WHERE `username`=\"".$user."\"";
        $results = $db->query($query);

        // If this is a new user, create a new
        // record in Customer table.
        if ($results->num_rows > 0) {
            $row = $results->fetch_assoc();
            $cust_id = $row['ID'];
        }
        else{
            // Validate that CustomerID is unique.
            $cust_id = mt_rand();
            $query = "SELECT * FROM `customer` WHERE `ID`=\"".$cust_id."\"";
            while ($db->query($query)->num_rows > 0){
                $cust_id = mt_rand();
            }

            // Insert into Customer Database.
            $query = "INSERT INTO `customer` VALUES ('".$cust_id."','".$user."', '".$pass."', '".$email."', '".$fname."', '".$lname."', '".$address."')";
            if ($db->query($query) === FALSE) {
                $message = "Something Went Wrong :(" . $db->error;
                $_SESSION['request_error'] = TRUE;
            }

        }

        // Validate that Account number is unique.
        $acc_num = mt_rand(10000000,99999999);
        $query = "SELECT * FROM `account` WHERE `acc_number`='".$acc_num."'";
        while ($db->query($query)->num_rows > 0){
            $acc_num = mt_rand(10000000,99999999);
        }

        // Insert into Account Database.
        $query = "INSERT INTO `account` VALUES ('".$acc_num."','".$cust_id."','".$acc_type."', 0, 0)";
		if ($db->query($query) === TRUE) {
            $message = "Account Request Approved";
        } else {
            $message = "Something Went Wrong :( " . $db->error;
            $_SESSION['request_error'] = TRUE;
        }
        
        // Remove existing request.
        removeRequest($db, $message);
    }

    function removeRequest($db, $message) {
        //takes input passed from form and assigns to variables
        $acc_id = $_POST['acc_id'];

        $query = "DELETE FROM `acc_request` WHERE `ID`='". $acc_id."'";
        if ($db->query($query) === TRUE) {
            $_SESSION['message'] = $message;
        } else {
            $_SESSION['message'] = "Something Went Wrong :(" . $db->error;
            $_SESSION['request_error'] = TRUE;
        }
    }

    function addAccount($db){
        $acc_type = $_POST['acc_type'];
        $user = $_POST['username'];
        $ssn = $_POST['ssn'];
		$pass = $_POST['pass'];
		$email = $_POST['email'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$address = $_POST['address'];

        //queries db for username entered
        $query = "SELECT * FROM `customer` WHERE username = '".$user."'";
        $result = $db->query($query)->fetch_assoc();

        // TODO: VALIDATE CORRECT SSN INSTEAD OF GENERIC.
        // Validate SSN/Password.
        $ssn = preg_replace('~\D~', '', $ssn); // replace all non-digits
        if(!preg_match('~^(?!000|666|9\d\d)\d{3}(?!00)\d{2}(?!0000)\d{4}$~', $ssn) || !password_verify($pass, $result['password'])) {
            $_SESSION['message'] = 'Invalid Credentials. Please try again.';
            return;
        }

        // creates insert query for db with user info
		$query = "INSERT INTO `acc_request` VALUES 
		(NULL, '".$acc_type."', '".$user."', '".$pass."', '".$email."', '".$fname."', '".$lname."', '".$address."')";
		
		// checks if insert was successful
		if ($db->query($query)) {
			$_SESSION['message'] = 'Account Request Submitted!';
            $_SESSION['newAcc'] = true;
			return;
		}
		// checks if some other error has occurred
		else {
			$_SESSION['message'] = 'An error has occurred. Please try again later.';
			return;
		}

    }
    
    

?>