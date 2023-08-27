
<?php require 'header.php'; ?>

    <h1>新しい会員追加</h1>

    <form method="POST" action="login.php">
    <input type="hidden" name="command" value="regist">  
        <label>ユーザー名: <input type="text" name="username"></label><br>
        <label>アドレス: <input type="text" name="address"></label><br>
        <label>パスワード: <input type="password" name="password"></label><br>
        <label>パスワード(確認): <input type="password" name="confirm_password"></label><br>
        <input type="submit" value="会員追加">
    </form>

<?php require 'footer.php'; ?>
