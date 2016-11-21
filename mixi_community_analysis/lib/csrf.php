<?php
require_once('simple_html_dom.php');

function getCSRF() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://mixi.jp" );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookie");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookie");
    $html = str_get_html(curl_exec($ch));
    curl_close($ch);

    // "name=post_key"の要素を抽出し、値を返却
    foreach ($html->find('input, name') as $element) {
      if (strpos($element,'post_key') !== false) {
          return $element->{'value'};
      }
    }
}