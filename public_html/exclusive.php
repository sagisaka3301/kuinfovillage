<?php 
session_start();
require_once '../classes/UserLogic.php';
require_once '../classes/dbc.php';
require_once '../classes/class-func.php';

if (!isset($_SESSION['login_user'])) {
    header('Location: index.php');
}

$user_id = $_SESSION['user_id'];
$user = UserLogic::getUser($user_id);

$info = new Info();
$exdata = $_POST['select-under'];

$echoUngra = $info->setUndergra($exdata);

$find = array_reverse($info->searchUndergra($exdata));

define('MAX', '36');

$infoCount = count($find);

$max_page = ceil($infoCount / MAX);

if (!isset($_GET['page_id'])) { // $_GET['page_id'] はURLに渡された現在のページ数
    $now = 1; // 設定されてない場合は1ページ目にする
} else {
    $now = $_GET['page_id'];
}


$start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか

// array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る
$disp_data = array_slice($find, $start_no, MAX, true);

// headの読み込み
$title = 'KU Info Village｜お問い合わせ';
$discription = '神奈川大学学生専用の授業情報掲示板です。履修の際に参考にしてください。';
include 'head.php';

?>
<link rel="stylesheet" href="./css/class-info.css">
<link rel="stylesheet" href="./css/exclusive-res.css">
<div class="filter">
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="class-inner">
            <div class="title">
                <h3>～学部検索(<?php echo $echoUngra; ?>)～</h3>
            </div>
            <div class="back-sec">
                <a href="class-info.php">BACK</a>
            </div>
            <div class="list-box">
                <table>
                    <div class="contents">
                    <div class="info-cover" style="
                    <?php 
                        if ($user['post_flag'] === '0') {
                            echo "display:block;";
                        } else {
                            echo "display:none;";
                        }
                    ?>
                    ">
                        <p>1つでも、授業の評価を投稿していただけると、すべての評価が閲覧可能になります。新入生は、これまで受けた数回の授業の感想などを投稿していただければと思います。</p>
                    </div>
                    <?php foreach($find as $contents): ?>
                        <div class="class-content">
                            <?php 
                            /*
                                if($user['post_flag'] === 0) {
                                    echo '<div class="info-cover"><p>1つでも授業評価を投稿していただくと全ての評価が閲覧可能になります。新入生は第1回の授業でもいいので感想を投稿してください。</p></div>';
                                }
                            */
                            ?>
                            <div class="name-type">
                                <div class="con-name">
                                    <p><?php echo $contents['class_name']; ?>　<span><?php echo $info->setType($contents['type']); ?></span></p>
                                </div>
                            </div>
                            <div class="con-charge">
                                <p>担当者　　<?php echo $contents['in_charge']; ?> さん</p>
                            </div>
                            <div class="con-star">
                                <p><?php echo $info->setStar($contents['evaluation']); ?></p>
                            </div>
                            <div class="con-under">
                                <p><?php echo $info->setUndergra($contents['undergra']); ?></p>
                            </div>
                                <a href="./detail.php?id=<?php echo $contents['id']; ?>" class="deta">詳細</a>
                            <div class="con-comment">
                                <p><?php echo $contents['comment']; ?></p>
                            </div>
                            <div class="con-date">
                                <p><?php echo $contents['up_time']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                </table>
            </div>
        </div>
        <p class="links">
            <?php 
                echo '全件数'. $infoCount. '件'. '　'; // 全データ数の表示です。
                
                if($now > 1){ // リンクをつけるかの判定
                    echo '<a href="./class-info.php?page_id='.($now - 1).'")>前へ</a>'. '　';
                } else {
                    echo '前へ'. '　';
                }

                for($i = 1; $i <= $max_page; $i++){ // 最大ページ数分リンクを作成
                    if ($i == $now) { // 現在表示中のページ数の場合はリンクを貼らない
                        echo $now. '　'; 
                    } else {
                        echo '<a href="./exclusive.php?page_id='. $i. '")>'. $i. '</a>'. '　';
                    }
                }

                if($now < $max_page){ // リンクをつけるかの判定
                    echo '<a href="./exclusive.php?page_id='.($now + 1).'")>次へ</a>'. '　';
                } else {
                    echo '次へ';
                }
            ?>
        </p>
    </main>
    <?php include 'footer.php'; ?>
    <script src="./js/detail.js"></script>
</body>
</div>
</html>