<?php
    //gets session info
    session_start();

    // Creates new database object
    // --Update with your own local DB creds--
    $db = new mysqli('localhost', 'G6_admin', 'CSIT415OBS', 'group6_banking');   
    // Checks connection to database
    if (mysqli_connect_errno()) {
        echo 'Error: could not connect to database. Please try again later.';
        exit();
    }

?>