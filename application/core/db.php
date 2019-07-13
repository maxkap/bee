<?php
class Db{
    
    
    private $connection;
    
    private static $instance;

    
    
    private function __construct(){
        
        global $config;
        try {
            $this->connection = new PDO('mysql:host='.$config['db_host'].';dbname='.$config['db_base'].';charset='.$config['db_charset'], $config['db_user'], $config['db_password']);
            
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $this->connection->exec("set names utf8");
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }        
        
    }
    
    public static function getInstance(){
        
        if (empty(self::$instance)){
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    
    public function select($sql, $placeholders = array()) {
        
        $query = $this->connection->prepare($sql);
        $query->execute($placeholders); 
        $result =  $query->fetchAll();
        return $result;
        
    }
    public function select_one($sql, $placeholders = array()) {
        
        $result = $this->select($sql, $placeholders);
        return isset($result[0])?$result[0]:false;
        
    }
    
    public function set($sql, $placeholders = array()) {
        
        $query = $this->connection->prepare($sql);
        $query->execute($placeholders); 
        return $this->connection->lastInsertId();
        
    }
    
    
    
}