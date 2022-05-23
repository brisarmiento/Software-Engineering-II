<?php
include "../../lib/customer_register_confirm.php";

// Register form is submitted, call registration
// function in customer_register_confirm.
if (isset($_POST["register_submit"])) {
    handleRegistration($db);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/styles.css" />


    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />

    <title>Online Banking System</title>
</head>

<body>
    <div class="register-page">
        <section class="vh-200">
            <!-- Status Message -->
            <?php
            if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
                echo "<div class='alert alert-danger alert-dismissible show' role='alert' style='text-align:center'>" . $_SESSION['message'] . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                $_SESSION['message'] = '';
            }
            ?>
            <div class="container py-5 h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12 col-lg-9 col-xl-7">
                        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                                <form action="" method="post">

                                    <!-- Row #1 -->
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="col-10">
                                                <label for="acc_type">Account Type</label>
                                                <select class="form-select form-select-lg " id="acc_type" name="acc_type">
                                                    <option value="Savings">Savings</option>
                                                    <option value="Checkings">Checkings</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row #2 -->
                                    <div class="row">
                                        <div class="col-md-6 mb-1">
                                            <div class="form-group">
                                                <label class="form-label" for="user">Username</label>
                                                <input type="text" name="user" id="user" class="form-control form-control-lg" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <div class="form-group">
                                                <label class="form-label" for="ssn">Social Security Number</label>
                                                <input type="text" name="ssn" id="ssn" class="form-control form-control-lg" pattern="[0-9]{3}-[0-9]{2}-[0-9]{4}" required />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row #3 -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="pass">Password</label>
                                                <input type="password" name="pass" id="pass" class="form-control form-control-lg" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="con_pass">Confirm Password</label>
                                                <input type="password" name="con_pass" id="con_pass" class="form-control form-control-lg" required />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row #4 -->
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="fname">First Name</label>
                                                <input type="text" name="fname" id="fname" class="form-control form-control-lg" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="lname">Last Name</label>
                                                <input type="text" name="lname" id="lname" class="form-control form-control-lg" required />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row #5 -->
                                    <div class="row">
                                        <div class="col-md-6 mb-1 pb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control form-control-lg" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-1 pb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="phone">Phone Number</label>
                                                <input type="tel" name="phone" id="phone" class="form-control form-control-lg" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row #6 -->
                                    <div class="row">
                                        <div class="col-md-12 mb-2 pb-2">
                                            <div class="col-12">
                                                <label for="stadd" class="form-label">Address</label>
                                                <input type="text" name="stadd" id="stadd" class="form-control form-control-lg" required />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row #7 -->
                                    <div class="row">
                                        <div class="col-md-7 mb-2 pb-2">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" name="city" class="form-control form-control-lg" id="city" required />
                                        </div>
                                        <div class="col-md-2">
                                            <label for="state" class="form-label">State</label>
                                            <select name="state" type="text" class="form-select form-select-lg" id="state" required>
                                                <option value="AL">AL</option>
                                                <option value="AK">AK</option>
                                                <option value="AZ">AZ</option>
                                                <option value="AR">AR</option>
                                                <option value="CA">CA</option>
                                                <option value="CO">CO</option>
                                                <option value="CT">CT</option>
                                                <option value="DE">DE</option>
                                                <option value="DC">DC</option>
                                                <option value="FL">FL</option>
                                                <option value="GA">GA</option>
                                                <option value="HI">HI</option>
                                                <option value="ID">ID</option>
                                                <option value="IL">IL</option>
                                                <option value="IN">IN</option>
                                                <option value="IA">IA</option>
                                                <option value="KS">KS</option>
                                                <option value="KY">KY</option>
                                                <option value="LA">LA</option>
                                                <option value="ME">ME</option>
                                                <option value="MD">MD</option>
                                                <option value="MA">MA</option>
                                                <option value="MI">MI</option>
                                                <option value="MN">MN</option>
                                                <option value="MS">MS</option>
                                                <option value="MO">MO</option>
                                                <option value="MT">MT</option>
                                                <option value="NE">NE</option>
                                                <option value="NV">NV</option>
                                                <option value="NH">NH</option>
                                                <option value="NJ">NJ</option>
                                                <option value="NM">NM</option>
                                                <option value="NY">NY</option>
                                                <option value="NC">NC</option>
                                                <option value="ND">ND</option>
                                                <option value="OH">OH</option>
                                                <option value="OK">OK</option>
                                                <option value="OR">OR</option>
                                                <option value="PA">PA</option>
                                                <option value="RI">RI</option>
                                                <option value="SC">SC</option>
                                                <option value="SD">SD</option>
                                                <option value="TN">TN</option>
                                                <option value="TX">TX</option>
                                                <option value="UT">UT</option>
                                                <option value="VT">VT</option>
                                                <option value="VA">VA</option>
                                                <option value="WA">WA</option>
                                                <option value="WV">WV</option>
                                                <option value="WI">WI</option>
                                                <option value="WY">WY</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="zip" class="form-label">Zip</label>
                                            <input type="text" name="zip" class="form-control form-control-lg" id="zip" pattern="[0-9]{5}" required />
                                        </div>
                                    </div>

                                    <center>
                                        <button type="submit" class="btn btn-primary btn-lg" name="register_submit">
                                            Register
                                        </button>
                                    </center>



                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</html>