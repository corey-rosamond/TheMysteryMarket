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
     * ProductSetThumbnail will set the thumbnail value for an already existing product.
     */
    class ProductSetThumbnail extends Query
    {
        /**
         * Basic constructor that auto passes this database configuration in.
         */
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        /**
         * Set an already created objects thumbnail property.
         * @param int $id
         * @param string $thumbnail
         * @return bool
         * @throws PDODatabaseException
         */
        public function Query(int $id, string $thumbnail): bool
        {
            $preparedStatement = $this->Prepare("
                UPDATE `Products` SET `thumbnail`=:thumbnail WHERE `id`=:id
            ");
            $preparedStatement->bindValue(':thumbnail', $thumbnail);
            $preparedStatement->bindValue(':id', $id, PDO::PARAM_INT);

            if($this->Execute($preparedStatement))
            {
                return true;
            }
            return false;
        }
    }
}