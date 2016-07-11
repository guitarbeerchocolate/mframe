<?php
// include_once 'includes/general/top-cache.php';
include_once 'includes/general/showerrors.inc.php';
require_once 'classes/config.class.php';
require_once 'classes/utilities.class.php';
$c = new config;
$u = new utilities;
include_once 'includes/general/urlhandler.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    include_once 'includes/general/meta.inc.php';
    $u->echoeol();
    $u->title($status,$c->getVal('name'));
    $u->echoeol();
    include_once 'includes/general/icons.inc.php';
    $u->echoeol();
    include_once 'includes/general/linkrel.inc.php';
    ?>
  </head>
  <body>
    <?php
    include_once 'includes/general/googletracker.inc.php';
    $u->echoeol();
    include_once 'includes/general/navigation.inc.php';
    $u->echoeol();
    include_once 'includes/general/header.inc.php';
    $u->echoeol();
    include_once 'includes/general/message.inc.php';
    $u->echoeol();
    if(isset($_GET['username']) && isset($_GET['password']))
    {
			require_once 'classes/database.class.php';
			$username = urldecode($_GET['username']);
			$password = urldecode($_GET['password']);
			$pdo = new database();	
			$pdo->query();
			$sth = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username AND password = :password");	
			$sth->bindParam(':username', $username);
			$sth->bindParam(':password', $password);	
			$sth->execute();	
			$row = $sth->fetch(PDO::FETCH_ASSOC);		
			if(($row === false) && ($sth->rowCount() == 0))
			{
				$error = urlencode('Invalid email or password. Please try again.');
				header('location:'.$c->getVal('formspage').'&message='.$error);
				exit;
			}
			else
			{
				include_once 'includes/public/sub/resetpassword.inc.php';
			}	
    }
    else
    {
      include_once 'includes/public/sub/authenticate.inc.php';
    }
    ?>
    <div class="row">
      <div class="container">
      <?php
      /*
      if(isset($_GET['inc']))
      {
        $includeFile = 'includes/public/'.$_GET['inc'].'.inc.php';
        if(file_exists($includeFile))
        {
          include_once $includeFile;
        }
        else
        {
          $error = urlencode('Include does not exist.');
          header('location:'.$settings['website']['url'].'private.php?message='.$error);
          exit;
        }
      }
      */
      ?>		
  		</div><!-- .container -->
  	</div><!-- .row -->
    <?php
    include_once 'includes/general/footer.inc.php';
    ?>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script src="jquery/1.11.2/jquery.min.js"></script>    
    <script src="js-cache.php"></script>
  </body>
</html>
<?php
// include_once 'includes/general/bottom-cache.php';
?>