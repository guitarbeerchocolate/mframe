<?php
require_once 'database.class.php';
class blog extends database
{
    private $pa;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    function addblog()
    {
        $sth = $this->prepare("INSERT INTO blog (responseid,userid,name,content) VALUES (:responseid,:userid,:name,:content)");
        $sth->bindParam(':responseid', $this->pa['responseid']);
        $sth->bindParam(':userid', $this->pa['userid']);
        $sth->bindParam(':name', $this->pa['name']);
        $sth->bindParam(':content', $this->pa['content']);
        $message = $this->testExecute($sth, 'Record added');
        $this->u->move_on($this->getVal('url').'private/blog',$message);
    }

    function addresponse()
    {
        $sth = $this->prepare("INSERT INTO blog (responseid,userid,name,content) VALUES (:responseid,:userid,:name,:content)");
        $sth->bindParam(':responseid', $this->pa['responseid']);
        $sth->bindParam(':userid', $this->pa['userid']);
        $sth->bindParam(':name', $this->pa['name']);
        $sth->bindParam(':content', $this->pa['content']);
        $message = $this->testExecute($sth, 'Record added');
        $this->u->move_on($this->getVal('url').'private/blog',$message);
    }

    function updateblog()
    {
        $sth = $this->prepare("UPDATE blog SET name = :name, content = :content WHERE id = :id");
        $sth->bindParam(':id', $this->pa['id']);
        $sth->bindParam(':name', $this->pa['name']);
        $sth->bindParam(':content', $this->pa['content']);
        $message = $this->testExecute($sth, 'Record updated');
        $this->u->move_on($this->getVal('url').'manager/blog',$message);
    }

    function deleteblog()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $responses = $this->getAllByFieldValue('blog','responseid',$checked, 'content');
            if(count($responses) > 0)
            {
                foreach ($responses as $response)
                {
                    $sth = $this->prepare("DELETE FROM blog WHERE id = :id");
                    $sth->bindParam(':id', $response['id']);
                    $sth->execute();
                }
            }
            $sth = $this->prepare("DELETE FROM blog WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }
        $message = 'Records deleted';
        $this->u->move_on($this->getVal('url').'manager/blog',$message);
    }

    function getdata($id)
    {
        return $this->getOneByID('blog',$id,'content');
    }

    function __destruct()
    {

    }
}
?>