<?php
/**
 * This is the database namespace.
 * @noinspection PhpMultipleClassDeclarationsInspection
 */
namespace TheMysteryMarket\Database
{
    /** Include the PDODatabase class. */
    require_once("PDODatabase.class.php");
    /** Include the database configuration object and use the namespace. */
    require_once("Configuration/Database.class.php");


    use TheMysteryMarket\Configuration\Database as DBConfiguration;
    /** Include the PDODatabase exception and use the namespace. */
    require_once("Exception/PDODatabaseException.class.php");
    use TheMysteryMarket\Exception\PDODatabaseException;

    use PDO;

    use PDOStatement;

    use PDOException;


    class Query
    {
        /** @var ?DBConfiguration $dbConfiguration Database configuration object. */
        private $dbConfiguration;
        /** @var ?PDODatabase $pdoDatabase PDODatabase instance. */
        private $pdoDatabase;
        /** @var ?PDO $connection The PDO connection object. */
        private ?PDO $connection;

        /**
         * This method stores the configuration gets a reference to PDODatabase then establishs a connection.
         * @param DBConfiguration $dbConfiguration
         */
        public function __construct(DBConfiguration $dbConfiguration)
        {
            $this->dbConfiguration = $dbConfiguration;
            $this->pdoDatabase = PDODatabase::GetInstance();
            $this->Connect();
        }

        /**
         * Set the connection to a valid PDO object.
         */
        private function Connect(): void
        {
            $this->connection = $this->pdoDatabase->Connect($this->dbConfiguration);
        }

        /**
         * Call the PDODatabase object to reset the connection once the connection is released
         * recall the connect method
         * @throws PDODatabaseException
         * @todo decide what to do if an exception is thrown by ResetConnection.
         */
        private function Reconnect(): void
        {
            $this->pdoDatabase->ResetConnection($this->dbConfiguration);
            $this->Connect();
        }

        /**
         * Create a PDOStatement and return it.
         * @param string $query
         * @return PDOStatement
         */
        protected function Prepare(string $query): PDOStatement
        {
            return $this->connection->prepare($query);
        }

        /**
         * Begin a transaction.
         */
        public function BeginTransaction(): void
        {
            $this->connection->beginTransaction();
        }

        /**
         * Rollback a transaction.
         */
        public function RollBackTransaction(): void
        {
            $this->connection->rollBack();
        }

        /**
         * Commit a transaction.
         */
        public function CommitTransaction(): void
        {
            $this->connection->commit();
        }

        /**
         * Execute pdo prepared statements and gracefully handle reconnects if needed.
         * @param PDOStatement $preparedStatement
         * @return bool
         * @throws PDODatabaseException
         */
        protected function Execute(PDOStatement $preparedStatement): bool
        {
            try{
                return $preparedStatement->execute();
            }
            catch (PDOException $exception){
                if($exception->getCode() != 2006)
                {
                    throw $exception;
                }
                $this->Reconnect();
                return $this->Execute($preparedStatement);
            }
        }

        /**
         * Get the last insert id and return it as a string.
         * @return string
         */
        protected function LastInsertID(): string
        {
            return $this->connection->lastInsertId();
        }
    }
}