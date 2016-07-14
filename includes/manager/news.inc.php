<div class="row">
	<div class="container">
		<div class="col-md-12">
			<br /><a href="manager" class="btn btn-primary">Back</a>
			<h3>Manage news</h3>
			<?php
			require_once 'classes/database.class.php';
			$db = new database;
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$row = $db->getOneByID('news',$id);
				if(!isset($row['id']))
				{
					$error = urlencode('The ID does not exist');
					header('location:manager/news&message='.$error);
					exit;
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
			<form action="formhandler.php?action=<?php echo $action; ?>" method="POST" role="form">
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
			<h4>Existing news</h4>
			<form method="post" action="formhandler.php?action=news/deletenews" role="form">	
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
							echo '<tr>';
							echo '<td>';
							echo '<input type="checkbox" name="id[]" ';
							echo 'value="'.$row['id'].'"></td>';
							echo '<td>'.$row['name'].'</td>';
							echo '<a href="manager/news&id='.$row['id'].'">Edit</a>';
							echo '</td>';
							echo '<td>';
							echo '<a href="news&id='.$row['id'].' " target="_blank">Preview</a>';
							echo '</td>';
							$u->echoeol('</tr>');
						}
					}
					else
					{
						echo '<tr><td>No existing news</td></tr>';
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>