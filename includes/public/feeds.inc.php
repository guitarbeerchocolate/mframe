<?php
$h2 = $bs->tag('h2','Feeds');
$col = $bs->tag('section',$h2,array('class'=>'col-md-12'));	
$con = $bs->tag(NULL,$col,array('class'=>'container'));
$bs->tag(NULL,$con,array('class'=>'row'));
$bs->render();
?>
<script src="modules/feedloader/feedloader.plugin.js"></script>
<script>
	$('section').feedloader();
</script>