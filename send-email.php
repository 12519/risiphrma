<?php
if(isset($_POST['submit'])) {
  $to = "your-email@example.com";
  $subject = "New resume submission from your website";
  $name = $_POST['name'];
  $email = $_POST['email'];
  
  // Get the uploaded resume file
  $resume = $_FILES['resume']['tmp_name'];
  $resume_name = $_FILES['resume']['name'];
  
  // Set the email content and attachment
  $message = "Name: $name \nEmail: $email \n\nPlease find attached the submitted resume.";
  $headers = "From: $email";
  $attachments = array($resume);
  
  // Send the email
  if(mail($to, $subject, $message, $headers, $attachments)) {
    echo "Resume sent successfully!";
  } else {
    echo "Error sending resume.";
  }
}
?>
