<?php
require_once 'classes/database.class.php';
$db = new database;
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$row = $db->getOneByID('pages',$id);
	if(!isset($row['id']))
	{
		$error = urlencode('The ID does not exist');
		header('location:manager.php?inc=addeditpage&message='.$error);
		exit;
	}	
	$name = $row['name'];
	$content = $row['content'];
	$action = 'pages/updatepage';	
}
else
{
	$id = $db->getNextID('pages');	
	$name = '';
	$content = '';
	$action = 'pages/addpage';
}
?>
<div class="col-md-12">
	<br /><a href="manager.php?inc=managepages" class="btn btn-primary">Back</a>
	<h3>Add/edit page</h3>
</div>
<div class="col-md-12">
	<form action="<?php echo $action; ?>" method="POST" role="form" class="ajax triggersave">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<div class="form-group">
			<label for="name">Name of page</label>
			<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" />
		</div><!-- .form-group -->
		<div class="form-group">
			<label for="content">Page content</label>
			<textarea name="content" id="content" cols="30" rows="10" class="tinymce form-control"><?php echo $content; ?></textarea>
		</div><!-- .form-group -->
		<button type="submit" class="btn btn-primary">Submit</button>
	</form><br />
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fileModal">Add image</button><br />
	<div id="newfilepath">
		<img src="" alt="">
	</div>
	<?php
	$dir = 'data/pages/'.$id;
	if(file_exists($dir))
	{
		if(count(scandir($dir)) > 0)
		{
			$u->echoeol('<div id="newfilepath">');
			$u->echoeol('<h4>Files available for page</h4>');
			echo '<table class="table table-bordered"><tbody>';
			foreach(scandir($dir) as $fname)
			{
				$path_parts = pathinfo($fname);				
				if(isset($path_parts['extension']))
				{
					if(($fname != '.') && ($fname != '..'))
					{
						echo '<tr>';
						echo '<td><img src="'.$dir.'/'.urlencode($fname).'" width="30" /></td>';
						echo '<td>'.$dir.'/'.urlencode($fname).'</td>';
						echo '</tr>';
					}
				}
			}
			$u->echoeol('</tbody></table>');
			$u->echoeol('</div>');		
		}	
	}
	
	
	?>	
</div>

<div class="modal fade" id="fileModal">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Upload file</h4>
		</div>
		<div class="modal-body">
			<form action="formhandler.php?action=pages/addpageimage" method="POST" enctype="multipart/form-data" id="addfile">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<div class="form-group">
					<label for="pagefile">File</label>
					<input type="file" name="pagefile" id="pagefile">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div><!-- .modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->