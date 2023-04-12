<?php
// Define the recipient email address
$to_email = "angadalagopiprasad@gmail.com";

// Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Get the resume file
$resume_file = $_FILES['resume']['tmp_name'];
$resume_name = $_FILES['resume']['name'];

// Set up the email headers
$headers = "From: $name <$email>" . "\r\n";
$headers .= "Reply-To: $email" . "\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=" . uniqid(rand(), true) . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Set up the email body
$body = "--" . uniqid(rand(), true) . "\r\n";
$body .= "Content-Type: text/plain; charset=UTF-8\r\n";
$body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
$body .= "Name: $name\n";
$body .= "Email: $email\n";
$body .= "Message:\n$message\n\n";
$body .= "--" . uniqid(rand(), true) . "\r\n";
$body .= "Content-Type: application/octet-stream; name=\"$resume_name\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n";
$body .= "Content-Disposition: attachment; filename=\"$resume_name\"\r\n\r\n";
$body .= chunk_split(base64_encode(file_get_contents($resume_file))) . "\r\n";
$body .= "--" . uniqid(rand(), true) . "--";

// Send the email
if (mail($to_email, "New Resume Submission", $body, $headers)) {
  echo "Email sent successfully!";
} else {
  echo "Error sending email.";
}
?>
