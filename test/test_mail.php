<?php
     $to      = 'antsiresy2@gmail.com';
     $subject = 'Test PHP';
     $message = 'Bonjour !';
     $headers = 'From: antsiresy@gmail.com' . "\r\n" .
     'Reply-To: antsiresy@gmail.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

//      mail($to, $subject, $message, $headers);
     
     
     $CR_Mail = TRUE;
     
     $CR_Mail = @mail ($to, $subject, $message, $headers);
     
     if ($CR_Mail === FALSE)   echo " ### CR_Mail=$CR_Mail - Erreur envoi mail <br> \n";
     else                      echo " *** CR_Mail=$CR_Mail - Mail envoyé<br> \n";
      
 ?>