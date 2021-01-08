const video = document.querySelector("#camera");
const canvas = document.querySelector("#frame");
const ctx = canvas.getContext("2d");

window.onload = () => {
  /** カメラ設定 */
  const constraints = {
    audio: false,
    video: {
      width: 300,
      height: 200,
      facingMode: "user"   // フロントカメラを利用する
    }
  };

  navigator.mediaDevices.getUserMedia(constraints)
    .then((stream) => {
      video.srcObject = stream;
      video.onloadedmetadata = (e) => {
        video.play();
        checkQR();
      }
    })
    .catch((e) => {
      alert(e.name + ": " + e.message);
    });
}

/**
 * QRコードの読み取り
 */
function checkQR() {
  // カメラの映像をCanvasに描画
  ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
  // QRコードのCanvasから取得
  const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
  // jsQRに渡す
  const code = jsQR(imageData.data, canvas.width, canvas.height);

  if (code) {
    drawFrame(ctx, code.location);
    openModal(code.data);
    console.log("hello");
  } else {
    setTimeout(() => {
      checkQR();
    }, 200);
  }
}

function drawFrame(ctx, pos, options = { color: "yellow", size: 3 }) {
  // 線のスタイル設定
  ctx.strokeStyle = options.color;
  ctx.lineWidth = options.size;

  // 線を描画
  ctx.beginPath();
  ctx.moveTo(pos.topLeftCorner.x, pos.topLeftCorner.y); // 左上スタート
  ctx.lineTo(pos.topRightCorner.x, pos.topRightCorner.y);
  ctx.lineTo(pos.bottomRightCorner.x, pos.bottomRightCorner.y);
  ctx.lineTo(pos.bottomLeftCorner.x, pos.bottomLeftCorner.y);
  ctx.lineTo(pos.topLeftCorner.x, pos.topLeftCorner.y);
  ctx.stroke();
}

function openModal(url) {
  document.querySelector("#result").innerText = url;
  document.querySelector("#link").setAttribute("href", "result.php?id=" + url);
  document.querySelector("#modal").classList.add("show");
}

document.querySelector("#modal-close").addEventListener("click", () => {
  document.querySelector("#modal").classList.remove("show");
  checkQR();
});