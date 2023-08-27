<?php session_start(); ?>
<?php error_reporting(0); ?>
<?php 
$pdo = new PDO(
    'mysql:host=localhost;dbname=hakkason;charset=utf8',
    'staff',
    'password'
);
// ログイン、ログアウト、新規会員登録の遷移されてきたか
if (isset($_REQUEST['command'])) {
    switch ($_REQUEST['command']) {
        // ログイン
        case 'login':
            unset($_SESSION['customer']);
            $sql = $pdo->prepare('select * from customer where username=? and password=?');
            $sql->execute([$_REQUEST['username'], $_REQUEST['password']]);
            foreach($sql as $row){
                $_SESSION['customer'] = [
                    'id' => $row['id'],
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'address' => $row['address']
                ];
            }
            if (!isset($_SESSION['customer'])) {
                // ログイン失敗時の処理
                $alert = "<script type='text/javascript'>alert('ログイン名もしくはパスワードが間違っています');</script>";
                echo $alert;
            }
            break;

        // ログアウト
        case 'logout':
            unset($_SESSION['customer']);
            break;
        // 新規会員登録
        case 'regist':
            if ($_REQUEST['password'] != $_REQUEST['confirm_password']) {
                $alert = "<script type='text/javascript'>alert('入力されたパスワードが一致しません');</script>";
                echo $alert;
                break;
            }
            // ログイン名の重複確認
            $sql=$pdo->prepare('select * from customer where username=?');
            $sql->execute([htmlspecialchars($_REQUEST['username'])]);
            if (empty($sql->fetchAll())) {
                // 会員情報を新規登録する
                $sql=$pdo->prepare('insert into customer values(null,?,?,?)');
                $sql->execute([
                htmlspecialchars($_REQUEST['username']),
                htmlspecialchars($_REQUEST['address']),
                htmlspecialchars($_REQUEST['password'])
                ]);
                break;
            } else {
                $alert = "<script type='text/javascript'>alert('使用済みのログイン名です');</script>";
                echo $alert;
            }
            break;
        }}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ウォーキング</title>
</head>
<body>

    <?php
    // ログインしているか
    if (isset($_SESSION['customer'])) {
        echo '<a href="account.php">';
        echo 'ACCOUNT';
        echo '</a>';
    } else {
        echo '<a href="login.php">';
        echo 'LOGIN';
        echo '</a>';
        echo '<a href="new.php">';
        echo 'new';
        echo '</a>';
    }
    ?>

