<?php
class MailService {
  public function sendMail($email, $subject, $message) {
    $headers = 'From: Movie Archivator <no-reply@mats-andresen.de>' . "\r\n";
    $headers .= 'Reply-To: no-reply@mats-andresen.de' . "\r\n" .
    $headers .= 'X-Mailer: PHP/' . phpversion();
    mail($email, $subject, $message, $headers);
  }
}
?>
