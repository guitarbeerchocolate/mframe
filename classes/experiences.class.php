<?php
require_once 'database.class.php';
class experiences extends database
{
	private $pa;
    public $userid, $serviceid, $name, $description, $recommend, $suspend;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    function addexperiences()
    {
    	$sth = $this->prepare("INSERT INTO experiences (userid,serviceid,name,description,overallrating,recommend) VALUES (:userid,:serviceid,:name,:description,:overallrating,:recommend)");
        $sth->bindParam(':userid', $this->pa['userid']);
        $sth->bindParam(':serviceid', $this->pa['serviceid']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':description', substr($this->pa['description'],0,1000));	
        $sth->bindParam(':overallrating', $this->pa['overallrating']);        
        $sth->bindParam(':recommend', $this->pa['recommend']);
		$message = $this->testExecute($sth, 'Record added');
        $this->u->move_on($this->getVal('url').'private',$message);
    }

    function updateexperiences()
    {
    	$sth = $this->prepare("UPDATE experiences SET userid = :userid, serviceid = :serviceid, name = :name, description = :description, overallrating = :overallrating, recommend = :recommend, suspend = :suspend WHERE id = :id");
        $sth->bindParam(':id', $this->pa['id']);
    	$sth->bindParam(':userid', $this->pa['userid']);
        $sth->bindParam(':serviceid', $this->pa['serviceid']);
        $sth->bindParam(':name', $this->pa['name']);
        $sth->bindParam(':description', substr($this->pa['description'],0,1000)); 
        $sth->bindParam(':overallrating', $this->pa['overallrating']);
        $sth->bindParam(':recommend', $this->pa['recommend']);
        $sth->bindParam(':suspend', $this->pa['suspend']);
		$message = $this->testExecute($sth, 'Record updated');
        $this->u->move_on($this->getVal('url').'manager/experiences',$message);
    }

    function deleteexperiences()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM experiences WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }        
        $message = 'Records deleted';
        $this->u->move_on($this->getVal('url').'manager/experiences',$message);
    }

    function getexperiences($id)
    {
        $experiences = $this->getOneByID('experiences',$id);
        $this->userid = $experiences['userid'];
        $this->serviceid = $experiences['serviceid'];
        $this->name = $experiences['name'];        
        $this->description = $experiences['description'];
        $this->overallrating = $experiences['overallrating'];
        $this->recommend = $experiences['recommend'];
        $this->suspend = $experiences['susend'];
    }

    function __destruct()
    {

    }
}
?>