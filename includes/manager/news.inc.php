<div class="row">
	<div class="container">
		<div class="col-md-12">
			<br /><a href="manager" class="btn btn-primary">Back</a>
			<h2>Manage news</h2>
			<?php
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$row = $db->getOneByID('news',$id);
				if(!isset($row['id']))
				{
					$error = 'The ID does not exist';
					$db->u->move_on($this->getVal('url').'manager/news',$error);
				}	
				$name = $row['name'];
				$content = $row['content'];				
				$action = 'news/updatenews';	
			}
			else
			{
				$id = $db->getNextID('news');	
				$name = '';
				$content = '';
				$action = 'news/addnews';
			}
			?>

		</div>
	</div>
</div>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<form action="<?php echo $action; ?>" method="POST" role="form">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<div class="form-group">
					<label for="name">Name of news</label>
					<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required />
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="content">Page content</label>
					<textarea name="content" id="content" cols="30" rows="10" class="tinymce form-control"><?php echo $content; ?></textarea>
				</div><!-- .form-group -->
				<button type="submit" class="btn btn-primary">Submit</button>
			</form><br />
		</div>
	</div>
</div>
<?php
include_once 'uploadedimages.inc.php';
?>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h3>Existing news</h3>
			<form method="post" action="news/deletenews" role="form">	
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td><td>Action</td><td></td>
						</tr>
					</thead>
					<tbody>
					<?php
					$rows = $db->listall('news');
					if(count($rows) > 0)
					{
						foreach ($rows as $row)
						{
							$inputStr = '<input type="checkbox" name="id[]" ';
							$inputStr .= 'value="'.$row['id'].'">';
							$editStr = '<a href="manager/news&id='.$row['id'].'">Edit</a>';
							$previewLink = '<a href="news&id='.$row['id'].'" target="_blank">Preview</a>';
							$db->u->echotr(array($inputStr,$row['name'],$editStr,$previewLink));
						}
					}
					else
					{
						$db->u->echotr(array('No existing news'));
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>