<!DOCTYPE html>
<?php
  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }
?>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>QRcodeReader</title>
</head>
<body>
  <div id="reader">
    <video id="camera" class="reader-camera" autoplay playsinline></video>
  </div>
  <canvas id="frame"></canvas>

  <div id="modal" class="modal-overlay">
    <div class="modal">
      <span class="modal-title">読み取り結果</span>
      <span id="result"></span>
    </div>
    <a href="result.php?id=" id="link" target="_blank">開く</a>
    <button type="button" id="modal-close">閉じる</button>
  </div>
</body>
<script src="jsQR.js"></script>
<script src="QRcodeReader.js"></script>
</html>