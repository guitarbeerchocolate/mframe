<?php
require_once 'database.class.php';
class pages extends database
{
	private $pa;
    public $name, $content;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    function addpage()
    {
    	$sth = $this->prepare("INSERT INTO pages (name,content) VALUES (:name,:content)");
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);	
		$sth->execute();
        $message = 'Record added';
		$outURL = $this->settings['website']['url'].'manager.php?inc=managepages&message='.$message;
		$myArr = array('location'=>$outURL);
		return $myArr;
    }

    function updatepage()
    {
    	$sth = $this->prepare("UPDATE pages SET name = :name, content = :content WHERE id = :id");
    	$sth->bindParam(':id', $this->pa['id']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);	
		$sth->execute();
        $message = 'Record updated';
		$outURL = $this->settings['website']['url'].'manager.php?inc=managepages&message='.$message;
		$myArr = array('location'=>$outURL);
		return $myArr;
    }

    function deletepages()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM pages WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }        
        $message = 'Records deleted';
        $outURL = $this->settings['website']['url'].'manager.php?inc=managepages&message='.$message;
        $myArr = array('location'=>$outURL);
        return $myArr;
    }

    function addpageimage()
    {
        $target_dir = 'data/pages/'.$this->pa['id'];
        if(!file_exists($target_dir))
        {
            mkdir($target_dir, 0777, true);
        }
        $target_dir .= '/';        
        $target_file = $target_dir.basename($_FILES["pagefile"]["name"]);
        $tmp_name = $_FILES["pagefile"]["tmp_name"];        
        move_uploaded_file($tmp_name, $target_file);
        $outURL = $target_file;
        $myArr = array('location'=>$outURL);
        return $myArr;
    }

    function getpage($id)
    {
        $page = $this->getOneByID('pages',$id);
        $this->name = $page['name'];        
        $this->content = $page['content'];
    }

    function __destruct()
    {

    }
}
?>