<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';




function forgotPassword($data)
{

    try {

        $mail = new PHPMailer(true);



        $mail->SMTPDebug = false;

        $mail->isSMTP();

        // ENTER THE MAILING SERVER OF YOU HOSTING ex. smtp.google.com



        $mail->Host = 'smtp.hostinger.com';

        // IF SMTP AUTHENTICATION  IS ENABLED THEN YOU SHOULD USE THE USERNAME AND PASSWORD

        $mail->SMTPAuth = true;

        // SMTP SECURED MEANS EMAILS ARE SENT IN A SECURE WAY IF THE SMTP SECURE OPTIONS IS STARTTLS THEN THE PORT SHOULD BE 587. IF IT IS SSL THEN THE PORT SHOULD BE 465. IF IT IS NEITHER THE THE DEFAULT IS 25

        // ENTER THE SECURITY PROTOCAL EX SSL, TLS

        $mail->SMTPSecure = "ssl";


        // ENTER THE PROTOCAL PORT EX 465, 587, 25
        $mail->Port = 465;

        // ENTER ACCOUNTS USERNAME 
        $mail->Username = 'noreply@jawek.tn';

        // ENTER CORRESPONDING ACCOUNT EMAIL
        $mail->Password = 'K27kbAJ!?gPAr!P';


        // ENTER THE EMAIL THAT SHOULD SEND THE EMAILS. THIS SHOULD BE FROM THE SAME SERVER AS THE SMTP SERVER EX EXAMPLE@GMAIL.COM WILL HAVE  smpt.google.com as the SMTP SERVER
        $mail->setFrom("noreply@jawek.tn", 'Jawek.tn');



        // THIS IS THE EMAIL THAT SHOULD RECIEVE THE MESSAGES. CAN EVEN BE YOUR GMAIL
        $mail->addAddress($data[0], "");



        // THIS IS THE EMAIL THAT SHOULD RECIEVE THE MESSAGES. CAN EVEN BE YOUR GMAIL



        $mail->isHTML(true);

        $mail->Subject = ' ' . $data[1] . ' est votre code de recuperation de compte Jawek.tn';


        $mail->Body = '

       <!DOCTYPE html
           PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
       <html xmlns="http://www.w3.org/1999/xhtml">

       <head>
           <meta name="viewport" content="width=device-width" />
           <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
           <title>Melucian Sea moss</title>
           <style>
          
               /* -------------------------------------
		GLOBAL
------------------------------------- */
               * {
                   margin: 0;
                   padding: 0;
                   font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                   font-size: 100%;
                   line-height: 1.6;
               }

               img {
                   max-width: 100%;
               }

               body {
                   -webkit-font-smoothing: antialiased;
                   -webkit-text-size-adjust: none;
                   width: 100% !important;
                   height: 100%;
               }

               /* -------------------------------------
		ELEMENTS
------------------------------------- */
               a {
                   color: #348eda;
               }

               .btn-primary {
                   text-decoration: none;
                   color: #FFF;
                   background-color: #348eda;
                   border: solid #348eda;
                   border-width: 10px 20px;
                   line-height: 2;
                   font-weight: bold;
                   margin-right: 10px;
                   text-align: center;
                   cursor: pointer;
                   display: inline-block;
                   border-radius: 25px;
               }

               .btn-secondary {
                   text-decoration: none;
                   color: #FFF;
                   background-color: #aaa;
                   border: solid #aaa;
                   border-width: 10px 20px;
                   line-height: 2;
                   font-weight: bold;
                   margin-right: 10px;
                   text-align: center;
                   cursor: pointer;
                   display: inline-block;
                   border-radius: 25px;
               }

               .last {
                   margin-bottom: 0;
               }

               .first {
                   margin-top: 0;
               }

               .padding {
                   padding: 10px 0;
               }

               /* -------------------------------------
		BODY
------------------------------------- */
               table.body-wrap {
                   width: 100%;
                   padding: 20px;
               }

               table.body-wrap .container {
                   border: 1px solid #f0f0f0;
               }

               /* -------------------------------------
		FOOTER
------------------------------------- */
               table.footer-wrap {
                   width: 100%;
                   clear: both !important;
               }

               .footer-wrap .container p {
                   font-size: 12px;
                   color: #666;

               }

               table.footer-wrap a {
                   color: #999;
               }

               /* -------------------------------------
		TYPOGRAPHY
------------------------------------- */
               h1,
               h2,
               h3 {
                   font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
                   line-height: 1.1;
                   margin-bottom: 15px;
                   color: #000;
                   margin: 10px 0 10px;
                   padding: 10px 0;
                   line-height: 1.2;
                   font-weight: 200;
                   border-bottom: 1px solid #ccc;
               }

               h1 {
                   font-size: 36px;
               }

               h2 {
                   font-size: 28px;
               }

               h3 {
                   font-size: 22px;
               }

               p,
               ul,
               ol {
                   margin-bottom: 10px;
                   font-weight: normal;
                   font-size: 14px;
               }

               ul li,
               ol li {
                   margin-left: 5px;
                   list-style-position: inside;
               }

  
               /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
               .container {
                   display: block !important;
                   max-width: 600px !important;
                   margin: 0 auto !important;
                   /* makes it centered */
                   clear: both !important;
                   background: #FFFFFF;
                   border-radius: 15px;
               }

               /* Set the padding on the td rather than the div for Outlook compatibility */
               .body-wrap .container {
                   padding: 20px;
               }

               /* This should also be a block element, so that it will fill 100% of the .container */
               .content {
                   max-width: 600px;
                   margin: 0 auto;
                   display: block;
               }

             
               .content table {
                   width: 100%;
               }
           </style>
       </head>

       <body bgcolor="#f6f6f6">

           <!-- body -->
           <table class="body-wrap">
               <tr>
                   <td></td>
                   <td class="container">

                       <!-- content -->
                       <div class="content">
                           <table>
                               <tr>
                                   <p>Votre code de réinitialisation de mot de passe est :<h1>' . $data[1] . '</h1></p>
                               </tr>
                           </table>
                       </div>
                       <!-- /content -->

                   </td>
                   <td></td>
               </tr>
           </table>
           <!-- /body -->



       </body>

       </html>';

        //  FINALLY SEND THE EMAIL
        return $mail->send();
    } catch (Exception $e) {

        return $mail->ErrorInfo;
    }
}
