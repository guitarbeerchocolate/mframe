<?php
require_once 'database.class.php';
class news extends database
{
	private $pa;
    public $name, $content;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    function addnews()
    {
    	$sth = $this->prepare("INSERT INTO news (name,content) VALUES (:name,:content)");
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);	
		$sth->execute();
        $message = 'Record added';
		$outURL = $this->settings['website']['url'].'manager.php?inc=managenews&message='.$message;
		$myArr = array('location'=>$outURL);
		return $myArr;
    }

    function updatenews()
    {
    	$sth = $this->prepare("UPDATE news SET name = :name, content = :content WHERE id = :id");
    	$sth->bindParam(':id', $this->pa['id']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);	
		$sth->execute();
        $message = 'Record updated';
		$outURL = $this->settings['website']['url'].'manager.php?inc=managenews&message='.$message;
		$myArr = array('location'=>$outURL);
		return $myArr;
    }

    function deletenews()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM news WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }        
        $message = 'Records deleted';
        $outURL = $this->settings['website']['url'].'manager.php?inc=managenews&message='.$message;
        $myArr = array('location'=>$outURL);
        return $myArr;
    }

    function addnewsimage()
    {
        $target_dir = 'data/news/'.$this->pa['id'];
        if(!file_exists($target_dir))
        {
            mkdir($target_dir, 0777, true);
        }
        $target_dir .= '/';        
        $target_file = $target_dir.basename($_FILES["newsfile"]["name"]);
        $tmp_name = $_FILES["newsfile"]["tmp_name"];        
        move_uploaded_file($tmp_name, $target_file);
        $outURL = $target_file;
        $myArr = array('location'=>$outURL);
        return $myArr;
    }

    function getnews($id)
    {
        $news = $this->getOneByID('news',$id);
        $this->name = $news['name'];        
        $this->content = $news['content'];
    }

    function __destruct()
    {

    }
}
?>