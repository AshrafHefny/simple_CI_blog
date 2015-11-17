<?php

function getName($id, $table, $display = false, $lang = false) {
    $CI = &get_instance();
    $CI->load->model('options_model');
    return $CI->options_model->getName($id, $table, $display, $lang);
}

function isThisAdmin($userId) {
    $CI = &get_instance();
    $CI->load->model('check_model');
    return $CI->check_model->isThisAdmin($userId);
}

function resize($obj, $w, $h) {
    $CI = &get_instance();
    $CI->load->library('image');
    return $CI->image->resize($obj, $w, $h);
}

function shortText($str, $maxchar) {
    if (strlen($str) > $maxchar) {
        $short = substr($str, 0, $maxchar) . "..";
    } else {
        $short = $str;
    }
    return $short;
}

?>
