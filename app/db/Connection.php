<?php 
/**
 * @class Connection A database connector an utility class
 */
class Connection {
  
  private static $db_link = null;
  
  public static function connect () {
    
    if (!self::$db_link) {
      
      try {
        self::$db_link = new PDO (
            'mysql:host='.DB_HOST.';dbname='.DB_SCHEMA
          , DB_USER
          , DB_PASS
        );
      } 
      
      catch (PDOException $ex) {
        die('Failed to connect to database');
      }
      
    }
    
    return self::$db_link;
    
  }
  
}
