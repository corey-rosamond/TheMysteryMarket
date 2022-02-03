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
     *
     */
    class ProductGetUpsells extends Query
    {
        /**
         * Basic constructor that auto passes this database configuration in.
         */
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        /**
         *
         * @throws PDODatabaseException
         */
        public function Query()
        {
            $preparedStatement = $this->Prepare("
                SELECT
                    A.`id`,
                    A.`name`,
                    A.`price`,
                    A.`title`,
                    A.`description`,
                    A.`thumbnail`
                FROM `Products` as A
                INNER JOIN `Upsells` as B
                ON A.`id` = B.`product_id`
                WHERE A.`active` = true
                AND A.`primary` = false
                ORDER BY B.`display_order`
            ");
            $this->Execute($preparedStatement);
            return $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}