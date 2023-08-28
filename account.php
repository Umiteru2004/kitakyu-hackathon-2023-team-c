<?php require 'header.php'; ?>

<?php
$tmp=$points;
$sql_points=$pdo->prepare('select * from points where customer_id=?');
$sql_points->execute([$_SESSION['customer']['id']]);
    foreach ($sql_points as $row_points) {
        //ここにユーザー名、アドレス、所得しているポイントを表示
        echo"<div class=aaa>";
        echo"<br>";
        echo "<p>ユーザー名: " . $_SESSION['customer']['username'] . "</p>";
        echo "<p>アドレス: " . $_SESSION['customer']['address'] . "</p>";
        echo "<p>所得しているポイント: " . $row_points['points'] ."</p>";
        echo"</div>";
    }
    if ($points == $tmp) {
        echo"<div class=aaa>";
        echo"<br>";
        echo "<p>ユーザー名: " . $_SESSION['customer']['username'] . "</p>";
        echo "<p>アドレス: " . $_SESSION['customer']['address'] . "</p>";
        echo '<p>ポイントはありません</p>';
        echo"</div>";
    }
    ?>

    <div class="bbb">
        <form action="login.php" method="post">
            <input type="hidden" name="command" value="logout">
            <input type="submit" value="ログアウト">
        </form>
    </div>
<?php require 'footer.php'; ?>

