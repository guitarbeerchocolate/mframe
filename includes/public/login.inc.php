<?php
if(isset($_GET['username']) && isset($_GET['password']))
{
    $username = urldecode($_GET['username']);
    $password = urldecode($_GET['password']);        
    $db->query();
    $sth = $db->prepare("SELECT id, username, password FROM users WHERE username = :username AND password = :password");   
    $sth->bindParam(':username', $username);
    $sth->bindParam(':password', $password);    
    $sth->execute();    
    $row = $sth->fetch(PDO::FETCH_ASSOC);       
    if(($row === false) && ($sth->rowCount() == 0))
    {
        $error = 'Invalid email or password. Please try again.';
        $u->move_on($c->getVal('formspage'), $error);
    }
    else
    {
        include_once 'sub/resetpassword.inc.php';
    }   
}
else
{
  include_once 'sub/authenticate.inc.php';
}
?>