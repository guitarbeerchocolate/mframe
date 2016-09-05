<?php
require_once 'database.class.php';
class searchpdo extends database
{
	private $tableArr, $fieldArr;
	function __construct($tableArr, $fieldArr = NULL, $q = NULL)
	{
		parent::__construct();
		$this->tableArr = $tableArr;
		$this->fieldArr = $fieldArr;
		$this->formatAndReturn($q);
	}

	function formatAndReturn($q)
	{
		$sArr = explode(' ', $q);	
		$boolean = $this->checkForBool($sArr);
		$s = NULL;
		$sArr = array_diff($sArr, array($boolean));		
		if($boolean == "OR")
		{
			$this->createORstring($sArr);
		}
		elseif($boolean == "AND")
		{
			$this->createANDstring($sArr);
		}
		else
		{
			$this->createNormalstring($q);
		}
	}

	function checkForBool($sArr)
	{
		$boolean = NULL;
		foreach ($sArr as $searchwords)
		{
			if(($searchwords == "OR") || ($searchwords == "AND"))
			{
				$boolean = $searchwords;
			}			
		}
		return $boolean;
	}

	function createNormalstring($q)
	{
		$colArr = array();
		foreach ($this->tableArr as $table)
		{
			$ss = NULL;
			$ss = "SELECT * FROM `".$table."` WHERE ";
			$colArr = $this->getFieldsFromTable($table);
			foreach ($colArr as $col)
			{
				// This is the area of concentration
				$ss .= "`".$col."` LIKE '%$q%' OR ";
			}
			$ss = rtrim($ss," OR ");			
			$rows = $this->query($ss);
			$this->buildTable($rows, $colArr, $table);
		}
	}

	function createORstring($sArr)
	{
		$colArr = array();
		foreach ($this->tableArr as $table)
		{
			$ss = NULL;
			$ss = "SELECT * FROM `".$table."` WHERE ";
			$colArr = $this->getFieldsFromTable($table);			
			foreach ($colArr as $col)
			{
				foreach ($sArr as $q)
				{
					$ss .= "`".$col."` LIKE '%$q%' OR ";
				}				
			}
			$ss = rtrim($ss," OR ");			
			$rows = $this->query($ss);
			$this->buildTable($rows, $colArr, $table);
		}
	}

	function createANDstring($sArr)
	{
		$colArr = array();
		foreach ($this->tableArr as $table)
		{
			$ss = NULL;
			$ss = "SELECT * FROM `".$table."` WHERE ";
			$colArr = $this->getFieldsFromTable($table);			
			foreach ($colArr as $col)
			{
				foreach ($sArr as $q)
				{
					$ss .= "`".$col."` LIKE '%$q%' AND ";
				}
				$ss = rtrim($ss," AND ");
				$ss .= " OR ";
			}
			$ss = rtrim($ss," OR ");			
			$rows = $this->query($ss);
			$this->buildTable($rows, $colArr, $table);
		}
	}

	function getFieldsFromTable($tn)
	{
		$outArr = array();
		$schema = $this->settings['schema'];
		$s = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='{$schema}' AND `TABLE_NAME`='{$tn}'";
		$rows = $this->performquery($s);
		foreach ($rows as $row)
		{
			if(strtolower($row['COLUMN_NAME']) !== 'id')
			{
				array_push($outArr, $row['COLUMN_NAME']);
			}
		}
		return $outArr;
	}

	function buildBody($rows, $colArr, $table)
	{
		foreach ($rows as $row)
		{
			if($row['suspend'] != 1)
			{
				echo '<tr itemscope itemtype="http://schema.org/Service">';			
				echo '<td class="thirty"><a href="service&id='.$row['id'].'">';
				if(!empty($row['photo']))
				{
					echo '<img src="'.$row['photo'].'" alt="'.$row['name'].'" class="img-responsive margtopbit base64" itemprop="image" data-id="'.$row['id'].'" />';
					/* echo '<img src="'.$row['photo'].'" alt="'.$row['name'].'" class="img-responsive margtopbit base64" itemprop="image" />'; */
				}
				else
				{
					$this->u->base64_image('img/blank.png', 'Blank');
				}
				echo '<i class="fa fa-spinner fa-spin fa-4x fa-fw"></i>';
				echo '</a></td>';
				echo '<td id="description"><a href="service&id='.$row['id'].'"><h4 itemprop="name">'.$row['name'].'</h4></a>';
				echo '<section itemprop="description">'.$row['description'].'</section>';
				$this->u->echop($row['county']);

				$avgRating = $this->averageValue('experiences', 'overallrating', $row['id']);
				if($avgRating != 0)
				{
					echo 'Average rating = '.round($avgRating, 1);
				}
				$exp = $this->getAllByFieldValue('experiences','serviceid',$row['id']);
				$totalRecommended = 0;
				foreach ($exp as $e)
				{
					if($e['recommend'] == 1) $totalRecommended++;
				}
				if($totalRecommended != 0)
				{
					$this->u->echop($totalRecommended.' out of '.count($exp).' reviewers recommended this service.');
				}
				echo '</td>';
				echo '</tr>'.PHP_EOL;
			}
		}
	}

	function buildTable($rows, $colArr, $table)
	{
		if(count($rows) > 0)
		{
			echo '<div class="table-responsive">';
			echo '<table class="table table-condensed table-hover" id="searchresults">'.PHP_EOL;
			echo '<tbody>'.PHP_EOL;
			$this->buildBody($rows, $colArr, $table);
			echo '</tbody></table>'.PHP_EOL;
			echo '</div>'.PHP_EOL;
		}
	}

	function isAssoc($arr)
	{
		return array_keys($arr) !== range(0, count($arr) - 1);
	}
}
?>