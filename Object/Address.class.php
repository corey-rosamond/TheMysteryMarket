<?php
/**
 * The Address object lives in TheMysteryMarket\Object namespace.
 */
namespace TheMysteryMarket\Object
{
    /**
     * The Address class is a container for both billing and shipping addresses.
     */
    class Address
    {
        /** @var $id Addresses should be stored in an address table this would be the id for this address in that table. */
        private $id;
        private $lineOne;
        private $lineTwo;
        private $city;
        private $state;
        private $zip;

    }
}