// JavaScript function to calculate total price
function calculateTotalPrice() {
    try {
        // Get all quantity input fields
        var quantityInputs = document.querySelectorAll('.qty');
        
        // Loop through each input field
        quantityInputs.forEach(function(input) {
            // Attach event listener
            input.addEventListener('input', function() {
                // Get the unit price from the hidden input field
                var unitPrice = parseFloat(input.parentElement.querySelector('.unit-price').value);
                
                // Calculate total price
                var totalPrice = unitPrice * input.value;
                
                // Display total price
                input.parentNode.nextElementSibling.querySelector('span:nth-child(1)').textContent = totalPrice;
            });
        });
    } catch (error) {
        console.error('An error occurred:', error);
    }
 }
 
 // Call the function when the page loads
 window.addEventListener('load', calculateTotalPrice);