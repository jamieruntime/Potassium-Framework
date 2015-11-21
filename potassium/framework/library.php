<!--
	Potassium Framework
-->

<?php

	function fileRead($argFile, $argArray)
	{
		$file = fopen($argFile, 'r');
		$data = fread($file, filesize($argFile));
		fclose($file);
		if($argArray) {$data = explode("\n", $data);}
		return $data;
	}

	function includeDirectory($argDirectory)
	{
		if($directory = opendir($argDirectory))
		{
			while(($file = readdir($directory)) !== false)
			{
				if($file !== "." && $file !== "..")
				{
					include $argDirectory.$file;
				}
			}
			closedir($directory);
		}
	}

?>