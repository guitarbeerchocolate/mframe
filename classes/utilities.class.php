<?php
class utilities
{
	function __construct()
	{

	}

	function get_mime_type($filename = NULL)
 	{
		$mime_types = array(
		'txt' => 'text/plain',
		'htm' => 'text/html',
		'html' => 'text/html',
		'php' => 'text/html',
		'css' => 'text/css',
		'js' => 'application/javascript',
		'json' => 'application/json',
		'xml' => 'application/xml',
		'swf' => 'application/x-shockwave-flash',
		'flv' => 'video/x-flv',

		// images
		'png' => 'image/png',
		'jpe' => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'jpg' => 'image/jpeg',
		'gif' => 'image/gif',
		'bmp' => 'image/bmp',
		'ico' => 'image/vnd.microsoft.icon',
		'tiff' => 'image/tiff',
		'tif' => 'image/tiff',
		'svg' => 'image/svg+xml',
		'svgz' => 'image/svg+xml',

		// archives
		'zip' => 'application/zip',
		'rar' => 'application/x-rar-compressed',
		'exe' => 'application/x-msdownload',
		'msi' => 'application/x-msdownload',
		'cab' => 'application/vnd.ms-cab-compressed',

		// audio/video
		'mp3' => 'audio/mpeg',
		'qt' => 'video/quicktime',
		'mov' => 'video/quicktime',

		// adobe
		'pdf' => 'application/pdf',
		'psd' => 'image/vnd.adobe.photoshop',
		'ai' => 'application/postscript',
		'eps' => 'application/postscript',
		'ps' => 'application/postscript',

		// ms office
		'doc' => 'application/msword',
		'rtf' => 'application/rtf',
		'xls' => 'application/vnd.ms-excel',
		'ppt' => 'application/vnd.ms-powerpoint',

		// open office
		'odt' => 'application/vnd.oasis.opendocument.text',
		'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
		);
		$fnameArr = array();
		$fnameArr = explode('.',$filename);
		$lastItem = array_pop($fnameArr);
		$ext = strtolower($lastItem);

		if(array_key_exists($ext, $mime_types))
		{
			return $mime_types[$ext];
		}
		else
		{
			return 'application/octet-stream';
		}
	}

	function data_uri($file = NULL)
	{
		$mime = $this->get_mime_type($file);
		$contents = file_get_contents($file);
		$base64 = base64_encode($contents);
		echo "data:$mime;base64,$base64";
	}

	function data_uri_string($file = NULL, $mime = NULL)
	{
		switch ($mime)
		{
			case 'image/png':
				$image = imagecreatefrompng($file);
				break;
			case 'image/jpeg':
				$image = imagecreatefromjpeg($file);
				break;
			case 'image/gif':
				$image = imagecreatefromgif($file);
				break;
			case 'image/bmp':
				$image = imagecreatefromwbmp($file);
				break;
			default:
				break;
		}
		$image = imagescale($image , 500);
		ob_start();
		imagejpeg($image);
		$contents = ob_get_contents();
		ob_end_clean();
		return "data:image/jpeg;base64,".base64_encode($contents);
	}

	function data_uri_image($file = NULL, $mime = NULL, $alt = NULL)
	{
		$contents = file_get_contents($file);
		$base64 = base64_encode($contents);
		echo '<img src="data:'.$mime.';base64,'.$base64.'" alt="'.$alt.'" class="img-responsive" />';
	}

	function base64_image($file = NULL, $alt = NULL)
	{
		echo '<img src="'.$file.'" alt="'.$alt.'" class="img-responsive" />';
	}

	function image_db_string($file = NULL, $mime, $size = 400)
	{
		switch ($mime)
		{
			case 'image/png':
				$image = imagecreatefrompng($file);
				break;
			case 'image/jpeg':
				$image = imagecreatefromjpeg($file);
				break;
			case 'image/gif':
				$image = imagecreatefromgif($file);
				break;
			case 'image/bmp':
				$image = imagecreatefromwbmp($file);
				break;
			default:
				break;
		}
		$image = imagescale($image, $size);
		ob_start();
		switch ($mime)
		{
			case 'image/png':
				imagepng($image,$tempimage,95);
				break;
			case 'image/jpeg':
				imagejpeg($image,$tempimage,95);
				break;
			case 'image/gif':
				imagegif($image,$tempimage,95);
				break;
			case 'image/bmp':
				imagewbmp($image,$tempimage,95);
				break;
			default:
				break;
		}
		$contents = ob_get_contents();
		ob_end_clean();
		return "data:".$mime.";base64,".base64_encode($contents);
	}

	function rootPath()
    {
    	return $this->addTrailingSlash($this->getServer().$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']));
    }

	function getServer()
	{
		if(isset($_SERVER['HTTPS']))
		{
			return 'https://';
		}
		else
		{
			return 'http://';
		}
	}

	function addTrailingSlash($s)
	{
		if(substr($s, -1) !== '/')
		{
			return $s.'/';
		}
		else
		{
			return $s;
		}
	}

	function getModuleFiles($moduleDir = 'modules', $ext = 'css')
	{
		$fileArr = array();
		$moduleDirArr = $this->getModuleDirs($moduleDir);
		foreach($moduleDirArr as $module)
		{
			if($handle = opendir($module))
			{
		    	while(false !== ($entry = readdir($handle)))
		    	{
		        	if(($entry != ".") && ($entry != "..") && (pathinfo($entry, PATHINFO_EXTENSION) == $ext))
		        	{
		        		array_push($fileArr, $module.'/'.$entry);
		        	}
		    	}
		    	closedir($handle);
			}
		}
		if($ext == 'css')
		{
			array_push($fileArr, 'custom.css');
		}
		else
		{
			array_push($fileArr, 'custom.js');
		}
		return $fileArr;
	}

	function getModuleDirs($moduleDir)
	{
		$moduleDirArr = array();
		$avoidDirrArr = array('.','..','tinymce','datepicker','taghandler');
		if($handle = opendir($moduleDir))
		{
	    	while(false !== ($entry = readdir($handle)))
	    	{
	        	if(!in_array($entry, $avoidDirrArr))
	        	{
	        		array_push($moduleDirArr, $moduleDir.'/'.$entry);
	        	}
	    	}
	    	closedir($handle);
		}
		return $moduleDirArr;
	}

	function include_to_string($inc)
	{
		ob_start();
		include_once $inc;
		$html = ob_get_contents();
		ob_get_clean();
		return $html;
	}

	function var_dump_to_string($s)
	{
		ob_start();
		var_dump($s);
		return ob_get_clean();
	}

	function var_dump_structure($s)
	{
		echo "<pre>";
		var_dump($s);
		echo "</pre>";
	}

	function print_array_structure($a)
	{
		echo "<pre>";
		print_r($a);
		echo "</pre>";
	}

	function array_to_string($a)
	{
		ob_start();
		echo "<pre>";
		print_r($a);
		echo "</pre>";
		return ob_get_clean();
	}

	function move_on($loc = NULL, $message = NULL)
	{
		$locStr = 'location:'.$loc;
		if(!is_null($message))
		{
			$locStr .= '&message='.urlencode($message);
		}
		header($locStr);
		exit;
	}

	function __destruct()
	{

	}
}