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
            $sql = $pdo->prepare('select * from customer where name=? and password=?');
            $sql->execute([$_REQUEST['name'], $_REQUEST['password']]);
            foreach($sql as $row){
                $_SESSION['customer'] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
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
            $sql=$pdo->prepare('select * from customer where name=?');
            $sql->execute([htmlspecialchars($_REQUEST['name'])]);
            if (empty($sql->fetchAll())) {
                // 会員情報を新規登録する
                $sql=$pdo->prepare('insert into customer values(null,?,?,?)');
                $sql->execute([
                htmlspecialchars($_REQUEST['name']),
                htmlspecialchars($_REQUEST['address']),
                htmlspecialchars($_REQUEST['password'])
                ]);
                break;
            } else {
                $alert = "<script type='text/javascript'>alert('使用済みのログイン名です');</script>";
                echo $alert;
            }
            break;
                // アドレス変更
        case 'address':
            $id = $_SESSION['customer']['id'];
            $sql=$pdo->prepare('update customer set address=? where id=?');
            $sql->execute([$_REQUEST['address'], $id]);
            $_SESSION['customer']=[
            'id'      =>$id,
            'name'    =>htmlspecialchars($_REQUEST['name']),
            'password'=>htmlspecialchars($_REQUEST['password']),
            'address' =>htmlspecialchars($_REQUEST['address']),
            ];
            break;
        // パスワード変更
        case 'password':
            $flag = 1;
            $id = $_SESSION['customer']['id'];
            $sql=$pdo->prepare('select * from customer where id=?');
            $sql->execute([$id]);
            foreach ($sql as $row) {
                if ($row['password'] != $_REQUEST['password']) {
                    $alert = "<script type='text/javascript'>alert('パスワードが間違っています');</script>";
                    echo $alert;
                    $flag = 0;
                }
            }
            if ($flag) {
                if ($_REQUEST['new_password'] != $_REQUEST['confirm_new_password']) {
                    $alert = "<script type='text/javascript'>alert('入力されたパスワードが一致しません');</script>";
                    echo $alert;
                    break;
                }
                $name = $_SESSION['customer']['name'];
                $address = $_SESSION['customer']['address'];
                $sql=$pdo->prepare('update customer set password=? where id=?');
                $sql->execute($_REQUEST['new_password']);
                $_SESSION['customer']=[
                    'id'      =>$id,
                    'name'    =>$name,
                    'password'=>$_REQUEST['new_password'],
                    'address' =>$address
                ];
                break;
            }
            break;
            }
        }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ウォーキング</title>
</head>
<body>
    <div class= "ccc">
        <h1>タイトル</h1>
    </div>
    <?php
    // ログインしているか
    if (isset($_SESSION['customer'])) {
        echo"<div class= 'ccc'>";
        echo '<a href="account.php">';
        echo 'ACCOUNT';
        echo '</a>';
        echo '<a href="menu.php">';
        echo 'メインページ';
        echo '</a>';
        echo "</div>";
    } else {
        echo"<div class= 'ccc'>";
        echo '<a href="login.php">';
        echo 'LOGIN';
        echo '</a>';
        echo '<a href="new.php">';
        echo 'new account';
        echo '</a>';
        echo "</div>";
    }
    ?>

