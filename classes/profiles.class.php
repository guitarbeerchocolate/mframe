<?php
require_once 'database.class.php';
class profiles extends database
{
    private $pa;
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
            $uploadResult = $this->u->data_uri_string($filename, $mime);
            if($uploadResult == "data:image/jpeg;base64,")
            {
                $addMessage = ', but the image was an invalid type.';
                $uploadResult = '';
            }
        }
        else
        {
            $uploadResult = '';
        }
        $sth->bindParam(':photo', $uploadResult);
        $message = $this->testExecute($sth, 'Record added');
        if($addMessage != '')
        {
            $message .= $addMessage;
        }
        $this->u->move_on($this->getVal('url').'private',$message);
    }

    function updateprofiles()
    {

        if(isset($_FILES) && (!empty($_FILES['photo']['name'])))
        {
            $filename = $_FILES['photo']['tmp_name'];
            $mime = $_FILES['photo']['type'];
            $uploadResult = $this->u->image_db_string($filename, $mime);
            $sth = $this->prepare("UPDATE profiles SET name = :name, content = :content, photo = :photo WHERE userid = :userid");
            $sth->bindParam(':userid', $this->pa['userid']);
            $sth->bindParam(':name', $this->pa['name']);
            $sth->bindParam(':content', $this->pa['content']);
            $sth->bindParam(':photo', $uploadResult);
        }
        else
        {
            $sth = $this->prepare("UPDATE profiles SET name = :name, content = :content WHERE userid = :userid");
            $sth->bindParam(':userid', $this->pa['userid']);
            $sth->bindParam(':name', $this->pa['name']);
            $sth->bindParam(':content', $this->pa['content']);
        }
        $message = $this->testExecute($sth, 'Record updated');
        $this->u->move_on($this->getVal('url').'private',$message);
    }

    function deleteprofiles()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM profiles WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }
        $message = 'Records deleted ';
        $this->u->move_on($this->c->getVal('url').'manager/profiles',$message);
    }

   function getdata($id)
    {
        return $this->getOneByID('profiles',$id,'content');
    }

    function __destruct()
    {

    }
}
?>