<?php
/**
 * TheMysteryMarket\Log namespace is for all things related to error logging
 */
namespace TheMysteryMarket\Log
{
    /**
     * The Logger object is a simple interface to write log messages to date stamped files.
     * I plan to expand on this and switch to fopen in the future.
     */
    class Logger
    {
        /** @var string $fileName This is the last part of the log file name. */
        private static $fileName = "UncaughtException.log";

        /**
         * The Write method takes in a PHPException object then writes it to the correct log file.
         * @param \Exception $exception
         */
        public static function Write(\Throwable $exception): void
        {
            file_put_contents(
                __DIR__.DIRECTORY_SEPARATOR.@date('Y-m-d')."-".self::$fileName,
                @date('[d/M/Y:H:i:s]')."\n".print_r($exception, true)
            );
        }
    }
}