<?php
/**
 * This is the namespace that contains all the email template objects.
 */
namespace TheMysteryMarket\Email
{
    /**
     * Include the abstract EmailBase class and import it into this namespace.
     */
    require_once("EmailBase.class.php");

    /**
     * The order received template is for notifying us that an order has been placed.
     */
    class OrderReceived extends EmailBase
    {
        /** These are placeholders for now. */
        private $orderNumber;
        private $orderDetailLink;

        /**
         * This is the basic constructor for the OrderReceived object. This still needs the real
         * content that will be sent but as of now construction and sending of an email works.
         */
        public function __construct()
        {
            $this->SetReceiverName("Corey Rosamond")
                ->SetReceiverAddress("corey@binary-solutions-llc.com")
                ->SetSubject("The Mystery Market: Order Received")
                ->SetBodyHTML("Order Received")
                ->SetBodyText("Order Received");
        }
    }
}