<?php
/**
 * This is the factory namespace.
 */
namespace TheMysteryMarket\Factory
{
    /** Include the Factory interface and namespace. */
    require_once("Interfaces/Factory.interface.php");

    use TheMysteryMarket\Interfaces\Event;
    use TheMysteryMarket\Interfaces\Factory;
    /** Include the AlphaNumeric class and use the namespace.  */
    require_once("Helpers/AlphaNumeric.class.php");
    use TheMysteryMarket\Helper\AlphaNumeric;
    /** Include AlphNumericException and use the namespace. */
    require_once("Exception/AlphaNumericException.class.php");
    use TheMysteryMarket\Exception\AlphaNumericException;
    /** Include the PHPWarningException and use the namespace. */
    require_once("Exception/WarningException.class.php");
    use TheMysteryMarket\Exception\WarningException;

    /**
     * This is the basic event factory
     */
    class EventFactory implements Factory
    {

        /**
         * Build the event object.
         * @param string $raw_type
         * @param string $raw_name
         * @return mixed|Event
         */
        public static function Build(string $raw_type = 'Public', string $raw_name = 'Render')
        {
            /**
             * Let's build our filename. If this throws an exception, the request
             * is malformed in some way.
             */
            try {
                $event_string = new AlphaNumeric($raw_name);

                $type = new AlphaNumeric($raw_type);
            } //If we catch an exception we want to build a different event
            catch (AlphaNumericException $exception) {
                return self::BuildErrorPageEvent(400);
            }
            $filename = sprintf(
                'Event/%s/%s.class.php',
                $type->GetString(),
                $event_string->GetString()
            );
            //Now we try to include our event object
            try {
                require_once($filename);
            } //If we catch a warning exception, return a renderPage 404 event
            catch (WarningException $exception) {
                return self::BuildErrorPageEvent(404);
            }

            $string = $event_string->getString();
            $event_class = "TheMysteryMarket\\Event\\".$event_string->getString();
            //If we made it this far, everything is sanitary, return the built object
            return new $event_class();
        }

        /**
         * Build the error page event.
         * @param int $errorCode
         * @return Event
         */
        private static function BuildErrorPageEvent(int $errorCode): Event
        {
            $renderPageEvent = self::Build();
            $renderPageEvent->SetType('error');
            $renderPageEvent->SetPage('c' . $errorCode);
            return $renderPageEvent;
        }
    }
}