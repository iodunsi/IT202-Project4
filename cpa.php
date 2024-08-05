<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('p4.php');

if (isset($_GET['sum']) && $_GET['sum'] === 'SubmitUpdate') {
    $pf = mysqli_real_escape_string($con, $_GET['pf']);
    $pl = mysqli_real_escape_string($con, $_GET['pl']);
    $patientID = mysqli_real_escape_string($con, $_GET['patientID']);

    $checkQuery = "SELECT * FROM Patients WHERE PatientID='$patientID' AND FirstName='$pf' AND LastName='$pl'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (!$checkResult) {
        die("Query failed: " . mysqli_error($con));
    }

    $numRows = mysqli_num_rows($checkResult);

    if ($numRows > 0) {
        echo 'PATIENT EXISTS IN THE SYSTEM.';
    } else {
        $updateQuery = "INSERT INTO Patients (FirstName, LastName, PatientID) VALUES ('$pf', '$pl', $patientID)";
        $updateResult = mysqli_query($con, $updateQuery);

        if ($updateResult) {
            echo 'PATIENT ACCOUNT CREATED.';
        } else {
            echo "Update failed: " . mysqli_error($con);
        }
    }
}
?>
