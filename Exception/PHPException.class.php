<?php
/**
 * The TheMysteryMarket/Exception namespace houses all the exception type objects and
 * the exception handler itself.
 */
namespace TheMysteryMarket\Exception
{
    /**
     * This is the basic exception wrapper class.
     */
    class PHPException extends \Exception
    {
        /** @var array|NULL $context This is the context the exception was thrown in. */
        private $context;

        /**
         * Construct for the basic exception.
         * @param string $message
         * @param int $code
         * @param string $file
         * @param int $line
         * @param array $context
         * @param null $previous
         */
        public function __construct(string $message, int $code, string $file, int $line, array $context, $previous = null)
        {
            parent::__construct($message, $code, $previous);
            $this->file = $file;
            $this->line = $line;
            $this->context = $context;
        }

        /**
         * Getter for exception context.
         * @return array
         */
        public function GetContext(): array
        {
            return $this->context;
        }
    }
}