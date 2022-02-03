<?php
/**
 * The root namespace
 */
namespace TheMysteryMarket
{
    define("PAGE_LOCATION", "Page/Back-End/");
    define("EVENT_LOCATION", "Event/Back-End/");
    define("PAGE_NAMESPACE", "TheMysteryMarket\\Page\\BackEnd\\");
    define("HOME_PAGE", "Login");
    define("FOUR_ZERO_FOUR", "NotFound");
    define("FIVE_HUNDRED", "Error");
    /** Call session start here to make it always happen */
    session_start();
    /** Include the stack controller and use the namespace. */
    require_once("Controller/StackController.class.php");
    use TheMysteryMarket\Controller\StackController;
    new StackController();
}