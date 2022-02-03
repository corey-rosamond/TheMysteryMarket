<?php
/**
 * The Customer object should live in TheMysteryMarket\Object namespace.
 */
namespace TheMysteryMarket\Object
{
    /**
     * The Customer object is a container for each individual customer's information. This will need to be expanded
     * when we allow customers to login and see previous orders and current order states.
     */
    class Customer
    {
        private $id;
        private $firstName;
        private $middleName;
        private $lastName;
        private $emailAddress;
        private $phoneNumber;
        /** @var Address $billingAddress */
        private $billingAddress;
        /** @var Address $shippingAddress */
        private $shippingAddress;
        private $orders;
    }
}