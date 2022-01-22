<?php
//フォームからの値をそれぞれ変数に代入
$name = $_POST['name'];
$mail = $_POST['mail'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

try {
    //ID:'root', Password: 'root'
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', 'root');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}

// try {
//     $dbh = new PDO($pdo, $username, $password);
// } catch (PDOException $e) {
//     $msg = $e->getMessage();
// }

// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO gs_an_table(name, mail, pass)
                        VALUES(NULL, :name, :mail, :pass, )");

//フォームに入力されたmailがすでに登録されていないかチェック
$sql = "SELECT * FROM gs_an_table WHERE mail = :mail";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':mail', $mail);
$stmt->execute();
$member = $stmt->fetch();
if ($member['mail'] === $mail) {
    $msg = '同じメールアドレスが存在します。';
    $link = '<a href="signup.php">戻る</a>';
} else {
    //登録されていなければinsert 
    $sql = "INSERT INTO gs_an_table(name, mail, pass) VALUES (:name, :mail, :pass)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':mail', $mail);
    $stmt->bindValue(':pass', $pass);
    $stmt->execute();
    $msg = '会員登録が完了しました';
    $link = '<a href="login.php">ログインページ</a>';
}
?>

<h1><?php echo $msg; ?></h1><!--メッセージの出力-->
<?php echo $link; ?>