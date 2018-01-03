<?php
     $to      = 'antsiresy2@gmail.com';
     $subject = 'Test PHP';
     $message = 'Bonjour !';
     $headers = 'From: antsiresy@gmail.com' . "\r\n" .
     'Reply-To: antsiresy@gmail.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     mail($to, $subject, $message, $headers);
 ?>