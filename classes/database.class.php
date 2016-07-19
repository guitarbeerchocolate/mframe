<?php
require_once 'utilities.class.php';
class database extends PDO
{
    public $settings;
    protected $u;
    public function __construct($file = 'config.ini')
    {
        $this->settings = parse_ini_file($file, TRUE);
        $dns = $this->settings['driver'].':host=' . $this->settings['host'].((!empty($this->settings['port'])) ? (';port='.$this->settings['port']) : '').';dbname='.$this->settings['schema'];        
        parent::__construct($dns, $this->settings['username'], $this->settings['password']);
        $this->u = new utilities;
    }

    function listall($table)
    {
        $sql = "SELECT * FROM ".$table; 
        $stmt = $this->query($sql); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function performquery($q)
    {
        $stmt = $this->query($q); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getOneByFieldValue($table,$field,$value)
    {
        $sql = "SELECT * FROM {$table} WHERE {$field} = :{$field}  LIMIT 1";        
        $bindStr = ':'.$field;        
        $sth = $this->prepare($sql);
        $sth->bindParam($bindStr, $value);        
        $message = $this->testExecute($sth, 'Record received');        
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    function getAllByFieldValue($table,$field,$value)
    {
        $sql = "SELECT * FROM {$table} WHERE {$field} = :{$field}";        
        $bindStr = ':'.$field;        
        $sth = $this->prepare($sql);
        $sth->bindParam($bindStr, $value);        
        $message = $this->testExecute($sth, 'Records received');        
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    function getSimilarByFieldValue($table,$field,$value)
    {
        $sql = "SELECT * FROM {$table} WHERE {$field} LIKE :{$field}";        
        $bindStr = ':'.$field;        
        $sth = $this->prepare($sql);
        $sth->bindParam($bindStr, $value);        
        $message = $this->testExecute($sth, 'Records received');        
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    function getOneByID($table,$id)
    {
        $sql = "SELECT * FROM ".$table." WHERE id = :id LIMIT 1";               
        $sth = $this->prepare($sql);
        $sth->bindParam(':id', $id);        
        $message = $this->testExecute($sth, 'Record received');        
        return $sth->fetch(PDO::FETCH_ASSOC);
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
        $message = $this->testExecute($sth, 'Records received');        
        return $sth->fetchAll(PDO::FETCH_ASSOC);         
    }

    function listorderbywhere($table,$wherefield, $wherevalue, $orderby,$ad = "ASC")
    {
        $sql = "SELECT * FROM {$table} WHERE {$wherefield} = :{$wherefield} ORDER BY {$orderby} {$ad}";
        $bindStr = ':'.$wherefield;
        $sth = $this->prepare($sql);
        $sth->bindParam($bindStr, $wherevalue);
        $message = $this->testExecute($sth, 'Records received');        
        return $sth->fetchAll(PDO::FETCH_ASSOC);
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

    function testExecute($sth, $successMessage)
    {
        if($sth->execute() == TRUE)
        { 
            return $successMessage;
        }
        else
        {
            $messageArr = $sth->errorInfo();
            return $messageArr[2];
        }
    }
}
?>