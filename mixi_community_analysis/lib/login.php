<?php
require_once('simple_html_dom.php');

function paramInit($csrf, $mail, $password) {
    $post_data = array();
    $post_data["next_url"] = "/home.pl";
    $post_data["post_key"] = $csrf;
    $post_data["email"] = $mail;
    $post_data["password"] = $password;
    return $post_data;
}

function mixiLogin($csrf, $mail, $password) {
    $param = paramInit($csrf, $mail, $password);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://mixi.jp/login.pl" );
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
    curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookie");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookie");
    $result = curl_exec($ch);
    
    curl_setopt($ch, CURLOPT_URL, "http://mixi.jp/check.pl?n=%2Fhome.pl" );
    curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookie");
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
    curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookie");
    $html = str_get_html(curl_exec($ch));
    curl_close($ch);

    // "name=post_key"の要素を抽出し、値を返却
    foreach ($html->find('input, name') as $element) {
        if (strpos($element,'redirect') !== false) {
            // 今なにしてる？　のフィールドが現れた場合、ログイン成功
            if ($element->{'value'} === 'recent_voice') {
                return true;
            }
        }
    }
    
    // ログインに失敗した場合、クッキーファイルを削除
    unlink("/tmp/cookie");
    return false;
}