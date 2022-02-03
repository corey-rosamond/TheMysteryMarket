<?php
/**
 * The TheMysteryMarket/Exception namespace houses all the exception type objects and
 * the exception handler itself.
 */
namespace TheMysteryMarket\Exception
{
    /** Include the base PHPException */
    require_once("PHPException.class.php");

    /**
     * PHP Warning version of the PHPException.
     */
    class WarningException extends PHPException
    {}
}