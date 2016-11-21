<?php
require_once('simple_html_dom.php');

function paramInit($community) {
    $post_data = array();

    return $post_data;
}

function requestCommunity($community) {
    $param = paramInit($community);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "" );
    curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookie");
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
    curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookie");
    $html = str_get_html(curl_exec($ch));
    curl_close($ch);    
}