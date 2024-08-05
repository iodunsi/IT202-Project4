<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Create a Patient Account</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .topnav {
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #04AA6D;
            color: white;
        }

        .overlay {
            margin-top: 40px;
        }

        #messageContainer {
            display: none;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function reqApp() {
            if (confirm("You are about to REQUEST an Appointment. Are you sure you want to do so?")) {
                var appdate = document.getElementById('ad').value;
                var apptype = document.getElementById('at').value;
                var docID = document.getElementById('dID').value;
var dateRegex = /^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])?$/;
        if (!dateRegex.test(appdate)) {
            alert("Please enter a valid date in the format YYYY-MM-DD.");
            return;
        }
                $.ajax({
                    type: "GET",
                    url: "raf2.php",
                    data: {
                        ad: appdate,
                        at: apptype,
                        dID: docID,
                        sum: 'SubmitUpdate'
                    },
                    success: function (response) {
                        // Update the message container with the response
                        $("#messageContainer").html(response).show();
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            } else {
                // User canceled the update
                alert("Appointment request canceled.");
            }
        }
    </script>
</head>
<body>
    <div class="topnav">
        <a class="active" href="p4index.html">Home</a>
        <a href="p4rt.php">Search Receptionist Account</a>
        <a href="upr.html">Update Patient Record</a>
        <a href="mpa.html">Make Patient Appointment</a>
        <a href="sap.html">Schedule A Procedure</a>
        <a href="cap.html">Cancel A Procedure</a>
        <a href="cpa.html">Create Patient Account</a>
        <a href="cancapp.html">Cancel Appointment</a>
    </div>
    <section>
        <div class="overlay">
            <div class="login-info">
                <div class="transparent-box">
                    <form id="verifyForm">
                        <h1>Request An Appointment Form</h1>
                        <br>
                        <br>
                        <label for="ad">Appointment Date:</label>
                        <input type="text" id="ad" name="ad" required>
                        <br>
                        <br>
                        <label for="at">Appointment Type:</label>
                        <input type="text" id="at" name="at" required>
                        <br>
                        <br>
                        <label for="dID">Doctor ID:</label>
                        <input type="text" id="dID" name="dID" required>
                        <br>
                        <br>
                        <button type="button" onclick="reqApp()">Request Appointment</button>

                        
                        <div id="messageContainer"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
