<?php
class utilities
{
	function __construct()
	{

	}

	function echobr($s = NULL)
	{
		echo $s.'<br />';
	}

	function echohr($s = NULL)
	{
		echo $s.'<hr />';
	}

	function brecho($s = NULL)
	{
		echo '<br />'.$s;
	}

	function echon($s = NULL)
	{
		echo $s."\n";
	}

	function necho($s = NULL)
	{
		echo "\n".$s;
	}

	function echoeol($s = NULL)
	{
		echo $s.PHP_EOL;
	}

	function eolecho($s = NULL)
	{
		echo PHP_EOL.$s;
	}

	function testbr($s = NULL)
	{
		try
		{
			eval($s);
		}
		catch(Exception $e)
		{
    		echo 'Caught exception: '.$e->getMessage().'<br />';
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
    		echo '<br />Caught exception: '.$e->getMessage();
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
    		echo 'Caught exception: '.$e->getMessage()."\n";
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
    		echo "\n".'Caught exception: '.$e->getMessage();
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
    		echo 'Caught exception: '.$e->getMessage().PHP_EOL;
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
    		echo PHP_EOL.'Caught exception: '.$e->getMessage();
		}
	}

	function anchorblank($url = NULL, $label = NULL)
	{
		$outStr = '<a href="'.$url.'" target="_blank">';
		if(!is_null($label))
		{
			$outStr .= $label;
		}
		else
		{
			$outStr .= $url;
		}
		$outStr .= '</a>';
		return $outStr;
	}

	function title($s = NULL, $sitename = NULL)
	{
		$output = '<title>';
		if((strtolower($s) == 'index.php') || (strtolower($s) == ''))
		{
			$output .= 'Home';
		}
		else
		{
			$output .= ucwords($s);
		}
		$output .= ' : ';
		$output .= $sitename;
		$output .= '</title>';
		echo $output;
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
		if($handle = opendir($moduleDir))
		{
	    	while(false !== ($entry = readdir($handle)))
	    	{
	        	if($entry != "." && $entry != "..")
	        	{
	        		array_push($moduleDirArr, $moduleDir.'/'.$entry);
	        	}
	    	}
	    	closedir($handle);
		}
		return $moduleDirArr;
	}

	function var_dump_to_string($s)
	{
		ob_start();
		var_dump($s);
		return ob_get_clean();
	}

	function __destruct()
	{
		
	}
}