<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ./database/login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>phoenix pulse</title>
  <link rel="stylesheet" href="./style/awareness.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <header class="navbar">
    <div class="logo">phoenix pulse</div>
    <nav class="nav-links">
      <a href="/home.php">Home</a>
      <a href="/dregistration.php">Donate now</a>
      <a href="/faq.php">FAQs</a>
      <a class="active" href="/awareness.php">Awareness</a>
      <a href="#">Donor's</a>
    </nav>
    <div class="user-section">
      <svg class="account-icon" viewBox="0 0 24 24" width="24" height="24">
        <path fill="currentColor" d="M12 4a4 4 0 014 4 4 4 0 01-4 4 4 4 0 01-4-4 4 4 0 014-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4z"/>
      </svg>
      <h3>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h3>
      <button class="logout-btn" onclick="window.location.href='./database/logout.php'">Logout</button>
    </div>
  </header>

  <section class="awareness-section" id="awareness">
    <div class="awareness-wrapper">
      <h1>Be a Hero. Give the Gift of Life.</h1>
      <p>
        Every 9 minutes, another name is added to the organ transplant waiting list.
        With a simple decision to become an organ donor, you can save up to 8 lives
        and enhance the lives of more than 75 others through tissue donation.
      </p>

      <img src="./assets/donation10.jpeg" alt="Organ Donation Awareness">

      <h2>Why Organ Donation Matters</h2>
      <ul>
        <li>Over 100,000 people are currently waiting for a life-saving transplant.</li>
        <li>One donor can save multiple lives.</li>
        <li>Organ and tissue donations help restore health, independence, and hope.</li>
        <li>Donors are honored with the deepest gratitude by families and communities.</li>
      </ul>

      <h2>How You Can Help</h2>
      <ol>
        <li><strong>Register:</strong> Sign up as an organ donor through your national registry or local health department.</li>
        <li><strong>Share:</strong> Talk to your family and friends about your decision to be a donor.</li>
        <li><strong>Support:</strong> Volunteer with or donate to organizations promoting organ donation awareness.</li>
        <li><strong>Educate:</strong> Spread the facts, bust the myths, and encourage others to become life-savers.</li>
      </ol>

      <p>💚 <strong>Be remembered as a giver of life. Make a difference today.</strong></p>

      <a href="#register">Register as a Donor</a>
    </div>
  </section>
</body>
</html>