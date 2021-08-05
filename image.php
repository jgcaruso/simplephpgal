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
     * Simple Photo Gallery (image.php)
     * ================================
     *
     * Interface for viewing larger images. Image size is based on window size.
     *
     * Creates 'Previous' and 'Next' image links
     *
     *
     */
?>

<!-- Some needed javascript -- Borrowed from imageshack.com -->
<script type="text/javascript">
    var actualWidth = 1280;
    var originalWidth;

    function scaleImg() {
        var what;
        if (actualWidth<tableWidth())
            return;

        what = document.getElementById('thepic');

        if (what.width==tableWidth())
            what.width=originalWidth;
        else {
            what.style.cursor = "pointer";
            what.width=tableWidth();
        }
    }

    function liveResize() {
        if (actualWidth<tableWidth())
            return;

        what = document.getElementById('thepic');

        if (what.width>actualWidth)
            what.width=tableWidth();
    }

    function setImgWidth_handler() {
        setTimeout('setImgWidth()', 1000);
    }
    function setImgWidth() {
        var what;

        what = document.getElementById('thepic');

        originalWidth = what.width;

        if (actualWidth<tableWidth() || what.width < actualWidth)
            return;

        what.width=tableWidth();
    }

    function tableWidth() {
        return windowWidth()-300;
    }

    function windowWidth() {
        if (navigator.appName=="Netscape")
            return window.innerWidth;
            return document.body.offsetWidth;

    }

    onresize=liveResize;


function highlight(field) {
        field.focus();
        field.select();
}

</script>
<!-- end javascript -->


<?php
    ini_set(max_execution_time, 320);
    include ("phpGalleryConfig.php");
    include ('functions.php');

    // SCRIPT
    $path = getcwd()."/".$imagesFolder; // define entire path to images directory
    $image = $_GET['i'];


    // Generate NEXT and LAST links

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
        }
    }

    closedir($dir_handle);

    // get current filename
    $something = explode("/", $_SERVER['PHP_SELF']);
    $filename = $something[count($something) - 1];

    // sort the array
    $fileArray = imageSort($fileArray, $sortMode,$path."/");

    // search array for current image, then take previous and next links

    $previous = "";
    $next = "";

    for ($i = 0; $i < count($fileArray) ; $i++)
    {
        if (!strcmp($imagesFolder."/".$fileArray[$i], $image))
        {
            if ($i == 0) // if looking at first image
            {
                $previous = "";
                $next = $filename."?i=".$imagesFolder."/".$fileArray[($i + 1)];
            }
            else if ($i == (count($fileArray) -1)) // if looking at last
            {
                $previous = $filename."?i=".$imagesFolder."/".$fileArray[($i - 1)];
                $next = "";
            }
            else
            {
                $previous = $filename."?i=".$imagesFolder."/".$fileArray[($i - 1)];
                $next = $filename."?i=".$imagesFolder."/".$fileArray[($i + 1)];
            }
        }

    }

    // create Back to Gallery link
    $gallery = substr($_SERVER['PHP_SELF'], 0,
        strlen($_SERVER['PHP_SELF']) - (strlen($_SERVER['PHP_SELF']) -
        strpos ($_SERVER['PHP_SELF'], '/'.$filename))); // html path to the current folder

    echo "<center>";
    if (!empty($previous)) { echo "<a href='$previous'>Previous</a> | "; }
    echo "<a href='$gallery'>Back to Gallery</a>";
    if (!empty($next)) { echo " | <a href='$next'>Next</a></center>"; }

    echo "<center><img id='thepic' onClick='scaleImg()' src='".$image."' /><script language='javascript'>setImgWidth_handler();</script></center>";



    // copyright info
    echo "<br /><center>Created with <a href='http://www.johncaruso.ca/phpGallery'>Simple PHP Photo Gallery</a> Created by <a href='http://www.johncaruso.ca/'>John Caruso</a> 2005.</center>";
?>