<?php
require_once 'database.class.php';
class navigation extends database
{
    private $pa;
    public $i;
    function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    function additem()
    {
        $sth = $this->prepare("INSERT INTO navigation (name,location) VALUES (:name,:location)");
        $sth->bindParam(':name', $this->pa['name']);
        $sth->bindParam(':location', $this->pa['location']);
        $message = $this->testExecute($sth, 'Record added');
        $this->u->move_on($this->getVal('url').'manager/navigation&',$message);
    }

    function updateitem()
    {
        $sth = $this->prepare("UPDATE navigation SET name = :name, location = :location WHERE id = :id");
        $sth->bindParam(':id', $this->pa['id']);
        $sth->bindParam(':name', $this->pa['name']);
        $sth->bindParam(':location', $this->pa['location']);
        $message = $this->testExecute($sth, 'Record updated');
        $this->u->move_on($this->getVal('url').'manager/navigation&',$message);
    }

    function deleteitems()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM navigation WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }
        $message = 'Records deleted='.$this->pa['id'];
        $this->u->move_on($this->getVal('url').'manager/navigation&',$message);
    }

    function __destruct()
    {

    }
}
?>