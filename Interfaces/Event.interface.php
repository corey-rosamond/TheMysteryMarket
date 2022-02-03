<?php
/**
 * The interfaces namespace contains all the interfaces used.
 */
namespace TheMysteryMarket\Interfaces
{
    /**
     * This is the basic Event interface.
     */
    interface Event
    {
        /** Entry point for any event */
        public function run();
    }
}