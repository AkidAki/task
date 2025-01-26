<?php
session_start();

// initializing variables
$EMPLOYEE_USERNAME = "";
$MANAGER_ID = "";
$EMAIL = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost:3307', 'root', '', 'task_management',3307);

////////////////////THIS SECTION IS NOT NECESSARY/////////////
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $EMPLOYEE_USERNAME = mysqli_real_escape_string($db, $_POST['EMPLOYEE_USERNAME']);
  $EMAIL = mysqli_real_escape_string($db, $_POST['EMAIL']);
  $EMPLOYEE_NAME = mysqli_real_escape_string($db, $_POST['EMPLOYEE_NAME']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation
  if (empty($EMPLOYEE_USERNAME)) { array_push($errors, "Username is required"); }
  if (empty($EMAIL)) { array_push($errors, "Email is required"); }
  if (empty($EMPLOYEE_NAME)) { array_push($errors, "Employee name is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match"); }

  // check if user already exists
  $user_check_query = "SELECT * FROM EMPLOYEE WHERE EMPLOYEE_USERNAME='$EMPLOYEE_USERNAME' OR EMAIL='$EMAIL' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { 
    if ($user['EMPLOYEE_USERNAME'] === $EMPLOYEE_USERNAME) {
      array_push($errors, "Username already exists");
    }
    if ($user['EMAIL'] === $EMAIL) {
      array_push($errors, "Email already exists");
    }
  }

  // Register user if no errors
  if (count($errors) == 0) {
    $password = md5($password_1); // encrypt password
    $query = "INSERT INTO EMPLOYEE (EMPLOYEE_USERNAME, EMAIL, EMP_PASSWORD, EMPLOYEE_NAME) 
              VALUES('$EMPLOYEE_USERNAME', '$EMAIL', '$EMP_PASSWORD', '$EMPLOYEE_NAME')";
    mysqli_query($db, $query);

    $_SESSION['EMPLOYEE_USERNAME'] = $EMPLOYEE_USERNAME;
    $_SESSION['success'] = "You are now logged in";
    header('location: employee.php'); //
  }
}

/////manager/////
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $MANAGER_ID = mysqli_real_escape_string($db, $_POST['MANAGER_ID']);
  $EMAIL = mysqli_real_escape_string($db, $_POST['EMAIL']);
  $MANAGER_NAME = mysqli_real_escape_string($db, $_POST['MANAGER_NAME']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation
  if (empty($MANAGER_ID)) { array_push($errors, "ID is required"); }
  if (empty($EMAIL)) { array_push($errors, "Email is required"); }
  if (empty($MANAGER_NAME)) { array_push($errors, "Manager name is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match"); }

  // check if user already exists
  $user_check_query = "SELECT * FROM MANAGER WHERE MANAGER_ID='$MANAGER_ID' OR EMAIL='$EMAIL' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { 
    if ($user['MANAGER_ID'] === $MANAGER_ID) {
      array_push($errors, "Username already exists");
    }
    if ($user['EMAIL'] === $EMAIL) {
      array_push($errors, "Email already exists");
    }
  }

  // Register user if no errors
  if (count($errors) == 0) {
    $password = md5($password_1); // encrypt password
    $query = "INSERT INTO MANAGER (MANAGER_ID, EMAIL, MAN_PASSWORD, MANAGER_NAME) 
              VALUES('$MANAGER_ID', '$EMAIL', '$MAN_PASSWORD', '$MANAGER_NAME')";
    mysqli_query($db, $query);

    $_SESSION['MANAGER_ID'] = $MANAGER_ID;
    $_SESSION['success'] = "You are now logged in";
    header('location: manager.php');
  }
}


///////////////////-----------------------------///////////////

// LOGIN USER
if (isset($_POST['login_user_employee'])) {
  $EMPLOYEE_USERNAME = mysqli_real_escape_string($db, $_POST['EMPLOYEE_USERNAME']);
  $EMP_PASSWORD = mysqli_real_escape_string($db, $_POST['EMP_PASSWORD']);

  //LOGIN EMPLOYEE
  if (empty($EMPLOYEE_USERNAME)) {
    array_push($errors, "Username is required");
  }
  if (empty($EMP_PASSWORD)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $PASSWORD = md5($EMP_PASSWORD);
    $query = "SELECT * FROM EMPLOYEE WHERE EMPLOYEE_USERNAME='$EMPLOYEE_USERNAME' AND EMP_PASSWORD='$EMP_PASSWORD'";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) == 1) {
      $_SESSION['EMPLOYEE_USERNAME'] = $EMPLOYEE_USERNAME;
      $_SESSION['success'] = "You are now logged in";
      header('location: employee.php'); //will be direct to any login homepage (employee)
    } else {
      array_push($errors, "Invalid username/password combination");
    }
  }
}

if (isset($_POST['login_user_manager']))
{
  //LOGIN - MANAGER
  $MANAGER_ID = mysqli_real_escape_string($db, $_POST['MANAGER_ID']);
  $MAN_PASSWORD = mysqli_real_escape_string($db, $_POST['MAN_PASSWORD']);
  if (empty($MANAGER_ID)) {
    array_push($errors, "Username is required");
  }
  if (empty($MAN_PASSWORD)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $PASSWORD = md5($MAN_PASSWORD);
    $query = "SELECT * FROM MANAGER WHERE MANAGER_ID='$MANAGER_ID' AND MAN_PASSWORD='$MAN_PASSWORD'";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) == 1) {
      $_SESSION['MANAGER_ID'] = $MANAGER_ID;
      $_SESSION['success'] = "You are now logged in";
      header('location: manager.php'); //will be direct to any login homepage (manager)
    } else {
      array_push($errors, "Invalid username/password combination");
    }
  }
}
?>