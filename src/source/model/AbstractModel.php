<?php 
namespace app\source\model;

use app\source\db\DataBase;
use app\source\db\QueryBuilderTrait;

/**
 * This is an abstract class that serves as the base for all models.
 */
abstract class AbstractModel {

    use QueryBuilderTrait {
		insert as traitInsert;
	}
    /**
     * @var PDO $db The PDO connection object.
     */
    protected $db;

    /**
     * The name of the database table for model.
     */
    public $table = '';


    /**
     * Class AbstractModel
     * 
     * This class represents an abstract model.
     */
    public function __construct() {
        $config = require 'config/config.php';
        $this->db =  (new DataBase($config['components']['db']))->db;
    }

    /**
     * Validates the data of the model.
     * if the data is valid, returns true, otherwise throws an exception.
     * if validate method is not implemented in the child class, returns true.
     */
    protected function validate($columns){
        return true;
    }

    /**
     * Insert a new record into the database table.
     * Running the validate method before inserting the data.
     * If it definied in the child class, it will be run, otherwise it will return true.
     * Then data will be inserted into the database table.
     *
     * @param array $columns The columns to insert data into.
     * @param array $values The values to be inserted.
     * @return void
     */
    public function insert(array $columns , array $values ){
        $requestDictionary = array_combine($columns, $values);
        if($this->validate($requestDictionary)){
            $query = $this->traitInsert($this->table , $columns);
            $query = $this->db->prepare($query);
            $query->execute($requestDictionary);
        }
        else{
            throw new \Exception("Data is not valid");
        }


        
    }

    



}

