<?php
/**
 * Database Class PDOHandler
 * --------------------------------------------------------------
 * 
 */

 class PDOHandler 
 {
    private static $instance;
    private $error;
    public $DB;

    public function __construct () {
        $this->error = [];
        try {
            $this->DB = new PDO(
                "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", 
                DB_USER, 
                DB_PASS,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
            );
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e)
        {
            $this->error[] = $e->getMessage();
        }
    }

    public static function get_instance(){
        if( ! isset(self::$instance)){self::$instance = new PDOHandler();}

        return self::$instance;
    }
 }
