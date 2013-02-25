<?php
/*
 * $Id$
 */
	$partViewer->
		view('_parts/header')->
		view('_parts/menu');

	$partViewer->view("$area/layout");
	
	$partViewer->view('_parts/footer');
