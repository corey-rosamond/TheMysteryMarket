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

    class OrderAdd extends Query
    {
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        public function Query(
            int $customerId,
            int $billingId,
            int $shippingId,
            string $stripeCustomerId,
            string $stripeChargeId,
            float $productTotal,
            float $taxTotal,
            float $shippingTotal
        ): int
        {
            $preparedStatement = $this->Prepare("
                INSERT INTO `Orders` (
                    `customer_id`, 
                    `billing_address`, 
                    `shipping_address`, 
                    `order_date`, 
                    `stripe_customer_id`, 
                    `stripe_charge_id`, 
                    `product_total`, 
                    `tax_total`, 
                    `shipping_total`
                ) VALUES (
                    :customer_id,
                    :billing_id,
                    :shipping_id,
                    now(),
                    :stripe_customer_id,
                    :stripe_charge_id,
                    :product_total,
                    :tax_total,
                    :shipping_total
                );
            ");
            $preparedStatement->bindValue(':customer_id', $customerId,PDO::PARAM_INT);
            $preparedStatement->bindValue(':billing_id', $billingId, PDO::PARAM_INT);
            $preparedStatement->bindValue(':shipping_id', $shippingId, PDO::PARAM_INT);
            $preparedStatement->bindValue(':stripe_customer_id', $stripeCustomerId, PDO::PARAM_STR);
            $preparedStatement->bindValue(':stripe_charge_id', $stripeChargeId,PDO::PARAM_STR);
            $preparedStatement->bindValue(':product_total', (string)$productTotal, PDO::PARAM_STR);
            $preparedStatement->bindValue(':tax_total', (string)$taxTotal, PDO::PARAM_STR);
            $preparedStatement->bindValue(':shipping_total', (string)$shippingTotal, PDO::PARAM_STR);
            $this->Execute($preparedStatement);
            return $this->LastInsertID();
        }
    }
}