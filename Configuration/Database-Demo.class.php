<?php
/**
 * This is the configuration namespace it will contain all objects that contain configuration information.
 * @noinspection PhpMultipleClassDeclarationsInspection
 */
namespace TheMysteryMarket\Configuration
{
    /** Include the DatabaseConfiguration interface and use the namespace. */
    require_once("Interfaces/DatabaseConfiguration.interface.php");
    use TheMysteryMarket\Interfaces\DatabaseConfiguration;

    /**
     * This is the database configuration class.
     */
    class Database implements DatabaseConfiguration
    {
        /** @var string $host The host uri where the database is located. */
        public static $host = "127.0.0.1";
        /** @var int $port The port the database accepts communication on. */
        public static $port = 3306;
        /** @var string $username The username used when connecting to the database. */
        public static $username = "username";
        /** @var string $password The password used when connecting to the database. */
        public static $password = "password";
        /** @var string $database The name of the primary database. */
        public static $database = "DatabaseName";
    }
}