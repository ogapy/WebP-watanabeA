<?php
  session_start();

  ini_set('display_errors', "On");
  error_reporting(E_ALL);

  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }

  if (isset($_POST["username"])) {
      
    $user = $_POST["username"];
    $mail = $_POST["mail"];
    $passwd = $_POST["passwd"];
    $grade = $_POST["grade"];

    //＊＊＊プリペアドステートメントを使い、テーブルarticleに$title, $body, $timeを登録する処理をここに書く＊＊＊
    if($user == "" or $mail=="" or $passwd=="" or $grade==""){
      $result = "入力欄に空欄があり、登録できませんでした";
    }else{
      $pdo = new PDO("sqlite:../itemsDB.sqlite");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      
      $stt = $pdo->prepare("select * from user where name = ?; ");
      $stt->execute(array(h($user)));
      $data = $stt->fetch();

      if(!isset($data['name'])){
        $st = $pdo->prepare("insert into user(name, mail, password, grade) values(?, ?, ?, ?)");
        $st->execute(array($user, $mail, $passwd, $grade));
        $result = "ok";
      }else{
        $result = "同じアカウント名が存在するため、登録できません";
      }
    }

  }
  else {
    $result = "エラーが発生しました";
  }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>My Blog - 記事登録</title>
    <link rel="stylesheet" href="../css/style.css">          
  </head>
  <body>

    <!-- 処理結果$resultと、ブログのページ(top.php)に戻るリンクを表示するHTMLをここに書く-->
    <?php
      if($result == "ok"){
        $pdo->query("insert into user(name, mail, password, grade) values(".$user.",".$mail.",".$passwd.",".$grade.");");
        print "<div class = 'article'>";
        print "<h2>".$result."</h2>";
        print "<a href = 'top.html'>トップへ戻る</a>";
        print "</div>";
      }
      else{
        print "<div class = 'article'>";
        print "<h2>".$result."</h2></br>";
        print "<a href = 'login.php'>入力画面に戻る<br></a><br>";
        print "<a href = 'top.html'>トップに戻る<br></a>";
        print "</div>";
      }
    ?>

  </body>
</html>
