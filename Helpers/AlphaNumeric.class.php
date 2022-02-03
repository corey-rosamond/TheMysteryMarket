<?php
/**
 * This is the helper object namespace.
 */
namespace TheMysteryMarket\Helper
{
    /** Include the AlphaNumericException and use the namespace. */
    require_once("Exception/AlphaNumericException.class.php");
    use TheMysteryMarket\Exception\AlphaNumericException;

    /**
     * The AlphaNumeric class is a helper object for verifying that a string is in
     * fact alphanumeric.
     */
    class AlphaNumeric
    {
        /** @var string $alnumString The string to be validated. */
        private $alnumString;

        /**
         * Constructor for the AlphaNumeric class.
         * @param $string
         * @throws AlphaNumericException
         */
        public function __construct($string)
        {
            if (ctype_alnum($string) === false)
                throw new AlphaNumericException('Data passed is not an alpha string.');

            //Set no matter what
            $this->alnumString = $string;
        }

        /**
         * Return the alnumString.
         * @return string
         */
        public function GetString(): string
        {
            return $this->alnumString;
        }
    }
}