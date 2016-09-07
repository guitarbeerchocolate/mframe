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
        $message = 'Profile added';        
        $uploadResult = '';
        $sth = $this->prepare("INSERT INTO profiles (userid,name,content,photo) VALUES (:userid,:name,:content,:photo)");
        $sth->bindParam(':userid', $this->pa['userid']);
        $sth->bindParam(':name', $this->pa['name']);
        $sth->bindParam(':content', $this->pa['content']);
        if(isset($_FILES) && (!empty($_FILES['photo']['name'])))
        {
            $filename = $_FILES['photo']['tmp_name'];
            $mime = $_FILES['photo']['type'];
            $uploadResult = $this->u->image_db_string($filename, $mime);
        }
        else
        {
            $uploadResult = '';
        }        
        $sth->bindParam(':photo', $uploadResult);        
        $message = $this->testExecute($sth, 'Record added'); 
        $this->u->move_on($this->getVal('url').'private',$message);
    }

    function updateprofiles()
    {
        /*
        $sth = $this->prepare("UPDATE profiles SET name = :name, content = :content, photo = :photo WHERE userid = :userid");
        $sth->bindParam(':userid', $this->pa['userid']);
        $sth->bindParam(':name', $this->pa['name']);
        $sth->bindParam(':content', $this->pa['content']);
        if(isset($_FILES) && (!empty($_FILES['photo']['name'])))
        {
            $filename = $_FILES['photo']['tmp_name'];
            $mime = $_FILES['photo']['type'];            
            $uploadResult = $this->u->image_db_string($filename, $mime);
        }
        elseif(!empty($this->pa['tempphoto']))
        {
            $uploadResult = $this->pa['tempphoto'];
        }
        else
        {
            $uploadResult = '';
        }        
        $sth->bindParam(':photo', $uploadResult);
        $message = $this->testExecute($sth, 'Record updated');
        $this->u->move_on($this->c->getVal('url').'private',$message);
        */
    }

    function deleteprofiles()
    {
        /*
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM profiles WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }
        $message = 'Records deleted ';
        $this->u->move_on($this->c->getVal('url').'manager/profiles',$message);
        */
    }

    function getprofiles($id)
    {
        /*
        $profiles = $this->getOneByID('profiles',$id);
        $this->name = $profiles['name'];        
        $this->content = $profiles['content'];
        */
    }

    function __destruct()
    {

    }
}
?>