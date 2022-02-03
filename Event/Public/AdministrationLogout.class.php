<?php
/**
 * This is the base event namespace.
 */
namespace TheMysteryMarket\Event {

    /** Use the Event Interface namespace. */
    use TheMysteryMarket\Interfaces\Event;

    /**
     * This is the Administration logout event. This will destroy the session completely
     * then kick the user back to the login page.
     */
    class AdministrationLogout implements Event
    {
        /**
         * Default event run method.
         */
        public function run()
        {
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
            header("Location: index.php?page=Login");
        }
    }
}