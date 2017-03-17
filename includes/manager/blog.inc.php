<?php
$back = $bs->buttonLink('Back', 'manager');
$h2 = $bs->tag('h2','Manage blog');
$action = 'blog/deleteblog';
$h3 = $bs->tag('h3','Existing blog');
$rowArr = array();
$rows = $db->listorderby('blog','created','DESC', 'content');
if(count($rows) > 0)
{
    foreach ($rows as $row)
    {
        $inputStr = '<input type="checkbox" name="id[]" ';
        $inputStr .= 'value="'.$row['id'].'">';
        array_push($rowArr, array($inputStr,$row['name']));
    }
}
else
{
    array_push($rowArr, array('No existing blog'));
}
$table = $bs->table(array('','Name'),$rowArr);
$form = $bs->form($table, $action);
$bs->singleRow(NULL, $h3.$form);
$bs->render();
?>