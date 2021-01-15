<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>備品削除確認ページ</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="center">
    <h3>
        このアイテムを備品リストから削除します。よろしいですか？
    </h3>

    <?php
    ini_set('display_errors', "On");
    error_reporting(E_ALL);

    $db = new PDO("sqlite:../itemsDB.sqlite");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $book = $db->query("select * from items where id=" . $_GET['id']);  //データベースitemsのidの値を前ページから送ってくる
    $rows = $book->fetchAll();

    print '<table border=1>';
    print '<tr>';
    print '<th width="40">ID</th>';
    print '<th>名前</th>';
    print '<th width="40">個数</th>';
    print '<th width="80">カテゴリ</th>';
    print '</tr>';

    for ($i = 0; $i < count($rows); $i++) {
        print '<tr><td>' . $rows[$i]['id'] . '</td>';
        print '<td align="left">' . $rows[$i]['name'] . '</td>';
        print '<td>' . $rows[$i]['quantity'] . '</td>';
        print '<td>';
        $genre_id = $rows[$i]['genreID'];
        if($genre_id == 1)  print '本';
        else if($genre_id == 2) print 'カメラ';
        else if($genre_id == 3) print 'ビデオカメラ';
        else if($genre_id == 4) print 'HMD';
        else if($genre_id == 5) print '機材';
        else if($genre_id == 6) print '工具';
        else if($genre_id == 7) print '筆記用具';
        print '</td>';
        /*
        if ($rows[$i]['state'] == 0) {
            print '<td>〇</td>';
        } else if ($rows[$i]['state'] == 1) {
            print '<td>×</td>';
        }
        */

        print '</tr>';
    }
    print '</table>';
    ?>
    <p>
        <?php
        print '<form action=delete_submit.php method="GET"></form>';
        print '<a href="delete_submit.php?id=' . $rows[0]['id']. '">はい</a><br>';
        print '<a href="delete_check.php?genre=' . $rows[0]['genreID']. '">いいえ(備品リストに戻る)</a><br>';
        ?>
    </p>
    <a href="list.php">リストへ戻る</a>
    </div>
    
</body>

</html>