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
    class UpsellsExist extends Query
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
         */
        public function Query()
        {
            $preparedStatement = $this->Prepare("
                SELECT count(`id`) as TotalUpsells FROM `Upsells`
            ");
            $this->Execute($preparedStatement);
            $result = $preparedStatement->fetch(PDO::FETCH_ASSOC);
            if($result['TotalUpsells'] == 0)
            {
                return false;
            }
            return true;
        }
    }
}