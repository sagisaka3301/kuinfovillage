<?php
require_once '../classes/class-func.php';

$getclass = new Info();

$result = $getclass->getById($_GET['id']);
$id = $result['id'];


// headの読み込み
$title = 'KU Info Village';
$discription = '神奈川大学学生専用の授業情報掲示板です。履修の際に参考にしてください。';
include 'head.php';

?>

<link rel="stylesheet" href="./css/detail.css">

<div class="filter">
<body> 
    <?php include 'header.php'; ?>
    <main>
    <!-- ローディング -->
    <div id="loading">
        <div class="spinner"></div>
    </div>
    <a href="javascript:history.back()" class="back">BACK</a>
    <div class="list-box">
        <div class="contents">
            <div class="class-content">
                <div class="name-type">
                    <div class="con-name">
                        <p><?php echo $result['class_name']; ?>　<span><?php echo $getclass->setType($result['type']); ?></span></p>
                    </div>
                </div>
                <div class="con-charge">
                    <p>担当者　　<?php echo $result['in_charge']; ?> さん</p>
                </div>
                <div class="con-star">
                    <p><?php echo $getclass->setStar($result['evaluation']); ?></p>
                </div>
                <div class="con-under">
                    <p><?php echo $getclass->setUndergra($result['undergra']); ?></p>
                </div>
                <div class="con-comment">
                    <p><?php echo $result['comment']; ?></p>
                </div>
                <div class="con-date">
                    <p><?php echo $result['up_time']; ?></p>
                </div>
            </div>
        </div>
    </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</div>
</html>