<?php
require_once 'classes/blog.class.php';
if(!is_null($liveConfig['id']))
{
    $id = $liveConfig['id'];
    $c = NULL;
    $n = NULL;
    $blog = new blog;
    $b = $blog->getdata($id);
    if(isset($b['name']))
    {
        $h = $bs->tag('h3',$b['name']);
        $c = $h.$b['content'];
        $responses = $db->getAllByFieldValue('blog','responseid',$id, 'content');
        if(count($responses) > 0)
        {
            echo '<hr />';
            $c .= $bs->tag('h4','Responses');
            foreach ($responses as $response)
            {
                $n = $bs->tag('h5',$response['name']);
                $c .=$n.$response['content'];
            }
        }
    }
    else
    {
        $c = $bs->tag('p','Not a valid ID');
    }
    $bs->singleRow(NULL, $c);
    $bs->render();
}
elseif(isset($_GET['responseid']))
{
    $blogc = new blog;
    $id = $db->getNextID('blog');
    $bc = $blogc->getdata($_GET['responseid']);
    $entryTitle = 'Add a response entry : '.$bc['name'];
    $h2 = $bs->tag('h2',$entryTitle);
    $responseid = $_GET['responseid'];
    $userid = $s->userid;
    $name = '';
    $content = '';
    $action = 'blog/addresponse';
    $bs->singleRow(NULL, $h2);
    $bs->render();

    $hiddenID = $bs->hiddeninput('id', $id);
    $hiddenResponseID = $bs->hiddeninput('responseid', $responseid);
    $hiddenUserID = $bs->hiddeninput('userid', $userid);
    $blogName = $bs->input('name','Name of response', NULL, $name);
    $pageContent = $bs->textarea('content', 'Response content', $content,NULL,'content');
    $form = $bs->form(array($hiddenID,$hiddenResponseID,$hiddenUserID,$blogName,$pageContent), $action);
    $bs->singleRow(NULL, $form);
    $bs->render();
}
else
{
    $h2 = $bs->tag('h2','Add a blog entry');
    $id = $db->getNextID('blog');
    $responseid = '0';
    $userid = $s->userid;
    $name = '';
    $content = '';
    $action = 'blog/addblog';
    $bs->singleRow(NULL, $h2);
    $bs->render();

    $hiddenID = $bs->hiddeninput('id', $id);
    $hiddenResponseID = $bs->hiddeninput('responseid', $responseid);
    $hiddenUserID = $bs->hiddeninput('userid', $userid);
    $blogName = $bs->input('name','Name of blog', NULL, $name);
    $pageContent = $bs->textarea('content', 'Blog content', $content,NULL,'content');
    $form = $bs->form(array($hiddenID,$hiddenResponseID,$hiddenUserID,$blogName,$pageContent), $action);
    $bs->singleRow(NULL, $form);
    $bs->render();

    echo '<hr />';
    $entries = NULL;
    $rows = $db->listorderby('blog','created','DESC', 'content');
    if(count($rows) > 0)
    {
        foreach ($rows as $row)
        {
            if($row['responseid'] == 0)
            {
                $h4 = $bs->tag('h4',$row['name']);
                $header = $bs->tag('header',$h4);
                $content = $row['content'];
                $footerText = 'Created '.date("jS F Y",strtotime($row['created']));
                $footer = $bs->tag('footer',$footerText);
                $respLink = 'private/blog&responseid='.$row['id'];
                $btn2 = $bs->buttonLink('Respond', $respLink);
                $btn1 = '';
                $responses = $db->getAllByFieldValue('blog','responseid',$row['id'], 'content');
                if(count($responses) > 0)
                {
                    $blink = 'private/blog&id='.$row['id'];
                    $btn1 = $bs->buttonLink('Show responses', $blink);
                }
                $entries .= $bs->tag('article',$header.$content.$footer.$btn1.$btn2);
            }

        }
    }
    else
    {
        $entries = $bs->echop('No existing blogentries');
    }
    $bs->singleRow(NULL, $entries);
    $bs->render();
}
?>