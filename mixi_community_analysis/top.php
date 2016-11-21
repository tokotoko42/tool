<?php
require_once('lib/csrf.php');
require_once('lib/login.php');

// Cookie初期か
unlink("/tmp/cookie");

$login_result = false;

if ($_POST["mail"]) {
    // POSTデータを取得
    $mail = $_POST["mail"];
    $password = $_POST["password"];

    // ログイントークンを取得
    $csrf = getCSRF();

    // Mixiへログイン
    $login_result = mixiLogin($csrf, $mail, $password);
}

/****************************************   HTML   ****************************************/
if ($login_result) {
    echo "<html>";
    echo "<head>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
    echo "<title>Mixi Top form</title>";
    echo "</head>";
    echo "<body>";
    echo "<form action='community_search.php' method='post'>";
    echo "  ログインに成功しました。<br>";
    echo "  コミュニティ検索<br />";
    echo "  <input type='text' name='community' size='40' value='' /><br />";
    echo "  <br>";
    echo "  <input type='submit' value='Submit' />";
    echo "</form>";
    echo "</body>";
    echo "</html>";
} else {
    echo "<html>";
    echo "<head>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
    echo "<title>Mixi Login form</title>";
    echo "</head>";
    echo "<body>";
    echo "ログインに失敗しました。もう一度お試しください";
    echo "<form action='top.php' method='post'>";
    echo "  Mail Address<br />";
    echo "  <input type='text' name='mail' size='40' value='' /><br />";
    echo "  Password<br />";
    echo "  <input type='text' name='password' size='40' value='' /><br />";
    echo "  <br>";
    echo "  <input type='submit' value='Submit' />";
    echo "</form>";
    echo "</body>";
    echo "</html>";
}

