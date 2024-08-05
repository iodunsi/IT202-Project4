<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('p4.php');

if (isset($_GET['sum']) && $_GET['sum'] === 'SubmitUpdate') {
    $pf = mysqli_real_escape_string($con, $_GET['pf']);
    $pl = mysqli_real_escape_string($con, $_GET['pl']);
    $patientID = mysqli_real_escape_string($con, $_GET['patientID']);

    $checkQuery = "SELECT PatientID, FirstName, LastName FROM Patients WHERE TRIM(LOWER(PatientID)) = TRIM(LOWER('$patientID')) AND TRIM(LOWER(FirstName)) = TRIM(LOWER('$pf')) AND TRIM(LOWER(LastName)) = TRIM(LOWER('$pl'))";
    $checkResult = mysqli_query($con, $checkQuery);

    if (!$checkResult) {
        die("Query failed: " . mysqli_error($con));
    }

    $numRows = mysqli_num_rows($checkResult);

  //  echo '<script>alert("Debug Info: PatientID=' . $patientID . ', FirstName='. $pf .', LastName='. $pl . ', Rows='. $numRows . '");</script>';

    if ($numRows > 0) {
        // Patient found, redirect to raf.html
  //      echo '<script>alert("Patient found!");</script>';
        echo '<script>window.location.href = "raf.php";</script>';
    } else {
        // Patient not found
        echo '<script>alert("Patient with ID: ' . $patientID . ' does not exist in the database. A secondary check will occur; if the patient can still not be found, an account will need to be created.");</script>';
        echo '<script>window.location.href = "cpa.html";</script>';
    }
}
?>
