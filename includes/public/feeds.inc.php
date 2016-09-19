<div class="row">
	<div class="container">
			<div class="col-md-12">
			<?php
			require_once 'classes/externalfeeds.class.php';
			$ef = new externalfeeds;
			$arr = $ef->getResults();
			
			if(count($ef->agg->messageArr) > 0)
	        {   
	            $db->u->echoh3('Errors');
	            foreach($ef->agg->messageArr as $err)
	            {
	                $db->u->echobr($err);
	            }
	            $db->u->echohr();
	        }
			foreach($arr as $row)
			{
				$db->u->echoh5('<a href="'.$row->link.'" target="_blank">'.$row->title.'</a>');
				echo $row->description;
				$db->u->echop('<small><a href="'.strip_tags($row->link).'" target="_blank">'.strip_tags($row->link).'</a></small>');
				$db->u->echohr('Posted '.date("jS F Y",strtotime($row->pubDate)).'<br />');
			}
			?>
		</div>
	</div>
</div>