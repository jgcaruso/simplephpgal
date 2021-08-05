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
     * Simple Photo Gallery Config file (phpGalleryConfig.php)
     *
     * Use this file to set your preferences for the gallery that will
     * reside in the current folder.
     *
     */

    // folder names
    $imagesFolder = "phpGallery_images";
    $thumbsFolder = "phpGallery_thumbs"; // This folder needs to have WRITE permissions enabled

    // Gallery Title -- uncomment if you want to override using folder name as title
    //$galleryTitle = 'Title';

    // Thumbnail dimensions
    $width = 120;
    $height = 110;

    // Number of pictures in each row
    $num_in_each_row = 5;

    /* Gallery Sort Mode
     * 1 = Alphabetic (A to Z)
     * 2 = Alphabetic (Z to A)
     * 3 = Date (oldest to newest) (almost like creation date however it was not available. So inode metadata date is used)
     * 4 = Date (newest to oldest)
     *
     */
     $sortMode = 1;
?>