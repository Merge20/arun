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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organ Donation Registration</title>
    <link rel="stylesheet" href="./style/styled.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="navbar">
        <div class="logo">phoenix pulse</div>
        <nav class="nav-links">
          <a href="/home.php">Home</a>
          <a class="active" href="/dregistration.php">Donate now</a>
          <a href="/faq.php">FAQs</a>
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
    <div class="container">
        <header>
            <h1><i class="fas fa-heartbeat"></i> Organ Donation Registration</h1>
            <p>Your decision to donate organs can save up to 8 lives👨‍👩‍👧‍👦. Thank you for considering this noble act.</p>
        </header>

        <main>
            <form id="donation-form" action="./database/save_donation.php" method="POST">
                <div class="form-section">
                    <h2>Personal Information</h2>
                    <div class="form-group">
                        <label for="full-name">Full Name*</label>
                        <input type="text" id="full-name" name="full_name" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="dob">Date of Birth*</label>
                            <input type="date" id="dob" name="dob" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender*</label>
                            <select id="gender" name="gender" required>
                                <option value="">Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="prefer-not-to-say">Prefer not to say</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address*</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number*</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="blood-type">Blood Type</label>
                            <select id="blood-type" name="blood_type">
                                <option value="">Unknown</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h2>Donation Preferences</h2>
                    <div class="form-group">
                        <label>I wish to donate the following organs/tissues:</label>
                        <div class="checkbox-group">
                            <label><input type="checkbox" name="organs[]" value="heart"> Heart</label>
                            <label><input type="checkbox" name="organs[]" value="lungs"> Lungs</label>
                            <label><input type="checkbox" name="organs[]" value="liver"> Liver</label>
                            <label><input type="checkbox" name="organs[]" value="kidneys"> Kidneys</label>
                            <label><input type="checkbox" name="organs[]" value="pancreas"> Pancreas</label>
                            <label><input type="checkbox" name="organs[]" value="intestines"> Intestines</label>
                            <label><input type="checkbox" name="organs[]" value="corneas"> Corneas</label>
                            <label><input type="checkbox" name="organs[]" value="skin"> Skin</label>
                            <label><input type="checkbox" name="organs[]" value="bone"> Bone</label>
                            <label><input type="checkbox" name="organs[]" value="all" id="all-organs"> All organs and tissues</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="donation-type">Donation Type*</label>
                        <select id="donation-type" name="donation_type" required>
                            <option value="">Select</option>
                            <option value="living">Living Donation (e.g., kidney, liver lobe)</option>
                            <option value="deceased">Deceased Donation (after death)</option>
                        </select>
                    </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Donate</button>
                    <button type="button" class="btn-reset">Reset Form</button>
                </div>
            </form>
        </main>

        <footer>
            <p>For more information about organ donation, please visit <a href="./faq.php">our FAQ page</a>.</p>
            <p class="copyright">&copy; 2025 National Organ Donation Registry. All rights reserved.</p>
        </footer>
    </div>

    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="modal-icon">
                <i class="fas fa-heart"></i>
            </div>
            <h2>Thank You for Registering!</h2>
            <p>Your organ donor registration has been successfully submitted.</p>
            <p>We will send a confirmation email with your donor card and additional information.</p>
            <button class="btn-close">Close</button>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Show modal if success
        if (window.location.search.includes('success=true')) {
            document.getElementById("confirmation-modal").style.display = "block";
            
            // Clear the form
            document.getElementById("donation-form").reset();
            
            // Remove the success parameter from URL
            history.replaceState({}, document.title, window.location.pathname);
        }
        
        // Handle error if present
        if (window.location.search.includes('error=')) {
            const urlParams = new URLSearchParams(window.location.search);
            const errorMsg = urlParams.get('error');
            alert("Error: " + errorMsg);
            
            // Remove the error parameter from URL
            history.replaceState({}, document.title, window.location.pathname);
        }
        
        // Close modal handlers
        document.querySelector(".close-modal").addEventListener("click", function() {
            document.getElementById("confirmation-modal").style.display = "none";
        });
        
        document.querySelector(".btn-close").addEventListener("click", function() {
            document.getElementById("confirmation-modal").style.display = "none";
        });
        
        // "All organs" checkbox functionality
        document.getElementById("all-organs").addEventListener("change", function() {
            const checkboxes = document.querySelectorAll('input[name="organs"]:not(#all-organs)');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
        
        // Reset form button
        document.querySelector(".btn-reset").addEventListener("click", function() {
            document.getElementById("donation-form").reset();
        });
    });

    // Handle "All organs" checkbox
    document.getElementById('all-organs').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="organs[]"]:not(#all-organs)');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
<script src="script.js"></script>
</body>
</html>