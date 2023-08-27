
<?php require 'header.php'; ?>

    <h1>新しい会員追加</h1>

    <form method="POST" action="login.php">
        <label>ユーザー名: <input type="text" name="username"></label><br>
        <label>アドレス: <input type="text" name="address"></label><br>
        <label>パスワード: <input type="password" name="password"></label><br>
        <input type="submit" value="追加">
    </form>
    
<?php require 'footer.php'; ?>
