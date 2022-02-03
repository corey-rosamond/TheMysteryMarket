<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace TheMysteryMarket\Query
{
    require_once("Database/Query.class.php");

    use PDO;
    use TheMysteryMarket\Database\Query;

    require_once("Configuration/Database.class.php");
    use TheMysteryMarket\Configuration\Database as DatabaseConfiguration;

    class OrderGet extends Query
    {
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        public function Query(int $orderId)
        {
            $preparedStatement = $this->Prepare("
                SELECT
                    `id`,
                    `customer_id`,
                    `billing_address`,
                    `shipping_address`,
                    `order_date`,
                    `shipping_date`,
                    `delivery_date`,
                    `cancel_date`,
                    `stripe_charge_id`,
                    `stripe_customer_id`,
                    `product_total`,
                    `tax_total`,
                    `shipping_total`
                FROM `Orders`
                WHERE `id`=:order_id
            ");
            $preparedStatement->bindValue(':order_id', $orderId, PDO::PARAM_INT);
            $this->Execute($preparedStatement);
            if($preparedStatement->rowCount()==0)
            {
                return false;
            }
            return $preparedStatement->fetch(\PDO::FETCH_ASSOC);
        }
    }
}