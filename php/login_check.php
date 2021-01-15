<?php
  session_start();
  
  ini_set('display_errors', "On");
  error_reporting(E_ALL);


  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }

  if (isset($_POST["username"]) && isset($_POST["passwd"])) {
    $username = $_POST["username"];
    $passwd = $_POST["passwd"];
    $check = false;

    $pdo = new PDO("sqlite:../itemsDB.sqlite");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $st = $pdo->prepare("select * from user where name = ?; ");
    $st->execute(array(h($username)));
    $data = $st->fetch();

    if(!$data){
      $result = "指定されたユーザが存在しません";
    }else if( $passwd == $data["password"]){
      $_SESSION["user"] = $username;
      $result = "ようこそ！".$username."さん。ログインに成功しました";
      $check = true;
    }else{
      $result = "パスワードが違います";
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login success</title>
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <div class="form">
      
      <?php 
        print "<h2>".$result."</h2>";
        
        if($check){
          print '<p><a href="mypage.php">マイページへ進む</a></p>';
        }
      ?>
      
      
    </div>

    
  </body>
</html>
