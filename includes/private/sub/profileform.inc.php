<form action="<?php echo $action; ?>" method="POST"  enctype="multipart/form-data" role="form">
	<input type="hidden" name="userid" value="<?php echo $s->userid; ?>" />
	<div class="form-group">
		<label for="name">Your name</label>
		<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required />
	</div><!-- .form-group -->
	<div class="form-group">
		<label for="content">About you</label>
		<textarea name="content" id="content" cols="30" rows="10" class="form-control" required><?php echo $content; ?></textarea>
	</div><!-- .form-group -->
	<div class="form-group">
		<label for="photo">Chosen photo</label>
		<input type="file" name="photo" id="photo" />
	</div><!-- .form-group -->
	<button type="submit" class="btn btn-primary">Submit</button>
</form>