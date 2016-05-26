<?php
require_once 'database.class.php';
class profiles extends database
{
	private $pa;
    public $name, $content, $photo;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    function addprofiles()
    {
    	$sth = $this->prepare("INSERT INTO profiles (name,content,photo) VALUES (:name,:content,:photo)");
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);
        $sth->bindParam(':photo', $this->pa['photo']);
		$sth->execute();
        $message = 'Record added';
		$outURL = $this->settings['website']['url'].'manager.php?inc=profiles&message='.urlencode($message);
        header('Location:'.$outURL);
    }

    function updateprofiles()
    {
    	$sth = $this->prepare("UPDATE profiles SET name = :name, content = :content, photo = :photo WHERE id = :id");
    	$sth->bindParam(':id', $this->pa['id']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);
        $sth->bindParam(':photo', $this->pa['photo']);	
		$sth->execute();
        $message = 'Record updated';
		$outURL = $this->settings['website']['url'].'manager.php?inc=profiles&message='.urlencode($message);
        header('Location:'.$outURL);
    }

    function deleteprofiles()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM profiles WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }        
        $message = 'Records deleted';
        $outURL = $this->settings['website']['url'].'manager.php?inc=profiles&message='.urlencode($message);
        header('Location:'.$outURL);
    }

    function getprofiles($id)
    {
        $profiles = $this->getOneByID('profiles',$id);
        $this->name = $profiles['name'];        
        $this->content = $profiles['content'];
    }

    function __destruct()
    {

    }
}
?>