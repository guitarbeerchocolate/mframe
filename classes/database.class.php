<?php
class database extends PDO
{
	public $settings;
    public function __construct($file = 'config.ini')
    {
        $this->settings = parse_ini_file($file, TRUE);
        $dns = $this->settings['database']['driver'].':host=' . $this->settings['database']['host'].((!empty($this->settings['database']['port'])) ? (';port='.$this->settings['database']['port']) : '').';dbname='.$this->settings['database']['schema'];        
        parent::__construct($dns, $this->settings['database']['username'], $this->settings['database']['password']);
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

    function getOneByID($table,$id)
    {
    	$sql = "SELECT * FROM ".$table." WHERE id=".$id." LIMIT 1"; 
		$stmt = $this->query($sql); 
		return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getNextID($table)
    {
        $sql = "SELECT * FROM ".$table." ORDER BY id DESC LIMIT 1"; 
        $stmt = $this->query($sql);
        $row = $stmt->fetch();        
        return $row['id']+1;
    }

    function testExcecute($sth, $successMessage)
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