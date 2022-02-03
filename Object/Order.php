<?php
/**
 * The Order object should live in TheMysteryMarket\Object namespace.
 */
namespace TheMysteryMarket\Object
{
    /**
     * The order object is a representation of a single order.
     */
    class Order
    {
        /** @var int $id This is the order id in the order table. */
        private $id;
        /** @var int $customer this is the customer id the customer table. */
        private $customer;
        /** @var OrderState $state This is the order state it should be represented by the OrderState object. */
        private $state;
        /** @var Address $billing This is the billing address represented by the address object. */
        private $billing;
        /** @var Address $shipping This is the shipping address represented by the address object. */
        private $shipping;
        /** @var DateStamp $orderDate This is the date stamp represented by the date stamp object  */
        private $orderDate;
        /** @var DateStamp $shippingDate This is the date the order was shipped represented by the date stamp object. */
        private $shippingDate;
        /** @var DateStamp $deliveryDate This is the date the order was delivered represented by the date stamp object. */
        private $deliveryDate;
        /** @var DateStamp $cancelDate  This is the date the order was canceled represented by the date stamp object. */
        private $cancelDate;
        /** @var string $trackingNumber This is the tracking number string for shipping. */
        private $trackingNumber;
        /** @var array $products This is an array of product objects that were in this order. */
        private $products;

    }
}