<?php
class fileupload
{
	public $upload_file_location = 'img/profile';
	public $files = NULL;
	function __construct($pl = NULL)
	{
		$this->upload_file_location = $pl;
	}

	function imageupload($subDir = NULL, $w = 200, $h = 300)
	{
		require_once 'imagemanipulator.class.php';
		$target = $this->appendSlash($this->upload_file_location).basename($this->files->name);
		
		if(!is_null($subDir))
		{
			if(!file_exists($this->appendSlash($this->upload_file_location).$subDir))
			{
				if(!mkdir($this->appendSlash($this->upload_file_location).$subDir, 0777))
				{
    				$message = 'Failed to create '.$this->appendSlash($this->upload_file_location).$subDir;
				}
				else
				{
					$message = $this->appendSlash($this->upload_file_location).$subDir.' created';	
				}
			}			
			$target = $this->appendSlash($this->upload_file_location).$this->appendSlash($subDir).basename($this->files->name);
		}

		if(file_exists($target))
		{
			chmod($target,0755);
			unlink($target);
		}

		$manipulator = new imagemanipulator($this->files->tmp_name);
		/* Original line */
		$newImage = $manipulator->resample($w, $h);

		/* Start of New */
		$width  = $manipulator->getWidth();
		$height = $manipulator->getHeight();
		$centreX = round($width / 2);
		$centreY = round($height / 2);
		// our dimensions will be 200x300
		$x1 = $centreX - 100; // 200 / 2
		$y1 = $centreY - 150; // 130 / 2 
		$x2 = $centreX + 100; // 200 / 2
		$y2 = $centreY + 150; // 130 / 2 		
		// center cropping to 200x130
		$newImage = $manipulator->crop($x1, $y1, $x2, $y2);
		/* End of new */

		$manipulator->save($this->appendSlash($this->upload_file_location).$this->appendSlash($subDir).basename($this->files->name));
		return $target;
	}

	function appendSlash($s)
	{
		if(substr($s, -1) != '/')
		{
			$s .= '/';
		}
		return $s;
	}

	function __destruct()
	{
	
	}
}
?>