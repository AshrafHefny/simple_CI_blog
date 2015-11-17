<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Image {

    /**
     * @author Ashraf Hefny
     * @copyright 2015 Ashraf Hefny
     */
    function resize($obj, $w, $h) {
        $thumbnailwidth = $w;
        $thumbnailheight = $h;
        list($width, $height) = getimagesize($obj);
        if ($width > $thumbnailwidth || $height > $thumbnailheight) {
            if ($width > $height) {
                $wscall = $width / $thumbnailwidth;
                $hscall = $height / $wscall;
                $imagewidth = $w;
                $imageheight = $hscall;
            } else {
                $hscall = $height / $thumbnailheight;
                $wscall = $width / $hscall;
                $imageheight = $h;
                $imagewidth = $wscall;
            }
        } else {
            $imagewidth = $width;
            $imageheight = $height;
        }

        return "width='" . (int) $imagewidth . "' height='" . (int) $imageheight . "'";
    }

}
?>