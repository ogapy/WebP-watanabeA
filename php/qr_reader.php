<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>QRcodeReader</title>
</head>
<body>
  <div class="webcamera">
    <div id="reader">
      <video id="camera" class="reader-camera" autoplay playsinline></video>
    </div>
    <canvas id="frame"></canvas>
  </div>

  <div id="modal" class="modal-overlay">
    <div class="modal">
      <span class="modal-title">読み取り結果</span>
      <span id="result"></span>
      <a href="#" id="link">開く</a>
      <button type="button" id="modal-close">閉じる</button>
    </div>
  </div>
</body>
<script src="../js/jsQR.js" type="text/javascript"></script>
<script src="../js/QRcodeReader.js" type="text/javascript"></script>
</html>