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
     * ProductGetPrimary This will return all information about the product flagged as primary
     */
    class ProductGetPrimary extends Query
    {
        /**
         * Basic constructor that auto passes this database configuration in.
         */
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        /**
         * This will return all information about the product flagged as primary
         * @return mixed
         * @throws PDODatabaseException
         */
        public function Query()
        {
            $preparedStatement = $this->Prepare("
                SELECT 
                    `id`, 
                    `name`, 
                    `thumbnail`, 
                    `title`, 
                    `description`, 
                    `price`, 
                    `shipping_price`, 
                    `active`, 
                    `primary` 
                FROM `Products` 
                WHERE `primary`=:primary
            ");
            $preparedStatement->bindValue(':primary', true, PDO::PARAM_BOOL);
            $this->Execute($preparedStatement);
            return $preparedStatement->fetch(PDO::FETCH_ASSOC);
        }
    }
}