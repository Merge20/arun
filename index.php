<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Phoenix Pulse</title>
  <link rel="stylesheet" href="./style/form.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
</head>
<body>
  <div class="form-container">
    <h2>Login to Phoenix Pulse</h2>
    <?php 
    session_start();
    if (isset($_SESSION['error'])) {
        echo '<div class="error-message" style="color: red; margin-bottom: 1rem; text-align: center;">'.$_SESSION['error'].'</div>';
        unset($_SESSION['error']);
    }
    ?>
    <form action="./database/login.php" method="POST">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required />
    
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required />
    
      <button type="submit">Login</button>
      <p class="bottom-text">Don't have an account? <a href="register.php">Register here</a></p>
    </form>
  </div>
</body>
</html>