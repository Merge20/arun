<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register | Phoenix Pulse</title>
  <link rel="stylesheet" href="./style/form.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
</head>
<body>
  <div class="form-container">
    <h2>Register as a Donor</h2>
    
    <?php if (isset($_SESSION['error'])): ?>
      <div class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['success'])): ?>
      <div class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    
    <form action="./database/register.php" method="POST">
      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" required 
             value="<?php echo isset($_SESSION['form_data']['name']) ? htmlspecialchars($_SESSION['form_data']['name']) : ''; ?>" />
    
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required 
             value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>" />
    
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required />
    
      <label for="confirm">Confirm Password</label>
      <input type="password" id="confirm" name="confirm" required />
    
      <button type="submit">Register</button>
      <p class="bottom-text">Already have an account? <a href="index.php">Login here</a></p>
    </form>
  </div>
</body>
</html>