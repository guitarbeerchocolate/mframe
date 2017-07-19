<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h2>Test page</h2>
			<?php
			$db->u->print_array_structure($liveConfig)
			// $bs->tag('h2','Hello world!', array('class'=>array('red', 'green', 'blue')));
			// $bs->tag('h2','Hello world!', array('class'=>array('red')));
			// $bs->tag('h2','Hello world!', array('id'=>'orange'));
			/*
			$bs->tag('h2','Hello world!', array('class'=>array('red', 'green', 'blue'),
			'id'=>'orange', 'itemtype'=>'http://schema.org/Organization'));
			$bs->render();
			*/
			/*
			$rows = $db->performquery('SELECT * FROM news USE INDEX (content)');
			foreach ($rows as $row)
			{
				echo '<h2>'.$row['name'].'</h2>';
				echo $row['content'];
				echo '<hr />';
			}
			*/
			/*
			$feedTest = simplexml_load_file('https://www.pinterest.com/mick/feed.rss');
			var_dump($feedTest);
			*/
			/*
			require_once 'classes/bootstrap.class.php';
			$html = new bootstrap;
			$hr = $html->hr();
			*/
			/*
			$headers = array('First', 'Second', 'Third');
			$data = array(array('1','2','3'),array('4','5','6'),array('7','8','9'));
			$table = $html->table($headers, $data);
			*/

			/*
			$data = array('First'=>'1','Second'=>'2','Third'=>'3');
			$table = $html->table(NULL, $data);
			*/

			/*
			$data = array(array('1','2','3'),array('4','5','6'),array('7','8','9'));
			$table = $html->table(NULL, $data);
			*/

			/*
			$data = array(array('First'=>'1','Second'=>'2','Third'=>'3'), array('First'=>'4','Second'=>'5','Third'=>'6'), array('First'=>'7','Second'=>'8','Third'=>'9'));
			$table = $html->table(NULL, $data);
			*/
			/*
			$input = $html->input('mick', 'My field');
			$checkbox = $html->checkbox('mickeroo', 'My checkbox', TRUE);
			$textarea = $html->textarea('micktastic', 'My textarea', 'Put this inside', array('tinymce'));
			*/
			/* $select = $html->select('mickie', 'My selector', array(1,2,3,4),3); */
			/*
			$select = $html->select('mickie', 'My selector', array(1=>'One',2=>'Two',3=>'Three',4=>'Four'),3, array('beer'));

			$radio = $html->radio('mickster', array(1=>'One',2=>'Two',3=>'Three',4=>'Four'),3);

			$body = '<p>It is time for you to stop all of your sobbing</p><p>Yes it\'s time for you to stop all of your sobbing oh oh oh</p><p>There\'s one thing you gotta do</p><p>To make me.</p>';
			$md = $html->mediaobject('media.jpg', 'Tom and Emily', '#', 'Tom and Emily', $body);

			$inputArr = array($input, $checkbox, $textarea, $select, $radio);
			$form = $html->form($inputArr, 'hello.php', FALSE, 'form');

			$col = $html->column($form.$md);
			$con = $html->container($col);
			$html->row($con);
			$html->render();
			*/
			?>
		</div>
	</div>
</div>