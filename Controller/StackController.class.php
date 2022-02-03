<?php
/**
 * This is the controller namespace.
 */
namespace TheMysteryMarket\Controller
{
    /** Include the ExceptionHandler class and use it and the base PHPException. */
    require_once("Exception/ExceptionHandler.class.php");
    use TheMysteryMarket\Exception\ExceptionHandler;
    /** Include the Logger class and use the namespace. */
    require_once("Log/Logger.class.php");
    use TheMysteryMarket\Log\Logger;
    /** Include the Event controller and use the namespace. */
    require_once("Controller/EventController.class.php");
    use TheMysteryMarket\Controller\EventController;
    /** Include the AlphaNumeric helper object and use the namespace. */
    require_once("Helpers/AlphaNumeric.class.php");
    use TheMysteryMarket\Helper\AlphaNumeric;
    /** Include the factory interface and use the namespace. */
    require_once("Interfaces/Factory.interface.php");
    use TheMysteryMarket\Interfaces\Factory;
    /** Include the Event Interface and use the namespace */
    require_once("Interfaces/Event.interface.php");
    use TheMysteryMarket\Interfaces\Event;
    /** Include the Event factory and use the namespace. */
    require_once('Factory/EventFactory.class.php');
    use TheMysteryMarket\Factory\EventFactory;


    /**
     * This is the StackController.
     */
    class StackController
    {
        /**
         * Constructor
         */
        public function __construct()
        {
            /** Initialize the exception handler. */
            new ExceptionHandler();
            try{
                /** Construct the Event factory */
                $eventController = new EventController();

                /** @var array $requestArray Create an array of default values */
                $requestArray = array('event' => 'Render', 'type' => 'output');
                /** @var Factory $factory */
                $factory = self::GetFactory(new AlphaNumeric('EventFactory'));
                $requestArray = array_replace($requestArray, array_intersect_key($_GET, $requestArray));
                /** @var Event $event This is the event that will need to run. */
                $event = $factory::Build('Public', $requestArray['event']);
                $eventController->run($event);

                /** Any exceptions that reach this point should be considered uncaught and logged. */
            } catch (\Exception $exception)
            {
                /** Write the exception to the log. */
                Logger::Write($exception);
                /** Build the error page render event and run it. */
                $eventClass = EventFactory::Build("Public", "Render");
                $eventClass->run(['page'=> 'Error']);
            }
            catch (\Error $exception)
            {
                /** Write the exception to the log. */
                Logger::Write($exception);
                /** Build the error page render event and run it. */
                $eventClass = EventFactory::Build("Public", "Render");
                $eventClass->run(['page'=> 'Error']);
            }

        }

        /**
         * Get A Factory.
         * @param AlphaNumeric $string
         * @return string
         */
        public static function GetFactory(AlphaNumeric $string): string
        {
            $factory_name = $string->GetString();
            include_once('Factory/'.$factory_name.'.class.php');
            return "TheMysteryMarket\\Factory\\".$factory_name;
        }
    }
}