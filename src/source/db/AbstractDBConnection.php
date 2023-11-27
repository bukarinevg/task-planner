<?php
namespace app\source\db;

use PDO;

/**
 * Class AbstractDBConnection
 *
 * This abstract class provides a base for establishing and managing a connection to a database.
 * It defines common properties and a constructor that are shared by all database connection classes.
 */
abstract class AbstractDBConnection {
    /**
     * @var string $host The hostname of the database server.
     */    
    /**
     * @var string $db_name The name of the database.
     */
    
    /**
     * @var string $username The username used to connect to the database.
     */

    /**
     * @var string $password The password used to connect to the database.
     */
    
    /**
     * @var PDO $connection The PDO connection object.
     */
    protected PDO $connection;

    /**
     * AbstractDBConnection constructor.
     *
     * @param array $config The configuration array containing host, database name, username, and password.
     */
    public function __construct( protected string $host = 'localhost', protected string $db_name = 'database', 
        protected string $username = 'username', protected string $password = 'password',        ){ }
}
?>