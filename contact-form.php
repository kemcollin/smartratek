<?php
// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $name    = isset($_POST['con_name']) ? htmlspecialchars(trim($_POST['con_name'])) : '';
    $email   = isset($_POST['con_email']) ? filter_var(trim($_POST['con_email']), FILTER_SANITIZE_EMAIL) : '';
    $service = isset($_POST['Visiting']) ? htmlspecialchars(trim($_POST['Visiting'])) : '';
    $message = isset($_POST['con_message']) ? htmlspecialchars(trim($_POST['con_message'])) : '';

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Email settings
    $to      = "smartratek@gmail.com";  // Replace with your email address
    $subject = "New Service Inquiry from $name";

    // Build the email content
    $body  = "You have received a new inquiry from your website contact form.\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Service: $service\n\n";
    $body .= "Message:\n$message\n";

    // Build the email headers
    $headers  = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for contacting us. Your message has been sent successfully.";
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }
} else {
    // If form is not submitted via POST
    echo "Invalid request.";
}
?>
