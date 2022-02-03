<?php
/**
 * The SendMail namespace is intended for only tasks related to the sending of email.
 */
namespace TheMysteryMarket\SendMail
{
    /**
     * Include all the required PHPMailer class files and use the namespace.
     */
    require_once('PHPMailer/src/Exception.php');
    require_once('PHPMailer/src/PHPMailer.php');
    require_once('PHPMailer/src/SMTP.php');
    use PHPMailer\PHPMailer\PHPMailer;

    /**
     * Include the Email Configuration class and alias it as configuration.
     */
    require_once("Configuration/Email.class.php");
    use TheMysteryMarket\Configuration\Email as Configuration;

    /**
     * Include the EmailBase object and use its namespace.
     */
    require_once("Email/EmailBase.class.php");
    use TheMysteryMarket\Email\EmailBase;

    /**
     * The SendMail class is a static interface that allows for sending emails required for the site
     * by only passing in the values that will need to be populated.
     */
    class SendMail
    {
        /**
         * This method takes in an EmailBase object then uses that object to generate and
         * send the requested email content.
         * @param EmailBase $email
         */
        public static function Send(EmailBase $email): void
        {
            $mail = new PHPMailer(true);
            try {
                // Specify the SMTP settings.
                $mail->isSMTP();
                $mail->setFrom(
                    Configuration::$emailSenderAddress,
                    Configuration::$emailSenderName
                );
                $mail->Host       = Configuration::$smtpHost;
                $mail->Port       = Configuration::$smtpPort;
                $mail->Username   = Configuration::$smtpUsername;
                $mail->Password   = Configuration::$smtpPassword;
                $mail->SMTPAuth   = true;
                $mail->SMTPSecure = 'tls';

                $mail->SMTPDebug = $email->InDebugMode();
                //$mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

                // Specify the message recipients.
                $mail->addAddress($email->GetReceiverAddress());

                /** Construct the email. */
                $mail->isHTML(true);
                $mail->Subject    = $email->GetSubject();
                $mail->Body       = $email->GetBodyHTML();
                $mail->AltBody    = $email->GetBodyText();
                $mail->Send();
            } catch (\PHPMailer\PHPMailer\Exception $e) {
                /** @todo Add logging here */
                echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
            } catch (\Exception $e) {
                /** @todo Add logging here */
                echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
            }
        }
    }
}