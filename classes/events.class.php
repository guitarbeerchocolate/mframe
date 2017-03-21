<?php
require_once 'database.class.php';
class events extends database
{
    private $pa;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    function addevents()
    {
            $sth = $this->prepare("INSERT INTO events (name,datestart,dateend,content) VALUES (:name,:datestart,:dateend,:content)");
            $sth->bindParam(':name', $this->pa['name']);
            $sth->bindParam(':content', $this->pa['content']);
            $sth->bindParam(':datestart', $this->pa['datestart']);
            $sth->bindParam(':dateend', $this->pa['dateend']);
            $message = $this->testExecute($sth, 'Record added');
            $this->u->move_on($this->getVal('url').'manager/events',$message);
    }

    function updateevents()
    {
        $sth = $this->prepare("UPDATE events SET name = :name, content = :content, datestart = :datestart, dateend = :dateend WHERE id = :id");
        $sth->bindParam(':id', $this->pa['id']);
        $sth->bindParam(':name', $this->pa['name']);
        $sth->bindParam(':content', $this->pa['content']);
        $sth->bindParam(':datestart', $this->pa['datestart']);
        $sth->bindParam(':dateend', $this->pa['dateend']);
        $message = $this->testExecute($sth, 'Record updated');
        $this->u->move_on($this->getVal('url').'manager/events',$message);
    }

    function deleteevents()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM events WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }
        $message = 'Records deleted';
        $this->u->move_on($this->getVal('url').'manager/events',$message);
    }

    function getdata($id)
    {
        return $this->getOneByID('events',$id,'content');
    }

    function listevents()
    {
        $sql = "SELECT * FROM events USE INDEX (content) ORDER BY datestart ASC";
        $stmt = $this->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function __destruct()
    {

    }
}
?>