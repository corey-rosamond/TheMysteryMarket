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


    class AddressAdd extends Query
    {
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        public function Query(int $customerId, string $lineOne, string $lineTwo, string $city, string $state, int $zip)
        {
            $preparedStatement = $this->Prepare("
                INSERT into `Addresses`(`customer_id`, `line_one`, `line_two`, `city`, `state`, `zip`) VALUES
                (:customer_id, :line_one, :line_two, :city, :state, :zip);
            ");
            $preparedStatement->bindValue(':customer_id', $customerId, PDO::PARAM_INT);
            $preparedStatement->bindValue(':line_one', $lineOne, PDO::PARAM_STR);
            $preparedStatement->bindValue(':line_two', $lineTwo, PDO::PARAM_STR);
            $preparedStatement->bindValue(':city', $city, PDO::PARAM_STR);
            $preparedStatement->bindValue(':state', $state, PDO::PARAM_STR);
            $preparedStatement->bindValue(':zip', $zip, PDO::PARAM_INT);

            $this->Execute($preparedStatement);

            return $this->LastInsertID();
        }
    }
}