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

    class CustomerGetIdWithEmail extends Query
    {

        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        public function Query(string $emailAddress): int
        {
            $preparedStatement = $this->Prepare("SELECT `id` FROM `Customers` WHERE `email_address`=:email_address");
            $preparedStatement->bindValue(':email_address', $emailAddress, PDO::PARAM_STR);
            $this->Execute($preparedStatement);
            $result = $preparedStatement->fetch(PDO::FETCH_ASSOC);
            return $result['id'];
        }
    }
}