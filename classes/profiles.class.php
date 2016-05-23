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
		$outURL = $this->settings['website']['url'].'manager.php?inc=manageprofiles&message='.$message;
		$myArr = array('location'=>$outURL);
		return $myArr;
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
		$outURL = $this->settings['website']['url'].'manager.php?inc=manageprofiles&message='.$message;
		$myArr = array('location'=>$outURL);
		return $myArr;
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
        $outURL = $this->settings['website']['url'].'manager.php?inc=manageprofiles&message='.$message;
        $myArr = array('location'=>$outURL);
        return $myArr;
    }

    function addprofilesimage()
    {
        $target_dir = 'data/profiles/'.$this->pa['id'];
        if(!file_exists($target_dir))
        {
            mkdir($target_dir, 0777, true);
        }
        $target_dir .= '/';        
        $target_file = $target_dir.basename($_FILES["profilesfile"]["name"]);
        $tmp_name = $_FILES["profilesfile"]["tmp_name"];        
        move_uploaded_file($tmp_name, $target_file);
        $outURL = $target_file;
        $myArr = array('location'=>$outURL);
        return $myArr;
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