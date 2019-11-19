<?php
    function sendMail($to, $message){
            ini_set( 'display_errors', 1 );
            error_reporting( E_ALL );
            $subject = "Banco Proyecto PHP";
            $headers = "From:" . "sheeva0710@gmail.com";
            mail($to,$subject,$message, $headers);
    }
?>