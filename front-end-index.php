<?php

/**
 * The root namespace
 */
namespace TheMysteryMarket
{
    session_start();
    define("PAGE_LOCATION", "Page/Front-End/");
    define("EVENT_LOCATION", "Event/Front-End/");
    define("PAGE_NAMESPACE", "TheMysteryMarket\\Page\\FrontEnd\\");
    define("HOME_PAGE", "Lander");
    define("FOUR_ZERO_FOUR", "NotFound");
    define("FIVE_HUNDRED", "Error");
    /** Include the stack controller and use the namespace. */
    require_once("Controller/StackController.class.php");
    use TheMysteryMarket\Controller\StackController;
    new StackController();
}