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
     * This is the Admin Get Users query object.
     */
    class AdminGetUsers extends Query
    {
        /**
         * Basic constructor that passes in this DB configuration object.
         */
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        /**
         * This method will return an array of all admin users and their basic information.
         * @return mixed
         * @throws PDODatabaseException
         */
        public function Query()
        {
            $preparedStatement = $this->Prepare("
                SELECT 
                    `id`, 
                    `email_address`, 
                    `first_name`,
                    `last_name`
                FROM `Admins`
            ");
            $this->Execute( $preparedStatement );
            return $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}