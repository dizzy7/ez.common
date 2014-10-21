<?php

if(!function_exists('custom_mail')){
    function custom_mail($to, $subject, $message, $additional_headers, $additional_parameters){
        $log = <<<TEXT
To: {$to}
Subject: {$subject}


{$message}

------------------------------------------------------------

TEXT;
        $file = fopen(__DIR__.'/../../../mail.log','a+');
        fwrite($file,$log);
        fclose($file);
    }
}