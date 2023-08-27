<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php
// フォームが送信された場合の処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $address = $_POST["address"];
    $password = $_POST["password"]; // パスワードをハッシュ化予定

    $pdo = new PDO(
        'mysql:host=localhost;dbname=hakkason;charset=utf8',
        'staff',
        'password'
    );

    // データベースに新しい管理者を追加
    $stmt = $pdo->prepare("insert into admin (username, address, password) values (?, ?, ?)");
    if ($stmt->execute([$username, $address, $password])) {
        // 追加に成功したらログインページにリダイレクト
        header("Location: login.php");
        exit(); // リダイレクト後にスクリプトを終了する
    } else {
        $alert = "<script type='text/javascript'>alert('正しく追加出来ませんでした。');</script>";
        echo $alert;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>新しい管理者追加</title>
</head>
<body>
    <h1>新しい管理者追加</h1>

    <form method="POST" action="">
        <label>ユーザー名: <input type="text" name="username"></label><br>
        <label>住所: <input type="text" name="address"></label><br>
        <label>パスワード: <input type="password" name="password"></label><br>
        <input type="submit" value="追加">
    </form>
</body>
</html>
