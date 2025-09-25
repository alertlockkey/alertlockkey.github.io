<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['demo-name'];
    $email = $_POST['demo-email'];
    $category = $_POST['demo-category'];
    $priority = $_POST['demo-priority'];
    $message = $_POST['demo-message'];
    $copy = isset($_POST['demo-copy']) ? 'Yes' : 'No';
    $human = isset($_POST['demo-human']) ? 'Yes' : 'No';

    // Set the recipient email address
    $to = "tim@alertlock.net";

    // Set the email subject
    $subject = "New Contact Form Submission";

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Category: $category\n";
    $email_content .= "Priority: $priority\n";
    $email_content .= "Copy requested: $copy\n";
    $email_content .= "Human verification: $human\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers
    $headers = "From: $email";

    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        // Redirect to a thank-you page
        header("Location: contact.html");
    } else {
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }
} else {
    echo "There was a problem with your submission, please try again.";
}
?>
