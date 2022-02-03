<?php
/**
 * The interfaces namespace contains all the interfaces used.
 */
namespace TheMysteryMarket\Interfaces
{
    /**
     * This is the basic factory interface.
     */
    interface Factory
    {
        /** This is the entry point for any function. */
        public static function build();
    }
}
