<?php require 'header.php'; ?>

<?php
$tmp=$points;
$sql_points=$pdo->prepare('select * from points where customer_id=?');
$sql_points->execute([$_SESSION['customer']['id']]);
    foreach ($sql_points as $row_points) {
        //ここにユーザー名、アドレス、所得しているポイントを表示
        echo"<div class=aaa>";
        echo"<br>";
        echo "<p>ユーザー名: " . $_SESSION['customer']['name'] . "</p>";
        echo "<p>アドレス: " . $_SESSION['customer']['address'] . "</p>";
        echo "<p>所得しているポイント: " . $row_points['points'] ."</p>";
        echo"</div>";
    }
    if ($points == $tmp) {
        echo"<div class=aaa>";
        echo"<br>";
        echo "<p>ユーザー名: " . $_SESSION['customer']['name'] . "</p>";
        echo "<p>アドレス: " . $_SESSION['customer']['address'] . "</p>";
        echo '<p>ポイントはありません</p>';
        echo"</div>";
    }
    ?>

    <form action="account.php" method="post">
        <input type="hidden" name="command" value="address">
        <?php
        echo '<input type="hidden" name="name" value="', $_SESSION['customer']['name'], '">';
        echo '<input type="hidden" name="password" value="', $_SESSION['customer']['password'], '">';
        echo '<table>';
        echo '<tr><td><label>ADDRESS</label></td>';
        echo '<td><input type="text" name="address" value="', $_SESSION['customer']['address'], '" required></td>';
        echo '<td><button type="submit">変更</button></td></tr>';
        echo '<tr><td><label>Password</label></td>';
        echo '<td>';
        echo '********';
        echo '</td>';
        echo '<td><a href="change_pass.php"><button type="button" onclick="location.href=\'change_pass.php\'">変更</button></a></td></tr>';
        echo '</table>';
        ?>
    </form>

    <div class="bbb">
        <form action="login.php" method="post">
            <input type="hidden" name="command" value="logout">
            <input type="submit" value="ログアウト">
        </form>
    </div>
<?php require 'footer.php'; ?>

