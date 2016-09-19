<div class="row">
	<div class="container">
		<div class="col-md-12">
			<br /><a href="manager" class="btn btn-primary">Back</a>
			<h3>Manage external feeds</h3>
			<?php
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$row = $db->getOneByID('externalfeeds',$id,'content');
				if(!isset($row['id']))
				{
					$error = 'The ID does not exist';
					$db->u->move_on($this->getVal('url').'manager/externalfeeds',$error);
				}	
				$name = $row['name'];
				$location = $row['location'];
				$type = $row['type'];				
				$action = 'externalfeeds/updateexternalfeed';	
			}
			else
			{
				$id = $db->getNextID('externalfeeds');	
				$name = '';
				$location = '';
				$type = 1;
				$action = 'externalfeeds/addexternalfeed';
			}
			$placeHolderText = 'Add URL of the feed';
			switch($type)
			{
				case 1:
					$placeHolderText = 'Add URL of the feed';
					break;
				case 2:
					$placeHolderText = 'Add twitter username';
					break;
				case 3:
					$placeHolderText = 'Add twitter hashtag';
					break;
				case 4:
					$placeHolderText = 'Add name of channel URL e.g. patcondell';
					break;
				case 5:
					$placeHolderText = 'Add name of pinterest username e.g. mick';
					break;
				default:
					$placeHolderText = 'Add URL of the feed';
					break;
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
					<label for="name">Name of external feed</label>
					<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required />
				</div><!-- .form-group -->
				<div class="form-group">
					<label class="radio-inline">
						<input type="radio" name="type" id="type1" value="1" <?php if(($type == 1) || ($type == '')) echo 'checked'; ?> /> RSS
					</label>
					<label class="radio-inline">
						<input type="radio" name="type" id="type2" value="2" <?php if($type == 2) echo 'checked'; ?> /> Twitter user
					</label>
					<label class="radio-inline">
						<input type="radio" name="type" id="type3" value="3" <?php if($type == 3) echo 'checked'; ?> /> Twitter hashtag
					</label>
					<label class="radio-inline">
						<input type="radio" name="type" id="type4" value="4" <?php if($type == 4) echo 'checked'; ?> /> YouTube channel
					</label>
					<label class="radio-inline">
						<input type="radio" name="type" id="type5" value="5" <?php if($type == 5) echo 'checked'; ?> /> Pinterest user
					</label>
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="name">Feed</label>
					<input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="<?php echo $placeHolderText; ?>" required />
				</div><!-- .form-group -->				
				<button type="submit" class="btn btn-primary">Submit</button>
			</form><br />
		</div>
	</div>
</div>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h4>Existing external feeds</h4>
			<form method="post" action="externalfeeds/deleteexternalfeeds" role="form">	
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td><td>Action</td>
						</tr>
					</thead>
					<tbody>
					<?php
					$rows = $db->listall('externalfeeds','content');
					if(count($rows) > 0)
					{
						foreach ($rows as $row)
						{
							$inputStr = '<input type="checkbox" name="id[]" ';
							$inputStr .= 'value="'.$row['id'].'">';
							$editStr = '<a href="manager/externalfeeds&id='.$row['id'].'">Edit</a>';							
							$db->u->echotr(array($inputStr,$row['name'],$editStr));
						}
					}
					else
					{
						$db->u->echotr(array('No existing external feeds'));
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>