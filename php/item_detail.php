<?php
  session_start();
  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }

  $pdo = new PDO("sqlite:../itemsDB.sqlite");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $st = $pdo->query("select * from items order by id desc");
  $data = $st->fetchAll();
  $i = $pdo->query("select * from user where name = ?");
  $i->execute(array(h($_SESSION["user"])));
  $current_user = $i->fetch();
  $user_id = $current_user["id"];

  // レンタル関係
  if(isset($_GET["rental"])){
    $id = $_GET["id"];
    $item = ($pdo->query("select * from items where id = ".$id))->fetch();
    // レンタルするとき
    if($_GET["rental"] == 1 && $item["quantity"] > 0){
      $item_update = ($pdo->query("update items set quantity = ".$item["quantity"]."-1 where id = ".$id))->fetch();
      $rental = $pdo->prepare("insert into rental(itemID, borrowDate, ownerID, returnDate) values(?, ?, ?, ?)");
      $rental->execute(array($id, date("Y/m/d"), $user_id, ""));
      // 全部レンタルされている時
      if($item_update["quantity"] <= 0){
        $item_update = $pdo->query("update items set state = 1 where id = ".$id);
      }
    // 返却するとき
    } else if($_GET["rental"] == 0) {
      $item_update = $pdo->query("update items set quantity = ".$item["quantity"]."+1, state = 0 where id = ".$id);
      $rental = $pdo->prepare("update rental set returnDate = ? where itemID = ? and ownerID = ?");
      $rental->execute(array(date("Y/m/d"), $id, $user_id));
      $rental = $rental->fetch();
      $_GET["rental"] = -1;
    }
  }

  if(isset($_GET["id"])){
    $id = $_GET["id"];
    $item = ($pdo->query("select * from items where id = ".$id))->fetch();
    $genre = ($pdo->query("select * from genre where id = ".$item["genreID"]))->fetch();
    $rental_records = ($pdo->query("select * from rental where itemID = ".$id))->fetchAll();
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>機材詳細</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php
    print '<a href="items.php?genre_id='.$genre["id"].'">戻る</a>';
    print '<div class="item-detail">';
      print '<h1 class="item-name text-center">'.$item["name"].'</h1>';
      print '<a href="items.php?genre_id='.$genre["id"].'" class="text-center">'.$genre["name"].'</a>';
      print '<p class="text-center">現在数量：'.$item["quantity"].'</p>';
      // まだ残ってる時
      if($item["state"] == 0) {
        print '<p class="available text-center">貸し出し可能</p>';
        print '<form action="item_detail.php" method="get">';
          print '<input type="hidden" value="1" name="rental">';
          print '<input type="hidden" value='.$id.' name="id">';
          print '<input type="submit" class="text-center" value="借りる">';
        print '</form>';
      // 貸し出し中の時
      } elseif($item["state"] == 1) {
        print '<p class="inavailable text-center">貸し出し中</p>';
        // print '<button class="inactive text-center" name="rental" value="1">借りる</button>';
        print '<form action="item_detail.php" method="get">';
          print '<input type="hidden" value="0" name="rental">';
          print '<input type="hidden" value='.$id.' name="id">';
          print '<input type="submit" class="text-center" value="返す">';
        print '</form>';
      }
      
      print '<span>貸し出し履歴</span>';
      print '<div class="rental-record">';
        foreach($rental_records as $rental_record){
          $rental_user = ($pdo->query("select * from user where id = ".$rental_record["ownerID"]))->fetch();
          print '<span>'.$rental_user["name"].'</span><span>'.$rental_user["grade"].'</span>';
          print '<span>'.$rental_record["borrowDate"].'</span><span>レンタル</span>';
          if($rental_record["returnDate"] !== ""){
            print '<span>'.$rental_record["returnDate"].'</span><span>返却</span>';
          }
        }
      print '</div>';
      print '<button class="text-center">この機材情報を削除する</button>';

      print '<div id="modal-overlay" class="modal-overlay">';
        print '<div class="modal">';
          print '<p>本当に削除して</p>';
          print '<p>よろしいですか？</p>';
          print '<a href="#">いいえ</a>';
          print '<a href="#">はい</a>';
        print '</div>';
      print '</div>';
    print '</div>';
  ?>
</body>
</html>