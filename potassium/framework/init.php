<!--
	Potassium Framework
-->

<?php

	// Enable Session
	//session_start();

	// Include Library
	include "potassium/framework/library.php";

	// Load Components
	includeDirectory("potassium/components/");

	// Create Application
	kApp::init();

	// Create Event
	kEvent::init();
	if(isset($_GET['event'])) {kEvent::setRoute($_GET['event']);}

	// Load Controller
	kEvent::execute();
	
	// Render Event
	kEvent::render();

?>