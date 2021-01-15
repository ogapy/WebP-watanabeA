<?php
  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }

  if ($_GET["NAME"] && (1 <= $_GET["QUANTITY"]) && ($_GET["GENRE_ID"] != 0)) {
    $name = $_GET["NAME"];
    $quantity = $_GET["QUANTITY"];
    $genre_id = $_GET["GENRE_ID"];

    $pdo = new PDO("sqlite:../itemsDB.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $st = $pdo->prepare("insert into items(name, quantity, genreID, state) values(?, ?, ?, ?)");
    $st->execute(array($name, $quantity, $genre_id, 0));

    $result = "以下の内容で登録しました。";
    $result .= '<br>名前：' . $_GET["NAME"];
    $result .= '<br>個数：' . $_GET["QUANTITY"];
    $result .= '<br>カテゴリ：';
    if($genre_id == 1)  $result .= '本';
    else if($genre_id == 2)  $result .= 'カメラ';
    else if($genre_id == 3)  $result .= 'ビデオカメラ';
    else if($genre_id == 4)  $result .= 'HMD';
    else if($genre_id == 5)  $result .= '機材';
    else if($genre_id == 6)  $result .= '工具';
    else if($genre_id == 7)  $result .= '筆記用具';
  }
  else {  //エラーメッセージ
    $result = "登録に失敗しました";
    if(!$_GET["NAME"]){
      $result = $result . '<br>名前を入力してください';
    }
    if($_GET["QUANTITY"] < 1){
      $result = $result . '<br>個数は1以上の数値を入力してください';
    }
    if($_GET["GENRE_ID"] == 0){
      $result = $result . '<br>カテゴリを正しく設定してください';
    }
  }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>備品登録</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h1>備品登録</h1>

    <a href="mypage.php">マイページ</a>
    <a href="">ログアウト</a>

    <?php
      print '<p>';
      print $result;
      print '</p>';
    ?>
    
    <a href="add_form.html">備品登録ページに戻る</a>
    
</body>

</html>