<?php
$back = $bs->buttonLink('Back', 'manager');
$h2 = $bs->tag('h2','Manage navigation');
$id = NULL;
if(!is_null($liveConfig['id']))
{
    $id = $liveConfig['id'];
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
                        $dontList = array('.','..','404.inc.php','seo.inc.php','test.inc.php','navitems.inc.php,loader.inc.php');
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
<?php
$action = 'navigation/deleteitems';
$h3 = $bs->tag('h3','Existing navigation items');
$rowArr = array();
$rows = $db->listall('navigation','content');
if(count($rows) > 0)
{
    foreach ($rows as $row)
    {
        $inputStr = '<input type="checkbox" name="id[]" ';
        $inputStr .= 'value="'.$row['id'].'">';
        $editStr = '<a href="manager/navigation&id='.$row['id'].'">Edit</a>';
        array_push($rowArr, array($inputStr,$row['name'],$row['location'],$editStr));
    }
}
else
{
    array_push($rowArr, array('No existing navigation'));
}
$table = $bs->table(array('','Name','Location','Action'),$rowArr);
$form = $bs->form($table, $action);
$bs->singleRow(NULL, $h3.$form);
$bs->render();
?>
