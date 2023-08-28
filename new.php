
<?php require 'header.php'; ?>

<div class="bbb">
    <h1>新しい会員追加</h1>
        <form method="POST" action="login.php">
        <input type="hidden" name="command" value="regist">  
            <label>ユーザー名: <input type="text" name="username" required></label><br>
            <label>アドレス: <input type="text" name="address" required></label><br>
            <label>パスワード: <input type="password" name="password" required></label><br>
            <label>パスワード(確認): <input type="password" name="confirm_password" required></label><br>
            <input type="submit" value="会員追加">
        </form>
</div>

<?php require 'footer.php'; ?>
