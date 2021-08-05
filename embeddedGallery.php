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
     * Simple Photo Gallery (embeddedGallery.php)
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
     * thumbnail_generator.php � Christian Heilmann http://icant.co.uk/articles/phpthumbnails/
     *
     */


// FUNCTIONS

    function getTitle()
    {
        $title = "";

        // find the name of the current folder
        $path = $_SERVER['PHP_SELF'];
        $pstats = pathinfo($path);
        $title = $pstats['dirname'];

        // get rid of previous directory names
        $continue = true;

        while ($continue)
        {
            $index = strpos($title, "/");

            if ($index === false)
            {
                $continue = false;
            }
            else
            {
                $title = substr ($title, $index + 1);
            }
        }

        // replace _ with space
        $title = strtr ($title, "_", " ");

        return $title;
    }

    function thumbExists($findfilename)
    {
        include ('phpGalleryConfig.php');
        $path = getcwd()."/".$thumbsFolder;

        // Open the folder
        $dir_handle = @opendir($path) or die("Unable to open $path");

        $found = false;

        for ($i = 0; $file = readdir($dir_handle); $i++)
        {
            if ($file == "tn_".$findfilename)
            {
                $found = $found || true;
            }
        }

        return $found;
    }


    function generateDirListing()
    {
        include ('phpGalleryConfig.php');
        $path = getcwd()."/".$imagesFolder;


        // Open the folder
        $dir_handle = @opendir($path);

        if ($dir_handle == false)
        {
            // get current filename
            $something = explode("/", $_SERVER['PHP_SELF']);
            $filename = $something[count($something) - 1];

            // create path to current folder for linking
            $htmlpath = substr($_SERVER['PHP_SELF'], 0, strlen($_SERVER['PHP_SELF']) - (strlen($_SERVER['PHP_SELF']) - strpos ($_SERVER['PHP_SELF'], '/'.$filename)));

            // create directory listing and exit
            $path = getcwd();

            $dir_handle = opendir($path);

            // create an array of files

            $fileArray = Array();

            for ($i = 0; $file = readdir($dir_handle); $i++)
            {
                if ($file == "." || $file == ".." || $file == $filename || $file == "phpGalleryConfig.php" || $file == "embeddedGallery.php")
                {
                    $i--;
                    continue;
                }
                else
                {
                    $fileArray[$i] = $file;
                }
            }

            // sort the array

            sort($fileArray);

            // Determine the title
            if (! isset($galleryTitle))
            {
                $galleryTitle = getTitle();
            }

            // print the listing
            echo "<center><h1>".$galleryTitle."</h1>\n\n<table><tr><td><ul>";

            for ($i = 0; $i < count($fileArray); $i++)
            {
                echo "<li><a href='".$htmlpath."/".$fileArray[$i]."'><font size='6'>".strtr ($fileArray[$i], "_", " ")."</font></a><br />";
            }

            echo "</ul></td></tr></table></center>";

            exit();
        }
    }


    // SCRIPT

    generateDirListing(); // generates directory listing if image folder doesn't exist

    // include helper files and generate gallery page
    include ('functions.php');
    include ('thumbnail_generator.php');
    include ('phpGalleryConfig.php');

    ini_set(max_execution_time, 320); // increase execution time to allow GD to mess around with the images


    $path = getcwd()."/".$imagesFolder; // define entire path to images directory

    // get current filename
    $something = explode("/", $_SERVER['PHP_SELF']);
    $filename = $something[count($something) - 1];

    $htmlpath = substr($_SERVER['PHP_SELF'], 0,
        strlen($_SERVER['PHP_SELF']) - (strlen($_SERVER['PHP_SELF']) -
        strpos ($_SERVER['PHP_SELF'], '/'.$filename))); // html path to the current folder

    $num_pix = count(glob($path."/*")); // number of files in images folder minus 2 for '.' and '..'

    // Open the folder
    $dir_handle = @opendir($path) or die("Unable to open $path");


    // create an array of files

    $fileArray = Array();

    for ($i = 0; $file = readdir($dir_handle); $i++)
    {
        if ($file == "." || $file == "..")
        {
            $i--;
            continue;
        }
        else
        {
            $fileArray[$i] = $file;

            if (!thumbExists($file))
            {
                createthumb($imagesFolder."/".$file,$thumbsFolder.'/tn_'.$file,$width,$height);
            }
        }
    }

    // sort the array

    $fileArray = imageSort($fileArray, $sortMode, $path."/");

    // Determine the title
    if (! isset($galleryTitle))
    {
        $galleryTitle = getTitle();
    }

    // Generate the page
    echo "<center>\n";
    echo "<div class='phpGallery_title'>".$galleryTitle."<br />\n";
    echo "<a href='".$htmlpath."/../'>Back to Listing</a></div>\n";

    // print the table
    echo "<table class='phpGallery_table'>\n";
    for ($i = 0; $i < count($fileArray); $i++)
    {
        if ($i % $num_in_each_row == 0) { echo "\t<tr class='phpGallery_tr'>\n"; }

        echo "\t\t<td class='phpGallery_td'>\n\t\t\t<a href='image.php?i=".$imagesFolder."/".$fileArray[$i]."'><img src='".$htmlpath."/".$thumbsFolder."/"."tn_".$fileArray[$i]."' alt='img' /></a>\n\t\t</td>\n";

        if ($i % $num_in_each_row == ($num_in_each_row - 1) || $i == $num_pix - 1) { echo "\t</tr>\n"; }

    }
    echo "</table>\n</center>\n";

    // Close
    closedir($dir_handle);

// For Folder Path debugging
/*	echo "path = ".$path."<br />";
    echo "htmlpath = ".$htmlpath."<br />";
    echo "position of $filename=".strpos ($_SERVER['PHP_SELF'], '/'.$filename)."<br />";
    echo "server=".$_SERVER['PHP_SELF']."<br />";
*/
?>