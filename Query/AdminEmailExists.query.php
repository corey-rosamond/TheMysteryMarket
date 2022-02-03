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
     * This is the AdminEmailExists query to check if a admin email address exists in the system.
     */
    class AdminEmailExists extends Query
    {
        /**
         * Basic constructor that passes in the right database configuration object.
         */
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        /**
         * This method takes in an email address and returns true if the email address exists in the admins
         * table and false if it does not.
         * @param string $emailAddress
         * @return bool
         * @throws PDODatabaseException
         */
        public function Query(string $emailAddress): bool
        {
            $preparedStatement = $this->Prepare(
                "SELECT COUNT(`id`) as total FROM `Admins` WHERE email_address=:emailAddress"
            );
            $preparedStatement->bindValue( ':emailAddress', $emailAddress, PDO::PARAM_STR );
            $this->Execute( $preparedStatement );
            $result = $preparedStatement->fetch(PDO::FETCH_ASSOC);
            if($result['total'] == 0)
            {
                return false;
            }
            return true;
        }
    }
}