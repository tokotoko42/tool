<?php
require_once('lib/community.php');

$result = false;

if ($_POST["community"]) {
    // POSTデータを取得
    $community = $_POST["community"];
    
    // Request送信
    requestCommunity($community);
    
}

/****************************************   HTML   ****************************************/

if ($result) {
    echo "<html>";
    echo "<head>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
    echo "<title>Mixi Community form</title>";
    echo "</head>";
    echo "<body>";
    echo "コミュニティ：　　　　検索結果<br><br>";
    echo "<table border='1'>";
    echo "<tr>";
    echo "<td>ホームズの思い出</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>ホームズの事件簿</td>";
    echo "</tr>";
    echo "</body>";
    echo "</html>";

} else {
    echo "<html>";
    echo "<head>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
    echo "<title>Mixi Login form</title>";
    echo "</head>";
    echo "<body>";
    echo "予期せぬエラーが発生しました。もう一度ログインしてください";
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
