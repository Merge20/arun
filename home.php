<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ./database/login.php");
    exit();
}

require_once('./database/config.php');

$query = "SELECT COUNT(*) as donor_count FROM donors";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$donorCount = $row['donor_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>phoenix pulse</title>
  <link rel="stylesheet" href="./style/donation.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <header class="navbar">
    <div class="logo">phoenix pulse</div>
    <nav class="nav-links">
      <a class="active" href="/home.php">Home</a>
      <a href="/dregistration.php">Donate now</a>
      <a href="/faq.php">FAQs</a>
      <a href="/awareness.php">Awareness</a>
      <a href="#" class="donors-link">Donors (<span id="donor-number"><?php echo $donorCount; ?></span>)</a>
    </nav>
    <div class="user-section">
      <svg class="account-icon" viewBox="0 0 24 24" width="24" height="24">
        <path fill="currentColor" d="M12 4a4 4 0 014 4 4 4 0 01-4 4 4 4 0 01-4-4 4 4 0 014-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4z"/>
      </svg>
      <h3>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h3>
      <button class="logout-btn" onclick="window.location.href='./database/logout.php'">Logout</button>
    </div>
  </header>

  <section class="body">
    <div class="content">
      <h1>DONATE TO SAVE LIVES!</h1>
      <p>Take a minute to help those in need. Donate and become a donor.<br>Every registration counts.</p>
      <button class="signup-btn" onclick="window.location.href='/dregistration.php'">DONATE NOW</button>
    </div>
  </section>

  <section class="info-boxes">
    <div class="box pledge-box">
      <h2>Pledge to become a Donor!</h2>
      <p>More than 100,000 people are waiting for a lifesaving transplant. You can help.</p>
      <a href="/dregistration.php"><button class="pledge-btn">Pledge</button></a>
    </div>
    <div class="box">
      <img src="./assets/donation7.jpeg" alt="loading" class="circle-img">
      A person is added to the waiting list every 9 minutes.
    </div>
    <div class="box">
      <img src="./assets/donation8.png" alt="loading" class="circle-img">
      17 people die each day while waiting for an organ transplant.
    </div>
    <div class="box">
      <img src="./assets/donation.9.jpeg" alt="loading" class="circle-img">
      One organ, eye and tissue donor can save and heal more than 75 lives.
    </div>
  </section>
  <hr>
  <p id="footer">-----designed by ---------Arunkumar----------- ashishkumar---------------- ashishranjan--------</p>

  <script>
function updateDonorCount() {
    fetch('./database/get_donor_count.php')
        .then(response => response.text())
        .then(count => {
            document.getElementById('donor-number').textContent = count;
        });
}

updateDonorCount();
setInterval(updateDonorCount, 60000);
</script>
</body>
</html>