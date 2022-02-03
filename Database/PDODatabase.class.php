<?php
/**
 * This is the database namespace.
 * @noinspection PhpMultipleClassDeclarationsInspection
 */
namespace TheMysteryMarket\Database
{
    /** Include the database configuration object and use the namespace. */
    require_once("Configuration/Database.class.php");
    use TheMysteryMarket\Configuration\Database as DBConfiguration;
    /** Include the PDODatabase exception class and use the namespace. */
    require_once("Exception/PDODatabaseException.class.php");
    use TheMysteryMarket\Exception\PDODatabaseException;
    /** Use the PDO namespace. */
    use PDO;
    /**
     * The PDODatabase class is in charge of managing all database connections and
     * configuration objects.
     */
    class PDODatabase
    {
        /** @var PDODatabase $instance This is the static PDODatabase instance. */
        private static $instance;
        /** @var DBConfiguration[] $configurations  */
        private $configurations = [];
        /** @var PDO[] $databases Array of database connections. */
        private $databases = [];

        /**
         * This method will check if an instance of this object exists. If it does not it will create it.
         * @return PDODatabase
         */
        public static function GetInstance(): PDODatabase
        {
            if(!isset(self::$instance))
            {
                self::$instance = new PDODatabase();
            }
            return self::$instance;
        }

        /**
         * Store the configuration object if it is not already. Create a new PDO database connection
         * if one does not already exist. Set error mode to exceptions. Disable emulate prepares.
         * Then return the requested PDO database connection object.
         * @param DBConfiguration $dbConfiguration
         * @return PDO
         */
        public function Connect(DBConfiguration $dbConfiguration): PDO
        {
            /** Check if we have this database configuration stored */
            if(!array_key_exists($dbConfiguration::$name, $this->configurations))
            {
                /** Add this configuration object to the array. */
                $this->configurations[$dbConfiguration::$name] = $dbConfiguration;
            }
            /** Check if the PDO object already exists */
            if(array_key_exists($dbConfiguration::$name, $this->databases))
            {
                /** Return the already created object we are done. */
                return $this->databases[$dbConfiguration::$name];
            }
            /** Create a new pdo database object and add it to the collection. */
            $this->databases[$dbConfiguration::$name] = new PDO(
                $dbConfiguration::type .
                ':host=' . $dbConfiguration::$host .
                ';port=' . $dbConfiguration::$port .
                ';dbname=' . $dbConfiguration::$name,
                $dbConfiguration::$username,
                $dbConfiguration::$password
            );
            //Tell the handle to throw exceptions
            $this->databases[$dbConfiguration::$name]->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            $this->databases[$dbConfiguration::$name]->setAttribute(
                PDO::ATTR_EMULATE_PREPARES,
                false
            );
            /** Return the database configuration. */
            return $this->databases[$dbConfiguration::$name];
        }

        /**
         * Clear the database connection object from the collection or throw an exception if it does not exist.
         * @param DBConfiguration $dbConfiguration
         * @throws PDODatabaseException
         */
        public function ResetConnection(DBConfiguration $dbConfiguration): void
        {
            /** Make sure this database connection exists. */
            if(!isset($this->databases[$dbConfiguration::$name]))
            {
                /** Throw an exception this connection does not exist. */
                throw new PDOdatabaseException('Database connection defined does not exist', 2);
            }
            /** Unset the database connect in the collection */
            unset($this->databases[$dbConfiguration::$name]);
        }
    }
}