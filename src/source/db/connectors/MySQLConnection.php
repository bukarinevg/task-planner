<?php 
namespace app\source\db\connectors;
use PDO;
use PDOException;
use app\source\db\BaseDBConnectionInterface;
use app\source\db\DBConnectionInterface;
/**
 * Class MySQLConnection
 *
 * This class is responsible for establishing and managing a connection to a MySQL database.
 * It extends the BaseDBConnectionInterface class and implements the DBConnectionInterface interface.
 */
class MySQLConnection  extends BaseDBConnectionInterface implements DBConnectionInterface
{
    /**
     * Establishes a connection to the database.
     *
     * @return PDO|null The PDO connection object if successful, null otherwise.
     */
    public function getConnection()
    {
        $this->connection = null;
        try {
            $this->connection = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
    }
}

?>