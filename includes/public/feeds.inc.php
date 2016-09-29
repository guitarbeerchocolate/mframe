<?php
$h2 = $bs->tag('h2','Feeds');
$col = $bs->column($h2,12,'section');
$con = $bs->container($col);
$bs->row($con);
$bs->render();
?>
<script src="modules/feedloader/feedloader.plugin.js"></script>
<script>
	$('section').feedloader();
</script>