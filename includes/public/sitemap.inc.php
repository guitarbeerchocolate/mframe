<div class="row">
	<div class="container">
		<aside class="col-md-4">
		<?php
		include_once 'includes/general/advertising.inc.php';
		?>	
		</aside>
		<div class="col-md-8">
			<h2>Sitemap</h2>						
			<?php
			$hasParams = FALSE;			
      		/*
      		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li><a href="#">Library</a></li>
			<li class="active">Data</li>
			</ol>
      		*/
      		$query = NULL;
      		$nullField = NULL;
      		$query = "SELECT * FROM services WHERE ";
			if(isset($_GET['tags']) && (strtoupper($_GET['tags']) !== 'NULL'))
			{
				$tagStr = 'tags = '.$_GET['tags'];
				$hasParams = TRUE;
			}
			elseif(isset($_GET['tags']) && (strtoupper($_GET['tags']) == 'NULL'))
			{
				$query = "SELECT DISTINCT tags FROM service";
				$nullField = 'tags';
				$hasParams = FALSE;
			}
			if(isset($_GET['county']) && (strtoupper($_GET['county']) !== 'NULL'))
			{
				$countyStr = 'county = '.$_GET['county'];
				$hasParams = TRUE;
			}
			elseif(isset($_GET['county']) && (strtoupper($_GET['county']) == 'NULL'))
			{
				$query = "SELECT DISTINCT county FROM service";
				$nullField = 'county';
				$hasParams = FALSE;
			}
			if(isset($_GET['rating']) && (strtoupper($_GET['rating']) !== 'NULL'))
			{
				$ratingStr = 'rating = '.$_GET['rating'];
				$hasParams = TRUE;
			}
			elseif(isset($_GET['rating']) && (strtoupper($_GET['rating']) == 'NULL'))
			{
				$query = "SELECT DISTINCT rating FROM service";
				$nullField = 'rating';
				$hasParams = FALSE;
			}
			if($hasParams == TRUE)
			{
				echo 'You can do a search and this is the order : <br />';
				$paramCount = 0;
				
				foreach($_GET as $key => $value)
				{
					if($key !== 'params')
					{
						if($paramCount == 0)
						{
							switch($key)
							{
								case 'tags':
									$query .= $tagStr;
									break;
								case 'county':
									$query .= $countyStr;
									break;
								case 'rating':
									$query .= $ratingStr;
									break;
							}
						}
						else
						{
							switch($key)
							{
								case 'tags':
									$query .= ' AND '.$tagStr;
									break;
								case 'county':
									$query .= ' AND '.$countyStr;
									break;
								case 'rating':
									$query .= ' AND '.$ratingStr;
									break;
							}
						}
						$paramCount++;
					}
				}
				echo '<br />The query is '.$query;
				/* Perform query */
			}
			elseif(($hasParams == FALSE) && ($query !== NULL))
			{
				echo 'Do the NULL query of '.$query;
				
				$services = $db->performquery($query);
				foreach ($services as $service)
				{
					$anc = '<a href="sitemap&'.$nullField.'='.$service[$nullField].'">'.$service[$nullField].'</a>';
					$db->u->echop($anc);
				}
				
			}			
			if(empty($_GET))
			{
				echo '<h3>Start again</h3>';
			}
			?>			
			<p><a href="sitemap&tags=NULL">By service type</a></p>
			<p><a href="sitemap&county=NULL">By county</a></p>
			<p><a href="sitemap&rating=NULL">By rating</a></p>
		</div>
	</div>
</div>