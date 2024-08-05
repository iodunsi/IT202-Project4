<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Receptionist & Patient Info</title>
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
  </style>
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
          <h1>House of Health</h1>

          <table>
            <thead>
              <th>Receptionist First Name</th>
              <th>Receptionist Last Name</th>
              <th>Receptionist Password</th>
              <th>Receptionist ID Number</th>
              <th>Receptionist Phone Number</th>
              <th>Receptionist Email</th>
            </thead>

            <tbody>
              <?php
              session_start();
              error_reporting(E_ALL);
              ini_set('display_errors', 1);
              include('p4.php');
              
              if (isset($_SESSION['rcpid'])) {
                $rcpid = $_SESSION['rcpid'];
                $result = mysqli_query($con, "SELECT * FROM Receptionist WHERE IDNumber = '$rcpid'");
                
                if (!$result) {
                  die("Query failed: " . mysqli_error($con));
                }

                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>{$row['FirstName']}</td>";
                  echo "<td>{$row['LastName']}</td>";
                  echo "<td>{$row['Password']}</td>";
                  echo "<td>{$row['IDNumber']}</td>";
                  echo "<td>{$row['PhoneNumber']}</td>";
                  echo "<td>{$row['EmailAddress']}</td>";
                  echo "</tr>";
                }
              }

              mysqli_close($con);
              ?>
            </tbody>
          </table>
          <form action="p4index.html" method="get"> 
          </form>
        </div>
      </div>
    </div>
  </section>

</body>

</html>
