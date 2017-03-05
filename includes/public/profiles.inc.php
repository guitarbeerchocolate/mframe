<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h2>Profiles</h2>
			<?php
			$rows = $db->listall('profiles','content');
			foreach ($rows as $row)
			{
				$profileImg = $bs->tag('img',NULL,array('class'=>'img-responsive','src'=>$row['photo'],'alt'=>$row['name']));
				$h4 = $bs->tag('h4',$row['name']);
				$content = $h4.$profileImg.strip_tags($row['content']);
				$bs->tag('article',$content,array('class'=>'publicprofiles'));
				$bs->render();
			}
			?>
		</div>
	</div>
</div>