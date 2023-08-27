<script>
    function logout() {
        // ログアウト処理を実行
        fetch("logout.php")
            .then(response => {
                // ログアウト後にログインページにリダイレクト
                window.location.href = "login.php";
            });
    }
</script>

<p>ログアウトしてもよろしいですか？</p>
<button onclick="logout()">ログアウト</button>
