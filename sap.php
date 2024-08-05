<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('p4.php');

if (isset($_GET['sum']) && $_GET['sum'] === 'SubmitUpdate') {
    $pd = mysqli_real_escape_string($con, $_GET['pd']);
    $pt = mysqli_real_escape_string($con, $_GET['pt']);
    $aID = mysqli_real_escape_string($con, $_GET['aID']); 
    
    $proID = mt_rand(100000, 999999);

    $checkQuery = "SELECT * FROM Appointments WHERE AppointmentID='$aID'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (!$checkResult) {
        die("Query failed: " . mysqli_error($con));
    }

    $numRows = mysqli_num_rows($checkResult);

    if ($numRows > 0) {
        $insertQuery="INSERT INTO Procedures (ProcedureDate, ProcedureType, AppointmentID, ProcedureID) VALUES ( '$pd', '$pt', '$aID', '$proID')";

        echo 'Procedure scheduled successfully.';
    } else {
        echo 'PLEASE MAKE SURE A PRE-PROCEDURE APPOINTMENT WAS MADE BEFORE BOOKING A PROCEDURE.';
    }
}
?>
