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
     * Simple Photo Gallery (functions.php)
     * ================================
     *
     * Functions that are used in multiple files
     *
     *
     */


    // Ascending date sort
    function ascDate($a, $b)
    {
        $filePath = $GLOBALS['__SimplephpGallery_Path__'];
        $aCDate = filectime($filePath.$a);
        $bCDate = filectime($filePath.$b);

        if ($aCDate == $bCDate)
        {
            return 0;
        }
        return ($aCDate < $bCDate) ? -1 : 1;
    }

    // descending date sort
    function descDate($a, $b)
    {
        $filePath = $GLOBALS['__SimplephpGallery_Path__'];
        $aCDate = filectime($filePath.$a);
        $bCDate = filectime($filePath.$b);

        if ($aCDate == $bCDate)
        {
            return 0;
        }
        return ($aCDate > $bCDate) ? -1 : 1;
    }

    function imageSort($fileArray, $sortMode, $filePath)
    {
        $GLOBALS['__SimplephpGallery_Path__'] = $filePath;

        if ($sortMode == 1)
        {
            // ascending alphabetic
            sort($fileArray);
        }
        else if ($sortMode == 2)
        {
            // descending alphabetic
            rsort($fileArray);
        }
        else if ($sortMode == 3)
        {
            // ascending cdate
            usort($fileArray, "ascDate");

        }
        else if ($sortMode == 4)
        {
            // descending cdate
            usort($fileArray, "descDate");
        }
        else
        {
            sort($fileArray);
        }


        return $fileArray;
    }

?>