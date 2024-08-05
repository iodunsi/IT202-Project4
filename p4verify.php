<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('p4.php');


if(isset($_POST['sum'])) {
  $rcpfst = $_POST['rcpfst'];
  $rcplst = $_POST['rcplst'];
  $rcppass = $_POST['rcppass'];
  $rcpid = $_POST['rcpid'];
  $rcpphn = $_POST['rcpphn'];
  $rcpeml = $_POST['rcpem'];
  
// echo "Received values:\n";
//   var_dump($_POST);


 $sql = "SELECT * FROM Receptionist WHERE FirstName = '$rcpfst' AND LastName = '$rcplst' AND IDNumber = '$rcpid' AND Password = '$rcppass' AND EmailAddress = '$rcpeml' AND PhoneNumber='$rcpphn'";
  $result = mysqli_query($con, $sql);

  if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode(['success' => true, 'data' => $row]);
            session_start();
            $_SESSION["rcpid"] = $rcpid;
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => "An account for $rcpfst cannot be found."]);
            exit();
        }
    } else {
       
        //echo "MySQL error: " . mysqli_error($con);
        exit();
    }
}

  mysqli_close($con);
?>

