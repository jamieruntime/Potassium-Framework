<!--
	Potassium Framework
-->

<?php

	class kEvent
	{
		// Initialised Status
		private static $init = false;
		
		// Controller for this event
		private static $controller;
		
		// Action for this event
		private static $action;
		
		// Layout file to render
		private static $layout;
		
		// View file to render
		private static $view;
		
		// Level of restriction for client
		private static $restrict;
		
		// Render view or not
		private static $render;
		
		public static function init()
		{
			// Check Initialised
			if(self::$init) {return;}
			
			// Initialise Properties
			self::$init = true;
			//
			self::setRoute(kApp::getDefaultEvent());
			self::$layout = kApp::getDefaultLayout();
			self::$view = kApp::getDefaultView();
			self::$restrict = 0;
			self::$render = true;
		}
		
		public static function execute()
		{
			include self::getController();
			call_user_func(self::$action);
		}
		
		private static function getController()
		{
			return "controllers/".self::$controller.".php";
		}
		
		private static function getLayout()
		{
			return "layouts/".self::$layout.".php";
		}
		
		private static function getLayoutHtml()
		{
			if(!file_exists(self::getLayout())) {throw new Exception("Could not find the layout ".self::$layout);}
			$html = "";
			$layout = fileRead(kEvent::getLayout(), true);
			for($x = 0; $x < count($layout); $x++)
			{
				$html .= str_replace("[[render]]", self::getViewHtml(), $layout[$x]);
			}
			return $html;
		}
		
		private static function getView()
		{
			return "views/".self::$view.".php";
		}
		
		private static function getViewHtml()
		{
			if(!file_exists(self::getView()))
			{
				throw new Exception("Could not find the view ".self::$view);
				//return;
			}
			return fileRead(kEvent::getView(), false);
		}
		
		public static function nextEvent($argEvent)
		{
			echo "<script>location.assign('index.php?event=".$argEvent."')</script>";
			exit();
		}
		
		public static function nextEventAction($argEvent, $argAction)
		{
			echo "<script>location.assign('index.php?event=".$argEvent."&action=".$argAction."')</script>";
			exit();
		}
		
		public static function noRender()
		{
			self::$render = false;
		}
		
		public static function render()
		{
			if(self::$render)
			{
				echo self::getLayoutHtml();
			}
		}
		
		public static function setLayout($argLayout)
		{
			if(file_exists("layouts/".$argLayout.".php"))
			{
				self::$layout = $argLayout;
			}
			else
			{
				//$GLOBALS['kError']
			}
		}
		
		public static function setRestrict($argRestrict)
		{
			if(is_int($argRestrict))
			{
				self::$restrict = $argRestrict;
			}
		}
		
		public static function setRoute($argRoute)
		{
			$pos = strpos($argRoute, ".");
			if($pos == false)
			{
				self::$controller = $argRoute;
				self::$action = "index";
			}
			else
			{
				self::$controller = subStr($argRoute, 0, strPos($argRoute, "."));
				self::$action = subStr($argRoute, strPos($argRoute, ".") + 1);
			}
			self::$view = self::$controller."/".self::$action;
		}
		
		public static function setView($argView)
		{
			// note: need to check that this view exists
			self::$view = $argView;
		}
	}

?>