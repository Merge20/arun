document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const donationForm = document.getElementById('donation-form');
    const resetBtn = document.querySelector('.btn-reset');
    const allOrgansCheckbox = document.getElementById('all-organs');
    const individualOrganCheckboxes = document.querySelectorAll('input[name="organs"]:not(#all-organs)');
    const modal = document.getElementById('confirmation-modal');
    const closeModalBtn = document.querySelector('.close-modal');
    const closeBtn = document.querySelector('.btn-close');

    // Select all organs when "All organs and tissues" is checked
    allOrgansCheckbox.addEventListener('change', function() {
        individualOrganCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
            checkbox.disabled = this.checked;
        });
    });

    // Uncheck "All organs" if any individual organ is unchecked
    individualOrganCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                allOrgansCheckbox.checked = false;
            }
            
            // Check if all individual organs are checked
            const allChecked = Array.from(individualOrganCheckboxes).every(cb => cb.checked);
            allOrgansCheckbox.checked = allChecked;
        });
    });

    // Reset form
    resetBtn.addEventListener('click', function() {
        donationForm.reset();
        individualOrganCheckboxes.forEach(checkbox => {
            checkbox.disabled = false;
        });
    });

    // Form submission
    donationForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate at least one organ is selected
        const organsSelected = Array.from(document.querySelectorAll('input[name="organs"]:checked')).length > 0;
        if (!organsSelected) {
            alert('Please select at least one organ/tissue you wish to donate.');
            return;
        }
        
        // In a real application, you would send the data to a server here
        // For this example, we'll just show the confirmation modal
        modal.style.display = 'block';
        
        // Reset form after submission (in a real app, you might not want to do this immediately)
        donationForm.reset();
        individualOrganCheckboxes.forEach(checkbox => {
            checkbox.disabled = false;
        });
    });

    // Close modal
    function closeModal() {
        modal.style.display = 'none';
    }

    closeModalBtn.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);

    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Age verification based on date of birth
    const dobInput = document.getElementById('dob');
    dobInput.addEventListener('change', function() {
        const dob = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const monthDiff = today.getMonth() - dob.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        
        if (age < 18) {
            alert('You must be at least 18 years old to register as an organ donor.');
            this.value = '';
        }
    });
});