<?php
require_once 'database.class.php';
class draftpages extends database
{
    private $pa;
    public $name, $content, $layout, $secondarycontent, $issubpage;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    /*
    Tests should be
    1
    1,2
    1,3
    4 after 1
    4 after 1,2
    4 after 1,3
    4,5 after 1
    4,5 after 1,2
    4,5 after 1,3
    4,6 after 1
    4,6 after 1,2
    4,6 after 1,3
    */
    function adddraftpage()
    {
        $message = '';
        $sth = $this->prepare("INSERT INTO draftpages (name,content,layout,secondarycontent,issubpage) VALUES (:name,:content,:layout,:secondarycontent,:issubpage)");
        $sth->bindParam(':name', $this->pa['name']);
        $sth->bindParam(':content', $this->pa['content']);
        $sth->bindParam(':layout', $this->pa['layout']);
        $sth->bindParam(':secondarycontent', $this->pa['secondarycontent']);
        $sth->bindParam(':issubpage', $this->pa['issubpage']);
        $message .= $this->testExecute($sth, 'Draft page created added 1.');

        if(!is_null($this->pa['liveselection']))
        {
            $sth = $this->prepare("UPDATE pages SET name = :name, content = :content, layout = :layout, secondarycontent = :secondarycontent, issubpage = :issubpage WHERE id = :id");
            $sth->bindParam(':id', $this->pa['liveselection']);
            $sth->bindParam(':name', $this->pa['name']);
            $sth->bindParam(':content', $this->pa['content']);
            $sth->bindParam(':layout', $this->pa['layout']);
            $sth->bindParam(':secondarycontent', $this->pa['secondarycontent']);
            $sth->bindParam(':issubpage', $this->pa['issubpage']);
            $message .= $this->testExecute($sth, ' Existing page updated 2.');
        }
        elseif($this->pa['justmakelive'] == 'on')
        {
            $sth = $this->prepare("INSERT INTO pages (name,content,layout,secondarycontent,issubpage) VALUES (:name,:content,:layout,:secondarycontent,:issubpage)");
            $sth->bindParam(':name', $this->pa['name']);
            $sth->bindParam(':content', $this->pa['content']);
            $sth->bindParam(':layout', $this->pa['layout']);
            $sth->bindParam(':secondarycontent', $this->pa['secondarycontent']);
            $sth->bindParam(':issubpage', $this->pa['issubpage']);
            $message .= $this->testExecute($sth, ' Draft page made live 3.');
        }
        $this->u->move_on($this->getVal('url').'manager/draftpages',$message);
    }

    function updatedraftpage()
    {
        $message =- NULL;
        $sth = $this->prepare("UPDATE draftpages SET name = :name, content = :content, layout = :layout, secondarycontent = :secondarycontent, issubpage = :issubpage WHERE id = :id");
        $sth->bindParam(':id', $this->pa['id']);
        $sth->bindParam(':name', $this->pa['name']);
        $sth->bindParam(':content', $this->pa['content']);
        $sth->bindParam(':layout', $this->pa['layout']);
        $sth->bindParam(':secondarycontent', $this->pa['secondarycontent']);
        $sth->bindParam(':issubpage', $this->pa['issubpage']);
        $message .= $this->testExecute($sth, 'Draft page created updated 4.');

        if(!is_null($this->pa['liveselection']))
        {
            $sth = $this->prepare("UPDATE pages SET name = :name, content = :content, layout = :layout, secondarycontent = :secondarycontent, issubpage = :issubpage WHERE id = :id");
            $sth->bindParam(':id', $this->pa['liveselection']);
            $sth->bindParam(':name', $this->pa['name']);
            $sth->bindParam(':content', $this->pa['content']);
            $sth->bindParam(':layout', $this->pa['layout']);
            $sth->bindParam(':secondarycontent', $this->pa['secondarycontent']);
            $sth->bindParam(':issubpage', $this->pa['issubpage']);
            $message .= $this->testExecute($sth, ' Existing page updated 5.');
        }
        elseif($this->pa['justmakelive'] == 'on')
        {
            $sth = $this->prepare("INSERT INTO pages (name,content,layout,secondarycontent,issubpage) VALUES (:name,:content,:layout,:secondarycontent,:issubpage)");
            $sth->bindParam(':name', $this->pa['name']);
            $sth->bindParam(':content', $this->pa['content']);
            $sth->bindParam(':layout', $this->pa['layout']);
            $sth->bindParam(':secondarycontent', $this->pa['secondarycontent']);
            $sth->bindParam(':issubpage', $this->pa['issubpage']);
            $message .= $this->testExecute($sth, ' Draft page made live 6.');
        }


        $this->u->move_on($this->getVal('url').'manager/draftpages',$message);
    }

    function deletedraftpages()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM draftpages WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }
        $message = 'Records deleted';
        $this->u->move_on($this->getVal('url').'manager/draftpages',$message);
    }

    function getpage($id)
    {
        $page = $this->getOneByID('draftpages',$id,'content');
        $this->name = $page['name'];
        $this->content = $page['content'];
        $this->layout = $page['layout'];
        $this->secondarycontent = $page['secondarycontent'];
        $this->issubpage = $page['issubpage'];
    }

    function __destruct()
    {

    }
}
?>