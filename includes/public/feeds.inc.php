<?php
$h2 = $bs->tag('h2','Feeds');
$bs->singleRow('section',$h2);
$bs->render();
?>
<script src="modules/feedloader/feedloader.plugin.js"></script>
<script>
    $('section').feedloader();
</script>