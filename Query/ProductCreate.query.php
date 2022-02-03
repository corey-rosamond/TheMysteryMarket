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
     * ProductCreate Will create a basic product
     */
    class ProductCreate extends Query
    {
        /**
         * Basic constructor that auto passes this database configuration in.
         */
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        /**
         * This will take in new product information and return the insert id you will need to use the
         * ProductSetThumbnail query object to set that once the product is created.
         * @param string $name
         * @param string $title
         * @param string $description
         * @param float $price
         * @param float $shippingPrice
         * @param bool $active
         * @param bool $primary
         * @return int
         * @throws PDODatabaseException
         */
        public function Query(
            string $name,
            string $title,
            string $description,
            float $price,
            float $shippingPrice,
            bool $active = true,
            bool $primary = false
        ): int
        {
            $preparedStatement = $this->Prepare("
                INSERT INTO `Products` 
                    (`name`, `title`, `description`,  `price`, `shipping_price`, `active`, `primary`)
                VALUES
                    (:name, :title, :description, :price, :shipping_price, :active, :primary)
            ");
            $preparedStatement->bindValue(':name', $name);
            $preparedStatement->bindValue(':title', $title);
            $preparedStatement->bindValue(':description', $description);
            $preparedStatement->bindValue(':price', $price);
            $preparedStatement->bindValue(':shippingPrice', $shippingPrice);
            $preparedStatement->bindValue(':active', $active, PDO::PARAM_BOOL);
            $preparedStatement->bindValue(':primary', $primary, PDO::PARAM_BOOL);
            $this->Execute( $preparedStatement );
            return $this->LastInsertID();
        }
    }
}