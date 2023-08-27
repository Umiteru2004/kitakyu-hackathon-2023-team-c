<?php session_start(); ?>


<?php
$pdo=new PDO(
    'mysql:host=localhost;dbname=hakkason;charset=utf8',
    'staff',
    'password'
  );


if (isset($_REQUEST['command'])) {
    switch ($_REQUEST['command']) {
        // ログイン
        case 'login':
            unset($_SESSION['admin']);

            // ユーザー名とパスワードの検証
            $sql = $pdo->prepare("select * from admin where username=? and password=?");
            $sql->execute([$_REQUEST['username'], $_REQUEST['password']]);
            foreach($sql as $row){
                $_SESSION['admin']=[
                    'admin_id'        => $row['admin_id'],
                    'username'      => $row['username'],
                    'password'  => $row['password']
                ];
            }
            if (!isset($_SESSION['admin'])) {
                //$alert = "<script type='text/javascript'>alert('ログイン名もしくはパスワードが間違っています');</script>";
                //echo $alert;
                error_reporting(E_ALL);
                ini_set('display_errors', 1); 
                print_r($_SESSION);

            }
            break;

        // ログアウト
        case 'logout':
            unset($_SESSION['admin']);
            break;
    }
}

if (isset($_SESSION['admin'])) {
    require 'header.php';
    echo '<div class="m-5">';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">ID</th><th scope="col">名前</th><th scope="col" style="width: 5%">パスワード</th>';
    echo '</tr>';
    echo '</thead>';
    foreach ($pdo->query('select * from admin') as $row) {
        echo '<tbody>';
        echo '<tr>';
        echo '<td>', $row['admin_id'], '</td>';
        echo '<td>', $row['username'], '</td>';
        echo '<td>', $row['password'], '</td>';
        echo '<td>', $row['address'], '</td>';
        echo '</tr>';
        echo "\n";
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<a href="login.php">ログインに戻る</a>';
}
?>

</div>

</body>
</html>
