<?php


function head($title = false, $keywords = false, $description = false, $author = false) {
    $output = "";
    if ($title) {
        $output.="<title>{$title}</title>\n";
    } else {
        $output.="<title>Untitled Page</title>\n";
    }

    if ($keywords) {
        $output.="<meta name='keywords' content='" . $keywords . "'>\n";
    }

    if ($description) {
        $output.="<meta name='description' content='" . $description . "'>\n";
    }
    if ($author) {
        $output.="<meta name='author' content='" . $author . "'>\n";
    }
    return $output;
}

function FB($FBTitle = false, $FBURL = false, $FBDescription = false) {
    $output = "";
    if ($FBTitle) {
        $output.="<meta property='og:title' content='" . $FBTitle . "'>\n";
    }
    if ($FBURL) {
        $output.="<meta property='og:url' content='" . $FBURL . "'>\n";
    }
    if ($FBDescription) {
        $output.="<meta property='og:description' content='" . $FBDescription . "'>\n";
    }
    
    return $output;
}

function css($cssFiles = array(), $innerpath = true, $ext = true) {
    $output = "";
    $path = "";
    $extention = "";
    if ($ext) {
        $extention = ".css";
    }
    if ($innerpath) {
        $path = CSS . '/';
    }
    if (count($cssFiles) > 0) {
        foreach ($cssFiles as $cssFiles) {
            $output.="<link rel='stylesheet' href='" . $path . $cssFiles . $extention . "' />\n";
        }
        return $output;
    }
}

function js($jsFiles = array()) {
    $output = "";
    if (count($jsFiles) > 0) {
        foreach ($jsFiles as $jsFiles) {
            $output.="<script language='javascript' src='" . JS . '/' . $jsFiles . ".js'></script>\n";
        }
        return $output;
    }
}



?>
