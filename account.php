<?php require 'header.php'; ?>

<?php

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

?>
<form action="login.php" method="post">
    <input type="hidden" name="command" value="logout">
    <button><input type="submit" value="ログアウト"></button>
            </form>