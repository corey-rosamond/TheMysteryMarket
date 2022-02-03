<?php
/**
 * This is the namespace that contains all the email template objects.
 */
namespace TheMysteryMarket\Email
{
    /**
     * Include the SendMail class and bring it into this namespace.
     */
    require_once("SendMail/SendMail.class.php");
    use TheMysteryMarket\SendMail\SendMail;

    /**
     * The EmailBase class will provide all common functionality for every email object.
     * This allows us to obfuscate the common and difficult tasks to a single file thus
     * allowing the Email objects to be very simple.
     */
    abstract class EmailBase
    {
        /** @var bool $debugMode This is a flag to allow putting the email sending process into debug mode. */
        protected $debugMode = false;
        /** @var string $receiverName This is the name of the person that will receive the email. */
        protected $receiverName;
        /** @var string $receiverAddress This is the email address of the person set to receive the email. */
        protected $receiverAddress;
        /** @var string $subject This is the email subject. */
        protected $subject;
        /** @var string $bodyHTML This is the html version of the email */
        protected $bodyHTML;
        /** @var string $bodyText This is the text version of the message this will be seen if the receiver has html disabled */
        protected $bodyText;

        /**
         * This method will turn debug mode on.
         * @return void
         */
        public function EnableDebugMode(): void
        {
            $this->debugMode = true;
        }

        /**
         * This method will return a true or false depending on if debug mode is enabled.
         * @return bool
         */
        public function InDebugMode(): bool
        {
            return $this->debugMode;
        }

        /**
         * This function sets the receiver name and returns itself.
         * @param string $receiverName
         * @return $this
         */
        public function SetReceiverName(string $receiverName): EmailBase
        {
            $this->receiverName = $receiverName;
            return $this;
        }

        /**
         * This method will return the receiver name as a string.
         * @return string
         */
        public function GetReceiverName(): string
        {
            return $this->receiverName;
        }

        /**
         * This method takes in the receiver address as a string updates the value and
         * returns this.
         * @param string $receiverAddress
         * @return $this
         */
        public function SetReceiverAddress(string $receiverAddress): EmailBase
        {
            $this->receiverAddress = $receiverAddress;
            return $this;
        }

        /**
         * This method will return the Receiver address as a string.
         * @return string
         */
        public function GetReceiverAddress(): string
        {
            return $this->receiverAddress;
        }

        /**
         * This method takes in a string that it then sets as the new email subject then
         * it will return the email object.
         * @param string $subject
         * @return $this
         */
        public function SetSubject(string $subject): EmailBase
        {
            $this->subject = $subject;
            return $this;
        }

        /**
         * This method will return the set email subject as a string.
         * @return string
         */
        public function GetSubject(): string
        {
            return $this->subject;
        }

        /**
         * This method accepts a string containing the html version of the message. It will
         * set the new value of html body and return the email object itself.
         * @param string $bodyHTML
         * @return $this
         */
        public function SetBodyHTML(string $bodyHTML): EmailBase
        {
            $this->bodyHTML = $bodyHTML;
            return $this;
        }

        /**
         * This method will return the HTML body of the message as a string.
         * @return string
         */
        public function GetBodyHTML(): string
        {
            return $this->bodyHTML;
        }

        /**
         * This method accepts a string that it will then update the text only version
         * of the email to. Then it will return the email object it was called from.
         * @param string $bodyText
         * @return $this
         */
        public function SetBodyText(string $bodyText): EmailBase
        {
            $this->bodyText = $bodyText;
            return $this;
        }

        /**
         * This method will return the text only version of the email as a string.
         * @return string
         */
        public function GetBodyText(): string
        {
            return $this->bodyText;
        }

        /**
         * This method will forward itself to the SendMail object via the SendMail::Send
         * method. This will result in the email being sent.
         */
        public function Send(): void
        {
            SendMail::Send($this);
        }
    }
}