<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>ログイン</h1>
    <div class="form">
        <form action="login_check.php" method="post">
            <h3>ユーザー名とパスワードを入力してください</h3>
            <label class="box">
                <input type="text" value="" placeholder="ユーザー名" name="username"><br><br>
                <input type="password" value="" placeholder="パスワード" name="passwd"><br>
            </label>
            <br><br>
            <input type="submit" value="ログイン">
        </form>
        <div class="back">
            <p><button type="button" name="back" onclick="location.href='top.html'">戻る</button></p>
        </div>
    </div>
</body>
​
</html>