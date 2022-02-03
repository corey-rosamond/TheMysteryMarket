<?php
/**
 * This is the configuration namespace it will contain all objects that contain configuration information.
 */
namespace TheMysteryMarket\Configuration
{
    /**
     * This is the email configuration class. It will contain all information required for the sending of emails.
     */
    class Email
    {
        /** @var string $smtpHost SMTP host of the server that will be sending site mail. */
        public static $smtpHost = "email-smtp.us-west-2.amazonaws.com";
        /** @var int $smtpPort The port the SMTP server accepts communication on. */
        public static $smtpPort = 587;
        /** @var string $smtpUsername The smtp username NOT the email username */
        public static $smtpUsername = "username";
        /** @var string $smtpPassword The smtp password NOT the email password */
        public static $smtpPassword = "password";
        /** @var string $emailSenderAddress The email address that these emails will be coming from. */
        public static $emailSenderAddress = "from@site.com";
        /** @var string $emailSenderName The name to be show for the address sending the emails. */
        public static $emailSenderName = "Cool Guy";
        /** @var string $noticeEmailAddress The email address of the person to receive any site notice emails. */
        public static $noticeEmailAddress = "notice@address.com";
        /** @var string $noticeEmailName The name of the person that will be receiving the notice emails. */
        public static $noticeEmailName = "John Doe";
    }
}