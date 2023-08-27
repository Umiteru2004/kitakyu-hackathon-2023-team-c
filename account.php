<?php require 'header.php'; ?>

<?php
$tmp=$points;
$sql_points=$pdo->prepare('select * from points where customer_id=?');
$sql_points->execute([$_SESSION['customer']['id']]);
foreach ($sql_points as $row_points) {
    //ここにユーザー名、アドレス、所得しているポイントを表示
    echo "ユーザー名: " . $_SESSION['customer']['username'] . "<br>";
    echo "アドレス: " . $_SESSION['customer']['address'] . "<br>";
    echo "所得しているポイント: " . $row_points['points'] . "<br>";
}
if ($points == $tmp) {
    echo "ユーザー名: " . $_SESSION['customer']['username'] . "<br>";
    echo "アドレス: " . $_SESSION['customer']['address'] . "<br>";
    echo '<p>ポイントはありません</p>';
}
?>
<form action="login.php" method="post">
    <input type="hidden" name="command" value="logout">
    <button><input type="submit" value="ログアウト"></button>
            </form>

<?php require 'footer.php'; ?>

