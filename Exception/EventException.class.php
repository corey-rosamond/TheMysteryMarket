<?php
/**
 * The TheMysteryMarket/Exception namespace houses all the exception type objects and
 * the exception handler itself.
 */
namespace TheMysteryMarket\Exception
{
    /** Include the event interface and use the namespace. */
    require_once("Interfaces/Event.interface.php");
    use TheMysteryMarket\Interfaces\Event;

    /**
     * events assume success. If they fail, they will throw an eventException.
     * This will contain an error message, as well as a new
     * event to run in its place.
     *
     * The event exception is thrown within an event. It is then
     * caught in the event controller object. The alternate event
     * is then pulled from the exception, and passed to the new event.
     */
    class EventException extends \Exception
    {
        /** @var Event $event */
        private $event;

        /**
         * Basic constructor for event exceptions
         * @param string $message
         * @param Event $event
         * @param \Exception|null $previous
         */
        public function __construct(string $message, Event $event, \Exception $previous = null)
        {
            //We don't really need error codes at this point for eventExceptions.
            //Default them to 0
            parent::__construct($message, 0, $previous);
            $this->event = $event;
        }

        /**
         * Return the event object.
         * @return Event
         */
        public function GetEvent(): Event
        {
            return $this->event;
        }
    }
}