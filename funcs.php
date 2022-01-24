<?php
//XSS対応（ echoする場所で使用！）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

//DB接続関数：

function db_conn()
{
//※関数を作成し、内容をreturnさせる。
//※ DBname等、今回の授業に合わせる。
try {
    $db_name = 'gs_db';    //データベース名
    $db_id   = 'root';      //アカウント名
    $db_pw   = 'root';      //パスワード：XAMPPはパスワード無しに修正してください。
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
    return $pdo;
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

}
//SQLエラー関数：sql_error($stmt)

function sql_error($stmt)
{
$error = $stmt->errorInfo();
exit('SQLError:' . print_r($error, true));
}
//リダイレクト関数: redirect($file_name)

function redirect($file_name)
{
header('Location:' . $file_name);
exit();

}
