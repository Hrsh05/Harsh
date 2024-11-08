// payment-process.php

$userEmail = $_POST['userEmail'];  // Assume userEmail is collected from the frontend
$subject = "Payment Verification";
$message = "Please confirm your payment by clicking the link: [Confirmation Link]";
$headers = "From: no-reply@sciastra.com";

if (mail($userEmail, $subject, $message, $headers)) {
    echo "A verification email has been sent. Please check your inbox.";
    // You can then redirect the user to a confirmation page.
} else {
    echo "Failed to send verification email.";
}
