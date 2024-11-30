<?php
// Assuming you already have the total price from previous steps
$total_price = 1000; // Replace with actual total price

// Include the Stripe PHP library (if you use Composer, this is automatic)
require 'vendor/autoload.php'; // If using Composer

// Set your secret Stripe key
\Stripe\Stripe::setApiKey('YOUR_SECRET_KEY');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Proceed to Payment</h1>
    <p><strong>Total Price: ₹<?php echo $total_price; ?></strong></p>

    <form action="charge.php" method="POST" id="payment-form">
        <div>
            <label for="card-element">Credit or Debit Card</label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>

        <button type="submit">Pay Now</button>
    </form>

    <script>
        var stripe = Stripe('YOUR_PUBLIC_KEY');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Show error in the card element
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server
                    var token = result.token.id;
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'charge.php';

                    var hiddenTokenInput = document.createElement('input');
                    hiddenTokenInput.type = 'hidden';
                    hiddenTokenInput.name = 'stripeToken';
                    hiddenTokenInput.value = token;
                    form.appendChild(hiddenTokenInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
