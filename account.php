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
        <div class="bbb">
        <form action="account.php" method="post">
            <input type="hidden" name="command" value="address">
            <?php
            echo '<input type="hidden" name="name" value="', $_SESSION['customer']['name'], '">';
            echo '<input type="hidden" name="password" value="', $_SESSION['customer']['password'], '">';
            // echo '<table>';
            echo '<p>ADDRESS</p>';
            echo '<p><input type="text" name="address" value="', $_SESSION['customer']['address'], '" required></p>';
            echo '<p><button type="submit">変更</button></p>';
            echo '<p>Password</p>';
            echo '********.'."<br>";
            echo '<a href="change_pass.php"><button type="button" onclick="location.href=\'change_pass.php\'">変更</button></a>';
            // echo '</table>';
            ?>
        </form>


            <form action="login.php" method="post">
                <input type="hidden" name="command" value="logout">
                <input type="submit" value="ログアウト">
            </form>
        </div>
<?php require 'footer.php'; ?>

