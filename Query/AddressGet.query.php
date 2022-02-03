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

    class AddressGet extends Query
    {
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        public function Query(int $customerId, int $addressId)
        {
            $preparedStatement = $this->Prepare("
                SELECT
                    `id`,
                    `customer_id`,
                    `line_one`,
                    `line_two`,
                    `city`,
                    `state`,
                    `zip`
                FROM `Addresses`
                WHERE `customer_id`=:customer_id
                AND `id`=:address_id
            ");
            $preparedStatement->bindValue(':customer_id', $customerId, PDO::PARAM_INT);
            $preparedStatement->bindValue(':address_id', $addressId, PDO::PARAM_INT);

            $this->Execute($preparedStatement);
            if($preparedStatement->rowCount()==0)
            {
                return false;
            }
            return $preparedStatement->fetch(\PDO::FETCH_ASSOC);
        }
    }
}