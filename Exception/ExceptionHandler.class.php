<?php
/**
 * The TheMysteryMarket/Exception namespace houses all the exception type objects and
 * the exception handler itself.
 */
namespace TheMysteryMarket\Exception
{
    /** Include all the basic exception objects. */
    require_once("PHPException.class.php");
    require_once("WarningException.class.php");
    require_once("NoticeException.class.php");

    /**
     * This is a very basic version of the exception handler. I plan to expand on this in the future.
     */
    class ExceptionHandler
    {
        /**
         * This is the construct for the Exception handler object. For now, it simply sets error reporting to E_ALL
         * then sets the error handler object.
         */
        public function __construct()
        {
            error_reporting(E_ALL);
            set_error_handler(array($this, 'HandleError'));
        }

        /**
         * This method is the basic version of the error handler.
         * @param int $code
         * @param string $message
         * @param string $file
         * @param int $line
         * @param array|null $context
         * @throws NoticeException
         * @throws PHPException
         * @throws WarningException
         */
        public function HandleError(int $code, string $message, string $file, int $line, array $context = NULL): void
        {
            switch($code)
            {
                case E_NOTICE:
                    throw new NoticeException($message, $code, $file, $line, $context);
                break;
                case E_WARNING:
                    throw new WarningException($message, $code, $file, $line, $context);
                break;
                default:
                    throw new PHPException($message, $code, $file, $line, $context);
            }
        }
    }
}