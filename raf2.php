<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('p4.php');

if (isset($_GET['sum']) && $_GET['sum'] === 'SubmitUpdate') {
    $ad = mysqli_real_escape_string($con, $_GET['ad']);
    $at = mysqli_real_escape_string($con, $_GET['at']);
    $docID = mysqli_real_escape_string($con, $_GET['dID']);

    $appointmentID = mt_rand(100000, 999999);

    
    error_log("Debug Info: appdate=$ad, apptype=$at, docID=$docID");
    
      $_SESSION['appointment_info'] = [
        'ad' => $ad,
        'at' => $at,
        'docID' => $docID,
        'appointmentID' => $appointmentID
    ];

    $iQuery = "INSERT INTO Appointments (AppointmentID, AppointmentDate, AppointmentType, DoctorID) VALUES ('$appointmentID', '$ad', '$at', '$docID')";
    
    // Log the query for debugging
    error_log("SQL Query: $iQuery");

    $checkResult = mysqli_query($con, $iQuery);

    if (!$checkResult) {
        die("Query failed: " . mysqli_error($con));
    } 

    $numRows = mysqli_affected_rows($con);
    
    // Log information about affected rows
    error_log("Debug Info: Affected Rows=$numRows");

    if ($checkResult) {
        // Insert successful
        echo '<script>alert("Appointment confirmed! Appointment ID: ' . $appointmentID . '");</script>';
    //    echo '<script>window.location.href = "raf.php";</script>';
    } else {
        // Insert failed
        echo '<script>alert("Error confirming appointment: ' . mysqli_error($con) . '");</script>';
     //   echo '<script>window.location.href = "raf.php";</script>';
    }
}
?>
