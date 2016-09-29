<?php
class bootstrap
{
	public $s = NULL;
	function __construct()
	{

	}

	function tag($t, $s, $classArr = NULL)
	{
		$out = '<'.$t;
		$out .= $this->addClasses($classArr);
		$out .= '>'.$s.'</'.$t.'>'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function hr($s = NULL)
	{
		$out = $this->checkNulls($s);
		$out .= '<hr />'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function br($s = NULL)
	{
		$out = $this->checkNulls($s);
		$out .= '<br />'.PHP_EOL;
		$this->s = $out;
		return $out;
	}

	function anchorblank($url = NULL, $label = NULL)
	{
		$out = '<a href="'.$url.'" target="_blank">';
		if(!is_null($label))
		{
			$out .= $label;
		}
		else
		{
			$out .= $url;
		}
		$out .= '</a>';
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

	function column($s, $width = 12, $tag = 'div', $ampArr = NULL, $schemaArr = NULL)
	{
		$out = '<'.$tag.' class="col-md-'.$width.'"';
		$out .= $this->setAMP($ampArr);
		$out .= $this->setSchema($schemaArr);
		$out .= '>'.PHP_EOL;
		$out .= $this->checkNulls($s);
		$out .= '</'.$tag.'><!-- .col-md-'.$width.' -->'.PHP_EOL;
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
		$out.= ' role="'.$role.'"';
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
		$out .= '<input type="hidden" name="'.$name;
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

	function img($src = NULL, $alt = NULL, $id = NULL)
	{
		$out = '<img src="'.$src.'" class="img-responsive" alt="'.$alt.'"';
		if(!is_null($id)) $out .= ' id="'.$id.'"';
		$out .= ' />'.PHP_EOL;		
		return  $out;
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

	function pageheader($s = NULL, $id = NULL)
	{
		$out = NULL;
		$out .= '<div class="page-header"';
		if(!is_null($id)) $out .= ' id="'.$id.'"';
		$out .= '>'.PHP_EOL;
		$out .= $s.PHP_EOL;
		$out .= '</div><!-- .page-header -->'.PHP_EOL;
		return $out;
	}

	function jumbotron($s = NULL, $id = NULL)
	{
		$out = NULL;
		$out .= '<div class="jumbotron"';
		if(!is_null($id)) $out .= ' id="'.$id.'"';
		$out .= '>'.PHP_EOL;
		$out .= $s.PHP_EOL;
		$out .= '</div><!-- .jumbotron -->'.PHP_EOL;
		return $out;
	}

	function header($level = 1, $s, $id = NULL)
	{
		$out = NULL;
		$out .= '<h'.$level.'';
		if(!is_null($id)) $out .= ' id="'.$id.'"';
		$out .= '>'.PHP_EOL;
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

	function panel($s = NULL, $header = NULL, $footer = NULL, $id = NULL)
	{
		$out = NULL;
		$out .= '<div class="panel panel-default"';
		if(!is_null($id)) $out .= ' id="'.$id.'"';
		$out .= '>'.PHP_EOL;
		if(!is_null($header)) $out .= '<div class="panel-heading">'.$header.'</div>'.PHP_EOL;
		$out .= '<div class="panel-body"></div>'.PHP_EOL;
		if(!is_null($footer)) $out .= '<div class="panel-footer">'.$footer.'</div>'.PHP_EOL;
		$out .= '</div><!-- .panel -->'.PHP_EOL;
		return $out;
	}

	function well($s = NULL, $id = NULL)
	{
		$out = NULL;
		$out .= '<div class="well">'.PHP_EOL;
		$out .= $s.PHP_EOL;
		$out .= '</div><!-- .well -->'.PHP_EOL;
		return $out;
	}

	function image($src, $alt)
	{
		return '<img src="'.$src.'" alt="'.$alt.'" class="img-responsive" />';
	}

	function carousel($imgArr = array())
	{
		$out = NULL;
		$out .= '<div id="mycarousel" class="carousel slide" data-ride="carousel">'.PHP_EOL;
		$out .= '<div class="carousel-inner">'.PHP_EOL;
		$count = 0;
		foreach($imgArr as $img)
		{
			$anImage = $this->image($img,'Gallery item');
			if($count == 0)
			{
				$out .= $this->tag('div',$anImage,array('item','active'));				
				$count++;
			}
			else
			{
				$out .= $this->tag('div',$anImage,'item');
			}
		}
		$out .= '</div><!-- .carousel-inner -->'.PHP_EOL;
		/* $out .= '<a class="left carousel-control" href="#mycarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control" href="#mycarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>'.PHP_EOL; */
		$out .= '</div><!-- #mycarousel -->'.PHP_EOL;
		return $out;
	}

	function addClasses($ca)
	{
		$out = NULL;
		$isFirst = TRUE;
		if(is_array($ca))
		{
			$out = ' class="';
			foreach ($ca as $class)
			{
				if($isFirst == TRUE)
				{
					$out .= ' '.$class;
					$isFirst == FALSE;
				}
				else
				{
					$out .= ' '.$class;
				}
			}
			$out .= '"';
		}
		else
		{
			if(!is_null($ca))
			{
				$out = ' class="'.$ca.'"';	
			}
		}
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

	function setAMP($sa)
	{
		
	}

	function setSchema($sa)
	{

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