<?php
require_once 'classes/database.class.php';
$db = new database;
?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="<?php $db->u->data_uri('img/largelogoCC3333.png'); ?>" alt="Large logo 1" class="img-responsive" />      
    </div>
    <div class="item">
      <img src="<?php $db->u->data_uri('img/largelogo1F7A7A.png'); ?>" alt="Large logo 2" class="img-responsive" />
    </div>    
    <div class="item">
      <img src="<?php $db->u->data_uri('img/largelogo8FBE30.png'); ?>" alt="Large logo 3" class="img-responsive" />
    </div>
  </div>
</div>