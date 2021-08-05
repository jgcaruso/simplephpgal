<?php

	/* The contents of this file are subject to the Mozilla Public License Version 1.0 (the "License");
	 * you may not use this file except in compliance with the License. You may obtain a copy of the
	 * License at http://www.mozilla.org/MPL/
	 * 
	 * Software distributed under the License is distributed on an "AS IS" basis, WITHOUT WARRANTY OF ANY KIND,
	 * either express or implied. See the License for the specific language governing rights and limitations under the License.
	 * 
	 * The Original Code is Simple PHP Photo Gallery.
	 * 
	 * The Initial Developer of the Original Code is John Caruso.
	 * Portions created by John Caruso are Copyright (C) 2005 John Caruso. All Rights Reserved.
	 * 
	 * Contributor(s): .
	 *
	 */


	/*
	 * Simple Photo Gallery (index.php)
	 * ================================
	 * 
	 * Place all your photos (must end in .JPG -- uppercase) into a folder called 'images'.
	 * 
	 * 
	 * Edit the CONFIG.PHP file to set preferences.
	 *
	 *
	 * For Multiple galleries, place a copy of each file in its own directory,
	 * along with the images you would like in that gallery. Then place the index.php
	 * in the folder that holds all the other galleries - It will create a directory listing
	 * that contains links to each gallery. 
	 *
	 * thumbnail_generator.php © Christian Heilmann http://icant.co.uk/articles/phpthumbnails/
	 *
	 */


	// include helper files and generate gallery page


	// Generate the page
	echo "<?xml version='1.0' encoding='UTF-8'?>";
	echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>\n<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>\n";
	echo "<head>\n<title>Gallery</title>\n<style type='text/css' media='all'>@import 'phpGalleryStyle.css';</style>\n</head>\n<body>\n";

	include("embeddedGallery.php");
	
	// copyright info
	echo "<br /><br />\n<center>\n<div class='phpGallery_footer'>\n\tCreated with <a href='http://www.johncaruso.ca/phpGallery'>Simple PHP Photo Gallery</a> Created by <a href='http://www.johncaruso.ca/'>John Caruso</a> 2005.\n</div>\n</center>";
	echo "</body>\n</html>";
?>