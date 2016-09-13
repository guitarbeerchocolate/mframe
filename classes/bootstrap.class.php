<?php
class bootstrap
{
	public $s = NULL;
	function __construct()
	{

	}

	function hr()
	{
		$out = '<hr />'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function br()
	{
		$out = '<br />'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function row($s = NULL, $tag = 'div', $id = NULL)
	{
		$out = '<'.$tag.' class="row"';
		if(!is_null($id)) $out .= ' id="'.$id.'"';
		$out .= '>'.PHP_EOL;
		$out .= $this->checkNulls($s);
		$out .= '</'.$tag.'><!-- .row -->'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function container($s = NULL)
	{
		$out = '<div class="container">'.PHP_EOL;
		$out .= $this->checkNulls($s);
		$out .= '</div><!-- .container -->'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function column($s, $width = 12, $tag = 'div')
	{
		$out = '<'.$tag.' class="col-md-'.$width.'">'.PHP_EOL;
		$out .= $this->checkNulls($s);
		$out .= '</'.$tag.'><!-- .col-md-'.$width.' -->'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function table($headers = array(), $rows = array())
	{
		$out = '<table class="table table-striped table-condensed table-responsive">'.PHP_EOL;
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

	function form($fields = NULL, $action = NULL, $upload = FALSE, $role = 'form', $additionalClasses = array())
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
		
		$out.= ' role="'.$role.'">'.PHP_EOL;
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
		return $out;
	}

	function input($name = NULL, $label = NULL, $type = 'text', $value = NULL)
	{
		$out = NULL;
		$out .= '<div class="form-group">'.PHP_EOL;
		$out .= '<label for="'.$name.'">'.$label.'</label>'.PHP_EOL;
		$out .= '<input type="'.$type.'" name="'.$name.'" class="form-control"';
		if(!is_null($value))
		{
			$out .= ' value="'.$value.'"';
		}
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

	function textarea($name = NULL, $label = NULL, $value = NULL, $additionalClasses = array())
	{
		$out = NULL;
		$out .= '<div class="form-group">'.PHP_EOL;
		$out .= '<label for="'.$name.'">'.$label.'</label>'.PHP_EOL;
		$out .= '<textarea ';
		$out .= $this->addClasses($additionalClasses);
		$out .= ' rows="3" name="'.$name.'">';
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
		$out .= '<input type="hidden" name="'.$name;
		if(!is_null($value))
		{
			$out .= ' value="'.$value.'"';
		}
		$out .= ' />'.PHP_EOL;
		return $out;
	}

	function addClasses($c = array())
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

	function select($name = NULL, $label = NULL, $optionArr = array(), $selected = NULL, $additionalClasses = array())
	{
		$out = NULL;
		$out .= '<div class="form-group">'.PHP_EOL;
		$out .= '<label for="'.$name.'">'.$label.'</label>'.PHP_EOL;
		$out .= '<select ';
		$out .= $this->addClasses($additionalClasses);
		$out .= ' name="'.$name.'">'.PHP_EOL;
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

	function img($src = NULL, $alt = NULL)
	{
		return '<img src="'.$src.'" class="img-responsive" alt="'.$alt.'" />';
	}

	function mediaobject($src = NULL, $alt = NULL, $href = '#', $heading = NULL, $body = NULL, $align = 'left')
	{
		$out = NULL;
		$out .= '<div class="media">'.PHP_EOL;
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
		return $out;

	}

	function floatleft($s = NULL)
	{
		$out = NULL;
		$out .= '<div class="pull-left">'.PHP_EOL;
		$out .= $s.PHP_EOL;
		$out .= '</div><!-- .pull-left -->'.PHP_EOL;
		return $out;
	}

	function floatright($s = NULL)
	{
		$out = NULL;
		$out .= '<div class="pull-right">'.PHP_EOL;
		$out .= $s.PHP_EOL;
		$out .= '</div><!-- .pull-right -->'.PHP_EOL;
		return $out;
	}

	function centre($s = NULL)
	{
		$out = NULL;
		$out .= '<div class="center-block">'.PHP_EOL;
		$out .= $s.PHP_EOL;
		$out .= '</div><!-- .center-block -->'.PHP_EOL;
		return $out;
	}

	function clearfix($s = NULL)
	{
		$out = NULL;
		$out .= '<div class="clearfix">'.PHP_EOL;
		$out .= $s.PHP_EOL;
		$out .= '</div><!-- .clearfix -->'.PHP_EOL;
		return $out;
	}

	function pageheader($s = NULL)
	{
		$out = NULL;
		$out .= '<div class="page-header">'.PHP_EOL;
		$out .= $s.PHP_EOL;
		$out .= '</div><!-- .page-header -->'.PHP_EOL;
		return $out;
	}

	function jumbotron($s = NULL)
	{
		$out = NULL;
		$out .= '<div class="jumbotron">'.PHP_EOL;
		$out .= $s.PHP_EOL;
		$out .= '</div><!-- .jumbotron -->'.PHP_EOL;
		return $out;
	}

	function header($level = 1, $s)
	{
		$out = NULL;
		$out .= '<h'.$level.'>'.PHP_EOL;
		$out .= $s.PHP_EOL;
		$out .= '</h'.$level.'><!-- h'.$level.' -->'.PHP_EOL;
		return $out;
	}

	function alert($s = NULL, $type = 'success')
	{
		$out = NULL;
		$out .= '<div class="alert alert-'.$type.'" role="alert">'.PHP_EOL;
		$out .= $s.PHP_EOL;
		$out .= '</div><!-- .alert -->'.PHP_EOL;
		return $out;
	}

	function panel($s = NULL, $header = NULL, $footer = NULL)
	{
		$out = NULL;
		$out .= '<div class="panel panel-default">'.PHP_EOL;
		if(!is_null($header)) $out .= '<div class="panel-heading">'.$header.'</div>'.PHP_EOL;
		$out .= '<div class="panel-body"></div>'.PHP_EOL;
		if(!is_null($footer)) $out .= '<div class="panel-footer">'.$footer.'</div>'.PHP_EOL;
		$out .= '</div><!-- .panel -->'.PHP_EOL;
		return $out;
	}

	function well($s = NULL)
	{
		$out = NULL;
		$out .= '<div class="well">'.PHP_EOL;
		$out .= $s.PHP_EOL;
		$out .= '</div><!-- .well -->'.PHP_EOL;
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

	function render()
	{
		echo $this->s;
	}

	function __destruct()
	{

	}
}
?>