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
     * The admin create class will create an admin user.
     */
    class AdminCreate extends Query
    {
        /**
         * Basic constructor that auto passes this database configuration in.
         */
        public function __construct()
        {
            parent::__construct((new DatabaseConfiguration()));
        }

        /**
         * This is the query method that will create an admin user.
         * @param string $emailAddress
         * @param string $password
         * @param string $firstName
         * @param string $lastName
         * @return bool
         * @throws PDODatabaseException
         */
        public function Query(string $emailAddress, string $password, string $firstName, string $lastName): bool
        {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $preparedStatement = $this->Prepare("
                INSERT INTO `Admins` 
                    (`email_address`, `password_hash`, 'first_name', 'last_name')
                VALUES
                    (:emailAddress, :passwordHash, :firstName, :lastName)
            ");
            $preparedStatement->bindValue( ':emailAddress', $emailAddress, PDO::PARAM_STR );
            $preparedStatement->bindValue( ':passwordHash', $passwordHash, PDO::PARAM_STR );
            $preparedStatement->bindValue( ':firstName', $firstName, PDO::PARAM_STR );
            $preparedStatement->bindValue( ':lastName', $lastName, PDO::PARAM_STR );
            return $this->Execute( $preparedStatement );
        }
    }
}