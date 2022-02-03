<?php
/**
 * This is the database query namespace.
 * @noinspection PhpMultipleClassDeclarationsInspection
 */
namespace TheMysteryMarket\Query
{
    /** Include the query class and use the namespace. */
    require_once("Database/Query.class.php");
    use TheMysteryMarket\Database\Query;
    /** Include the database class and use it as DatabaseConfiguration */
    require_once("Configuration/Database.class.php");
    use TheMysteryMarket\Configuration\Database as DatabaseConfiguration;
    use TheMysteryMarket\Exception\PDODatabaseException;
    use \PDO;

    /**
     * This is the Admin Get query object used to get an admin user information.
     */
    class AdminGet extends Query
    {
        /**
         * Basic constructor that passes in this DB configuration object.
         */
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        /**
         * This is the query method that will take in an admin's email address and return an associative array
         * of their user information.
         * @param string $emailAddress
         * @return mixed
         * @throws PDODatabaseException
         */
        public function Query(string $emailAddress)
        {
            $preparedStatement = $this->Prepare("
                SELECT 
                    `id`, 
                    `email_address`, 
                    `password_hash`,
                    `first_name`,
                    `last_name`
                FROM `Admins` 
                WHERE `email_address`=:emailAddress
            ");
            $preparedStatement->bindValue( ':emailAddress', $emailAddress, PDO::PARAM_STR );
            $this->Execute( $preparedStatement );
            return $preparedStatement->fetch(PDO::FETCH_ASSOC);
        }
    }
}