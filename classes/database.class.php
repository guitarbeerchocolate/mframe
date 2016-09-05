<?php
require_once 'utilities.class.php';
class database extends PDO
{
    public $settings, $u, $c;
    public function __construct($file = 'config.ini')
    {
        $this->settings = parse_ini_file($file, TRUE);
        $dns = $this->settings['driver'].':host=' . $this->settings['host'].((!empty($this->settings['port'])) ? (';port='.$this->settings['port']) : '').';dbname='.$this->settings['schema'];        
        parent::__construct($dns, $this->settings['username'], $this->settings['password']);
        $this->u = new utilities;
        $this->c = $this->listall('config');
    }

    function listall($table)
    {
        $sql = "SELECT * FROM {$table}";
        $stmt = $this->query($sql); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function listallLimit($table, $limit)
    {
        $sql = "SELECT * FROM {$table} LIMIT {$limit}";
        $stmt = $this->query($sql); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function performquery($q)
    {
        $stmt = $this->query($q); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function searchBynames($table,$field,$value)
    {
        $sql = "SELECT * FROM {$table} WHERE {$field} LIKE :{$field} AND suspend <> 1 LIMIT 6";
        $bindStr = ':'.$field;        
        $sth = $this->prepare($sql);
        $sth->bindParam($bindStr, $value);        
        $message = $this->testExecute($sth);
        if($message == TRUE)
        {
            return $sth->fetchAll(PDO::FETCH_ASSOC);    
        }
        else
        {
            return $message;
        }
    }

    function getOneByFieldValue($table,$field,$value)
    {
        $sql = "SELECT * FROM {$table} WHERE {$field} = :{$field}  LIMIT 1";        
        $bindStr = ':'.$field;        
        $sth = $this->prepare($sql);
        $sth->bindParam($bindStr, $value);        
        $message = $this->testExecute($sth);
        if($message == TRUE)
        {
            return $sth->fetch(PDO::FETCH_ASSOC);    
        }
        else
        {
            return $message;
        }
    }

    function getAllByFieldValue($table,$field,$value)
    {
        $sql = "SELECT * FROM {$table} WHERE {$field} = :{$field}";        
        $bindStr = ':'.$field;        
        $sth = $this->prepare($sql);
        $sth->bindParam($bindStr, $value);        
        $message = $this->testExecute($sth);
        if($message == TRUE)
        {
            return $sth->fetchAll(PDO::FETCH_ASSOC);    
        }
        else
        {
            return $message;
        }
    }

    function getAllByFieldValueLimit($table,$field,$value,$limit)
    {
        $sql = "SELECT * FROM {$table} WHERE {$field} = :{$field} LIMIT {$limit}";        
        $bindStr = ':'.$field;        
        $sth = $this->prepare($sql);
        $sth->bindParam($bindStr, $value);        
        $message = $this->testExecute($sth);
        if($message == TRUE)
        {
            return $sth->fetchAll(PDO::FETCH_ASSOC);    
        }
        else
        {
            return $message;
        }
    }

    function getSimilarByFieldValue($table,$field,$value)
    {
        $sql = "SELECT * FROM {$table} WHERE {$field} LIKE :{$field}";        
        $bindStr = ':'.$field;        
        $sth = $this->prepare($sql);
        $sth->bindParam($bindStr, $value);        
        $message = $this->testExecute($sth);
        if($message == TRUE)
        {
            return $sth->fetchAll(PDO::FETCH_ASSOC);    
        }
        else
        {
            return $message;
        }
    }

    function getSimilarByFieldValueLimit($table,$field,$value,$limit)
    {
        $sql = "SELECT * FROM {$table} WHERE {$field} LIKE :{$field} LIMIT {$limit}";        
        $bindStr = ':'.$field;        
        $sth = $this->prepare($sql);
        $sth->bindParam($bindStr, $value);        
        $message = $this->testExecute($sth);
        if($message == TRUE)
        {
            return $sth->fetchAll(PDO::FETCH_ASSOC);    
        }
        else
        {
            return $message;
        }
    }

    function getOneByID($table,$id)
    {
        $sql = "SELECT * FROM ".$table." WHERE id = :id LIMIT 1";               
        $sth = $this->prepare($sql);
        $sth->bindParam(':id', $id);        
        $message = $this->testExecute($sth);
        if($message == TRUE)
        {
            return $sth->fetch(PDO::FETCH_ASSOC);    
        }
        else
        {
            return $message;
        }
    }

    function getNextID($table)
    {
        $sql = "SELECT * FROM ".$table." ORDER BY id DESC LIMIT 1"; 
        $stmt = $this->query($sql);
        $row = $stmt->fetch();        
        return $row['id']+1;
    }
    
    function listorderby($table,$orderby,$ad = "ASC")
    {
        $sql = "SELECT * FROM {$table} ORDER BY {$orderby} {$ad}";
        $sth = $this->prepare($sql);       
        $message = $this->testExecute($sth);
        if($message == TRUE)
        {
            return $sth->fetchAll(PDO::FETCH_ASSOC);    
        }
        else
        {
            return $message;
        }
    }

    function listorderbyLimit($table,$orderby,$limit,$ad = "ASC")
    {
        $sql = "SELECT * FROM {$table} ORDER BY {$orderby} {$ad} LIMIT {$limit}";
        $sth = $this->prepare($sql);       
        $message = $this->testExecute($sth);
        if($message == TRUE)
        {
            return $sth->fetchAll(PDO::FETCH_ASSOC);    
        }
        else
        {
            return $message;
        }
    }

    function listorderbywhere($table,$wherefield, $wherevalue, $orderby, $ad = "ASC")
    {
        $sql = "SELECT * FROM {$table} WHERE {$wherefield} = :{$wherefield} ORDER BY {$orderby} {$ad}";
        $bindStr = ':'.$wherefield;
        $sth = $this->prepare($sql);
        $sth->bindParam($bindStr, $wherevalue);
        $message = $this->testExecute($sth);
        if($message == TRUE)
        {
            return $sth->fetchAll(PDO::FETCH_ASSOC);    
        }
        else
        {
            return $message;
        }
    }

    function listorderbywhereLimit($table,$wherefield, $wherevalue, $orderby, $limit, $ad = "ASC")
    {
        $sql = "SELECT * FROM {$table} WHERE {$wherefield} = :{$wherefield} ORDER BY {$orderby} {$ad} LIMIT {$limit}";
        $bindStr = ':'.$wherefield;
        $sth = $this->prepare($sql);
        $sth->bindParam($bindStr, $wherevalue);
        $message = $this->testExecute($sth);
        if($message == TRUE)
        {
            return $sth->fetchAll(PDO::FETCH_ASSOC);    
        }
        else
        {
            return $message;
        }
    }

    function getFieldsFromTable($tn)
    {
        $outArr = array();
        $dbname = $this->settings['schema'];
        $s = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='{$dbname}' AND `TABLE_NAME`='{$tn}'";
        $stmt = $this->query($s);
        if($stmt !== FALSE)
        {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }        
        foreach ($rows as $row)
        {
            if(strtolower($row['COLUMN_NAME']) !== 'id')
            {
                array_push($outArr, $row['COLUMN_NAME']);
            }
        }
        return $outArr;
    }

    function countrow($table)
    {
        $sql = "SELECT * FROM {$table}";
        $sth = $this->prepare($sql);
        $sth->execute();
        return $sth->rowCount();
    }

    function averageValue($table, $col, $serviceid)
    {
        $sql = "SELECT * FROM ".$table." WHERE serviceid = :serviceid";
        $sth = $this->prepare($sql);
        $sth->bindParam(':serviceid', $serviceid); 
        $message = $this->testExecute($sth);
        if($message == TRUE)
        {
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);    
        }
        else
        {
            return $message;
        }
        $count = 0;
        $total = 0;
        foreach($rows as $row)
        {
            $total += $row[$col];
            $count++;
        }
        if($count == 0)
        {
            return 0;
        }
        else
        {
            return ($total/$count);    
        }
    }

    function getManagers()
    {
        return explode(',', $this->getVal('managerids'));
    }

    function getVal($key)
    {
        foreach ($this->c as $name => $index)
        {
            if(strtolower($key) == strtolower($index['name']))
            {
                return $index['value'];
            }
        }
        return FALSE;
    }

    function testExecute($sth, $successMessage = NULL)
    {
        if($sth->execute() == TRUE)
        { 
            if($successMessage != NULL)
            {
                return $successMessage;    
            }
            else
            {
                return TRUE;
            }
            
        }
        else
        {
            $messageArr = $sth->errorInfo();
            return $messageArr[2];
        }
    }
}
?>