<?php
/**
 * Model Class BaseModel
 * -----------------------------------------------------------
 * 
 * class BaseModel
 * 
 * @extends PDOHandler
 */

class BaseModel extends PDOHandler
 {
    protected $modelDB;
    protected $mysqlConfig;
    protected $modelError;
    protected $truncateIgnore;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct () {
        $this->modelDB = parent::get_instance();
        $this->mysqlConfig = AppConfig::getConfig('mysql');
        $this->modelError = [];
        $this->truncateIgnore = [];
    }

    /**
     * getConfigQuery
     *
     * @param  string $sql
     * @param  array $queryId
     *
     * @return string
     */
    private function getConfigQuery ($sql, $queryId)
    {
        $result = '';

        if (isset($this->mysqlConfig[$sql][$queryId])) {
            $result = $this->mysqlConfig[$sql][$queryId];
        } elseif (!empty($sql) && empty($queryId)) {
            $result = $sql;
        }

        return $result;
    }

    /**
     * getQuery
     *
     * @param  string $query
     * @param  array $bindParam
     *
     * @return array
     */
    protected function getQuery ($sql, $queryId = '', Array $bindParam=[], Bool $onlyOne = false) 
    {
        $results = [];

        if (!$query = $this->getConfigQuery ($sql, $queryId)) {
            return $results;
        }
        try {

            $stat = $this->modelDB->DB->prepare($query);
            
            if (!empty($bindParam)) {
                $stat->execute($bindParam);
            } else {
                $stat->execute();
            }
            if ( (int) $stat->rowCount() > 0) {
                while($row = $stat->fetch(PDO::FETCH_ASSOC)) {
                    $results[] = $row;
                }
                if ($onlyOne ) {
                    $results = $results[0];
                }
            } 
        } catch(PDOExecption $e) {
            $this->modelError[] = $e->getMessage();
        } 
        // $stat->debugDumpParams();
        
        return $results;
    }

    /**
     * setQuery
     *
     * @param  string $sql
     * @param  array $bindParam
     *
     * @return boolean
     */
    protected function setQuery (String $sql, Array $bindParam=[]) 
    {
        if (isset($this->mysqlConfig['select'][$sql])) {

            $query = $this->mysqlConfig['select'][$sql];

            try {

                $stat = $this->modelDB->DB->prepare($query);
            
                if (!empty($bindParam)) {
                    $stat->execute($bindParam);
                } else {
                    $stat->execute();
                }

                return ((int) $stat->rowCount() > 0) ? true : false;

            } catch(PDOExecption $e) {
                $this->modelError[] = $e->getMessage();
            } 
                

        }

        return false;
    }

    protected function setUpdate (String $tbl, Array $values)
    {
        $setQuery = [];
        $id = 0;

        foreach($values as $key => $val) {

            if ($key === 'id') {
                $id = $val;
            } else {
                $setQuery[] = $key.'=  "'.$val.'" ';
            }
        }

        if (!empty($setQuery)) {
            try {
                $query = "UPDATE $tbl SET ".implode(', ', $setQuery)." WHERE id = $id";
                $stat = $this->modelDB->DB->prepare($query);
                $stat->execute();
            } catch(PDOExecption $e) {
                $this->modelError[] = $e->getMessage();
            } 
        }
    }

    protected function setInsert (String $tbl, $values, $isBlockAct = false) {
        
        $lastInsertId = 0;

        if (!isset($this->mysqlConfig['tables'][$tbl])) {
            return $lastInsertId;
        }

        try {

            $cols = "(".implode(",",$this->mysqlConfig['tables'][$tbl]).")";
            
            if (!$isBlockAct) {
                $values = "('".implode("','",$values)."')";
                $query = vsprintf("INSERT INTO $tbl %s VALUES %s", [$cols, $values]);
            } else {
                $query = "INSERT INTO $tbl $cols VALUES $values";
            }
            $stat = $this->modelDB->DB->prepare($query);

            try {
                $this->modelDB->DB->beginTransaction(); 
                $stat->execute();

                $lastInsertId = $this->modelDB->DB->lastInsertId(); 
                $this->modelDB->DB->commit();

            } catch(PDOExecption $e) {
                $this->modelDB->DB->rollback();
                $this->modelError[] = $e->getMessage();
                $lastInsertId = 0;
            } 
        } catch(PDOExecption $e) {
            $this->modelError[] = $e->getMessage();
            $lastInsertId = 0;
        } 
        return $lastInsertId;
    }

    public function getPostModel (String $tbl, $options= [])
    {
        $result = $options;
        
        if (isset($this->mysqlConfig['tables'][$tbl])) {

            foreach($this->mysqlConfig['tables'][$tbl] as $key) {
                if (isset($_POST[$key])) {
                    if (isset($this->mysqlConfig['replace']['db'][$key])) {
                        $_POST[$key] = str_replace($this->mysqlConfig['replace']['db'][$key][0], $this->mysqlConfig['replace']['db'][$key][1], $_POST[$key]);
                    }
                    $result[$key] = $_POST[$key];
                }
            }
        }

        return $result;
    }

    public function getColModel (String $tbl, $item, $options= [])
    {
        $result = $options;
        
        if (isset($this->mysqlConfig['tables'][$tbl])) {

            foreach($item as $key => $val) {
                
                if (in_array($key, $this->mysqlConfig['tables'][$tbl])) {
                    
                    $result[$key] = $val;
                }
            }
        }
        var_dump($item);
        return $result;
    }
 }
 
