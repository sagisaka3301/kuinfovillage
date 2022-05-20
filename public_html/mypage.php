<?php
session_start();
require_once '../classes/UserLogic.php';
require_once '../classes/functions.php';

$user_id = $_SESSION['user_id'];

$user = UserLogic::getUser($user_id);

// $_SESSION['user']はほかのページでも使いまわす
$_SESSION['user'] = $user;

$up_user = $_SESSION['user'];



//ログインしているか判定し、していなかったら新規登録画面に返す
$result = UserLogic::checkLogin();

if (!$result) {
    header('Location: index.php');
    return;
}

$login_user = $_SESSION['login_user'];

$title = 'KU Info Village｜マイページ';
$discription = '神奈川大学学生専用の授業情報掲示板です。履修の際に参考にしてください。';
include 'head.php';

?>
<link rel="stylesheet" href="./css/mypage.css">
<link rel="stylesheet" href="./css/mypage-res.css">

<div class="filter">
<body>
<?php include 'header.php'; ?>
    <main>
        <!-- ローディング -->
        <div id="loading">
            <div class="spinner"></div>
        </div>
        <div class="h-title">
            <h3>～マイページ～</h3>
            <h2>My Page</h2>
        </div>
        <div class="user-area" >
            <div class="user-info" style="background-image: url('./img/black.jpg')">
                <div class="ui-title">
                    <h3>～USER DATA～</h3>
                </div>
                <!-- 表示する処理・・本番は画像エリアに -->
                <div class="pro-img-front">
                    <img src="<?php echo "{$up_user['f_path']}"; ?>" alt="###" >
                </div>
                <div class="user-datas">
                    <div class="u-name">
                        <div class="un-title">USERNAME：</div>
                        <div class="un-con"><?php echo h($up_user['name']) ?></div>
                    </div>
                    <div class="u-mail">
                        <div class="um-title">EMAIL：</div>
                        <div class="um-con"><?php echo h($up_user['email']) ?></div>
                    </div>
                    <div class="edit-logout">
                        <div class="e-btn">
                            <p class="edit-btn">プロフィール編集</p>
                        </div>
                        <div class="l-btn">
                            <form action="logout.php" method='POST'>
                                <input type="submit" name='logout' value="ログアウト">
                            </form>
                        </div>
                    </div>
                </div>               
            </div>
        </div>
        <div class="edit-form">
            <form enctype="multipart/form-data" action="pro_update.php" method='POST'>
                <p class="e-user">EDIT PROFILE</p>
                <div class="edit-inner">
                    <div class="image-e-form">
                        <div class="img-edit">
                            <div class="file-up">
                                <input class='file_img' type="hidden" name="MAX_FILE_SIZE" value="3048576" />
                                <label>
                                    <span class="e-f-title">プロフィール画像</span>
                                    <img src="" alt="">
                                    <input class='select_file' name="img" type="file" accept="image/*" />
                                </label>
                            </div>
                        </div>
                        <div id="image_in"></div>
                    </div>
                    
                    <div class="n-m-edit">
                        <div class="name-edit">
                            <label>USERNAME</label><br>
                            <input type="text" name='name' value="<?php echo h($up_user['name']) ?>">
                        </div>
                        <div class="mail-edit">
                            <label>EMAIL</label><br>
                            <input type="email" name='email' value="<?php echo h($up_user['email']) ?>">
                        </div>
                    </div>
                </div>
                <div class="submit-btn">
                    <div class="s-btn">
                        <input class="pro-submit" type="submit" value="変更">
                    </div>
                    <div class="b-btn">
                        <p class="back">戻る</p>
                    </div>
                </div>
            </form>
        </div>
        <script>
        $('.select_file').change(function(){
            var image = "";
            if (this.files.length > 0) {
                // 選択されたファイル情報を取得
                var file = this.files[0];
                
                // readerのresultプロパティに、データURLとしてエンコードされたファイルデータを格納
                var reader = new FileReader();
                reader.readAsDataURL(file);

                $('.e-f-title').css('display','none');
                
                reader.onload = function() {
                    image += "<img src=\"" + this.result + "\" />\r\n";
                    document.getElementById( "image_in" ).innerHTML = image;
                }
            }
        });
        </script>
        <div class="notify">
            <p>※iphoneで撮影した写真など、一部使用できない画像があるので、ご注意ください。<br>　(スクリーンショットであれば可能です。)</p>
            <p><br>※画像ファイルサイズの上限を指定してあるため、<br>エラーが出た場合は別の画像をご利用ください。</p>
        </div>
    </main>
    <footer>
        <div class="footer-innner">
            <div class="footer-name">
                <p>KU Info Village</p>
            </div>
            <div class="media">
                <ul>
                    <li><a href="https://twitter.com/kazuki82325972" target="blank"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://instagram.com/k.sagisaka" target="blank"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://github.com/sagisaka3301" target="blank"><i class="fab fa-github"></i></a></li>
                    <li><i class="fab fa-youtube"></i></li>
                </ul>
            </div>
            <div class="footer-logo">
                <div class="logo">
                    <img src="./img/K.png" alt="ロゴ">
                    <p>Thanks for Visiting</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>🄬 2021 KU INFO VILLAGE</p>
            </div>
        </div>
    </footer>
<script src="./js/mypage.js"></script>
</body>
</div>
</html>