<?php
namespace app\source\db;

use app\source\db\connectors\MySQLConnection;
use app\source\db\connectors\PostgreSQLConnection;
use app\source\db\connectors\MSSQLConnection;
/**
 * Class DataBase
 *
 * This class is responsible for establishing a connection to a database based on the provided configuration.
 * It supports multiple database drivers.
 */
class DataBase  {

    use QueryBuilderTrait {
		insert as traitInsert;
	}
    /**
     * @var array $config The configuration array containing the database connection details.
     */
    /**
     * @var DBConnectionInterface $db The database connection object.
     */
    public $db;

    /**
     * DataBase constructor.
     *
     * @param array $config The configuration array containing the database connection details.
     */
    public function __construct(private array $config) {
        $this->connect();
    }
    
    public function insert($table, $columns, $requestDictionary): bool|\Exception{
        $query = $this->traitInsert($table , $columns);
        $query = $this->db->prepare($query);
        return $query->execute($requestDictionary) ? true : throw new \Exception("Error inserting data into the database.");

    } 

    /**
     * Establishes a connection to the database based on the provided configuration.
     */
    private function connect(): bool|\Exception {
        $driver = $this->config['driver'];
        $dbArguments = array_values([
            'host' => $this->config['host'],
            'db_name' => $this->config['db_name'],
            'username' => $this->config['username'],
            'password' => $this->config['password']
        ]);

        switch ($driver) {
            case 'mysql':
                $connection = new MySQLConnection(...$dbArguments);
                break;
            case 'pgsql':
                $connection = new PostgreSQLConnection(...$dbArguments);
                break;
            case 'sqlite':
                $connection = new MSSQLConnection(...$dbArguments);
                break;
            // Add more cases for other supported drivers

            default:
                throw new \Exception("Unsupported driver: $driver");
        }
        $this->setDataBaseConnection($connection);
        return true;
    }

    /**
     * Sets the database connection object.
     *
     * @param DBConnectionInterface $DBConnectionInterface The database connection object.
     */
    private function setDataBaseConnection(DBConnectionInterface $DBConnectionInterface): \PDO|\Exception {
        return $this->db = $DBConnectionInterface->getConnection() ??  throw new \Exception("Error connecting to the database.");
    }

}
  
