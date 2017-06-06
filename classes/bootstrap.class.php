<?php
class bootstrap
{
	public $s = NULL;
	function __construct()
	{

	}

	function tag($t = NULL, $s = NULL, $settingsArr = array())
	{
		if(is_null($t)) $t = 'div';
		$out = '<'.$t;
		$out .= $this->handleSettings($settingsArr);
		$out .= '>';
		$out .= $this->checkNulls($s).PHP_EOL;
		$out .= '</'.$t.'><!-- '.$t.' -->'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function echobr($s = NULL)
	{
		$out = $s.'<br />';
		$this->s = $out;
		return $out;
	}

	function echohr($s = NULL)
	{
		$out = $s.'<hr />';
		$this->s = $out;
		return $out;
	}

	function brecho($s = NULL)
	{
		$out = '<br />'.$s;
		$this->s = $out;
		return $out;
	}

	function hrecho($s = NULL)
	{
		$out = '<hr />'.$s;
		$this->s = $out;
		return $out;
	}

	function echon($s = NULL)
	{
		$out = $s."\n";
		$this->s = $out;
		return $out;
	}

	function necho($s = NULL)
	{
		$out = "\n".$s;
		$this->s = $out;
		return $out;
	}

	function echoeol($s = NULL)
	{
		$out = $s.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function eolecho($s = NULL)
	{
		$out = PHP_EOL.$s;
		$this->s = $out;
		return $out;
	}

	function testbr($s = NULL)
	{
		try
		{
			eval($s);
		}
		catch(Exception $e)
		{
    			$out = 'Caught exception: '.$e->getMessage().'<br />';
    			$this->s = $out;
			return $out;
		}
	}

	function brtest($s = NULL)
	{
		try
		{
			eval($s);
		}
		catch(Exception $e)
		{
    			$out = '<br />Caught exception: '.$e->getMessage();
    			$this->s = $out;
			return $out;
		}
	}

	function testn($s = NULL)
	{
		try
		{
			eval($s);
		}
		catch(Exception $e)
		{
    			$out = 'Caught exception: '.$e->getMessage()."\n";
    			$this->s = $out;
			return $out;
		}
	}

	function ntest($s = NULL)
	{
		try
		{
			eval($s);
		}
		catch(Exception $e)
		{
    			$out = "\n".'Caught exception: '.$e->getMessage();
    			$this->s = $out;
			return $out;
		}
	}

	function testeol($s = NULL)
	{
		try
		{
			eval($s);
		}
		catch(Exception $e)
		{
    			$out = 'Caught exception: '.$e->getMessage().PHP_EOL;
    			$this->s = $out;
			return $out;
		}
	}

	function eoltest($s = NULL)
	{
		try
		{
			eval($s);
		}
		catch(Exception $e)
		{
    			$out = PHP_EOL.'Caught exception: '.$e->getMessage();
    			$this->s = $out;
			return $out;
		}
	}

	function echotr($arr)
	{
		$out = '<tr>';
		foreach ($arr as $item)
		{
			$out .= '<td>'.$item.'</td>';
		}
		$out .= '<tr>';
		$this->s = $out;
		return $out;
	}

	function echoheader($n = 1, $s = NULL)
	{
		$out = '<h'.$n.'>'.$s.'</h'.$n.'>';
		$this->s = $out;
		return $out;
	}

	function echop($s = NULL)
	{
		$out = '<p>'.$s.'</p>';
		$this->s = $out;
		return $out;
	}

	function title($s = NULL, $sitename = NULL)
	{
		$out = '<title itemprop="name">';
		if((strtolower($s) == 'index.php') || (strtolower($s) == ''))
		{
			$out .= '';
		}
		else
		{
			$out .= ucwords($s);
		}
		$out .= $sitename;
		$out .= '</title>';
		$this->s = $out;
		return $out;
	}

	function singleRow($t = NULL, $s = NULL, $settingsArr = array('class'=>'col-md-12'))
	{
		$out = '<div class="row">'.PHP_EOL;
		$out .= '<div class="container">'.PHP_EOL;
		if(is_null($t)) $t = 'div';
		$out .= '<'.$t;
		$out .= $this->handleSettings($settingsArr);
		$out .= '>';
		$out .= $this->checkNulls($s).PHP_EOL;
		$out .= '</'.$t.'><!-- '.$t.' -->'.PHP_EOL;
		$out .= '</div><!-- .container -->'.PHP_EOL;
		$out .= '</div><!-- .row -->'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function twoHalves($t = NULL, $s1 = NULL, $s2 = NULL, $settingsArr = array('class'=>'col-md-6'))
	{
		$out = '<div class="row">'.PHP_EOL;
		$out .= '<div class="container">'.PHP_EOL;
		if(is_null($t)) $t = 'div';
		$out .= '<'.$t;
		$out .= $this->handleSettings($settingsArr);
		$out .= '>';
		$out .= $this->checkNulls($s1).PHP_EOL;
		$out .= '</'.$t.'><!-- '.$t.' -->'.PHP_EOL;
		if(is_null($t)) $t = 'div';
		$out .= '<'.$t;
		$out .= $this->handleSettings($settingsArr);
		$out .= '>';
		$out .= $this->checkNulls($s2).PHP_EOL;
		$out .= '</'.$t.'><!-- '.$t.' -->'.PHP_EOL;
		$out .= '</div><!-- .container -->'.PHP_EOL;
		$out .= '</div><!-- .row -->'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function threeThirds($t = NULL, $s1 = NULL, $s2 = NULL, $s3 = NULL, $settingsArr = array('class'=>'col-md-4'))
	{
		$out = '<div class="row">'.PHP_EOL;
		$out .= '<div class="container">'.PHP_EOL;
		if(is_null($t)) $t = 'div';
		$out .= '<'.$t;
		$out .= $this->handleSettings($settingsArr);
		$out .= '>';
		$out .= $this->checkNulls($s1).PHP_EOL;
		$out .= '</'.$t.'><!-- '.$t.' -->'.PHP_EOL;
		if(is_null($t)) $t = 'div';
		$out .= '<'.$t;
		$out .= $this->handleSettings($settingsArr);
		$out .= '>';
		$out .= $this->checkNulls($s2).PHP_EOL;
		$out .= '</'.$t.'><!-- '.$t.' -->'.PHP_EOL;
		if(is_null($t)) $t = 'div';
		$out .= '<'.$t;
		$out .= $this->handleSettings($settingsArr);
		$out .= '>';
		$out .= $this->checkNulls($s3).PHP_EOL;
		$out .= '</'.$t.'><!-- '.$t.' -->'.PHP_EOL;
		$out .= '</div><!-- .container -->'.PHP_EOL;
		$out .= '</div><!-- .row -->'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function table($headers = array(), $rows = array(), $id = NULL)
	{
		$out = '<table class="table table-striped table-condensed table-responsive"';
		if(!is_null($id)) $out .= ' id="'.$id.'"';
		$out .= '>'.PHP_EOL;
		if(!empty($headers))
		{
			$out .= '<thead><tr>'.PHP_EOL;
			foreach($headers as $head)
			{
				$out .= '<th>'.$head.'</th>'.PHP_EOL;
			}
			$out .= '</tr></thead>'.PHP_EOL;
		}
		else
		{
			$out .= $this->buildHeadFromData($rows);
		}
		if(!empty($rows))
		{
			$out .= '<tbody>'.PHP_EOL;
			if(count($rows) == 1) $out .= '<tr>';
			foreach($rows as $row)
			{
				// $out .= '<tr>';
				if(is_array($row))
				{
					$out .= '<tr>';
					foreach($row as $col)
					{
						$out .= '<td>'.$col.'</td>';
					}
					$out .= '</tr>'.PHP_EOL;
				}
				else
				{
					$out .= '<td>'.$row.'</td>';
				}
				// $out .= '</tr>'.PHP_EOL;
			}
			if(count($rows) == 1) $out .= '</tr>'.PHP_EOL;
			$out .= '</tbody>'.PHP_EOL;
		}

		$out .= '</table><!-- .table -->'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function buildHeadFromData($rows)
	{
		$out = NULL;
		$keys = array();
		if(is_array($rows))
		{
			if($this->isAssoc($rows) == TRUE)
			{
				$keys = array_keys($rows);
				$out .= $this->buildHead($keys);
			}
			elseif($this->isAssoc($rows[0]) == TRUE)
			{
				$keys = array_keys($rows[0]);
				$out .= $this->buildHead($keys);
			}

		}
		elseif($this->isAssoc($rows) == TRUE)
		{

			foreach($rows as $row)
			{
				if(is_array($row))
				{
					foreach($row as $col)
					{
						$keys = array_keys($row);
					}
				}
				else
				{
					$keys = array_keys($rows);
				}
			}
			$keys = array_unique($keys);
			$out .= $this->buildHead($keys);
		}
		return $out;
	}

	function buildHead($arr = array())
	{
		$out = NULL;
		$out .= '<thead><tr>'.PHP_EOL;
		foreach($arr as $item)
		{
			$out .= '<th>'.$item.'</th>'.PHP_EOL;
		}
		$out .= '</tr></thead>'.PHP_EOL;
		return $out;
	}

	function form($fields = NULL, $action = NULL, $upload = FALSE, $role = 'form', $additionalClasses = array(), $id = NULL)
	{
		$out = NULL;
		$out .= '<form action="'.$action.'" method="POST"';
		if($upload == TRUE)
		{
			$out.= ' enctype="multipart/form-data"';
		}
		if(!empty($additionalClasses))
		{
			$out .= ' class="';
			foreach ($additionalClasses as $ac)
			{
				$out .= $ac.' ';
			}
			$out = trim($out);
			$out .= '"';
		}
		if(!is_null($role)) $out.= ' role="'.$role.'"';
		if(!is_null($id)) $out .= ' id="'.$id.'"';
		$out .= '>'.PHP_EOL;
		if(is_array($fields))
		{
			foreach ($fields as $field)
			{
				$out .= $field;
			}
		}
		else
		{
			$out .= $this->checkNulls($fields);
		}
		$out .= '<button type="submit" class="btn btn-primary">Submit</button>';
		$out .= '</form>'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function input($name = NULL, $label = NULL, $type = 'text', $value = NULL, $id = NULL)
	{
		$out = NULL;
		$out .= '<div class="form-group">'.PHP_EOL;
		$out .= '<label for="'.$name.'">'.$label.'</label>'.PHP_EOL;
		$out .= '<input type="'.$type.'" name="'.$name.'" class="form-control"';
		if(!is_null($value))
		{
			$out .= ' value="'.$value.'"';
		}
		$out .= ' ';
		if(!is_null($id)) $out .= ' id="'.$id.'"';
		$out .= ' />'.PHP_EOL;
		$out .= '</div><!-- .form-group -->'.PHP_EOL;
		return $out;
	}

	function checkbox($name = NULL, $label = NULL, $value = FALSE)
	{
		$out = NULL;
		$out .= '<div class="form-group">'.PHP_EOL;
		$out .= '<div class="checkbox">'.PHP_EOL;
		$out .= '<label>'.PHP_EOL;
		$out .= '<input name="'.$name.'" type="checkbox"';
		if($value == TRUE)
		{
			$out .= ' CHECKED';
		}
		$out .= ' /> '.$label.PHP_EOL;
		$out .= '</label>'.PHP_EOL;
		$out .= '</div><!-- .checkbox -->'.PHP_EOL;
		$out .= '</div><!-- .form-group -->'.PHP_EOL;
		return $out;
	}

	function textarea($name = NULL, $label = NULL, $value = NULL, $additionalClasses = array(), $id = NULL)
	{
		$out = NULL;
		$out .= '<div class="form-group">'.PHP_EOL;
		$out .= '<label for="'.$name.'">'.$label.'</label>'.PHP_EOL;
		$out .= '<textarea ';
		$out .= $this->addFormClasses($additionalClasses);
		$out .= ' rows="3" name="'.$name.'"';
		if(!is_null($id)) $out .= ' id="'.$id.'"';
		$out .= '>'.PHP_EOL;
		if(!is_null($value))
		{
			$out .= $value;
		}
		$out .= '</textarea>'.PHP_EOL;
		$out .= '</div><!-- .form-group -->'.PHP_EOL;
		return $out;
	}

	function hiddeninput($name = NULL, $value = NULL)
	{
		$out = NULL;
		$out .= '<input type="hidden" name="'.$name.'"';
		if(!is_null($value))
		{
			$out .= ' value="'.$value.'"';
		}
		$out .= ' />'.PHP_EOL;
		return $out;
	}

	function addFormClasses($c = array())
	{
		$out = NULL;
		$out .= ' class="form-control ';
		if(!empty($c))
		{
			foreach ($c as $ac)
			{
				$out .= $ac.' ';
			}
		}
		$out = trim($out);
		$out .= '"';
		return $out;
	}

	function select($name = NULL, $label = NULL, $optionArr = array(), $selected = NULL, $additionalClasses = array(), $id = NULL)
	{
		$out = NULL;
		$out .= '<div class="form-group">'.PHP_EOL;
		$out .= '<label for="'.$name.'">'.$label.'</label>'.PHP_EOL;
		$out .= '<select ';
		$out .= $this->addFormClasses($additionalClasses);
		$out .= ' name="'.$name.'"';
		if(!is_null($id)) $out .= ' id="'.$id.'"';
		$out .= '>'.PHP_EOL;
		if(!empty($optionArr))
		{
			if($this->isAssoc($optionArr) == TRUE)
			{
				foreach($optionArr as $key => $value)
				{
					$out .= '<option value="'.$key.'"';
					if($selected == $key) $out .= ' SELECTED';
					$out .= '>'.$value.'</option>'.PHP_EOL;
				}
			}
			else
			{
				foreach ($optionArr as $option)
				{
					if(is_array($option))
					{
						$tempArr = $option;
						$keys = array_keys($tempArr);
						foreach ($keys as $key)
						{
							$out .= '<option value="'.$key.'"';
							if($selected == $key) $out .= ' SELECTED';
							$out .= '>'.$tempArr[$key].'</option>'.PHP_EOL;
						}
					}
					else
					{
						$out .= '<option';
						if($selected == $option) $out .= ' SELECTED';
						$out .= '>'.$option.'</option>'.PHP_EOL;
					}
				}
			}
		}
		$out .= '</select>'.PHP_EOL;
		$out .= '</div><!-- .form-group -->'.PHP_EOL;
		return $out;
	}

	function radio($name = NULL, $optionArr = array(), $selected = NULL)
	{
		$out = NULL;
		$out .= '<div class="form-group">'.PHP_EOL;
		foreach($optionArr as $value => $label)
		{
			$out .= '<div class="radio">'.PHP_EOL;
			$out .= '<label>'.PHP_EOL;
			$out .= '<input type="radio" name="'.$name.'" value="'.$value.'" id="'.$name.$value.'"';
			if($selected == $value) $out .= ' CHECKED';
			$out .= ' />'.PHP_EOL;
    			$out .= $label.PHP_EOL;
			$out .= '</label>'.PHP_EOL;
			$out .= '</div><!-- .radio -->'.PHP_EOL;
		}
		$out .= '</div><!-- .form-group -->'.PHP_EOL;
		return $out;
	}

	function reCAPTCHA()
	{
		$out = NULL;
		require_once 'database.class.php';
		$db = new database;
		$out .= '<div class="g-recaptcha" data-sitekey="'.$db->getVal('recaptcha-sitekey').'"></div>'.PHP_EOL;
		return $out;
	}

	function dateField($name = 'date', $label = 'Date', $dateToAdd = NULL)
	{
		$out = NULL;
		if(is_null($dateToAdd))
		{
			$todaysDate = date("Y-m-d");
		}
		else
		{
			$todaysDate = $dateToAdd;
		}
		$out .= '<div class="form-group">'.PHP_EOL;
		$out .= '<label for="'.$name.'">'.$label.'</label>'.PHP_EOL;
		$out .= '<input id="'.$name.'" name="'.$name.'" class="datepicker form-control"  data-date-format="yyyy-mm-dd" value="'.$todaysDate.'" />'.PHP_EOL;
		$out .= '</div><!-- .form-group -->'.PHP_EOL;
		return $out;
	}

	function mediaobject($src = NULL, $alt = NULL, $href = '#', $heading = NULL, $body = NULL, $align = 'left', $id = NULL)
	{
		$out = NULL;
		$out .= '<div class="media"';
		if(!is_null($id)) $out .= ' id="'.$id.'"';
		$out .= '>'.PHP_EOL;
		$out .= '<div class="media-'.$align.'">'.PHP_EOL;
    		$out .= '<a href="'.$href.'">'.PHP_EOL;
		$out .= '<img class="media-object" src="'.$src.'" alt="'.$alt.'" />'.PHP_EOL;
		$out .= '</a>'.PHP_EOL;
		$out .= '</div><!-- .media-left -->'.PHP_EOL;
		$out .= '<div class="media-body">'.PHP_EOL;
		$out .= '<h4 class="media-heading">'.$heading.'</h4>'.PHP_EOL;
		$out .= $body;
		$out .= '</div><!-- .media-body -->'.PHP_EOL;
		$out .= '</div><!-- .media -->'.PHP_EOL;
		$this->s = $out;
		return $out;

	}

	function carousel($imgArr = array())
	{
		$out = NULL;
		$items = NULL;
		$out .= '<div id="mycarousel" class="carousel slide" data-ride="carousel">'.PHP_EOL;
		$out .= '<div class="carousel-inner">'.PHP_EOL;
		$count = 0;
		foreach($imgArr as $img)
		{
			$anImage = $this->tag('img',NULL,array('src'=>$img,'alt'=>'Gallery item','class'=>'img-responsive'));
			if($count == 0)
			{
				$items .= $this->tag('div',$anImage,array('class'=>array('item','active')));
				$count++;
			}
			else
			{
				$items .= $this->tag('div',$anImage,array('class'=>'item'));
			}
		}
		$inner = $this->tag('div',$items,array('class'=>'carousel-inner'));
		$out = $this->tag('div',$inner,array('id'=>'mycarousel','data-ride'=>'carousel','class'=>'carousel slide'));
		$this->s = $out;
		return $out;
	}

	function panel($content = '', $header = NULL, $footer = NULL)
	{
		$out = NULL;
		$out .= '<div class="panel panel-default">'.PHP_EOL;
		if(!is_null($header))
  		{
  			$out .= '<div class="panel-heading">'.PHP_EOL;
  			$out .= '<h3 class="panel-title">'.$header.'</h3>'.PHP_EOL;
  			$out .= '</div><!-- .panel-heading -->'.PHP_EOL;
  		}
  		$out .= '<div class="panel-body">'.PHP_EOL;
  		$out .= $content.PHP_EOL;
  		$out .= '</div><!-- .panel-body -->'.PHP_EOL;
  		if(!is_null($footer))
  		{
  			$out .= '<div class="panel-footer">'.PHP_EOL;
  			$out .= $footer;
  			$out .= '</div><!-- .panel-footer -->'.PHP_EOL;
  		}
		$out .= '</div><!-- .panel -->'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function buttonLink($s, $href = '#', $c = 'btn-primary', $target = '_self')
	{
		$out = NULL;
		$out .= '<a class="btn '.$c.'" role="button" href="'.$href.'" target="'.$target.'">'.$s.'</a>'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function img($src = '#', $alt = NULL, $shape = NULL)
	{
		$out = NULL;
		$out .= '<img src="'.$src.'" class="img-responsive" alt="'.$alt.'"';
		if(!is_null($shape))
		{
			$out .= ' class="'.$shape.'"';
		}
		$out .= ' />'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function modal($id = 'myModal', $content = NULL, $header = NULL, $c = 'btn-default', $showSubmit = FALSE)
	{
		$out = NULL;
		$out .= '<div class="modal fade" id="'.$id.'" tabindex="-1" role="dialog" aria-labelledby="'.$id.'Label">'.PHP_EOL;
		$out .= '<div class="modal-dialog" role="document">'.PHP_EOL;
		$out .= '<div class="modal-content">'.PHP_EOL;
		if(!is_null($header))
		{
			$out .= '<div class="modal-header">'.PHP_EOL;
			$out .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.PHP_EOL;
			$out .= '<h4 class="modal-title" id="'.$id.'Label">'.$header.'</h4>'.PHP_EOL;
			$out .= '</div><!-- .modal-header -->'.PHP_EOL;
		}
		$out .= '<div class="modal-body">'.PHP_EOL;
		$out .= $content;
		$out .= '</div><!-- .modal-body -->'.PHP_EOL;
		$out .= '<div class="modal-footer">'.PHP_EOL;
		if($showSubmit == TRUE) $out .= '<button type="button" class="btn '.$c.'">Submit</button>'.PHP_EOL;
		$out .= '<button type="button" class="btn '.$c.'" data-dismiss="modal">Close</button>'.PHP_EOL;
		$out .= '</div><!-- .modal-footer -->'.PHP_EOL;
		$out .= '</div><!-- .modal-content -->'.PHP_EOL;
		$out .= '</div><!-- .modal-dialog -->'.PHP_EOL;
		$out .= '</div><!-- #'.$id.' -->'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function modalLink($id = NULL, $s = NULL)
	{
		$out = NULL;
		$out .= '<a data-toggle="modal" data-target="#'.$id.'">'.$s.'</a>'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function alert($content, $type = 'warning')
	{
		$out = NULL;
		$out .= '<div class="alert alert-';
		$out .= $type.'" role="alert">';
		$out .= $content.PHP_EOL;
		$out .= '</div><!-- .alert -->'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function isAssoc($arr)
	{
	    return array_keys($arr) !== range(0, count($arr) - 1);
	}

	function checkNulls($s)
	{
		if(!is_null($s))
		{
			return $s.PHP_EOL;
		}
	}

	function handleSettings($sarr = array())
	{
		$out = '';
		if(!empty($sarr))
		{
			foreach($sarr as $key => $value)
			{
				if(is_array($value))
				{
					$out .= ' '.$this->handleSettingArrayValues($key, $value);
				}
				else
				{
					if($key == 'itemtype')
					{
						$out .= ' itemscope '.$key.'="'.$value.'"';
					}
					else
					{
						$out .= ' '.$key.'="'.$value.'"';
					}
				}
			}
		}
		return $out;
	}

	function handleSettingArrayValues($key = NULL, $value = array())
	{
		$out = '';
		switch($key)
		{
			case 'class':
				$out .= $key.'="';
				$out .= $this->handleValueArrays($value);
				$out .= '"';
				break;
			default:
				# code...
				break;
		};
		return $out;
	}

	function handleValueArrays($v = array())
	{
		$out = '';
		foreach ($v as $item)
		{
			$out .= ' '.$item;
		}
		$out = ltrim($out);
		return $out;
	}

	function render()
	{
		echo $this->s;
		$this->s = '';
	}

	function __destruct()
	{

	}
}
?>