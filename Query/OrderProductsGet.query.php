<?php
/**
 * @noinspection PhpMultipleClassDeclarationsInspection
 */
namespace TheMysteryMarket\Query
{
    require_once("Database/Query.class.php");

    use PDO;
    use TheMysteryMarket\Database\Query;

    require_once("Configuration/Database.class.php");
    use TheMysteryMarket\Configuration\Database as DatabaseConfiguration;

    class OrderProductsGet extends Query
    {
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        public function Query(int $orderId)
        {
            $preparedStatement = $this->Prepare("
                SELECT
                    a.`id`,
                    a.`order_id`,
                    a.`product_id`,
                    a.`quantity`,
                    a.`price`,
                    b.`name`
                FROM `OrderProducts` AS a
                LEFT JOIN `Products` AS b
                ON a.`product_id`=b.`id`
                WHERE a.`order_id`=:order_id
            ");
            $preparedStatement->bindValue(':order_id', $orderId, PDO::PARAM_INT);
            $this->Execute($preparedStatement);
            if($preparedStatement->rowCount()==0)
            {
                return false;
            }
            return $preparedStatement->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
}