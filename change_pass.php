<?php require 'header.php'; ?>

<div class="bbb">
    <h2>
        Change password
    </h2>
    <h6>
        パスワード変更
    </h6>
        <form action="account.php" method="post">
        <input type="hidden" name="command" value="password">
            <input type="password" class="form-control" placeholder="Password" name="password" required/>
            <input type="password" class="form-control" placeholder="New password" name="new_password" required/>
            <input type="password" class="form-control" placeholder="Confirm new password" name="confirm_new_password" required/>
            <input type="submit" value="変更">
        </form>
</div>
<?php require 'footer.php'; ?>