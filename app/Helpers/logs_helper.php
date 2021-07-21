<?php

function parseDate($log){
    $str = [];

    $date = preg_match_all('/\d{1,2}\/\D{3}\/\d{4}/', $log["date_of_request"], $str);
    return date("d/m/y", strtotime(str_replace("/","-",$str[0])[0]));
}
