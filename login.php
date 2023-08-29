<?php require 'header.php'; ?>


<div class="bbb">
    <h1>ログイン</h1>
        <form method="POST" action="menu.php">
            <label>ユーザー名: <input type="text" name="name" required></label><br>
            <label>パスワード: <input type="password" name="password" required></label><br>
            <input type="hidden" name="command" value="login">
            <input type="submit" value="ログイン">
        </form>
</div>

<?php require 'footer.php'; ?>