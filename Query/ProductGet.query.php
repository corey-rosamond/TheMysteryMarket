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
     * ProductGet will get all basic information about the product with the id provided
     */
    class ProductGet extends Query
    {
        /**
         * Basic constructor that auto passes this database configuration in.
         */
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        /**
         * This will return all information about the product with the provided ID
         * @param int $id
         * @return mixed
         * @throws PDODatabaseException
         */
        public function Query(int $id)
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
                WHERE `id`=:id
            ");
            $preparedStatement->bindValue(':id', $id, PDO::PARAM_INT);
            $this->Execute($preparedStatement);
            return $preparedStatement->fetch(PDO::FETCH_ASSOC);
        }
    }
}