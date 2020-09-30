<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php_mailer/src/Exception.php';
require 'php_mailer/src/PHPMailer.php';
require 'php_mailer/src/SMTP.php';


require "connection.php";

header("Content-type: application/json");
$code = 404;
$data = null;

if(isset($_POST['btnContact'])) {
    $ime = $_POST['name'];
    $poruka = $_POST['message'];
    $email = $_POST['email'];

    $errors = [];

    $reIme = "/^[A-Z][a-z]{2,15}$/";

    if(!$ime) {
        array_push($errors, "Polje za ime je obavezno.");
    } elseif(!preg_match($reIme, $ime)) {
        array_push($errors, "Polje za ime je nije dobrog formata.");
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email adresa nije u dobrom formatu.");
    }

    if(count($errors)) {
        var_dump($errors);
    } else {
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    //Server settings
                    //$mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'mradivojevic37@gmail.com';                 // SMTP username
                    $mail->Password = 'nemanjaVIDIC15';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                 // TCP port to connect to

                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );

                    //Recipients
                    $mail->setFrom('mradivojevic37@gmail.com', 'Poruka sa sajta');
                    $mail->addAddress("mradivoje97@gmail.com");     // Add a recipient

                    //Content
                    $mail->isHTML(false);                                  // Set email format to HTML
                    $mail->Subject = 'Poruka sa sajta';
                    $mail->Body    = $poruka;

                    $rez = $mail->send();
                    if($rez){
                        $code=201;
                        $data="Uspesno poslata poruka";
                    }else{
                        $code=500;
                        $data="Poruka nije poslata";
                    }
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    $code=422;
                    $data = 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
                }
            }

    }
    http_response_code($code);
    echo json_encode($data);