<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Employee Login</title>
  <link rel="stylesheet" href="style.css"></link>
</head>
<body>
  <div class="form-container">
    <div class="header">
      <h2>Login - Employee</h2>
    </div>
    <form method="post" action="employeelogin.php">
      <?php include('errors.php'); ?>
      <div class="input-group">
        <label>Username</label>
        <input type="text" name="EMPLOYEE_USERNAME" required>
      </div>
      <div class="input-group">
        <label>Password</label>
        <input type="password" name="EMP_PASSWORD" required>
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="login_user_employee">Login</button>
      </div>
      <p>
        Login as manager? <a href="managerlogin.php">Switch to manager</a>
      </p>
      <p>
        <br>
        <a align=center href="Homepage.html">Back</a>
      </p>
    </form>
  </div>
</body>
</html>
