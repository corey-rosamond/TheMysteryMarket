<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace TheMysteryMarket\Query
{
    require_once("Database/Query.class.php");

    use PDO;
    use TheMysteryMarket\Database\Query;

    require_once("Configuration/Database.class.php");
    use TheMysteryMarket\Configuration\Database as DatabaseConfiguration;

    class CustomerGet extends Query
    {
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        public function Query(int $customerId)
        {
            $preparedStatement = $this->Prepare("
                SELECT
                    `id`,
                    `first_name`,
                    `middle_name`,
                    `last_name`,
                    `email_address`,
                    `phone_number`
                FROM `Customers`
                WHERE `id`=:customer_id
            ");
            $preparedStatement->bindValue(':customer_id', $customerId, PDO::PARAM_INT);
            $this->Execute($preparedStatement);
            if($preparedStatement->rowCount()==0)
            {
                return false;
            }
            return $preparedStatement->fetch(\PDO::FETCH_ASSOC);
        }
    }
}