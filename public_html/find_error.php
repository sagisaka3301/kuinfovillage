<?php
// headの読み込み
$title = 'KU Info Village';
$discription = '神奈川大学学生専用の授業情報掲示板です。履修の際に参考にしてください。';
include 'head.php';
?>
<link rel="stylesheet" href="./css/find_error.css">
<link rel="stylesheet" href="./css/exclusive-res.css">

<div class="filter">
<body>
    <?php include 'header.php'; ?>
    <main>
        <!-- ローディング -->
        <div id="loading">
            <div class="spinner"></div>
        </div>
        <div class="class-inner">
            <div class="title">
                <h3>投稿がありません</h3>
            </div>
            <a href="./class-info.php" class="back">BACK</a>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="./js/detail.js"></script>
</body>
</div>
</html>