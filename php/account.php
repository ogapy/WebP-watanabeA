<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>新規登録画面</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h1>新規登録</h1>
    <div class="form">
        <form action="account_registered.php" method="post">
            <label class="box">
                <input type="text" value="" placeholder="ユーザー名" name="username"><br><br>
                <input type="text" value="" placeholder="メールアドレス" name="mail"><br><br>
                <input type="password" value="" placeholder="パスワード" name="passwd"><br><br>
                <input type="text" value="" placeholder="学年" name="grade"><br>
            </label>
            <br><br>
            <input type="submit" value="登録">
            <div class="back">
                <p><button type="button" name="back" onclick="location.href='top.html'">戻る</button></p>
            </div>
        </form>
    </div>
</body>

</html>