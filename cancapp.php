<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('p4.php');

if (isset($_GET['sum']) && $_GET['sum'] === 'SubmitUpdate') {
    $aID = mysqli_real_escape_string($con, $_GET['aID']);

    $checkQuery = "SELECT * FROM Appointments WHERE AppointmentID='$aID'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (!$checkResult) {
        die("Query failed: " . mysqli_error($con));
    }

    $numRows = mysqli_num_rows($checkResult);

    if ($numRows > 0) {
    
        $cancelQuery = "DELETE FROM Appointments WHERE AppointmentID='$aID'";
        $cancelResult = mysqli_query($con, $cancelQuery);

        if (!$cancelResult) {
            die("Cancellation failed: " . mysqli_error($con));
        } else {
            echo 'Appointment canceled successfully.';
        }
    } else {
        // Appointment does not exist
        echo 'Appointment does not exist. Please check the information and re-enter valid data.';
    }
}
?>
