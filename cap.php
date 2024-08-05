<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('p4.php');

if (isset($_GET['sum']) && $_GET['sum'] === 'SubmitUpdate') {
    $pID = mysqli_real_escape_string($con, $_GET['pID']);

    $checkQuery = "SELECT * FROM Procedures WHERE ProcedureID='$pID'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (!$checkResult) {
        die("Query failed: " . mysqli_error($con));
    }

    $numRows = mysqli_num_rows($checkResult);

    if ($numRows > 0) {

        $cancelQuery = "DELETE FROM Procedures WHERE ProcedureID='$pID'";
        $cancelResult = mysqli_query($con, $cancelQuery);

        if (!$cancelResult) {
            die("Cancellation failed: " . mysqli_error($con));
        } else {
            echo 'Procedure canceled successfully.';
        }
    } else {
        echo 'Procedure does not exist. Please check the information and re-enter valid data.';
    }
}
?>
