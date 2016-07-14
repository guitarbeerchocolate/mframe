<div class="row">
	<div class="container">
		<div class="col-md-12">
			<br /><a href="manager" class="btn btn-primary">Back</a>
			<h3>Manage pages</h3>
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
					header('location:manager/pages&message='.$error);
					exit;
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
					<label for="name">Name of page</label>
					<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required />
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="content">Page content</label>
					<textarea name="content" id="content" cols="30" rows="10" class="tinymce form-control"><?php echo $content; ?></textarea>
				</div><!-- .form-group -->
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
				<div class="form-group" id="issubpageholder">
					<h4>Is this content a sub-page</h4>
					<label class="radio-inline">
						<input type="radio" name="issubpage" id="issubpage0" value="0" <?php if($issubpage == 0) echo 'checked'; ?>> No
					</label>
					<label class="radio-inline">
						<input type="radio" name="issubpage" id="issubpage1" value="1" <?php if($issubpage == 1) echo 'checked'; ?>> Yes
					</label>					
				</div>	
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
			<h4>Existing pages</h4>
			<form method="post" action="formhandler.php?action=pages/deletepages" role="form">	
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td><td>Action</td><td></td>
						</tr>
					</thead>
					<tbody>
					<?php					
					$rows = $db->listall('pages');
					if(count($rows) > 0)
					{
						foreach ($rows as $row)
						{
							echo '<tr>';
							echo '<td>';
							echo '<input type="checkbox" name="id[]" ';
							echo 'value="'.$row['id'].'"></td>';
							echo '<td>'.$row['name'].'</td>';
							echo '<td>';
							echo '<a href="manager/pages&id='.$row['id'].'">Edit</a>';
							echo '</td>';
							echo '<td>';
							echo '<a href="pages&id='.$row['id'].'" target="_blank">Preview</a>';
							echo '</td>';
							$u->echoeol('</tr>');
						}
					}
					else
					{
						echo '<tr><td>No existing pages</td></tr>';
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>