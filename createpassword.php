<html>
<?php
if(isset($_POST) && isset($_POST['password']))
{
	echo 'entrypted password for '.$_POST['password'].' is '.sha1(md5($_POST['password']));
}
?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<label for="password">Password</label>
<input type="text" name="password">
<button type="submit">Submit</button>
</form>   
<html>