<?php
    ini_set('display_errors', "On");
    error_reporting(E_ALL);
    function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }

    $pdo = new PDO("sqlite:../itemsDB.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $st = $pdo->query("select * from items order by id desc");
    $data = $st->fetchAll();

    if(isset($_GET["genre_id"])){
        $genre_id = $_GET["genre_id"];
        // $item = ($pdo->query("select * from items where id = ".$id));
        $items = ($pdo->query("select * from items where genreID = ".$genre_id))->fetchAll();
        $genre = ($pdo->query("select * from genre where id = ".$genre_id))->fetch();
    }
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <?php print '<title>'.$genre["name"].'</title>'; ?>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div>
    <?php print '<h1>'.$genre["name"].'</h1>'; ?>
    <a href="list.php">リストへ戻る</a>

    <?php
    print '<a href="delete_check.php?genre='.$genre_id.'">削除する</a>';
    print '<table border=1>';
    print '<tr>';
    print '<th width="40">ID</th>';
    print '<th>名前</th>';
    print '<th width="40">個数</th>';
    print '<th width="80">貸出状況</th>';
    print '</tr>';

    foreach($items as $item){
        print '<tr><td>' . $item['id'] . '</td>';
        print '<td align="left"><a href="item_detail.php?id='.$item['id'].'">' . $item['name'] . '</a></td>';
        print '<td>' . $item['quantity'] . '</td>';
        if ($item['state'] == 0) {
            print '<td>〇</td>';
        } else if ($item['state'] == 1) {
            print '<td>×</td>';
        }
        print '</tr>';
    }
    print '</table>';
    ?>
    
    </div>
</body>

</html>