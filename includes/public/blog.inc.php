<div class="row">
    <div class="container">
        <div class="col-md-12" class="blog">
        <h2>Blog</h2>
        <?php
        require_once 'classes/blog.class.php';
        if(isset($_GET['id']))
        {
            $c = NULL;
            $n = NULL;
            $id = $_GET['id'];
            $b = new blog;
            $b->getblog($_GET['id']);
            if(isset($b->name))
            {
                $h = $bs->tag('h3',$b->name);
                $c = $h.$b->content;
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
        else
        {
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
                        $responses = $db->getAllByFieldValue('blog','responseid',$row['id'], 'content');
                        $blink = NULL;
                        $btn1 = NULL;
                        if(count($responses) > 0)
                        {
                            $blink = 'blog&id='.$row['id'];
                            $btn1 = $bs->buttonLink('Show responses', $blink);
                        }
                        $bs->tag('article',$header.$content.$footer.$btn1);
                        $bs->render();
                    }

                }
            }
            else
            {
                $bs->echop('No existing blogentries');
                $bs->render();
            }
        }

        ?>
        </div>
    </div>
</div>