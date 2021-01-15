<?php
    ini_set('display_errors', "On");
    error_reporting(E_ALL);

    $db = new PDO("sqlite:../itemsDB.sqlite");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $book = $db->query("delete from items where id=" . $_GET['id']);    //データベースitemsのidの値を前ページから送ってくる

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>削除完了</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="center">    
    <h3>
        削除しました
    </h3>

    <a href="list.php">リストへ戻る</a>
    </div>
    
</body>

</html>