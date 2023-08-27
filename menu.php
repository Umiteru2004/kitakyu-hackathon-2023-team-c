<?php require 'header.php'; ?>

<?php
$pdo=new PDO(
    'mysql:host=localhost;dbname=hakkason;charset=utf8',
    'staff',
    'password'
);

if (isset($_SESSION['admin'])) {
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

<?php require 'footer.php'; ?>
