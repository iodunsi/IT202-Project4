<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('p4.php');

if (isset($_GET['sum']) && $_GET['sum'] === 'SubmitUpdate') {
    $shots = mysqli_real_escape_string($con, $_GET['shots']);
    $illnesses = mysqli_real_escape_string($con, $_GET['illnesses']);
    $patientID = mysqli_real_escape_string($con, $_GET['patientID']);

    $checkQuery = "SELECT * FROM Patients WHERE PatientID='$patientID'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (!$checkResult) {
        die("Query failed: " . mysqli_error($con));
    }

    $numRows = mysqli_num_rows($checkResult);

    if ($numRows > 0) {
        $updateQuery = "UPDATE Patients SET ShotsGiven='$shots', Illnesses='$illnesses' WHERE PatientID='$patientID'";
        $updateResult = mysqli_query($con, $updateQuery);

        if ($updateResult) {
            echo '<script>alert("Shots and Illnesses updated for Patient ID: ' . $patientID . '");</script>';
            echo '<script>window.location.href = "p4index.html";</script>';
        } else {
            echo "Update failed: " . mysqli_error($con);
        }
    } else {
        echo '<script>alert("Patient with ID: ' . $patientID . ' does not exist. Please check your data.");</script>';
        echo '<script>window.location.href = "upr.html";</script>';
    }
}
?>
