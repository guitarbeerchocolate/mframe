<?php
$back = $bs->buttonLink('Back', 'manager');
$h2 = $bs->tag('h2','Manage navigation');
$id = NULL;
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $row = $db->getOneByID('navigation',$id,'content');
    if(!isset($row['id']))
    {
        $error = 'The ID does not exist';
        $db->u->move_on($this->getVal('url').'manager/navigation',$error);
    }
    $name = $row['name'];
    $location = $row['location'];
    $action = 'navigation/updateitem';
}
else
{
    $id = $db->getNextID('navigation');
    $name = '';
    $location = '';
    $action = 'navigation/additem';
}
$bs->singleRow(NULL, $back.$h2);
$bs->render();
?>
<div class="row">
    <div class="container">
        <div class="col-md-12">
                <form method="post" action="<?php echo $action; ?>" role="form">
                    <div class="form-group">
                        <label for="name">Name of Navigation item</label>
                        <input type="" name="name" class="form-control" value="<?php echo $name; ?>"  />
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <select class="form-control" name="location">
                        <?php
                        $dontList = array('.','..','404.inc.php','seo.inc.php','test.inc.php','navitems.inc.php');
                        $dir = 'includes/public';
                        $f = scandir($dir);
                        if(count($f) > 2)
                        {
                            foreach($f as $fname)
                            {
                                $path_parts = pathinfo($fname);
                                if(isset($path_parts['extension']))
                                {
                                    if(!in_array($fname,$dontList))
                                    {
                                        echo '<option value="';
                                        echo substr($fname,0,-8).'"';
                                        if($location == substr($fname,0,-8)) echo ' SELECTED';
                                        echo '>'.$fname;
                                        echo '</option>'.PHP_EOL;
                                    }
                                }
                            }
                            $subpages = $db->performquery('SELECT * FROM pages USE INDEX (content) WHERE issubpage = 0');
                            foreach ($subpages as $subpage)
                            {
                                echo '<option value="';
                                echo 'pages&id='.$subpage['id'].'"';
                                echo '>'.$subpage['name'];
                                echo '</option>'.PHP_EOL;
                            }
                        }
                        else
                        {
                            echo 'No uploaded images';
                        }
                        ?>
                    </select>
                    </div><!-- .form-group -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
    </div>
</div>
<div class="row">
    <div class="container">
        <div class="col-md-12">
            <h3>Existing navigation items</h3>
            <form method="post" action="navigation/deleteitems" role="form">
                <table class="table">
                    <thead>
                        <tr>
                            <td></td><td>Name</td><td>Location</td><td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $rows = $db->listall('navigation','content');
                    if(count($rows) > 0)
                    {
                        foreach ($rows as $row)
                        {
                            $inputStr = '<input type="checkbox" name="id[]" ';
                            $inputStr .= 'value="'.$row['id'].'">';
                            $editStr = '<a href="manager/navigation&id='.$row['id'].'">Edit</a>';
                            $db->u->echotr(array($inputStr,$row['name'],$row['location'],$editStr));
                        }
                    }
                    else
                    {
                        $db->u->echotr(array('No existing navigation'));
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Delete</button>
            </form>
        </div>
    </div>
</div>