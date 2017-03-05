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
		$out .= '<button type="submit" class="btn btn-default">Submit</button>';
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
					$out .= '<option';
					if($selected == $option) $out .= ' SELECTED';
					$out .= '>'.$option.'</option>'.PHP_EOL;
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
			$out .= '<input type="radio" name="'.$name.'" value="'.$value.'"';
			if($selected == $value) $out .= ' CHECKED';
			$out .= ' />'.PHP_EOL;
    		$out .= $label.PHP_EOL;
			$out .= '</label>'.PHP_EOL;
			$out .= '</div><!-- .radio -->'.PHP_EOL;
		}
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