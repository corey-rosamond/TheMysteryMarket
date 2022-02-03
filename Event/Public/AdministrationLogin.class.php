<?php
/**
 * This is the base event namespace.
 */
namespace TheMysteryMarket\Event
{
    /** Use the PDO exception namespace. */
    use TheMysteryMarket\Exception\PDODatabaseException;
    /** Use the Event Interface namespace. */
    use TheMysteryMarket\Interfaces\Event;
    /** Require the event factory and import the namespace */
    require_once("Factory/EventFactory.class.php");
    use TheMysteryMarket\Factory\EventFactory;
    /** Require the Admin Emails exist query and namespace. */
    require_once("Query/AdminEmailExists.query.php");
    use TheMysteryMarket\Query\AdminEmailExists;
    /** Require the AdminGet query and use the namespace. */
    require_once("Query/AdminGet.query.php");
    use TheMysteryMarket\Query\AdminGet;

    /**
     * This is the Administration login event. This will handle logging an admin in.
     */
    class AdministrationLogin implements Event
    {
        /**
         * Default event run method.
         * @return bool
         * @throws PDODatabaseException
         */
        public function run(): bool
        {
            /** Make sure someone is not trying to use this event directly. */
            if(!isset($_POST['email'])||!isset($_POST['password']))
            {
                /** No post information means error so redirect to the error page. */
                $eventClass = EventFactory::Build("Public", "Render");
                $eventClass->run(['page'=> 'Error']);
                return false;
            }
            $errors = $this->TestSubmittedData();
            /** See if we have encountered errors */
            if(sizeof($errors) > 0)
            {
                /** Send them back to the login page. */
                $this->SendBackToLogin($errors);
                return false;
            }
            /** Verify this user even exists. */
            if(!(new AdminEmailExists())->Query($_POST['email']))
            {
                /** If this user does not exist send them back to the login page and just say it is a bad combination. */
                array_push($errors, "Incorrect username and password combination!");
                $this->SendBackToLogin($errors);
                return false;
            }
            /** @var array $userData This is an array of the userdata associated with this email address. */
            $userData = (new AdminGet())->Query($_POST['email']);
            /** Test if the password matches the hash in the database */
            if(!password_verify($_POST['password'], $userData['password_hash']))
            {
                /** Wrong password for user add error and redirect back to login page */
                array_push($errors, "Incorrect username and password combination!");
                $this->SendBackToLogin($errors);
                return false;
            }
            /** Set the user data. */
            $_SESSION['UserData'] = $userData;
            header("Location: index.php?page=Dashboard");
            return true;
        }

        /**
         * Kick the user back to the login page event and pass on an array of errors.
         * @param array $errors
         */
        private function SendBackToLogin(array $errors): void
        {
            $eventClass = EventFactory::Build("Public", "Render");
            $eventClass->run(['page'=> 'Login', 'errors' => $errors]);
        }

        /**
         * Test the data that was submitted and return an array of errors. If no errors the array is empty.
         * @return array
         */
        private function TestSubmittedData(): array
        {
            $errors = [];
            if($_POST['email']=="")
            {
                array_push($errors, "Email Address can not be blank!");
            }

            if($_POST['password']=="")
            {
                array_push($errors, "Password can not be blank!");
            }
            return $errors;
        }
    }
}