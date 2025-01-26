<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Manager Login</title>
  <link rel="stylesheet" href="style.css"></link>
</head>
<body>
  <div class="form-container">
    <div class="header">
      <h2>Login - Manager</h2>
    </div>
    <form method="post" action="managerlogin.php">
      <?php include('errors.php'); ?>
      <div class="input-group">
        <label>ID</label>
        <input type="text" name="MANAGER_ID" required>
      </div>
      <div class="input-group">
        <label>Password</label>
        <input type="password" name="MAN_PASSWORD" required>
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="login_user_manager">Login</button>
      </div>
      <p>
        Login as employee? <a href="employeelogin.php">Switch to employee</a>
      </p>
      <p>
        <br>
        <a align=center href="Homepage.html">Back</a>
      </p>
    </form>
  </div>
</body>
</html>
