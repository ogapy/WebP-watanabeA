<?php
  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }

  $pdo = new PDO("sqlite:itemsDB.sqlite");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $st = $pdo->query("select * from items order by id desc");
  $data = $st->fetchAll();

  if(isset($_GET["id"])){
    $id = $_GET["id"];
    $item = $pdo->query("select * from items where id = ".$id);
    $result = $item->fetch();
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Result</title>
</head>
<body>
  <?php
    print_r($result);
    print $result["id"];
    print $result["name"];
  ?>
</body>
</html>