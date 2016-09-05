<?php
require_once 'database.class.php';
class service extends database
{
	private $pa;
    public $userid, $name, $description, $photo, $tel, $postcode, $county, $address, $website, $email, $tags, $suspend;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    function addservice()
    {
        $existNameTest = $this->checkExists();
        if($existNameTest == TRUE)
        {
            $message = 'A similar service already exists';
            $this->u->move_on($this->getVal('url').'private/service',$message);
        }
        else
        {
            $sth = $this->prepare("INSERT INTO service (userid,name,description,photo,tel,postcode,county,address,website,email,tags) VALUES (:userid,:name,:description,:photo,:tel,:postcode,:county,:address,:website,:email,:tags)");
            $sth->bindParam(':userid', $this->pa['userid']);
            $sth->bindParam(':name', $this->pa['name']);
            $sth->bindParam(':description', $this->pa['description']);
            if(isset($_FILES) && (!empty($_FILES['photo']['name'])))
            {
                $filename = $_FILES['photo']['tmp_name'];
                $mime = $_FILES['photo']['type'];            
                $uploadResult = $this->u->data_uri_string($filename, $mime);
            }
            else
            {
                $uploadResult = '';
            }
            $sth->bindParam(':photo', $uploadResult);
            $sth->bindParam(':tel', $this->pa['tel']);
            $sth->bindParam(':postcode', $this->pa['postcode']);
            $sth->bindParam(':county', $this->pa['county']);
            $sth->bindParam(':address', $this->pa['address']);
            $sth->bindParam(':website', $this->pa['website']);
            $sth->bindParam(':email', $this->pa['email']);
            $tags = implode(',',$this->pa['tags']);
            if(empty($tags)) $tags = '0';
            $sth->bindParam(':tags', $tags);
            $message = $this->testExecute($sth, 'Record added');            
            $outURL = $this->getVal('url').'private&message='.urlencode($message);
            header('Location:'.$outURL);
            exit;
        }
    }

    function updateservice()
    {
    	$sth = $this->prepare("UPDATE service SET userid = :userid, name = :name, description = :description, photo = :photo, tel = :tel, postcode = :postcode, county = :county, address = :address, website = :website, email = :email, tags = :tags, suspend = :suspend WHERE id = :id");
    	$sth->bindParam(':id', $this->pa['id']);
        $sth->bindParam(':userid', $this->pa['userid']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':description', $this->pa['description']);
        if(isset($_FILES) && (!empty($_FILES['photo']['name'])))
        {
            $filename = $_FILES['photo']['tmp_name'];
            $mime = $_FILES['photo']['type'];            
            $uploadResult = $this->u->data_uri_string($filename, $mime);
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
        $sth->bindParam(':photo', $uploadResult);
        $sth->bindParam(':tel', $this->pa['tel']);
        $sth->bindParam(':postcode', $this->pa['postcode']);
        $sth->bindParam(':county', $this->pa['county']);
        $sth->bindParam(':address', $this->pa['address']);
        $sth->bindParam(':website', $this->pa['website']);
        $sth->bindParam(':email', $this->pa['email']);
        $tags = implode(',',$this->pa['tags']);
        if(empty($tags)) $tags = '0';
        $sth->bindParam(':tags', $tags);
        $sth->bindParam(':suspend', $this->pa['suspend']);
        $message = $this->testExecute($sth, 'Record updated');
        $outURL = $this->getVal('url').'private&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
    }

    function deleteservice()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM service WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }        
        $message = 'Records deleted';
        $outURL = $this->getVal('url').'manager/service&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
    }

    function getservice($id)
    {
        $content = $this->getOneByID('service',$id);
        $this->userid = $content['userid'];
        $this->name = $content['name'];        
        $this->description = $content['description'];
        $this->photo = $content['photo'];
        $this->tel = $content['tel'];
        $this->postcode = $content['postcode'];
        $this->county = $content['county'];
        $this->address = $content['address'];
        $this->website = $content['website'];
        $this->email = $content['email'];
        $this->tags = $content['tags'];
        $this->suspend = $content['suspend'];
    }

    function checkExists()
    {
        $existTest = FALSE;
        $sth = $this->prepare("SELECT * FROM service WHERE name LIKE :name OR tel = :tel OR website = :website OR email = :email");
        $sth->bindParam(':name', $this->pa['name']);
        $sth->bindParam(':tel', $this->pa['tel']);        
        $sth->bindParam(':website', $this->pa['website']);
        $sth->bindParam(':email', $this->pa['email']);
        $sth->execute();
        $exist = $sth->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($exist))
        {
            $existTest = TRUE;
        }
        return $existTest;
    }

    function __destruct()
    {

    }
}
?>