<?php
/**
 * This is the controller namespace.
 */
namespace TheMysteryMarket\Controller
{
    /** Include the event exception class and use the namespace. */
    require_once("Exception/EventException.class.php");
    use TheMysteryMarket\Exception\EventException;
    /** Include the event interface and use the namespace. */
    require_once("Interfaces/Event.interface.php");
    use TheMysteryMarket\Interfaces\Event;

    /**
     * This class is the main event controller for agileStack.
     * It is the layer of the application stack that controls the flow of events
     * in agileStack.
     */
    class EventController
    {

        /**
         * This function will attempt to run an event. Since we are the event controller,
         * we only care about eventExceptions. We ignore all others.
         *
         * eventException object contain an event to run in the case of an event failure.
         * Upon failure, events should throw an eventException. We want to run the event
         * encapsulated within.
         *
         * It is possible that this function creates an endless loop if the event inside
         * the eventException also throws an eventException every time. In that case,
         * fix your code.
         * @param Event $event
         * @return mixed
         */
        public static function run(Event $event)
        {
            try {
                return $event->run();
            }
            catch (EventException $exception){
                $event = $exception->GetEvent();
                return self::run($event);
            }
        }
    }
}