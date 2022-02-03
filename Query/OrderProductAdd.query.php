<?php
/**
 * This is the database query namespace.
 * @noinspection PhpMultipleClassDeclarationsInspection
 */
namespace TheMysteryMarket\Query
{
    require_once("Configuration/Database.class.php");
    use TheMysteryMarket\Configuration\Database as DatabaseConfiguration;
    require_once("Database/Query.class.php");
    use TheMysteryMarket\Database\Query;
    use \PDO;

    class OrderProductAdd extends Query
    {
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        public function Query(int $orderId, int $productId, int $quantity, float $price)
        {
            $preparedStatement = $this->Prepare("
                INSERT INTO `OrderProducts`(`order_id`, `product_id`, `quantity`, `price`) VALUES
                (:order_id, :product_id, :quantity, :price);
            ");
            $preparedStatement->bindValue(':order_id', $orderId,PDO::PARAM_INT);
            $preparedStatement->bindValue(':product_id', $productId, PDO::PARAM_INT);
            $preparedStatement->bindValue(':quantity', $quantity, PDO::PARAM_INT);
            $preparedStatement->bindValue(':price', $price, PDO::PARAM_STR);
            $this->Execute($preparedStatement);
        }
    }
}