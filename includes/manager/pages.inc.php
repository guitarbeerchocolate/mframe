<?php
$back = $bs->buttonLink('Back', 'manager');
$h2 = $bs->tag('h2','Manage pages');
if(!is_null($liveConfig['id']))
{
	$id = $liveConfig['id'];
	$row = $db->getOneByID('pages',$id,'content');
	if(!isset($row['id']))
	{
		$error = 'The ID does not exist';
		$db->u->move_on($this->getVal('url').'manager/pages',$error);
	}
	$name = $row['name'];
	$content = $row['content'];
	$layout = $row['layout'];
	$secondarycontent = $row['secondarycontent'];
	$issubpage = $row['issubpage'];
	$action = 'pages/updatepage';
}
else
{
	$id = $db->getNextID('pages');
	$name = '';
	$content = '';
	$layout = '1';
	$secondarycontent = '';
	$issubpage = 0;
	$action = 'pages/addpage';
}
$bs->singleRow(NULL, $back.$h2);
$bs->render();
?>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<form action="<?php echo $action; ?>" method="POST" role="form">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<div class="form-group">
					<label for="name">Name of page</label>
					<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required />
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="content">Page content</label>
					<textarea name="content" id="content" cols="30" rows="10" class="tinymce form-control"><?php echo $content; ?></textarea>
				</div><!-- .form-group -->
		</div>
	</div>
</div>
<div class="row">
	<div class="container">
		<div class="col-md-6">
			<div class="form-group" id="layoutholder">
				<h4>Choose your layout</h4>
				<label class="radio-inline">
					<input type="radio" name="layout" id="layout1" value="1" <?php if(($layout == 1) || ($layout == 0)) echo 'checked'; ?>> <img src="img/layouts/full.png" alt="Full screen">
				</label>
				<label class="radio-inline">
					<input type="radio" name="layout" id="layout2" value="2" <?php if($layout == 2) echo 'checked'; ?>> <img src="img/layouts/half.png" alt="Half screen">
				</label>
				<label class="radio-inline">
					<input type="radio" name="layout" id="layout3" value="3" <?php if($layout == 3) echo 'checked'; ?>> <img src="img/layouts/goldenvertical.png" alt="Golden vertical">
				</label>
			</div>
			<?php
			include_once 'secondarycontent.inc.php';
			?>
		</div><!-- .col-md-6 -->
		<div class="col-md-6">
			<div class="form-group" id="issubpageholder">
				<h4>Is this content a sub-page</h4>
				<label class="radio-inline">
					<input type="radio" name="issubpage" id="issubpage0" value="0" <?php if($issubpage == 0) echo 'checked'; ?>> No
				</label>
				<label class="radio-inline">
					<input type="radio" name="issubpage" id="issubpage1" value="1" <?php if($issubpage == 1) echo 'checked'; ?>> Yes
				</label>
			</div>
		</div><!-- .col-md-6 -->
	</div>
</div>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">Submit</button>
			</form><br />
		</div><!-- .col-md-12 -->
	</div>
</div>
<?php
include_once 'uploadedimages.inc.php';

$action = 'pages/deletepages';
$h3 = $bs->tag('h3','Existing pages');
$rowArr = array();
$rows = $db->listall('pages','content');
if(count($rows) > 0)
{
	foreach ($rows as $row)
	{
		$inputStr = '<input type="checkbox" name="id[]" ';
		$inputStr .= 'value="'.$row['id'].'">';
		$editStr = '<a href="manager/pages&id='.$row['id'].'">Edit</a>';
		$previewLink = '<a href="pages&id='.$row['id'].'" target="_blank">Preview</a>';
		array_push($rowArr, array($inputStr,$row['name'],$editStr,$previewLink));
	}
}
else
{
	array_push($rowArr, array('No existing pages'));
}
$table = $bs->table(array('','Name','Action',''),$rowArr);
$form = $bs->form($table, $action);
$bs->singleRow(NULL, $h3.$form);
$bs->render();
?>