<!--
	Potassium Framework
-->

<?php

	class kApp
	{
		// Initialised Status
		private static $init = false;
		
		// Defaults
		private static $defaultEvent = "main.index";
		private static $defaultLayout = "main";
		private static $defaultView = "main/index";
		
		public static function init()
		{
			// Check Initialised
			if(self::$init) {return;}
			
			// Initialise Properties
			self::$init = true;
			//
		}

		public static function getDefaultEvent()
		{
			return self::$defaultEvent;
		}

		public static function getDefaultLayout()
		{
			return self::$defaultLayout;
		}

		public static function getDefaultView()
		{
			return self::$defaultView;
		}
		
	}

?>