<?php require 'server_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (isset($_SESSION['admin'])): ?>
        <p>ログイン中</p>
        <p><a href="logout.php">ログアウト</a></p>
        <p><a href="mypage.php">マイページ</a></p>
    <?php else: ?>
        <p><a href="login.php">ログイン</a></p>
    <?php endif; ?>
    <p><a href="new.php">新規会員登録</a></p>
</body>
</html>
