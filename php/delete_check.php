<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>備品削除</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="center">
    <h1>
    <?php
        //リスト表示のページから変数genreにデータベースitemsのgenreIDの値を入れてここに渡してる
        if(isset($_GET['genre'])){
            $num = $_GET['genre'];
            if($num == 1)   print '本';
            else if($num == 2)  print 'カメラ';
            else if($num == 3)  print 'ビデオカメラ';
            else if($num == 4)  print 'HMD';
            else if($num == 5)  print '機材';
            else if($num == 6)  print '工具';
            else if($num == 7)  print '筆記用具';
        }
    ?>
    </h1>
    <a href="list.php">リストへ戻る</a>

    <?php
    ini_set('display_errors', "On");
    error_reporting(E_ALL);

    $db = new PDO("sqlite:../itemsDB.sqlite");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $book = $db->query("select * from items where genreID=" . $num);
    $rows = $book->fetchAll();

    print '<table border=1>';
    print '<tr>';
    print '<th width="40">ID</th>';
    print '<th>名前</th>';
    print '<th width="40">個数</th>';
    print '<th width="80">貸出状況</th>';
    print '<th width="60"></th>';
    print '</tr>';

    for ($i = 0; $i < count($rows); $i++) {
        print '<tr><td>' . $rows[$i]['id'] . '</td>';
        print '<td align="left">' . $rows[$i]['name'] . '</td>';
        print '<td>' . $rows[$i]['quantity'] . '</td>';
        //print '<td>'.$rows[$i]['genreID'].'</td>';
        if ($rows[$i]['state'] == 0) {
            print '<td>〇</td>';
        } else if ($rows[$i]['state'] == 1) {
            print '<td>×</td>';
        }
        print '<td>';
        print '<form action="delete_submit.php" method="GET"></form>';
        print '<a href="delete_confirm.php?id=' . $rows[$i]['id'] . '">削除</a></td>';
        print '</tr>';
    }
    print '</table>';
    ?>
    </div>
</body>

</html>