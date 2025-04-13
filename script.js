// Fetch and update donor count
function updateDonorCount() {
    fetch('./database/get_donor_count.php')
        .then(response => response.text())
        .then(count => {
            document.getElementById('donor-number').textContent = count;
        })
        .catch(error => console.error('Error fetching donor count:', error));
}

// Update on page load
document.addEventListener('DOMContentLoaded', updateDonorCount);

// Optional: Update every 5 minutes (300000 ms)
setInterval(updateDonorCount, 300000);