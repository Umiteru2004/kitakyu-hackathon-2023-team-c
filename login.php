<?php require 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>

    <form method="POST" action="menu.php">
        <label>ユーザー名: <input type="text" name="username"></label><br>
        <label>パスワード: <input type="password" name="password"></label><br>
        <input type="hidden" name="command" value="login">
        <input type="submit" value="ログイン">
    </form>

<?php require 'footer.php'; ?>