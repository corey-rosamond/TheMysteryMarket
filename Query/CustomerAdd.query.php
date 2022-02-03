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

    class CustomerAdd extends Query
    {

        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        public function Query(string $firstName, string $middleName, string $lastName, string $emailAddress, string $phoneNumber): int
        {
            $preparedStatement = $this->Prepare("
                INSERT INTO `Customers` (`first_name`, `middle_name`, `last_name`, `email_address`, `phone_number`) VALUES
                (:first_name, :middle_name, :last_name, :email_address, :phone_number)
            ");
            $preparedStatement->bindValue(':first_name', $firstName, PDO::PARAM_STR);
            $preparedStatement->bindValue(':middle_name', $middleName, PDO::PARAM_STR);
            $preparedStatement->bindValue(':last_name', $lastName, PDO::PARAM_STR);
            $preparedStatement->bindValue(':email_address', $emailAddress, PDO::PARAM_STR);
            $preparedStatement->bindValue(':phone_number', $phoneNumber, PDO::PARAM_STR);
            $this->Execute($preparedStatement);
            return $this->LastInsertID();
        }
    }
}