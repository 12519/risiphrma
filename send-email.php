<?php
if(isset($_POST['submit'])) {
    $to = "angadalagopiprasad@gmail.com";
    $from = $_POST['email'];
    $name = $_POST['name'];
    $subject = "New Resume Submission from $name";
    $message = "A new resume has been submitted by $name. Please find the attached resume.";
    $file = $_FILES['resume']['tmp_name'];
    $filename = $_FILES['resume']['name'];
    $filetype = $_FILES['resume']['type'];
    $filesize = $_FILES['resume']['size'];

    $attachment = chunk_split(base64_encode(file_get_contents($file)));

    $boundary = md5(time());

    $headers = "From: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

    $message = "--$boundary\r\n";
    $message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $message .= "$message\r\n";

    $message .= "--$boundary\r\n";
    $message .= "Content-Type: $filetype; name=\"$filename\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; filename=\"$filename\"\r\n\r\n";
    $message .= "$attachment\r\n";
    $message .= "--$boundary--";

    mail($to, $subject, $message, $headers);

    echo "Thank you for submitting your resume. We will contact you soon.";
}
?>
