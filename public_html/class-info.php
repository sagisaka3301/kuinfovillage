<!-- 情報掲示板ページ -->
<?php 
session_start();
require_once '../classes/UserLogic.php';
require_once '../classes/dbc.php';
require_once '../classes/class-func.php';

// セッション確認
if (!isset($_SESSION['login_user'])) {
    header('Location: index.php');
}

$user_id = $_SESSION['user_id'];
$user = UserLogic::getUser($user_id);

$info = new Info();
$infoData = array_reverse($info->getAll());

// ページ遷移
define('MAX', '36');

$infoCount = count($infoData);

$max_page = ceil($infoCount / MAX);


if (!isset($_GET['page_id'])) { 
    $now = 1; 
} else {
    $now = $_GET['page_id'];
}


$start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか

// array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る
$disp_data = array_slice($infoData, $start_no, MAX, true);

// headの読み込み
$title = 'KU Info Village｜授業情報';
$discription = '神奈川大学学生専用の授業情報掲示板です。履修の際に参考にしてください。';
include 'head.php';

?>
<link rel="stylesheet" href="./css/class-info.css">
<link rel="stylesheet" href="./css/class-info-res.css">
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
                <h3>～授業情報掲示板～</h3>
                <h2>Class Information Board</h2>
            </div>
            <div class="search-post-area">
                <!-- 学部絞り込み -->
                <div class="exclusive-box">
                    <div class="e-list">
                    <form class="ungra-ev" action="exclusive.php" method="post">
                        <select name="select-under" id="" class="ungra-ex">
                            <option value="9">すべて</option>
                            <option value="1">経営学部</option>
                            <option value="2">経済学部</option>
                            <option value="3">外国語学部</option>
                            <option value="4">国際日本学部</option>
                            <option value="5">法学部</option>
                            <option value="6">人間科学部</option>
                            <option value="7">理学部</option>
                            <option value="8">工学部</option>
                        </select>
                        <input type="submit" class="ex-sub" value="学部検索">
                    </form>
                    </div>
                </div>
                <form class='postform' enctype="multipart/form-data" action="./find.php" method="post">
                    <input type="search" name="search" class="search" placeholder="授業名を検索" required>
                    <input type="submit" name="search_submit" class="search-sub" value="検索">
                </form>
                <div class="open-btn">
                    <p>評価投稿</p>
                </div>
            </div>
            <!-- 評価投稿フォーム -->
            <div class="review-box">
                <div class="rev-title">
                    <h2>～POST CLASS REVIEW～</h2>
                </div>
                <form enctype="multipart/form-data" action="info-post.php" method='POST'>
                    <input type="hidden" name="post_user" value="<?php echo $user['email']; ?>">
                    <div class="gakubu-taipu">
                        <div class="gakubu">
                            <label for="">学部</label>
                            <select name="undergra" id="">
                                <option value="1">経営学部</option>
                                <option value="2">経済学部</option>
                                <option value="3">外国語学部</option>
                                <option value="4">国際日本学部</option>
                                <option value="5">法学部</option>
                                <option value="6">人間科学部</option>
                                <option value="7">理学部</option>
                                <option value="8">工学部</option>
                            </select>
                        </div>
                        <div class="taipu">
                            <label for="">授業種</label>
                            <select name="type" id="type">
                                <option value="1">共通教養</option>
                                <option value="2">専攻科目</option>
                                <option value="3">その他</option>
                            </select>
                        </div>
                    </div>
                    <div class="jugyou-tantou">
                        <div class="jugyou">
                            <label for="">講義名</label>
                            <input type="text" name="class_name" placeholder="" required>
                        </div>
                        <div class="tantou">
                            <label for="">担当教員</label>
                            <input type="text" name="in_charge" placeholder=""><span>さん</span>
                        </div>
                    </div>
                    <!-- 星の評価 -->
                    <div class="star-review">
                        <input class="rating__input hidden--visually" type="radio" id="5-star" name="rating" value="5" />
                        <label class="rating__label" for="5-star" title="星5つ"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">星5つ</span></label>
                        <input class="rating__input hidden--visually" type="radio" id="4-star" name="rating" value="4" />
                        <label class="rating__label" for="4-star" title="星4つ"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">星4つ</span></label>
                        <input class="rating__input hidden--visually" type="radio" id="3-star" name="rating" value="3" />
                        <label class="rating__label" for="3-star" title="星3つ"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">星3つ/span></label>
                        <input class="rating__input hidden--visually" type="radio" id="2-star" name="rating" value="2" />
                        <label class="rating__label" for="2-star" title="星2つ"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">星2つ</span></label>
                        <input class="rating__input hidden--visually" type="radio" id="1-star" name="rating" value="1" required/>
                        <label class="rating__label" for="1-star" title="星1つ"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">星1つ</span></label>
                        <label class="star-title" for="">評価：</label>
                    </div>
                    <div class="hyouka">
                        <label for="">コメント</label>
                        <textarea name="comment" placeholder="(例) 課題が多過ぎる／楽単だけど充実はしてない／面白くて単位も普通にとれる。etc"></textarea>
                    </div>
                    <div class="submit-btn">
                        <input class="toukou" type="submit" value="投稿">
                    </div>
                    <!-- 投稿者 -->
                </form>
            </div>
            <!-- 評価一覧 -->
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
                        <p>1つでも、授業の評価を投稿していただけると、このフィルターが外れ、すべての評価の詳細が閲覧可能になります。新入生は、これまで受けた数回の授業の感想などを投稿していただければと思います。</p>
                    </div>
                    <?php foreach($disp_data as $content): ?>
                        <div class="class-content">
                            <div class="name-type">
                                <div class="con-name">
                                    <p><?php echo $content['class_name']; ?>　<span><?php echo $info->setType($content['type']); ?></span></p>
                                </div>
                            </div>
                            <div class="con-charge">
                                <p>担当者　　<?php echo $content['in_charge']; ?> さん</p>
                            </div>
                            <div class="con-star">
                                <p><?php echo $info->setStar($content['evaluation']); ?></p>
                            </div>
                            <div class="con-under">
                                <p><?php echo $info->setUndergra($content['undergra']); ?></p>
                            </div>
                                <a href="./detail.php?id=<?php echo $content['id']; ?>" class="deta">詳細</a>
                            <div class="con-comment">
                                <p><?php echo $content['comment']; ?></p>
                            </div>
                            <div class="con-date">
                                <p><?php echo $content['up_time']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                </table>
            </div>
            <p class="links">
            <?php 
                echo '全件数'. $infoCount. '件'. '　'; // 全データ数の表示。
                
                if($now > 1){ // リンクをつけるかの判定
                    echo '<a href="./class-info.php?page_id='.($now - 1).'")>前へ</a>'. '　';
                } else {
                    echo '前へ'. '　';
                }

                for($i = 1; $i <= $max_page; $i++){ // 最大ページ数分リンクを作成
                    if ($i == $now) { // 現在表示中のページ数の場合はリンクを貼らない
                        echo $now. '　'; 
                    } else {
                        echo '<a href="./class-info.php?page_id='. $i. '")>'. $i. '</a>'. '　';
                    }
                }

                if($now < $max_page){ // リンクをつけるかの判定
                    echo '<a href="./class-info.php?page_id='.($now + 1).'")>次へ</a>'. '　';
                } else {
                    echo '次へ';
                }
            ?>
            </p>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="./js/class-info.js"></script>