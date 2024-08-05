//Validation Starts Here
function validateForm() {
  var firstName = document.getElementById('rcpfst').value; 
  var lastName = document.getElementById('rcplst').value; 
  var phoneNumber = document.getElementById('rcpphn').value;
  var password = document.getElementById('rcppass').value;
  var userId = document.getElementById('rcpid').value;
  var email = document.getElementById('rcpem').value;
  var checkbox = document.getElementById('chk').checked;
  var emailInput = document.getElementById('rcpem');
  var emailErrorLabel = document.getElementById('Eerror'); 
  var form = document.getElementById('healthForm');
  emailInput.classList.remove('error');
  emailErrorLabel.style.display = 'none';
  emailErrorLabel.textContent = '';

  if (checkbox) {
      emailInput.classList.add('error');
      emailErrorLabel.style.display = 'inline';
      emailInput.setAttribute('required', 'required');
  } else {
      emailInput.removeAttribute('required');
  }
   const numberRegex = /\d/;


  if (firstName === "") {
    alert("Please enter your First Name.");
    document.getElementById('rcpfst').focus();
    return;
  }



  if (lastName === "") {
    alert("Please enter your Last Name.");
    document.getElementById('rcplst').focus();

    return;
  }
 
  if (numberRegex.test(firstName)) {
alert("Names shouldn't have any numbers.")
  document.getElementById('rcpfst').focus();
    return;
  }

 
  if (numberRegex.test(lastName)) {
alert("Names shouldn't have any numbers.")
  document.getElementById('rcplst').focus();
    return;
  }

  if (password === "") {
    alert("Please enter your Password.");
    document.getElementById('rcppass').focus();
    return;
  }


  if (password.length > 16) {
    alert("Password should contain a maximum of 16 characters.");
    document.getElementById('rcppass').focus();
    return;
  }

  if (!/[A-Z]/.test(password)) {
    alert("Password should contain at least 1 uppercase letter.");
    document.getElementById('rcppass').focus();
    return;
  }

  if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
    alert("Password should contain at least 1 special character.");
    document.getElementById('rcppass').focus();
    return;
  }

  if (!/\d/.test(password)) {
    alert("Password should contain at least 1 numeric character.");
    document.getElementById('rcppass').focus();
    return;
  }

  if (userId === "" || userId.length != 4) {
    alert("User ID should be a 4 digit number.");
    document.getElementById('rcpid').focus();
    return;
  }


  if (phoneNumber === "") {
    alert("Please enter your Phone Number.");
    document.getElementById('rcpphn').focus();
    return;
  }

  var phoneRegex = /^\d{10}$/; 
  if (!phoneRegex.test(phoneNumber)) {
    alert("Please enter a valid phone number format (e.g., 5555555555).");
    document.getElementById('rcpphn').focus();
    return;
  }



  if (email === "") {
    alert("Please enter your Email.");
    document.getElementById('rcpem').focus();
    return;
  }

  if (!/\S+@\S+\.\S{3,5}/.test(email)) {
    alert("Please enter a valid email address.");
    document.getElementById('rcpem').focus();
    return;
  }
//Validation Ends Here





    var selectedTransaction = form.querySelector('input[name="transaction"]:checked');
  if (!selectedTransaction) {
    alert("Please select a transaction.");
    return;
  }

  var transactionName = "";

  switch (selectedTransaction.id) {
    case "searchAccount":
      transactionName = "Search Records";
      break;
    case "bookAppointment":
      transactionName = "Book An Appointment";
      break;
    case "cancelAppointment":
      transactionName = "Cancel an Appointment";
      break;
    case "requestProcedures":
      transactionName = "Request a Procedure";
      break;
    case "cancelProcedures":
      transactionName = "Cancel A Procedure";
      break;
    case "updateInfo":
      transactionName = "Update Patient Info";
      break;
    case "createAccount":
      transactionName = "Create a New Patient Account";
      break;



  }



// Verification using p4verify.php Starts Here
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
  console.log(this.responseText);
    var response = JSON.parse(this.responseText);
    
    if (response.success) {
      alert("Welcome, " + firstName + " " + lastName + "! You have entered the system. Transaction: " + transactionName + ".");
      
      
    if (selectedTransaction.id === "searchAccount") {
      window.location.href = "p4rt.php";
    }

    if (selectedTransaction.id === "updateInfo") {
      window.location.href = "upr.html";
    }
    if (selectedTransaction.id === "bookAppointment") {
      window.location.href = "mpa.html";
    }
     if (selectedTransaction.id === "cancelAppointment") {
      window.location.href = "cancapp.html";
    }
    if (selectedTransaction.id === "requestProcedures") {
      window.location.href = "sap.html";
    }
    if (selectedTransaction.id === "cancelProcedures") {
      window.location.href = "cap.html";
    }
    if (selectedTransaction.id === "updateInfo") {
      window.location.href = "upr.html";
    }
     if (selectedTransaction.id === "createAccount") {
      window.location.href = "cpa.html";
    }
    } else {
      alert(response.message);
    }
  }
};


var data = "rcpfst=" + encodeURIComponent(firstName) +
           "&rcplst=" + encodeURIComponent(lastName) +
           "&rcppass=" + encodeURIComponent(password) +
           "&rcpid=" + encodeURIComponent(userId) +
           "&rcpphn=" + encodeURIComponent(phoneNumber) +
           "&rcpem=" + encodeURIComponent(email) +
           "&sum=Submit";


xhttp.open("POST", "p4verify.php", true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send(data);

} 

