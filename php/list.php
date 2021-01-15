<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>備品リスト画面</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header class="page-header wrapper">
        <h2><img class="logo" src="../images/LabLogo.svg">RentaLab</h2>
        <nav>
            <ul class="main">
                <li><a href="mypage.php">マイページ</a></li>
                <li><a href="">ログアウト</a></li>
            </ul>
        </nav>
    </header>

    <h1 class="title-border">備品リスト:カテゴリ</h1>

    <div class="list grid">
        <div class="item">
            <a href="items.php?genre_id=1">
                <img src="../images/book4.png" alt="" width="100%">
                <!-- <p>本</p> -->
            </a>
        </div>
        <div class="item">
            <a href="items.php?genre_id=2">
                <img src="../images/camera2.png" alt=""  width="100%">
                <p>カメラ</p>
            </a>
        </div>
        <div class="item">
            <a href="items.php?genre_id=3">
                <img src="../images/videocamera2.png" alt=""  width="100%">
                <p>ビデオカメラ</p>
            </a>
        </div>
        <div class="item">
            <a href="items.php?genre_id=4">
            <img src="../images/hmd2.png" alt="" style="border:double 5px #b9b9b9" width="100%">
            <p>HMD</p>
            </a>
        </div>
        <div class="item">
            <a href="items.php?genre_id=5">
            <img src="../images/devices2.png" alt="" style="border:double 5px #b9b9b9" width="100%">
            <p>機材</p>
            </a>
        </div>
        <div class="item">
            <a href="items.php?genre_id=6">
            <img src="../images/instrument2.png" alt="" style="border:double 5px #b9b9b9" width="100%">
            <p>工具</p>
            </a>
        </div>
        <div class="item">
            <a href="items.php?genre_id=7">
            <img src="../images/stationery2.png" alt="" style="border:double 5px #b9b9b9" width="100%">
            <p>筆記用具</p>
            </a>
        </div>
    </div>

</body>

</html>