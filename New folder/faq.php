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
    <link rel="stylesheet" href="./style/pro.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="navbar">
        <div class="logo">phoenix pulse</div>
        <nav class="nav-links">
          <a href="/home.php">Home</a>
          <a href="/dregistration.php">Donate now</a>
          <a class="active" href="/faq.php">FAQs</a>
          <a href="/awareness.php">Awareness</a>
          <a href="#" class="donors-link" id="donors-count">Donors (<span id="donor-number">0</span>)</a>
        </nav>
        <div class="user-section">
          <svg class="account-icon" viewBox="0 0 24 24" width="24" height="24">
            <path fill="currentColor" d="M12 4a4 4 0 014 4 4 4 0 01-4 4 4 4 0 01-4-4 4 4 0 014-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4z"/>
          </svg>
          <h3>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h3>
          <button class="logout-btn" onclick="window.location.href='./database/logout.php'">Logout</button>
        </div>
      </header>
    <div class="faq-container">
        <h1>Frequently Asked Questions</h1>
        
        <div class="faq-item">
            <input type="checkbox" id="faq1" class="faq-toggle">
            <label for="faq1" class="faq-question">
                <h3>what is organ and tissue Donation?</h3>
                <span class="toggle-icon">+</span>
            </label>
            <div class="faq-answer">
                <p>Organ donation means that a person during his life time pledge that after his/her death, organ from his/her body to donate to a needy person. </p>
            </div>
        </div>
        
        <div class="faq-item">
            <input type="checkbox" id="faq2" class="faq-toggle">
            <label for="faq2" class="faq-question">
                <h3>who can donate?</h3>
                <span class="toggle-icon">+</span>
            </label>
            <div class="faq-answer">
                <p>any person not less than 18 years of age,who voluntarily authorizes the removal of any his organ and/or tissue.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <input type="checkbox" id="faq3" class="faq-toggle">
            <label for="faq3" class="faq-question">
                <h3>What is transpalation?</h3>
                <span class="toggle-icon">+</span>
            </label>
            <div class="faq-answer">
                <p>transpalation of human cell,tissue or organs saves many lives and restore essential functions where no altrnatives.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <input type="checkbox" id="faq4" class="faq-toggle">
            <label for="faq4" class="faq-question">
                <h3>Will my family be charged for donating my organs?</h3>
                <span class="toggle-icon">+</span>
            </label>
            <div class="faq-answer">
                <p>No, there is no cost to the donor's family for organ or tissue donation.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <input type="checkbox" id="faq5" class="faq-toggle">
            <label for="faq5" class="faq-question">
                <h3> What organs can be donated?</h3>
                <span class="toggle-icon">+</span>
            </label>
            <div class="faq-answer">
                <p>Organs that can be donated include the heart, kidneys, liver, lungs, pancreas, and intestines. Tissues such as corneas, skin, bone, and heart valves can also be donated.</p>
            </div>
        </div>

        <div class="faq-item">
            <input type="checkbox" id="faq6" class="faq-toggle">
            <label for="faq6" class="faq-question">
                <h3>  Can I donate an organ while I'm alive?</h3>
                <span class="toggle-icon">+</span>
            </label>
            <div class="faq-answer">
                <p>Yes, living donors can donate a kidney, a portion of the liver, or bone marrow. This is done through medical procedures that are safe and carefully monitored.</p>
            </div>
        </div>

        <div class="faq-item">
            <input type="checkbox" id="faq7" class="faq-toggle">
            <label for="faq7" class="faq-question">
                <h3>  How do I know if my organs are suitable for donation?</h3>
                <span class="toggle-icon">+</span>
            </label>
            <div class="faq-answer">
                <p>If you choose to become an organ donor, your health will be evaluated at the time of your death. Only organs that are healthy and functional can be donated.</p>
            </div>
        </div>
    </div>
    
    <script>
    // Auto-refresh donor count every 60 seconds
    function updateDonorCount() {
        fetch('./database/get_donor_count.php')
            .then(response => response.text())
            .then(count => {
                document.getElementById('donor-number').textContent = count;
            });
    }

    // Update on page load and every 60 seconds
    updateDonorCount();
    setInterval(updateDonorCount, 60000);
    </script>
</body>
</html>